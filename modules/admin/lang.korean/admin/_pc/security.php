
<div id="configbox">

	<form name="sendForm" action="<?php echo $g['s']?>/" method="post" onsubmit="return sslCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="m" value="<?php echo $module?>" />
	<input type="hidden" name="a" value="config" />

	<input type="hidden" name="ssl_type" value="<?php echo $d['admin']['ssl_type']?>" />
	<input type="hidden" name="ssl_port" value="<?php echo $d['admin']['ssl_port']?>" />
	<input type="hidden" name="ssl_menu" value="<?php echo $d['admin']['ssl_menu']?>" />
	<input type="hidden" name="ssl_page" value="<?php echo $d['admin']['ssl_page']?>" />
	<input type="hidden" name="ssl_bbs" value="<?php echo $d['admin']['ssl_bbs']?>" />
	<input type="hidden" name="ssl_module" value="<?php echo $d['admin']['ssl_module']?>" />
	<input type="hidden" name="http_port" value="<?php echo $d['admin']['http_port']?>" />

	<input type="hidden" name="cache_flag" value="<?php echo $d['admin']['cache_flag']?>" />
	<input type="hidden" name="themepc" value="<?php echo $d['admin']['themepc']?>" />
	<input type="hidden" name="thememobile" value="<?php echo $d['admin']['thememobile']?>" />
	<input type="hidden" name="autoclose" value="<?php echo $d['admin']['autoclose']?>" />
	<input type="hidden" name="version" value="<?php echo $d['admin']['version']?>" />
	<input type="hidden" name="hidepannel" value="<?php echo $d['admin']['hidepannel']?>" />
	<input type="hidden" name="pannellink" value="<?php echo $d['admin']['pannellink']?>" />


	<div class="title">
		보안설정
	</div>

	<table>
		<tr>
			<td class="td1">에디터 허용태그</td>
			<td class="td2">
				<div class="shift">
				<label><input type="checkbox" name="secu_iframe" value="1"<?php if($d['admin']['secu_iframe']):?> checked="checked"<?php endif?> />iframe</label>
				<label><input type="checkbox" name="secu_script" value="1"<?php if($d['admin']['secu_script']):?> checked="checked"<?php endif?> />script</label>
				<label><input type="checkbox" name="secu_style" value="1"<?php if($d['admin']['secu_style']):?> checked="checked"<?php endif?> />style</label>

				</div>
				<div id="_gxguide_" class="guide">
					킴스큐에 포함된 위지위그 에디터를 사용할 경우 편리하게 문서를 편집할 수 있습니다.<br />
					그러나 특정태그를 허용하게 되면 XSS(Cross-site scripting, 크로스 사이트 스크립팅) 나<br />
					CSRF(Cross Site Request Forgery, 크로스 사이트 요청 변조)공격을 받을 수 있으므로 주의해야 합니다.<br />
					특히 iframe 이나 script 는 특수한 경우가 아니면 허용하지 말아야 합니다.<br />
				</div>
			</td>
		</tr>
		<tr>
			<td class="td1">플래쉬 허용</td>
			<td class="td2">
				<div class="shift">
				<label><input type="checkbox" name="secu_flash" value="1"<?php if($d['admin']['secu_flash']):?> checked="checked"<?php endif?> />관리자도 플래쉬를 볼 수 있도록 허용함</label>

				</div>
				<div id="_gxguide_" class="guide">
					플래쉬를 이용한 XSS 공격을 차단하기 위해 관리자 권한으로 접속했을 경우 플래쉬를 볼 수 없도록 합니다.<br />
					(비회원이나 일반회원은 제한없이 플래쉬를 볼 수 있습니다)<br />
				</div>
			</td>
		</tr>
		<tr>
			<td class="td1">iframe 허용도메인</td>
			<td class="td2">
				<input type="text" name="secu_domain" value="<?php echo $d['admin']['secu_domain']?>" class="input" />
				<div class="guide">
					허용할 도메인을 콤마(,)로 구분해서 등록해 주세요.<br />
					iframe 태그를 허용하지 않아도 여기에 등록된 도메인들은 iframe 이 허용됩니다.<br />
					보기) youtube.com,naver.com,daum.net,vimeo.com,<br />				
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
function sslCheck(f)
{
	getIframeForAction(f);
	return confirm('정말로 실행하시겠습니까?         ');
}
//]]>
</script>




