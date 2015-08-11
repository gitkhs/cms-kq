<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$folder = './'.str_replace('./','',$folder);
if(!is_dir($folder.$newfolder))
{
	mkdir($folder.$newfolder,0707);
	@chmod($folder.$newfolder,0707);
}
getLink($g['s'].'/?r='.$r.'&m=admin&module='.$m.'&front=main&pwd='.$folder.($pwd?'&fileupload=Y':'&folderadd=Y').'&iframe='.$iframe,'parent.',$alert,$history);
?>