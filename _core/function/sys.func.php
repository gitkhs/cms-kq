<?php
//TIME얻기
function getNowTimes()
{
	$MicroTsmp = explode(' ',microtime());
	return $MicroTsmp[0]+$MicroTsmp[1];
}
//링크
function getLink($url,$target,$alert,$history)
{
	include_once $GLOBALS['g']['path_core'].'function/lib/getLink.lib.php';
}
//윈도우오픈
function getWindow($url,$alert,$option,$backurl,$target)
{
	include_once $GLOBALS['g']['path_core'].'function/lib/getWindow.lib.php';
}
//검색sql
function getSearchSql($w,$k,$ik,$h)
{
	include_once $GLOBALS['g']['path_core'].'function/lib/searchsql.lib.php';
	return LIB_getSearchSql($w,$k,$ik,$h);
}
//페이징
function getPageLink($lnum,$p,$tpage,$img)
{
	include_once $GLOBALS['g']['path_core'].'function/lib/page.lib.php';
	return LIB_getPageLink($lnum,$p,$tpage,$img);
}
//페이징 부트스트랩
function getBootstrapPageLink($lnum,$p,$tpage)
{
	include_once $GLOBALS['g']['path_core'].'function/lib/page.lib.php';
	return LIB_getBootstrapPageLink($lnum,$p,$tpage);
}
//문자열끊기
function getStrCut($long_str,$cutting_len,$cutting_str)
{
	$rtn = array();$long_str = trim($long_str);
    return preg_match('/.{'.$cutting_len.'}/su', $long_str, $rtn) ? $rtn[0].$cutting_str : $long_str;
}
//링크필터링
function getLinkFilter($default,$arr)
{
	foreach($arr as $val) if ($GLOBALS[$val]) $default .= '&amp;'.$val.'='.urlencode($GLOBALS[$val]);
	return $default;
}
//총페이지수
function getTotalPage($num,$rec)
{
	return @intval(($num-1)/$rec)+1;
}
//날짜포맷
function getDateFormat($d,$f)
{
	return $d ? getDateCal($f,$d,0) : '';
}
//시간조정/포맷
function getDateCal($f,$d,$h)
{
	return date($f,mktime((int)substr($d,8,2)+$h,(int)substr($d,10,2),(int)substr($d,12,2),substr($d,4,2),substr($d,6,2),substr($d,0,4)));
}
//시간값
function getVDate($t)
{
	$date['PROC']	= $t ? getDateCal('YmdHisw',date('YmdHis'),$t) : date('YmdHisw');
	$date['totime'] = substr($date['PROC'],0,14);
	$date['year']	= substr($date['PROC'],0,4);
	$date['month']	= substr($date['PROC'],0,6);
	$date['today']  = substr($date['PROC'],0,8);
	$date['nhour']  = substr($date['PROC'],0,10);
	$date['tohour'] = substr($date['PROC'],8,6);
	$date['toweek'] = substr($date['PROC'],14,1);
	return $date;
}
//남은날짜
function getRemainDate($d)
{
	if(!$d) return 0;
	return ((substr($d,0,4)-date('Y')) * 365) + (date('z',mktime(0,0,0,substr($d,4,2),substr($d,6,2),substr($d,0,4)))-date('z'));
}
//지난시간
function getOverTime($d1,$d2)
{
	if (!$d2) return array(0);
	$d1 = date('U',mktime(substr($d1,8,2),substr($d1,10,2),substr($d1,12,2),substr($d1,4,2),substr($d1,6,2),substr($d1,0,4)));
	$d2 = date('U',mktime(substr($d2,8,2),substr($d2,10,2),substr($d2,12,2),substr($d2,4,2),substr($d2,6,2),substr($d2,0,4)));
	$tx = $d1-$d2;$ar = array(1,60,3600,86400,2592000,31104000);
	for ($i = 0; $i < 5; $i++) if ($tx < $ar[$i+1]) return array((int)($tx/$ar[$i]),$i);
	return array(substr($d1,0,4)-substr($d2,0,4),5);
}
//요일
function getWeekday($n)
{
	return $GLOBALS['lang']['sys']['week'][$n];
}
//시간비교
function getNew($time,$term)
{
	if(!$time) return false;
	$dtime = date('YmdHis',mktime(substr($time,8,2)+$term,substr($time,10,2),substr($time,12,2),substr($time,4,2),substr($time,6,2),substr($time,0,4)));
	if ($dtime > $GLOBALS['date']['totime']) return true;
	else return false;
}
//퍼센트
function getPercent($a,$b,$flag)
{
	return round($a / $b * 100 , $flag);
}
//지정문자열필터링
function filterstr($str)
{
	$str = str_replace(',','',$str);
	$str = str_replace('.','',$str);
	$str = str_replace('-','',$str);
	$str = str_replace(':','',$str);
	$str = str_replace(' ','',$str);
	return $str;
}
//문자열복사
function strCopy($str1,$str2)
{
	$badstrlen = getUTFtoUTF($str1) == $str1 ? strlen($str1) : intval(strlen($str1)/3);
	return str_pad('',($badstrlen?$badstrlen:1),$str2);
}
//아웃풋
function getContents($str,$html)
{
	include_once $GLOBALS['g']['path_core'].'function/lib/getContent.lib.php';
	return LIB_getContents($str,$html);
}
//쿠키배열
function getArrayCookie($ck,$split,$n)
{
	$arr = explode($split,$ck);
	return $arr[$n];
}
//대괄호배열
function getArrayString($str)
{
	$arr1 = array();
	$arr1['data'] = array();
	$arr2 = explode('[',$str);
	foreach($arr2 as $val)
	{
		if($val=='') continue;
		$arr1['data'][] = str_replace(']','',$val);
	}
	$arr1['count'] = count($arr1['data']);
	return $arr1;
}
//성별
function getSex($flag)
{
	return $GLOBALS['lang']['sys']['sex'][$flag-1];
}
//생일->나이
function getAge($birth)
{
	if (!$birth) return 0;
	return substr($GLOBALS['date']['today'],0,4) - substr($birth,0,4) + 1;
}
//나이->출생년도
function getAgeToYear($age)
{
	return substr($GLOBALS['date']['today'],0,4)-($age-1);
}
//사이즈포멧
function getSizeFormat($size,$flag)
{
	if ($size/(1024*1024*1024)>1) return round($size/(1024*1024*1024),$flag).'GB';
	if ($size/(1024*1024)>1) return round($size/(1024*1024),$flag).'MB';
	if ($size/1024>1) return round($size/1024,$flag).'KB';
	if ($size/1024<1) return $size.'B';
}
//파일타입
function getFileType($ext)
{
	if (strpos('_gif,jpg,jpeg,png,bmp,',strtolower($ext))) return 2;
	if (strpos('_swf,',strtolower($ext))) return 3;
	if (strpos('_mid,wav,mp3,',strtolower($ext))) return 4;
	if (strpos('_asf,asx,avi,mpg,mpeg,wmv,wma,mov,flv,',strtolower($ext))) return 5;
	if (strpos('_doc,xls,ppt,hwp',strtolower($ext))) return 6;
	if (strpos('_zip,tar,gz,tgz,alz,',strtolower($ext))) return 7;
	return 1;
}
//파일확장자
function getExt($name)
{
	$nx=explode('.',$name);
	return $nx[count($nx)-1];
}
//이미지추출
function getImgs($code,$type) 
{  
	$erg = '/src[ =]+[\'"]([^\'"]+\.(?:'.$type.'))[\'"]/i';  
	preg_match_all($erg, $code, $mtc, PREG_PATTERN_ORDER);
	return $mtc[1];
}
//이미지체크
function getThumbImg($img)
{
	$arr=array('.jpg','.gif','.png');
	foreach($arr as $val) if(is_file($img.$val)) return $GLOBALS['g']['s'].'/'.str_replace('./','',$img).$val;
}
function getUploadImage($upfiles,$d,$content,$ext)
{
	include_once $GLOBALS['g']['path_core'].'function/lib/getUploadImage.lib.php';
	return LIB_getUploadImage($upfiles,$d,$content,$ext);
}
//도메인
function getDomain($url)
{
	$urlexp = explode('/',$url);
	return $urlexp[2];
}
//키워드
function getKeyword($url)
{
	$urlexp = explode('?' , urldecode($url));
	if (!trim($urlexp[1])) return '';
	$queexp = explode('&' , $urlexp[1]);
	$quenum = count($queexp);
	for ($i = 0; $i < $quenum; $i++){$valexp = explode('=',trim($queexp[$i])); if (strstr(',query,q,p,',','.$valexp[0].',')&&!is_numeric($valexp[1])) return $valexp[1] == getUTFtoUTF($valexp[1]) ? $valexp[1] : getKRtoUTF($valexp[1]);}
	return '';
}
//검색엔진
function getSearchEngine($url)
{
	$set = array('naver','nate','daum','yahoo','google');
	foreach($set as $val) if (strpos($url,$val)) return $val;
	return 'etc';
}
//브라우져
function getBrowzer($agent)
{
	if(isMobileConnect($agent)) return 'Mobile';
	$set = array('MSIE 9','MSIE 8','MSIE 7','MSIE 6','Firefox','Opera','Chrome','Safari');
	foreach($set as $val) if (strpos('_'.$agent,$val)) return $val;
	return '';
}
//폴더네임얻기
function getFolderName($file)
{
	if(is_file($file.'/name.txt')) return implode('',file($file.'/name.txt'));
	return basename($file);
}
function getKRtoUTF($str)
{
	return iconv('euc-kr','utf-8',$str);
}
function getUTFtoKR($str)
{
	return iconv('utf-8','euc-kr',$str);
}
function getUTFtoUTF($str)
{
	return iconv('utf-8','utf-8',$str);
}
//관리자체크
function checkAdmin($n)
{
	if(!$GLOBALS['my']['admin']) getLink('','',$GLOBALS['lang']['sys']['need_admin'],$n?$n:'');
}
//모바일접속체크
function isMobileConnect($agent)
{
	if($_SESSION['pcmode']=='E') return 'RB-Emulator';
	$xagent = strtolower($agent);
	foreach($GLOBALS['d']['magent'] as $val)
	{
		$valexp = explode('=',trim($val));
		if(strpos($xagent,$valexp[0])) return $valexp[1];
	}
	return '';
}
//MOD_rewrite
function RW($rewrite)
{
	if ($GLOBALS['_HS']['rewrite'])
	{
		if(!$rewrite) return $GLOBALS['g']['r']?$GLOBALS['g']['r']:'/';
		$rewrite = str_replace('c=','c/',$rewrite);
		$rewrite = str_replace('mod=','p/',$rewrite);
		$rewrite = str_replace('m=admin','admin',$rewrite);
		$rewrite = str_replace('m=bbs','b',$rewrite);
		$rewrite = str_replace('&bid=','/',$rewrite);
		$rewrite = str_replace('&uid=','/',$rewrite);
		$rewrite = str_replace('&CMT=','/',$rewrite);
		$rewrite = str_replace('&s=','/s',$rewrite);
		return $GLOBALS['g']['r'].'/'.$rewrite;
	}
	else return $GLOBALS['_HS']['usescode']?('./?r='.$GLOBALS['_HS']['id'].($rewrite?'&amp;'.$rewrite:'')):'./'.($rewrite?'?'.$rewrite:'');;
}
//동기화URL
function getCyncUrl($cync)
{
	if (!$cync) return $GLOBALS['g']['r'];
	$_r = getArrayString($cync);
	$_r = $_r['data'][5];
	if ($GLOBALS['_HS']['rewrite']&&strpos('_'.$_r,'m:bbs,bid:'))
	{
		$_r = str_replace('m:bbs','b',$_r);
		$_r = str_replace(',bid:','/',$_r);
		$_r = str_replace(',uid:','/',$_r);
		$_r = str_replace(',CMT:','/',$_r);
		$_r = str_replace(',s:','/s',$_r);
		return $GLOBALS['g']['r'].'/'.$_r;
	}
	else return $GLOBALS['g']['s'].'/?'.($GLOBALS['_HS']['usescode']?'r='.$GLOBALS['_HS']['id'].'&amp;':'').str_replace(':','=',str_replace(',','&amp;',$_r));
}
//게시물링크
function getPostLink($arr)
{
	return RW('m=bbs&bid='.$arr['bbsid'].'&uid='.$arr['uid'].($GLOBALS['s']!=$arr['site']?'&s='.$arr['site']:''));
}
//위젯불러오기
function getWidget($widget,$wdgvar)
{
	global $DB_CONNECT,$table,$date,$my,$r,$s,$m,$g,$d,$c,$mod,$_HH,$_HD,$_HS,$_HM,$_HP,$_CA;
	static $wcsswjsc;
	if (!is_file($g['wdgcod']) && !strpos('_'.$wcsswjsc,'['.$widget.']'))
	{
		$wcss = $g['path_widget'].$widget.'/main.css';
		$wjsc = $g['path_widget'].$widget.'/main.js';
		if (is_file($wcss)) $g['widget_cssjs'] .= '<link type="text/css" rel="stylesheet" charset="utf-8" href="'.$g['s'].'/widgets/'.$widget.'/main.css" />'."\n";
		if (is_file($wjsc)) $g['widget_cssjs'] .= '<script type="text/javascript" charset="utf-8" src="'.$g['s'].'/widgets/'.$widget.'/main.js" /></script>'."\n";
		$wcsswjsc.='['.$widget.']';
	}
	$wdgvar['widget_id'] = $widget;
	include $g['path_widget'].$widget.'/main.php';
}
//문자열필터(@ 1.1.0)
function getStripTags($string)
{
	return str_replace('&nbsp;',' ',str_replace('&amp;nbsp;',' ',strip_tags($string)));
}
//스위치로드(@ 1.1.0)
function getSwitchInc($pos)
{
	$incs = array();
	foreach ($GLOBALS['d']['switch'][$pos] as $switch)
	{
		if(strpos($switch,'@')) continue;
		$incs[] = $GLOBALS['g']['path_switch'].$pos.'/'.$switch.'/main.php';
	} 
	return $incs;
}
// 페이지계산
function PageCalc($p,$t,$u=10,$s=10){
	// p : 현재 페이지 번호
	// t : 조회한 데이터의 총건수
	// u : 한페이지에 보여줄 유닛갯수
	// s : 페이저 번호 갯수
	$_p['s'] = $s;											// 페이저 번호 갯수
	$_p['u'] = $u;											// 페이자당 보여줄 갯수
	$_p['n'] = ($p-1) * $u;									// 쿼리 데이터 커서 위치 (limit [n], [u])
	$_p['t'] = $t - $_p['n'];								// 조회페이지에 붙일넘버링
	$_p['c'] = ceil($t / $u);								// 총 페이지 수
	$_p['c'] = $_p['c'] ? $_p['c'] : 1;
	$_p['i'] = $GLOBALS['g']['img_core'].'/page/default';	// 페이저 관련 이미지 경로
	
	return $_p;
}
//xml파싱
function ParseSimpleXml($str){
	libxml_use_internal_errors(true);
	$sxe = simplexml_load_string($str);
	if (!$sxe) {
		echo "Failed loading XML\n";
		foreach(libxml_get_errors() as $error) {
			echo "\t", $error->message;
		}
	}
	return $sxe;
}
// 파일다운로드
function downFile($path,$name){
	$filesize = filesize($path);
	header("Content-Type: application/octet-stream"); 
	header("Content-Length: " .$filesize); 
	header('Content-Disposition: attachment; filename="'.$name.'"'); 
	header("Cache-Control: private, must-revalidate"); 
	header("Pragma: no-cache");
	header("Expires: 0");

	$fp = fopen($path, 'rb');
	if (!fpassthru($fp)) fclose($fp);
}
// ftp 파일 전송
function putFtpFile($host, $hid, $hpwd, $aFlist){
	$FTP_CONNECT = ftp_connect($host);
	$FTP_CRESULT = ftp_login($FTP_CONNECT,$hid,$hpwd);
	if (!$FTP_CONNECT || !$FTP_CRESULT)
		getLink('','','FTP 접속 정보가 잘못 되었습니다.','');
	foreach($aFlist as $_val){
		$tmp	= explode('||',$_val);
		if($tmp[0]=='mkdir')
			ftp_mkdir($FTP_CONNECT,$tmp[1]);
		else
			ftp_put($FTP_CONNECT,$tmp[0],$tmp[1],FTP_BINARY);
	}
	ftp_close($FTP_CONNECT);
}
// ftp 파일 다운로드
function getFtpFile($host, $hid, $hpwd, $aFlist){
//	$files	= array("./images/def/test/topmenudef.jpg||rb/images/s0001/topmenudef.jpg");
//	$files	= array("getdir||./rb/images/def/test||rb/images/s0001");
//	getFtpFile("", "", "", $files);
	$FTP_CONNECT = ftp_connect($host);
	$FTP_CRESULT = ftp_login($FTP_CONNECT,$hid,$hpwd);
	if (!$FTP_CONNECT || !$FTP_CRESULT)
		getLink('','','FTP 접속 정보가 잘못 되었습니다.','');
	foreach($aFlist as $_val){
		$tmp	= explode('||',$_val);
		if($tmp[0]=='getdir'){
// 디렉토리 여유있을때 다시 확인
//			$contents = ftp_nlist($FTP_CONNECT, $tmp[2]);
//			foreach($contents as $_item){
//				$_item	= trim($_item);
//				$pos	= strrpos($_item,'/');
//				$fname	= substr($_item,$pos,strlen($_item)-$pos);
//				echo '['.$_item.']<br/>';
//				echo $tmp[1].$fname.'<br/>';
//				ftp_get($FTP_CONNECT, $_item, $tmp[1].$fname, FTP_BINARY);
//				break;
//			}
		}
		else
			ftp_get($FTP_CONNECT,$tmp[0],$tmp[1],FTP_BINARY);
	}
	ftp_close($FTP_CONNECT);
}
?>