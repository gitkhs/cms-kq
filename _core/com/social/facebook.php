<? include $g['path_layout'].'_config.php'; ?>
<script type="text/javascript">
	window.fbAsyncInit = function() {
		FB.init({
			appId      : '<?=$d['config']['facebook_appid']?>',
			cookie     : true,
			xfbml      : true,
			version    : 'v2.1'
		});

		FB.getLoginStatus(function(response) {
			<? if($system) { ?>statusChangeCallback(response);<? } ?>
		});
	};
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_KR/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>