<? include  $g['path_layout'].$d['layout']['dir'].'/_cross/loginbar.php'; ?>
<? include  $g['path_layout'].$d['layout']['dir'].'/_cross/'.$d['config']['site_theme'].'/top.php'; ?>

<? include $g['path_layout'].$d['layout']['dir'].'/_cross/content_top.php'?>
<div id="content">
<? if($my['level'] >= $admin['master'] || $d['config']['site_open'] == 1) { ?>
	<? if($g['window_full']=='min'){ ?><div class="wrap"><? } ?>

		<? if($d['config']['side_position']=='left' && !$system) { ?>
		<div class="aside">
		<? include $g['path_layout'].$d['layout']['dir'].'/_cross/side.php'; ?>
		</div>
		<? } ?>

		<div id="rcontent" class="center<? if($d['config']['side_position']&&!$system) { ?> m_side<? } ?>">
		<? include __KIMS_CONTENT__ ?>
		</div>

		<? if($d['config']['side_position']=='right' && !$system) { ?>
		<div class="bside">
		<? include $g['path_layout'].$d['layout']['dir'].'/_cross/side.php'; ?>	
		</div>
		<? } ?>
		
		<? if($d['config']['side_position']) { ?><div class="clear"></div><? } ?>

	<? if($g['window_full']=='min'){ ?></div><? } ?>
<? }else{ ?>
	<div class="wrap">
		<h2 style="font-family:DaumRegular; color:#666666;"><span class="glyphicon glyphicon-ban-circle"></span> 사이트 준비 중입니다.</h2>
	</div>
<? } ?>
</div>
<? include $g['path_layout'].$d['layout']['dir'].'/_cross/content_bottom.php'?>

<? include  $g['path_layout'].$d['layout']['dir'].'/_cross/'.$d['config']['site_theme'].'/bottom.php'; ?>
<? include  $g['path_layout'].$d['layout']['dir'].'/_cross/quickmenu.php'; ?>
<script type="text/javascript">
$(window).load(function(){
	quickmenu = new quickMenu('#quickmenu');
	topmenu = new topmenu();
});
</script>
