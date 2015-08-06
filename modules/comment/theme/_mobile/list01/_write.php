<div id="cwrite" class="<?php echo $type=='modify'?'md':'wr'?>box">

	<?php if($d['comment']['perm_write'] <= $my['level'] || $my['admin']):?>
	<?php $_SESSION['wcode']=$date['totime']?>

	<form name="writeForm" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return writeCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="a" value="write" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	<input type="hidden" name="uid" value="<?php echo $R['uid']?>" />
	<input type="hidden" name="upfiles" id="upfilesValue" value="<?php echo $type=='modify'?$R['upload']:''?>" />
	<input type="hidden" name="c" value="<?php echo $c?>" />
	<input type="hidden" name="skin" value="<?php echo $skin?>" />
	<input type="hidden" name="iframe" value="<?php echo $iframe?>" />
	<input type="hidden" name="hidepost" value="<?php echo $hidepost?>" />
	<input type="hidden" name="pcode" value="<?php echo $date['totime']?>" />

	<div class="box">
		
		<div class="tt">
			<?php if($type == 'modify'):?>댓글수정<?php else:?>댓글쓰기<?php endif?>
			<span>- 댓글등록 이용약관을 지켜주세요.</span>
		</div>

		<div class="inputbox">
			<?php if(!$my['id']):?>
			<div><input type="text" name="name" value="<?php echo $R['name']?>" class="input1" /> <span>(이름)</span></div>
			<div><input type="password" name="pw" value="<?php echo $pw?>" class="input1" /> <span>(비번)</span></div>
			<?php endif?>
			<?php if($d['comment']['use_subject']):?>
			<div>
				<input type="text" name="subject" value="<?php echo htmlspecialchars($R['subject'])?>" class="input2" /> <span>(제목)</span>
			</div>
			<?php endif?>

			<div>
				<input type="hidden" name="html" value="<?php echo $R['html']?$R['html']:'TEXT'?>" />
				<textarea name="content"><?php echo htmlspecialchars($R['content'])?></textarea>
			</div>

		</div>


		<div class="bottom">
			<div class="l">
				<?php if($my['admin']):?>
				<input type="checkbox" name="notice" value="1"<?php if($R['notice']):?> checked="checked"<?php endif?> />공지글
				<?php endif?>
				<?php if($d['comment']['use_hidden']):?>
				<input type="checkbox" name="hidden" value="1"<?php if($R['hidden']):?> checked="checked"<?php endif?> />비밀글
				<?php endif?>
				<?php if(!$R['uid']&&is_file($g['path_module'].$d['comment']['snsconnect'])):?>
				<?php include_once $g['path_module'].$d['comment']['snsconnect']?>
				<?php endif?>
			</div>
			<div class="r">
				<?php if($type=='modify'):?><img src="<?php echo $g['img_module_skin']?>/btn_cancel.gif" alt="취소" class="hand" onclick="history.back();"><?php endif?>
				<input type="image" src="<?php echo $g['img_module_skin']?>/btn_write.gif" alt="의견등록" />
			</div>
			<div class="clear"></div>
		</div>

	</div>

	</form>
	<?php else:?>
	<?php if(!$my['uid']):?>
	<div class="box">
		<div class="tt">
			댓글쓰기
			<span>- 댓글쓰기 권한이 없습니다.</span>
		</div>
	</div>
	<?php endif?>
	<?php endif?>


</div>





