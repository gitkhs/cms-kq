<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);


$fdset = array('themepc','thememobile','autoclose','version','hidepannel','pannellink','cache_flag','http_port','ssl_type','ssl_port','ssl_menu','ssl_page','ssl_bbs','ssl_module','secu_iframe','secu_script','secu_style','secu_flash','secu_domain');

$_tmpdfile = $g['dir_module'].'var/var.system.php';
$fp = fopen($_tmpdfile,'w');
fwrite($fp, "<?php\n");
foreach ($fdset as $val)
{
	fwrite($fp, "\$d['admin']['".$val."'] = \"".trim(${$val})."\";\n");
}
fwrite($fp, "?>");
fclose($fp);
@chmod($_tmpdfile,0707);


getLink('reload','parent.','','');
?>