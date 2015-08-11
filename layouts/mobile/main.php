<?
	$d['config']['site_theme_mobile'] = $d['config']['site_theme_mobile'] ? $d['config']['site_theme_mobile'] : 'm001';
?>
<? include  $g['path_layout'].$d['layout']['dir'].'/_cross/'.$d['config']['site_theme_mobile'].'/top.php'; ?>

<div id="content">
<? if($my['level'] >= $admin['master'] || $d['config']['site_open'] == 1) { ?>
	<? include __KIMS_CONTENT__?>
<? }else{ ?>
	<h2 style="font-family:DaumRegular; color:#666666;"><span class="glyphicon glyphicon-ban-circle"></span> 사이트 준비 중입니다.</h2>
<? } ?>
</div>

<? include  $g['path_layout'].$d['layout']['dir'].'/_cross/'.$d['config']['site_theme_mobile'].'/bottom.php'; ?>
