<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$_sw1 = $g['path_switch'].$switch_folder;
$alert = '정상적인 접근이 아닙니다.';

if (is_file($_sw1.'/'.$switch.'/main.php'))
{
	if (strstr($switch,'@'))
	{
		$xswitch = str_replace('@','',$switch);
		rename($_sw1.'/'.$switch,$_sw1.'/'.$xswitch);
		$alert = '['.getFolderName($_sw1.'/'.$xswitch).'] 스위치가 켜졌습니다.';
	}
	else {
		$xswitch = $switch.'@';
		rename($_sw1.'/'.$switch,$_sw1.'/'.$xswitch);
		$alert = '['.getFolderName($_sw1.'/'.$xswitch).'] 스위치가 꺼졌습니다.';
	}
}

$_switchset = array('start','top','head','foot','end');

$_ufile = $g['path_var'].'switch.var.php';
$fp = fopen($_ufile,'w');
fwrite($fp, "<?php\n");

foreach ($_switchset as $_key)
{
	foreach ($d['switch'][$_key] as $_val)
	{
		$_val = $_key==$switch_folder&&$_val==$switch ? $xswitch : $_val;
		fwrite($fp, "\$d['switch']['".$_key."'][] = \"".trim($_val)."\";\n");
	}
}

fwrite($fp, "?>");
fclose($fp);
@chmod($_ufile,0707);

if ($reload == 'Y')
{
	getLink('reload','parent.','','');
}
else {
	getLink($g['s'].'/?r='.$r.'&m=admin&module=admin&front=switch','parent.',$alert,'');
}
?>