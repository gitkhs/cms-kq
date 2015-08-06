
<div class="widget_tag01">
	<?php if(!$wdgvar['notuse']):?>
	<div class="tt"><?php echo $wdgvar['title']?></div>
	<?php endif?>
	<?php $d_regis1 = date('Ymd',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-$wdgvar['term'],substr($date['today'],0,4)))?>
	<?php $d_regis2 = $date['today']?>
	<?php $WHEREIS1 = 'site='.$s.' and date between '.$d_regis1.' and '.$d_regis2?>
	<?php $_RCD=getDbArray($table['s_tag'],$WHEREIS1,'*','hit','desc',$wdgvar['limit'],1)?>
	<?php $k=0;while($TG=db_fetch_array($_RCD)):?>
	<?php $TARR[]=array($TG['keyword'],$k++)?>
	<?php endwhile?>
	<?php $TGN=count($TARR)?>
	<?php if($TGN)shuffle($TARR)?>

	<?php $x2 = 0?>
	<?php $x1 = 5?>
	<?php for($j = 0; $j < $TGN; $j++):?>
	<?php $TCNUM=$TARR[$j][1]>$x1?1:($TARR[$j][1]>$x2?2:3)?>

	<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;mod=search&amp;keyword=<?php echo urlencode($TARR[$j][0])?>"><span class="tags_<?php echo $TCNUM?>"><?php echo $TARR[$j][0]?></span></a>
	<?php endfor?>
	<?php if(!db_num_rows($_RCD)):?>
	<span class="none">등록된 태그가 없습니다.</span>
	<?php endif?>
</div>