<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$_tmpdfile = $g['dir_module'].'var/var.search.php';
$fp = fopen($_tmpdfile,'w');
fwrite($fp, "<?php\n");

fwrite($fp, "\$d['search']['s_bbs'] = \"".$s_bbs."\";\n");
fwrite($fp, "\$d['search']['s_comment'] = \"".$s_comment."\";\n");
fwrite($fp, "\$d['search']['s_image'] = \"".$s_image."\";\n");
fwrite($fp, "\$d['search']['s_upload'] = \"".$s_upload."\";\n");
fwrite($fp, "\$d['search']['s_search'] = \"".$s_search."\";\n");
fwrite($fp, "\$d['search']['s_num1'] = \"".$s_num1."\";\n");
fwrite($fp, "\$d['search']['s_num2'] = \"".$s_num2."\";\n");
fwrite($fp, "\$d['search']['s_term'] = \"".$s_term."\";\n");
fwrite($fp, "\$d['search']['layout'] = \"".$layout."\";\n");
fwrite($fp, "\$d['search']['sosokmenu'] = \"".$sosokmenu."\";\n");

fwrite($fp, "?>");
fclose($fp);
@chmod($_tmpdfile,0707);


$_tmpdfile = $g['dir_module'].'var/search.list.txt';
$fp = fopen($_tmpdfile,'w');
fwrite($fp,trim(stripslashes($s_searchlist)));
fclose($fp);
@chmod($_tmpdfile,0707);



getLink('reload','parent.','','');
?>