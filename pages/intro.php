<div id="slider_intro" class="slider-images">
<div class="first bg" style="background:url(<?=$g['s']?>/files/_etc/images/intro_background01.jpg) center no-repeat; background-size:cover;"></div>
<div class="bg" style="background:url(<?=$g['s']?>/files/_etc/images/intro_background02.jpg) center no-repeat; background-size:cover;"></div>
<div class="bg" style="background:url(<?=$g['s']?>/files/_etc/images/intro_background03.jpg) center no-repeat; background-size:cover;"></div>
<div class="bg" style="background:url(<?=$g['s']?>/files/_etc/images/intro_background04.jpg) center no-repeat; background-size:cover;"></div>

<div style="position:absolute; top:0; width:100%;">
1111
	<label><input type="checkbox" id="skip_intor" value="Y" onclick="skipIntor();"> SKIP</label>
</div>
</div>
<script type="text/javascript">slider_intro = new fadeImage({id:'slider_intro',interval:10000});</script>

				
<form name="frmIntro" method="post"  action="<?=$g['s']?>/" target="_action_frame_<?=$m?>">
	<input type="hidden" name="r" value="<?=$r?>" />
	<input type="hidden" name="m" value="<?=$m?>" />
	<input type="hidden" name="a" value="intro" />
	<input type="hidden" name="skip" value="" />
	<input type="hidden" name="link" value="" />
</form>


<script type="text/javascript">
$(document).ready(function(){
	var h = $(window).height();
	$('#intro').css('height',h);
	$('.bg').css('height',h);
});
$(window).resize(function(){
	var h = $(window).height();
	var w = $(window).width();
	$('#intro').css('height',h);
	$('#intro').css('width',w);
	$('.bg').css('height',h);
	$('.bg').css('width',w);
});
function skipIntor() {
	var frm = $('form[name=frmIntro]');
	frm.submit();
}
</script>