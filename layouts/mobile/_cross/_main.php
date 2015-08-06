<?php if($d['layout']['begin']):?>
<div id="mainbox">

	<?php if($d['layout']['bbs1']!='n'):?>
	<?php $_sort=explode(',',$d['layout']['sort1'])?>
	<?php $_date=$d['layout']['bbs1_day']!=''?date('YmdHis',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-$d['layout']['bbs1_day'],$date['year'])):0?>
	<?php $_RCD=getDbArray($table['bbsdata'],($d['layout']['bbs1']?'bbs='.$d['layout']['bbs1']:'site='.$s).' and display=1 and d_regis > '.$_date,'*',$_sort[0],$_sort[1],$d['layout']['bbs1_num'],1)?>
	<?php $_NUM=db_num_rows($_RCD)?>

	<div class="tboard">
		<?php if(!$d['layout']['bbs1_namehide']):?><div class="title"><?php echo $d['layout']['bbs1_name']?></div><?php endif?>
		<ul>
		<?php $_i=0;while($_R=db_fetch_array($_RCD)):$_i++?>
		<li<?php if($_NUM==$_i):?> class="noline"<?php endif?>><a href="<?php echo getPostLink($_R)?>"><?php echo $_R['subject']?></a></li>
		<?php endwhile?>
		<?php if(!$_NUM):?>
		<li class="none">등록된 게시물이 없습니다.</li>
		<?php endif?>
		<ul>
	</div>
	<?php endif?>


	<?php if($d['layout']['bbs2']!='n'):?>
	<?php $_sort=explode(',',$d['layout']['sort2'])?>
	<?php $_date=$d['layout']['bbs2_day']!=''?date('YmdHis',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-$d['layout']['bbs1_day'],$date['year'])):0?>
	<?php $_RCD=getDbArray($table['bbsdata'],($d['layout']['bbs2']?'bbs='.$d['layout']['bbs2']:'site='.$s).' and display=1 and d_regis > '.$_date,'*',$_sort[0],$_sort[1],$d['layout']['bbs2_num'],1)?>
	<?php $_NUM=db_num_rows($_RCD)?>
	
	<div class="mboard">
		<?php if(!$d['layout']['bbs2_namehide']):?><div class="title num<?php echo $_NUM?>"><?php echo $d['layout']['bbs2_name']?></div><?php endif?>
		<ul>
		<?php while($_R=db_fetch_array($_RCD)):?>
		<?php $_THUMB=getUploadImage($_R['upload'],$_R['d_regis'],$_R['content'],'jpg|jpeg')?>
		<li>
			<div><img src="<?php echo $_THUMB?$_THUMB:$g['img_core'].'/blank.gif'?>" alt="" /></div>
			<a href="<?php echo getPostLink($_R)?>"><?php echo $_R['subject']?></a>
		</li>
		<?php endwhile?>
		<?php if(!$_NUM):?>
		<li class="none">등록된 게시물이 없습니다.</li>
		<?php endif?>
		<ul>
		<div class="clear"></div>
	</div>
	<?php endif?>


	<?php if($d['layout']['bbs3']!='n'):?>
	<?php $_sort=explode(',',$d['layout']['sort3'])?>
	<?php $_date=$d['layout']['bbs3_day']!=''?date('YmdHis',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-$d['layout']['bbs3_day'],$date['year'])):0?>
	<?php $_RCD=getDbArray($table['bbsdata'],($d['layout']['bbs3']?'bbs='.$d['layout']['bbs3']:'site='.$s).' and display=1 and d_regis > '.$_date,'*',$_sort[0],$_sort[1],$d['layout']['bbs3_num'],1)?>
	<?php $_NUM=db_num_rows($_RCD)?>

	<div class="fboard">
		<?php if(!$d['layout']['bbs3_namehide']):?><div class="title"><?php echo $d['layout']['bbs3_name']?></div><?php endif?>
		<?php $_i=0;while($_R=db_fetch_array($_RCD)):$_i++?>
		<?php $_THUMB=getUploadImage($_R['upload'],$_R['d_regis'],$_R['content'],'jpg|jpeg')?>
		<div class="post<?php if($_NUM==$_i):?> noline<?php endif?>">
			<div class="xtitle"><a href="<?php echo getPostLink($_R)?>"><?php echo $_R['subject']?></a></div>
			<div class="date"><?php echo getDateFormat($_R['d_regis'],'Y년 m월 d일')?></div>
			<div class="cont">
				<?php if($_THUMB):?><img src="<?php echo $_THUMB?>" alt="" /><?php endif?>
				<?php echo getStrCut(getStripTags($_R['content']),200,'..')?>
			</div>
		</div>
		<?php endwhile?>
		<?php if(!$_NUM):?>
		<div class="none">등록된 게시물이 없습니다.</div>
		<?php endif?>
		<div class="clear"></div>
	</div>
	<?php endif?>

</div>
<?php endif?>
