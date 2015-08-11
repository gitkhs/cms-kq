<?php
$step_start = 0;
$pwd_start = './';
$pwd = $pwd ? urldecode($pwd) : $pwd_start;
$tdir = str_replace('./','',$pwd);
$g['adm_href'] = $g['adm_href'].'&amp;iframe='.$iframe;

if (strstr($pwd,'..'))
{
    getLink($g['s'].'/?r='.$r.'&m='.$m,'','더이상 접근권한이 없는 디렉토리입니다.','');
}
if(!is_dir($pwd))
{
	getLink('','','존재하지 않는 폴더입니다.','-1');
}

$set1 = array
(
	'layouts'=>'레이아웃',
	'modules'=>'모듈',
	'widgets'=>'위젯',
	'pages'=>'페이지',
	'files'=>'첨부파일',
	'switchs'=>'스위치'
);
$set2 = array
(

);
function getTPLname($fname)
{
	global $set1;
	$nName = $set1[$fname];
	return $nName ? $nName : $fname;
}
function getFILEname($fname)
{
	global $set2;
	$fexp = explode('.',$fname);
	$nName = $set2[str_replace('.'.$fexp[count($fexp)-1],'',$fname)];
	return $nName ? $nName.'.'.$fexp[count($fexp)-1] : getKRtoUTF($fname);
}
function getDirexists($dir)
{
    $opendir = opendir($dir);
    while(false !== ($file = readdir($opendir))) {
        if($file != '.' && $file != '..' && is_dir($dir.'/'.$file)){$fex = 1; break;}
    }
    closedir($opendir);
    return $fex;
}
function getPrintdir( $nTab, $filepath, $files, $state ,$dir_ex)
{
    global $g,$pwd,$file,$step_start,$iframe;
    
    if($step_start) { $nTab = $nTab - $step_start; }
	$css = strstr($pwd,$filepath) ? 'nowdir' : 'alldir';
	$fname1 = getFolderName($filepath);
	$fname2 = getTPLname($fname1);

    echo '<div class="dir01">';
    echo '<img src="'.$g['img_module_admin'].'/blank.gif" width="'.(($nTab*17)+3).'" height="1" alt="" /> ';
    echo '<a href="'.$g['adm_href'].'&amp;pwd='.urlencode($filepath).'" title="'.$fname1.'">';
    if($state && $dir_ex) {
        echo '<img src="'.$g['img_module_admin'].'/dir_closef.gif" align="absmiddle" alt="" />';
        echo ' <img src="'.$g['img_module_admin'].'/close_dir.gif" alt=""> <span class="'.$css.'">'.$fname2;
    }
    else if (!$state && $dir_ex) {
        echo '<img src="'.$g['img_module_admin'].'/dir_openf.gif" align="absmiddle" alt="" />';
        echo ' <img src="'.$g['img_module_admin'].'/open_dir.gif" alt=""> <span class="'.$css.'">'.$fname2;
    }
    else {
        echo '<img src="'.$g['img_module_admin'].'/blank.gif" width="11" height="18" align="absmiddle" alt="" />';
        echo ' <img src="'.$g['img_module_admin'].'/close_dir.gif" alt=""> <span class="'.$css.'">'.$fname2;
    }
    echo '</span></a></div>';
}
function getDirlist($dirpath,$nStep)
{
    global $pwd;
    $arrPath = explode('/', $pwd );

    if( $dir_handle = opendir($dirpath) )
    {
        while( false !== ($files = readdir($dir_handle)) )
        {
            $subDir = $dirpath.$files.'/';
            if( @is_dir($subDir) && ($files != '.') && ($files != '..') )
            {
                getPrintdir( $nStep, $subDir, $files, !strstr($pwd,$subDir) , getDirexists($subDir) );
                if( $arrPath[$nStep+1] == $files ) {
                    getDirlist( $subDir, $nStep+1);
                }
            }
        }
    }
    closedir( $dir_handle );
}
function getPermision($file) 
{
    $p_bin = substr(decbin(@fileperms($file)), -9) ;
    $p_arr = explode(".", substr(chunk_split($p_bin, 1,"."), 0, 17)) ;
    $perms = ""; $i = 0;
    foreach ($p_arr as $thisx) { 
        $p_char = ( $i%3==0 ? "r" : ( $i%3==1 ? "w" :"x" ) ); 
        $perms .= ( $thisx=="1" ? $p_char : "-" ) . ($i%3==2 ? "" : "" );
        $i++;
    }
    return trim($perms);
}
function getFileuser($file,$stat) 
{
    if (function_exists('posix_getpwuid'))
	{
        $filestat = stat($file);
        $getname = posix_getpwuid($filestat[$stat]);
        return $getname['name'];
    }
    else {  
        return getKRtoUTF($_SERVER['USERNAME']?$_SERVER['USERNAME']:$_ENV['USERNAME']);
    }
}
?>



