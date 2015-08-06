<?php
if(!defined('__KIMS__')) exit;

if(!$sess_Code) exit;

$savePath = $upload_dir;
$saveFile = $savePath.getUTFtoKR($_FILES['Filedata']['name']);
$fileExt  = strtolower(getExt($_FILES['Filedata']['name']));

if ($Overwrite == 'true' || !is_file($saveFile))
{
	if (strstr('php3,html,inc,cgi,pl,jsp',$fileExt)) exit;

	move_uploaded_file($_FILES['Filedata']['tmp_name'], $saveFile);
	@chmod($saveFile,0707);
}

exit;
?>