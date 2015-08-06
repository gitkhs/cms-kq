<? include $g['path_layout'].'_config.php'; ?>
<div id="login" style="background:url('<?=$g['s']?>/files/_etc/images/android_background.jpg') center no-repeat;">

<div class="loginbox">
	<form name="frmLogin" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return loginCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="a" value="login" />
	<input type="hidden" name="appmode" value="<?=$appmode?>" />
	<input type="hidden" name="referer" value="<?php echo $referer?$referer:$_SERVER['HTTP_REFERER']?>" />
	<input type="hidden" name="idpwsave" value="checked" />

	<div class="xdiv"><input type="text" name="id" value="<?php echo getArrayCookie($_COOKIE['svshop'],'|',0)?>" /></div>
	<div class="xdiv"><input type="password" name="pw" value="<?php echo getArrayCookie($_COOKIE['svshop'],'|',1)?>" /></div>
	<div class="xdiv">
		<div class="xl">
			<a class="guest" href="#" onclick="loginGuest(); return false;">게스트</a>
		</div>
		<div class="xr">
			<input type="submit" value="로그인" class="btnblue btnsz01" />
		</div>
		<div class="clear"></div>
	</div>

	</form>
</div>

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

</div>

<script type="text/javascript">
//<![CDATA[
$(document).ready(function (){
	var h = $(window).height();
	$('#login').css('height',h);
	$('#login').css("background", "url('<?=$g['s']?>/files/_etc/images/android_background.jpg') center no-repeat;");
	$('#login').css("background-size", "cover");
	<?if($_SESSION['appmode'] == 'android' && $d['config']['facebook_use']) {?>window.android.facebookLogin();<?}?>
});
function loginGuest() {
	<?if($_SESSION['appmode'] == 'android') {?>window.android.guestLogin();<?}?>
}

function loginCheck(f)
{
	if (f.id.value == '')
	{
		alert('아이디 입력해 주세요.');
		f.id.focus();
		return false;
	}
	if (f.pw.value == '')
	{
		alert('비밀번호를 입력해 주세요.');
		f.pw.focus();
		return false;
	}
}

function loginFacebook(response) {
	var frm = $('form[name=frmFblogin]');
	frm.find('input[name=id]').val(response.id);
	frm.find('input[name=email]').val(response.email);
	frm.find('input[name=name]').val(response.name);
	frm.find('input[name=birthday]').val(response.birthday);
	frm.find('input[name=gender]').val(response.gender);
	frm.find('input[name=link]').val(response.link);
	$('form[name=frmFblogin]').submit();
}
//]]>
</script>
