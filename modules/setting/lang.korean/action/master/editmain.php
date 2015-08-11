<?
	$fp = fopen($file_source,'w');
	fwrite($fp, trim(stripslashes($str_source)));
	fclose($fp);
	@chmod($file_source,0707);
	
	$fp = fopen($file_style,'w');
	fwrite($fp, trim(stripslashes($str_style)));
	fclose($fp);
	@chmod($file_style,0707);

	getLink('reload','parent.','적용되었습니다.','');
?>