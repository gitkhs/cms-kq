<script type="text/javascript" charset="utf-8" src="<?=$g['s']?>/_core/js/jquery-ui.min.js"></script>
<link type="text/css" rel="stylesheet" charset="utf-8" href="<?=$g['s']?>/_core/css/jquery-ui.css">
<script type="text/javascript">
function makeDatepicker(obj) {
	obj.attr('readonly','readonly');
	obj.attr('style','width:100px; text-align:center; cursor:pointer;');
	obj.datepicker({
		showMonthAfterYear: true,
		changeMonth: true,
		changeYear: true,
		constrainInput: true,
//		showOn: "button",
		prevText: '◀',
		nextText: '▶',
		yearSuffix: '년',
		monthNames: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
		monthNamesShort: ['1월', '2월', '3월', '4월', '5월', '6월', '7월', '8월', '9월', '10월', '11월', '12월'],
		dayNamesMin: ['일', '월', '화', '수', '목', '금', '토'],
		dateFormat: 'yy-mm-dd'
	});
}
</script>