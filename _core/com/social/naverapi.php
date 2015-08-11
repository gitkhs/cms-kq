<?
//	include $g['path_layout'].'_config.php';
function sendNaverSearch($query, $target, $start, $debug='') {
	$host_name = "openapi.naver.com";

	$fp = fsockopen($host_name, 80, $errno, $errstr, 30);
	if (!$fp){
		$result = array('code'=>'-1001', 'message'=>'서버가 응답하지 않습니다.');
		return $result;
	}
	
	//$key	= "c1b406b32dbbbbeee5f2a36ddc14067f";
	$key = "a1ad0cf313221213155678c1576674ce";
	$query	= urlencode($query);
	$http_req = "GET /search?key={$key}&target={$target}&display=5&start={$start}&query={$query} HTTP/1.1\r\n";
	$http_req .= "Host: {$host_name}\r\n";
	$http_req .= "Connection: Close\r\n\r\n";

	fwrite($fp, $http_req);
	fwrite($fp, $http_param);

	$buf = "";
	while (!feof($fp)){
		$buf .= fgets($fp, 2048);
	}
	fclose($fp);

	if($debug) {
		echo '<textarea style="width:100%; height:300px;">'.$buf.'</textarea>';
	}

	$buf = trim($buf);
	$buf = substr($buf,strpos($buf,"\r\n<?")+2);
	$buf = substr($buf,0,strpos($buf,"</rss>")+6);
	
	// xml parse
	$xml = ParseSimpleXml($buf);
	return $xml->channel->item;
}

// sample
//$news1	= sendNaverSearch('부동산 모텔', 'news', 1);
?>
