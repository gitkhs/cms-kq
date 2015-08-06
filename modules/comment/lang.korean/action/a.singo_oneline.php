<?php
if(!defined('__KIMS__')) exit;

if (!$my['uid']) getLink('','','로그인해 주세요.','');

$R = getUidData($table['s_oneline'],$uid);
if (!$R['uid']) getLink('','','존재하지 않는 한줄의견입니다.','');

if (!strstr($_SESSION['module_'.$m.'_osingo'],'['.$R['uid'].']'))
{
	getDbUpdate($table[$m.'oneline'],'singo=singo+1','uid='.$R['uid']);
	$_SESSION['module_'.$m.'_osingo'] .= '['.$R['uid'].']';
	getLink('','','신고처리 되었습니다.','');
}
else {
	getLink('','','이미 신고하신 한줄의견입니다.','');
}
?>