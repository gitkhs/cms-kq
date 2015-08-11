<div id="topbanner">
	<form name="frmBanner" method="post" action="<?=$g['s']?>/" target="_action_frame_<?=$m?>" onsubmit="return chkWrite(this);">
	<input type="hidden" name="r" value="<?=$r?>" />
	<input type="hidden" name="a" value="<?=$mod?>" />
	<input type="hidden" name="m" value="<?=$m?>" />
	<input type="hidden" name="div" value="<?=$div?>" />
	
	<table class="tbl-form">
	<colgroup>
	<col width="150px">
	<col>
	</colgroup>
	<tr>
		<td class="lbl">인증키</td>
		<td><input type="password" name="ikey" value=""></td>
	</tr>
	<tr>
		<td class="lbl">모듈선택</td>
		<td>
			<label><input type="radio" name="imodule" value="dbtool"> DB tool</label>
			<label><input type="radio" name="imodule" value="nsoland"> 부동산</label>
		</td>
	</tr>
	<tr>
		<td colspan="2" class="submit">
		<input type="submit" class="btnblue btnsz01" value=" 확 인 ">
		</td>
	</tr>
	</table>
	
	</form>
</div>


<script type="text/javascript">
</script>
