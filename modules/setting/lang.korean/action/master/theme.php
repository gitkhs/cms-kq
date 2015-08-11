<?
	$fp = fopen($file_name,'w');
	fwrite($fp, trim(stripslashes($str_code)));
	fclose($fp);
	@chmod($file_name,0707);
	
	getLink('reload','parent.','적용되었습니다.','');
?>