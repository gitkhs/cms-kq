<?php
include_once $g['path_module'].$module.'/var/var.php';
?>

<div id="configbox">

	<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="m" value="<?php echo $module?>" />
	<input type="hidden" name="a" value="config" />

	<div class="title">
		트랙백 환경설정
	</div>

	<table>
		<tr>
			<td class="td1">
				트랙백테마
				<img src="<?php echo $g['img_core']?>/_public/ico_q.gif" alt="도움말" title="도움말" class="hand" onclick="layerShowHide('guide_skin','block','none');" />
			</td>
			<td class="td2">
				
				<select name="skin_main" class="select1">
				<option value="">&nbsp;+ 선택하세요</option>
				<option value="">--------------------------------</option>
				<?php $tdir = $g['path_module'].$module.'/theme/'?>
				<?php $dirs = opendir($tdir)?>
				<?php while(false !== ($skin = readdir($dirs))):?>
				<?php if($skin=='.' || $skin == '..' || is_file($tdir.$skin))continue?>
				<option value="<?php echo $skin?>" title="<?php echo $skin?>"<?php if($d['trackback']['skin_main']==$skin):?> selected="selected"<?php endif?>>ㆍ<?php echo getFolderName($tdir.$skin)?>(<?php echo $skin?>)</option>
				<?php endwhile?>
				<?php closedir($dirs)?>
				</select>
				<div id="guide_skin" class="guide hide">
				지정된 테마는 트랙백리스트 출력시에 적용됩니다.<br />
				적용할 트랙백테마를 지정해 주세요.
				</div>
			</td>
		</tr>
		<tr>
			<td class="td1 m">
				(모바일테마)
			</td>
			<td class="td2">
				
				<select name="skin_mobile" class="select1">
				<option value="">&nbsp;+ 선택하세요</option>
				<option value="">--------------------------------</option>
				<?php $tdir = $g['path_module'].$module.'/theme/'?>
				<?php $dirs = opendir($tdir)?>
				<?php while(false !== ($skin = readdir($dirs))):?>
				<?php if($skin=='.' || $skin == '..' || is_file($tdir.$skin))continue?>
				<option value="<?php echo $skin?>" title="<?php echo $skin?>"<?php if($d['trackback']['skin_mobile']==$skin):?> selected="selected"<?php endif?>>ㆍ<?php echo getFolderName($tdir.$skin)?>(<?php echo $skin?>)</option>
				<?php endwhile?>
				<?php closedir($dirs)?>
				</select>
			</td>
		</tr>

		<tr>
			<td class="td1">보내기권한</td>
			<td class="td2">
				<select name="perm_write" class="select1">
				<option value="0">&nbsp;+ 전체허용</option>
				<option value="0">--------------------------------</option>
				<?php $_LEVEL=getDbArray($table['s_mbrlevel'],'','*','uid','asc',0,1)?>
				<?php while($_L=db_fetch_array($_LEVEL)):?>
				<option value="<?php echo $_L['uid']?>"<?php if($_L['uid']==$d['trackback']['perm_write']):?> selected="selected"<?php endif?>>ㆍ<?php echo $_L['name']?>(<?php echo number_format($_L['num'])?>) 이상</option>
				<?php if($_L['gid'])break; endwhile?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="td1">엮인글출력수</td>
			<td class="td2">
				<input type="text" name="recnum" value="<?php echo $d['trackback']['recnum']?>" size="5" class="input" />개
			</td>
		</tr>

	</table>





	<div class="submitbox">
		<input type="submit" class="btnblue" value=" 확인 " />
	</div>

	</form>

</div>




<script type="text/javascript">
//<![CDATA[
function saveCheck(f)
{
	if (f.skin_main.value == '')
	{
		alert('대표테마를 선택해 주세요.       ');
		f.skin_main.focus();
		return false;
	}
	if (f.skin_mobile.value == '')
	{
		alert('모바일테마를 선택해 주세요.       ');
		f.skin_mobile.focus();
		return false;
	}

	return confirm('정말로 실행하시겠습니까?         ');
}
//]]>
</script>


