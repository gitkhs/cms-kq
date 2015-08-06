<?php
if(!defined('__KIMS__')) exit;

$_mod	= $_GET['mod'];
$where	= $where ? $where : 'main';

if ($g['mobile'] && $_SESSION['pcmode'] != 'Y')
{
	$_front = '_mobile';
}
else {
	$_front = '_pc';
}

include_once $g['dir_module'].'var/var.search.php';

$_HM['layout'] = $_HM['layout'] ? $_HM['layout'] : $d['search']['layout'];

$g['dir_module_skin'] = $g['dir_module'].'lang.'.$_HS['lang'].'/pages/'.$_front.'/';
$g['url_module_skin'] = $g['url_module'].'/lang.'.$_HS['lang'].'/pages/'.$_front;
$g['img_module_skin'] = $g['url_module_skin'].'/image';

$g['dir_module_mode'] = $g['dir_module_skin'].$where;
$g['url_module_mode'] = $g['url_module_skin'].'/'.$where;

$g['url_reset']	= $g['s'].'/?r='.$r.'&amp;'.($_mod ? 'mod='.$_mod : 'm='.$m).($keyword?'&amp;keyword='.urlencode($keyword):'').'&amp;where=';

if($d['search']['sosokmenu'])
{
	$_CA = explode('/',$d['search']['sosokmenu']);
	$g['location'] = '<a href="'.RW(0).'">HOME</a>';
	$_tmp['count'] = count($_CA);
	$_tmp['split_id'] = '';
	for ($_i = 0; $_i < $_tmp['count']; $_i++)
	{
		$_tmp['location'] = getDbData($table['s_menu'],"id='".$_CA[$_i]."'",'*');
		$_tmp['split_id'].= ($_i?'/':'').$_tmp['location']['id'];
		$g['location']   .= ' &gt; <a href="'.RW('c='.$_tmp['split_id']).'">'.$_tmp['location']['name'].'</a>';
	}
	$g['location']   .= ' &gt; <a href="'.RW('mod='.$_HP['id']).'">'.$_HP['name'].'</a>';
}

$g['main'] = $g['dir_module_mode'].'.php';
?>