<?php
if(!defined('__KIMS__')) exit;

include_once $g['dir_module'].'var/var.php';

if ($d['trackback']['perm_write'] > $my['level'] && !$my['admin'])
{
	getLink('','','권한이 없습니다.','');
}

if ($trackback)
{
	$cyncArr= getArrayString($_SESSION[$m.'cync']);
	$trackback = trim($trackback);
	$compaurl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'].'/'.$r.'/'.$cyncArr['data'][0].'/'.$cyncArr['data'][1];
	if ($trackback == $compaurl) getLink('','','지정된 주소는 원본글의 트랙백주소입니다.','');
	$R = getUidData($table[$cyncArr['data'][0].'data'],$cyncArr['data'][1]);

	if ($R['uid'])
	{
		include_once $g['path_core'].'function/trackback.func.php';
		
		$orignurl = $g['url_root'].'/?r='.$r.'&m='.$cyncArr['data'][0].'&bid='.$R['bbsid'].'&uid='.$R['uid'];
		$result = putTrackback($trackback,$orignurl,getUTFtoKR($R['subject']),getUTFtoKR($R[$_HS['nametype']]),getUTFtoKR(strip_tags($R['content'])),0);

		if ($result)
		{
			$minuid = getDbCnt($table['s_trackback'],'min(uid)','');
			$uid = $minuid ? $minuid-1 : 100000000;

			$QKEY = "uid,site,type,parent,parentmbr,url,name,subject,content,d_regis,d_modify,cync";
			$QVAL = "'$uid','$s','2','".$cyncArr['data'][0].$R['uid']."','".$my['uid']."','$trackback','','','','".$date['totime']."','','".$_SESSION[$m.'cync']."'";
			getDbInsert($table['s_trackback'],$QKEY,$QVAL);
			getDbUpdate($table['s_numinfo'],'sndtrack=sndtrack+1',"date='".$date['today']."' and site=".$s);

			if ($uid == 100000000) db_query("OPTIMIZE TABLE ".$table['s_trackback'],$DB_CONNECT);
		}
		else {
			getLink('','','트랙백서버가 동작하지 않거나 정상적인 주소가 아닙니다.','');
		}
	}
}

getLink('reload','parent.','','');
?>