

<div class="widget_gallery01">
	<?php if($wdgvar['link']):?>
	<h6><a href="<?php echo $wdgvar['link']?>"><?php echo $wdgvar['title']?></a></h6>
	<?php else:?>
	<h6><?php echo $wdgvar['title']?></h6>
	<?php endif?>
	<ul>
	<?php $_RCD=getDbArray($table['bbsdata'],($wdgvar['bid']?'bbs='.$wdgvar['bid'].' and ':'').'display=1 and site='.$_HS['uid'],'*','gid','asc',$wdgvar['limit'],1)?>
	<?php while($_R=db_fetch_array($_RCD)):?>
	<?php $_thumbimg=getUploadImage($_R['upload'],$_R['d_regis'],$_R['content'],'jpg|jpeg')?>
	<?php $_thumbimg=$_thumbimg?$_thumbimg:$g['img_core'].'/blank.gif'?>
	<?php $_link=getPostLink($_R)?>
	<li>
		<a href="<?php echo $_link?>"><img src="<?php echo $_thumbimg?>" width="<?php echo $wdgvar['width']?>" height="<?php echo $wdgvar['height']?>" class="thumb" alt="" /></a>
		<p style="width:<?php echo $wdgvar['width']?>px;">
			<a href="<?php echo $_link?>" title="<?php echo $_R[$_HS['nametype']]?>님"><?php echo $_R['subject']?></a>
			<?php if($_R['comment']):?><span class="comment">[<?php echo $_R['comment']?><?php if($_R['oneline']):?>+<?php echo $_R['oneline']?><?php endif?>]</span><?php endif?>
			<span class="date">
			<?php echo getDateFormat($_R['d_regis'],'Y-m-d')?>
			<?php if(getNew($_R['d_regis'],24)):?><span class="new">new</span><?php endif?>			
			</span>
		</p>
	</li>
	<?php endwhile?>
	</ul>
	<?php if($wdgvar['link']):?><a href="<?php echo $wdgvar['link']?>" class="more" title="더보기">더보기</a><?php endif?>
</div>
