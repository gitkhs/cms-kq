<script type="text/javascript" src="<?=$g['path_core']?>com/smarteditor/js/HuskyEZCreator.js" charset="utf-8"></script>

<div id="stdpage_write">
	<div class="subject"><?=$_HM['name']?></div>
	
	<div style="margin-top:10px;">
		<form name="frmWrite" method="post" action="<?=$g['s']?>/" target="_action_frame_<?=$m?>" onsubmit="onSubmit();">
			<input type="hidden" name="r" value="<?=$r?>" />
			<input type="hidden" name="c" value="<?=$c?>" />
			<input type="hidden" name="a" value="<?=$mod?>" />
			<input type="hidden" name="pid" value="<?=$R['pid']?$R['pid']:$_HM['id']?>" />	
			<input type="hidden" name="site" value="<?=$R['site']?$R['site']:$_HS['uid']?>" />

			<div>
				<input type="hidden" name="upfiles" id="upfilesValue" value="<?=$R['upload']?>" />
				<input type="hidden" name="content" value="<?=htmlspecialchars($R['content']);?>" />

				<textarea id="ir1" rows="22" style="width:100%;height400px;"></textarea>
				<script type="text/javascript">
					var uri = "<?=$g['path_core']?>com/smarteditor/SmartEditor2Skin.php?s=<?=$g['s']?>&r=<?=$r?>&s_file=Y&s_photo=Y";
					CreateEditor("ir1","content",uri);
				</script>
				<div><iframe name="upfilesFrame" id="upfilesFrame" src="<?=$g['s']?>/?r=<?=$r?>&amp;m=upload&amp;mod=list&amp;gparam=upfilesValue|ir1&amp;code=<?=$R['upload'] ? $R['upload'] : '[]'?>" width="100%" height="0" frameborder="0" scrolling="no" allowTransparency="true"></iframe></div>
			</div>

			<table class="tbl-form" style="margin-top:12px;">
			<colgroup>
			<col width="120px">
			<col>
			</colgroup>
			<tr>
				<td class="lbl">조회 등급</td>
				<td>
					<select name="level">
					<option value="0">전체 조회</option>
					<? $_LVLARR = array(); ?>
					<? $levelnum = getDbData($table['s_mbrlevel'],'gid=1','*'); ?>
					<? $LVL=getDbArray($table['s_mbrlevel'],'','*','uid','asc',$levelnum['uid'],1); ?>
					<? while($_L=db_fetch_array($LVL)) { $_LVLARR[$_L['uid']] = $_L['name']; ?>
					<option value="<?=$_L['uid']?>"<? if($_L['uid']==$R['level']) { ?> selected="selected"<? } ?>><?=$_L['name']?></option>
					<? } ?>
					</select>
					선택 등급 이상 조회 가능 합니다.
				</td>
			</tr>
			<tr>
				<td class="lbl">지도 API</td>
				<td>
					<div>
						<label class="ctrl-radio"><input type="radio" name="mapapi_pos" value="0" <?if(!$R['mapapi_pos']) echo 'checked="checked"';?>> 지도 API사용 안함</label>
						<label class="ctrl-radio"><input type="radio" name="mapapi_pos" value="1" <?if($R['mapapi_pos'] == 1) echo 'checked="checked"';?>> 내용 위 출력</label>
						<label class="ctrl-radio"><input type="radio" name="mapapi_pos" value="2" <?if($R['mapapi_pos'] == 2) echo 'checked="checked"';?>> 내용 아래 출력</label>
					</div>

					<textarea name="mapapi" rows="4" style="margin:auto; width:98%;"><?=$R['mapapi']?></textarea>
					<div class="row">지도 API 제공서비스(<a href="http://dna.daum.net/examples/maps/MissA/step1.php" target="_blank"><b>다음지도 API</b></a>, <a href="https://www.google.com/maps/mm?authuser=0&hl=ko" target="_blank"><b>구글지도 API</b></a>)  컨텐츠를 이용하여 제공되는 테그를 붙여 넣기 하세요.</div>
				</td>
			</tr>
			<tr>
				<td class="lbl">내용 작성 후</td>
				<td>
					<label class="ctrl-radio"><input type="radio" name="backtype" value="view" <?if(!$_SESSION['stdpage'] || $_SESSION['stdpage']=="view"){echo 'checked="checked"';}?>> 본문으로 이동</label>
					<label class="ctrl-radio"><input type="radio" name="backtype" value="now" <?if($_SESSION['stdpage']=="now"){echo 'checked="checked"';}?>> 이 화면 유지</label>
				</td>
			</tr>
			<tr>
				<td class="submit" colspan="2">
					<input type="button" value="취소" class="btngray btnsz01" onclick="onCencel();">
					<input type="submit" value="확인" class="btnblue btnsz01">
				</td>
			</tr>
			</table>

		</form>
	</div>

</div>

<script type="text/javascript">
var	isSubmit = false;
function onCencel(){
	history.back();
}

function onSubmit(){
	$('input[name=content]').val(GetEditor('ir1'));

	if (getId('upfilesFrame'))
	{
		frames.upfilesFrame.dragFile();
	}
	isSubmit = true;
}

window.onbeforeunload = function (e) {
	if (isSubmit)	return;

	e = e || window.event;

	// For IE<8 and Firefox prior to version 4
	if (e) {
		e.returnValue = '페이지를 벗어 날경우 작업중인 내용은 저장되지 않습니다.';
	}

	// For Chrome, Safari, IE8+ and Opera 12+
	return '페이지를 벗어 날경우 작업중인 내용은 저장되지 않습니다.';
};

</script>