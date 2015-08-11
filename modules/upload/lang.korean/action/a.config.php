<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);
$ftp_port = $ftp_port ? trim($ftp_port) : '21';
$_tmpdfile = $g['dir_module'].'var/var.php';
$fp = fopen($_tmpdfile,'w');
fwrite($fp, "<?php\n");
fwrite($fp, "\$d['upload']['theme'] = \"".$theme."\";\n");
fwrite($fp, "\$d['upload']['maxsize_file'] = \"".$maxsize_file."\";\n");
fwrite($fp, "\$d['upload']['maxnum_file'] = \"".$maxnum_file."\";\n");
fwrite($fp, "\$d['upload']['maxsize_img'] = \"".$maxsize_img."\";\n");
fwrite($fp, "\$d['upload']['maxnum_img'] = \"".$maxnum_img."\";\n");
fwrite($fp, "\$d['upload']['name_file'] = \"".$name_file."\";\n");
fwrite($fp, "\$d['upload']['name_img'] = \"".$name_img."\";\n");
fwrite($fp, "\$d['upload']['ext_file'] = \"".$ext_file."\";\n");
fwrite($fp, "\$d['upload']['ext_img'] = \"".$ext_img."\";\n");
fwrite($fp, "\$d['upload']['ext_cut'] = \"".$ext_cut."\";\n");
fwrite($fp, "\$d['upload']['width_img'] = \"".$width_img."\";\n");
fwrite($fp, "\$d['upload']['use_classicup'] = \"".$use_classicup."\";\n");
fwrite($fp, "\$d['upload']['use_fileserver'] = \"".$use_fileserver."\";\n");
fwrite($fp, "\$d['upload']['ftp_host'] = \"".trim($ftp_host)."\";\n");
fwrite($fp, "\$d['upload']['ftp_port'] = \"".$ftp_port."\";\n");
fwrite($fp, "\$d['upload']['ftp_user'] = \"".trim($ftp_user)."\";\n");
fwrite($fp, "\$d['upload']['ftp_pasv'] = \"".$ftp_pasv."\";\n");
fwrite($fp, "\$d['upload']['ftp_pass'] = \"".trim($ftp_pass)."\";\n");
fwrite($fp, "\$d['upload']['ftp_folder'] = \"".trim($ftp_folder)."\";\n");
fwrite($fp, "\$d['upload']['ftp_urlpath'] = \"".trim($ftp_urlpath)."\";\n");
fwrite($fp, "?>");
fclose($fp);
@chmod($_tmpdfile,0707);

getLink($g['s'].'/?r='.$r.'&m=admin&module='.$m.'&front=fserver&xmod='.$xmod,'parent.',!$xmod?'갱신되었습니다.':'','');
?>