
<div id="mjointbox">

	<div class="title">
		이 위젯(<span class="b"><?php echo getFolderName($g['path_widget'].$swidget)?></span>)을 추가하시겠습니까?
	</div>


	<form name="procform" onsubmit="return saveCheck(this);">

	<table>
	<tr>
	<td class="td1">태그 타이틀</td>
	<td class="td2">:</td>
	<td class="td3">
		<input type="text" name="title" value="<?php echo $wdgvar['title']?$wdgvar['title']:'태그'?>" size="24" class="input" />
		<input type="checkbox" name="notuse" value="1"<?php if($wdgvar['notuse']):?> checked="checked"<?php endif?> />사용안함
	</td>
	</tr>
	<tr>
	<td class="td1">태그 노출수</td>
	<td class="td2">:</td>
	<td class="td3">
		<select name="limit">
		<?php for($i = 10; $i < 51; $i=$i+5):?>
		<option value="<?php echo $i?>"<?php if($wdgvar['limit']==$i || (!$wdgvar['limit']&&$i==25)):?> selected="selected"<?php endif?>>ㆍ<?php echo $i?>개</option>
		<?php endfor?>
		</select>
	</td>
	</tr>
	<tr>
	<td class="td1">집계 기간</td>
	<td class="td2">:</td>
	<td class="td3">
		<select name="term">
		<?php for($i = 7; $i < 71; $i=$i+7):?>
		<option value="<?php echo $i?>"<?php if($wdgvar['term']==$i || (!$wdgvar['term']&&$i==14)):?> selected="selected"<?php endif?>>ㆍ최근 <?php echo $i?>일이내</option>
		<?php endfor?>
		</select>
	</td>
	</tr>
	</table>

	<div class="btnbox">
	<input type="button" value="미리보기" class="btngray" onclick="imgOrignWin('<?php echo $g['url_root']?>/widgets/<?php echo $swidget?>/thumb.jpg');" />
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
#mjointbox .td1 {padding:0;letter-spacing:-1px;width:80px;}
#mjointbox .td2 {padding:0 15px 0 0;color:#c0c0c0;}
#mjointbox .td3 {}
#mjointbox .td3 select {width:230px;}
#mjointbox .td4 {padding:10px 0 0 0;color:#999;line-height:150%;}
#mjointbox .td5 {height:10px;}
#mjointbox .btnbox {text-align:center;padding:20px 0 0 0;margin:20px 0 0 0;border-top:#dfdfdf dashed 1px;}
</style>




<script type="text/javascript">
//<![CDATA[
var RB_widgetCode;
function widgetCode()
{
	var f = document.procform;
	var widgetName = "<?php echo $swidget?>";
	var widgetInfo = "";

	if(f.title.value) widgetInfo+= "'title'=>'"+f.title.value+"',";
	if(f.notuse.checked == true) widgetInfo+= "'notuse'=>'1',";
	if(f.limit.value) widgetInfo+= "'limit'=>'"+f.limit.value+"',";
	if(f.term.value) widgetInfo+= "'term'=>'"+f.term.value+"',";

	RB_widgetCode = "<"+"?php "+"getWidget('"+widgetName+"',array("+widgetInfo+"))?>";
	OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&system=popup.widgetcode&iframe=Y');
}
function saveCheck(f)
{
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
	opener.createTile('310px','185px','0px','0px');
	<?php endif?>

	opener.blocktitle[n] = '태그';
	opener.blockarray[n] = "<?php echo $swidget?>,title^"+f.title.value+",notuse^"+(f.notuse.checked==true?'1':'')+",limit^"+f.limit.value+",term^"+f.term.value;
	opener.getId('wtitle'+n).innerHTML = opener.blocktitle[n];
	top.close();
	return false;
}
//]]>
</script>

