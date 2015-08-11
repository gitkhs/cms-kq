<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

if ($moduleid)
{

	$tmpname	= $_FILES['upfile']['tmp_name'];
	$realname	= $_FILES['upfile']['name'];
	$fileExt	= strtolower(getExt($realname));
	$fileExt	= $fileExt == 'jpeg' ? 'jpg' : $fileExt;
	$photo		= $my['id'].'.'.$fileExt;
	$saveFile	= $g['path_module'].$moduleid.'/icon.gif';


	if (is_uploaded_file($tmpname))
	{
		if (!strstr('[gif][jpg][png]',$fileExt))
		{
			getLink('','','gif/jpg/png 파일만 등록할 수 있습니다.','');
		}
		if (is_file($saveFile))
		{
			unlink($saveFile);
		}

		include_once $g['path_core'].'function/thumb.func.php';

		move_uploaded_file($tmpname,$saveFile);
		ResizeWidthHeight($saveFile,$saveFile,60,60);
		@chmod($saveFile,0707);

	}

	getDbUpdate($table['s_module'],"name='".trim($name)."',hidden='$hidden',mobile='$mobile'","id='".$moduleid."'");

}

getLink('reload','parent.','','');

?>