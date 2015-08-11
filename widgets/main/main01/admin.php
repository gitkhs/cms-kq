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
	<td class="td1">요약위젯갯수</td>
	<td class="td2">:</td>
	<td class="td3">
	<select name="tabnum" onchange="this.form.submit();">
	<?php $tabnum = $tabnum ? $tabnum : ($wdgvar['tabnum']?$wdgvar['tabnum']-3:3)?>
	<?php for($i = 1; $i < 6; $i++):?>
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
	<td class="td1">[요약<?php echo $i?>] 게시판</td>
	<td class="td2">:</td>
	<td class="td3">
		<select name="bbsid<?php echo ($i+3)?>" onchange="titleChange(this,<?php echo ($i+3)?>);">
		<option value="">&nbsp;+ 선택하세요</option>
		<option value="">----------------------------------</option>
		<?php echo $BBSOPTI?>
		</select>
		<?php if($wdgvar['bid'.($i+3)]):?><?php $BBSSCRI.='getBBSselect('.($i+3).','.$wdgvar['bid'.($i+3)].');'?><?php endif?>
	</td>
	</tr>
	<tr>
	<td class="td1">[요약<?php echo $i?>] 타이틀</td>
	<td class="td2">:</td>
	<td class="td3"><input type="text" name="title<?php echo ($i+3)?>" value="<?php echo $wdgvar['title'.($i+3)]?>" size="36" class="input" /></td>
	</tr>
	<tr>
	<td class="td1">[요약<?php echo $i?>] 링크</td>
	<td class="td2">:</td>
	<td class="td3"><input type="text" name="link<?php echo ($i+3)?>" value="<?php echo $wdgvar['link'.($i+3)]?>" size="36" class="input" /></td>
	</tr>
	<?php endfor?>


	<tr><td colspan="3" class="td5"></td></tr>
	<tr>
	<td class="td1">리뷰 게시판</td>
	<td class="td2">:</td>
	<td class="td3">
		<select name="bbsid1" onchange="titleChange(this,1);">
		<option value="">&nbsp;+ 선택하세요</option>
		<option value="">----------------------------------</option>
		<?php echo $BBSOPTI?>
		</select>
		<?php if($wdgvar['bid1']):?><?php $BBSSCRI.='getBBSselect(1,'.$wdgvar['bid1'].');'?><?php endif?>
	</td>
	</tr>
	<tr>
	<td class="td1">리뷰 타이틀</td>
	<td class="td2">:</td>
	<td class="td3"><input type="text" name="title1" value="<?php echo $wdgvar['title1']?>" size="36" class="input" /></td>
	</tr>
	<tr>
	<td class="td1">리뷰 링크</td>
	<td class="td2">:</td>
	<td class="td3"><input type="text" name="link1" value="<?php echo $wdgvar['link1']?>" size="36" class="input" /></td>
	</tr>
	<tr>
	<td class="td1">리뷰 갯수</td>
	<td class="td2">:</td>
	<td class="td3">
		<select name="limit1">
		<?php for($i = 2; $i < 10; $i++):?>
		<option value="<?php echo $i?>"<?php if($wdgvar['limit1']==$i || (!$wdgvar['limit1']&&$i==4)):?> selected="selected"<?php endif?>><?php echo $i?>개</option>
		<?php endfor?>
		</select>
	</td>
	</tr>
	<tr><td colspan="3" class="td5"></td></tr>
	<tr>
	<td class="td1">갤러리 게시판</td>
	<td class="td2">:</td>
	<td class="td3">
		<select name="bbsid2" onchange="titleChange(this,2);">
		<option value="">&nbsp;+ 선택하세요</option>
		<option value="">----------------------------------</option>
		<?php echo $BBSOPTI?>
		</select>
		<?php if($wdgvar['bid2']):?><?php $BBSSCRI.='getBBSselect(2,'.$wdgvar['bid2'].');'?><?php endif?>
	</td>
	</tr>
	<tr>
	<td class="td1">갤러리 타이틀</td>
	<td class="td2">:</td>
	<td class="td3"><input type="text" name="title2" value="<?php echo $wdgvar['title2']?>" size="36" class="input" /></td>
	</tr>
	<tr>
	<td class="td1">갤러리 링크</td>
	<td class="td2">:</td>
	<td class="td3"><input type="text" name="link2" value="<?php echo $wdgvar['link2']?>" size="36" class="input" /></td>
	</tr>
	<tr>
	<td class="td1">갤러리 갯수</td>
	<td class="td2">:</td>
	<td class="td3">
		<select name="limit2">
		<?php for($i = 2; $i < 10; $i=$i+2):?>
		<option value="<?php echo $i?>"<?php if($wdgvar['limit2']==$i || (!$wdgvar['limit2']&&$i==8)):?> selected="selected"<?php endif?>><?php echo $i?>개</option>
		<?php endfor?>
		</select>
	</td>
	</tr>
	<tr><td colspan="3" class="td5"></td></tr>
	<tr>
	<td class="td1">최근글 게시판</td>
	<td class="td2">:</td>
	<td class="td3">
		<select name="bbsid3" onchange="titleChange(this,3);">
		<option value="">&nbsp;+ 선택하세요</option>
		<option value="">----------------------------------</option>
		<?php echo $BBSOPTI?>
		</select>
		<?php if($wdgvar['bid3']):?><?php $BBSSCRI.='getBBSselect(3,'.$wdgvar['bid3'].');'?><?php endif?>
	</td>
	</tr>
	<tr>
	<td class="td1">최근글 타이틀</td>
	<td class="td2">:</td>
	<td class="td3"><input type="text" name="title3" value="<?php echo $wdgvar['title3']?>" size="36" class="input" /></td>
	</tr>
	<tr>
	<td class="td1">최근글 링크</td>
	<td class="td2">:</td>
	<td class="td3"><input type="text" name="link3" value="<?php echo $wdgvar['link3']?>" size="36" class="input" /></td>
	</tr>
	<tr>
	<td class="td1">최근글 갯수</td>
	<td class="td2">:</td>
	<td class="td3">
		<select name="limit3">
		<?php for($i = 1; $i < 26;$i++):?>
		<option value="<?php echo $i?>"<?php if($wdgvar['limit3']==$i || (!$wdgvar['limit3']&&$i==10)):?> selected="selected"<?php endif?>><?php echo $i?>개</option>
		<?php endfor?>
		</select>
	</td>
	</tr>
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

	var tablen = parseInt(f.tabnum.value) + 3;
	for (i = 1; i <= tablen; i++)
	{
		bbsx = eval("f.bbsid"+i).value.split('^');
		if(bbsx[0]) widgetInfo+= "'bid"+i+"'=>'"+bbsx[0]+"',";
		if(eval("f.title"+i).value) widgetInfo+= "'title"+i+"'=>'"+eval("f.title"+i).value+"',";
		if(eval("f.link"+i).value) widgetInfo+= "'link"+i+"'=>'"+eval("f.link"+i).value+"',";
	}
	if(f.limit1.value) widgetInfo+= "'limit1'=>'"+f.limit1.value+"',";
	if(f.limit2.value) widgetInfo+= "'limit2'=>'"+f.limit2.value+"',";
	if(f.limit3.value) widgetInfo+= "'limit3'=>'"+f.limit3.value+"',";
	if(f.tabnum.value) widgetInfo+= "'tabnum'=>'"+tablen+"',";

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
	opener.createTile('730px','950px','0px','0px');
	<?php endif?>

	var bbsx;
	var tabvalue = "";
	var tablen = parseInt(f.tabnum.value)+3;
	for (i = 1; i <= tablen; i++)
	{
		bbsx = eval("f.bbsid"+i).value.split('^');
		tabvalue += ',bid' + i + '^' + bbsx[0] + ',title' + i + '^' + eval("f.title"+i).value + ',link' + i + '^' + eval("f.link"+i).value;
	}

	opener.blocktitle[n] = '메인구성';
	opener.blockarray[n] = "<?php echo $swidget?>,limit1^"+f.limit1.value+",limit2^"+f.limit2.value+",limit3^"+f.limit3.value+",tabnum^"+tablen + tabvalue;
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

