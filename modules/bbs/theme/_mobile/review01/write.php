<div class="subject"><?=$_HM['name']?></div>

<div id="bbswrite">

	<form name="writeForm" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" enctype="multipart/form-data" onsubmit="return writeCheck(this);">
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
	<col width="80" />
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
			<input type="text" name="subject" value="<?=$R['subject']?>"/>

			<div>
			<? if($my['admin'] || $my['level'] >= $admin['admin']) { ?>
				<label><input type="checkbox" name="notice" value="1"<? if($R['notice']) { ?> checked="checked"<? } ?> /> 공지글</label>
			<? } ?>
			<? if($d['theme']['use_hidden']==1) { ?>
				<span class="dv">|</span>
				<label><input type="checkbox" name="hidden" value="1"<? if($R['hidden']) { ?> checked="checked"<? } ?> /> 비밀글</label>
			<? }else if($d['theme']['use_hidden']==2) { ?>
				<input type="hidden" name="hidden" value="1" />
			<? } ?>
			</div>
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
		<td class="lbl">내용</td>
		<td>
			<input type="hidden" name="html" value="TEXT" />
			<textarea name="content" rows="8"><?php echo $reply=='Y'?'':strip_tags($R['content'])?></textarea>
		</td>
	</tr>

	<?php if($d['theme']['perm_upload'] <= $my['level']):?>
	<tr>
	<td class="lbl">파일첨부</td>
	<td>
		<?php for($i = 0; $i < $d['theme']['num_upload']; $i++):?>
		<div class="row"><input type="file" name="upfile[]" value=""/></div>
		<?php endfor?>
		<input type="hidden" name="num_upfile" value="<?php echo $d['theme']['num_upload']?>" />
	</td>
	</tr>
	<?php endif?>

	<?php if($d['theme']['perm_photo'] <= $my['level']):?>
	<tr>
	<td class="lbl">사진첨부</td>
	<td>
		<input type="hidden" name="num_photo" value="<?php echo $d['theme']['num_photo']?>" />
		<?php for($i = 0; $i < $d['theme']['num_photo']; $i++):?>
		<div class="row"><input type="file" name="upfile[]" value="" /></div>
		<?php endfor?>
		<div class="row">
			<select name="insert_photo">
			<option value="bottom">사진을 내용하단에 삽입</option>
			<option value="top">사진을 내용상단에 삽입</option>
			<option value="">내용에 삽입하지 않음</option>
			</select>
		</div>
		<div class="row">
		사진첨부는 Windows7폰,안드로이드 2.2버젼 이상 일부 모바일기기에서만 지원됩니다.(jpg/png/gif 첨부가능)
		</div>	
	</td>
	</tr>
	<?php endif?>

	<?php if($d['upload']['data']):?>
	<tr>
	<td class="lbl">파일삭제</td>
	<td>
		<ul class='filedelete'>
		<?php foreach($d['upload']['data'] as $_u):?>
		<li>
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=upload&amp;a=files_delete&amp;file_uid=<?php echo $_u['uid']?>&amp;isreload=Y" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?   ');"><?php echo $_u['name']?></a>
			<span class="size">(<?php echo getSizeFormat($_u['size'],1)?>)</span>
			<span class="down">(<?php echo number_format($_u['down'])?>)</span>
		</li>
		<?php endforeach?>
		</ul>
	</td>
	</tr>
	<?php endif?>

	<? if(!$my['uid']) { ?>
	<tr>
		<td class="lbl">스팸 방지</td>
		<td>
			<img class="auth_code" id="auth_code" src="">
			<div style="padding-top:10px;">
				<input type="text" name="spamauth" value="" style="width:100px;"/>
				<input type="button" value="새로고침" class="btndef" onclick="sp_code.changeCode();"/>
				<div>(※ 코드를 입력해 주세요.)</div>
			</div>
			<script type="text/javascript">var sp_code = new authCode('auth_code');</script>
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
			<div class="agreecmb">
				<select onchange="tabShow(this.value);">
					<option value="2">정보수집/이용목적</option>
					<option value="3">개인정보수집항목</option>
					<option value="4">정보보유/이용기간</option>
					<option value="5">개인정보제공</option>
				</select>
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
				게시물 등록(수정/답변)후<br/>
				<label><input type="radio" name="backtype" value="list"<?php if(!$_SESSION['bbsback'] || $_SESSION['bbsback']=='list'):?> checked="checked"<?php endif?> />목록으로 이동</label>
				<label><input type="radio" name="backtype" value="view"<?php if($_SESSION['bbsback']=='view'):?> checked="checked"<?php endif?> />본문으로 이동</label>
				</div>
			<?}else{?>
				<input type="hidden" name="backtype" value="gowrite" />
			<?}?>

			<input type="button" value="취소" class="btngray btnsz01" onclick="cancelCheck();" />
			<input type="submit" value="확인" class="btnblue btnsz01" />
		</td>
	</tr>

