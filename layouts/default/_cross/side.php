<div id="sidebox">

<? if($d['config']['side_loginbox']) { ?>
<? if($my['uid']) { ?>
<div class="mbrinfo">
	<div class="symbol"><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;mod=mypage&amp;page=simbol"><img src="<?php echo $g['s']?>/_var/simbol/<?php echo $my['photo']?$my['photo']:'0.gif'?>" alt="" /></a></div>
	<div class="name">
		<div class="namel"><?php echo $my[$_HS['nametype']]?>님</div>
		<div class="namer">
			<?php if($d['layout']['sns_hide']):?>
			<a href="<?php echo RW('mod=mypage')?>"><img src="<?php echo $g['img_layout']?>/btn_config.gif" alt="" /></a>
			<?php else:?>
			<a href="#." onclick="getLayerBox('<?php echo $g['s']?>/?r=<?php echo $r?>&m=social&page=account','소셜계정',600,650,event,true,'<?php echo $d['layout']['dsp_side']=='left'?'r':'l'?>');"><img src="<?php echo $g['img_layout']?>/btn_config1.gif" alt="" /></a>
			<?php endif?>
			<a href="#" onclick="pageLogout();"><img src="<?php echo $g['img_layout']?>/btn_logout.gif" alt="" /></a>
		</div>
	</div>
	<div class="clear"></div>
	<div class="score">
		<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;mod=mypage&amp;page=point">포인트 <?php echo number_format($my['point'])?>P</a> / 가입 <?php echo getDateFormat($my['d_regis'],'Y.m.d')?>
	</div>
</div>
<? } ?>
<? } ?>


<? $_M1 = getUidData($table['s_menu'], $g['nowFMemnu']); ?>
<div class="sidetitle"><?=$_M1['name'] ? $_M1['name'] : '&nbsp;'?></div>

<? if($d['layout']['dsp_side_menu']) { ?>
<? $_MENUS2=getDbSelect($table['s_menu'],'site='.$s.' and parent='.(int)$g['nowFMemnu'].' and depth=2 order by gid asc','*')?>
<? $_MENUSN=db_num_rows($_MENUS2)?>
<? if($_MENUN || (!$d['layout']['dsp_side_menuhide']&&$_CA[0])) { ?>
<div class="sidemenu">
<ul>
	<?php $_i=0;while($_M2=db_fetch_array($_MENUS2)) { ?>
	<? if($_M2['hidden'] && $my[level] < $admin['admin']) continue; ?>
	<li class="m2<?if(!$_i){?> _fst<?}?>">
	<a href="<?php echo RW('c='.$_CA[0].'/'.$_M2['id'])?>" target="<?php echo $_M2['target']?>">
	<div class="<?if($_M2['id']==$_CA[1]){?>on<?}?>"><span class="glyphicon <?if($_M2['id']==$_CA[1]){?>glyphicon glyphicon-chevron-down<?}else{?>glyphicon-chevron-right<?}?>"></span> <?=$_M2['name']?></div>
	</a>

	<?php if(($_HM['uid']==$_M2['uid']||$_HM['parent']==$_M2['uid'])&&$_M2['isson']):?>
	<ul class="m3">
	<?php $_MENUS3=getDbSelect($table['s_menu'],'site='.$s.' and parent='.$_M2['uid'].' and depth=3 order by gid asc','*')?>
	<? while($_M3=db_fetch_array($_MENUS3)) { ?>
	<? if($_M3['hidden'] && $my[level] < $admin['admin']) continue; ?>
	<li><a href="<?php echo RW('c='.$_CA[0].'/'.$_CA[1].'/'.$_M3['id'])?>" target="<?php echo $_M3['target']?>"<?php if($_M3['uid']==$_HM['uid']):?> class="on"<?php endif?>><?php echo $_M3['name']?></a></li>
	<? } // end while ?>
	</ul>
	<?php endif?>
	</li>
	<? $_i++; } ?>
</ul>
</div>
<? } ?>
<? } ?>



<?php if($d['config']['side_bbshot']):?>
<div class="hotbox">
	<div class="tabbox">
		<div class="tp vline on" onclick="tabCheck_s(1,this,'_myHOTlayer_','<?php echo $d['layout']['dsp_side_hotnum']?>');">많이 본 글</div>
		<div class="tp" onclick="tabCheck_s(2,this,'_myHOTlayer_','<?php echo $d['layout']['dsp_side_hotnum']?>');">댓글 많은 글</div>
		<div class="clear"></div>
	</div>
	<div id="_myHOTlayer_" class="hbody">
		<ul>
		<?php $_date=date('YmdHis',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-30,$date['year']))?>
		<?php $_RCD=getDbArray($table['bbsdata'],'site='.$s.' and display=1 and d_regis > '.$_date,'*','hit','desc',$d['layout']['dsp_side_hotnum'],1);?>
		<?php $_i=0;while($_R=db_fetch_array($_RCD)):$_i++?>
		<li><i<?php if($_i<4):?> class="emp"<?php endif?>><?php echo $_i?></i><a href="<?php echo getPostLink($_R)?>"><?php echo $_R['subject']?></a><?php if($_R['comment']+$_R['oneline']):?><span>(<?php echo $_R['comment']+$_R['oneline']?>)</span><?php endif?></li>
		<?php endwhile?>
		</ul>
	</div>
</div>
<?php endif?>

</div>