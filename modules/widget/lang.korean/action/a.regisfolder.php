<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$name = trim($name);
$folder = trim($folder);

if (!$name || !$folder) exit;

mkdir($g['path_widget'].$folder,0707);
$fp = fopen($g['path_widget'].$folder.'/name.txt','w');
fwrite($fp,$name);
fclose($fp);

@chmod($g['path_widget'].$folder,0707);
@chmod($g['path_widget'].$folder.'/name.txt',0707);

getLink('reload','parent.','','');
?>