<?
	$ver	= $ver ? $ver : 'pc';

	if($ver == 'pc') {
		$file	= $g['path_layout'].$d['layout']['dir'].'/_cross/'.$d['config']['site_theme'].'/theme.css';
	}
	else {
		$file	= $g['path_layout'].'mobile/_cross/'.$d['config']['site_theme_mobile'].'/theme.css';
	}
?>
<link rel="stylesheet" href="<?=$g['s']?>/_core/com/codemirror/codemirror.css">
<script src="<?=$g['s']?>/_core/com/codemirror/codemirror.js"></script>
<script src="<?=$g['s']?>/_core/com/codemirror/css.js"></script>
<div id="topbanner">
	<form name="frmBanner" method="post" action="<?=$g['s']?>/" target="_action_frame_<?=$m?>" onsubmit="return chkWrite(this);">
	<input type="hidden" name="r" value="<?=$r?>" />
	<input type="hidden" name="a" value="<?=$mod?>" />
	<input type="hidden" name="m" value="<?=$m?>" />
	<input type="hidden" name="div" value="<?=$div?>" />
	<input type="hidden" name="file_name" value="<?=$file?>" />
	
	<table class="tbl-form">
	<tr>
		<td>
			<input type="button" class="<?if($ver=='pc'){?>btnnavy<?}else{?>btnsky<?}?>" value="PC 버전" onclick="changeVersion('pc');">
			<input type="button" class="<?if($ver=='mobile'){?>btnnavy<?}else{?>btnsky<?}?>" value="Mobile 버전" onclick="changeVersion('mobile');">
		</td>
	</tr>
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
	indentUnit: 4,
	indentWithTabs: true,
	enterMode: "keep",
	tabMode: "shift",
	lineNumbers: true
});

function changeVersion(v) {
	goHref('<?=$g['s']?>/?m=<?=$m?>&mod=<?=$mod?>&div=<?=$div?>&ver='+v);
}
</script>
