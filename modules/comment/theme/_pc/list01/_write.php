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

			<?php if(!$g['mobile']):?>
			<div class="iconbox">
				<?php if($d['comment']['perm_photo'] <= $my['level']):?>
				<a href="#." onclick="OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=upload&mod=photo&gparam=upfilesValue|upfilesFrame|editFrame');" /><img src="<?php echo $g['img_core']?>/_public/ico_photo.gif" alt="" />사진</a>
				<?php endif?>
				<?php if($d['comment']['perm_upfile'] <= $my['level']):?>
				<a href="#." onclick="OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=upload&mod=file&gparam=upfilesValue|upfilesFrame');" /><img src="<?php echo $g['img_core']?>/_public/ico_xfile.gif" alt="" />파일</a>
				<?php endif?>
				<?php if($d['comment']['edit_tool']):?>
				<a href="#." onclick="frames.editFrame.ToolboxShowHide(150);" /><img src="<?php echo $g['img_core']?>/_public/ico_edit.gif" alt="" />편집</a>
				<?php endif?>
			</div>
			<?php endif?>

			<?php if($type == 'modify'):?>댓글수정<?php else:?>댓글쓰기<?php endif?>
			<span>- 타인을 비방하거나 개인정보를 유출하는 글의 게시를 삼가주세요.</span>
		</div>

		<div class="inputbox">
			<?php if(!$my['id']):?>
			<div>
				<input type="text" name="name" value="<?php echo $R['name']?>" class="input1" /> <span>(이름)</span>
				<input type="password" name="pw" value="<?php echo $pw?>" class="input1" /> <span>(비번)</span>
			</div>
			<?php endif?>
			<?php if($d['comment']['use_subject']):?>
			<div>
				<input type="text" name="subject" value="<?php echo htmlspecialchars($R['subject'])?>" class="input2" /> <span>(제목)</span>	
			</div>
			<?php endif?>
		</div>

		<div class="editbox">
			<input type="hidden" name="html" id="editFrameHtml" value="<?php echo $R['html']?$R['html']:'HTML'?>" />
			<input type="hidden" name="content" id="editFrameContent" value="<?php echo htmlspecialchars($R['content'])?>" />
			<iframe name="editFrame" id="editFrame" src="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=editor&amp;toolbox=<?php echo $R['upload']?'Y':'N'?>" width="100%" height="<?php echo ($d['comment']['edit_height']+($R['upload']?400:0))?>" frameborder="0" scrolling="no"></iframe>
		</div>

		<div class="uploadbox">
			<iframe name="upfilesFrame" id="upfilesFrame" src="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=upload&amp;mod=list&amp;gparam=upfilesValue|editFrame&amp;code=<?php echo $type=='modify'?$R['upload']:''?>" width="100%" height="0" frameborder="0" scrolling="no"></iframe>
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
				&nbsp;&nbsp;SNS동시등록 - 
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
			<span>- 로그인한 후 댓글작성권한이 있을 경우 이용하실 수 있습니다.</span>
			<span class="login"><img src="<?php echo $g['img_module_skin']?>/btn_login.gif" alt="로그인" class="hand" onclick="commentLogin();"></span>
		</div>
	</div>
	<?php endif?>
	<?php endif?>


</div>





