<?
	$_tmpdfile = $g['path_module'].'member/var/var.join.php';
	$fp = fopen($_tmpdfile,'w');
	fwrite($fp, "<?php\n");

	//회원가입
	fwrite($fp, "\$d['member']['join_enable'] = \"1\";\n");
	fwrite($fp, "\$d['member']['join_mobile'] = \"1\";\n");
	fwrite($fp, "\$d['member']['join_out'] = \"2\";\n");
	fwrite($fp, "\$d['member']['join_rejoin'] = \"1\";\n");
	fwrite($fp, "\$d['member']['join_auth'] = \"".$join_auth."\";\n");
	fwrite($fp, "\$d['member']['join_level'] = \"1\";\n");
	fwrite($fp, "\$d['member']['join_group'] = \"1\";\n");
	fwrite($fp, "\$d['member']['join_point'] = \"0\";\n");
	fwrite($fp, "\$d['member']['join_pointmsg'] = \"".$join_pointmsg."\";\n");
	fwrite($fp, "\$d['member']['join_cutid'] = \"".$join_cutid."\";\n");
	fwrite($fp, "\$d['member']['join_cutnic'] = \"".$join_cutnic."\";\n");
	fwrite($fp, "\$d['member']['join_email'] = \"\";\n");
	fwrite($fp, "\$d['member']['join_email_send'] = \"\";\n");

	//가입양식
	fwrite($fp, "\$d['member']['form_agree'] = \"".$form_agree."\";\n");
	fwrite($fp, "\$d['member']['form_jumin'] = \"".$form_jumin."\";\n");
	fwrite($fp, "\$d['member']['form_foreign'] = \"".$form_foreign."\";\n");
	fwrite($fp, "\$d['member']['form_comp'] = \"".$form_comp."\";\n");
	fwrite($fp, "\$d['member']['form_age'] = \"".$form_age."\";\n");
	fwrite($fp, "\$d['member']['form_qa'] = \"".$form_qa."\";\n");
	fwrite($fp, "\$d['member']['form_home'] = \"".$form_home."\";\n");
	fwrite($fp, "\$d['member']['form_tel1'] = \"".$form_tel1."\";\n");
	fwrite($fp, "\$d['member']['form_tel2'] = \"".$form_tel2."\";\n");
	fwrite($fp, "\$d['member']['form_job'] = \"".$form_job."\";\n");
	fwrite($fp, "\$d['member']['form_marr'] = \"".$form_marr."\";\n");
	fwrite($fp, "\$d['member']['form_addr'] = \"".$form_addr."\";\n");
	fwrite($fp, "\$d['member']['form_qa_p'] = \"".$form_qa_p."\";\n");
	fwrite($fp, "\$d['member']['form_home_p'] = \"".$form_home_p."\";\n");
	fwrite($fp, "\$d['member']['form_tel1_p'] = \"".$form_tel1_p."\";\n");
	fwrite($fp, "\$d['member']['form_tel2_p'] = \"".$form_tel2_p."\";\n");
	fwrite($fp, "\$d['member']['form_job_p'] = \"".$form_job_p."\";\n");
	fwrite($fp, "\$d['member']['form_marr_p'] = \"".$form_marr_p."\";\n");
	fwrite($fp, "\$d['member']['form_addr_p'] = \"".$form_addr_p."\";\n");
	fwrite($fp, "\$d['member']['form_nic'] = \"".$form_nic."\";\n");
	fwrite($fp, "\$d['member']['form_nic_p'] = \"".$form_nic_p."\";\n");
	fwrite($fp, "\$d['member']['form_birth'] = \"".$form_birth."\";\n");
	fwrite($fp, "\$d['member']['form_birth_p'] = \"".$form_birth_p."\";\n");
	fwrite($fp, "\$d['member']['form_sex'] = \"".$form_sex."\";\n");
	fwrite($fp, "\$d['member']['form_sex_p'] = \"".$form_sex_p."\";\n");

	//마이페이지
	fwrite($fp, "\$d['member']['mytab_post'] = \"1\";\n");
	fwrite($fp, "\$d['member']['mytab_comment'] = \"1\";\n");
	fwrite($fp, "\$d['member']['mytab_oneline'] = \"\";\n");
	fwrite($fp, "\$d['member']['mytab_simbol'] = \"1\";\n");
	fwrite($fp, "\$d['member']['mytab_scrap'] = \"1\";\n");
	fwrite($fp, "\$d['member']['mytab_friend'] = \"\";\n");
	fwrite($fp, "\$d['member']['mytab_paper'] = \"\";\n");
	fwrite($fp, "\$d['member']['mytab_point'] = \"1\";\n");
	fwrite($fp, "\$d['member']['mytab_log'] = \"1\";\n");
	fwrite($fp, "\$d['member']['mytab_info'] = \"1\";\n");
	fwrite($fp, "\$d['member']['mytab_pw'] = \"1\";\n");
	fwrite($fp, "\$d['member']['mytab_out'] = \"1\";\n");

	//로그인
	fwrite($fp, "\$d['member']['login_point'] = \"0\";\n");
	fwrite($fp, "\$d['member']['login_emailid'] = \"1\";\n");
	fwrite($fp, "\$d['member']['login_openid'] = \"1\";\n");
	fwrite($fp, "\$d['member']['login_ssl'] = \"1\";\n");

	fwrite($fp, "\$d['member']['layout_join'] = \"\";\n");
	fwrite($fp, "\$d['member']['layout_login'] = \"\";\n");
	fwrite($fp, "\$d['member']['layout_mypage'] = \"\";\n");
	fwrite($fp, "\$d['member']['sosokmenu'] = \"\";\n");

	//추가항목
	$mfile = $g['path_module'].'member/var/add_field.txt';
	if(!is_array($addFieldMembers)){
		$addFieldMembers = array();
	}

	$fp = fopen($mfile,'w');
	foreach($addFieldMembers as $val){
		fwrite($fp,$val.'|'.${'add_name_'.$val}.'|'.${'add_type_'.$val}.'|'.${'add_value_'.$val}.'|'.${'add_size_'.$val}.'|'.${'add_pilsu_'.$val}.'|'.${'add_hidden_'.$val}."\n");
	}

	if ($add_name){
		fwrite($fp,$date['totime'].'|'.$add_name.'|'.$add_type.'|'.$add_value.'|'.$add_size.'|'.$add_pilsu.'|'.$add_hidden."\n");
	}

	fclose($fp);
	@chmod($mfile,0707);

	// 회원등급 설정
	$arLevel	= explode(',',$level_val);

	$gfile= $g['dir_module'].'var/mbrlevel.php';
	$fp = fopen($gfile,'w');
	fwrite($fp, "<?php\n");
	for($i=0; $i<count($arLevel); $i++) {
		if($arLevel[$i] == '관리자')	continue;
		fwrite($fp, "\$levelset['".($i+1)."'] = \"".$arLevel[$i]."\";\n");
	}
	fwrite($fp, "\$levelset['18'] = \"관리자\";\n");
	fwrite($fp, "?>");
	fclose($fp);
	@chmod($gfile,0707);
	
	getLink('reload','parent.','적용되었습니다.','');
?>