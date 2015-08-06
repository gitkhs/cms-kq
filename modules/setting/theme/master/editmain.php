<?
	$ver	= $ver ? $ver : 'pc';

	if($ver == 'pc') {
		$file_source	= $g['path_page'].'main.php';
		$file_style		= $g['path_page'].'main.css';
	}
	else if($ver == 'mobile') {
		$file_source	= $g['path_page'].'main_mobile.php';
		$file_style		= $g['path_page'].'main_mobile.css';
	}
	else {
		$file_source	= $g['path_page'].'main_app.php';
		$file_style		= $g['path_page'].'main_app.css';
	}
?>
<link rel="stylesheet" href="<?=$g['s']?>/_core/com/codemirror/codemirror.css">
<script src="<?=$g['s']?>/_core/com/codemirror/codemirror.js"></script>
<script src="<?=$g['s']?>/_core/com/codemirror/css.js"></script>
<script src="<?=$g['s']?>/_core/com/codemirror/matchbrackets.js"></script>
<script src="<?=$g['s']?>/_core/com/codemirror/htmlmixed.js"></script>
<script src="<?=$g['s']?>/_core/com/codemirror/xml.js"></script>
<script src="<?=$g['s']?>/_core/com/codemirror/javascript.js"></script>
<script src="<?=$g['s']?>/_core/com/codemirror/clike.js"></script>
<script src="<?=$g['s']?>/_core/com/codemirror/php.js"></script>
<div id="editfooter">
	<form name="frmBanner" method="post" action="<?=$g['s']?>/" target="_action_frame_<?=$m?>" onsubmit="return chkWrite(this);">
	<input type="hidden" name="r" value="<?=$r?>" />
	<input type="hidden" name="a" value="<?=$mod?>" />
	<input type="hidden" name="m" value="<?=$m?>" />
	<input type="hidden" name="div" value="<?=$div?>" />
	<input type="hidden" name="file_source" value="<?=$file_source?>" />
	<input type="hidden" name="file_style" value="<?=$file_style?>" />
	
	<table class="tbl-form">
	<tr>
		<td colspan="2">
			<div class="left">
			<input type="button" class="<?if($ver=='pc'){?>btnnavy<?}else{?>btnsky<?}?>" value="PC 버전" onclick="changeVersion('pc');">
			<input type="button" class="<?if($ver=='mobile'){?>btnnavy<?}else{?>btnsky<?}?>" value="Mobile 버전" onclick="changeVersion('mobile');">
			<input type="button" class="<?if($ver=='app'){?>btnnavy<?}else{?>btnsky<?}?>" value="app 버전" onclick="changeVersion('app');">
			</div>
			<div class="right" style="font-size:15pt;">
			<label onclick="changeView();"><span class="glyphicon glyphicon-transfer"></span></label>
			</div>
			<div class="clear"></div>
		</td>
	</tr>
	<tr>
		<td id="vi_source">
		<textarea id="str_source" name="str_source"><?if(is_file($file_source)){ echo implode('',file($file_source));}?></textarea>
		</td>
		<td id="vi_style">
		<textarea id="str_style" name="str_style"><?if(is_file($file_style)){ echo implode('',file($file_style));}?></textarea>
		</td>
	</tr>
	<tr>
		<td colspan="2" class="submit">
		<input type="submit" class="btnblue btnsz01" value=" 확 인 ">
		</td>
	</tr>
	</table>
	
	</form>
</div>


<script type="text/javascript">
var edtSource = CodeMirror.fromTextArea(document.getElementById("str_source"), {
	matchBrackets: true,
	mode: "application/x-httpd-php",
	indentUnit: 4,
	indentWithTabs: true,
	enterMode: "keep",
	tabMode: "shift",
	lineNumbers: true
});
var edtStyle = CodeMirror.fromTextArea(document.getElementById("str_style"), {
	matchBrackets: true,
	indentUnit: 4,
	indentWithTabs: true,
	enterMode: "keep",
	tabMode: "shift",
	lineNumbers: true
});

function changeView() {
	if($('#vi_source').width() < 700) {
		$('#vi_source').width(700);
		$('#vi_source').find('.CodeMirror').width(700);
		$('#vi_style').width(233);
		$('#vi_style').find('.CodeMirror').width(233);
	}
	else {
		$('#vi_source').width(233);
		$('#vi_source').find('.CodeMirror').width(233);
		$('#vi_style').width(700);
		$('#vi_style').find('.CodeMirror').width(700);
	}
}
function changeVersion(v) {
	goHref('<?=$g['s']?>/?m=<?=$m?>&mod=<?=$mod?>&div=<?=$div?>&ver='+v);
}
</script>
