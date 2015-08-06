<?php if($type == 'modify'):?>

	<?php include_once $g['dir_module_skin'].'_write.php'?>

<?php else:?>

	<?php if($R['uid']):?>
		<?php if ($isSECRETCHECK):?>
		<?php include_once $g['dir_module_skin'].'_view.php'?>
		<?php else:?>
		<?php include_once $g['dir_module_skin'].'_pwcheck.php'?>
		<?php endif?>
	<?php endif?>

	<?php include_once $g['dir_module_skin'].'_list.php'?>
	<?php include_once $g['dir_module_skin'].'_write.php'?>

<?php endif?>


<script type="text/javascript">
//<![CDATA[
function frameSetting()
{
	var obj = parent.getId(frames.name);
	if(obj)
	{
		obj.style.height = parseInt(document.body.scrollHeight) + 'px';
		if(parent.getId('comment_num<?php echo $cyncArr['data'][1]?>'))
		{
			parent.getId('comment_num<?php echo $cyncArr['data'][1]?>').innerHTML = '<?php echo ($NUM+count($NCD))?>';
		}
	}
	
	<?php if($type != 'modify' && $uid && $isSECRETCHECK):?>
	var ofs = getOfs(getId('vContent')); 
	getDivWidth(ofs.width,'vContent');
	<?php endif?>
}
window.onload = frameSetting;
//]]>
</script>