<div id="clist">



	<?php foreach($NCD as $R):?>
	<?php $R['mobile']=isMobileConnect($R['agent'])?>
	<div class="postbox">
		<div class="subject">
			<img src="<?php echo $g['img_module_skin']?>/ico_notice.gif" alt="공지" class="imgpos2" />
			<?php if($R['mobile']):?><img src="<?php echo $g['img_core']?>/_public/ico_mobile.gif" class="imgpos1" alt="모바일" title="모바일(<?php echo $R['mobile']?>)로 등록된 글입니다" /><?php endif?>
			<a href="<?php echo $g['cment_view'].$R['uid']?>#CMT<?php echo $R['uid']?>" class="notice"><?php echo $R['subject']?></a>
			<?php if(strstr($R['content'],'.jpg')):?><img src="<?php echo $g['img_core']?>/_public/ico_pic.gif" class="imgpos" alt="사진" title="사진" /><?php endif?>
			<?php if($R['upload']):?><img src="<?php echo $g['img_core']?>/_public/ico_file.gif" class="imgpos" alt="첨부파일" title="첨부파일" /><?php endif?>
			<?php if($R['hidden']):?><img src="<?php echo $g['img_core']?>/_public/ico_hidden.gif" class="imgpos" alt="비밀글" title="비밀글" /><?php endif?>
			<?php if($R['oneline']):?><span class="comment">[<?php echo $R['oneline']?>]</span><?php endif?>
			<?php if(getNew($R['d_regis'],24)):?><span class="new">new</span><?php endif?>
		</div>
		<div class="info">
			<?php echo $R[$_HS['nametype']]?> / 조회 <?php echo $R['hit']?> / 공감 <?php echo $R['score1']?> / <?php echo getDateFormat($R['d_regis'],'m.d H:i')?>
		</div>
	</div>
	<?php endforeach?>

	<?php $cnt=count($RCD)?>
	<?php foreach($RCD as $R):?>
	<?php $R['mobile']=isMobileConnect($R['agent'])?>

	<div class="postbox">
		<div class="subject">
			<?php if($R['mobile']):?><img src="<?php echo $g['img_core']?>/_public/ico_mobile.gif" class="imgpos1" alt="모바일" title="모바일(<?php echo $R['mobile']?>)로 등록된 글입니다" /><?php endif?>
			<a href="<?php echo $g['cment_view'].$R['uid']?>#CMT<?php echo $R['uid']?>"<?php if($R['uid']==$uid):?> class="b"<?php endif?>><?php echo $R['subject']?></a>
			<?php if(strstr($R['content'],'.jpg')):?><img src="<?php echo $g['img_core']?>/_public/ico_pic.gif" class="imgpos" alt="사진" title="사진" /><?php endif?>
			<?php if($R['upload']):?><img src="<?php echo $g['img_core']?>/_public/ico_file.gif" class="imgpos" alt="첨부파일" title="첨부파일" /><?php endif?>
			<?php if($R['hidden']):?><img src="<?php echo $g['img_core']?>/_public/ico_hidden.gif" class="imgpos" alt="비밀글" title="비밀글" /><?php endif?>
			<?php if($R['oneline']):?><span class="comment">[<?php echo $R['oneline']?>]</span><?php endif?>
			<?php if(getNew($R['d_regis'],24)):?><span class="new">new</span><?php endif?>
		</div>
		<div class="info">
			<?php echo $R[$_HS['nametype']]?> / 조회 <?php echo $R['hit']?> / 공감 <?php echo $R['score1']?> / <?php echo getDateFormat($R['d_regis'],'m.d H:i')?>
		</div>
	</div>

	<?php endforeach?>
	<?php $R=array()?>


	<?php if(!$NUM):?>

	<?php endif?>
	
	<div class="page pagebox01">
		<script type="text/javascript">getPageLink(5,<?php echo $p?>,<?php echo $TPG?>,'<?php echo $g['img_core']?>/page/default');</script>
	</div>
	

</div>

