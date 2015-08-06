<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$sfile = $g['path_switch'].$switch.'/main.php';
$nfile = $g['path_switch'].$switch.'/name.txt';

if (is_file($sfile))
{
	$fp = fopen($nfile,'w');
	fwrite($fp,$name);
	fclose($fp);
	$fp = fopen($sfile,'w');
	fwrite($fp,trim(stripslashes($switch_code)));
	fclose($fp);
	@chmod($nfile,0707);
	@chmod($sfile,0707);
}
getLink('reload','parent.','수정 되었습니다.','');
?>