<div id="bbslist">
	<? if($mod=='list') { ?><div class="subject"><?=$_HM['name']?></div><? } ?>

<div class="container" style="margin-top:12px;">
	<div class="row">
		<div class="text-right col-md-12">
			<span class="stat"><?php echo number_format($NUM+count($NCD))?>개(<?php echo $p?>/<?php echo $TPG?>페이지)</span>
		</div>
	</div>

	<div class="list-group">
		<?php if($B['category']):$_catexp = explode(',',$B['category']);$_catnum=count($_catexp)?>
		<a href="#" class="list-group-item" onclick="return false;">
			<select onchange="document.bbssearchf.cat.value=this.value;document.bbssearchf.submit();" class="form-control">
			<option value="">&nbsp;+ <?php echo $_catexp[0]?></option>
			<option value="" class="sline">-------------------</option>
			<?php for($i = 1; $i < $_catnum; $i++):if(!$_catexp[$i])continue;?>
			<option value="<?php echo $_catexp[$i]?>"<?php if($_catexp[$i]==$cat):?> selected="selected"<?php endif?>>ㆍ<?php echo $_catexp[$i]?><?php if($d['theme']['show_catnum']):?>(<?php echo getDbRows($table[$m.'data'],'site='.$s.' and notice=0 and bbs='.$B['uid']." and category='".$_catexp[$i]."'")?>)<?php endif?></option>
			<?php endfor?>
			</select>
		</a>
		<?php endif?>

	<!-- 공지 -->
	<? foreach($NCD as $R) { ?> 
	<? $R['mobile']=isMobileConnect($R['agent']); ?>
		<a href="<?=$g['bbs_view'].$R['uid']?>" class="list-group-item list-group-item-info<?if($R['uid'] == $uid) echo ' active'; ?>">
		<div class="row">
		<div class="text-left col-sm-6 col-md-6" style="font-weight:bold;">
			<? if($R['category']) { ?><span class="cat">[<?=$R['category']?>]</span><? } ?>
			<?=getStrCut($R['subject'],$d['bbs']['sbjcut'],'...')?>
			<? if($R['comment']) { ?><span class="comment">[<?=$R['comment']?><? if($R['oneline']) { ?>+<?echo $R['oneline']?><? } ?>]</span><? } ?>
			<? if(getNew($R['d_regis'],24)) { ?><small><span class="label label-danger">new</span></small><? } ?>
		</div>
		<div class="text-right col-sm-6 col-md-6">
			<? if(strstr($R['content'],'.jpg')) { ?><span class="pic glyphicon glyphicon-picture"></span><? } ?>
			<? if($R['upload']) { ?><span class="file glyphicon glyphicon-paperclip"></span><? } ?>
			<? if($R['hidden']) { ?><span class="lock glyphicon glyphicon-lock"></span><? } ?>
		
			<?=$R[$_HS['nametype']]?> <span>|</span> 
			조회 <?=$R['hit']?> <span>|</span> 
			<?=getDateFormat($R['d_regis'],'Y.m.d')?>
		</div>
		</div>
		</a>
	<? } ?>

	<!-- 게시물 -->
	<? foreach($RCD as $R) { ?> 
	<? $R['mobile']=isMobileConnect($R['agent'])?>
		<a href="<?=$g['bbs_view'].$R['uid']?>" class="list-group-item<?if($R['uid'] == $uid) echo ' active'; ?>">
		<div class="row">
		<div class="text-left col-sm-6 col-md-6" style="font-weight:bold;">
			<? if($R['category']) { ?><span class="cat">[<?=$R['category']?>]</span><? } ?>
			<?=getStrCut($R['subject'],$d['bbs']['sbjcut'],'...')?>
			<? if($R['comment']) { ?><span class="comment">[<?=$R['comment']?><? if($R['oneline']) { ?>+<?echo $R['oneline']?><? } ?>]</span><? } ?>
			<? if(getNew($R['d_regis'],24)) { ?><small><span class="label label-danger">new</span></small><? } ?>
		</div>
		<div class="text-right col-sm-6 col-md-6">
			<? if(strstr($R['content'],'.jpg')) { ?><span class="pic glyphicon glyphicon-picture"></span><? } ?>
			<? if($R['upload']) { ?><span class="file glyphicon glyphicon-paperclip"></span><? } ?>
			<? if($R['hidden']) { ?><span class="lock glyphicon glyphicon-lock"></span><? } ?>
		
			<?=$R[$_HS['nametype']]?> <span>|</span> 
			조회 <?=$R['hit']?> <span>|</span> 
			<?=getDateFormat($R['d_regis'],'Y.m.d')?>
		</div>
		</div>
		</a>
	<? } ?>
	
	<? if(!$NUM) { ?>
		<a href="#" class="list-group-item" onclick="return false;"><h4 class="list-group-item-heading">등록된 게시물이 없습니다.</h4></a>
	<? } ?>
	
	</div>

	<div class="text-center">
	<?php echo getBootstrapPageLink($d['theme']['pagenum'],$p,$TPG)?>
	</div>

</div>

	<?php if($B['uid']):?>
	<div class="container text-right">
		<form name="bbssearchf" class="form-inline" action="<?php echo $g['s']?>/">
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
		<div class="form-group">
		<select class="form-control" name="where">
		<option value="subject|tag"<?php if($where=='subject|tag'):?> selected="selected"<?php endif?>>제목+태그</option>
		<option value="content"<?php if($where=='content'):?> selected="selected"<?php endif?>>본문</option>
		<option value="name"<?php if($where=='name'):?> selected="selected"<?php endif?>>이름</option>
		<option value="nic"<?php if($where=='nic'):?> selected="selected"<?php endif?>>닉네임</option>
		</select>
		</div>
		
		<div class="form-group">
		<input type="text" class="form-control" name="keyword" value="<?php echo $_keyword?>" />
		</div>

		<div class="form-group">
		<input type="submit" value=" 검색 " class="btn btn-sm btn-primary form-control" />
		</div>

		<?php endif?>

		</form>
		<div class="clear"></div>

	</div>
	<?php endif?>

	<? if($admin['admin'] <= $my['lelvel'] || $d['bbs']['perm_w'] <= $my['level']) { ?>
	<div>
		<div class="btnWrite"><a href="<?=$g['bbs_write']?>"><span class="label label-danger">+</span></a></div>
	</div>
	<? } ?>
</div>



