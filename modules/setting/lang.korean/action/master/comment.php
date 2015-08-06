<?
//시발,씨발,개새끼,개세끼,개쉐이,지랄,니미,좆,좃,조낸,죽어,쪽바리,짱개,떼놈
	$badword = trim($badword);
	$badword = str_replace("\r\n","",$badword);
	$badword = str_replace("\n","",$badword);


	$fdset = array('skin_main','skin_mobile','badword','badword_action','badword_escape','singo_del','singo_del_num','singo_del_act','onelinedel','perm_write','perm_upfile','perm_photo','edit_height','edit_tool','use_hidden','recnum','use_subject','give_point','give_opoint','snsconnect','orderby1','orderby2');

	$gfile= $g['path_module'].'comment/var/var.php';
	
	$fp = fopen($gfile,'w');
	fwrite($fp, "<?php\n");
	foreach ($fdset as $val)
	{
		fwrite($fp, "\$d['comment']['".$val."'] = \"".trim(${$val})."\";\n");
	}
	fwrite($fp, "?>");
	fclose($fp);
	@chmod($gfile,0707);

	getLink('reload','parent.','적용되었습니다.','');
?>