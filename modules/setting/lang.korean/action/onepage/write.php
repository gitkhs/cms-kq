<?
$d_regis	= date("Ymdhis");
$d_modify	= date("Ymdhis");
$level		= $level ? $level : '0';

$rsStd = getDbData($table['s_stdpage'],"pid={$pid}","*");

if($rsStd['pid']){
	$qrTbl = $table['s_stdpage'];
	$qrSet = "level='{$level}', content='{$content}', mapapi='{$mapapi}', mapapi_pos='{$mapapi_pos}', d_modify='{$d_modify}', upload='{$upfiles}'";
	$qrWhe = "pid='{$pid}'";
	getDbUpdate($qrTbl, $qrSet, $qrWhe);
}
else{
	$qrTbl = $table['s_stdpage'];
	$qrKey = "pid, site, level, content, mapapi, mapapi_pos, hit, d_regis, d_modify, upload";
	$qrVal = "'{$pid}', '{$site}', '{$level}', '{$content}', '{$mapapi}', '{$mapapi_pos}', '0', '{$d_regis}', '', '{$upfiles}'";
	getDbInsert($qrTbl,$qrKey,$qrVal);
}

getLink('reload','parent.','적용되었습니다.','');
?>