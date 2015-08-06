<?php
if(!defined('__KIMS__')) exit;

if (!$my['admin']) getLink('','','권한이 없습니다.','');

$R = getUidData($table['s_trackback'],$uid);
if (!$R['uid']) getLink(RW(0),'','','');

$cyncArr= getArrayString($R['cync']);


getDbDelete($table['s_trackback'],'uid='.$R['uid']);

if ($R['type']==1)
{
	getDbUpdate($table[$cyncArr['data'][0].'data'],'trackback=trackback-1','uid='.$cyncArr['data'][1]);
	getDbUpdate($table['s_numinfo'],'rcvtrack=rcvtrack-1',"date='".substr($R['d_regis'],0,8)."' and site=".$R['site']);
}
else {
	getDbUpdate($table['s_numinfo'],'sndtrack=sndtrack-1',"date='".substr($R['d_regis'],0,8)."' and site=".$R['site']);
}
getLink('reload','parent.','','');
?>