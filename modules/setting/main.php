<?php
if(!defined('__KIMS__')) exit;
if(is_file($g['path_layout'].'_setting.php'))	include_once $g['path_layout'].'_setting.php';

$system = 'Y';			// 시스템, 사이드 사용여부
//$g['window_full'] = '';	// 전체 화면 사용여부 (min:작은사이즈)
//$iframe = 'Y';			// 컨텐츠 내용만 사용

if($my['level'] < $admin[$mod])	$mod = '_permcheck';

$g['dir_module_skin'] = $g['dir_module'].'theme/';
$g['url_module_skin'] = $g['url_module'].'/theme';
$g['img_module_skin'] = $g['url_module_skin'].'/images';

$g['dir_module_mode'] = $g['dir_module_skin'].$mod;
$g['url_module_mode'] = $g['url_module_skin'].'/'.$mod;

$g['main'] = $g['dir_module_mode'].'.php';
?>