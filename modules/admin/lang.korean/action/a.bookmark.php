<?php
if(!defined('__KIMS__')) exit;


checkAdmin(0);

$memberuid	= $my['uid'];
$url		= $g['s'].'/?r='.$r.'&m='.$m.'&module='.$_addmodule.'&front='.$_addfront;

if(getDbRows($table['s_admpage'],'memberuid='.$memberuid." and url='".$url."'"))
{
	getLink('','','이미 등록된 페이지입니다.','');
}

$maxgid = getDbCnt($table['s_admpage'],'max(gid)','memberuid='.$memberuid);
$MD = getDbData($table['s_module'],"id='".$_addmodule."'",'*');

include_once $g['path_module'].$_addmodule.'/lang.'.$_HS['lang'].'/admin/_pc/var/var.menu.php';
$gid = $maxgid + 1;
$name= $MD['name'].'&gt;'.$d['amenu'][$_addfront];

getDbInsert($table['s_admpage'],'memberuid,gid,name,url',"'$memberuid','$gid','$name','$url'");

getLink('reload','parent.','','');
?>