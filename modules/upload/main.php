<?php
if(!defined('__KIMS__')) exit;

if (!$mod) getLink(RW(0),'','','');

include_once $g['dir_module'].'var/var.php';

$iframe = 'Y';

$g['dir_module_skin'] = $g['dir_module'].'theme/'.$d['upload']['theme'].'/';
$g['url_module_skin'] = $g['url_module'].'/theme/'.$d['upload']['theme'];
$g['img_module_skin'] = $g['url_module_skin'].'/image';

$g['dir_module_mode'] = $g['dir_module_skin'].$mod;
$g['url_module_mode'] = $g['url_module_skin'].'/'.$mod;

$g['main'] = $g['dir_module_mode'].'.php';
?>