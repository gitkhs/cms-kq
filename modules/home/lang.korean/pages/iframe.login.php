<?php 
$g['use_social'] = is_file($g['path_module'].'social/var/var.php');
if ($g['use_social']) include $g['path_module'].'social/var/var.php';
include $g['path_layout'].'_config.php';
?>

<div id="loginBox">
	<div id="snsBar">
		<? if($d['config']['facebook_use']){ ?><span class="facebook"><fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button></span><? } ?>
	</div>

	<form name="showLogBoxForm" action="<?php echo $d['admin']['ssl_type']?$g['ssl_root']:$g['url_root']?>/" method="post"  onsubmit="return showLogCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="a" value="login" />
	<input type="hidden" name="referer" value="" />
	<input type="hidden" name="__target" value="_parent" />


	<fieldset>
		<label> 
		<div>이메일 또는 아이디</div>
		<input type="text" name="id" class="xi" id="_xi_1" autocomplete="on" value="<?php echo getArrayCookie($_COOKIE['svshop'],'|',0)?>" />
		</label>
		<label> 
		<div>비밀번호</div>
		<input type="password" name="pw" class="xi" id="_xi_2" value="<?php echo getArrayCookie($_COOKIE['svshop'],'|',1)?>" />
		</label>
		<div class="submit">
		<label>
		<input type="checkbox" name="idpwsave" value="checked"<?php if($_COOKIE['svshop']):?> checked="checked"<?php endif?> />
		<span>아이디/비밀번호 기억</span>
		</label>
		<label>
		<input type="checkbox" name="gohub" value="Y" />
		<span>마이페이지로 이동</span> 
		</label>
		</div>
		<input type="submit" id="_login_btn_" class="btnblue" value="로그인" />
	</fieldset>
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
	</form>
	<? } ?>
</div>

<script type="text/javascript">
//<![CDATA[
function showLogCheck(f)
{
	if (f.id.value == '')
	{
		alert('아이디나 이메일을 입력해 주세요.');
		f.id.focus();
		return false;
	}
	if (f.pw.value == '')
	{
		alert('비밀번호를 입력해 주세요.');
		f.pw.focus();
		return false;
	}
	if (f.gohub.checked == true)
	{
		f.referer.value = "<?php echo $g['s']?>/?r=<?php echo $r?>&mod=mypage";
	}
	else {
		f.referer.value = '<?php echo urldecode($referer)?>';
	}
	return true;
}


window.onload = function()
{
	parent.getId('_modal_on_').style.overflow = 'hidden';
	parent.getId('_modal_on_').style.width = '325px';
	parent.getId('_modal_on_').style.height = '290px';
	getId('_xi_1').style.width = '250px';
	getId('_xi_2').style.width = '250px';
	getId('_login_btn_').style.left = '212px';
}
//]]>
</script>

<? if($d['config']['facebook_use']){ ?>
<? include_once $g['path_core'].'com/social/facebook.php'?>
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