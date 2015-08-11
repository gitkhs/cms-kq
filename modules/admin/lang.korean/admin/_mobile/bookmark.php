
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


		
<input type="button" value="제외하기" class="btnblue" onclick="actQue('bookmark_delete');" /> : 체크한 후 터치해주세요.







<script type="text/javascript">
//<![CDATA[
function actQue(act)
{
	var f  = document.procForm;
    var l = document.getElementsByName('bookmark_pages[]');
    var n = l.length;
    var i;
	var j=0;

	if (act == 'bookmark_delete')
	{
		f.a.value = act;
		f.submit();
	}
}
//]]>
</script>





