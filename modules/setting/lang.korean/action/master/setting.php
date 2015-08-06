<?
	if($side==1)		$side = '';
	else if($side==2)	$side = 'left';
	else if($side==3)	$side = 'right';
	
//	$option = "";
//	for($i=0;$i<sizeof($opt);$i++)
//		$option .= "|{$opt[$i]}";
//	$option = substr($option,1);

	$gfile= $g['path_layout'].'_config.php';
	$fp = fopen($gfile,'w');
	fwrite($fp, "<?php\n");
	fwrite($fp, "\$d['config']['site_open'] = \"".$site_open."\";\n");
	fwrite($fp, "\$d['config']['site_intro'] = \"".$site_intro."\";\n");
	fwrite($fp, "\$d['config']['site_member'] = \"".$site_member."\";\n");
	fwrite($fp, "\$d['config']['site_search'] = \"".$site_search."\";\n");
	fwrite($fp, "\$d['config']['site_theme'] = \"".$site_theme."\";\n");
	fwrite($fp, "\$d['config']['site_theme_mobile'] = \"".$site_theme_mobile."\";\n");
	fwrite($fp, "\$d['config']['banner_top_use'] = \"".$banner_top_use."\";\n");
	fwrite($fp, "\$d['config']['side_position'] = \"".$side_position."\";\n");
	fwrite($fp, "\$d['config']['side_loginbox'] = \"".$side_loginbox."\";\n");
	fwrite($fp, "\$d['config']['side_bbshot'] = \"".$side_bbshot."\";\n");
	fwrite($fp, "\$d['config']['facebook_use'] = \"".$facebook_use."\";\n");
	fwrite($fp, "\$d['config']['facebook_appid'] = \"".$facebook_appid."\";\n");
	fwrite($fp, "?>");
	fclose($fp);
	@chmod($gfile,0707);
	
	//getLink('','','----'.$site_title,'');
	//getDbUpdate($table['mInstall'],"layout={$lUid}, side='{$side}', `option`='{$option}'","`set`=1");
	getDbUpdate($table['s_site'], "name='{$site_title}', title='{$site_title}', theme='{$site_theme}'", "`id`='{$r}'");

	getLink('reload','parent.','적용되었습니다.','');
?>