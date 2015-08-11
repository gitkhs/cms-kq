<?
	$RS	= getDbSelect($table['s_menu'],'site='.$s.' and parent='.$mid.' and hidden=0 and depth=2 order by gid asc','*');
	while($_R=db_fetch_array($RS))
		$lst_menu[]	= $_R;

	if(!$pid) {
		$pid	= $lst_menu[0]['uid'];
	}
	
	$R	= getDbData($table['s_stdpage'], "pid='{$pid}'", "*");
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

<div id="write">
	<form name="frmBanner" method="post" action="<?=$g['s']?>/" target="_action_frame_<?=$m?>">
	<input type="hidden" name="r" value="<?=$r?>" />
	<input type="hidden" name="a" value="<?=$mod?>" />
	<input type="hidden" name="m" value="<?=$m?>" />
	<input type="hidden" name="div" value="<?=$div?>" />

	<div class="menu">
		<select name="mid" onchange="goHref('<?=$g['s']?>/?m=setting&mod=onepage&div=write&mid='+this.value);">
		<?$_MENUS1=getDbSelect($table['s_menu'],'site='.$s.' and hidden=0 and depth=1 order by gid asc','*')?>
		<?while($_M1=db_fetch_array($_MENUS1)){?>
		<option value="<?=$_M1['uid']?>" <?if($mid==$_M1['uid']){?>selected="selected"<?}?>><?=$_M1['name']?></option>
		<?}?>
		</select>

		<select name="pid" onchange="goHref('<?=$g['s']?>/?m=setting&mod=onepage&div=write&mid=<?=$mid?>&pid='+this.value);">
		<?foreach($lst_menu as $_R) {?>
		<option value="<?=$_R['uid']?>" <?if($pid==$_R['uid']){?>selected="selected"<?}?>><?=$_R['name']?>[<?=$_R['uid']?>]</option>
		<?}?>
		</select>

		<div class="right">
		<input type="button" class="btndef" value=" 화면으로 " onclick="goHref('<?=$g['s']?>/?c=<?=$mid?>');">
		<input type="submit" class="btnblue" value=" 저장 ">
		</div>
		<div class="clear"></div>
	</div>
	
	<div class="editer">
		<textarea id="str_source" name="content"><?=$R['content']?></textarea>
	</div>
	</form>
	
	<div class="sample">
		<div class="">샘 플</div>
		<table class="tbl-none">
		<tr>
		<td width="400px" valign="top">
			<div>링크정보 : /?c=<?=$mid?></div>
			<div>페이지이동 : /?c=<?=$mid?>#pageid[메뉴번호]</div>
		</td>

		<td>
<textarea id="str_sample">
<div class="vi-wrap" style="min-height:100px; background:url(files/_etc/images/intro_background01.jpg) bottom no-repeat; background-size:cover;">
	<!-- 1줄 전체 채울때 -->
	<div class="bx-mx">내용1</div>
	<!-- 분할입력 -->
	<div class="bx-30 left">30% 분할입력</div><div class="bx-70 right">70% 분할입력</div><div class="clear"></div>
	<div class="bx-50 left">50% 분할입력</div><div class="bx-50 right">50% 분할입력</div><div class="clear"></div>
	<!-- 리스트 화면 4개, 2개, 1개 순으로 표현-->
	<ul class="bx-lst">
	<li>내용1</li><li>내용2</li><li>내용3</li><li>내용4</li>
	</ul>
	<div class="clear"></div>
</div>
</textarea>
		</td>
		</tr>
		</table>
	</div>
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
var str_sample = CodeMirror.fromTextArea(document.getElementById("str_sample"), {
	matchBrackets: true,
	mode: "application/x-httpd-php",
	indentUnit: 4,
	indentWithTabs: true,
	enterMode: "keep",
	tabMode: "shift",
	lineNumbers: true
});
</script>
