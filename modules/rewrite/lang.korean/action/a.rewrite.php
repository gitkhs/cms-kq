<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$mfile = './.htaccess';
$fp = fopen($mfile,'w');
fwrite($fp,trim(stripslashes($rewrite)));
fclose($fp);
@chmod($mfile,0707);

getLink('reload','parent.','','');
?>