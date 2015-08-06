


<div id="mjointbox">

	<div class="title">
		이 위젯(<span class="b"><?php echo getFolderName($g['path_widget'].$swidget)?></span>)을 추가하시겠습니까?
	</div>


	<form name="procform" onsubmit="return saveCheck(this);">

	<table>
	<tr>
	<td class="td1">트위터아이디</td>
	<td class="td2">:</td>
	<td class="td3"><input type="text" name="id" value="<?php echo $wdgvar['id']?>" size="20" class="input" /></td>
	</tr>
	<tr>
	<td class="td1">노출사이즈</td>
	<td class="td2">:</td>
	<td class="td3"><input type="text" name="width" value="<?php echo $wdgvar['width']?$wdgvar['width']:200?>" size="5" class="input" />*<input type="text" name="height" value="<?php echo $wdgvar['height']?$wdgvar['height']:300?>" size="5" class="input" />px</td>
	</tr>
	<tr>
	<td class="td1">트윗노출수</td>
	<td class="td2">:</td>
	<td class="td3"><input type="text" name="num" value="<?php echo $wdgvar['num']?$wdgvar['num']:'10'?>" size="5" class="input" /></td>
	</tr>
	<tr>
	<td class="td1">타이틀 배경색</td>
	<td class="td2">:</td>
	<td class="td3">#<input type="text" name="bgcolor1" value="<?php echo $wdgvar['bgcolor1']?$wdgvar['bgcolor1']:'efefef'?>" size="6" class="input" /></td>
	</tr>
	<tr>
	<td class="td1">타이틀 글자색</td>
	<td class="td2">:</td>
	<td class="td3">#<input type="text" name="color1" value="<?php echo $wdgvar['color1']?$wdgvar['color1']:'333333'?>" size="6" class="input" /></td>
	</tr>
	<tr>
	<td class="td1">트윗 배경색</td>
	<td class="td2">:</td>
	<td class="td3">#<input type="text" name="bgcolor" value="<?php echo $wdgvar['bgcolor']?$wdgvar['bgcolor']:'ffffff'?>" size="6" class="input" /></td>
	</tr>
	<tr>
	<td class="td1">트윗 글자색</td>
	<td class="td2">:</td>
	<td class="td3">#<input type="text" name="color" value="<?php echo $wdgvar['color']?$wdgvar['color']:'666666'?>" size="6" class="input" /></td>
	</tr>
	<tr>
	<td class="td1">트윗 링크색</td>
	<td class="td2">:</td>
	<td class="td3">#<input type="text" name="link" value="<?php echo $wdgvar['link']?$wdgvar['link']:'2276BB'?>" size="6" class="input" /></td>
	</tr>
	<tr>
	<td class="td1">트윗 작동방식</td>
	<td class="td2">:</td>
	<td class="td3"><input type="text" name="behavior" value="<?php echo $wdgvar['behavior']?$wdgvar['behavior']:'alternative'?>" size="10" class="input" /></td>
	</tr>
	</table>
	
	<div class="btnbox">
	<?php if ($isWcode == 'Y'):?>
	<input type="button" value="위젯코드" class="btnblue" onclick="widgetCode();" />
	<?php else :?>
	<input type="submit" value="<?php echo $option?'속성변경':'위젯추가'?>" class="btnblue" />
	<?php endif?>
	</div>
	</form>


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
var RB_widgetCode;
function widgetCode()
{
	var f = document.procform;
	if (f.id.value == '')
	{
		alert('트위터 아이디를 입력해 주세요.      ');
		f.id.focus();
		return false;
	}

	var widgetName = "<?php echo $swidget?>";
	var widgetInfo = "";

	if(f.id.value) widgetInfo+= "'id'=>'"+f.id.value+"',";
	if(f.width.value) widgetInfo+= "'width'=>'"+f.width.value+"',";
	if(f.height.value) widgetInfo+= "'height'=>'"+f.height.value+"',";
	if(f.num.value) widgetInfo+= "'num'=>'"+f.num.value+"',";
	if(f.bgcolor1.value) widgetInfo+= "'bgcolor1'=>'"+f.bgcolor1.value+"',";
	if(f.color1.value) widgetInfo+= "'color1'=>'"+f.color1.value+"',";
	if(f.bgcolor.value) widgetInfo+= "'bgcolor'=>'"+f.bgcolor.value+"',";
	if(f.color.value) widgetInfo+= "'color'=>'"+f.color.value+"',";
	if(f.link.value) widgetInfo+= "'link'=>'"+f.link.value+"',";
	if(f.behavior.value) widgetInfo+= "'behavior'=>'"+f.behavior.value+"',";

	RB_widgetCode = "<"+"?php "+"getWidget('"+widgetName+"',array("+widgetInfo+"))?>";
	OpenWindow('./?system=popup.widgetcode&iframe=Y');
}
function saveCheck(f)
{
	if (f.id.value == '')
	{
		alert('트위터 아이디를 입력해 주세요.      ');
		f.id.focus();
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
	opener.createTile((f.width.value?f.width.value:200)+'px',(f.height.value?f.height.value:300)+'px','0px','0px');
	<?php else:?>
	opener.moveObject[n].style.width = getId('s_w').value + 'px';
	opener.moveObject[n].style.height = getId('s_h').value + 'px';
	opener.moveObject[n].style.top = getId('s_t').value + 'px';
	opener.moveObject[n].style.left = getId('s_l').value + 'px';
	<?php endif?>

	opener.blocktitle[n] = '트위터';
	opener.blockarray[n] = "<?php echo $swidget?>,id^" + f.id.value + ",width^"+f.width.value + ",height^" + f.height.value + ",num^"+f.num.value+",bgcolor1^" + f.bgcolor1.value + ",color1^"+f.color1.value + ",bgcolor^"+f.bgcolor.value + ",color^"+f.color.value + ",link^"+f.link.value + ",behavior^"+f.behavior.value;
	opener.getId('wtitle'+n).innerHTML = opener.blocktitle[n];
	top.close();
	return false;
}
//]]>
</script>

