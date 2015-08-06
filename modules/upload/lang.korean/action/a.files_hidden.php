<?php
if(!defined('__KIMS__')) exit;

if (!$file_uid) exit;

$R = getUidData($table['s_upload'],$file_uid);
if (!$R['uid']) exit;
if (!$my['admin'] && (!$R['mbruid'] || $my['uid'] != $R['mbruid'])) exit;

getDbUpdate($table['s_upload'],'hidden='.($R['hidden']?0:1),'uid='.$R['uid']);
getLink($g['s'].'/?r='.$r.'&m='.$m.'&mod=list&gparam='.$gparam.'&code='.$code,'parent.','','');
?>