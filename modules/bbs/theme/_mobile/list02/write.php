<div class="subject"><?=$_HM['name']?></div>

<div id="bbswrite">

	<div class="container" style="margin-top:12px;">
	<form name="writeForm" class="form-horizontal" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" enctype="multipart/form-data" onsubmit="return writeCheck(this);">
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

	<? if(!$my['id'] || $my['level'] >= $admin['admin']) { ?>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="name">작성자</label>
		<div class="col-sm-10">
		<input type="text" class="form-control" id="name" name="name" value="<?=$my['name']?>">
		</div>
	</div>
	<? if((!$R['uid'] || $reply=='Y') && !$my['id']) { ?>
	<? } ?>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="pw">비밀번호</label>
		<div class="col-sm-10">
		<input type="password" class="form-control" id="pw" name="pw" value="<?=$R['pw']?>">
		<? if($R['hidden']&&$reply=='Y') { ?><p class="help-block">비밀답변은 비번을 수정하지 않아야 원게시자가 열람할 수 있습니다.</p><? } ?>
		</div>
		
	</div>
	<? } ?>
  
	<? if($B['category']) { ?>
	<? $_catexp = explode(',',$B['category']); $_catnum = count($_catexp); ?>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="category">카테고리</label>
		<div class="col-sm-10">
			<select class="form-control" name="category" id="category">
			<option value="">&nbsp;+ <?=$_catexp[0]?> 선택</option>
			<? for($i = 1; $i < $_catnum; $i++) { ?>
			<? if(!$_catexp[$i]) continue; ?>
			<option value="<?=$_catexp[$i]?>"<? if($_catexp[$i]==$R['category']||$_catexp[$i]==$cat) { ?> selected="selected"<? } ?>>
			ㆍ<?=$_catexp[$i]?><? if($d['theme']['show_catnum']) { ?>(<? echo getDbRows($table[$m.'data'],'site='.$s.' and notice=0 and bbs='.$B['uid']." and category='".$_catexp[$i]."'"); ?>)<? } ?>
			</option>
			<? } ?>
			</select>
		</div>
	</div>
	<? } ?>

	<div class="form-group">
		<label class="col-sm-2 control-label" for="subject">제 목</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="subject" id="subject" value="<?=$R['subject']?>"/>

			<p class="help-block">
			<? if($my['admin'] || $my['level'] >= $admin['admin']) { ?>
				<label class="checkbox-inline"><input type="checkbox" name="notice" value="1"<? if($R['notice']) { ?> checked="checked"<? } ?> /> 공지글</label>
			<? } ?>
			<? if($d['theme']['use_hidden']==1) { ?>
				<label class="checkbox-inline"><input type="checkbox" name="hidden" value="1"<? if($R['hidden']) { ?> checked="checked"<? } ?> /> 비밀글</label>
			<? }else if($d['theme']['use_hidden']==2) { ?>
				<input type="hidden" name="hidden" value="1" />
			<? } ?>
			</p>
		</div>
	</div>

	<?$addinfo = explode("|",$B['addinfo']);?>
	<?$values = explode("|", $R['adddata']);?>
	<?$i=0;foreach($addinfo as $_R){?>
	<?if($_R){ $itms = explode("#", $_R)?>
	<div class="form-group">
		<label class="col-sm-2 control-label"><?=$itms[2]?> <?=$itms[1] ? '(<span style="color:#ff0000;">*</span>)':''?></label>
		<div class="col-sm-10">
			<?$val = explode(":", $values[$i]);?>
			<input type="hidden" name="itms[]" class="input" value="|<?=$itms[2]?>:">
		<?if($itms[0]==1){?>
			<input type="text" class="form-control" name="itms[]" value="<?=$val[1]?>" <?=$itms[1] ? '_fix':''?>>
			<p class="help-block"><?=$itms[3]?></p>
		<?}else if($itms[0]==2){?>
			<?$tmp = explode(",", $itms[3])?>
			<?foreach($tmp as $_T){?>
			<label class="checkbox-inline"><input type="checkbox" name="itms[]" value="<?=$_T?>," <?if(strstr($val[1],$_T)) echo 'checked';?>><?=$_T?></label>
			<?}?>
		<?}else if($itms[0]==3){?>
			<?$tmp = explode(",", $itms[3])?>
			<?foreach($tmp as $_T){?>
			<label class="radio-inline"><input type="radio" name="itms[]" value="<?=$_T?>" <?if($val[1]) echo 'checked';?>><?=$_T?></label>
			<?}?>
		<?}?>
		</div>
	</div>
	<?}?>
	<?$i++;}?>
	
	<div class="form-group">
		<label class="col-sm-2 control-label" for="id_content">내 용</label>
		<div class="col-sm-10">
			<input type="hidden" name="html" value="TEXT" />
			<textarea class="form-control" name="content" id="id_content" rows="5"><?php echo $reply=='Y'?'':strip_tags($R['content'])?></textarea>
		</div>
	</div>

	<?php if($d['theme']['perm_upload'] <= $my['level']):?>
	<div class="form-group">
		<label class="col-sm-2 control-label">파일첨부</label>
		<div class="col-sm-10">
			<input type="hidden" name="num_upfile" value="<?php echo $d['theme']['num_upload']?>" />
			<?php for($i = 0; $i < $d['theme']['num_upload']; $i++):?>
			<input type="file" name="upfile[]" value=""/>
			<?php endfor?>
		</div>
	</div>
	<?php endif?>

	<?php if($d['theme']['perm_photo'] <= $my['level']):?>
	<div class="form-group">
		<label class="col-sm-2 control-label">사진첨부</label>
		<div class="col-sm-10">
			<input type="hidden" name="num_photo" value="<?php echo $d['theme']['num_photo']?>" />
			<?php for($i = 0; $i < $d['theme']['num_photo']; $i++):?>
			<input type="file" name="upfile[]" value="" style="margin-bottom:8px;"/>
			<?php endfor?>

			<select name="insert_photo" class="form-control">
			<option value="bottom">사진을 내용하단에 삽입</option>
			<option value="top">사진을 내용상단에 삽입</option>
			<option value="">내용에 삽입하지 않음</option>
			</select>
			
			<p class="help-block">사진첨부는 Windows7폰,안드로이드 2.2버젼 이상 일부 모바일기기에서만 지원됩니다.(jpg/png/gif 첨부가능)</p>
		</div>
	</div>
	<?php endif?>

	<?php if($d['upload']['data']):?>
	<div class="form-group">
		<label class="col-sm-2 control-label">파일삭제</label>
		<div class="col-sm-10">
			<ul class="list-group">
			<?php foreach($d['upload']['data'] as $_u):?>
			<li class="list-group-item">
				<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=upload&amp;a=files_delete&amp;file_uid=<?php echo $_u['uid']?>&amp;isreload=Y" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?   ');">
				<?php echo $_u['name']?>
				[<?php echo getSizeFormat($_u['size'],1)?>]
				(<?php echo number_format($_u['down'])?>)
				</a>
			</li>
			<?php endforeach?>
			</ul>
		</div>
	</div>
	<?php endif?>

	<? if(!$d['bbs']['gowrite']) { ?>
	<div class="form-group">
		<label class="col-sm-2 control-label" for="id-tag">검색태그</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="tag" id="id-tag" value="<?=$R['tag']?>"/>
			<p class="help-block">단어를 콤마(,)로 구분해서 입력해 주세요.</p>
		</div>
	</div>
	<? } ?>

	<? if(!$my['uid']) { ?>
	<div class="form-group">
		<label class="col-sm-2 control-label">스팸 방지</label>
		<div class="col-sm-10">
			<img class="auth_code" id="auth_code" src="" style="float:left;">
			<div>
				<input type="text" name="spamauth" value="" style="width:100px;"/>
				<input type="button" value="새로고침" class="btndef" onclick="sp_code.changeCode();"/>
				<div>(※ 코드를 입력해 주세요.)</div>
			</div>
			<div class="clear"></div>
			<script type="text/javascript">var sp_code = new authCode('auth_code');</script>
		</div>
	</div>
	<? } ?>

	<? if(!$uid && $d['bbs']['pagree']) { ?>
	<div class="form-group">
		<label class="col-sm-2 control-label"></label>
		<div class="col-sm-10">
			<p class="help-block"><b>개인정보 수집·이용 안내</b></p>
			<select onchange="tabShow(this.value);" class="form-control">
				<option value="2">정보수집/이용목적</option>
				<option value="3">개인정보수집항목</option>
				<option value="4">정보보유/이용기간</option>
				<option value="5">개인정보제공</option>
			</select>

			<div class="agreebox">
				<div id="bagree2"><textarea name="agree2"><?php readfile($g['path_module'].'member/var/agree2.txt')?></textarea></div>
				<div id="bagree3" class="hide"><textarea name="agree3"><?php readfile($g['path_module'].'member/var/agree3.txt')?></textarea></div>
				<div id="bagree4" class="hide"><textarea name="agree4"><?php readfile($g['path_module'].'member/var/agree4.txt')?></textarea></div>
				<div id="bagree5" class="hide"><textarea name="agree5"><?php readfile($g['path_module'].'member/var/agree5.txt')?></textarea></div>
			</div>

			<div class="agreecheck">
				<input type="checkbox" name="agree" value="1" /> 위의 <b>'개인정보 수집·이용'</b>에 동의 합니다.
			</div>
		</div>
	</div>
	<? } ?>

	<?if(!$d['bbs']['gowrite']){?>
	<div class="form-group">
		<label class="col-sm-2 control-label"></label>
		<div class="col-sm-10">
			<div><label class="control-label">게시물 등록(수정/답변)후</label></div>
			<label class="radio-inline"><input type="radio" name="backtype" value="list"<?php if(!$_SESSION['bbsback'] || $_SESSION['bbsback']=='list'):?> checked="checked"<?php endif?> />목록으로 이동</label>
			<label class="radio-inline"><input type="radio" name="backtype" value="view"<?php if($_SESSION['bbsback']=='view'):?> checked="checked"<?php endif?> />본문으로 이동</label>
		</div>
	</div>
	<? }else{ ?>
	<input type="hidden" name="backtype" value="gowrite" />
	<? } ?>

	<div class="form-group">
		<label class="col-sm-2 control-label"></label>
		<div class="col-sm-10">
			<div class="row">
			<div class="col-xs-6"><input type="submit" class="btn btn-primary form-control" value="확 인"/></div>
			<div class="col-xs-6"><input type="button" class="btn btn-default form-control" value="취소" onclick="cancelCheck();" /></div>
			</div>
		</div>
	</div>

	</form>
	</div>


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
