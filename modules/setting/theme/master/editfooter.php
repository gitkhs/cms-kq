<?$file= $g['path_layout'].'footer.php';?>
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
	
	<table class="tbl-form">
	<colgroup>
	<col width="150px">
	<col>
	</colgroup>
	<tr>
		<td>
		<textarea id="str_code" name="str_code"><?if(is_file($file)){ echo htmlspecialchars(implode('',file($file)));}?></textarea>
		</td>
	</tr>
	<tr>
		<td class="submit">
		<input type="submit" class="btnblue btnsz01" value=" 확 인 ">
		</td>
	</tr>
	</table>
	
	</form>
</div>


<script type="text/javascript">
var editor = CodeMirror.fromTextArea(document.getElementById("str_code"), {
	matchBrackets: true,
	mode: "application/x-httpd-php",
	indentUnit: 4,
	indentWithTabs: true,
	enterMode: "keep",
	tabMode: "shift",
	lineNumbers: true
});
</script>
