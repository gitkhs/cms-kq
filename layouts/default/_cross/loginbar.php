<div id="loginbar_banner" style="<?if($_SESSION['topbanner']){?>display:none;<?}?>">
<?
$loginbar_file= $g['path_layout'].'topbanner.php';
if(is_file(loginbar_file)) {
	$topbanner	= implode('',file(loginbar_file));
	$topbanner	= str_replace("\r","",$topbanner);
	$topbanner	= str_replace("\n","",$topbanner);
}
if(!$_SESSION['topbanner'] && $d['config']['banner_top_use']){
	echo $topbanner;
}
?>
</div>

<div id="loginbar">
	<div class="wrap">
		<div class="left">
		<? if($d['config']['banner_top_use']){ ?>
			<form name="frmTopbanner" method="post" action="<?=$g['s']?>/" target="_action_frame_<?=$m?>" onsubmit="toggleTopBanner();">
			<input type="hidden" name="m" value="home">
			<input type="hidden" name="a" value="topbanner">
			<label class="ctrl-chk"><input type="checkbox" name="hidden" value="Y" <?if($_SESSION['topbanner']){?>checked="checked"<?}?>> 오늘 하루 이창을 그만 엽니다.</label>
			<a href="#" onclick="$('form[name=frmTopbanner]').submit(); return false;" title="배너 보기" target="_action_frame_<?=$m?>"><span id="loginbar_banner_btn" class="glyphicon glyphicon-chevron-<?if($_SESSION['topbanner']){?>down<?}else{?>up<?}?>"></span></a>
			</form>
		<? } ?>
		</div>
		<ul class="lst-right">
		<?if($my['uid']){?>
			<li><a href="#" onclick="pageLogout();">로그아웃</a></li>
			<li><span class="bar">|</span> <a href="<?php echo RW('mod=mypage')?>">나의계정</a></li>
			<?if($my['admin'] || $my['level'] >= $admin['admin']){?><li><span class="bar">|</span><a href="<?=$g['s']?>/?r=<?=$r?>&amp;m=setting&amp;mod=admin">관리자</a></li><?}?>
			<?if($my['admin'] || $my['level'] >= $admin['master']){?><li><span class="bar">|</span><a href="<?=$g['s'].'/?r='.$r.'&m=setting&mod=master&div=setting'?>" style="color:#e02a3b;">세팅</a></li><?}?>
		<?}else{?>
			<li><a href="#." onclick="crLayer('로그인','<?php echo $g['s']?>/?r=<?php echo $r?>&amp;system=iframe.login&amp;iframe=Y&amp;referer=<?php echo urlencode($g['s'].'/?'.$_SERVER['QUERY_STRING'])?>','iframe',270,270,'15%');">로그인</a></li>
			<?if($d['config']['site_member']){?><li><span class="bar">|</span><a href="<?php echo RW('mod=join')?>">회원가입</a></li><?}?>
		<?}?>
		</ul>
		<div class="clear"></div>
	</div>
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
function toggleTopBanner() {
	var bar = $('#loginbar_banner');
	var btn = $('#loginbar_banner_btn');
	if(bar.css('display') == 'none') {
		bar.html('<?=$topbanner?>');
		btn.removeClass('glyphicon-chevron-down');
		btn.addClass('glyphicon-chevron-up');
	}
	else {
		btn.removeClass('glyphicon-chevron-up');
		btn.addClass('glyphicon-chevron-down');
	}

	bar.slideToggle();
}
</script>
