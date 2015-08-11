<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$folder = './'.str_replace('./','',$folder);
$nFile = $folder.getUTFtoKR($newfile);

$fp = fopen($nFile,'w');
fwrite($fp,trim(stripslashes($content)));
fclose($fp);
@chmod($nFile,0707);

getLink('reload','parent.',$alert,$history);
?>