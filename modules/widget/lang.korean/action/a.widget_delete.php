<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

if ($pwd && substr($pwd,0,10) == $g['r'].'/widgets/' && strlen($pwd) > 10)
{
	include_once $g['path_core'].'function/dir.func.php';
	DirDelete($pwd);

	$pwd_exp = explode('/',$pwd);
	$pwd_len = count($pwd_exp);
	$pwd_str = '';

	for($i = 0; $i < $pwd_len-2; $i++)
	{
		$pwd_str .= $pwd_exp[$i].'/';
	}
	getLink($g['s'].'/?r='.$r.'&m=admin&module='.$m.'&pwd='.$pwd_str.'&front=main','parent.','','');
}
else {
	getLink('','','','');
}
?>