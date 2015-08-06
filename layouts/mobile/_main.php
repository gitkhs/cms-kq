<?php
function getLayoutLogo($layout)
{
	if ($layout['imglogo_use'])
	{
		return '<div class="imglogo"><a href="'.$GLOBALS['g']['s'].'/?r='.$GLOBALS['r'].'"><img src="'.$GLOBALS['g']['s'].'/layouts/'.$layout['dir'].'/_var/'.$layout['imglogo'].'" alt="" /></a></div>';
	}
	else {
		return '<h1><a id="_layout_title_color_" href="'.$GLOBALS['g']['s'].'/?r='.$GLOBALS['r'].'">'.$layout['title'].'</a></h1>';
	}
}
include $g['path_layout'].$d['layout']['dir'].'/_var/_var.php';
include $g['path_layout'].'_config.php';

if (isset($_layoutAction))
{
	include $g['path_layout'].$d['layout']['dir'].'/_action/a.'.$_layoutAction.'.php';
	exit;
}

$d['layout']['_is_ownmain'] = $d['layout']['mainType_layout']&&!$_themeConfig&&!$_themePage&&$_HP['id']=='main_mobile';
$d['layout']['_is_content'] = $d['layout']['mainType_rb']||$_themeConfig||$_themePage||$_HP['id']!='main_mobile';

if (isset($_themeConfig))
{
	if (!$my['admin']) getLink($g['s'].'/?r='.$r,'','권한이 없습니다.','');
	$g['main'] = $g['path_layout'].$d['layout']['dir'].'/_admin/main.php';

	$g['dir_module_mode'] = $g['path_layout'].$d['layout']['dir'].'/_admin/main';
	$g['url_module_mode'] = $g['s'].'/layouts/'.$d['layout']['dir'].'/_admin/main';
	$d['layout']['_twhite'] = false;
}
if (isset($_themePage))
{
	$g['main'] = $g['path_layout'].$d['layout']['dir'].'/_pages/'.$_themePage.'.php';
	if (strpos($_themePage,'jax/'))
	{
		include $g['main'];
		exit;
	}
	else {
		$g['dir_module_mode'] = $g['path_layout'].$d['layout']['dir'].'/_pages/'.$_themePage;
		$g['url_module_mode'] = $g['s'].'/layouts/'.$d['layout']['dir'].'/_pages/'.$_themePage;
	}
}
?>