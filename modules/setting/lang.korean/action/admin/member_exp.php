<?
	if($actid == 'memberadd') {
		if(!$mbradd_level) {
			getLink('','','회원 등급을 선택하세요.','');
		}
		if(!$mbradd_id) {
			getLink('','','회원 아이디를 입력하세요.','');
		}
		if(!$mbradd_name) {
			getLink('','','회원 이름을 입력하세요.','');
		}
		$R	= getDbData($table['s_mbrid'], "id='{$mbradd_id}'", "*");
		if($R['uid']) {
			getLink('','','이미 등록된 회원 아이디 입니다.','');
		}

		// 회원등록
		$pw		= md5('1111');
		$sKey	= "site, id, pw";
		$sVal	= "'{$_HS['uid']}', '{$mbradd_id}', '{$pw}'";
		getDbInsert($table['s_mbrid'],$sKey,$sVal);

		$d_regis	= $date['totime'];
		$mbr	= getDbData($table['s_mbrid'],"id='{$mbradd_id}'", "*");
		$sKey	= "memberuid,site,auth,sosok,level,comp,admin,adm_view,email,name,nic,grade,photo,home,sex,birth1,birth2,birthtype,tel1,tel2,zip,addr0,addr1,addr2,job,marr1,marr2,sms,mailing,smail,point,usepoint,money,cash,num_login,pw_q,pw_a,now_log,last_log,last_pw,is_paper,d_regis,tmpcode,sns,addfield";
		$sVal	= "'{$mbr['uid']}','{$_HS['uid']}','1','1','{$mbradd_level}','0','0','','','{$mbradd_name}','{$mbradd_name}','','','','0','0','000','0','','','','','','','','0','000','1','1','0','0','0','0','0','0','','','','','','0','{$d_regis}','','',''";
		getDbInsert($table['s_mbrdata'],$sKey,$sVal);

		getLink('reload','parent.','회원 등록을 완료 했습니다.','');
	}

	getLink('reload','parent.','잘못 전달된 명령입니다. 관리자에 문의하세요.','');
?>