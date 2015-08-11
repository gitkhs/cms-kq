<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

foreach ($bookmark_pages as $val)
{
	getDbDelete($table['s_admpage'],'uid='.$val.' and memberuid='.$my['uid']);
}

getLink('reload','parent.','','');
?>