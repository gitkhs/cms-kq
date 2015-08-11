<div id="header">
	<div class="title">
		<a href="<?=$g['s'].'/?r='.$r?>"><?=$_HS['name']?></a>
	</div>
	<div class="loginbar">
		<? if($my['uid']) { ?>
		<a href="#" onclick="pageLogout();" style="color:#000000;"><span class="glyphicon glyphicon-log-out"></span></a>
		<? } else { ?>
		<a href="<?=$g['s']?>/?mod=login"><span class="glyphicon glyphicon-log-in"></span></a>
		<? } ?>

		<a href="<?=$g['s']?>/?r=<?=$r?>&amp;_themePage=menu"><span class="glyphicon glyphicon-th-list menu"></span></a>
	</div>
	<div class="clear"></div>
</div>

<? include_once $g['path_core'].'com/social/facebook.php'?>
<script type="text/javascript">
	function pageLogout() {
		<? if($_SESSION['sns_login'] == 'f') { ?>
			FB.logout(function(response) { goHref('<?=$g['s']?>/?r=<?=$r?>&a=logout'); });
		<? } else { ?>
			goHref('<?=$g['s']?>/?r=<?=$r?>&a=logout');
		<? } ?>
	}
</script>
