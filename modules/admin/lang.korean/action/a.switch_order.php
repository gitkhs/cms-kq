<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$_switchset = array('start','top','head','foot','end');

$_ufile = $g['path_var'].'switch.var.php';
$fp = fopen($_ufile,'w');
fwrite($fp, "<?php\n");

foreach ($_switchset as $_key)
{
	if (!is_array(${'switchmembers_'.$_key}))
	{
		fwrite($fp, "\$d['switch']['".$_key."'][] = \"\";\n");
	}
	else {
		foreach (${'switchmembers_'.$_key} as $_val)
		{
			fwrite($fp, "\$d['switch']['".$_key."'][] = \"".trim($_val)."\";\n");
		}
	}
}
fwrite($fp, "?>");
fclose($fp);
@chmod($_ufile,0707);

getLink('reload','parent.','적용되었습니다.','');
?>