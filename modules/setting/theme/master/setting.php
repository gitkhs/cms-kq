<? include_once $g['dir_module'].'var/_theme.php'; ?>
<div id="setting">
	<form name="frmSetup" method="post" action="<?=$g['s']?>/" target="_action_frame_<?=$m?>" onsubmit="return chkWrite(this);">
	<input type="hidden" name="r" value="<?=$r?>" />
	<input type="hidden" name="a" value="<?=$mod?>" />
	<input type="hidden" name="m" value="<?=$m?>" />
	<input type="hidden" name="div" value="<?=$div?>" />

	<input type="hidden" name="act" value="setting" />
	<input type="hidden" name="lUid" value="<?=$wSet['uid']?>" />

	<table class="tbl-form">
	<colgroup> 
	<col width="120">
	<col> 
	<colgroup> 
	<tr>
		<td class="lbl">사이트이름 / 옵션</td>
		<td>
			<div class="row">
				이름 <input type="text" name="site_title" value="<?=$_HS['title']?>" size="30">
				<span class="dv">|</span>
				테마 <select name="site_theme"><? foreach($d['theme_list'] as $_key => $_val){ ?><option value="<?=$_key?>" <?if($_key == $_HS['theme']) echo 'selected="selected"';?>><?=$_val?></option><? } ?></select>
				<span class="dv">|</span>
				모바일 테마 <select name="site_theme_mobile"><? foreach($d['theme_mobile_list'] as $_key => $_val){ ?><option value="<?=$_key?>" <?if($_key == $d['config']['site_theme_mobile']) echo 'selected="selected"';?>><?=$_val?></option><? } ?></select>
			</div>
		</td>
	</tr>
	<tr>
		<td class="lbl">옵션</td>
		<td>
			<div class="row">
				<label><input type="radio" name="site_open" value="1" <?if($d['config']['site_open']==1 || !$d['config']['site_open']){echo 'checked="checked"';}?>> 운영</label>
				<label><input type="radio" name="site_open" value="2" <?if($d['config']['site_open']==2){echo 'checked="checked"';}?>> 차단</label>
				<span class="dv">|</span>
				<label><input type="checkbox" name="site_intro" value="1" <?if($d['config']['site_intro']){echo 'checked="checked"';}?>> 인트로사용</label>
				<label><input type="checkbox" name="site_member" value="1" <?if($d['config']['site_member']){echo 'checked="checked"';}?>> 회원가입</label>
				<label><input type="checkbox" name="site_search" value="1" <?if($d['config']['site_search']){echo 'checked="checked"';}?>> 검색</label>
				<label><input type="checkbox" name="banner_top_use" value="1" <?if($d['config']['banner_top_use']){echo 'checked="checked"';}?>> 상단배너</label>
			</div>
		</td>
	</tr>

	<tr>
		<td class="lbl">페이스북</td>
		<td>
			<div class="row">
				<label><input type="checkbox" name="facebook_use" value="1" <?if($d['config']['facebook_use']){echo 'checked="checked"';}?>> 로그인 사용</label>
				<span class="dv">|</span>
				APP ID <input type="text" name="facebook_appid" value="<?=$d['config']['facebook_appid']?>">
			</div>
		</td>
	</tr>

	<tr>
		<td class="lbl">사이드 영역</td>
		<td>
			<div class="row">
				<label><input type="radio" name="side_position" value="" <?if(!$d['config']['side_position']){echo 'checked="checked"';}?>> 없음</label>
				<label><input type="radio" name="side_position" value="left" <?if($d['config']['side_position']=='left'){echo 'checked="checked"';}?>> 왼쪽</label>
				<label><input type="radio" name="side_position" value="right" <?if($d['config']['side_position']=='right'){echo 'checked="checked"';}?>> 오른쪽</label>
				<span class="dv">|</span>
				<label><input type="checkbox" name="side_loginbox" value="1" <?if($d['config']['side_loginbox']){echo 'checked="checked"';}?>> 로그인 박스</label>
				<span class="dv">|</span>
				<label><input type="checkbox" name="side_bbshot" value="1" <?if($d['config']['side_bbshot']){echo 'checked="checked"';}?>> 최근글 사용 (최근글 제외시 각 게시판에서 설정)</label>
			</div>
		</td>
	</tr>

	<tr>
		<td class="lbl">퀵메뉴</td>
		<td>
			<div class="row">* 메뉴 링크는 업로드된 파일 선택 후 입력 하세요. (주의 : 외부링크의 경우 http:// 를 붙이세요)</div>
			<div class="row">
				* 파일 업로드 후 확인 버튼을 클릭해야 정상적으로 반영됩니다.
				<input type="button" class="btnkhaki" style="float:right;" value="업로드" onclick="OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&m=upload&mod=n_photo&gparam=addinfo|upfile');">
				<div class="clear"></div>
			</div>
			<div class="row">
				<input type="hidden" name="quickmenu" id="addinfo" class="frm-txt" value="<?=$wG['quickmenu']?>">
				<iframe name="upfile" id="upfile" style="width:100%;border-top:1px solid #dadada;" class="frm-input" src="<?=$g['s']?>/?r=<?=$r?>&amp;m=upload&amp;mod=listbanner&amp;gparam=addinfo|editFrame&amp;code=<?=$wG['quickmenu'] ? $wG['quickmenu']:'[]'?>" height="0" frameborder="0" scrolling="no" allowTransparency="true"></iframe>
			</div>
		</td>
	</tr>

	<tr>
		<td class="lbl">사이드 롤링배너</td>
		<td>
			<div class="row">* 베너 링크는 업로드된 파일 선택 후 입력 하세요. (주의 : 외부링크의 경우 http:// 를 붙이세요)</div>
			<div class="row">* 파일 업로드 후 확인 버튼을 클릭해야 정상적으로 반영됩니다.</div>
			<div class="row">
				* 최적사이즈 200 * 85 픽셀
				<input type="button" class="btnkhaki" style="float:right;" value="업로드" onclick="OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&m=upload&mod=n_photo&gparam=addinfo2|upfile2');">
				<div class="clear"></div>
			</div>
			<div class="row">
				<input type="hidden" name="side_banner" id="addinfo2" class="frm-txt" value="<?=$wG['side_banner']?>">
				<iframe name="upfile2" id="upfile2" style="width:100%;border-top:1px solid #dadada;" class="frm-input" src="<?=$g['s']?>/?r=<?=$r?>&amp;m=upload&amp;mod=listbanner&amp;gparam=addinfo2|editFrame&amp;code=<?=$wG['side_banner'] ? $wG['side_banner']:'[]'?>" height="0" frameborder="0" scrolling="no" allowTransparency="true"></iframe>
			</div>
		</td>
	</tr>
	
	<tr>
		<td class="submit" colspan="2">
			<input type="button" class="btngray btnsz01" value="취 소" onclick="location.reload();">
			<input type="submit" class="btnblue btnsz01" value="확 인">
		</td>
	</tr>

	</table>
	
	</form>
</div>


<script type="text/javascript">
function chkWrite(f){
	if(getId('upfile'))
		frames.upfile.dragFile();
	if(getId('upfile2'))
		frames.upfile2.dragFile();
}

$(document).ready(function(){
});
</script>
