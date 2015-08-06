<?
	if(!$mbrmembers)	getLink('','','작업 할 회원을 선택해 주세요','');

	$uids = "";
	for($i=0;$i<count($mbrmembers);$i++)
		$uids .= ','.$mbrmembers[$i];
	$uids = substr($uids,1);

	if($actid == 'auth'){
		if(!$adm_auth && !$adm_level)	getLink('','','적용 할 회원인증여부 또는 등급을 선택해 주세요','');
		$qSet = "tmpcode=''";
		if($adm_auth)		$qSet .= ", auth='{$adm_auth}'";
		if($adm_level)		$qSet .= ", level='{$adm_level}'";

		getDbUpdate($table['s_mbrdata'],$qSet,"memberuid in ({$uids})");
		getLink('reload','parent.','적용 되었습니다.','');
	}
	else if($actid == 'initpwd'){
		$pw	= md5('1111');
		getDbUpdate($table['s_mbrid'],"pw='{$pw}'","uid in ({$uids})");
		getLink('reload','parent.','비밀번호가 초기화 되었습니다.','');
	}
	else if($actid == 'point'){
		if(strpos($uids,','))	getLink('','','포인트 관리는 여러명 처리 할 수 없습니다.','');

		if(!$pointval)		getLink('','','적용할 포인트를 입력해 주세요.','');
		if(!$pointcon)		getLink('','','지급사유를 입력해 주세요..','');
		if(!$pointknd)		getLink('','','포인트 지급/차감 내용을 선택해 주세요.','');

		$pointval	= str_replace(',','',$pointval);
		$mbrInfo	= getDbData($table['s_mbrdata'],"memberuid='{$uids}'","*");
		if($pointknd==2 && $mbrInfo['point'] < $pointval)	getLink('','','차감 포인트가 보유 포인트보다 큽니다.','');
		$pointval	= $pointknd==1 ? $pointval : $pointval*-1;
		$d_regis	= date('YmdHis');

		$qKey	= "my_mbruid, by_mbruid, price, content, d_regis";
		$qVal	= "'{$uids}', '{$my['uid']}', '{$pointval}', '{$pointcon}', '{$d_regis}'";
		getDbInsert($table['s_point'],$qKey,$qVal);

		if($pointknd==1){
			getDbUpdate($table['s_mbrdata'],"point = point + {$pointval}","memberuid={$uids}");
		}
		else if($pointknd==2){
			getDbUpdate($table['s_mbrdata'],"point = point + {$pointval}, usepoint = usepoint - {$pointval}","memberuid={$uids}");
		}

		getLink('reload','parent.','포인트 지급/차감 처리 되었습니다.','');
	}

	getLink('reload','parent.','잘못 전달된 명령입니다. 관리자에 문의하세요.','');
?>