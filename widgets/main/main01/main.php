
<div class="widget_main01">

	<div class="wright">

		<div class="review01">
			<?php if($wdgvar['link1']):?>
			<h6><a href="<?php echo $wdgvar['link1']?>"><?php echo $wdgvar['title1']?></a></h6> 
			<?php else:?>
			<h6><?php echo $wdgvar['title1']?></h6> 
			<?php endif?>
			<ul>
			<?php $_RCD=getDbArray($table['bbsdata'],($wdgvar['bid1']?'bbs='.$wdgvar['bid1'].' and ':'').'display=1 and site='.$_HS['uid'],'*','gid','asc',$wdgvar['limit1'],1)?>
			<?php while($_R=db_fetch_array($_RCD)):?>
			<?php $_thumbimg=getUploadImage($_R['upload'],$_R['d_regis'],$_R['content'],'jpg|jpeg')?>
			<?php $_thumbimg=$_thumbimg?$_thumbimg:$g['img_core'].'/blank.gif'?>
			<?php $_link=getPostLink($_R)?>
			<li>
				<a href="<?php echo $_link?>"><img src="<?php echo $_thumbimg?>" width="70" height="50" alt="" /></a>
				<span>
				<a href="<?php echo $_link?>"><?php echo $_R['subject']?></a>
				<?php if($_R['comment']):?><span class="comment">[<?php echo $_R['comment']?><?php if($_R['oneline']):?>+<?php echo $_R['oneline']?><?php endif?>]</span><?php endif?>
				<?php if(getNew($_R['d_regis'],24)):?><span class="new">new</span><?php endif?>				
				</span>
			</li>
			<?php endwhile?>
			</ul>
			<?php if($wdgvar['link1']):?><a href="<?php echo $wdgvar['link1']?>" class="more" title="더보기">더보기</a><?php endif?>
		</div>


		<div class="gallery01">
			<?php if($wdgvar['link2']):?>
			<h6><a href="<?php echo $wdgvar['link2']?>"><?php echo $wdgvar['title2']?></a></h6> 
			<?php else:?>
			<h6><?php echo $wdgvar['title2']?></h6> 
			<?php endif?>
			<ul>
			<?php $_RCD=getDbArray($table['bbsdata'],($wdgvar['bid2']?'bbs='.$wdgvar['bid2'].' and ':'').'display=1 and site='.$_HS['uid'],'*','gid','asc',$wdgvar['limit2'],1)?>
			<?php $k=0;while($_R=db_fetch_array($_RCD)):$k++?>
			<?php $_thumbimg=getUploadImage($_R['upload'],$_R['d_regis'],$_R['content'],'jpg|jpeg')?>
			<?php $_thumbimg=$_thumbimg?$_thumbimg:$g['img_core'].'/blank.gif'?>
			<?php $_link=getPostLink($_R)?>
			<li<?php if(!($k%2)):?> class="nogap"<?php endif?>>
				<a href="<?php echo $_link?>"><img src="<?php echo $_thumbimg?>" width="115" height="85" alt="" /></a>
				<span>
				<a href="<?php echo $_link?>"><?php echo $_R['subject']?></a>
				<?php if($_R['comment']):?><span class="comment">[<?php echo $_R['comment']?><?php if($_R['oneline']):?>+<?php echo $_R['oneline']?><?php endif?>]</span><?php endif?>
				<?php if(getNew($_R['d_regis'],24)):?><span class="new">new</span><?php endif?>				
				</span>
			</li>
			<?php endwhile?>
			</ul>
			<?php if($wdgvar['link2']):?><a href="<?php echo $wdgvar['link2']?>" class="more" title="더보기">더보기</a><?php endif?>
		</div>


	</div>

	<div class="wleft">

		<?php for($_k = 4; $_k <= $wdgvar['tabnum']; $_k++):?>
		<div class="review01">
			<?php if($wdgvar['link'.$_k]):?>
			<h6><a href="<?php echo $wdgvar['link'.$_k]?>"><?php echo $wdgvar['title'.$_k]?></a></h6> 
			<?php else:?>
			<h6><?php echo $wdgvar['title'.$_k]?></h6> 
			<?php endif?>
			<ul>
			<?php $_RCD=getDbArray($table['bbsdata'],($wdgvar['bid'.$_k]?'bbs='.$wdgvar['bid'.$_k].' and ':'').'display=1 and site='.$_HS['uid'],'*','gid','asc',7,1)?>
			<?php $_R=db_fetch_array($_RCD)?>
			<?php if($_R['uid']):?>
			<?php $_thumbimg=getUploadImage($_R['upload'],$_R['d_regis'],$_R['content'],'jpg|jpeg')?>
			<?php $_thumbimg=$_thumbimg?$_thumbimg:$g['img_core'].'/blank.gif'?>
			<?php $_link=getPostLink($_R)?>
			<li class="photo">
				<a href="<?php echo $_link?>"><img src="<?php echo $_thumbimg?>" width="115" height="85" alt="" /></a>
				<span><a href="<?php echo $_link?>"><?php echo $_R['subject']?></a></span>
			</li>
			<?php endif?>
			<?php $k=0;while($_R=db_fetch_array($_RCD)):?>
			<?php $_link=getPostLink($_R)?>
			<li>
				ㆍ<a href="<?php echo $_link?>"<?php if($k<2):?> class="b"<?php endif?>><?php echo $_R['subject']?></a>
				<?php if($_R['comment']):?><span class="comment">[<?php echo $_R['comment']?><?php if($_R['oneline']):?>+<?php echo $_R['oneline']?><?php endif?>]</span><?php endif?>
				<?php if(getNew($_R['d_regis'],24)):?><span class="new">new</span><?php endif?>
			</li>
			<?php $k++;endwhile?>
			</ul>
			<?php if($wdgvar['link'.$_k]):?><a href="<?php echo $wdgvar['link'.$_k]?>" class="more" title="더보기">더보기</a><?php endif?>
		</div>
		<?php endfor?>


		<div class="post01">
			<?php if($wdgvar['link3']):?>
			<h6><a href="<?php echo $wdgvar['link3']?>"><?php echo $wdgvar['title3']?></a></h6> 
			<?php else:?>
			<h6><?php echo $wdgvar['title3']?></h6> 
			<?php endif?>
			<ul> 
			<?php $_RCD=getDbArray($table['bbsdata'],($wdgvar['bid3']?'bbs='.$wdgvar['bid3'].' and ':'').'display=1 and site='.$_HS['uid'],'*','gid','asc',$wdgvar['limit3'],1)?>
			<?php $k=0; while($_R=db_fetch_array($_RCD)):$k++?>
			<li<?php if(!($k%4)):?> class="nogap"<?php endif?>>
				<a href="<?php echo getPostLink($_R)?>"<?php if($k<4):?> class="b"<?php endif?>><?php echo getStrCut($_R['subject'],$wdgvar['sbjcut'],'')?></a>
				<?php if($_R['comment']):?><span class="comment">[<?php echo $_R['comment']?><?php if($_R['oneline']):?>+<?php echo $_R['oneline']?><?php endif?>]</span><?php endif?>
				<?php if(getNew($_R['d_regis'],24)):?><span class="new">new</span><?php endif?>
			</li> 
			<?php endwhile?>
			<?php if(!db_num_rows($_RCD)):?><li class="none"></li><?php endif?> 
			</ul> 
			<?php if($wdgvar['link3']):?><a href="<?php echo $wdgvar['link3']?>" class="more" title="더보기">더보기</a><?php endif?>
		</div>
	</div>


</div>
