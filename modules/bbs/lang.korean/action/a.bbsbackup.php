<?php
if(!defined('__KIMS__')) exit;

if ($my['level'] < $admin['admin']) getLink('','','정상적인 접근이 아닙니다.','');
require_once $g['path_core'].'com/PHPExcel/PHPExcel.ReadWrite.php';

$B		= getDbData($table['bbslist'],"id = '{$bbsid}'","*");
$BLST	= getDbSelect($table['bbsdata'],"bbsid = '{$bbsid}' order by gid desc","*");

//$fname	= getUTFtoKR($B['name']."_게시판내용.xls");
$fname	= $B['name']."_게시판내용.xls";
$fpath	= $g['path_file']."_etc/etc/".$fname;
$data[]		= array('답변','답변게시물','최근글노출','숨김','공지','작성자','작성자별명','회원번호','회원ID','회원비번','카테고리','제목','내용','HTML','태그','등록일','추가데이터');
while($_R = db_fetch_array($BLST)){
	$data[]		= array($_R['depth'],$_R['parentmbr'],$_R['display'],$_R['hidden'],$_R['notice'],$_R['name'],$_R['nic'],$_R['mbruid'],$_R['id'],$_R['pw'],$_R['category'],$_R['subject'],$_R['content'],$_R['html'],$_R['tag'],$_R['d_regis'],$_R['adddata']);
}

writeExcel($fpath,$data);
downFile($fpath,$fname);
unlink($fpath);
?>