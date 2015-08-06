


<div id="mjointbox">

	<div class="title">
		이 위젯(<span class="b"><?php echo getFolderName($g['path_widget'].$swidget)?></span>)을 추가하시겠습니까?
	</div>



	<form name="procform" onsubmit="return saveCheck(this);">


	<table>
	<tr>
	<td class="td1">댓글테마</td>
	<td class="td2">:</td>
	<td class="td3">
		<select name="c_skin" class="select1">
		<option value="">&nbsp;+ 댓글 대표테마</option>
		<option value="">--------------------------------</option>
		<?php $tdir = $g['path_module'].'comment/theme/_pc/'?>
		<?php $dirs = opendir($tdir)?>
		<?php while(false !== ($skin = readdir($dirs))):?>
		<?php if($skin=='.' || $skin == '..' || is_file($tdir.$skin))continue?>
		<option value="_pc/<?php echo $skin?>" title="<?php echo $skin?>"<?php if($wdgvar['c_skin']=='_pc/'.$skin):?> selected="selected"<?php endif?>>ㆍ<?php echo getFolderName($tdir.$skin)?>(<?php echo $skin?>)</option>
		<?php endwhile?>
		<?php closedir($dirs)?>
		</select>
	</td>
	</tr>
	<tr>
	<td class="td1">댓글열기</td>
	<td class="td2">:</td>
	<td class="td3 shift">
		<input type="checkbox" name="c_open" value="1"<?php if($wdgvar['c_open']):?> checked="checked"<?php endif?> />자동펼침
	</td>
	</tr>
	<tr>
	<td class="td1">추출제외</td>
	<td class="td2">:</td>
	<td class="td3 shift">
		<input type="checkbox" name="c_hidepost" value="1"<?php if($wdgvar['c_hidepost']):?> checked="checked"<?php endif?> />최근댓글 출력에서 제외합니다.
	</td>
	</tr>
	<tr>
	<td class="td1"></td>
	<td class="td2"></td>
	<td class="td4">
		삽입된 댓글상자의 가로폭은 위젯폭에 맞춰지며<br />
		높이는 자동으로 조절됩니다.
	</td>
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
#mjointbox .td4 {padding:10px 0 0 0;color:#999;line-height:150%;}
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

	if(f.c_skin.value) widgetInfo+= "'c_skin'=>'"+f.c_skin.value+"',";
	if(f.c_open.checked == true) widgetInfo+= "'c_open'=>'1',";
	if(f.c_hidepost.checked == true) widgetInfo+= "'c_hidepost'=>'1',";

	RB_widgetCode = "<"+"?php "+"getWidget('"+widgetName+"',array("+widgetInfo+"))?>";
	OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&system=popup.widgetcode&iframe=Y');
}
function titleChange(obj)
{
	var f = document.procform;
	if (obj.value == '')
	{
		f.title.value = '댓글달기';
		f.link.value = '';
		f.title.focus();
	}
	else {
		var tt = obj.value.split('^');
		f.title.value = tt[1];
		f.link.value = tt[2];
		f.link.focus();
	}
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
	opener.createTile('650px','150px','0px','0px');
	<?php endif?>

	opener.blocktitle[n] = '댓글달기';
	opener.blockarray[n] = "<?php echo $swidget?>,c_skin^"+f.c_skin.value+",c_open^"+(f.c_open.checked==true?1:0)+",c_hidepost^"+(f.c_hidepost.checked==true?1:0);
	opener.getId('wtitle'+n).innerHTML = opener.blocktitle[n];
	top.close();
	return false;
}
//]]>
</script>

