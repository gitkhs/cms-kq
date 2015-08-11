<script type="text/javascript">
<? if($_SESSION['appmode']){ ?>
$(document).ready(function(){
	window.android.loginOK('<?=$my['uid']?>');
});
<? } ?>
</script>