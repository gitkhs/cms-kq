<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$folder = './'.str_replace('./','',$folder);

$oldfile = getUTFtoKR($oldfile);
$newfile = getUTFtoKR($newfile);

if ($oldfile == $newfile)
{
	if ($backup)
	{
		$backUpFile = $g['path_tmp'].'backup/'.str_replace('/','_',str_replace('./','',$folder).$oldfile).'.bak';
		if(is_file($backUpFile)) unlink($backUpFile);
		copy($folder.$oldfile,$backUpFile);
		@chmod($backUpFile,0707);
	}

	$fp = fopen($folder.$oldfile,'w');
	fwrite($fp,trim(stripslashes($content)));
	fclose($fp);
	@chmod($folder.$oldfile,0707);
}
else {

	if ($backup)
	{
		$new_backUpFile = $g['path_tmp'].'backup/'.str_replace('/','_',str_replace('./','',$folder).$newfile).'.bak';
		copy($folder.$oldfile,$new_backUpFile);
		@chmod($new_backUpFile,0707);
	}

	$old_backUpFile = $g['path_tmp'].'backup/'.str_replace('/','_',str_replace('./','',$folder).$oldfile).'.bak';
	if(is_file($old_backUpFile)) unlink($old_backUpFile);
	unlink($folder.$oldfile);

	$nFile = $folder.$newfile;

	$fp = fopen($nFile,'w');
	fwrite($fp,trim(stripslashes($content)));
	fclose($fp);
	@chmod($nFile,0707);

}

getLink('reload','parent.',$alert,$history);
?>