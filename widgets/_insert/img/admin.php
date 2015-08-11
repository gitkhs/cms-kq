


<div id="mjointbox">

	<div class="title">
		이 위젯(<span class="b"><?php echo getFolderName($g['path_widget'].$swidget)?></span>)을 추가하시겠습니까?
	</div>


	<?php if ($isWcode == 'Y'):?>
	<div class="none">
	<img src="<?php echo $g['img_core']?>/_public/ico_notice.gif" alt="" />
	이 위젯은 위젯코드를 지원하지 않습니다.
	</div>
	<?php else:?>
	<form name="procform" onsubmit="return saveCheck(this);">
	<table>
	<tr>
	<td class="td1">이미지주소</td>
	<td class="td2">:</td>
	<td class="td3">
		<input type="text" name="url" value="<?php echo $wdgvar['url']?>" size="40" class="input" />
	</td>
	</tr>
	<tr>
	<td class="td1">이미지설명</td>
	<td class="td2">:</td>
	<td class="td3">
		<input type="text" name="alt" value="<?php echo $wdgvar['alt']?>" size="40" class="input" />
	</td>
	</tr>
	<tr>
	<td class="td1">링크주소</td>
	<td class="td2">:</td>
	<td class="td3"><input type="text" name="href" value="<?php echo $wdgvar['href']?>" size="40" class="input" /></td>
	</tr>
	<tr>
	<td class="td1">링크타겟</td>
	<td class="td2">:</td>
	<td class="td3">
		<select name="target">
		<option value=""<?php if(!$wdgvar['target']):?> selected="selected"<?php endif?>>_self</option>
		<option value="_blank"<?php if($wdgvar['target']=='_blank'):?> selected="selected"<?php endif?>>_blank</option>
		</select>	
	</td>
	</tr>
	</table>
	<div class="btnbox">
	<input type="submit" value="<?php echo $option?'속성변경':'위젯추가'?>" class="btnblue" />
	</div>
	</form>
	<?php endif?>


</div>

<style type="text/css">
#mjointbox {}
#mjointbox .title {border-bottom:#dfdfdf dashed 1px;padding:0 0 10px 0;margin:0 0 20px 0;}
#mjointbox .td1 {padding:0 20px 0 0;letter-spacing:-1px;}
#mjointbox .td2 {padding:0 15px 0 0;color:#c0c0c0;}
#mjointbox .td3 {}
#mjointbox .btnbox {text-align:center;padding:20px 0 0 0;margin:20px 0 0 0;border-top:#dfdfdf dashed 1px;}
</style>





<script type="text/javascript">
//<![CDATA[
function saveCheck(f)
{
	if (f.url.value == '')
	{
		alert('이미지 주소를 입력해 주세요.      ');
		f.url.focus();
		return false;
	}
	<?php if(!$option):?>
	var i;
	var n = 0;

    for (i=0; i<opener.maxTiles; i++)
	{
        if (opener.moveObject[i].style.display=='block')
		{
			n = i+1;
        }
    }
	<?php else:?>
	var n = <?php echo $dropfield?>;
	<?php endif?>

	<?php if(!$option):?>
	opener.createTile('200px','200px','0px','0px');
	<?php endif?>

	opener.blocktitle[n] = '이미지';
	opener.blockarray[n] = "<?php echo $swidget?>,url^" + f.url.value + ",href^"+f.href.value + ",target^" + f.target.value + ",alt^"+f.alt.value;
	opener.getId('wtitle'+n).innerHTML = opener.blocktitle[n];
	top.close();
	return false;
}
//]]>
</script>