<div id="catebody">
	<div id="category">

		<div class="title">
			파일메니져
		</div>

		<div class="tree">
		<?php getDirlist($pwd_start,$step_start)?>
		</div>

	</div>

	<div id="catinfo">



	<?php if($fileadd):?>

		<div class="title">
			<div class="xleft">
				새 파일 만들기
			</div>
			<div class="xright">
				<a href="<?php echo $g['adm_href']?>&amp;pwd=<?php echo $pwd?>">목록</a>
			</div>
		</div>

		<div class="notice">
			새로 만들 파일명을 입력해 주세요.<br />
			파일명은 <span style="b">영문소문자/숫자/_</span>만 사용가능합니다.
		</div>

		<div id="editform">		
		<form action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return mkFileCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $module?>" />
		<input type="hidden" name="a" value="file_add" />
		<input type="hidden" name="folder" value="<?php echo $pwd?>" />
		<input type="hidden" name="iframe" value="<?php echo $iframe?>" />

		<table>
			<tr>
				<td class="td1">생성위치</td>
				<td class="td2 b">
					<?php echo $pwd?>
				</td>
			</tr>
			<tr>
				<td class="td1">파일이름</td>
				<td class="td2">
					<input type="text" name="newfile" class="input" />
					<input type="submit" class="btnblue" value=" 만들기 " />

					<select onchange="backChange(this.value);">
					<option value="">배경</option>
					<option value="1">흰색</option>
					<option value="2">검정</option>
					<option value="3">파랑</option>
					</select>
					<img src="<?php echo $g['img_module_admin']?>/btn_full.gif" alt="전체화면으로 편집" id="fullimg" class="resizeimg hand" onclick="editBoxcontrol(this);" />
					
				</td>
			</tr>
		</table>

		<div id="editbox" class="editdiv">
			<textarea id="editboxarea" name="content"></textarea>
		</div>

		</form>
			
		<script type="text/javascript">
		//<![CDATA[
		function setStart()
		{
			backChange(getCookie('EditBackColor'));
			if (getId('fullimg').src.indexOf('btn_full') != -1)
			{
				var ofs = getOfs(getId('catinfo')); 
				getId('editboxarea').style.width = (parseInt(ofs.width)-50) + 'px';
			}
		}
		setStart();
		window.onresize = setStart;
		//]]>
		</script>

	<?php elseif($folderadd):?>


		<div class="title">
			<div class="xleft">
				새 폴더 만들기
			</div>
			<div class="xright">
				<a href="<?php echo $g['adm_href']?>&amp;pwd=<?php echo $pwd?>">목록</a>
			</div>
		</div>

		<div class="notice">
			새로 만들 폴더명을 입력해 주세요.<br />
			폴더명은 <span style="b">영문소문자/숫자/_</span>만 사용가능합니다.
		</div>
		

		<form action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return mkFolderCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $module?>" />
		<input type="hidden" name="a" value="folder_add" />
		<input type="hidden" name="folder" value="<?php echo $pwd?>" />
		<input type="hidden" name="iframe" value="<?php echo $iframe?>" />

		<table>
			<tr>
				<td class="td1">생성위치</td>
				<td class="td2 b">
					<?php echo $pwd?>
				</td>
			</tr>
			<tr>
				<td class="td1">폴더이름</td>
				<td class="td2">
					<input type="text" name="newfolder" class="input" />
					<input type="submit" class="btnblue" value=" 확 인 " />
				</td>
			</tr>
		</table>


		</form>

	<?php elseif($fileupload):?>
	<?php
	$agopwd = '';
	$pwdexp = explode('/',$pwd);
	$pwdlen = count($pwdexp)-2;
	for($i=0;$i<$pwdlen;$i++) $agopwd .= $pwdexp[$i].'/';
	$agopwd = $agopwd ? $agopwd : './';
	$latpwd = $pwdexp[$pwdlen];
	?>

		<div class="title">
			<div class="xleft">
				파일 업로드
			</div>
			<div class="xright">
				<a href="<?php echo $g['adm_href']?>&amp;pwd=<?php echo $pwd?>">목록</a>
			</div>
		</div>

		<div class="notice">
			이미지/플래쉬파일만 첨부가능합니다. <span style="b">보기) jpg,jpeg,gif,png,swf</span><br />
			파일명에 한글이 포함되어 있을 경우 정상적으로 출력되지 않을 수 있습니다.<br />
			이미 같은이름으로 파일이 존재할 경우 덧씌워집니다.</br />
			첨부폴더는 지정된 경로와 그 안의 폴더들을 선택할 수 있습니다.<br />
			폴더를 선택하지 않으면 지정된 경로에 업로드됩니다.<br />
		</div>

		<form name="upForm" action="<?php echo $g['s']?>/" method="get" onsubmit="return folderCheck(this);">
		<input type="hidden" name="a" value="" />
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="module" value="<?php echo $module?>" />
		<input type="hidden" name="pwd" value="<?php echo $pwd?>" />
		<input type="hidden" name="folder" value="<?php echo $pwd?>" />
		<input type="hidden" name="iframe" value="<?php echo $iframe?>" />
		<input type="hidden" name="fileupload" value="<?php echo $fileupload?>" />

		<table>
			<tr>
				<td class="td1">첨부폴더 : </td>
				<td class="td2 b">
					<?php echo $pwd?>
					<select name="pwd1" style="padding:2px;margin:1px;" onchange="this.form.submit();">
					<option value=""></option>
					<?php $dirs = opendir($pwd)?>
					<?php while(false !== ($tpl = readdir($dirs))):?>
					<?php if($tpl=='.' || $tpl == '..' || is_file($pwd.$tpl))continue?>
					<option value="<?php echo $tpl?>"<?php if($pwd1==$tpl):?> selected="selected"<?php endif?>><?php echo $tpl?></option>
					<?php endwhile?>
					<?php closedir($dirs)?>
					</select>
					&lt;-
					<input type="text" name="newfolder" value="" size="15" class="input" />
					<input type="submit" value="새 폴더 추가" class="btngray" />

				</td>
			</tr>
		</table>

		<div class="updiv">
		<script type="text/JavaScript" src="<?php echo $g['url_root']?>/_core/lib/swfupload.js" charset="utf-8"></script>
		<script type="text/javascript">
		var save_Path = document.upForm.folder.value + (document.upForm.pwd1.value != '' ? document.upForm.pwd1.value + '/' : '');
		var object_Id = 'kimsqSwfuploader';
		var limitSize = '<?php echo str_replace('M','',ini_get('upload_max_filesize'))*1024*1024?>';
		var flashFile = '<?php echo $g['url_root']?>/_core/lib/swfupload.swf';
		var quploader = '../../index.php';
		var qupload_m = '<?php echo $module?>';
		var qupload_a = 'upload';
		var sess_Code = '<?php echo $my['admin']?>';
		var Permision = 'true';
		var Overwrite = 'true';
		var ftypeName = '그림파일';
		var ftypeExt1 = '*.jpg *.jpeg *.gif *.png *.swf';
		var ftypeExt2 = '*.php *.php3 *.html *.inc *.cgi *.pl *.js';
		var swbgcolor = '#ffffff';
		var swf_width = '500';
		var list_rows = '10';
		makeSwfMultiUpload();
		</script>
		</div>


		<div class="submitbox1">
			<input type="button" class="btngray" value=" 취 소 " onclick="<?php if($iframe=='Y'):?>top.close();<?php else:?>history.go(-1);<?php endif?>" />
			<input type="button" class="btnblue" value=" 확 인 " onclick="callSwfUpload();" />
			<div class="clear"></div>
		</div>

		</form>
			
		<script type="text/javascript">
		//<![CDATA[
		function folderCheck(f)
		{
			if (f.newfolder.value == '')
			{
				alert('폴더명을 입력해 주세요.');
				f.newfolder.focus();
				return false;
			}
			if(!chkIdValue(f.newfolder.value))
			{
				alert('폴더명은 영문소문자+숫자+_ 만 사용할 수 있습니다.');
				f.newfolder.focus();
				return false;
			}
			f.a.value = 'folder_add';
			f.m.value = f.module.value;
			f.module.value = '';
			f.fileupload.value = '';
			f.submit();
		}
		//]]>
		</script>

		<?php elseif($editmode == 'Y'):?>
		<?php if(!is_file($pwd.getUTFtoKR($file))) getLink('','','존재하지 않는 파일입니다.','-1')?>

		<?php if(strstr('jpeg,jpg,gif,png,swf',strtolower(getExt($file)))):?>
		<?php $IM=getimagesize($pwd.getUTFtoKR($file))?>


		<div class="title">
			<div class="xleft">
				파일 변경하기
			</div>
			<div class="xright">
				<a href="<?php echo $g['adm_href']?>&amp;pwd=<?php echo $pwd?>">목록</a>
			</div>
		</div>

		<div class="notice">
			파일을 업로드할 경우 업로드된 파일로 변경됩니다.<br />
			파일명은 기존 파일명(<?php echo $file?>)으로 고정됩니다.
		</div>
		

		<form action="<?php echo $g['s']?>/" method="post" enctype="multipart/form-data" target="_action_frame_<?php echo $m?>" onsubmit="return imgModifyCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $module?>" />
		<input type="hidden" name="a" value="upfile_modify" />
		<input type="hidden" name="folder" value="<?php echo $pwd?>" />
		<input type="hidden" name="oldfile" value="<?php echo $file?>" />
		<input type="hidden" name="fileext" value="<?php echo getExt($file)?>" />
		<input type="hidden" name="iframe" value="<?php echo $iframe?>" />

		<table>
			<tr>
				<td class="td1">파일선택</td>
				<td class="td2 b">
					<input type="file" name="upfile" class="upfile" />
					<input type="submit" class="btnblue" value=" 확인 " />
				</td>
			</tr>
			<tr>
				<td class="td1"></td>
				<td class="td2">

				</td>
			</tr>
		</table>



		<?php if(getExt($file) == 'swf'):?>
		<div id="hBox">(<?php echo $IM[0]?>*<?php echo $IM[1]?>px / <?php echo getSizeFormat(filesize($pwd.getUTFtoKR($file)),1)?>)
		<div style="text-align:center;"><embed src="<?php echo $g['url_root'].'/'.str_replace('./','',$pwd).$file?>"></embed></div></div>
		<?php else:?>
		<div id="hBox" style="cursor:hand;background:url('<?php echo $g['url_root'].'/'.str_replace('./','',$pwd).$file?>') center center no-repeat;" onclick="imgOrignWin('<?php echo $g['url_root'].'/'.str_replace('./','',$pwd).$file?>');">(<?php echo $IM[0]?>*<?php echo $IM[1]?>px / <?php echo getSizeFormat(filesize($pwd.getUTFtoKR($file)),1)?>)</div>
		<?php endif?>



		</form>



		<?php else:?>



		<div class="title">
			<div class="xleft">
				파일편집
			</div>
			<div class="xright">
				<a href="<?php echo $g['adm_href']?>&amp;pwd=<?php echo $pwd?>">목록</a>
			</div>
		</div>

		<div class="notice">
			파일을 편집한 후 확인버튼을 클릭하면 실시간으로 사용자페이지에 적용됩니다.<br />
			편집전에는 가급적 백업해 주세요.
			<span>
			(<input type="checkbox" id="backupcheck" value="1" />백업하기 - 
			<?php if(is_file($g['path_tmp'].'backup/'.str_replace('/','_',str_replace('./','',$pwd).getUTFtoKR($file)).'.bak')):?>
			최근백업 : <script type="text/javascript">getDateFormat('<?php echo date('YmdHis',filectime($g['path_tmp'].'backup/'.str_replace('/','_',str_replace('./','',$pwd).getUTFtoKR($file)).'.bak'))?>','xxxx.xx.xx xx:xx');</script>
			<a href="#." onclick="getBackCode();">복원</a>
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;iframe=<?php echo $iframe?>&amp;a=backup_delete&amp;folder=<?php echo $pwd?>&amp;oldfile=<?php echo $file?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('최근백업본을 삭제하시겠습니까?');">삭제</a>
			<?php else:?>
			백업하시면 소스복원이 가능합니다
			<?php endif?>
			)
			</span>
		</div>
		
		<div id="editform">
		<form action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return fileEditCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $module?>" />
		<input type="hidden" name="a" value="file_edit" />
		<input type="hidden" name="folder" value="<?php echo $pwd?>" />
		<input type="hidden" name="oldfile" value="<?php echo $file?>" />
		<input type="hidden" name="backup" value="" />
		<input type="hidden" name="iframe" value="<?php echo $iframe?>" />

		<table>
			<tr>
				<td class="td1">파일위치</td>
				<td class="td2 b">
					<?php echo $pwd?>
				</td>
			</tr>
			<tr>
				<td class="td1">파일이름</td>
				<td class="td2">
					<input type="text" name="newfile" class="input" value="<?php echo $file?>" />
					<input type="submit" class="btnblue" value=" 수 정 " />

					<select onchange="backChange(this.value);">
					<option value="">배경</option>
					<option value="1">흰색</option>
					<option value="2">검정</option>
					<option value="3">파랑</option>
					</select>
					<img src="<?php echo $g['img_module_admin']?>/btn_full.gif" alt="전체화면으로 편집" id="fullimg" class="resizeimg hand" onclick="editBoxcontrol(this);" />
				</td>
			</tr>
		</table>

		<div id="editbox" class="editdiv">
			<textarea id="editboxarea" name="content"><?php echo @htmlspecialchars(implode('',file($pwd.getUTFtoKR($file))))?></textarea>
		</div>


		</form>
		</div>

		<form name="srcForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $module?>" />
		<input type="hidden" name="a" value="file_resque" />
		<input type="hidden" name="folder" value="<?php echo $pwd?>" />
		<input type="hidden" name="oldfile" value="<?php echo $file?>" />
		<input type="hidden" name="iframe" value="<?php echo $iframe?>" />
		</form>
			
		<script type="text/javascript">
		//<![CDATA[
		function setStart()
		{
			backChange(getCookie('EditBackColor'));
			if (getId('fullimg').src.indexOf('btn_full') != -1)
			{
				var ofs = getOfs(getId('catinfo')); 
				getId('editboxarea').style.width = (parseInt(ofs.width)-50) + 'px';
			}
		}
		setStart();
		window.onresize = setStart;
		//]]>
		</script>

		<?php endif?>

		<?php else:?>

		<div class="listtop">
			<div class="l">
				<a href="<?php echo $g['adm_href']?>"><img src="<?php echo $g['img_module_admin']?>/pre_dir.gif" alt="처음으로" /></a>
				<span><?php echo $pwd?></span>
			</div>
			<div class="r">
				<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;iframe=<?php echo $iframe?>&amp;a=folder_delete&amp;folder=<?php echo $pwd?>" onclick="return confirm('사용중인 관련폴더나 파일을 삭제할 경우 심각한 문제가 발생할 수 있습니다.\n\n그래도 현재폴더와 하위파일들을 모두 삭제하시겠습니까?');"><img src="<?php echo $g['img_module_admin']?>/mk_del.gif" alt="폴더삭제" /></a>
				<a href="<?php echo $g['adm_href']?>&amp;folderadd=Y&amp;pwd=<?php echo $pwd?>"><img src="<?php echo $g['img_module_admin']?>/mk_dir.gif" alt="새폴더" /></a>
				<a href="<?php echo $g['adm_href']?>&amp;fileadd=Y&amp;pwd=<?php echo $pwd?>"><img src="<?php echo $g['img_module_admin']?>/mk_file.gif" alt="새파일" /></a>
				<a href="<?php echo $g['adm_href']?>&amp;fileupload=Y&amp;pwd=<?php echo $pwd?>"><img src="<?php echo $g['img_module_admin']?>/mk_up.gif" alt="파일첨부" /></a>
			</div>
		</div>


		<?php
		$files1 = array();
		$dirs = opendir($pwd);
		$i=0;
		while(false !== ($tpl = readdir($dirs)))
		{
			if(!is_file($pwd.$tpl)) continue;
			$files[] = $tpl;
			$i++;
		}
		closedir($dirs);
		$p = $p ? $p : 1;
		$recnum = 25;
		$filenum = count($files);
		$TPG = intval(($filenum)/$recnum)+1;
		?>


		<form name="listForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $module?>" />
		<input type="hidden" name="a" value="" />
		<input type="hidden" name="folder" value="<?php echo $pwd?>" />
		<input type="hidden" name="iframe" value="<?php echo $iframe?>" />


		<table class="ftable">
			<tr class="sbj">
				<td width="20"><img src="<?php echo $g['img_core']?>/_public/ico_check_01.gif" alt="선택/반전" class="hand" onclick="chkFlag('members[]');" /></td>
				<td width="40">번호</td>
				<td>파일명</td>
				<td width="70">소유자</td>
				<td width="70">퍼미션</td>
				<td width="70">용량</td>
				<td width="70">크기(px)</td>
				<td width="55">&nbsp;</td>
			</tr>
			<?php $j=0;for($i=($p-1)*$recnum;$i<=($p-1)*$recnum+$recnum-1;$i++):if ($files[$i]):$j++?>
			<?php $file_ext=strtolower(getExt($files[$i]))?>
			<?php $file_ext=strlen($file_ext)<5?$file_ext:'txt'?>
			<?php $IM=array();if(strstr('jpeg,jpg,gif,png,swf',strtolower($file_ext)))$IM=getimagesize($tdir.$files[$i])?>

			<tr class="loop">
				<td><input type="checkbox" name="members[]" value="<?php echo getKRtoUTF($files[$i])?>" /></td>
				<td><?php echo ($filenum-$i)?></td>
				<td class="code">
					<img src="<?php echo $g['img_core']?>/file/small/<?php echo is_file($g['path_core'].'image/file/small/'.$file_ext.'.gif')?$file_ext:'unknown'?>.gif" alt="<?php echo $file_ext?>" />
					<a href="<?php echo $g['adm_href']?>&amp;editmode=Y&amp;pwd=<?php echo $pwd?>&amp;file=<?php echo getKRtoUTF($files[$i])?>"<?php if(strstr('jpeg,jpg,gif,png,swf',$file_ext)):?> onmouseover="imgShow('<?php echo $tdir?>',this,<?php echo $IM[0]?>,event);" onmouseout="imgHide();"<?php endif?> title="<?php echo getKRtoUTF($files[$i])?>"><?php echo getFILEname($files[$i])?></a>
				</td>
				<td><?php echo getFileuser($tdir.$files[$i],4)?></td>
				<td><?php echo getPermision($tdir.$files[$i])?></td>
				<td><?php echo getSizeFormat(filesize($tdir.$files[$i]),1)?></td>
				<td>
					<?php if($IM[0]):?><?php echo $IM[0]?>*<?php echo $IM[1]?><?else:?>&nbsp;<?php endif?>
				</td>
				<td>
					<?php if(strstr('php,css,js,txt,cache',$file_ext)):?>
					<span class="btn02"><a href="<?php echo $g['adm_href']?>&amp;editmode=Y&amp;pwd=<?php echo $pwd?>&amp;file=<?php echo getKRtoUTF($files[$i])?>">편집</a></span>
					<?php elseif(strstr('jpeg,jpg,gif,png',$file_ext)):?>
					<span class="btn01"><a href="#." onclick="imgOrignWin('<?php echo $g['url_root']?>/<?php echo $tdir.getKRtoUTF($files[$i])?>');">보기</a></span>
					<?php elseif(strstr('swf',$file_ext)):?>
					<span class="btn01"><a href="#." onclick="window.open('<?php echo $g['url_root']?>/<?php echo $tdir.getKRtoUTF($files[$i])?>','','width=<?php echo $IM[0]?>px,height=<?php echo $IM[1]?>px,left=0,top=0,status=yes,scrolling=no,resizable=yes');">보기</a></span>
					<?else:?>
					&nbsp;
					<?php endif?>
				</td>
			</tr>
			<?php endif;endfor?>
			<?php if(!$j):?>
			<tr class="none">
				<td colspan="8">선택된 폴더내에 파일이 없습니다.</td>
			</tr>
			<?php endif?>
		</table>

		
		<div class="page">
			<div class="pagebox01">
			<script type="text/javascript">getPageLink(10,<?php echo $p?>,<?php echo $TPG?>,'<?php echo $g['img_core']?>/page/default');</script>
			</div>
		</div>
		<div class="prebox">
			<input type="button" class="btngray" value="선택/해제" onclick="chkFlag('members[]');" /> 
			<input type="button" class="btnblue" value="삭제" onclick="actQue('files_delete');" /> 
		</div>


		</form>

		<?php endif?>


		



	</div>
	<div class="clear"></div>
</div>


<div id="hImg"></div>





<?php if($iframe == 'Y'):?>
<script type="text/javascript">
//<![CDATA[
function windowSetting()
{
	document.title = '킴스큐-Rb 파일메니져';
	getId('catebody').style.padding = '10px';
	top.resizeTo(950,700);
}
window.onload = windowSetting;
//]]>
</script>
<?php endif?>
