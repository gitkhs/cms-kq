<?php
if(!defined('__KIMS__')) exit;

$_path = explode('/',$_SERVER['PATH_INFO']);
$_gurl = 'http://'.$_SERVER['HTTP_HOST'].str_replace('index.php','',$_SERVER['SCRIPT_NAME']);
if (!$_path[1] || !$_path[2] || !$_path[3]) getLink($_gurl,'','','');

$R = getUidData($table[$_path[2].'data'],$_path[3]);
if (!$R['uid']) $message = 'No Article';

if(!($_POST['title'] && $_POST['excerpt'] && $_POST['url'] && $_POST['blog_name']))
{
	getLink($_gurl.'?r='.$_path[1].'&m='.$_path[2].'&bid='.$R['bbsid'].'&uid='.$R['uid'],'','','');
}

if (!$message)
{
	$cync		= '['.$_path[2].']['.$R['uid'].'][m:'.$_path[2].',bid:'.$R['bbsid'].',uid:'.$R['uid'].']';
	$url		= $_POST['url'];
	$blog_name	= getUTFtoUTF($_POST['blog_name'])	== $_POST['blog_name']	? $_POST['blog_name']	: getKRtoUTF($_POST['blog_name']);
	$title		= getUTFtoUTF($_POST['title'])		== $_POST['title']		? $_POST['title']		: getKRtoUTF($_POST['title']);
	$excerpt	= getUTFtoUTF($_POST['excerpt'])	== $_POST['excerpt']	? $_POST['excerpt']		: getKRtoUTF($_POST['excerpt']);
	
	$T = getDbData($table['s_trackback'],'site='.$R['site']." and parent='".$_path[2].$R['uid']."' and url='".$url."'",'*');
	if ($T['uid'])
	{
		getDbUpdate($table['s_trackback'],"name='$blog_name',subject='$title',content='$excerpt',d_modify='".$date['totime']."'",'uid='.$T['uid']);
		getDbUpdate($table[$_path[2].'data'],"d_trackback='".$date['totime']."'",'uid='.$R['uid']);
	}
	else {
		$minuid = getDbCnt($table['s_trackback'],'min(uid)','');
		$uid = $minuid ? $minuid-1 : 100000000;

		$QKEY = "uid,site,type,parent,parentmbr,url,name,subject,content,d_regis,d_modify,cync";
		$QVAL = "'$uid','$s','1','".$_path[2].$R['uid']."','".$R['mbruid']."','$url','$blog_name','$title','$excerpt','".$date['totime']."','','$cync'";
		getDbInsert($table['s_trackback'],$QKEY,$QVAL);
		getDbUpdate($table['s_numinfo'],'rcvtrack=rcvtrack+1',"date='".$date['today']."' and site=".$s);
		getDbUpdate($table[$_path[2].'data'],"trackback=trackback+1,d_trackback='".$date['totime']."'",'uid='.$R['uid']);

		if ($uid == 100000000) db_query("OPTIMIZE TABLE ".$table['s_trackback'],$DB_CONNECT);
	}
}

header("Content-type: text/xml");
header("Cache-Control: no-cache, must-revalidate"); 
header("Pragma: no-cache");   
echo "<?xml version='1.0' encoding='utf-8'?>";
if ($message)
{
	echo "<response>";
	echo "<error>1</error>";
	echo "<message>".$message."</message>";
	echo "</response>";
}
else {
	echo "<response>";
	echo "<error>0</error>";
	echo "</response>";
}
exit;
?>