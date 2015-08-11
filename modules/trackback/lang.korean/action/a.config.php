<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$badword = trim($badword);
$badword = str_replace("\r\n","",$badword);
$badword = str_replace("\n","",$badword);


$fdset = array('skin_main','skin_mobile','perm_write','recnum');

$gfile= $g['dir_module'].'var/var.php';
$fp = fopen($gfile,'w');
fwrite($fp, "<?php\n");
foreach ($fdset as $val)
{
	fwrite($fp, "\$d['trackback']['".$val."'] = \"".trim(${$val})."\";\n");
}
fwrite($fp, "?>");
fclose($fp);
@chmod($gfile,0707);



getLink('reload','parent.','','');
?>