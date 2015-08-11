<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);


$folder = './'.str_replace('./','',$folder);

foreach($members as $val)
{
	unlink($folder.getUTFtoKR($val));
}

getLink('reload','parent.',$alert,$history);
?>