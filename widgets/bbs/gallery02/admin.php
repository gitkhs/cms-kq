


<div id="mjointbox">

	<div class="title">
		이 위젯(<span class="b"><?php echo getFolderName($g['path_widget'].$swidget)?></span>)을 추가하시겠습니까?
	</div>



	<form name="procform" onsubmit="return saveCheck(this);">


	<table>
	<tr>
	<td class="td1">게시판선택</td>
	<td class="td2">:</td>
	<td class="td3">
		<select name="bbsid" onchange="titleChange(this);">
		<option value="">&nbsp;+ 전체게시물</option>
		<option value="">----------------------------------</option>
		<?php $BBSLIST = getDbArray($table['bbslist'],'','*','gid','asc',0,1)?>
		<?php while($R=db_fetch_array($BBSLIST)):?>
		<option value="<?php echo $R['uid']?>^<?php echo $R['name']?>^<?php echo RW('m=bbs&bid='.$R['id'])?>"<?php if($wdgvar['bid']==$R['uid']):?> selected="selected"<?php endif?>>ㆍ<?php echo $R['name']?>(<?php echo $R['id']?>)</option>
		<?php endwhile?>
		</select>	
	</td>
	</tr>
	<tr>
	<td class="td1">타이틀</td>
	<td class="td2">:</td>
	<td class="td3"><input type="text" name="title" value="<?php echo $wdgvar['title']?$wdgvar['title']:'최근포스트'?>" size="36" class="input" /></td>
	</tr>
	<tr>
	<td class="td1">링크</td>
	<td class="td2">:</td>
	<td class="td3"><input type="text" name="link" value="<?php echo $wdgvar['link']?>" size="36" class="input" /></td>
	</tr>
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
	<td class="td1">노출개수</td>
	<td class="td2">:</td>
	<td class="td3">
		<select name="limit">
		<?php for($i = 2; $i < 21; $i=$i+2):?>
		<option value="<?php echo $i?>"<?php if($wdgvar['limit']==$i || (!$wdgvar['limit']&&$i==4)):?> selected="selected"<?php endif?>><?php echo $i?>개</option>
		<?php endfor?>
		</select>
	</td>
	</tr>
	<tr>
	<td class="td1"></td>
	<td class="td2"></td>
	<td class="td4">
		이 위젯은 가로 250px 고정 2행으로 노출됩니다.
	</td>
	</tr>
	<tr>
	<td class="td1">제목자르기</td>
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
	var bbsx = f.bbsid.value.split('^');
	var widgetName = "<?php echo $swidget?>";
	var widgetInfo = "";

	if(bbsx[0]) widgetInfo = "'bid'=>'"+bbsx[0]+"',";
	if(f.limit.value) widgetInfo+= "'limit'=>'"+f.limit.value+"',";
	if(f.sbjcut.value) widgetInfo+= "'sbjcut'=>'"+f.sbjcut.value+"',";
	if(f.title.value) widgetInfo+= "'title'=>'"+f.title.value+"',";
	if(f.link.value) widgetInfo+= "'link'=>'"+f.link.value+"',";

	RB_widgetCode = "<"+"?php "+"getWidget('"+widgetName+"',array("+widgetInfo+"))?>";
	OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&system=popup.widgetcode&iframe=Y');
}
function titleChange(obj)
{
	var f = document.procform;
	if (obj.value == '')
	{
		f.title.value = '최근포스트';
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
	opener.createTile('250px','300px','0px','0px');
	<?php endif?>

	var bbsx = f.bbsid.value.split('^');

	opener.blocktitle[n] = (bbsx[1]?'최근게시물('+bbsx[1]+')':'최근게시물(전체)');
	opener.blockarray[n] = "<?php echo $swidget?>,bid^" + bbsx[0] + ",limit^"+f.limit.value+",sbjcut^"+f.sbjcut.value+",link^"+f.link.value+",title^"+f.title.value;
	opener.getId('wtitle'+n).innerHTML = opener.blocktitle[n];
	top.close();
	return false;
}
//]]>
</script>

