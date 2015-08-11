
<div id="pages_join">


	<form name="procForm" action="<?php echo $g['s']?>/" method="get">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="c" value="<?php echo $c?>" />
	<input type="hidden" name="m" value="<?php echo $_m?>" />
	<input type="hidden" name="front" value="<?php echo $front?>" />
	<input type="hidden" name="mod" value="<?php echo $_GET['mod']?>" />
	<input type="hidden" name="page" value="step2" />
	<input type="hidden" name="comp" value="0" />

	<h2>회원가입</h2>

	<div class="msg">
		회원으로 가입을 원하실 경우, 아래의 <span class="b">'홈페이지 약관 및 개인정보 수집·이용'</span>에 대한 안내를 반드시 읽고 <span class="b">동의</span>해 주세요. 
	</div>

	<div class="tab">
		<ul>
		<li id="tagree1" class="selected" onclick="tabShow(1);">홈페이지 이용약관</li>
		<li id="tagree2" onclick="tabShow(2);">개인정보수집 및 이용목적</li>
		<li id="tagree3" onclick="tabShow(3);">수집하는 개인정보의 항목</li>
		<li id="tagree4" onclick="tabShow(4);">개인정보보유 및 이용기간</li>
		<li id="tagree5" onclick="tabShow(5);">개인정보의 위탁처리</li>
		</ul>
	</div>
	<div class="agreebox">
		<div id="bagree1">
			<textarea readonly="readonly"><?php readfile($g['dir_module'].'var/agree1.txt')?></textarea>
			<div class="more"><a href="<?php echo RW('mod=agreement')?>" target="_blank">더보기..</a></div>
		</div>
		<div id="bagree2" class="hide">
			<textarea readonly="readonly"><?php readfile($g['dir_module'].'var/agree2.txt')?></textarea>
			<div class="more"><a href="<?php echo RW('mod=private')?>#p1" target="_blank">더보기..</a></div>
		</div>
		<div id="bagree3" class="hide">
			<textarea readonly="readonly"><?php readfile($g['dir_module'].'var/agree3.txt')?></textarea>
			<div class="more"><a href="<?php echo RW('mod=private')?>#p2" target="_blank">더보기..</a></div>
		</div>
		<div id="bagree4" class="hide">
			<textarea readonly="readonly"><?php readfile($g['dir_module'].'var/agree4.txt')?></textarea>
			<div class="more"><a href="<?php echo RW('mod=private')?>#p3" target="_blank">더보기..</a></div>
		</div>
		<div id="bagree5" class="hide">
			<textarea readonly="readonly"><?php readfile($g['dir_module'].'var/agree5.txt')?></textarea>
			<div class="more"><a href="<?php echo RW('mod=private')?>#p4" target="_blank">더보기..</a></div>
		</div>
	</div>
	


	<div class="agreecheck">
		<input type="checkbox" name="agreecheckbox" id="agreecheckbox" /><label for="agreecheckbox">위의 <span class="b">'이용약관 및 개인정보 수집·이용'</span>에 동의 합니다.</label>
	</div>


	<div class="submitbox">
		<input type="button" value="가입취소" class="btngray" onclick="goHref('<?php echo RW(0)?>');" />
		<?php if($d['member']['form_comp']&&!$d['member']['form_jumin']):?>
		<input type="button" value="개인회원가입" class="btnblue" onclick="return nextStep(0);" />
		<input type="button" value="기업회원가입" class="btnblue" onclick="return nextStep(1);" />
		<?php else:?>
		<input type="button" value="다음단계로" class="btnblue" onclick="return nextStep(0);" />
		<?php endif?>
	</div>

	</form>
</div>


<script type="text/javascript">
//<![CDATA[
function nextStep(n)
{
	var f = document.procForm;

	if (f.agreecheckbox.checked == false)
	{
		alert('회원으로 가입을 원하실 경우,\n\n[홈페이지 약관 및 개인정보 수집·이용]에 동의하셔야 합니다.');
		return false;
	}

	f.comp.value = n;
	f.submit();
}
function tabShow(n)
{
	var i;

	for (i = 1; i < 6; i++)
	{
		getId('tagree'+i).style.borderTop = '#dfdfdf solid 1px';
		getId('tagree'+i).style.borderLeft = '#dfdfdf solid 1px';
		getId('tagree'+i).style.borderRight = '#dfdfdf solid 1px';
		getId('tagree'+i).style.background = '#f9f9f9';
		getId('tagree'+i).style.color = '#666666';
		getId('bagree'+i).style.display = 'none';
	}
	getId('tagree'+n).style.borderTop = '#000000 solid 1px';
	getId('tagree'+n).style.borderLeft = '#000000 solid 1px';
	getId('tagree'+n).style.borderRight = '#000000 solid 1px';
	getId('tagree'+n).style.background = '#000000';
	getId('tagree'+n).style.color = '#ffffff';
	getId('bagree'+n).style.display = 'block';
}
//]]>
</script>