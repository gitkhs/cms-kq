<?php
if(!defined('__KIMS__')) exit;

include_once $g['dir_module'].'var/var.php';

if($cync)
{
	$_SESSION[$m.'cync'] = $cync;
}
if (!$_SESSION[$m.'cync'])
{
	getLink($g['s'].'/','','동기화코드가 지정되지 않았습니다.','');
}
$cyncArr= getArrayString($_SESSION[$m.'cync']);

if ($CMT) $uid = $CMT;
if ($uid)
{
	$R = getUidData($table['s_comment'],$uid);
	if (!$R['uid']) getLink($g['s'].'/?r='.$r.'&m='.$m.($bid?'&bid='.$bid:''),'','존재하지 않는 댓글입니다.','');
	
	$isSECRETCHECK = true;
	if ($R['hidden'])
	{
		$isSECRETCHECK = false;
		if ($my['admin'] || ($my['id']&&$my['id']==$R['id']) || strstr($_SESSION['module_'.$m.'_view'],'['.$R['uid'].']'))
		{
			$isSECRETCHECK = true;
		}
		else {
			if ($pw)
			{
				if(md5($pw) != $R['pw'])
				{
					getLink('','','비밀번호가 일치하지 않습니다.','-1');
				}
				$isSECRETCHECK = true;
			}
		}
	}
	if ($type == 'modify')
	{
		if (!$my['id'] || ($my['id'] != $R['id'] && !$my['admin']))
		{
			if (!$pw)
			{
				getLink('','','비밀번호를 입력해 주세요.','-1');
			}
			else {
				if(md5($pw) != $R['pw'])
				{
					getLink('','','비밀번호가 일치하지 않습니다.','-1');
				}
			}
		}
	}

	if ($R['upload'])
	{
		$d['upload'] = array();
		$d['upload']['tmp'] = $R['upload'];
		$d['_pload'] = getArrayString($R['upload']);
		foreach($d['_pload']['data'] as $_val)
		{
			$U = getUidData($table['s_upload'],$_val);
			if (!$U['uid'])
			{
				$R['upload'] = str_replace('['.$_val.']','',$R['upload']);
				$d['_pload']['count']--;
			}
			else {
				$d['upload']['data'][] = $U;
			}
			if (!$U['cync'])
			{
				$_CYNC = "cync='[".$m."][".$R['uid']."][uid,down][".$table['s_comment']."][".$R['mbruid']."][".$cyncArr['data'][5].",CMT:".$R['uid']."#CMT]'";
				getDbUpdate($table['s_upload'],$_CYNC,'uid='.$U['uid']);
			}
		}
		if ($R['upload'] != $d['upload']['tmp'])
		{
			getDbUpdate($table['s_comment'],"upload='".$R['upload']."'",'uid='.$R['uid']);
		}
		$d['upload']['count'] = $d['_pload']['count'];
	}
	if ($isSECRETCHECK && !strstr($_SESSION['module_'.$m.'_view'],'['.$R['uid'].']'))
	{
		getDbUpdate($table['s_comment'],'hit=hit+1','uid='.$R['uid']);
		$_SESSION['module_'.$m.'_view'] .= '['.$R['uid'].']';
	}

	if($R['mbruid']) $g['member'] = getDbData($table['s_mbrdata'],'memberuid='.$R['mbruid'],'*');

	$OCD = array();
	if ($R['oneline'])
	{
		$TCD = getDbArray($table['s_oneline'],'parent='.$R['uid'],'*','uid',$d['comment']['orderby2'],0,0);
		while($_R = db_fetch_array($TCD)) $OCD[] = $_R;
	}
}

$mod	= 'main';
$sort	= $sort ? $sort : 'uid';
$orderby= $orderby ? $orderby : $d['comment']['orderby1'];
$recnum	= $recnum && $recnum < 200 ? $recnum : $d['comment']['recnum'];

$cmentque = " and parent='".$cyncArr['data'][0].$cyncArr['data'][1]."'";

$NCD = array();
$RCD = array();

$PCD = getDbArray($table['s_comment'],'notice=1'.$cmentque,'*',$sort,$orderby,0,0);
$TCD = getDbArray($table['s_comment'],'notice=0'.$cmentque,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table['s_comment'],'notice=0'.$cmentque);
$TPG = getTotalPage($NUM,$recnum);
while($_R = db_fetch_array($PCD)) $NCD[] = $_R;
while($_R = db_fetch_array($TCD)) $RCD[] = $_R;


if ($g['mobile']&&$_SESSION['pcmode']!='Y')
{
	$B['skin'] = $skin ? $skin : $d['comment']['skin_mobile'];
}
else {
	$B['skin'] = $skin ? $skin : $d['comment']['skin_main'];
}

$g['cment_reset']	= getLinkFilter($g['s'].'/?'.($_HS['usescode']?'r='.$r.'&amp;':'').($c?'c='.$c:'m='.$m),array($skin?'skin':'',$iframe?'iframe':''));
$g['cment_list']	= $g['cment_reset'].getLinkFilter('',array('p','sort','orderby','recnum','where','keyword'));
$g['cment_view']	= $g['cment_list'].'&amp;uid=';
$g['cment_modify']	= $g['cment_list'].'&amp;type=modify&amp;uid=';
$g['cment_action']	= $g['cment_list'].'&amp;a=';
$g['cment_delete']	= $g['cment_action'].'delete&amp;uid=';
$g['cment_odelete']	= $g['cment_action'].'oneline_delete&amp;uid=';

$g['dir_module_skin'] = $g['dir_module'].'theme/'.$B['skin'].'/';
$g['url_module_skin'] = $g['url_module'].'/theme/'.$B['skin'];
$g['img_module_skin'] = $g['url_module_skin'].'/image';

$g['dir_module_mode'] = $g['dir_module_skin'].$mod;
$g['url_module_mode'] = $g['url_module_skin'].'/'.$mod;

$g['main'] = $g['dir_module_mode'].'.php';
?>