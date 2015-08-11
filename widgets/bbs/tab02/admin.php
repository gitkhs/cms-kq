
<div id="mjointbox">

	<div class="title">
		이 위젯(<span class="b"><?php echo getFolderName($g['path_widget'].$swidget)?></span>)을 추가하시겠습니까?
	</div>

	<form action="<?php echo $g['s']?>/" method="get">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="system" value="<?php echo $system?>" />
	<input type="hidden" name="iframe" value="<?php echo $iframe?>" />
	<input type="hidden" name="pwd" value="<?php echo $pwd?>" />
	<input type="hidden" name="dropfield" value="<?php echo $dropfield?>" />
	<input type="hidden" name="option" value="<?php echo $option?>" />
	<input type="hidden" name="isWcode" value="<?php echo $isWcode?>" />
	<table>
	<tr>
	<td class="td1">게시판선택</td>
	<td class="td2">:</td>
	<td class="td3">
		<select name="bbsuid" onchange="this.form.submit();">
		<option value="">&nbsp;+ 선택해주세요.</option>
		<option value="">----------------------------------</option>
		<?php $G=array()?>
		<?php $tabnum = $tabnum ? $tabnum : ($wdgvar['tabnum']?$wdgvar['tabnum']:5)?>
		<?php $bbsuid = $bbsuid ? $bbsuid : ($wdgvar['bbsuid']?$wdgvar['bbsuid']:0)?>
		<?php $BBSLIST = getDbArray($table['bbslist'],"category<>''",'*','gid','asc',0,1)?>
		<?php while($R=db_fetch_array($BBSLIST)):?>
		<option value="<?php echo $R['uid']?>"<?php if($bbsuid==$R['uid']):$G=$R?> selected="selected"<?php endif?>>ㆍ<?php echo $R['name']?>(<?php echo $R['id']?>)</option>
		<?php endwhile?>
		<?php if(!db_num_rows($BBSLIST)):?>
		<option value="">ㆍ분류를 사용하는 게시판이 없습니다.</option>
		<?php endif?>
		</select>
	</td>
	</tr>
	<tr>
	<td class="td1">탭의갯수</td>
	<td class="td2">:</td>
	<td class="td3">
		<select name="tabnum" onchange="this.form.submit();">
		<?php for($i = 2; $i < 10; $i++):?>
		<option value="<?php echo $i?>"<?php if($tabnum==$i):?> selected="selected"<?php endif?>>ㆍ<?php echo $i?>개</option>
		<?php endfor?>
		</select>
	</td>
	</tr>
	</table>
	</form>

	<form name="procform" onsubmit="return saveCheck(this);">
	<input type="hidden" name="tabnum" value="<?php echo $tabnum?>" />
	<input type="hidden" name="bbsuid" value="<?php echo $bbsuid?>" />
	<input type="hidden" name="bbsid" value="<?php echo $G['id']?>" />

	<table>

	<?php if($bbsuid):?>
	<?php $catexp=explode(',',$G['category'])?>
	<?php for($i = 1; $i <= $tabnum; $i++):?>
	<tr><td colspan="3" class="td5"></td></tr>
	<tr>
	<td class="td1">[탭<?php echo $i?>] 분류/타이틀</td>
	<td class="td2">:</td>
	<td class="td3">
	<input type="hidden" name="cat<?php echo $i?>" value="<?php echo $catexp[$i]?>" />
	<input type="text" value="<?php echo $catexp[$i]?>" size="15" class="input" readonly="readonly" disabled="disabled" />
	<input type="text" name="title<?php echo $i?>" value="<?php echo $wdgvar['title'.$i]?$wdgvar['title'.$i]:$catexp[$i]?>" size="18" class="input" />
	</td>
	</tr>
	<?php endfor?>
	<?php endif?>

	<tr><td colspan="3" class="td5"></td></tr>

	<tr>
	<td class="td1">게시글 노출수</td>
	<td class="td2">:</td>
	<td class="td3">
		<select name="limit">
		<?php for($i = 1; $i < 21; $i++):?>
		<option value="<?php echo $i?>"<?php if($wdgvar['limit']==$i || (!$wdgvar['limit']&&$i==5)):?> selected="selected"<?php endif?>>ㆍ<?php echo $i?>개</option>
		<?php endfor?>
		</select>
	</td>
	</tr>
	<tr>
	<td class="td1">제목 자르기</td>
	<td class="td2">:</td>
	<td class="td3"><input type="text" name="sbjcut" value="<?php echo $wdgvar['sbjcut']?>" size="6" class="input" />자에서 자름(미입력시 자르지 않음)</td>
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
#mjointbox .td1 {padding:0;letter-spacing:-1px;width:90px;}
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
	if (f.bbsuid.value == '0')
	{
		alert('게시판을 선택해 주세요.  ');
		return false;
	}

	var widgetName = "<?php echo $swidget?>";
	var widgetInfo = "";

	var tablen = parseInt(f.tabnum.value);
	for (i = 1; i <= tablen; i++)
	{
		if(eval("f.title"+i).value) widgetInfo+= "'title"+i+"'=>'"+eval("f.title"+i).value+"',";
		if(eval("f.cat"+i).value) widgetInfo+= "'cat"+i+"'=>'"+eval("f.cat"+i).value+"',";
	}
	if(f.limit.value) widgetInfo+= "'limit'=>'"+f.limit.value+"',";
	if(f.sbjcut.value) widgetInfo+= "'sbjcut'=>'"+f.sbjcut.value+"',";
	if(f.tabnum.value) widgetInfo+= "'tabnum'=>'"+f.tabnum.value+"',";
	if(f.bbsuid.value) widgetInfo+= "'bbsuid'=>'"+f.bbsuid.value+"',";
	if(f.bbsid.value) widgetInfo+= "'bbsid'=>'"+f.bbsid.value+"',";

	RB_widgetCode = "<"+"?php "+"getWidget('"+widgetName+"',array("+widgetInfo+"))?>";
	OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&system=popup.widgetcode&iframe=Y');
}
function titleChange(obj,i)
{
	var f = document.procform;
	if (obj.value == '')
	{
		alert('게시판을 선택해 주세요.');
		obj.focus();
		return false;
	}
	var tt = obj.value.split('^');
	eval("f.title"+i).value = tt[1];
	eval("f.link"+i).value = tt[2];
	eval("f.link"+i).focus();
}
function saveCheck(f)
{
	if (f.bbsuid.value == '0')
	{
		alert('게시판을 선택해 주세요.  ');
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
	opener.createTile('440px','200px','0px','0px');
	<?php endif?>

	var tabvalue = "";
	var tablen = parseInt(f.tabnum.value);
	for (i = 1; i <= tablen; i++)
	{
		tabvalue += ',title' + i + '^' + eval("f.title"+i).value + ',cat' + i + '^' + eval("f.cat"+i).value;
	}

	opener.blocktitle[n] = '탭게시물(분류게시판)';
	opener.blockarray[n] = "<?php echo $swidget?>,limit^"+f.limit.value+",sbjcut^"+f.sbjcut.value+",tabnum^"+f.tabnum.value+",bbsuid^"+f.bbsuid.value+",bbsid^"+f.bbsid.value + tabvalue;
	opener.getId('wtitle'+n).innerHTML = opener.blocktitle[n];
	top.close();
	return false;
}
//]]>
</script>

