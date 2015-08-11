


<div id="catebody">
	<div id="category">

		<div class="title">
			<span class="add">
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=market&amp;front=pack&amp;type=layout" title="레이아웃 추가"><img src="<?php echo $g['img_core']?>/_public/btn_add.gif" alt="" /></a>
			</span>
			레이아웃 리스트
		</div>
		
		<table>
		
		<?php $layout = $layout ? $layout : dirname($_HS['layout'])?>
		<?php $sublayout = $sublayout ? $sublayout : 'main.php'?>
		<?php $type = $type ? $type : 'layout'?>
		<?php $dirs = opendir($g['path_layout'])?>
		<?php while(false !== ($tpl = readdir($dirs))):?>
		<?php if($tpl=='.' || $tpl == '..' || $tpl == '_blank' || is_file($g['path_layout'].$tpl))continue?>
		<?php $dirs1 = opendir($g['path_layout'].$tpl)?>
		
		<tr class="layout1">
		<td class="ltd">
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=filemanager&amp;pwd=<?php echo urlencode($g['path_layout'].$tpl.'/')?>" target="_blank"><img src="<?php echo $g['img_core']?>/_public/ico_folder_02.gif" alt="폴더열기" title="폴더열기" /></a>
			<a href="<?php echo $g['adm_href']?>&amp;layout=<?php echo $tpl?>" class="<?php if($tpl==$layout):?> on<?php endif?>"><?php echo getFolderName($g['path_layout'].$tpl)?></a>
			<span>(<?php echo $tpl?>)</span>
		</td>
		<td class="rtd">
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&a=layout_delete&killlayout=<?php echo $tpl?>" target="_action_frame_<?php echo $m?>" onclick="return delCheck();"><img src="<?php echo $g['img_core']?>/_public/btn_del_s01.gif" alt="삭제" title="삭제" /></a>
		</td>
		</tr>
		
		<?php if($tpl == $layout):?>
		<tr class="laygap"><td colspan="2"></td></tr>
		<?php while(false !== ($tpl1 = readdir($dirs1))):?>
		<?php if(!strstr($tpl1,'.php') || $tpl1=='_main.php')continue?>
		<tr class="layout2">
		<td class="ltd">
			ㆍ<a href="<?php echo $g['adm_href']?>&amp;layout=<?php echo $tpl?>&amp;sublayout=<?php echo $tpl1?>" class="<?php if($tpl1==$sublayout):?> on<?php endif?>"><?php echo str_replace('.php','',$tpl1)?></a>
		</td>
		<td class="rtd">
			<?php if($tpl1 != 'main.php'):?>
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=layout_delete&amp;layout=<?php echo $tpl?>&amp;sublayout=<?php echo $tpl1?>&amp;type=<?php echo $type?>" target="_action_frame_<?php echo $m?>" onclick="return delCheck();"><img src="<?php echo $g['img_core']?>/_public/btn_del_s01.gif" alt="삭제" title="삭제" /></a>
			<?php endif?>
		</td>
		</tr>
		<?php endwhile?>
		<?php closedir($dirs1)?>
		<tr class="laygap"><td colspan="2"></td></tr>
		<tr class="laygap"><td colspan="2"></td></tr>
		<?php endif?>
		
		<?php endwhile?>
		<?php closedir($dirs)?>

		</table>

	</div>


	<div id="catinfo">


		<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" enctype="multipart/form-data" onsubmit="return saveCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="a" value="layout_update" />
		<input type="hidden" name="m" value="<?php echo $module?>" />
		<input type="hidden" name="layout" value="<?php echo $layout?>" />
		<input type="hidden" name="sublayout" value="<?php echo $sublayout?>" />
		<input type="hidden" name="type" value="<?php echo $type?>" />

		<div class="tab">
			<ul>
			<li<?php if($type=='layout'):?> class="on"<?php endif?>><a href="<?php echo $g['adm_href']?>&amp;layout=<?php echo $layout?>&amp;type=layout">레이아웃코드</a></li>
			<li<?php if($type=='css'):?> class="on"<?php endif?>><a href="<?php echo $g['adm_href']?>&amp;layout=<?php echo $layout?>&amp;type=css">CSS코드</a></li>
			<li<?php if($type=='js'):?> class="on"<?php endif?>><a href="<?php echo $g['adm_href']?>&amp;layout=<?php echo $layout?>&amp;type=js">자바스크립트</a></li>
			<li<?php if($type=='php'):?> class="on"<?php endif?>><a href="<?php echo $g['adm_href']?>&amp;layout=<?php echo $layout?>&amp;type=php">PHP추가코드</a></li>
			<li<?php if($type=='image'):?> class="on"<?php endif?>><a href="<?php echo $g['adm_href']?>&amp;layout=<?php echo $layout?>&amp;type=image">파일저장소</a></li>
			<li><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=filemanager&amp;front=main&amp;pwd=<?php echo urlencode($g['path_layout'].$layout.'/')?>" target="_blank">탐색</a></li>
			</ul>
			<div class="r">
				
				<?php if($type != 'image'):?>
				<select onchange="backChange(this.value);">
				<option value="">배경</option>
				<option value="1">흰색</option>
				<option value="2">검정</option>
				<option value="3">파랑</option>
				</select>
				<img src="<?php echo $g['img_module_admin']?>/btn_full.gif" alt="전체화면으로 편집" class="resizeimg hand" onclick="editBoxcontrol(this);" />
				<?php else:?>

				<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=filemanager&amp;front=main&amp;pwd=<?php echo urlencode($g['path_layout'].$layout.'/'.$type.'/')?>" target="_blank"><img src="<?php echo $g['img_module_admin']?>/pre_dir.gif" alt="폴더보기" title="폴더보기" /></a>
				<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=filemanager&amp;front=main&amp;fileupload=Y&amp;pwd=<?php echo urlencode($g['path_layout'].$layout.'/'.$type.'/')?>" target="_blank"><img src="<?php echo $g['img_module_admin']?>/mk_up.gif" alt="업로드" title="업로드" /></a>
				<?php endif?>

			</div>

		</div>

		<div class="editbox">
			
			<?php if($type == 'image'):?>

			



			<div class="imgarea">
			<?php $i=0?>
			<?php $idir = $g['path_layout'].$layout.'/'.$type.'/'?>
			<?php $dirs = opendir($idir)?>
			<?php while(false !== ($f = readdir($dirs))):?>
			<?php if(!is_file($idir.$f))continue?>
			<?php $fext = getExt($f)?>
			<?php $ftype = getFileType($fext)?>
			

				<div class="imgbox" title="<?php echo $f?>">
					<div class="delbox"><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=layout_delete&amp;layout=<?php echo $layout?>&amp;imgfile=<?php echo $f?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?   ');"><img src="<?php echo $g['img_core']?>/_public/btn_del_s01.gif" alt="삭제" title="삭제" /></a></div>

					<?php if($ftype==2):$isize=getimagesize($idir.$f)?>
					<table><tr><td><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&module=filemanager&front=main&editmode=Y&pwd=<?php echo urlencode($idir)?>&file=<?php echo $f?>" target="_blank"><img src="<?php echo $idir.$f?>" <?php if($isize[0]>$isize[1]):?>width="<?php echo $isize[0]>90?90:$isize[0]?>"<?php else:?>height="<?php echo $isize[1]>90?90:$isize[1]?>"<?php endif?> alt="<?php echo $f?>" /></a></td></tr></table>
					<?php else:?>
					<table><tr><td><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&module=filemanager&front=main&editmode=Y&pwd=<?php echo urlencode($idir)?>&file=<?php echo $f?>" target="_blank"><img src="<?php echo $g['img_core']?>/file/big/<?php echo (is_file($g['path_core'].'image/file/big/'.$fext.'.gif')?$fext:'unknown')?>.gif" alt="<?php echo $f?>" /></a></td></tr></table>
					<?php endif?>
				</div>



			<?php $i++;endwhile?>
			<?php closedir($dirs)?>
			<?php if(!$i):?>
				<div class="noimg"><img src="<?php echo $g['img_core']?>/_public/ico_notice.gif" alt="" /> 파일저장소가 비어있습니다.</div>
			<?php endif?>
			</div>




			<?php else:?>
			<textarea name="code" id="editboxarea"><?php echo htmlspecialchars(@implode('',file($g['path_layout'].$layout.'/'.($type=='layout'?$sublayout:'_main.'.$type))))?></textarea>
			<?php endif?>
		</div>

		<?php if($type != 'image'):?>
		<div id="submitbox" class="submitbox">

			<?php if($type == 'layout'):?>
			<input type="text" name="name" value="<?php echo getFolderName($g['path_layout'].$layout)?>" class="input" />
			의 서브레이아웃 <input type="text" name="subname" size="10" value="<?php echo basename($sublayout,'.php')?>" class="input" />을 
			<?php endif?>
			<input type="submit" class="btnblue" value=" 수정/추가 " />


			<?php if($type == 'layout'):?>
			또는 레이아웃폴더 <input type="text" name="cplayout" size="10" value="" class="input" /> 을 생성 후 현재 레이아웃을 
			<input type="submit" class="btnblue" value=" 복사 " />
			<?php endif?>
		
		</div>
		<?php endif?>

		</form>
		
	</div>
	<div class="clear"></div>
