<?
	if($actid == 'getFile'){
		$fname	= str_replace('./','',$folder);
		$fname	= str_replace(' ','',$fname);
		$fname	= str_replace('/','=',$fname).'.tar.gz';

		exec("tar -cvzf {$fname} {$folder}");
		downFile($fname,$fname);
		unlink($fname);
	}
	else if($actid == 'getList'){
		require_once $g['path_core'].'com/PHPExcel/PHPExcel.ReadWrite.php';

		$FLST	= getDbSelect($table['s_upload'],"uid<>0 order by gid","*");
		$fname	= getUTFtoKR("첨부파일목록.xls");
		$fpath	= $g['path_file']."_etc/etc/".$fname;
		$idx	= 0;
		$data[]	= array('번호','폴더','파일명','원본','썸네일','사이즈','넓이','높이','등록일');
		while($_R = db_fetch_array($FLST)){
			$data[]	= array($idx,$_R['folder'],$_R['name'],$_R['tmpname'],$_R['thumbname'],number_format($_R['size']),$_R['width'],$_R['height'],getDateFormat($_R['d_regis'],'Y.m.d H:i'));
			$idx++;
		}

		writeExcel($fpath,$data);
		downFile($fpath,$fname);
		unlink($fpath);
	}

	getLink('','','잘못 전달된 명령입니다. 관리자에 문의하세요.','');
?>