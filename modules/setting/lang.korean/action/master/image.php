<?
	if ($actid == 'folder_add'){
		$folder = './'.str_replace('./','',$folder);
		if(!is_dir($folder.$newfolder))
		{
			mkdir($folder.$newfolder,0707);
			@chmod($folder.$newfolder,0707);
		}

		$url = $g['s'].'/?m=setting&amp;mod=master&amp;div=image&amp;winmod='.$winmod.'&amp;fileupload=Y&amp;pwd='.$pwd.'&amp;pwd1='.$pwd1;
		getLink($url,'','','');
	}
	else if ($actid == 'folder_delete'){
		$folder = './'.str_replace('./','',$folder);
		include_once $g['path_core'].'function/dir.func.php';

		DirDelete($folder);

		$pwdexp = explode('/',$folder);
		$lastpwd = $pwdexp[count($pwdexp)-2];
	
		$backpwd = urlencode(str_replace('/'.$lastpwd.'/','',$folder).'/');
		$url = $g['s'].'/?m=setting&amp;mod=master&amp;div=image&amp;winmod='.$winmod.'&amp;pwd='.$backpwd;
		getLink($url,'','','');
	}
	else if($actid == 'upfile_modify'){
		if (is_uploaded_file($_FILES['upfile']['tmp_name']))
		{
			$folder = './'.str_replace('./','',$folder);
			$oldfile= getUTFtoKR($oldfile);

			$upFile_A = explode('.' , $_FILES['upfile']['name']);
			$upFile_E = strtolower($upFile_A[count($upFile_A)-1]);

			if ($upFile_E == $fileext)
			{
				move_uploaded_file($_FILES['upfile']['tmp_name'],$folder.$oldfile);
				@chmod($folder.$oldfile , 0707);
			}
		}
		getLink('reload','parent.','','');
	}
	else if($actid == 'file_edit'){
		$folder = './'.str_replace('./','',$folder);

		$fp = fopen($folder.$oldfile,'w');
		fwrite($fp,trim(stripslashes($content)));
		fclose($fp);
		@chmod($file,0707);
	
		getLink('reload','parent.','수정되었습니다.','');
	}
	else if($actid == 'files_delete'){
		$folder = './'.str_replace('./','',$folder);
		
		foreach($members as $val)
		{
			unlink($folder.getUTFtoKR($val));
		}
		getLink('reload','parent.','삭제 되었습니다.','');
	}
	else if($actid == 'files_get'){
		getLink('reload','parent.','해당 파일을 받았습니다.','');
	}

	getLink('reload','parent.','잘못된 데이터가 전달 되었습니다. 관리자에게 문의 하세요.','');
?>