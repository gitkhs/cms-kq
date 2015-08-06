<?if($iframe != 'Y'){?><div class="subject"><?=$_HM['name']?></div><?}?>

<div id="bbslist">

	<div class="title">
		<div class="article">
			<a href="<?=$g['bbs_write']?>" style="color:#fa6800;"><span class="glyphicon glyphicon-pencil"></span> 글쓰기</a>
			<span class="stat"><?php echo number_format($NUM+count($NCD))?>개(<?php echo $p?>/<?php echo $TPG?>페이지)</span>
		</div>
		
		<div class="category">
			<?php if($B['category']):$_catexp = explode(',',$B['category']);$_catnum=count($_catexp)?>
			<select onchange="document.bbssearchf.cat.value=this.value;document.bbssearchf.submit();">
			<option value="">&nbsp;+ <?php echo $_catexp[0]?></option>
			<option value="" class="sline">-------------------</option>
			<?php for($i = 1; $i < $_catnum; $i++):if(!$_catexp[$i])continue;?>
			<option value="<?php echo $_catexp[$i]?>"<?php if($_catexp[$i]==$cat):?> selected="selected"<?php endif?>>ㆍ<?php echo $_catexp[$i]?><?php if($d['theme']['show_catnum']):?>(<?php echo getDbRows($table[$m.'data'],'site='.$s.' and notice=0 and bbs='.$B['uid']." and category='".$_catexp[$i]."'")?>)<?php endif?></option>
			<?php endfor?>
			</select>
			<?php endif?>
		</div>
		<div class="clear"></div>
	</div>

	<div class="gallery">
		<ul>
		<!-- 공지 -->
		<? if($p<=1) { ?>
		<? foreach($NCD as $R) { ?> 
		<? $R['mobile']=isMobileConnect($R['agent']); ?>
		<? $_thumbimg = getUploadImage($R['upload'],$R['d_regis'],$R['content'],$d['theme']['picimgext'],$d['bbs']['thumcnt']); ?>
		<? $_thumbimg = $_thumbimg ? $_thumbimg : $g['img_module_skin'].'/notfound-image.jpg'; ?>
		<li>
			<a href="<?=$g['bbs_view'].$R['uid']?>">
			<div class="box<? if($R['uid'] == $uid) {echo ' now';} ?>">
				<div class="img" style="background:url(<?=$_thumbimg?>) center no-repeat; background-size:cover;"></div>
				
				<? if(!$d['bbs']['hide_sbj']) { ?>
				<div class="sbj notify<? if($R['uid'] == $uid) {echo ' now';} ?>">
				<?=getStrCut($R['subject'],$d['bbs']['sbjcut'],'...')?>
				<? if(getNew($R['d_regis'],24)) { ?><span class="new">new</span><? } ?>
				</div>
				<? } ?>
			</div>
			</a>

		</li>
		<? } ?>
		<? } ?>

		<!-- 게시물 -->
		<? foreach($RCD as $R) { ?> 
		<? $R['mobile']=isMobileConnect($R['agent']); ?>
		<? $_thumbimg = getUploadImage($R['upload'],$R['d_regis'],$R['content'],$d['theme']['picimgext'],$d['bbs']['thumcnt']); ?>
		<? $_thumbimg = $_thumbimg ? $_thumbimg : $g['img_module_skin'].'/notfound-image.jpg'; ?>
		<li>
			<a href="<?=$g['bbs_view'].$R['uid']?>">
			<div class="box<? if($R['uid'] == $uid) {echo ' now';} ?>">
				<div class="img" style="background:url(<?=$_thumbimg?>) center no-repeat; background-size:cover;"></div>
				
				<? if(!$d['bbs']['hide_sbj']) { ?>
				<div class="sbj<? if($R['uid'] == $uid) {echo ' now';} ?>" style="max-width:<?=$imgw?>px;">
				<? if($R['mobile']) { ?><span class="mob glyphicon glyphicon-phone"></span><? } ?>
				<?=getStrCut($R['subject'],$d['bbs']['sbjcut'],'...')?>
				<? if($R['upload']) { ?><span class="file glyphicon glyphicon-paperclip"></span><? } ?>
				<? if($R['hidden']) { ?><span class="lock glyphicon glyphicon-lock"></span><? } ?>
				<? if($R['comment']) { ?><span class="comment">[<?=$R['comment']?><? if($R['oneline']) { ?>+<?echo $R['oneline']?><? } ?>]</span><? } ?>
				</div>
				<? } ?>
			</div>
			</a>

		</li>
		<? } ?>
		</ul>
		</div>

	<div class="page">
	<?php echo getPageLink($d['theme']['pagenum'],$p,$TPG,$g['img_core'].'/page/default')?>
	</div>

	<?php if($B['uid']):?>
	<div class="btnbox">
		<div class="ctrl">
			<? if($admin['admin'] <= $my['lelvel'] || $d['bbs']['perm_w'] <= $my['level']) { ?>
			<a href="<?=$g['bbs_write']?>" style="float:left; color:#fa6800;"><span class="glyphicon glyphicon-pencil"></span>쓰기</span></a>
			<? } ?>
			<a href="<?=$g['bbs_reset']?>" style="float:right; color:#4390df;"><span class="glyphicon glyphicon-list"></span>목록</span></a>
			<div class="clear"></div>
		</div>

		<div class="xl">
		<form name="bbssearchf" action="<?php echo $g['s']?>/">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="c" value="<?php echo $c?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="bid" value="<?php echo $bid?>" />
		<input type="hidden" name="cat" value="<?php echo $cat?>" />
		<input type="hidden" name="sort" value="<?php echo $sort?>" />
		<input type="hidden" name="orderby" value="<?php echo $orderby?>" />
		<input type="hidden" name="recnum" value="<?php echo $recnum?>" />
		<input type="hidden" name="type" value="<?php echo $type?>" />
		<input type="hidden" name="iframe" value="<?php echo $iframe?>" />
		<input type="hidden" name="skin" value="<?php echo $skin?>" />

		<?php if($d['theme']['search']):?>
		<select name="where">
		<option value="subject|tag"<?php if($where=='subject|tag'):?> selected="selected"<?php endif?>>제목+태그</option>
		<option value="content"<?php if($where=='content'):?> selected="selected"<?php endif?>>본문</option>
		<option value="name"<?php if($where=='name'):?> selected="selected"<?php endif?>>이름</option>
		<option value="nic"<?php if($where=='nic'):?> selected="selected"<?php endif?>>닉네임</option>
		</select>
		
		<input type="text" name="keyword" value="<?php echo $_keyword?>" />
		<input type="submit" value=" 검색 " class="btnblue" />
		<?php endif?>

		</form>
		</div>
		<div class="clear"></div>
	</div>
	<?php endif?>

</div>

