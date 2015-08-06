
<div class="widget_post04">
	<?php if($wdgvar['link']):?>
	<h6><a href="<?php echo $wdgvar['link']?>"><?php echo $wdgvar['title']?></a></h6> 
	<?php else:?>
	<h6><?php echo $wdgvar['title']?></h6> 
	<?php endif?>
	<ul>
	<?php $_RCD=getDbArray($table['bbsdata'],($wdgvar['bid']?'bbs='.$wdgvar['bid'].' and ':'').'display=1 and site='.$_HS['uid'],'*','gid','asc',7,1)?>
	<?php $_R=db_fetch_array($_RCD)?>
	<?php if($_R['uid']):?>
	<?php $_thumbimg=getUploadImage($_R['upload'],$_R['d_regis'],$_R['content'],'jpg|jpeg')?>
	<?php $_thumbimg=$_thumbimg?$_thumbimg:$g['img_core'].'/blank.gif'?>
	<?php $_link=getPostLink($_R)?>
	<li class="photo">
		<a href="<?php echo $_link?>"><img src="<?php echo $_thumbimg?>" width="115" height="85" alt="" /></a>
		<span><a href="<?php echo $_link?>"><?php echo getStrCut($_R['subject'],$wdgvar['sbjcut'],'')?></a></span>
	</li>
	<?php endif?>
	<?php $k=0;while($_R=db_fetch_array($_RCD)):?>
	<?php $_link=getPostLink($_R)?>
	<li>
		ㆍ<a href="<?php echo $_link?>"<?php if($k<$wdgvar['bnum']):?> class="b"<?php endif?>><?php echo getStrCut($_R['subject'],$wdgvar['sbjcut'],'')?></a>
		<?php if($_R['comment']):?><span class="comment">[<?php echo $_R['comment']?><?php if($_R['oneline']):?>+<?php echo $_R['oneline']?><?php endif?>]</span><?php endif?>
		<?php if(getNew($_R['d_regis'],24)):?><span class="new">new</span><?php endif?>
	</li>
	<?php $k++;endwhile?>
	</ul>
	<?php if($wdgvar['link']):?><a href="<?php echo $wdgvar['link']?>" class="more" title="더보기">더보기</a><?php endif?>
</div>

