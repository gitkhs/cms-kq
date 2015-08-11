<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$id = trim($id);
$subject = trim($subject);
$title = trim($title);
$keywords = trim($keywords);
$description = trim($description);
$classification = trim($classification);
$replyto = trim($replyto);
$language = trim($language);
$build = trim($build);


if ($seo)
{

	$R = getUidData($table['s_seo'],$seo);
	if (!$R['uid']) getLink('','','정상적인 접근이 아닙니다.    ','');

	$QVAL = "subject='".$subject."',title='".$title."',keywords='".$keywords."',description='".$description."',classification='".$classification."',replyto='".$replyto."',language='".$language."',build='".$build."'";
	getDbUpdate($table['s_seo'],$QVAL,'uid='.$seo);

}
else {
	$R = getDbData($table['s_seo'],'rel='.$rel.' and parent='.$cat,'*');
	if ($R['uid']) getLink('','','정상적인 접근이 아닙니다.    ','');
	
	$QKEY = 'rel,parent,subject,title,keywords,description,classification,replyto,language,build';
	$QVAL = "'$rel','$cat','$subject','$title','$keywords','$description','$classification','$replyto','$language','$build'";
	getDbInsert($table['s_seo'],$QKEY,$QVAL);
}


if ($rel != 3 && $id != $oid)
{
	if ($rel == 1) $ISMCODE = getDbData($table['s_menu'],"id='".$id."' and site=".$s,'*');
	if ($rel == 2) $ISMCODE = getDbData($table['s_page'],"id='".$id."'",'*');
	if ($ISMCODE['uid']) getLink('reload','parent.','고유주소 ['.$ISMCODE['id'].'] 는 다른메뉴 ['.$ISMCODE['name'].'] 에서 사용중입니다.','');
}

if ($rel == 1) getDbUpdate($table['s_menu'],"id='".$id."'",'uid='.$cat);
if ($rel == 2)
{
	getDbUpdate($table['s_page'],"id='".$id."'",'uid='.$cat);

	if ($oid != $id)
	{
		$mfile1 = $g['path_page'].$oid.'.php';
		$mfile2 = $g['path_page'].$id.'.php';
		@rename($mfile1,$mfile2);
		@chmod($mfile2,0707);
		$mfile1 = $g['path_page'].$oid.'.widget.php';
		$mfile2 = $g['path_page'].$id.'.widget.php';
		@rename($mfile1,$mfile2);
		@chmod($mfile2,0707);
		@unlink($g['path_page'].$oid.'.txt');
	}

}

getLink('reload','parent.','갱신되었습니다.','');
?>