<!--	
		<?php if(!$my['id']):?>
		<tr>
		<td class="td1">작성자명</td>
		<td class="td2">
			<input size="20" type="text" name="name" value="<?php echo $R['name']?>"/>
		</td>
		</tr>
		<?php if(!$R['uid']||$reply=='Y'):?>
		<tr>
		<td class="td1">비밀번호</td>
		<td class="td2">
			<input size="20" type="password" name="pw" value="<?php echo $R['pw']?>" class="input subject" />
			<?php if($R['hidden']&&$reply=='Y'):?>
			<div class="guide">
			비밀답변은 비번을 수정하지 않아야 원게시자가 열람할 수 있습니다.
			</div>
			<?php endif?>
		</td>
		</tr>
		<?php endif?>
		<?php endif?>


		<?php if($B['category']):$_catexp = explode(',',$B['category']);$_catnum=count($_catexp)?>
		<tr>
		<td class="td1">카테고리</td>
		<td class="td2">
			<select name="category">
			<option value="">&nbsp;+ <?php echo $_catexp[0]?>선택</option>
			<?php for($i = 1; $i < $_catnum; $i++):if(!$_catexp[$i])continue;?>
			<option value="<?php echo $_catexp[$i]?>"<?php if($_catexp[$i]==$R['category']||$_catexp[$i]==$cat):?> selected="selected"<?php endif?>>ㆍ<?php echo $_catexp[$i]?>(<?php echo getDbRows($table[$m.'data'],'site='.$s.' and notice=0 and bbs='.$B['uid']." and category='".$_catexp[$i]."'")?>)</option>
			<?php endfor?>
			</select>	
		</td>
		</tr>
		<?php endif?>

		<tr>
		<td class="td1">제목</td>
		<td class="td2">
			<input type="text" name="subject" value="<?php echo ($reply=='Y'?'RE:':'').$R['subject']?>" class="input subject" />
			<span class="check">
			<?php if($my['admin']):?>
			<input type="checkbox" name="notice" value="1"<?php if($R['notice']):?> checked="checked"<?php endif?> />공지글
			<?php endif?>
			<?php if($d['theme']['use_hidden']==1):?>
			<input type="checkbox" name="hidden" value="1"<?php if($R['hidden']):?> checked="checked"<?php endif?> />비밀글
			<?php elseif($d['theme']['use_hidden']==2):?>
			<input type="hidden" name="hidden" value="1" />
			<?php endif?>
			</span>
		</td>
		</tr>

		<tr>
		<td class="td1">내용</td>
		<td class="td2">
			<input type="hidden" name="html" value="TEXT" />
			<textarea name="content"><?php echo $reply=='Y'?'':strip_tags($R['content'])?></textarea>
		</td>
		</tr>

		<?php if($d['theme']['show_wtag']):?>
		<tr>
		<td class="td1">검색태그</td>
		<td class="td2">
			<input size="80" type="text" name="tag" value="<?php echo $R['tag']?>" class="input subject" />
			<div class="guide">
			이 게시물을 가장 잘 표현할 수 있는 단어를 콤마(,)로 구분해서 입력해 주세요.
			</div>			
		</td>
		</tr>
		<?php endif?>

		<?php if($d['theme']['perm_upload'] <= $my['level']):?>
		<tr>
		<td class="td1">파일첨부</td>
		<td class="td2">
			<?php for($i = 0; $i < $d['theme']['num_upload']; $i++):?>
			<input size="80" type="file" name="upfile[]" value="" class="input subject" /><br />
			<?php endfor?>
			<input type="hidden" name="num_upfile" value="<?php echo $d['theme']['num_upload']?>" />
		</td>
		</tr>
		<?php endif?>

		<?php if($d['theme']['perm_photo'] <= $my['level']):?>
		<tr>
		<td class="td1">사진첨부</td>
		<td class="td2">
			<input type="hidden" name="num_photo" value="<?php echo $d['theme']['num_photo']?>" />
			<?php for($i = 0; $i < $d['theme']['num_photo']; $i++):?>
			<input size="80" type="file" name="upfile[]" value="" class="input subject" /><br />
			<?php endfor?>
			<div class="guide">
			<select name="insert_photo">
			<option value="bottom">사진을 내용하단에 삽입</option>
			<option value="top">사진을 내용상단에 삽입</option>
			<option value="">내용에 삽입하지 않음</option>
			</select>
			</div>
			<div class="guide">
			사진첨부는 Windows7폰,안드로이드 2.2버젼 이상 일부 모바일기기에서만 지원됩니다.<br />
			(jpg/png/gif 첨부가능)
			</div>	
		</td>
		</tr>
		<?php endif?>

		<?php if($d['upload']['data']):?>
		<tr>
		<td class="td1">파일삭제</td>
		<td class="td2">
			<ul>
			<?php foreach($d['upload']['data'] as $_u):?>
			<li>
				<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=upload&amp;a=files_delete&amp;file_uid=<?php echo $_u['uid']?>&amp;isreload=Y" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?   ');"><?php echo $_u['name']?></a>
				<span class="size">(<?php echo getSizeFormat($_u['size'],1)?>)</span>
				<span class="down">(<?php echo number_format($_u['down'])?>)</span>
			</li>
			<?php endforeach?>
			</ul>
		</td>
		</tr>
		<?php endif?>

		<?php if((!$R['uid']||$reply=='Y')&&is_file($g['path_module'].$d['bbs']['snsconnect'])):?>
		<tr>
		<td class="td1">소셜연동</td>
		<td class="td2 shift">
			<?php include_once $g['path_module'].$d['bbs']['snsconnect']?>
		</td>
		</tr>
		<?php endif?>
-->
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
