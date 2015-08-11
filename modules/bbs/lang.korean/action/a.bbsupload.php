<?php
	if(!defined('__KIMS__')) exit;
	if ($my['level'] < $admin['admin']) getLink('','','정상적인 접근이 아닙니다.','');
	require_once $g['path_core'].'com/PHPExcel/PHPExcel.ReadWrite.php';
	$dir	= $g['path_file']."_etc/etc/";

	$B		= getDbData($table[$m.'list'],"id = '{$bbsid}'","*");

	$fname	= "upbbs.xls";
	$fpath	= $dir.$fname;
	move_uploaded_file($_FILES['upData']['tmp_name'], $fpath);
	
	$excel = readExcel($fpath);
	for($i=0;$i<count($excel);$i++){
		$_R = $excel[$i];
		if($_R[0] === '답변') continue;
		
		$_R[5]	= addslashes($_R[5]);
		$_R[6]	= addslashes($_R[6]);
		$_R[11]	= addslashes($_R[11]);
		$_R[12]	= addslashes($_R[12]);

		$mingid = getDbCnt($table[$m.'data'],'min(gid)','');
		$gid = $mingid ? $mingid-1 : 100000000.00;

		$QKEY = "site,gid,bbs,bbsid,depth,parentmbr,display,hidden,notice,name,nic,mbruid,id,pw,category,subject,content,html,tag,";
		$QKEY.= "hit,down,comment,oneline,trackback,score1,score2,singo,point1,point2,point3,point4,d_regis,d_modify,d_comment,d_trackback,upload,ip,agent,sns,adddata";
		$QVAL = "'$s','$gid','{$B['uid']}','$bbsid','{$_R[0]}','{$_R[1]}','{$_R[2]}','{$_R[3]}','{$_R[4]}','{$_R[5]}','{$_R[6]}','{$_R[7]}','{$_R[8]}','{$_R[9]}','{$_R[10]}','{$_R[11]}','{$_R[12]}','{$_R[13]}','{$_R[14]}',";
		$QVAL.= "'0','0','0','0','0','0','0','0','0','0','0','0','{$_R[15]}','','','','','','','','{$_R[16]}'";
		getDbInsert($table[$m.'data'],$QKEY,$QVAL);
		getDbInsert($table[$m.'idx'],'site,notice,bbs,gid',"'$s','{$_R[4]}','{$B['uid']}','$gid'");
		getDbUpdate($table[$m.'list'],"num_r=num_r+1",'uid='.$B['uid']);

		$bbsday		= $_R[15] ? substr($_R[15],0,8) : $date['today'];
		$bbsmonth	= $_R[15] ? substr($_R[15],0,6) : $date['month'];
		if(getDbRows($table[$m.'day'],"date='".$bbsday."' and site=".$s.' and bbs='.$B['uid']))
			getDbUpdate($table[$m.'day'],'num=num+1',"date='".$bbsday."' and site=".$s.' and bbs='.$B['uid']);
		else
			getDbInsert($table[$m.'day'],'date,site,bbs,num',"'".$bbsday."','".$s."','".$B['uid']."','1'");

		if(getDbRows($table[$m.'month'],"date='".$bbsmonth."' and site=".$s.' and bbs='.$B['uid']))
			getDbUpdate($table[$m.'month'],'num=num+1',"date='".$bbsmonth."' and site=".$s.' and bbs='.$B['uid']);
		else
			getDbInsert($table[$m.'month'],'date,site,bbs,num',"'".$bbsmonth."','".$s."','".$B['uid']."','1'");

		if ($gid == 100000000.00)
		{
			db_query("OPTIMIZE TABLE ".$table[$m.'idx'],$DB_CONNECT); 
			db_query("OPTIMIZE TABLE ".$table[$m.'data'],$DB_CONNECT); 
			db_query("OPTIMIZE TABLE ".$table[$m.'month'],$DB_CONNECT); 
			db_query("OPTIMIZE TABLE ".$table[$m.'day'],$DB_CONNECT); 
		}


	}

	unlink($fpath);
	getLink('reload','parent.','업로드 되었습니다.','');
?>