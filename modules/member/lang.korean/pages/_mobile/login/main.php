<div class="subject">로그인</div>


<div id="m_loginbox">
<form name="loginform" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return loginCheck(this);">
<input type="hidden" name="r" value="<?php echo $r?>" />
<input type="hidden" name="a" value="login" />
<input type="hidden" name="referer" value="<?php echo $referer ? $referer : $_SERVER['HTTP_REFERER']?>" />
<input type="hidden" name="usessl" value="<?php echo $d['member']['login_ssl']?>" />

<div id="snsBar">
	<? if($d['config']['facebook_use']){ ?><span class="facebook"><fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button></span><? } ?>
</div>

<div class="xdiv"><input type="text" name="id" class="input xinput" value="<?php echo getArrayCookie($_COOKIE['svshop'],'|',0)?>" /></div>
<div class="xdiv"><input type="password" name="pw" class="input xinput" value="<?php echo getArrayCookie($_COOKIE['svshop'],'|',1)?>" /></div>
<div class="xdiv">
	<div class="xl xfont">
		<input type="checkbox" name="idpwsave" value="checked"<?php if($_COOKIE['svshop']):?> checked="checked"<?php endif?> /><?php echo $d['member']['login_emailid']?'이메일':'아이디'?>/비번 기억
		<?php if($d['member']['login_ssl']):?>
		<br /><input type="checkbox" name="ssl" value="checked" />보안로그인(SSL)
		<?php endif?>
	</div>
	<div class="xr">
		<input type="button" value="비번찾기" class="btngray" onclick="goHref('<?php echo $g['url_reset']?>&page=idpwsearch');" />
		<input type="submit" value="로그인" class="btnblue" />
	</div>
	<div class="clear"></div>
</div>

</form>


<form name="SSLLoginForm" action="https://<?php echo $_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']?>" method="post" target="_action_frame_<?php echo $m?>">
<input type="hidden" name="r" value="<?php echo $r?>" />
<input type="hidden" name="a" value="login" />
<input type="hidden" name="referer" value="<?php echo $referer?$referer:$_SERVER['HTTP_REFERER']?>" />
<input type="hidden" name="id" value="" />
<input type="hidden" name="pw" value="" />
<input type="hidden" name="idpwsave" value="" />
</form>

<? if($d['config']['facebook_use']){ ?>
<form name="frmFblogin" action="<?=$g['url_root']?>/" method="post">
<input type="hidden" name="r" value="<?php echo $r?>" />
<input type="hidden" name="a" value="login_facebook" />
<input type="hidden" name="id" value="">
<input type="hidden" name="email" value="">
<input type="hidden" name="name" value="">
<input type="hidden" name="birthday" value="">
<input type="hidden" name="gender" value="">
<input type="hidden" name="link" value="">
<input type="hidden" name="referer" value="<?php echo $referer?$referer:$_SERVER['HTTP_REFERER']?>" />
</form>
<? } ?>

</div>

<script type="text/javascript">
//<![CDATA[
function loginCheck(f)
{
	if (f.id.value == '')
	{
		alert('<?php echo $d['member']['login_emailid']?'이메일을':'아이디를'?> 입력해 주세요.');
		f.id.focus();
		return false;
	}
	if (f.pw.value == '')
	{
		alert('비밀번호를 입력해 주세요.');
		f.pw.focus();
		return false;
	}
	if (f.usessl.value == '1')
	{
		if (f.ssl.checked == true)
		{
			var fs = document.SSLLoginForm;
			fs.id.value = f.id.value;
			fs.pw.value = f.pw.value;
			if(f.idpwsave.checked == true) fs.idpwsave.value
			fs.submit();
			return false;
		}
	}
}
//]]>
</script>

<? if($d['config']['facebook_use']){ ?>
<?// include_once $g['path_core'].'com/social/facebook.php'?>
<script type="text/javascript">
	function statusChangeCallback(response) {
		if (response.status === 'connected') {	// facebook logined
			pageLogin();
		} else if (response.status === 'not_authorized') {	// facebook logined, app not logined
			$('#fbLogin').show();
		} else {	// facebook not logined
			$('#fbLogin').show();
		}
	}

	function checkLoginState() {
		FB.getLoginStatus(function(response) {
			statusChangeCallback(response);
		});
	}
 
	function pageLogin() {
		FB.api('/me', function(response) {
			var frm = $('form[name=frmFblogin]');
			frm.find('input[name=id]').val(response.id);
			frm.find('input[name=email]').val(response.email);
			frm.find('input[name=name]').val(response.name);
			frm.find('input[name=birthday]').val(response.birthday);
			frm.find('input[name=gender]').val(response.gender);
			frm.find('input[name=link]').val(response.link);
			<? if(!$_SESSION['sns_login']) { ?>$('form[name=frmFblogin]').submit();<? } ?>
		});
	}
</script>
<? } ?>