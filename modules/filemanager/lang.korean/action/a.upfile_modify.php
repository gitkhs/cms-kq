<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

if (is_uploaded_file($_FILES['upfile']['tmp_name']))
{
	$folder = './'.str_replace('./','',$folder);
	$oldfile= getUTFtoKR($oldfile);

	$upFile_A = explode('.' , $_FILES['upfile']['name']);
	$upFile_E = strtolower($upFile_A[count($upFile_A)-1]);

	if ($upFile_E == $fileext)
	{
		move_uploaded_file($_FILES['upfile']['tmp_name'],$folder.$oldfile);
		@chmod($folder.$oldfile , 0707);
	}
}

getLink('reload','parent.',$alert,$history);
?>