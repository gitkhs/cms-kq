<?php
if(!defined('__KIMS__')) exit;

include_once $g['path_core'].'function/thumb.func.php';
include_once $g['dir_module'].'var/var.php';

$sessArr	= explode('_',$sess_Code);
$tmpcode	= $sessArr[0];
$mbruid		= $sessArr[1];
$fserver	= $d['upload']['use_fileserver'];
$url		= $fserver ? $d['upload']['ftp_urlpath'] : $g['url_root'].'/files/';
$name		= strtolower($_FILES['Filedata']['name']);
$size		= $_FILES['Filedata']['size'];
$width		= 0;
$height		= 0;
$caption	= trim($caption);
$down		= 0;
$d_regis	= $date['totime'];
$d_update	= '';
$fileExt	= getExt($name);
$fileExt	= $fileExt == 'jpeg' ? 'jpg' : $fileExt;
$type		= getFileType($fileExt);
$tmpname	= md5($name).substr($date['totime'],8,14);
$tmpname	= $type == 2 ? $tmpname.'.'.$fileExt : $tmpname;
$hidden		= $type == 2 ? 1 : 0;

if ($d['upload']['ext_cut'] && strstr($d['upload']['ext_cut'],$fileExt)) getLink('','','정상적인 접근이 아닙니다.','');

$savePath1	= $saveDir.substr($date['today'],0,4);
$savePath2	= $savePath1.'/'.substr($date['today'],4,2);
$savePath3	= $savePath2.'/'.substr($date['today'],6,2);
$folder		= substr($date['today'],0,4).'/'.substr($date['today'],4,2).'/'.substr($date['today'],6,2);

if ($fserver)
{
	$FTP_CONNECT = ftp_connect($d['upload']['ftp_host'],$d['upload']['ftp_port']); 
	$FTP_CRESULT = ftp_login($FTP_CONNECT,$d['upload']['ftp_user'],$d['upload']['ftp_pass']); 
	if (!$FTP_CONNECT) exit;
	if (!$FTP_CRESULT) exit;

	if($d['upload']['ftp_pasv']) ftp_pasv($FTP_CONNECT, true);
	ftp_chdir($FTP_CONNECT,$d['upload']['ftp_folder']);

	for ($i = 1; $i < 4; $i++)
	{
		ftp_mkdir($FTP_CONNECT,$d['upload']['ftp_folder'].str_replace('./files/','',${'savePath'.$i}));
	}

	if ($Overwrite == 'true' || !is_file($saveFile))
	{
		if ($type == 2)
		{
			$thumbname = md5($tmpname).'.'.$fileExt;
			$thumbFile = $g['path_tmp'].'backup/'.$thumbname;
			ResizeWidth($_FILES['Filedata']['tmp_name'],$thumbFile,150);
			$IM = getimagesize($_FILES['Filedata']['tmp_name']);
			$width = $IM[0];
			$height= $IM[1];
			ftp_put($FTP_CONNECT,$d['upload']['ftp_folder'].$folder.'/'.$thumbname,$thumbFile,FTP_BINARY);
			unlink($thumbFile);
		}
	}
	ftp_put($FTP_CONNECT,$d['upload']['ftp_folder'].$folder.'/'.$tmpname,$_FILES['Filedata']['tmp_name'],FTP_BINARY);
	ftp_close($FTP_CONNECT);
}
else {

	for ($i = 1; $i < 4; $i++)
	{
		if (!is_dir(${'savePath'.$i}))
		{
			mkdir(${'savePath'.$i},0707);
			@chmod(${'savePath'.$i},0707);
		}
	}

	$saveFile = $savePath3.'/'.$tmpname;

	if ($Overwrite == 'true' || !is_file($saveFile))
	{
		move_uploaded_file($_FILES['Filedata']['tmp_name'], $saveFile);
		if ($type == 2)
		{
			$thumbname = md5($tmpname).'.'.$fileExt;
			$thumbFile = $savePath3.'/'.$thumbname;
			ResizeWidth($saveFile,$thumbFile,150);
			@chmod($thumbFile,0707);
			$IM = getimagesize($saveFile);
			$width = $IM[0];
			$height= $IM[1];
		}
		@chmod($saveFile,0707);
	}

}

$mingid = getDbCnt($table['s_upload'],'min(gid)','');
$gid = $mingid ? $mingid - 1 : 100000000;

$QKEY = "gid,hidden,tmpcode,site,mbruid,type,ext,fserver,url,folder,name,tmpname,thumbname,size,width,height,caption,down,d_regis,d_update,cync";
$QVAL = "'$gid','$hidden','$tmpcode','$s','$mbruid','$type','$fileExt','$fserver','$url','$folder','$name','$tmpname','$thumbname','$size','$width','$height','$caption','$down','$d_regis','$d_update','$cync'";
getDbInsert($table['s_upload'],$QKEY,$QVAL);
getDbUpdate($table['s_numinfo'],'upload=upload+1',"date='".$date['today']."' and site=".$s);

if ($gid == 100000000) db_query("OPTIMIZE TABLE ".$table['s_upload'],$DB_CONNECT); 

if ($upType == 'normal')
{
	getLink($g['s'].'/?r='.$r.'&m='.$m.'&mod='.$mod.'&gparam='.$gparam.($cupload?'&cupload='.$cupload:''),'','','');
}
exit;
?>