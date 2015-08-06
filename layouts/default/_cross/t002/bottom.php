<div id="footer">
	<div class="back-video">
	<video id="watercolor-video" preload="auto" poster="" data-setup="{}">
		  <source src="<?=$g['s']?>/files/_etc/images/bkmv.webm" type="video/webm">
		  <source src="<?=$g['s']?>/files/_etc/images/bkmv.mp4" type="video/mp4">
	</video>

	<?include $g['path_layout'].'footer.php';?>
	</div>
</div>

<style>
</style>

<script type="text/javascript">
//<![CDATA[
<?if(!$g['mobile']){?>
var		m_first = true;
$(document).ready(function(){
	playBottomVideo();
});
$(window).scroll(function(){
	playBottomVideo();
});
function playBottomVideo() {
	var video_offset = $('#watercolor-video').offset().top;
	var scroll_top		= $(window).scrollTop()+$(window).height();

	if(scroll_top >= video_offset && m_first) {
		m_first	= false;
		myVideo = document.getElementById("watercolor-video");
		myVideo.play();
	}
}
<?}?>

function screenCheck()
{
	var _h = getId('header');
	var _t = getId('topmenu');
	var _c = getId('content');
	var _f = getId('footer');
	var _r = getId('rcontent');
	var _w;

	var w = parseInt(document.body.clientWidth);
	var b = getOfs(_c.children[0]);

	_w = w < 960 ? w : 960;
	_w = _w < 240 ? 240 : _w;

	_h.children[0].style.width = _w + 'px';
	_t.children[0].style.width = _w + 'px';
	_c.children[0].style.width = _w + 'px';
	_f.children[0].style.width = _w + 'px';
	document.body.style.overflowX = 'hidden';
}
function showBizinfo(no) {
	window.open('https://www.ftc.go.kr/info/bizinfo/communicationViewPopup.jsp?wrkr_no='+no,'communicationViewPopup','width=750,height=700')
}
//setTimeout("screenCheck()",100);
//window.onresize = screenCheck;
//]]>
</script>