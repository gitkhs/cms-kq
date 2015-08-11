

<div id="pwbox">
	<div id="chkbox">

		<div class="msg">
			<h3><img src="<?php echo $g['img_core']?>/_public/ico_notice.gif" alt="" /> 비밀번호 확인</h3>
			<div>댓글 등록시에 입력했던 비밀번호를 입력해 주세요.</div>
		</div>


		<form name="checkForm" method="post" action="<?php echo $g['s']?>/" onsubmit="return permCheck(this);">
		<input type="hidden" name="type" value="" />
		<input type="hidden" name="c" value="<?php echo $c?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="skin" value="<?php echo $skin?>" />
		<input type="hidden" name="iframe" value="<?php echo $iframe?>" />
		<input type="hidden" name="p" value="<?php echo $p?>" />
		<input type="hidden" name="sort" value="<?php echo $sort?>" />
		<input type="hidden" name="orderby" value="<?php echo $orderby?>" />
		<input type="hidden" name="recnum" value="<?php echo $recnum?>" />		
		<input type="hidden" name="where" value="<?php echo $where?>" />
		<input type="hidden" name="keyword" value="<?php echo $_keyword?>" />
		<input type="hidden" name="uid" value="<?php echo $R['uid']?>" />

		<div class="ibox">
			<input type="password" name="pw" class="input" />
			<input type="submit" value=" 확인 " class="btnblue" />
			<input type="button" value=" 취소 " class="btngray" onclick="history.back();" />
		</div>

		</form>
	</div>
</div>

<script type="text/javascript">
//<![CDATA[
var layer = getId('pwbox');
layer.style.display = 'block';
layer.style.left = '100px';
layer.style.top = '10px';
//]]>
</script>