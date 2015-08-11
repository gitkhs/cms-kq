<?php
if(!defined('__KIMS__')) exit;
if ($my['level'] < $admin['admin']) getLink('','','정상적인 접근이 아닙니다.','');

$gfile= $g['path_module'].'bbs/var/var.'.$bbsid.'.push.php';

$fp = fopen($gfile,'w');
fwrite($fp, "<?php\n");
fwrite($fp, "\$d['bbs']['email'] = \"".$email."\";\n");
fwrite($fp, "?>");
fclose($fp);
@chmod($gfile,0707);

getLink('reload','parent.','적용되었습니다.','');
?>