<?php include_once $g['path_module'].'member/var/var.join.php'?>

<div id="pages_login">

	<h2>관리자 로그인</h2>

	<div class="msg">
		<?php if($nosite=='Y'):?>
		<span class="nosite">
		사이트가 등록되지 않았습니다. 로그인 후 사이트를 등록해 주세요.<br />
		</span>
		<?php endif?>
		관리자일 경우 아이디와 비밀번호를 입력해 주세요.<br />
	</div>

	<div class="agreebox">
		
		<form name="loginform" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return loginCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="a" value="login" />
		<input type="hidden" name="referer" value="<?php echo $referer ? $referer : $_SERVER['HTTP_REFERER']?>" />
		<input type="hidden" name="usessl" value="<?php echo $d['member']['login_ssl']?>" />
		<input type="hidden" name="usertype" value="admin" />


		<div class="tblbox">
		<table>
			<tr>
			<td class="key"><?php echo $d['member']['login_emailid']?'이메일':'아이디'?></td>
			<td>
				<input type="text" name="id" class="input xinput" title="<?php echo $d['member']['login_emailid']?'이메일':'아이디'?>" value="<?php echo getArrayCookie($_COOKIE['svshop'],'|',0)?>" />
			</td>
			</tr>
			<tr>
			<td class="key">비밀번호</td>
			<td>
				<input type="password" name="pw" class="input xinput"  title="패스워드" value="<?php echo getArrayCookie($_COOKIE['svshop'],'|',1)?>" />
			</td>
			</tr>
			<tr>
			<td class="key"></td>
			<td class="xfont">
				<input type="checkbox" name="idpwsave" value="checked" onclick="remember_idpw(this)"<?php if($_COOKIE['svshop']):?> checked="checked"<?php endif?> /><?php echo $d['member']['login_emailid']?'이메일':'아이디'?>/비밀번호 기억
				<?php if($d['member']['login_ssl']):?>
				<input type="checkbox" name="ssl" value="checked" />보안로그인(SSL)
				<?php endif?>
			</td>
			</tr>
		</table>
		</div>

		<div class="submitbox">
			<input type="button" value="취소" class="btngray" onclick="goHref('<?php echo $g['r']?>/');" />
			<input type="submit" value="로그인" class="btnblue" />
		</div>

		</form>

		<form name="SSLLoginForm" action="https://<?php echo $_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME']?>" method="post" target="_action_frame_<?php echo $m?>">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="a" value="login" />
		<input type="hidden" name="referer" value="<?php echo $referer?$referer:$_SERVER['HTTP_REFERER']?>" />
		<input type="hidden" name="id" value="" />
		<input type="hidden" name="pw" value="" />
		<input type="hidden" name="idpwsave" value="" />
		<input type="hidden" name="usertype" value="admin" />
		</form>

	</div>
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
function remember_idpw(ths)
{
	if (ths.checked == true)
	{
		if (!confirm('\n\n패스워드정보를 저장할 경우 다음접속시 \n\n패스워드를 입력하지 않으셔도 됩니다.\n\n그러나, 개인PC가 아닐 경우 타인이 로그인할 수 있습니다.     \n\nPC를 여러사람이 사용하는 공공장소에서는 체크하지 마세요.\n\n정말로 패스워드를 기억시키겠습니까?\n\n'))
		{
			ths.checked = false;
		}
	}
}

window.onload = function()
{
	document.loginform.id.focus();
}
//]]>
</script>




