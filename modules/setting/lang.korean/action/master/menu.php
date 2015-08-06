<?
// 메뉴 등록 수정
if($actid == "regis"){
	//$joint = $joint ? $joint : "{$g['s']}/?r={$r}&m=home&mod=standard";
	$joint = trim(str_replace('&amp;','&',$joint));

	if (!$redirect&&(strstr($joint,'&c=')||strstr($joint,'?c=')))
	{
		getLink('','','연결주소에 사용할 수 없는 파라미터가 있습니다.','');
	}
	if(!$redirect&&$menutype==1)
	{
		include_once $g['path_core'].'function/menu.func.php';
	}

	if ($cat && !$vtype){
		$R = getUidData($table['s_menu'],$cat);
		$imghead = $R['imghead'];
		$imgfoot = $R['imgfoot'];
		$imgset = array('head','foot');

		if(!$redirect&&$menutype==1&&strstr($joint,'cync=Y'))
		{
			$ctarr = getMenuCodeToPath($table['s_menu'],$R['uid'],0);
			$catcode = '';
			$ctnum = count($ctarr);
			for ($i = 0; $i < $ctnum; $i++) $catcode .= $ctarr[$i]['id'].'/';
			$c = substr($catcode,0,strlen($catcode)-1);
			$joint = str_replace('cync=Y','cync=['.$m.'][c'.$R['uid'].'][,,,][][][c:'.$c.']',$joint);
		}

		$QVAL = "menutype='$menutype',mobile='$mobile',app='$app',hidden='$hidden',reject='$reject',name='$name',target='$target',";
		$QVAL.= "redirect='$redirect',joint='$joint',perm_g='$perm_g',perm_l='$perm_l',";
		$QVAL.= "layout='$layout',imghead='$imghead',imgfoot='$imgfoot',puthead='$puthead',putfoot='$putfoot',addinfo='$addinfo'";
		getDbUpdate($table['s_menu'],$QVAL,'uid='.$cat);

		if ($subcopy == 1)
		{
			include_once $g['path_core'].'function/menu.func.php';
			$subQue = getMenuCodeToSql($table['s_menu'],$cat,'uid');
			if ($subQue)
			{
				getDbUpdate($table['s_menu'],"hidden='".$hidden."',reject='".$reject."',perm_g='".$perm_g."',perm_l='".$perm_l."',layout='".$layout."'","uid <> ".$cat." and (".$subQue.")");
			}
		}
		
		$gfile	= $g['dir_module'].'var/menu/var.menu'.$R['id'].'.php';
		$fp = fopen($gfile,'w');
		fwrite($fp, "<?php\n");
		fwrite($fp, "\$d['setmenu']['topslide'] = \"".$topslide."\";\n");
		fwrite($fp, "\$d['setmenu']['topslide_wide'] = \"".$topslide_wide."\";\n");
		fwrite($fp, "\$d['setmenu']['topslide_sub'] = \"".$topslide_sub."\";\n");
		fwrite($fp, "\$d['setmenu']['topfixed'] = \"".$topfixed."\";\n");
		fwrite($fp, "\$d['setmenu']['topfixed_wide'] = \"".$topfixed_wide."\";\n");
		fwrite($fp, "\$d['setmenu']['topfixed_sub'] = \"".$topfixed_sub."\";\n");
		fwrite($fp, "\$d['setmenu']['btmfixed'] = \"".$btmfixed."\";\n");
		fwrite($fp, "\$d['setmenu']['btmfixed_wide'] = \"".$btmfixed_wide."\";\n");
		fwrite($fp, "\$d['setmenu']['btmfixed_sub'] = \"".$btmfixed_sub."\";\n");
		fwrite($fp, "?>");
		fclose($fp);
		@chmod($gfile,0707);
		
		getLink('reload','parent.','수정 되었습니다.','');
	}
	else{
		$MAXC = getDbCnt($table['s_menu'],'max(gid)','depth='.($depth+1).' and parent='.$parent);
		$sarr = explode(',' , trim($name));
		$slen = count($sarr);
		
		for ($i = 0 ; $i < $slen; $i++)
		{
			if (!$sarr[$i]) continue;

			$gid	= $MAXC+1+$i;
			$xdepth	= $depth+1;
			$xname	= trim($sarr[$i]);
			$xnarr	= explode('=',$xname);

			$QKEY = "gid,site,isson,parent,depth,id,menutype,mobile,app,hidden,reject,name,target,redirect,joint,perm_g,perm_l,layout,imghead,imgfoot,puthead,putfoot,num,d_last,addinfo";
			$QVAL = "'$gid','$account','0','$parent','$xdepth','$xnarr[1]','$menutype','$mobile','$app','$hidden','$reject','$xnarr[0]','$target','$redirect','$joint','$perm_g','$perm_l','$layout','','','','','0','',''";

			getDbInsert($table['s_menu'],$QKEY,$QVAL);
			$lastmenu = getDbCnt($table['s_menu'],'max(uid)','');

			if(!$redirect&&$menutype==1&&strstr($joint,'cync=Y'))
			{
				$ctarr = getMenuCodeToPath($table['s_menu'],$lastmenu,0);
				$catcode = '';
				$ctnum = count($ctarr);
				for ($j = 0; $j < $ctnum; $j++) $catcode .= $ctarr[$j]['id'].'/';
				$c = substr($catcode,0,strlen($catcode)-1);
				$joint = str_replace('cync=Y','cync=['.$m.'][c'.$lastmenu.'][,,,][][][c:'.$c.']',$joint);
			}
			if (!$xnarr[1])
			{
				getDbUpdate($table['s_menu'],"id='".$lastmenu."',joint='".$joint."'",'uid='.$lastmenu);
			}
			else {
				$ISMCODE = getDbData($table['s_menu'],"uid<> ".$lastmenu." and id='".$xnarr[1]."' and site=".$s,'*');
				if ($ISMCODE['uid'])
				{
					getDbUpdate($table['s_menu'],"id='".$lastmenu."',joint='".$joint."'",'uid='.$lastmenu);
				}
			}
		}
		if ($parent)
		{
			getDbUpdate($table['s_menu'],'isson=1','uid='.$parent);
		}
		db_query("OPTIMIZE TABLE ".$table['s_menu'],$DB_CONNECT); 
		
		if ($backc == 'user')
		{
			getLink($g['s'].'/?r='.$r.'&m='.$m.'&mod='.$mod.'&div='.$div.($parent?'&cat='.$parent:''),'parent.','적용되었습니다.','');
		}
		else {
			getLink($g['s'].'/?r='.$r.'&m='.$m.'&mod='.$mod.'&div='.$div.($parent?'&cat='.$parent:'').'&account='.$account,'parent.','적용되었습니다.','');
		}
	}
}
// 메뉴 삭제
else if($actid == "delete"){
	if (!$cat) getLink('./?m='.$m.'&mod='.$mod.'&front=menu','parent.','','');

	include_once $g['path_core'].'function/menu.func.php';
	$subQue = getMenuCodeToSql($table['s_menu'],$cat,'uid');
	if ($subQue)
	{
		$DAT = getDbSelect($table['s_menu'],$subQue,'*');
		while($R=db_fetch_array($DAT))
		{
			getDbDelete($table['s_menu'],'uid='.$R['uid']);
			getDbDelete($table['s_seo'],'rel=1 and parent='.$R['uid']);
		}
		if ($parent)
		{
			if (!getDbRows($table['s_menu'],'parent='.$parent))
			{
				getDbUpdate($table['s_menu'],'isson=0','uid='.$parent);
			}
		}
		db_query("OPTIMIZE TABLE ".$table['s_menu'],$DB_CONNECT); 
	}
	if ($backc == 'user')
	{
		getLink($g['s'].'/?r='.$r.'&m='.$m.'&mod='.$mod.'&div='.$div.'&cat='.$parent,'parent.','삭제 되었습니다.','');
	}
	else {
		getLink($g['s'].'/?r='.$r.'&m='.$m.'&mod='.$mod.'&div='.$div.'&account='.$account.'&cat='.$parent,'parent.','삭제 되었습니다.','');
	}
}
?>