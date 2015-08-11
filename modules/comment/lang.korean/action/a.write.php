<?php
if(!defined('__KIMS__')) exit;

//if (!$_SESSION['wcode']||$_SESSION['wcode']!=$pcode) exit;
include_once $g['dir_module'].'var/var.php';

$cync		= trim($_SESSION[$m.'cync']);
$mbruid		= $my['uid'];
$id			= $my['id'];
$name		= $my['uid'] ? $my['name'] : trim($name);
$nic		= $my['uid'] ? $my['nic'] : $name;
$pw			= $pw ? md5($pw) : ''; 
$subject	= $my['admin'] ? trim($subject) : htmlspecialchars(trim($subject));
$content	= trim($content);
$subject	= $subject ? $subject : getStrCut(str_replace('&amp;',' ',strip_tags($content)),35,'..');
$html		= $html ? $html : 'TEXT';
$d_regis	= $date['totime'];
$d_modify	= '';
$d_oneline	= '';
$ip			= $_SERVER['REMOTE_ADDR'];
$agent		= $_SERVER['HTTP_USER_AGENT'];
$upload		= $upfiles;
$adddata	= trim($adddata);
$hit		= 0;
$down		= 0;
$oneline	= 0;
$score1		= 0;
$score2		= 0;
$singo		= 0;
$point		= $d['comment']['give_point'];
$hidden		= $hidden ? intval($hidden) : 0;
$notice		= $notice ? intval($notice) : 0;
$display	= $hidepost || $hidden ? 0 : 1;

if ($d['comment']['perm_write'] > $my['level'])
{
	getLink('','','댓글등록 권한이 없습니다.','');
}

if ($d['comment']['badword_action'])
{
	$badwordarr = explode(',' , $d['comment']['badword']);
	$badwordlen = count($badwordarr);
	for($i = 0; $i < $badwordlen; $i++)
	{
		if(!$badwordarr[$i]) continue;

		if(strstr($subject,$badwordarr[$i]) || strstr($content,$badwordarr[$i]))
		{
			if ($d['comment']['badword_action'] == 1)
			{
				getLink('','','등록이 제한된 단어를 사용하셨습니다.','');
			}
			else {
				$badescape = strCopy($badwordarr[$i],$d['comment']['badword_escape']);
				$content = str_replace($badwordarr[$i],$badescape,$content);
				$subject = str_replace($badwordarr[$i],$badescape,$subject);
			}
		}
	}
}

if ($uid)
{
	$R = getUidData($table['s_comment'],$uid);
	if (!$R['uid']) getLink('','','존재하지 않는 댓글입니다.','');

	if (!$my['id'] || ($my['id'] != $R['id'] && !$my['admin']))
	{
		if (!$pw)
		{
			getLink('','','정상적인 접근이 아닙니다.','');
		}
		else {
			if($pw != $R['pw'])
			{
				getLink('','','정상적인 접근이 아닙니다.','');
			}
		}
	}

	$QVAL = "display='$display',hidden='$hidden',notice='$notice',subject='$subject',content='$content',html='$html',d_modify='$d_regis',upload='$upload',adddata='$adddata'";
	getDbUpdate($table['s_comment'],$QVAL,'uid='.$R['uid']);

	getLink(($c?$g['s'].'/?r='.$r.'&c='.$c:$g['s'].'/?r='.$r.'&m='.$m).getLinkFilter('',array('skin','iframe','sort','orderby','recnum','where','keyword','uid')),'parent.','','');
}
else 
{
	//동기화
	$cyncArr = getArrayString($cync);

	if(!$cyncArr['data'][0]||!$cyncArr['data'][1]) getLink('','','동기화코드가 지정되지 않았습니다.','');

	$fdexp = explode(',',$cyncArr['data'][2]);
	if($fdexp[0]&&$fdexp[1]&&$cyncArr['data'][3])
	{
		$cyncQue = $fdexp[1].'='.$fdexp[1].'+1';
		if($fdexp[3]) $cyncQue .= ','.$fdexp[3]."='".$d_regis."'";
		getDbUpdate($cyncArr['data'][3],$cyncQue,$fdexp[0].'='.$cyncArr['data'][1]);
	}

	$parent = $cyncArr['data'][0].$cyncArr['data'][1];
	$parentmbr = $cyncArr['data'][4];

	$minuid = getDbCnt($table['s_comment'],'min(uid)','');
	$uid = $minuid ? $minuid-1 : 1000000000;

	$QKEY = "uid,site,parent,parentmbr,display,hidden,notice,name,nic,mbruid,id,pw,subject,content,html,";
	$QKEY.= "hit,down,oneline,score1,score2,singo,point,d_regis,d_modify,d_oneline,upload,ip,agent,cync,sns,adddata";
	$QVAL = "'$uid','$s','$parent','$parentmbr','$display','$hidden','$notice','$name','$nic','$mbruid','$id','$pw','$subject','$content','$html',";
	$QVAL.= "'$hit','$down','$oneline','$score1','$score2','$singo','$point','$d_regis','$d_modify','$d_oneline','$upload','$ip','$agent','$cync','','$adddata'";
	getDbInsert($table['s_comment'],$QKEY,$QVAL);
	getDbUpdate($table['s_numinfo'],'comment=comment+1',"date='".$date['today']."' and site=".$s);

	if ($uid == 1000000000) db_query("OPTIMIZE TABLE ".$table['s_comment'],$DB_CONNECT);

	if ($point&&$my['uid'])
	{
		getDbInsert($table['s_point'],'my_mbruid,by_mbruid,price,content,d_regis',"'".$my['uid']."','0','".$point."','댓글(".getStrCut($subject,15,'').")포인트','".$date['totime']."'");
		getDbUpdate($table['s_mbrdata'],'point=point+'.$point,'memberuid='.$my['uid']);
	}

	if ($snsCallBack && is_file($g['path_module'].$snsCallBack))
	{
		$xcync = $cync.',CMT:'.$uid;
		$orignSubject = strip_tags($subject);
		$orignContent = getStrCut($orignSubject,60,'..');
		$orignUrl = 'http://'.$_SERVER['SERVER_NAME'].str_replace('./','/',getCyncUrl($xcync)).'#CMT';

		include_once $g['path_module'].$snsCallBack;
		if ($snsSendResult)
		{
			getDbUpdate($table['s_comment'],"sns='".$snsSendResult."'",'uid='.$uid);
		}
	}

	getLink(getLinkFilter($g['s'].'/?'.($_HS['usescode']?'r='.$r.'&amp;':'').($c?'c='.$c:'m='.$m),array('skin','iframe','sort','orderby','recnum','where','keyword')),'parent.','','');
}
?>