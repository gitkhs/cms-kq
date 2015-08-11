<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

unlink($g['path_tmp'].'backup/'.str_replace('/','_',str_replace('./','',$folder).getUTFtoKR($oldfile)).'.bak');

getLink('reload','parent.',$alert,$history);
?>