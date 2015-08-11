<?php include $g['path_module'].'member/var/var.join.php'?>


<div id="mheader">
	<img src="<?php echo $g['img_core']?>/_public/rb_logo_white.png" alt="kimsq" />
</div>
<div id="mcontent">
	<div class="infobox">
		<div class="title"><img src="<?php echo $g['img_core']?>/_public/ico_notice.gif" alt="" /> 관리자 로그인</div>

		<form name="loginform" action="<?php echo $g['s']?>/" method="post" onsubmit="return loginChecks(this);">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="a" value="login" />
		<input type="hidden" name="referer" value="<?php echo RW('m=admin')?>" />
		<input type="hidden" name="usessl" value="<?php echo $d['member']['login_ssl']?>" />
		<input type="hidden" name="usertype" value="admin" />
		<div class="logbox">
		<input type="text" name="id" value="<?php echo getArrayCookie($_COOKIE['svshop'],'|',0)?>" placeholder="이메일 또는 아이디" />
		<div class="line"></div>
		<input type="password" name="pw" value="<?php echo getArrayCookie($_COOKIE['svshop'],'|',1)?>" placeholder="패스워드" />
		</div>

		<div class="agree">
			<input type="checkbox" name="idpwsave" class="xch" value="checked"<?php if($_COOKIE['svshop']):?> checked="checked"<?php endif?> />내 아이디/패스워드 기억<br />
			<input type="checkbox" name="ssl" value="checked" />SSL 보안로그인<br />
		</div>
		<div class="submit">
			<input type="submit" value="로그인" />
		</div>
		<div class="clear"></div>
		</form>
	</div>
	<div class="mfooter">
		Redblock &copy; <?php echo $date['year']?> / kimsQ Rb <?php echo $d['admin']['version']?>
		<a href="<?php echo $g['s']?>/?r=<?php echo $r?>">HOME</a>
		<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;a=pcmode">PC모드</a>
	</div>
</div>


<form name="SSLLoginForm" action="https://<?php echo $_SERVER['SERVER_NAME'].':'.'80'.$_SERVER['SCRIPT_NAME']?>" method="post">
<input type="hidden" name="r" value="<?php echo $r?>" />
<input type="hidden" name="a" value="login" />
<input type="hidden" name="referer" value="<?php echo RW('m=admin')?>" />
<input type="hidden" name="id" value="" />
<input type="hidden" name="pw" value="" />
<input type="hidden" name="idpwsave" value="" />
<input type="hidden" name="usertype" value="admin" />
</form>

<script type="text/javascript">
//<![CDATA[
function loginChecks(f)
{
	if (f.id.value == '')
	{
		alert('이메일이나 아이디를 입력해 주세요.');
		f.id.focus();
		return false;
	}
	if (f.pw.value == '')
	{
		alert('패스워드를 입력해 주세요.');
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
			if(f.idpwsave.checked == true) fs.idpwsave.value;
			getIframeForAction(fs);
			fs.submit();
			return false;
		}
	}
	getIframeForAction(f);
	return true;
}
window.onload = function() {window.scrollTo(0,1);}
//]]>
</script>
