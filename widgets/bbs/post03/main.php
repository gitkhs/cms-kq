
<div class="widget_post03">
	<?php if($wdgvar['link']):?>
	<h6><a href="<?php echo $wdgvar['link']?>"><?php echo $wdgvar['title']?></a></h6> 
	<?php else:?>
	<h6><?php echo $wdgvar['title']?></h6> 
	<?php endif?>
	<ul> 
	<?php $_RCD=getDbArray($table['bbsdata'],($wdgvar['bid']?'bbs='.$wdgvar['bid'].' and ':'').'display=1 and site='.$_HS['uid'],'*','gid','asc',$wdgvar['limit'],1)?>
	<?php $k=0; while($_R=db_fetch_array($_RCD)):$k++?>
	<li<?php if($wdgvar['gnum']&&!($k%$wdgvar['gnum'])):?> class="nogap"<?php endif?>>
		<?php if($wdgvar['disp']):?><span class="date">[<?php echo getDateFormat($_R['d_regis'],'Y.m.d')?>]</span><?php endif?>
		<a href="<?php echo getPostLink($_R)?>"<?php if($k<=$wdgvar['bnum']):?> class="b"<?php endif?>><?php echo getStrCut($_R['subject'],$wdgvar['sbjcut'],'')?></a>
		<?php if($_R['comment']):?><span class="comment">[<?php echo $_R['comment']?><?php if($_R['oneline']):?>+<?php echo $_R['oneline']?><?php endif?>]</span><?php endif?>
		<?php if(getNew($_R['d_regis'],24)):?><span class="new">new</span><?php endif?>
	</li> 
	<?php endwhile?>
	<?php if(!db_num_rows($_RCD)):?><li class="none"></li><?php endif?> 
	</ul> 
	<?php if($wdgvar['link']):?><a href="<?php echo $wdgvar['link']?>" class="more" title="더보기">더보기</a><?php endif?>
</div>
