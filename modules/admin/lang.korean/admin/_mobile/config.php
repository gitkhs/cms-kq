
<div id="configbox">


	<form name="procForm" action="<?php echo $g['s']?>/" method="post" onsubmit="return saveCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="m" value="<?php echo $module?>" />
	<input type="hidden" name="a" value="config" />
	<input type="hidden" name="version" value="<?php echo $d['admin']['version']?>" />

	<input type="hidden" name="ssl_type" value="<?php echo $d['admin']['ssl_type']?>" />
	<input type="hidden" name="ssl_port" value="<?php echo $d['admin']['ssl_port']?>" />
	<input type="hidden" name="ssl_menu" value="<?php echo $d['admin']['ssl_menu']?>" />
	<input type="hidden" name="ssl_page" value="<?php echo $d['admin']['ssl_page']?>" />
	<input type="hidden" name="ssl_bbs" value="<?php echo $d['admin']['ssl_bbs']?>" />
	<input type="hidden" name="ssl_module" value="<?php echo $d['admin']['ssl_module']?>" />
	<input type="hidden" name="http_port" value="<?php echo $d['admin']['http_port']?>" />

	<div class="title">
		시스템 테마
	</div>

	<table>
		<tr>
			<td class="td1">관리자테마</td>
			<td class="td2">
				
				<select name="themepc" class="select1">
				<option value="">&nbsp;+ 선택하세요</option>
				<option value="">------------------------------------</option>
				<?php $dirs = opendir($g['dir_module'].'lang.'.$_HS['lang'].'/theme/_pc')?>
				<?php while(false !== ($tpl = readdir($dirs))):?>
				<?php if($tpl=='.' || $tpl == '..')continue?>
				<option value="<?php echo $tpl?>"<?php if($d['admin']['themepc']==$tpl):?> selected="selected"<?php endif?>>ㆍ<?php echo getFolderName($g['dir_module'].'lang.'.$_HS['lang'].'/theme/_pc/'.$tpl)?>(<?php echo str_replace('.php','',$tpl)?>)</option>
				<?php endwhile?>
				<?php closedir($dirs)?>
				</select>

			</td>
		</tr>
		<tr>
			<td class="td1 m">
				(모바일모드) 
			</td>
			<td class="td2">
				
				<select name="thememobile" class="select1">
				<option value="">&nbsp;+ 선택하세요</option>
				<option value="">------------------------------------</option>
				<?php $dirs = opendir($g['dir_module'].'lang.'.$_HS['lang'].'/theme/_mobile')?>
				<?php while(false !== ($tpl = readdir($dirs))):?>
				<?php if($tpl=='.' || $tpl == '..')continue?>
				<option value="<?php echo $tpl?>"<?php if($d['admin']['thememobile']==$tpl):?> selected="selected"<?php endif?>>ㆍ<?php echo getFolderName($g['dir_module'].'lang.'.$_HS['lang'].'/theme/_mobile/'.$tpl)?>(<?php echo str_replace('.php','',$tpl)?>)</option>
				<?php endwhile?>
				<?php closedir($dirs)?>
				</select>

				<div class="guide">모바일모드는 모바일뷰를 지원하도록 제작된 모듈만 지원됩니다.</div>
			</td>
		</tr>
		<tr>
			<td class="td1">모듈메뉴접기</td>
			<td class="td2">
				<div class="shift">
				<label>
				<input type="checkbox" name="autoclose" value="1"<?php if($d['admin']['autoclose']):?> checked="checked"<?php endif?> />
				가로 1024픽셀이하의 해상도에서 메뉴를 자동으로 접음
				</label>
				</div>
				<div class="guide">관리자모드는 가로 1200픽셀이상의 해상도를 권장합니다.</div>
			</td>
		</tr>
	</table>


	<div class="title">
		부가 환경설정
	</div>

	<table>
		<tr>
			<td class="td1">관리바 숨김</td>
			<td class="td2">
				<div class="shift">
				<label><input type="checkbox" name="hidepannel" value="1"<?php if($d['admin']['hidepannel']):?> checked="checked"<?php endif?> />상단의 관리 패널을 출력하지 않음</label>
				</div>
			</td>
		</tr>
		<tr>
			<td class="td1">관리링크 출력</td>
			<td class="td2">
				<div class="shift">
				<label><input type="radio" name="pannellink" value=""<?php if(!$d['admin']['pannellink']):?> checked="checked"<?php endif?> />적용중인 레이아웃에 출력</label><br />
				<label><input type="radio" name="pannellink" value="1"<?php if($d['admin']['pannellink']):?> checked="checked"<?php endif?> />레이어에 출력</label>
				</div>
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
var sendFlag = false;
function sendCheck(f)
{
	if (sendFlag == true)
	{
		alert('이메일전송 요청중에 있습니다. 잠시만 기다려 주세요.');
		return false;
	}
	if (f.email.value == '')
	{
		alert('전송할 이메일 주소를 입력해 주세요.       ');
		f.email.focus();
		return false;
	}
	if (confirm('정말로 실행하시겠습니까?         '))
	{
		sendFlag = true;
		getIframeForAction(f);
		return true;
	}
}
function saveCheck(f)
{
	if (f.themepc.value == '')
	{
		alert('관리자테마를 선택해 주세요.       ');
		f.themepc.focus();
		return false;
	}
	if (f.thememobile.value == '')
	{
		alert('모바일모드 관리자테마를 선택해 주세요.       ');
		f.thememobile.focus();
		return false;
	}
	getIframeForAction(f);
	return confirm('정말로 실행하시겠습니까?         ');
}
//]]>
</script>




