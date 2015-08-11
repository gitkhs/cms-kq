<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$term1 = $year1.$month1.$day1.$hour1.$min1.'00';
$term2 = $year2.$month2.$day2.$hour2.$min2.'00';
$name = trim(strip_tags($name));

if ($uid)
{
	$QVAL = "hidden='".$hidden."',term0='".$term0."',term1='".$term1."',term2='".$term2."',name='".$name."',content='".$content."',html='".$html."',upload='".$upload."',center='".$center."',";
	$QVAL.= "ptop='".$ptop."',pleft='".$pleft."',width='".$width."',height='".$height."',scroll='".$scroll."',type='".$type."',dispage='".$dispage."'";

	getDbUpdate($table['s_popup'],$QVAL,'uid='.$uid);
}
else {

	$QKEY = "hidden,term0,term1,term2,name,content,html,upload,center,ptop,pleft,width,height,scroll,type,dispage";
	$QVAL = "'$hidden','$term0','$term1','$term2','$name','$content','$html','$upload','$center','$ptop','$pleft','$width','$height','$scroll','$type','$dispage'";

	getDbInsert($table['s_popup'],$QKEY,$QVAL);
}

getLink('reload','parent.', $alert , $history);
?>