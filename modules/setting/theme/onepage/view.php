<?
	$RS	= getDbSelect($table['s_menu'],'site='.$s.' and parent='.$_HM['uid'].' and hidden=0 and depth=2 order by gid asc','*');
	while($_R=db_fetch_array($RS)) {
		unset($item);
		$item		= getDbData($table['s_stdpage'], "pid='{$_R['uid']}'", "*");
		if($item['pid']) {
			$item['name']	= $_R['name'];
			$lst_page[]	= $item;
		}
	}

?>
<div id="view">
	<?if($my['level']>=$admin['admin']){?>
	<div class="admin-bar">
		<input type="button" class="btndef" value=" 글작성 " onclick="goHref('<?=$g['s']?>/?m=setting&mod=onepage&div=write&mid=<?=$_HM['uid']?>');">
	</div>
	<?}?>
	<?foreach($lst_page as $_R) {?>
	<section id="pageid<?=$_R['pid']?>"><?=$_R['content']?></section>
	<?}?>
</div>

<style>
/*.vi-bg {min-height:100px; background:url(<?=$g['s']?>/files/_etc/images/intro_background01.jpg) bottom no-repeat; background-size:cover;}*/
</style>
