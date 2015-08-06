
<div id="configbox">

	<form name="sendForm" action="<?php echo $g['s']?>/" method="post" onsubmit="return sendCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="m" value="<?php echo $module?>" />
	<input type="hidden" name="a" value="email_check" />

	<div class="title">
		시스템 환경
	</div>

	<table>
		<tr>
			<td class="td1">웹서버</td>
			<td>:</td>
			<td class="td2">
			<?php echo $_SERVER['SERVER_SOFTWARE']?>
			</td>
		</tr>
		<tr>
			<td class="td1">PHP버젼</td>
			<td>:</td>
			<td class="td2">
			<?php echo phpversion()?>
			</td>
		</tr>
		<tr>
			<td class="td1">MYSQL버젼</td>
			<td>:</td>
			<td class="td2">
			<?php echo db_info()?> (<?php echo $DB['type']?>)
			</td>
		</tr>
		<tr>
			<td class="td1">코어버젼</td>
			<td>:</td>
			<td class="td2">
			kimsQ-RB <?php echo $d['admin']['version']?>
			</td>
		</tr>
		<tr>
			<td class="td1">이메일체크</td>
			<td class="vt">:</td>
			<td class="td2">
				<input type="text" name="email" value="<?php echo $my['email']?>" class="input" />
				<input type="submit" value="이메일 전송확인" class="btngray" />

				<div class="guide">입력한 이메일주소로 전송이 되면 메일서버가 정상작동되는 상태입니다.</div>
			</td>
		</tr>
	</table>

	</form>

	<br />
	<br />


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

	<input type="hidden" name="secu_iframe" value="<?php echo $d['admin']['secu_iframe']?>" />
	<input type="hidden" name="secu_script" value="<?php echo $d['admin']['secu_script']?>" />
	<input type="hidden" name="secu_style" value="<?php echo $d['admin']['secu_style']?>" />
	<input type="hidden" name="secu_flash" value="<?php echo $d['admin']['secu_flash']?>" />
	<input type="hidden" name="secu_domain" value="<?php echo $d['admin']['secu_domain']?>" />

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
				<label><input type="radio" name="pannellink" value=""<?php if(!$d['admin']['pannellink']):?> checked="checked"<?php endif?> />적용중인 레이아웃에 출력</label>
				<label><input type="radio" name="pannellink" value="1"<?php if($d['admin']['pannellink']):?> checked="checked"<?php endif?> />레이어에 출력</label>
				</div>
			</td>
		</tr>
		<tr>
			<td class="td1">CSS/JS 캐시</td>
			<td class="td2">
				<select name="cache_flag" class="select1">
				<option value=""<?php if($d['admin']['cache_flag']==''):?> selected="selected"<?php endif?>>ㆍ브라우져 설정을 따름</option>
				<option value="totime"<?php if($d['admin']['cache_flag']=='totime'):?> selected="selected"<?php endif?>>ㆍ접속시마다 갱신</option>
				<option value="nhour"<?php if($d['admin']['cache_flag']=='nhour'):?> selected="selected"<?php endif?>>ㆍ한시간 단위로 갱신</option>
				<option value="today"<?php if($d['admin']['cache_flag']=='today'):?> selected="selected"<?php endif?>>ㆍ하루 단위로 갱신</option>
				<option value="month"<?php if($d['admin']['cache_flag']=='month'):?> selected="selected"<?php endif?>>ㆍ한달 단위로 갱신</option>
				<option value="year"<?php if($d['admin']['cache_flag']=='year'):?> selected="selected"<?php endif?>>ㆍ일년 단위로 갱신</option>
				</select>
				<div class="guide">
				CSS 나 자바스크립트 파일을 수정했을 경우에는 일정기간 접속시마다 갱신되도록 설정해 주세요.
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