</div>




<script type="text/javascript">
//<![CDATA[
function editBoxcontrol(img)
{
	var fbox = getId('catinfo');
	var ebox = getId('editboxarea');
	var ebox1 = getId('submitbox');
	
	if (img.src.indexOf('btn_full') != -1)
	{
		fbox.style.zIndex = 10000;
		fbox.style.position = 'absolute';
		fbox.style.background = '#ffffff';
		fbox.style.marginLeft = '-20px';
		fbox.style.top = '0';
		fbox.style.left = '0';
		ebox.style.width = (screen.availWidth - 50) + 'px';
		ebox.style.height = (screen.availHeight - 215) + 'px';
		ebox.style.marginLeft = '10px';
		ebox.style.marginRight = '25px';
		ebox1.style.marginLeft = '10px';

		img.src = img.src.replace('btn_full','btn_resize');
		img.alt = '원래화면으로 편집';
	}
	else {
		fbox.style.zIndex = '';
		fbox.style.position = 'relative';
		fbox.style.marginLeft = '220px';
		ebox.style.marginLeft = '0px';
		ebox.style.width = '99%';
		ebox.style.height = '550px';
		ebox.style.marginLeft = '0px';
		ebox.style.marginRight = '0';
		ebox1.style.marginLeft1 = '0px';

		img.src = img.src.replace('btn_resize','btn_full');
		img.alt = '전체화면으로 편집';
	}
}
function backChange(val)
{
	if (val)
	{
		if (val == '1')
		{
			getId('editboxarea').style.background = '#ffffff';
			getId('editboxarea').style.color = '#000000';
		}
		else if(val == '2') {
			getId('editboxarea').style.background = '#222222';
			getId('editboxarea').style.color = '#ffffff';
		}
		else {
			getId('editboxarea').style.background = '#085388';
			getId('editboxarea').style.color = '#ffffff';
		}
		setCookie('EditBackColor',val,1);
		val = '';
	}
}
function saveCheck(f)
{
	if (f.name.value == '')
	{
		alert('레이아웃명칭을 입력해 주세요.  ');
		f.name.focus();
		return false;
	}
	if (f.subname.value == '')
	{
		alert('서브 레이아웃명칭을 입력해 주세요.  ');
		f.subname.focus();
		return false;
	}
	if (!chkIdValue(f.subname.value))
	{
		alert('서브 레이아웃명은 영문소문자/숫자만 사용할 수 있습니다.  ');
		f.subname.value = '';
		f.subname.focus();
		return false;
	}
	if (f.cplayout.value != '')
	{
		if (!chkIdValue(f.cplayout.value))
		{
			alert('복사할 레이아웃 폴더명은 영문소문자/숫자만 사용할 수 있습니다.  ');
			f.cplayout.value = '';
			f.cplayout.focus();
			return false;
		}
	}
}
function delCheck()
{
	if (confirm('삭제된 레이아웃은 복구가 불가능합니다.\n현재 사용중인 레이아웃이라면 절대로 삭제하지 마세요.\n\n그래도 삭제하시겠습니까?'))
	{
		if (confirm('실수로 인한 삭제를 막기위해 다시한번 확인합니다.\n\n정말로 삭제하시겠습니까?       '))
		{
			return true;
		}
	}
	return false;
}

<?php if($type != 'image'):?>
function setStart()
{
	backChange(getCookie('EditBackColor'));
	var ofs = getOfs(getId('catinfo')); 
	getId('editboxarea').style.width = (parseInt(ofs.width)-32) + 'px';
}
setStart();
window.onresize = setStart;
<?php endif?>
//]]>
</script>



