<?
include_once $g['dir_module_skin'].'libs/function.php';

$step_start = 1;
$pwd_start = './files/';
$pwd = $pwd ? urldecode($pwd) : $pwd_start;
$tdir = str_replace('./','',$pwd);
$g['adm_href'] = $g['s'].'/?r='.$r.'&amp;m=setting&amp;mod=master&amp;div=image&amp;winmod='.$winmod;

if (strstr($pwd,'..')){
    getLink($g['adm_href'],'','더이상 접근권한이 없는 디렉토리입니다.','');
}
if(!is_dir($pwd)){
	getLink('','','존재하지 않는 폴더입니다.','-1');
}

$set1 = array(
	'layouts'=>'레이아웃',
	'modules'=>'모듈',
	'widgets'=>'위젯',
	'pages'=>'페이지',
	'files'=>'첨부파일',
	'switchs'=>'스위치'
);
?>

<div id="image">
	<table class="tbl-none">
	<tr>
		<td class="dir"><? // 디릭토리 목록 ?>

			<div class="title">
				<div style="float:left;"><a href="<?=$g['adm_href']?>">디렉토리</a></div>
				<?if(!$winmod){?><div style="float:right;"><input type="button" class="btnkhaki" value="창모드" onclick="OpenWindow('<?=$g['s']?>/?r=<?=$r?>&amp;m=<?=$m?>&amp;mod=master&amp;div=<?=$div?>&amp;winmod=Y');"></div><?}?>
				<div class="clear"></div>
			</div>

			<div class="tree">
				<div class="dir01">
					<img src="<?=$g['img_module_skin']?>/blank.gif" width="3" height="1" alt="">
					<a href="<?=$g['adm_href']?>" title="..">
						<img src="<?=$g['img_module_skin']?>/close_dir.gif" alt=""> <span class="<?=$pwd == './files/' ? 'nowdir' : 'alldir'?>">/ 디렉토리 (최상위)</span>
					</a>
				</div>
			<?php getDirlist($pwd_start,$step_start)?>
			</div>

		</td>
		<td class="file"><? // 게시판 본문 관리 ?>
		<?if($fileupload == 'Y'){		// 파일업로드?>
		<?
			$agopwd = '';
			$pwdexp = explode('/',$pwd);
			$pwdlen = count($pwdexp)-2;
			for($i=0;$i<$pwdlen;$i++) $agopwd .= $pwdexp[$i].'/';
			$agopwd = $agopwd ? $agopwd : './';
			$latpwd = $pwdexp[$pwdlen];
		?>
			<div class="title">
				<div class="xleft">파일 업로드</div>
				<div class="xright"><a href="<?php echo $g['adm_href']?>&amp;pwd=<?php echo $pwd?>">목록</a></div>
				<div class="clear"></div>
			</div>
			<div class="notice">
				이미지/플래쉬파일만 첨부가능합니다. <span style="b">보기) jpg,jpeg,gif,png,swf</span><br />
				파일명에 한글이 포함되어 있을 경우 정상적으로 출력되지 않을 수 있습니다.<br />
				이미 같은이름으로 파일이 존재할 경우 덧씌워집니다.</br />
				첨부폴더는 지정된 경로와 그 안의 폴더들을 선택할 수 있습니다.<br />
				폴더를 선택하지 않으면 지정된 경로에 업로드됩니다.<br />
			</div>
			<form name="upForm" action="<?php echo $g['s']?>/" method="post" onsubmit="return folderCheck(this);">
			<input type="hidden" name="r" value="<?=$r?>" />
			<input type="hidden" name="a" value="<?=$mod?>" />
			<input type="hidden" name="m" value="<?=$m?>" />
			<input type="hidden" name="mod" value="<?=$mod?>" />
			<input type="hidden" name="div" value="<?=$div?>" />
			<input type="hidden" name="winmod" value="<?=$winmod?>" />

			<input type="hidden" name="module" value="<?php echo $module?>" />
			<input type="hidden" name="pwd" value="<?php echo $pwd?>" />
			<input type="hidden" name="folder" value="<?php echo $pwd?>" />
			<input type="hidden" name="fileupload" value="<?php echo $fileupload?>" />
			<input type="hidden" name="actid" value="folder_add" />

			<div class="row" style="padding-left:20px;">
				첨부폴더 :
				<span><?=$pwd?></span>
				<select name="pwd1" style="padding:2px;margin:1px;" onchange="this.form.submit();">
					<option value=""></option>
					<? $dirs = opendir($pwd); ?>
					<? while(false !== ($tpl = readdir($dirs))){?>
					<? if($tpl=='.' || $tpl == '..' || is_file($pwd.$tpl)) continue?>
					<? if($pwd == './files/' && $tpl != $wSet['id'] && $tpl != 'def') continue;?>
					<option value="<?=$tpl?>"<? if($pwd1==$tpl){?> selected="selected"<?}?>><?=$tpl?></option>
					<? } ?>
					<?closedir($dirs);?>
				</select>
				<?if($pwd != './files/'){?>
				&lt;-
				<input type="text" name="newfolder" value="" size="15" class="input" />
				<input type="submit" value="새 폴더 추가" class="btngray" />
				<?}?>
			</div>
			</form>

			<div style="padding-left:20px;">
				<script type="text/JavaScript" src="<?php echo $g['url_root']?>/_core/lib/swfupload.js" charset="utf-8"></script>
				<script type="text/javascript">
				var save_Path = document.upForm.folder.value + (document.upForm.pwd1.value != '' ? document.upForm.pwd1.value + '/' : '');
				var object_Id = 'kimsqSwfuploader';
				var limitSize = '<?php echo str_replace('M','',ini_get('upload_max_filesize'))*1024*1024?>';
				var flashFile = '<?php echo $g['url_root']?>/_core/lib/swfupload.swf';
				var quploader = '../../index.php';
				var qupload_m = 'setting';
				var qupload_a = 'uploadimage';
				var sess_Code = '1';
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

			<div class="submitbox">
				<input type="button" class="btngray" value=" 취 소 " onclick="<?if($winmod=='Y'){?>top.close();<?}else{?>goHref('<?=$g['adm_href']?>&amp;pwd=<?=$pwd?>');<?}?>" />
				<input type="button" class="btnblue" value=" 확 인 " onclick="callSwfUpload();" />
			</div>

		<?}else if($editmode == 'Y'){	// 파일 변경/편집?>
			<? if(!is_file($pwd.getUTFtoKR($file))) getLink('','','존재하지 않는 파일입니다.','-1'); ?>
			<? if(strstr('jpeg,jpg,gif,png,swf,ico',strtolower(getExt($file)))){?>
				<? $IM=getimagesize($pwd.getUTFtoKR($file)); ?>
		
			<div class="title">
				<div class="xleft">파일 변경하기</div>
				<div class="xright"><a href="<?php echo $g['adm_href']?>&amp;pwd=<?php echo $pwd?>">목록</a></div>
				<div class="clear"></div>
			</div>
			<div class="notice">
				파일을 업로드할 경우 업로드된 파일로 변경됩니다.<br />
				파일명은 기존 파일명(<?php echo $file?>)으로 고정됩니다.
			</div>

			<form action="<?php echo $g['s']?>/" method="post" enctype="multipart/form-data" target="_action_frame_<?php echo $m?>" onsubmit="return imgModifyCheck(this);">
			<input type="hidden" name="r" value="<?=$r?>" />
			<input type="hidden" name="a" value="<?=$mod?>" />
			<input type="hidden" name="m" value="<?=$m?>" />
			<input type="hidden" name="mod" value="<?=$mod?>" />
			<input type="hidden" name="div" value="<?=$div?>" />
			<input type="hidden" name="winmod" value="<?=$winmod?>" />

			<input type="hidden" name="folder" value="<?php echo $pwd?>" />
			<input type="hidden" name="oldfile" value="<?php echo $file?>" />
			<input type="hidden" name="fileext" value="<?php echo getExt($file)?>" />
			<input type="hidden" name="actid" value="upfile_modify" />

			<div class="row" style="text-align:center;">
				파일선택 : 
				<input type="file" name="upfile" class="upfile" />
				<input type="submit" class="btnblue" value=" 확인 " />
			</div>

			<div class="row" style="padding:20px;text-align:center;">
				<?if(getExt($file) == 'swf'){?>
				<div class="hBox">(<?php echo $IM[0]?>*<?php echo $IM[1]?>px / <?php echo getSizeFormat(filesize($pwd.getUTFtoKR($file)),1)?>)
				<div style="text-align:center;"><embed src="<?php echo $g['url_root'].'/'.str_replace('./','',$pwd).$file?>"></embed></div></div>
				<?}else{?>
				<div class="hBox" style="cursor:hand;background:url('<?php echo $g['url_root'].'/'.str_replace('./','',$pwd).$file?>') center center no-repeat;" onclick="imgOrignWin('<?php echo $g['url_root'].'/'.str_replace('./','',$pwd).$file?>');">(<?php echo $IM[0]?>*<?php echo $IM[1]?>px / <?php echo getSizeFormat(filesize($pwd.getUTFtoKR($file)),1)?>)</div>
				<?}?>
			</div>
			</form>
			
			<?}else{	// if(strstr('jpeg,jpg,gif,png,swf,ico',strtolower(getExt($file)))){?>

			<div class="title">
				<div class="xleft">파일편집</div>
				<div class="xright"><a href="<?php echo $g['adm_href']?>&amp;pwd=<?php echo $pwd?>">목록</a></div>
				<div class="clear"></div>
			</div>
			<div class="notice">파일 편집 후 수정 버튼을 클릭하세요.</div>

			<form action="<?php echo $g['s']?>/" method="post" enctype="multipart/form-data" target="_action_frame_<?php echo $m?>">
			<input type="hidden" name="r" value="<?=$r?>" />
			<input type="hidden" name="a" value="<?=$mod?>" />
			<input type="hidden" name="m" value="<?=$m?>" />
			<input type="hidden" name="mod" value="<?=$mod?>" />
			<input type="hidden" name="div" value="<?=$div?>" />
			<input type="hidden" name="winmod" value="<?=$winmod?>" />

			<input type="hidden" name="folder" value="<?php echo $pwd?>" />
			<input type="hidden" name="oldfile" value="<?php echo $file?>" />
			<input type="hidden" name="fileext" value="<?php echo getExt($file)?>" />
			<input type="hidden" name="actid" value="file_edit" />

			<div class="edt">
				<div class="row">
					<div style="float:left;padding-left:12px;"><?=$file?></div>
					<div style="float:right;"><input type="submit" class="btnblue" value=" 수정 " /></div>
					<div class="clear"></div>
				</div>
				<link rel="stylesheet" href="<?=$g['s']?>/_core/com/codemirror/codemirror.css">
				<script src="<?=$g['s']?>/_core/com/codemirror/codemirror.js"></script>
				<script src="<?=$g['s']?>/_core/com/codemirror/css.js"></script>
				<script src="<?=$g['s']?>/_core/com/codemirror/matchbrackets.js"></script>
				<script src="<?=$g['s']?>/_core/com/codemirror/htmlmixed.js"></script>
				<script src="<?=$g['s']?>/_core/com/codemirror/xml.js"></script>
				<script src="<?=$g['s']?>/_core/com/codemirror/javascript.js"></script>
				<script src="<?=$g['s']?>/_core/com/codemirror/clike.js"></script>
				<script src="<?=$g['s']?>/_core/com/codemirror/php.js"></script>
				<div class="view"><textarea id="codemr" name="content"><?=htmlspecialchars(implode('',file($pwd.$file)))?></textarea></div>
				<script type="text/javascript">var editor = CodeMirror.fromTextArea(document.getElementById("codemr"), {matchBrackets: true,mode: "application/x-httpd-php",indentUnit: 4,indentWithTabs: true,enterMode: "keep",tabMode: "shift", lineNumbers: true});</script>
			</div>
			
			</form>

			<?}?>
		

		<?}else{?>
			<div class="listtop">
				<div class="l">
					<a href="<?=$g['adm_href']?>"><img src="<?=$g['img_module_skin']?>/pre_dir.gif" alt="처음으로" /></a>
					<span><?=str_replace($pwd_start,'',$pwd)?></span>
				</div>
				<div class="r">
					<a href="<?=$g['adm_href']?>&amp;a=master&amp;actid=folder_delete&amp;folder=<?php echo $pwd?>" onclick="return confirm('사용중인 관련폴더나 파일을 삭제할 경우 심각한 문제가 발생할 수 있습니다.\n\n그래도 현재폴더와 하위파일들을 모두 삭제하시겠습니까?');"><img src="<?=$g['img_module_skin']?>/mk_del.gif" alt="폴더삭제" /></a>
					<a href="<?=$g['adm_href']?>&amp;fileupload=Y&amp;pwd=<?php echo $pwd?>"><img src="<?=$g['img_module_skin']?>/mk_up.gif" alt="파일첨부" /></a>
				</div>
			</div>
		<?
			$files1 = array();
			$dirs = opendir($pwd);
			$i=0;
			while(false !== ($tpl = readdir($dirs)))
			{
				if(!is_file($pwd.$tpl)) continue;
				$files[] = $tpl;
				$i++;
			}
			if($files)	sort($files);
			closedir($dirs);
			$p = $p ? $p : 1;
			$recnum = 20;
			$filenum = count($files);
			$TPG = intval(($filenum)/$recnum)+1;
		?>
			<form name="listForm" method="post" action="<?=$g['s']?>/" target="_action_frame_<?=$m?>">
			<input type="hidden" name="r" value="<?=$r?>" />
			<input type="hidden" name="m" value="<?=$m?>" />
			<input type="hidden" name="a" value="<?=$mod?>" />
			<input type="hidden" name="mod" value="<?=$mod?>" />
			<input type="hidden" name="div" value="<?=$div?>" />
			<input type="hidden" name="winmod" value="<?=$winmod?>" />

			<input type="hidden" name="folder" value="<?=$pwd?>" />
			<input type="hidden" name="actid" value="files_delete" />

			<table class="tbl-none flst">
			<colgroup>
			<col width="20">
			<col width="40">
			<col>
			<col width="70">
			<col width="70">
			<col width="55">
			</colgroup>
			<tr>
				<td class="th"><img src="<?php echo $g['img_core']?>/_public/ico_check_01.gif" alt="선택/반전" class="hand" onclick="chkFlag('members[]');" /></td>
				<td class="th">번호</td>
				<td class="th">파일명</td>
				<td class="th">용량</td>
				<td class="th">크기(px)</td>
				<td class="th">&nbsp;</td>
			</tr>
			<?php $j=0;for($i=($p-1)*$recnum;$i<=($p-1)*$recnum+$recnum-1;$i++):if ($files[$i]):$j++?>
			<?php $file_ext=strtolower(getExt($files[$i]))?>
			<?php $file_ext=strlen($file_ext)<5?$file_ext:'txt'?>
			<?php $IM=array();if(strstr('jpeg,jpg,gif,png,swf,ico',strtolower($file_ext)))$IM=getimagesize($tdir.$files[$i])?>

			<tr>
				<td class="tc c"><input type="checkbox" name="members[]" value="<?php echo getKRtoUTF($files[$i])?>" /></td>
				<td class="tc c"><?php echo ($filenum-$i)?></td>
				<td class="tc">
					<img src="<?php echo $g['img_core']?>/file/small/<?php echo is_file($g['path_core'].'image/file/small/'.$file_ext.'.gif')?$file_ext:'unknown'?>.gif" alt="<?php echo $file_ext?>" />
					<a href="<?php echo $g['adm_href']?>&amp;editmode=Y&amp;pwd=<?php echo $pwd?>&amp;file=<?php echo getKRtoUTF($files[$i])?>"<?php if(strstr('jpeg,jpg,gif,png,swf,ico',$file_ext)):?> onmouseover="imgShow('<?=$tdir?>',this,<?=$IM[0]?>,event);" onmouseout="imgHide();"<?php endif?> title="<?php echo getKRtoUTF($files[$i])?>"><?php echo getFILEname($files[$i])?></a>
				</td>
				<td class="tc r"><?php echo getSizeFormat(filesize($tdir.$files[$i]),1)?></td>
				<td class="tc c">
					<?php if($IM[0]):?><?php echo $IM[0]?>*<?php echo $IM[1]?><?else:?>&nbsp;<?php endif?>
				</td>
				<td class="tc">
					<?php if(strstr('php,css,js,txt,cache',$file_ext)):?>
					<input type="button" class="btnkhaki" value="편집" onclick="goHref('<?php echo $g['adm_href']?>&amp;editmode=Y&amp;pwd=<?php echo $pwd?>&amp;file=<?php echo getKRtoUTF($files[$i])?>');">
					<?php elseif(strstr('jpeg,jpg,gif,png,ico',$file_ext)):?>
					<input type="button" class="btnnavy" value="보기" onclick="imgOrignWin('<?php echo $g['url_root']?>/<?php echo $tdir.getKRtoUTF($files[$i])?>');">
					<?php elseif(strstr('swf',$file_ext)):?>
					<input type="button" class="btnnavy" value="보기" onclick="window.open('<?php echo $g['url_root']?>/<?php echo $tdir.getKRtoUTF($files[$i])?>','','width=<?php echo $IM[0]?>px,height=<?php echo $IM[1]?>px,left=0,top=0,status=yes,scrolling=no,resizable=yes');">
					<?else:?>
					&nbsp;
					<?php endif?>
				</td>
				</tr>
				<?php endif;endfor?>
				<?php if(!$j):?>
				<tr>
					<td class="tc c" colspan="6">선택된 폴더내에 파일이 없습니다.</td>
				</tr>
				<?php endif?>
			</table>

			<div class="pagerbox">
				<div class="pagebox01">
				<script type="text/javascript">getPageLink(10,<?php echo $p?>,<?php echo $TPG?>,'<?php echo $g['img_core']?>/page/default');</script>
				</div>
			</div>
			<div class="submitbox">
				<input type="button" class="btndark btnsz02" value="선택/해제" onclick="chkFlag('members[]');" /> 
				<input type="button" class="btnred btnsz01" value="삭제" onclick="actQue();" /> 
			</div>
			</form>

		<?}?>
		</td>
	</tr>
	</table>
	
	<div id="hImg"></div>
</div>

<?if($winmod){?>
<script type="text/javascript">
//<![CDATA[
function windowSetting()
{
	document.title = '이미지 업로드 메니저';
	top.resizeTo(950,830);
}
window.onload = windowSetting;	
//]]>
</script>
<?}?>
