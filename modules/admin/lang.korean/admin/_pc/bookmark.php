
<?php if(!$_isDragScript):?>
<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/core.js"></script>
<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/events.js"></script>
<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/css.js"></script>
<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/coordinates.js"></script>
<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/drag.js"></script>
<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/dragsort.js"></script>
<script type="text/javascript">
//<![CDATA[
var dragsort = ToolMan.dragsort();
//]]>
</script>
<?php endif?>
<div id="catebody">
	<div id="category">
		<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $module?>" />
		<input type="hidden" name="a" value="" />

		<div class="title">
			즐겨찾는 페이지
		</div>
		
		<div class="tree">
			<ul id="moduleorder3">
			<?php $ADMPAGE = getDbArray($table['s_admpage'],'memberuid='.$my['uid'],'*','gid','asc',0,1)?>
			<?php while($R=db_fetch_array($ADMPAGE)):?>
			<li class="move">
				<input type="checkbox" name="bookmark_pages[]" value="<?php echo $R['uid']?>" />
				<span><?php echo $R['name']?></span>
			</li>
			<?php endwhile?>
			<?php if(!db_num_rows($ADMPAGE)):?>
			<li>
				<input type="checkbox" disabled="disabled" />
				등록된 페이지가 없습니다.
			</li>
			<?php endif?>
			</ul>
		</div>

		</form>
	</div>


	<div id="catinfo">
		
		<ul>
		<li><input type="button" value="순서변경" class="btnblue" onclick="actQue('bookmark_order');" /> : 즐겨찾는 페이지의 순서를 드래그한 후 클릭해주세요.</li>
		<li><input type="button" value="제외하기" class="btnblue" onclick="actQue('bookmark_delete');" /> : 페이지의 체크한 후 클릭해주세요.</li>
		</ul>

	</div>
	<div class="clear"></div>
</div>




<script type="text/javascript">
//<![CDATA[
function actQue(act)
{
	var f  = document.procForm;
    var l = document.getElementsByName('bookmark_pages[]');
    var n = l.length;
    var i;
	var j=0;

	if (act == 'bookmark_order')
	{
		if (confirm('정말로 이 순서를 저장하시겠습니까?     '))
		{

			for	(i = 0; i < n; i++)
			{
				l[i].checked = true;
			}

			f.a.value = act;
			f.submit();
		}
	}
	if (act == 'bookmark_delete')
	{
		f.a.value = act;
		f.submit();
	}
}
dragsort.makeListSortable(getId("moduleorder3"));
//]]>
</script>





