<?
	if(!$ikey) {
		getLink('','','설치 인증키를 입력하세요.','');
	}
	if(!$imodule) {
		getLink('','','설치 모듈을 선택하세요.','');
	}

	// 설치 서버 인증...
	// ==================================================
	$host_name = "nsone.cafe24.com";
	$fp = fsockopen($host_name, 80, $errno, $errstr, 30);
	if (!$fp){
		getLink('','','인증 서버가 응답하지 않습니다.','');
	}
	$http_param = "id=root&pw={$ikey}";
	$http_req = "POST /inst/?m=install&a=getfile HTTP/1.1\r\n";
	$http_req .= "Host: {$host_name}\r\n";
	$http_req .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$http_req .= "Content-Length: ".strlen($http_param)."\r\n";
	$http_req .= "Connection: Close\r\n\r\n";
	fwrite($fp, $http_req);
	fwrite($fp, $http_param);
	$buf = "";
	while (!feof($fp)){
		$buf .= fgets($fp, 2048);
	}
	fclose($fp);
	$buf = trim($buf);
	$buf = substr($buf, strpos($buf,"\r\n\r\n"));
	// 응답결과
	$result = json_decode($buf);
	if($result->err_code) {
		getLink('','',$result->err_msg,'');
	}
	
	// 모듈 다운로드
	// ==================================================
	$downfile	= $imodule.'.tar.gz';
	$fp = fsockopen($host_name, 80, $errno, $errstr, 30);
	if (!$fp){
		getLink('','','다운로드 서버가 응답하지 않습니다.','');
	}

	$http_req = "GET /_storage/{$downfile} HTTP/1.1\r\n";
	$http_req .= "Host: {$host_name}\r\n";
	$http_req .= "Content-Type: application/x-www-form-urlencoded\r\n";
	$http_req .= "Connection: Close\r\n\r\n";
	fwrite($fp, $http_req);

	$buf			= "";
	$header_check	= false;
	$dest			= fopen($downfile, 'wb');
	while (!feof($fp)){
		if($header_check === false) {
			$buf .= fgets($fp, 2048);
			$pos	= strpos($buf, "\r\n\r\n");
			if($pos) {
				$header_check = true;
				fwrite($dest, substr($buf, $pos+4));
			}
			continue;
		}
		fwrite($dest, fgets($fp, 2048));
	}
	fclose($fp);
	fclose($dest);

	exec("tar -xvzf {$downfile}");
	exec("chmod -R 707 *");
	unlink($downfile);

	getLink('','','설치 되었습니다.','');
?>