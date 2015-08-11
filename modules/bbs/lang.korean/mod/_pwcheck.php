
<div id="chkbox">

	<div class="msg">
		<h3><img src="<?php echo $g['img_core']?>/_public/ico_notice.gif" alt="" /> 비밀번호 확인</h3>
		<div>게시물 등록시에 입력했던 비밀번호를 입력해 주세요.</div>
	</div>

	<form name="checkForm" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return permCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />	
	<input type="hidden" name="a" value="<?php echo $mod=='delete'?$mod:'pwcheck'?>" />
	<input type="hidden" name="c" value="<?php echo $c?>" />
	<input type="hidden" name="cuid" value="<?php echo $_HM['uid']?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	<input type="hidden" name="bid" value="<?php echo $R['bbsid']?$R['bbsid']:$bid?>" />
	<input type="hidden" name="uid" value="<?php echo $R['uid']?>" />

	<input type="hidden" name="p" value="<?php echo $p?>" />
	<input type="hidden" name="cat" value="<?php echo $cat?>" />
	<input type="hidden" name="sort" value="<?php echo $sort?>" />
	<input type="hidden" name="orderby" value="<?php echo $orderby?>" />
	<input type="hidden" name="recnum" value="<?php echo $recnum?>" />
	<input type="hidden" name="type" value="<?php echo $type?>" />
	<input type="hidden" name="iframe" value="<?php echo $iframe?>" />
	<input type="hidden" name="skin" value="<?php echo $skin?>" />
	<input type="hidden" name="where" value="<?php echo $where?>" />
	<input type="hidden" name="keyword" value="<?php echo $_keyword?>" />

	<div class="ibox">
		<input type="password" name="pw" class="input" />
		<input type="submit" value=" 확인 " class="btnblue" />
		<input type="button" value=" 취소 " class="btngray" onclick="history.go(-1);" />
	</div>

	</form>
</div>

<style type="text/css">
#chkbox {border:#dfdfdf solid 1px;width:<?php echo $g['mobile']?'90%':'350px'?>;padding:20px 10px 20px 10px;margin:40px auto 40px auto;}
#chkbox .msg {}
#chkbox .msg h3 {margin:0;padding:0 0 9px 0;font-size:14px;font-weight:bold;font-family:"malgun gothic","dotum";border-bottom:#dfdfdf dashed 1px;}
#chkbox .msg h3 img {position:relative;top:3px;}
#chkbox .msg div {padding:10px 0 0 22px;color:#999;}
#chkbox .ibox {padding:30px 0 10px 22px;}
#chkbox .input {width:<?php echo $g['mobile']?'100':'150'?>px;}
#chkbox .btnblue {width:80px;}
</style>

<script type="text/javascript">
//<![CDATA[
var checkFlag = false;
function permCheck(f)
{
	if (checkFlag == true)
	{
		alert('확인중입니다. 잠시만 기다려 주세요.   ');
		return false;
	}
	
	if (f.pw.value == '')
	{
		alert('비밀번호를 입력해 주세요.   ');
		f.pw.focus();
		return false;
	}
	checkFlag = true;
}
window.onload = function(){document.checkForm.pw.focus();}
//]]>
</script>
