<?php
if(!defined('__KIMS__')) exit;


if (!$my['uid']) getLink('','','정상적인 접근이 아닙니다.','');

$R = getUidData($table['s_comment'],$uid);
if (!$R['uid']) getLink('','','삭제되었거나 존재하지 않는 댓글입니다.','');

$mbruid		= $my['uid'];
$category	= '댓글';
$subject	= addslashes($R['subject']);
$url	    = getCyncUrl($R['cync']).'&amp;CMT='.$R['uid'].'#CMT';
$d_regis	= $date['totime'];

if (getDbRows($table['s_scrap'],"mbruid=".$mbruid." and url='".$url."'"))
{
	getLink('','','이미 스크랩된 댓글입니다.','');
}

$_QKEY = 'mbruid,category,subject,url,d_regis';
$_QVAL = "'$mbruid','$category','$subject','$url','$d_regis'";
getDbInsert($table['s_scrap'],$_QKEY,$_QVAL);


getLink('' ,'' , '스크랩 되었습니다.' , '');
?>