<?php
if(!defined('__KIMS__')) exit;

	if(!$id) {
		getLink('','','세션에 문제가 있습니다. 다시 시도해 주세요.','-1');
	}

	$birth	= explode('/',$birthday);
	$sex	= $gender=='male' ? 1 : 2;

	$M1 = getDbData($table['s_mbrdata'],"email='{$email}'",'*');
	$M	= getUidData($table['s_mbrid'],$M1['memberuid']);
	
	if(!$M['uid']) {
		$fid	= sprintf("f%x", time());

		getDbInsert($table['s_mbrid'],'site,id,pw',"'{$s}','{$fid}',''");
		$memberuid	= getDbCnt($table['s_mbrid'],'max(uid)','');

		$_QKEY = "memberuid,site,auth,sosok,level,comp,admin,adm_view,";
		$_QKEY.= "email,name,nic,grade,photo,home,sex,birth1,birth2,birthtype,tel1,tel2,zip,";
		$_QKEY.= "addr0,addr1,addr2,job,marr1,marr2,sms,mailing,smail,point,usepoint,money,cash,num_login,pw_q,pw_a,now_log,last_log,last_pw,is_paper,d_regis,tmpcode,sns,addfield";
		$_QVAL = "'{$memberuid}','{$s}','1','1','1','0','0','',";
		$_QVAL.= "'{$email}','{$name}','{$name}','','','','{$sex}','{$birth[2]}','{$birth[0]}{$birth[1]}','0','','','',";
		$_QVAL.= "'','','','','0','0','0','1','0','".$d['member']['join_point']."','0','0','0','1','','','1','".$date['totime']."','".$date['totime']."','0','".$date['totime']."','','{$link}',''";
		getDbInsert($table['s_mbrdata'],$_QKEY,$_QVAL);
		getDbUpdate($table['s_mbrlevel'],'num=num+1','uid=1');
		getDbUpdate($table['s_mbrgroup'],'num=num+1','uid=1');
		getDbUpdate($table['s_numinfo'],'login=login+1,mbrjoin=mbrjoin+1',"date='".$date['today']."' and site=".$s);
		if($d['member']['join_point']) getDbInsert($table['s_point'],'my_mbruid,by_mbruid,price,content,d_regis',"'$memberuid','0','".$d['member']['join_point']."','".$d['member']['join_pointmsg']."','".$date['totime']."'");
//		getDbInsert($table['s_mbrsns'],'memberuid,sf',"'".$memberuid."','".$_SESSION[$f_mbrid]."'");

		$M1 = getDbData($table['s_mbrdata'],"email='{$email}'",'*');
		$M	= getUidData($table['s_mbrid'],$M1['memberuid']);
	}
	
	$_SESSION['sns_login'] = 'f';
	$_SESSION['mbr_uid'] = $M['uid'];
	$_SESSION['mbr_pw']  = $M['pw'];

	if($_SESSION['appmode']) {
		getLink($g['s'].'/?m=setting&mod=app','parent.','');
	}
	if($g['mobile']) {
		$referer = $referer ? urldecode($referer) : $_SERVER['HTTP_REFERER'];
		getLink($referer,'','','close');
	}
	else {
		getLink('reload','parent.','','');
	}
?>