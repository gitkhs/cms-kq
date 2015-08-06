<?php
if(!defined('__KIMS__')) exit;

include_once $g['path_module'].$m.'/var/var.php';

if($cync)
{
	$_SESSION[$m.'cync'] = $cync;
}
if (!$_SESSION[$m.'cync'])
{
	getLink(RW(0),'','동기화코드가 지정되지 않았습니다.','');
}

$cyncArr= getArrayString($_SESSION[$m.'cync']);

$mod	= 'main';
$sort	= $sort ? $sort : 'uid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 200 ? $recnum : $d['trackback']['recnum'];

$cmentque = "parent='".$cyncArr['data'][0].$cyncArr['data'][1]."' and type=1";

$RCD = array();

$TCD = getDbArray($table['s_trackback'],$cmentque,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table['s_trackback'],$cmentque);
$TPG = getTotalPage($NUM,$recnum);
while($_R = db_fetch_array($TCD)) $RCD[] = $_R;


if ($g['mobile']&&$_SESSION['pcmode']!='Y')
{
	$B['skin'] = $d['trackback']['skin_mobile'];
}
else {
	$B['skin'] = $skin ? $skin : $d['trackback']['skin_main'];
}

$g['track_reset']	= $c?$g['s'].'/?r='.$r.'&amp;c='.$c:getLinkFilter($g['s'].'/?r='.$r.'&amp;m='.$m,array('skin','iframe'));
$g['track_list']	= $g['track_reset'].getLinkFilter('',array('p','sort','orderby','recnum','where','keyword'));
$g['track_action']	= $g['track_list'].'&amp;a=';
$g['track_delete']	= $g['track_action'].'delete&amp;uid=';

$g['dir_module_skin'] = $g['dir_module'].'theme/'.$B['skin'].'/';
$g['url_module_skin'] = $g['url_module'].'/theme/'.$B['skin'];
$g['img_module_skin'] = $g['url_module_skin'].'/image';

$g['dir_module_mode'] = $g['dir_module_skin'].$mod;
$g['url_module_mode'] = $g['url_module_skin'].'/'.$mod;

$g['main'] = $g['dir_module_mode'].'.php';
?>