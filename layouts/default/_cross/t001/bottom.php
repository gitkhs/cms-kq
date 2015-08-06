<div id="footer">
</div>

<script type="text/javascript">
//<![CDATA[
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