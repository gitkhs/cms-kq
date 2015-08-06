<script type="text/javascript" src="<?=$g['path_core']?>com/smarteditor/js/HuskyEZCreator.js" charset="utf-8"></script>


<div id="bbswrite">
	<div class="subject"><?=$_HM['name']?></div>

	<form name="frmWrite" method="post" action="<?=$g['s']?>/" target="_action_frame_<?=$m?>" onsubmit="return writeCheck(this);">
	<input type="hidden" name="r" value="<?=$r?>" />
	<input type="hidden" name="a" value="write" />
	<input type="hidden" name="c" value="<?=$c?>" />
	<input type="hidden" name="cuid" value="<?=$_HM['uid']?>" />
	<input type="hidden" name="m" value="<?=$m?>" />
	<input type="hidden" name="bid" value="<?=$R['bbsid']?$R['bbsid']:$bid?>" />
	<input type="hidden" name="uid" value="<?=$R['uid']?>" />
	<input type="hidden" name="reply" value="<?=$reply?>" />
	<input type="hidden" name="nlist" value="<?=$g['bbs_list']?>" />
	<input type="hidden" name="pcode" value="<?=$date['totime']?>" />
	<input type="hidden" name="upfiles" id="upfilesValue" value="<?php echo $reply=='Y'?'':$R['upload']?>" />

	<table class="tbl-form">
	<colgroup>
	<col width="150" />
	<col />
	</colgroup>

	<? if(!$my['id'] || $my['level'] >= $admin['admin']) { ?>
	<tr>
		<td class="lbl">작성자</td>
		<td>
			<input type="text" name="name" value="<?=$my['name']?>" size="20"/>
		</td>
	</tr>
	<? if((!$R['uid'] || $reply=='Y') && !$my['id']) { ?>
	<tr>
		<td class="lbl">비밀번호</td>
		<td>
			<input type="password" name="pw" value="<?=$R['pw']?>" size="20"/>
			<? if($R['hidden']&&$reply=='Y') { ?>
			<span class="guide">비밀답변은 비번을 수정하지 않아야 원게시자가 열람할 수 있습니다.</span>
			<? } ?>
		</td>
	</tr>
	<? } ?>
	<? } ?>

	<? if($B['category']) { ?>
	<? $_catexp = explode(',',$B['category']); $_catnum = count($_catexp); ?>
	<tr>
		<td class="lbl">카테고리</td>
		<td>
			<select name="category">
			<option value="">&nbsp;+ <?=$_catexp[0]?> 선택</option>
			<option value="">-----------------------------------------------------------</option>
			<? for($i = 1; $i < $_catnum; $i++) { ?>
			<? if(!$_catexp[$i]) continue; ?>
			<option value="<?=$_catexp[$i]?>"<? if($_catexp[$i]==$R['category']||$_catexp[$i]==$cat) { ?> selected="selected"<? } ?>>
			ㆍ<?=$_catexp[$i]?><? if($d['theme']['show_catnum']) { ?>(<? echo getDbRows($table[$m.'data'],'site='.$s.' and notice=0 and bbs='.$B['uid']." and category='".$_catexp[$i]."'"); ?>)<? } ?>
			</option>
			<? } ?>
			</select>
		</td>
	</tr>
	<? } ?>

	<tr>
		<td class="lbl">제 목</td>
		<td>
			<input type="text" name="subject" value="<?=$R['subject']?>" size="60" />
			<? if($my['admin'] || $my['level'] >= $admin['admin']) { ?>
				<span class="dv">|</span>
				<label><input type="checkbox" name="notice" value="1"<? if($R['notice']) { ?> checked="checked"<? } ?> /> 공지글</label>
			<? } ?>
			<? if($d['theme']['use_hidden']==1) { ?>
				<span class="dv">|</span>
				<label><input type="checkbox" name="hidden" value="1"<? if($R['hidden']) { ?> checked="checked"<? } ?> /> 비밀글</label>
			<? }else if($d['theme']['use_hidden']==2) { ?>
				<input type="hidden" name="hidden" value="1" />
			<? } ?>
		</td>
	</tr>

	<?$addinfo = explode("|",$B['addinfo']);?>
	<?$values = explode("|", $R['adddata'])?>
	<?$i=0;foreach($addinfo as $_R){?>
		<?if($_R){ $itms = explode("#", $_R)?>
		<tr>
			<td class="lbl"><?=$itms[2]?><?=$itms[1] ? '(<span style="color:#ff0000;">*</span>)':''?></td>
			<td>
				<?$val = explode(":", $values[$i]);?>
				<input type="hidden" name="itms[]" class="input" value="|<?=$itms[2]?>:">
			<?if($itms[0]==1){?>
				<input type="text" <?=$itms[1] ? '_fix':''?> name="itms[]" value="<?=$val[1]?>" size="60">
				<span class="cmmt"><?=$itms[3]?></span>
			<?}else if($itms[0]==2){?>
				<?$tmp = explode(",", $itms[3])?>
				<?foreach($tmp as $_T){?>
					<input type="checkbox" name="itms[]" value="<?=$_T?>," <?if(strstr($val[1],$_T)) echo 'checked';?>><?=$_T?>
				<?}?>
			<?}else if($itms[0]==3){?>
				<?$tmp = explode(",", $itms[3])?>
				<?foreach($tmp as $_T){?>
					<input type="radio" name="itms[]" value="<?=$_T?>" <?if($val[1]) echo 'checked';?>><?=$_T?>
				<?}?>
			<?}?>
			</td>
		</tr>
		<?}?>
	<?$i++;}?>
	
	<tr>
		<td colspan="2">
			<input type="hidden" name="html" id="editFrameHtml" value="HTML" />
			<input type="hidden" name="content" id="editFrameContent" value="<? echo htmlspecialchars($R['content'])?>" />
			<textarea id="ir1" style="width:100%;height:400px;"></textarea>
			<script type="text/javascript">
				var uri = "<?=$g['path_core']?>com/smarteditor/SmartEditor2Skin.php?s=<?=$g['s']?>&r=<?=$r?>&s_file=Y&s_photo=Y";
				CreateEditor("ir1","content",uri);
			</script>

			<? if($d['theme']['perm_upload']<=$my['level']||$d['theme']['perm_photo']<=$my['level']) { ?>
			<iframe name="upfilesFrame" id="upfilesFrame" src="<?=$g['s']?>/?r=<?=$r?>&amp;m=upload&amp;mod=list&amp;gparam=upfilesValue|ir1&amp;code=<? echo $reply=='Y' ? '[]' : ($R['upload'] ? $R['upload'] : '[]')?>" width="100%" height="0" frameborder="0" scrolling="no" allowTransparency="true"></iframe>
			<? } ?>
		</td>
	</tr>

	<? if(!$my['uid']) { ?>
	<tr>
		<td class="lbl">스팸 방지</td>
		<td>
			<img class="auth_code" id="auth_code" src="">
			<div>
				<input type="text" name="spamauth" value=""/>
				<input type="button" value="새로고침" class="btndef" onclick="sp_code.changeCode();"/>
				<div>(※ 왼쪽의 코드를 입력해 주세요.)</div>
			</div>
			<script type="text/javascript">var sp_code = new authCode('auth_code');</script>
		</td>
	</tr>
	<? } ?>

	<? if((!$R['uid']||$reply=='Y')&&is_file($g['path_module'].$d['bbs']['snsconnect'])) { ?>
	<tr>
		<td class="lbl">소셜연동</td>
		<td>
			<?php include_once $g['path_module'].$d['bbs']['snsconnect']?> 에도 게시물을 등록합니다.
		</td>
	</tr>
	<? } ?>

	<? if(!$d['bbs']['gowrite']) { ?>
	<tr>
		<td class="lbl">검색태그</td>
		<td>
			<input type="text" name="tag" value="<?=$R['tag']?>" size="60" />
			<div class="row">단어를 콤마(,)로 구분해서 입력해 주세요.</div>
		</td>
	</tr>
	<? } ?>

	<? if(!$uid && $d['bbs']['pagree']) { ?>
	<tr>
		<td colspan="2">
			<div class="row"><b>개인정보 수집·이용 안내</b></div>
			<div class="agreetab">
				<ul>
				<li id="tagree2" class="leftside selected" onclick="tabShow(2);">정보수집/이용목적</li>
				<li id="tagree3" onclick="tabShow(3);">개인정보수집항목</li>
				<li id="tagree4" onclick="tabShow(4);">정보보유/이용기간</li>
				<li id="tagree5" onclick="tabShow(5);">개인정보제공</li>
				</ul>
				<div class="clear"></div>
			</div>
			<div class="agreebox">
				<div id="bagree2"><textarea name="agree2"><?php readfile($g['path_module'].'member/var/agree2.txt')?></textarea></div>
				<div id="bagree3" class="hide"><textarea name="agree3"><?php readfile($g['path_module'].'member/var/agree3.txt')?></textarea></div>
				<div id="bagree4" class="hide"><textarea name="agree4"><?php readfile($g['path_module'].'member/var/agree4.txt')?></textarea></div>
				<div id="bagree5" class="hide"><textarea name="agree5"><?php readfile($g['path_module'].'member/var/agree5.txt')?></textarea></div>
			</div>
			<div class="agreecheck">
				<input type="checkbox" name="agree" value="1" /> 위의 <b>'개인정보 수집·이용'</b>에 동의 합니다.
			</div>
		</td>
	</tr>
	<? } ?>
	
	<tr>
		<td class="submit" colspan="2">
			<?if(!$d['bbs']['gowrite']){?>
				<div class="after">
				게시물 등록(수정/답변)후
				<input type="radio" name="backtype" id="backtype1" value="list"<?php if(!$_SESSION['bbsback'] || $_SESSION['bbsback']=='list'):?> checked="checked"<?php endif?> /><label for="backtype1">목록으로 이동</label>
				<input type="radio" name="backtype" id="backtype2" value="view"<?php if($_SESSION['bbsback']=='view'):?> checked="checked"<?php endif?> /><label for="backtype2">본문으로 이동</label>
				<input type="radio" name="backtype" id="backtype3" value="now"<?php if($_SESSION['bbsback']=='now'):?> checked="checked"<?php endif?> /><label for="backtype3">이 화면 유지</label>
				</div>
			<?}else{?>
				<input type="hidden" name="backtype" value="gowrite" />
			<?}?>

			<input type="button" value="취소" class="btngray btnsz01" onclick="cancelCheck();" />
			<input type="submit" value="확인" class="btnblue btnsz01" />
		</td>
	</tr>
	
	</table>

	</form>


</div>

<script type="text/javascript">
function tabShow(n){
	$('.agreetab').find('>ul>li').removeClass('selected');
	$('#tagree'+n).addClass('selected');

	$('.agreebox').find('>div').hide();
	$('#bagree'+n).show();
}

window.onbeforeunload = function() {
	if(submitFlag == false) {
		return "페이지 이동 및 새로고침 할 경우 작업한 내용은 사라집니다.";
	}
};
</script>

