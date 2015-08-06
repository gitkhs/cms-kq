<?php
if (!$my['uid']) getLink('','','권한이 없습니다.','');
if (!$rcvmbr) getLink('','parent.getLayerBoxHide();','받는사람이 지정되지 않았습니다.','');
$M = getDbData($table['s_mbrdata'],'memberuid='.$rcvmbr,'*');
if (!$M['memberuid']) getLink('','parent.getLayerBoxHide();','받는사람이 지정되지 않았습니다.','');
?>

<div id="paperbox">
	<? if($rcvmbr) {?>
	<form name="procForm" action="<?=$g['s']?>/" method="post" onsubmit="return onSubmit(this);">
	<input type="hidden" name="r" value="<?=$r?>" />
	<input type="hidden" name="m" value="member" />
	<input type="hidden" name="a" value="paper_send" />
	<input type="hidden" name="rcvmbr" value="<?=$M['memberuid']?>" />
		<table class="tbl-form">
		<tr>
			<td>
				<div class="rcvmbr">받는사람 : <?=$M['name']?></div>
				<textarea name="msg" rows="10"></textarea>
			</td>
		</tr>
		<tr>
			<td class="submit">
				<input type="submit" value=" 보내기 " class="btnblue" />
				<input type="button" value=" 취소 " class="btngray" onclick="parent.getLayerBoxHide();" />
			</td>
		</tr>
		</table>
	</form>
	<? }else{?>
	<div class="not-rcvmbr">받는사람이 지정되지 않았습니다.</div>
	<? } ?>
</div>
<iframe name="_action_send_" width="0" height="0" frameborder="0"></iframe>



<script type="text/javascript">
//<![CDATA[
function onSubmit(f)
{
	if (f.msg.value == '')
	{
		alert('메세지를 입력해 주세요.    ');
		f.msg.focus();
		return false;
	}
	getIframeForAction(f);
}
//]]>
</script>
