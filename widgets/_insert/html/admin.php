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
	<form name="procform" action="<?php echo $g['s']?>/" method="post" target="_action_frame_">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="m" value="<?php echo $g['sys_module']?>" />
	<input type="hidden" name="a" value="widgetdata_save" />
	<input type="hidden" name="widget" value="<?php echo $swidget?>" />
	<input type="hidden" name="savedir" value="data" />
	<input type="hidden" name="savename" value="<?php echo $wdgvar['savename']?$wdgvar['savename']:$date['totime']?>" />

	<textarea name="source" id="sourceArea" rows="18" cols="54"><?php @readfile($g['path_widget'].$swidget.'/data/'.$wdgvar['savename'].'.txt')?></textarea>
	<div class="btnbox">
	<input type="button" value="편집기" class="btngray" onclick="editWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&system=edit.editor&iframe=Y&droparea=sourceArea');" />
	<input type="button" value="<?php echo $option?'속성변경':'위젯추가'?>" class="btnblue" onclick="saveCheck();" />
	</div>
	</form>
	<iframe name="_action_frame_" width="0" height="0" frameborder="0" scrolling="no"></iframe>
	<?php endif?>


</div>

<style type="text/css">
#mjointbox {}
#mjointbox .title {border-bottom:#dfdfdf dashed 1px;padding:0 0 10px 0;margin:0 0 20px 0;}
#mjointbox textarea {padding:5px 0 5px 5px;line-height:150%;color:#000000;font-family:Courier new, arial, dotum;font-size:9pt;text-align:left;}
#mjointbox .btnbox {text-align:center;padding:20px 0 0 0;}
</style>



<script type="text/javascript">
//<![CDATA[
function editWindow(url) 
{
	window.open(url,'','left=0,top=0,width=800px,height=750px,statusbar=no,scrollbars=no,toolbar=no,resizable=yes');
}
function saveCheck()
{
	var f = document.procform;
	if (f.source.value == '')
	{
		alert('HTML소스를 입력해 주세요.      ');
		f.source.focus();
		return;
	}

	f.submit();

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
	opener.createTile('355px','150px','0px','0px');
	<?php endif?>

	opener.blocktitle[n] = 'HTML소스';
	opener.blockarray[n] = "<?php echo $swidget?>,savename^" + f.savename.value;
	opener.getId('wtitle'+n).innerHTML = opener.blocktitle[n];
	top.close();
}
//]]>
</script>

