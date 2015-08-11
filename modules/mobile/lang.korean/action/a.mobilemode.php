<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);
if ($value=='X' && $_SESSION['pcmode'] != 'E') getLink('','','PC모드 상태입니다.','');
$_SESSION['pcmode'] = $value;

if ($value=='X') getLink('','','PC모드로 전환되었습니다.','');
else exit;
?>