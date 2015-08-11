<?
// 팝업등록
if($actid == 'regis'){
	$term1 = '';
	$term2 = '';
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

	getLink('reload','parent.','적용 되었습니다.','');
}
// 팝업삭제
else if($actid == 'del'){
	getDbDelete($table['s_popup'],'uid='.$uid);
	getLink('reload','parent.','삭제 되었습니다.','');
}
?>