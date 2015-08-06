<?
	$gfile= $g['path_layout'].'topbanner.php';
	$fp = fopen($gfile,'w');
	fwrite($fp, trim(stripslashes($str_code)));
	fclose($fp);
	@chmod($gfile,0707);
	
	getLink('reload','parent.','적용되었습니다.','');
?>