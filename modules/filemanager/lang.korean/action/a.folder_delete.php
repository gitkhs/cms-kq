<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$folder = './'.str_replace('./','',$folder);
include_once $g['path_core'].'function/dir.func.php';

DirDelete($folder);

$pwdexp = explode('/',$folder);
$lastpwd = $pwdexp[count($pwdexp)-2];



if ($lastpwd == '' || $lastpwd == '.')
{
	getLink($g['s'].'/?r='.$r.'&m=admin&module='.$m.'&front=main&iframe='.$iframe,'','','');
}
else {
	$backpwd = urlencode(str_replace('/'.$lastpwd.'/','',$folder).'/');
	getLink($g['s'].'/?r='.$r.'&m=admin&module='.$m.'&front=main&pwd='.$backpwd.'&iframe='.$iframe,'','','');
}
?>