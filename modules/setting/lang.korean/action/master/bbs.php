<?
	$skin	= $skin ? $skin : '_pc/list01';
	$m_skin	= $m_skin ? $m_skin : '_mobile/list01';

// 게시판등록
if($actid == 'regis'){
	$id			= $id ? trim($id) : $bid;
	$name		= trim($name);
	$newtime	= $newtime ? $newtime : 24;

	if (!$name) getLink('','','게시판이름을 입력해 주세요.','');
	if (!$id) getLink('','','아이디를 입력해 주세요.','');
	include_once $flid.'.theme.php';
	
	$addinfo	= "";
	for($i=0;$i<count($addinfo0);$i++){
		$addinfo .= '|'.$addinfo0[$i].'#'.$addinfo1[$i].'#'.$addinfo2[$i].'#'.$addinfo3[$i].'#';
	}
	$addinfo	= substr($addinfo,1);

	if ($bid){
		$QVAL = "name='$name',category='$category',imghead='$imghead',imgfoot='$imgfoot',puthead='$puthead',putfoot='$putfoot',addinfo='$addinfo',writecode='$writecode'";
		getDbUpdate($table['bbslist'],$QVAL,"id='".$bid."'");
	}
	else{
		if(getDbRows($table['bbslist'],"id='".$id."'")) getLink('','','이미 같은 아이디의 게시판이 존재합니다.','');

		$Ugid = getDbCnt($table['bbslist'],'max(gid)','') + 1;
		$QKEY = "gid,id,name,category,num_r,d_last,d_regis,imghead,imgfoot,puthead,putfoot,addinfo,writecode";
		$QVAL = "'$Ugid','$id','$name','$category','0','','".$date['totime']."','$imghead','$imgfoot','$puthead','$putfoot','$addinfo','$writecode'";
		getDbInsert($table['bbslist'],$QKEY,$QVAL);
	}

	$fdset = array('layout','skin','m_skin','c_hidden','c_open','perm_g_list','perm_g_view','perm_g_write','perm_g_down','perm_l_list','perm_l_view','perm_l_write','perm_l_down','admin','hitcount','recnum','sbjcut','newtime','rss','sosokmenu','point1','point2','point3','display','hidelist','snsconnect','thumcnt','img_mobile','perm_w','category_type','pagree','hide_sbj','lst_sbj','lst_mbr','lst_type');

	$gfile= $g['path_module'].'bbs/var/var.'.$id.'.php';
	$fp = fopen($gfile,'w');
	fwrite($fp, "<?php\n");
	foreach ($fdset as $val)
	{
		fwrite($fp, "\$d['bbs']['".$val."'] = \"".trim(${$val})."\";\n");
	}
	fwrite($fp, "\$d['theme']['use_hidden'] = \"".$use_hidden."\";\n");
	fwrite($fp, "?>");
	fclose($fp);
	@chmod($gfile,0707);
	
	getLink('reload','parent.','적용되었습니다.','');
}
// 게시판삭제
else if($actid == 'del'){
	$R = getUidData($table['bbslist'],$uid);
	if (!$R['uid']) getLink('','','존재하지 않는 게시판입니다.','');
	include_once $flid.'.theme.php';

	include_once $g['path_module'].'upload/var/var.php';
	$RCD = getDbArray($table['bbsdata'],'bbs='.$R['uid'],'*','gid','asc',0,0);
	while($_R=db_fetch_array($RCD)){
		//댓글삭제
		if ($_R['comment'])
		{
			$CCD = getDbArray($table['s_comment'],"parent='".'bbs'.$_R['uid']."'",'*','uid','asc',0,0);

			while($_C=db_fetch_array($CCD))
			{
				if ($_C['upload'])
				{
					$UPFILES = getArrayString($_C['upload']);

					foreach($UPFILES as $_val)
					{
						$U = getUidData($table['s_upload'],$_val);
						if ($U['uid'])
						{
							getDbUpdate($table['s_numinfo'],'upload=upload-1',"date='".substr($U['d_regis'],0,8)."' and site=".$U['site']);
							getDbDelete($table['s_upload'],'uid='.$U['uid']);
							if ($U['url']==$d['upload']['ftp_urlpath'])
							{
								$FTP_CONNECT = ftp_connect($d['upload']['ftp_host'],$d['upload']['ftp_port']); 
								$FTP_CRESULT = ftp_login($FTP_CONNECT,$d['upload']['ftp_user'],$d['upload']['ftp_pass']); 
								if (!$FTP_CONNECT) getLink('','','FTP서버 연결에 문제가 발생했습니다.','');
								if (!$FTP_CRESULT) getLink('','','FTP서버 아이디나 패스워드가 일치하지 않습니다.','');
								if($d['upload']['ftp_pasv']) ftp_pasv($FTP_CONNECT, true);

								ftp_delete($FTP_CONNECT,$d['upload']['ftp_folder'].$U['folder'].'/'.$U['tmpname']);
								if($U['type']==2) ftp_delete($FTP_CONNECT,$d['upload']['ftp_folder'].$U['folder'].'/'.$U['thumbname']);
								ftp_close($FTP_CONNECT);
							}
							else {
								unlink($g['path_file'].$U['folder'].'/'.$U['tmpname']);
								if($U['type']==2) unlink($g['path_file'].$U['folder'].'/'.$U['thumbname']);
							}
						}
					}
				}
				if ($_C['oneline'])
				{
					$_ONELINE = getDbSelect($table['s_oneline'],'parent='.$_C['uid'],'*');
					while($_O=db_fetch_array($_ONELINE))
					{
						getDbUpdate($table['s_numinfo'],'oneline=oneline-1',"date='".substr($_O['d_regis'],0,8)."' and site=".$_O['site']);
						if ($_O['point']&&$_O['mbruid'])
						{
							getDbInsert($table['s_point'],'my_mbruid,by_mbruid,price,content,d_regis',"'".$_O['mbruid']."','0','-".$_O['point']."','한줄의견삭제(".getStrCut(str_replace('&amp;',' ',strip_tags($_O['content'])),15,'').")환원','".$date['totime']."'");
							getDbUpdate($table['s_mbrdata'],'point=point-'.$_O['point'],'memberuid='.$_O['mbruid']);
						}
					}
					getDbDelete($table['s_oneline'],'parent='.$_C['uid']);
				}
				getDbDelete($table['s_comment'],'uid='.$_C['uid']);
				getDbUpdate($table['s_numinfo'],'comment=comment-1',"date='".substr($_C['d_regis'],0,8)."' and site=".$_C['site']);

				if ($_C['point']&&$_C['mbruid'])
				{
					getDbInsert($table['s_point'],'my_mbruid,by_mbruid,price,content,d_regis',"'".$_C['mbruid']."','0','-".$_C['point']."','댓글삭제(".getStrCut($_C['subject'],15,'').")환원','".$date['totime']."'");
					getDbUpdate($table['s_mbrdata'],'point=point-'.$_C['point'],'memberuid='.$_C['mbruid']);
				}
			}
		}
		//첨부파일삭제
		if ($_R['upload'])
		{
			$UPFILES = getArrayString($_R['upload']);

			foreach($UPFILES['data'] as $_val)
			{
				$U = getUidData($table['s_upload'],$_val);
				if ($U['uid'])
				{
					getDbUpdate($table['s_numinfo'],'upload=upload-1',"date='".substr($U['d_regis'],0,8)."' and site=".$U['site']);
					getDbDelete($table['s_upload'],'uid='.$U['uid']);
					if ($U['url']==$d['upload']['ftp_urlpath'])
					{
						$FTP_CONNECT = ftp_connect($d['upload']['ftp_host'],$d['upload']['ftp_port']); 
						$FTP_CRESULT = ftp_login($FTP_CONNECT,$d['upload']['ftp_user'],$d['upload']['ftp_pass']); 
						if (!$FTP_CONNECT) getLink('','','FTP서버 연결에 문제가 발생했습니다.','');
						if (!$FTP_CRESULT) getLink('','','FTP서버 아이디나 패스워드가 일치하지 않습니다.','');
						if($d['upload']['ftp_pasv']) ftp_pasv($FTP_CONNECT, true);

						ftp_delete($FTP_CONNECT,$d['upload']['ftp_folder'].$U['folder'].'/'.$U['tmpname']);
						if($U['type']==2) ftp_delete($FTP_CONNECT,$d['upload']['ftp_folder'].$U['folder'].'/'.$U['thumbname']);
						ftp_close($FTP_CONNECT);
					}
					else {
						unlink($g['path_file'].$U['folder'].'/'.$U['tmpname']);
						if($U['type']==2) unlink($g['path_file'].$U['folder'].'/'.$U['thumbname']);
					}
				}
			}
		}
		
		//태그삭제
		if ($_R['tag'])
		{
			$_tagdate = substr($_R['d_regis'],0,8);
			$_tagarr1 = explode(',',$_R['tag']);
			foreach($_tagarr1 as $_t)
			{
				if(!$_t) continue;
				$_TAG = getDbData($table['s_tag'],"site=".$_R['site']." and date='".$_tagdate."' and keyword='".$_t."'",'*');
				if($_TAG['uid'])
				{
					if($_TAG['hit']>1) getDbUpdate($table['s_tag'],'hit=hit-1','uid='.$_TAG['uid']);
					else getDbDelete($table['s_tag'],'uid='.$_TAG['uid']);
				}
			}
		}

		getDbUpdate($table['bbsmonth'],'num=num-1',"date='".substr($_R['d_regis'],0,6)."' and site=".$_R['site'].' and bbs='.$_R['bbs']);
		getDbUpdate($table['bbsday'],'num=num-1',"date='".substr($_R['d_regis'],0,8)."' and site=".$_R['site'].' and bbs='.$_R['bbs']);
		getDbDelete($table['s_trackback'],"parent='".$_R['bbsid'].$_R['uid']."'");

		if ($_R['point1']&&$_R['mbruid'])
		{
			getDbInsert($table['s_point'],'my_mbruid,by_mbruid,price,content,d_regis',"'".$_R['mbruid']."','0','-".$_R['point1']."','게시물삭제(".getStrCut($_R['subject'],15,'').")환원','".$date['totime']."'");
			getDbUpdate($table['s_mbrdata'],'point=point-'.$_R['point1'],'memberuid='.$_R['mbruid']);
		}

	}

	getDbDelete($table['bbsidx'],'bbs='.$R['uid']);
	getDbDelete($table['bbsdata'],'bbs='.$R['uid']);
	getDbDelete($table['bbslist'],'uid='.$R['uid']);
	getDbDelete($table['bbsxtra'],'bbs='.$R['uid']);
	getDbDelete($table['s_seo'],'rel=3 and parent='.$R['uid']);

	unlink($g['path_module'].'bbs/var/var.'.$R['id'].'.php');

	getLink($g['s'].'/?r='.$r.'&m='.$m.'&mod='.$mod.'&div='.$div,'parent.','삭제되었습니다.','');
}
?>