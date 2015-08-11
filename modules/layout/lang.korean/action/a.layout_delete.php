<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

if ($imgfile)
{
	unlink($g['path_layout'].$layout.'/image/'.$imgfile);
	getLink($g['s'].'/?r='.$r.'&m=admin&module='.$m.'&front=main&layout='.$layout.'&type=image','parent.','','');
}
else if ($killlayout)
{
	include_once $g['path_core'].'function/dir.func.php';
	DirDelete($g['path_layout'].$killlayout);
	getLink($g['s'].'/?r='.$r.'&m=admin&module='.$m.'&front=main','parent.','','');
}
else {
	if ($sublayout != 'main.php')
	{
		unlink($g['path_layout'].$layout.'/'.$sublayout);
		@unlink($g['path_layout'].$layout.'/widget/'.$sublayout);
	}
	getLink($g['s'].'/?r='.$r.'&m=admin&module='.$m.'&front=main&layout='.$layout.'&type='.$type,'parent.','','');
}
?>