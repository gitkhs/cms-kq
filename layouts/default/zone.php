<? if($d['config']['site_intro'] && !$_SESSION['intro_skip']){ ?>
	<link type="text/css" rel="stylesheet" charset="utf-8" href="<?=$g['path_page'].'intro.css'; ?>">
	<? include $g['path_page'].'intro.php'; ?>
<? }else{ ?>

	<? include  $g['path_layout'].$d['layout']['dir'].'/_cross/loginbar.php'; ?>
	<? include  $g['path_layout'].$d['layout']['dir'].'/_cross/'.$_HS['theme'].'/top.php'; ?>

	<div id="content">
	<? if($my['level'] >= $admin['master'] || $d['config']['site_open'] == 1) { ?>
		<?php include __KIMS_CONTENT__?>
	<? }else{ ?>
		<div class="wrap">
			<h2 style="font-family:DaumRegular; color:#666666;"><span class="glyphicon glyphicon-ban-circle"></span> 사이트 준비 중입니다.</h2>
		</div>
	<? } ?>
	</div>

	<? include  $g['path_layout'].$d['layout']['dir'].'/_cross/'.$_HS['theme'].'/bottom.php'; ?>
	<? include  $g['path_layout'].$d['layout']['dir'].'/_cross/quickmenu.php'; ?>
<script type="text/javascript">
$(window).load(function(){
	quickmenu = new quickMenu('#quickmenu');
	topmenu = new topmenu();
});
</script>

<? } ?>