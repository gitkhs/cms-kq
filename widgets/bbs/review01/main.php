

<div class="widget_review01">
	<?php if($wdgvar['link']):?>
	<h6><a href="<?php echo $wdgvar['link']?>"><?php echo $wdgvar['title']?></a></h6>
	<?php else:?>
	<h6><?php echo $wdgvar['title']?></h6>
	<?php endif?>
	<ul>
	<?php $_RCD=getDbArray($table['bbsdata'],($wdgvar['bid']?'bbs='.$wdgvar['bid'].' and ':'').'display=1 and site='.$_HS['uid'],'*','gid','asc',$wdgvar['limit'],1)?>
	<?php while($_R=db_fetch_array($_RCD)):?>
	<?php $_thumbimg=getUploadImage($_R['upload'],$_R['d_regis'],$_R['content'],'jpg|jpeg')?>
	<?php $_link=getPostLink($_R)?>
	<li>
		<a href="<?php echo $_link?>" title="<?php echo $_R[$_HS['nametype']]?>님"><?php if($_thumbimg):?><span class="thumb"><img src="<?php echo $_thumbimg?>"<?php if($wdgvar['width']):?> width="<?php echo $wdgvar['width']?>"<?php endif?><?php if($wdgvar['height']):?> height="<?php echo $wdgvar['height']?>"<?php endif?> alt="" /></span><?php endif?><strong><?php echo $_R['subject']?></strong></a>

		<p><?php echo getStrCut(str_replace('&nbsp;',' ',strip_tags($_R['content'])),$wdgvar['length'],'..')?></p>
	</li>
	<?php endwhile?>
	</ul>
	<?php if($wdgvar['link']):?><a href="<?php echo $wdgvar['link']?>" class="more" title="더보기">더보기</a><?php endif?>
</div>
