
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
	<td class="td1">탭의갯수</td>
	<td class="td2">:</td>
	<td class="td3">
	<select name="tabnum" onchange="this.form.submit();">
	<?php $tabnum = $tabnum ? $tabnum : ($wdgvar['tabnum']?$wdgvar['tabnum']:5)?>
	<?php for($i = 2; $i < 10; $i++):?>
	<option value="<?php echo $i?>"<?php if($tabnum==$i):?> selected="selected"<?php endif?>><?php echo $i?>개</option>
	<?php endfor?>
	</select>
	</td>
	</tr>
	</table>
	</form>

	<form name="procform" onsubmit="return saveCheck(this);">
	<input type="hidden" name="tabnum" value="<?php echo $tabnum?>" />

	<table>

	<?php $BBSOPTI = ""?>
	<?php $BBSSCRI = ""?>
	<?php $BBSLIST = getDbArray($table['bbslist'],'','*','gid','asc',0,1)?>
	<?php while($R=db_fetch_array($BBSLIST)):?>
	<?php $BBSOPTI.= '<option value="'.$R['uid'].'^'.$R['name'].'^'.RW('m=bbs&bid='.$R['id']).'">ㆍ'.$R['name'].'('.$R['id'].')</option>'?>
	<?php endwhile?>

	<?php for($i = 1; $i <= $tabnum; $i++):?>
	<tr><td colspan="3" class="td5"></td></tr>
	<tr>
	<td class="td1">[탭<?php echo $i?>] 게시판</td>
	<td class="td2">:</td>
	<td class="td3">
		<select name="bbsid<?php echo $i?>" onchange="titleChange(this,<?php echo $i?>);">
		<option value="">&nbsp;+ 선택하세요</option>
		<option value="">----------------------------------</option>
		<?php echo $BBSOPTI?>
		</select>
		<?php if($wdgvar['bid'.$i]):?><?php $BBSSCRI.='getBBSselect('.$i.','.$wdgvar['bid'.$i].');'?><?php endif?>
	</td>
	</tr>
	<tr>
	<td class="td1">[탭<?php echo $i?>] 타이틀</td>
	<td class="td2">:</td>
	<td class="td3"><input type="text" name="title<?php echo $i?>" value="<?php echo $wdgvar['title'.$i]?>" size="36" class="input" /></td>
	</tr>
	<tr>
	<td class="td1">[탭<?php echo $i?>] 링크</td>
	<td class="td2">:</td>
	<td class="td3"><input type="text" name="link<?php echo $i?>" value="<?php echo $wdgvar['link'.$i]?>" size="36" class="input" /></td>
	</tr>
	<?php endfor?>

	<tr><td colspan="3" class="td5"></td></tr>

	<tr>
	<td class="td1"></td>
	<td class="td2"></td>
	<td class="td4">
		링크입력시 more(더보기) 링크가 출력됩니다.<br />
		메뉴에 연결된 게시판일 경우 <span class="u">메뉴의 링크</span><br />
		를 입력해 주세요<br />
	</td>
	</tr>
	<tr>
	<td class="td1">게시글 노출수</td>
	<td class="td2">:</td>
	<td class="td3">
		<select name="limit">
		<?php for($i = 1; $i < 21; $i++):?>
		<option value="<?php echo $i?>"<?php if($wdgvar['limit']==$i || (!$wdgvar['limit']&&$i==5)):?> selected="selected"<?php endif?>><?php echo $i?>개</option>
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
#mjointbox .td1 {padding:0;letter-spacing:-1px;width:80px;}
#mjointbox .td2 {padding:0 15px 0 0;color:#c0c0c0;}
#mjointbox .td3 {}
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
	var bbsx;
	var widgetName = "<?php echo $swidget?>";
	var widgetInfo = "";

	var tablen = parseInt(f.tabnum.value);
	for (i = 1; i <= tablen; i++)
	{
		bbsx = eval("f.bbsid"+i).value.split('^');
		if(bbsx[0]) widgetInfo+= "'bid"+i+"'=>'"+bbsx[0]+"',";
		if(eval("f.title"+i).value) widgetInfo+= "'title"+i+"'=>'"+eval("f.title"+i).value+"',";
		if(eval("f.link"+i).value) widgetInfo+= "'link"+i+"'=>'"+eval("f.link"+i).value+"',";
	}
	if(f.limit.value) widgetInfo+= "'limit'=>'"+f.limit.value+"',";
	if(f.sbjcut.value) widgetInfo+= "'sbjcut'=>'"+f.sbjcut.value+"',";
	if(f.tabnum.value) widgetInfo+= "'tabnum'=>'"+f.tabnum.value+"',";

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

	var bbsx;
	var tabvalue = "";
	var tablen = parseInt(f.tabnum.value);
	for (i = 1; i <= tablen; i++)
	{
		bbsx = eval("f.bbsid"+i).value.split('^');
		tabvalue += ',bid' + i + '^' + bbsx[0] + ',title' + i + '^' + eval("f.title"+i).value + ',link' + i + '^' + eval("f.link"+i).value;
	}

	opener.blocktitle[n] = '탭게시물';
	opener.blockarray[n] = "<?php echo $swidget?>,limit^"+f.limit.value+",sbjcut^"+f.sbjcut.value+",tabnum^"+f.tabnum.value + tabvalue;
	opener.getId('wtitle'+n).innerHTML = opener.blocktitle[n];
	top.close();
	return false;
}
function getBBSselect(i,bbs)
{
	var f = document.procform;
	var bbsx;
	var xval = "";
	var x = eval("f.bbsid"+i);

	for (i = 0; i < x.length; i++)
	{
		bbsx = x[i].value.split('^');
		if (bbs == parseInt(bbsx[0]))
		{
			x.value = x[i].value;
			break;
		}
	}
}
<?php echo $BBSSCRI?>
//]]>
</script>

