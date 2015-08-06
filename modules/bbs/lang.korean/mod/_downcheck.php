


<div id="guidebox">

	<h1>다운로드 안내</h1>
	<div class="sbj">
		이 자료를 다운로드 받기 위해서는 포인트가 필요합니다.
	</div>
	<br />
	<ul>
	<?php if($my['uid']):?>
	<li>다운로드를 위해서는 <span class="price1"><?php echo number_format($d['bbs']['point3'])?>포인트</span>가 필요하며 회원님은 현재 <span class="price2"><?php echo number_format($my['point'])?>포인트</span> 보유중입니다.</li>
	<?php else:?>
	<li>회원으로 로그인하셔야 이용하실 수 있습니다. 로그인해 주세요.</li>
	<?php endif?>
	<li>한번 다운로드한 자료는 언제든지 재결제 없이 다시 받으실 수 있습니다.</li>
	<?php if($my['admin']):?>
	<li class="b"><?php echo $my[$_HS['nametype']]?>님은 관리자권한으로 포인트는 차감되지 않습니다.</li>
	<?php endif?>
	<?php if($my['uid']==$R['mbruid']):?>
	<li class="b"><?php echo $my[$_HS['nametype']]?>님은 자료 등록자이므로 실제 포인트는 차감되지 않습니다.</li>
	<?php endif?>
	</ul>

	<div class="back">
		<input type="button" value="취소" class="btngray" onclick="self.close();" />
		<input type="button" value="다운로드(<?php echo number_format($d['bbs']['point3'])?>포인트차감)" class="btnblue" onclick="viewArticle();" />
	</div>

</div>

<form name="checkForm" method="post" action="<?php echo $g['s']?>/" onsubmit="return permCheck(this);">
<input type="hidden" name="r" value="<?php echo $r?>" />	
<input type="hidden" name="m" value="upload" />	
<input type="hidden" name="a" value="download" />
<input type="hidden" name="confirm" value="Y" />
<input type="hidden" name="uid" value="<?php echo $dfile?>" />
</form>


<style type="text/css">
#guidebox {padding:15px;}
#guidebox h1 {font-family:"malgun gothic",dotum;font-size:22px;padding:0 0 10px 0;margin:0 0 30px 0;border-bottom:#dfdfdf solid 1px;}
#guidebox ul {}
#guidebox li {padding:5px 0 5px 0;color:#999;}
#guidebox .sbj {font-weight:bold;color:#000000;border-bottom:#dfdfdf dotted 1px;padding:0 0 20px 30px;}
#guidebox .price1 {font-weight:bold;color:#ff0000;}
#guidebox .price2 {font-weight:bold;color:#0000ff;}
#guidebox .back {border-top:#dfdfdf solid 1px;margin:30px 0 0 0;padding:20px 0 30px 0;text-align:right;}
</style>

<script type="text/javascript">
//<![CDATA[
function viewArticle()
{
	var f = document.checkForm;
	if (memberid == '')
	{
		alert('로그인하신 후에 이용해 주세요.   ');
		return false;
	}
	<?php if($my['point'] < $d['bbs']['point3']):?>
	alert('회원님의 보유포인트가 다운로드 차감 포인트보다 적습니다.  ');
	return false;
	<?php endif?>
	if (confirm('정말로 다운로드 받으시겠습니까?   '))
	{
		f.submit();
	}
}
//]]>
</script>
