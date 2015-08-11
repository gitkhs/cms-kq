<div id="header">
	<div class="wrap">
		<table class="tbl-none">
		<tr>
			<td class="logo">
				<a href="<?=$g['s']?>/"><img src="<?=$g['dir_images']?>/dsk_logo.png"></a>
			</td>
			<td class="search">
				<? if($d['config']['site_search']) { ?>
				<form action="<?php echo $g['s']?>/" method="get" id="_layout_search_border_">
				<input type="hidden" name="r" value="<?=$r?>" />
				<input type="hidden" name="mod" value="search" />
				<div class="srch-box">
					<input type="text" name="keyword" placeholder="통합검색" class="srch-kwd" value="<?=$_keyword?>" />
					<span class="glyphicon glyphicon-search srch-btn" onclick="$('#_layout_search_border_').submit();"></span>
					<div class="clear"></div>
				</div>
				</form>
				<? } ?>
			</td>
		</tr>
		</table>
	</div>
</div>

<div id="topmenu">
	<div class="wrap">
		<ul>
		<li class="t-box">
			<a href="#" onclick="topmenu.allMenu(); return false;"><span class="glyphicon glyphicon-th"></span></a>
		</li>
		<?php $_MENUS1=getDbSelect($table['s_menu'],'site='.$s.' and hidden=0 and depth=1 order by gid asc','*')?>
		<? $_i=0; while($_M1=db_fetch_array($_MENUS1)){?>
		<li class="m-box<?if(in_array($_M1['id'],$_CA)) {?> on<?}?>" onmouseover="showM('<?=$_M1['uid']?>');" onmouseout="hideM('<?=$_M1['uid']?>');">
			<? if($_M1['isson']) {?>
			<div id="subMenuBox<?php echo $_M1['uid']?>" class="subMenuBox">
			<dl>
			<?php $_MENUS2=getDbSelect($table['s_menu'],'site='.$s.' and parent='.$_M1['uid'].' and hidden=0 and depth=2 order by gid asc','*')?>
			<?php while($_M2=db_fetch_array($_MENUS2)) {?>
			<dt<?php if(in_array($_M2['id'],$_CA)):?> class="on1"<?php endif?>><a href="<?php echo RW('c='.$_M1['id'].'/'.$_M2['id'])?>"><?php echo $_M2['name']?></a></dt>
			<?php if($_M2['isson']) {?>
			<?php $_MENUS3=getDbSelect($table['s_menu'],'site='.$s.' and parent='.$_M2['uid'].' and hidden=0 and depth=3 order by gid asc','*')?>
			<?php while($_M3=db_fetch_array($_MENUS3)) {?>
			<dd><a href="<?php echo RW('c='.$_M1['id'].'/'.$_M2['id'].'/'.$_M3['id'])?>">ㆍ<?php echo $_M3['name']?></a></dd>
			<?php }?>
			<?php }?>
			<?php }?>
			</dl>
			</div>
			<?}?>

			<a href="<?php echo $_M1['redirect']?$_M1['joint']:RW('c='.$_M1['id'])?>" target="<?php echo $_M1['target']?>"<?php if(in_array($_M1['id'],$_CA)):$g['nowFMemnu']=$_M1['uid']?> class="on"<?php endif?>><span><?php echo $_M1['name']?></span></a>
		</li>
		<?$_i++; if($_i >= $d['layout']['menunum']) break; ?>
		<?}?>
		</ul>
		<div class="clear"></div>
	</div>

	<div class="all-box">
		<div class="wrap">
			<table class="tbl-none">
			<tr>
			<td width="55px">&nbsp;</td>
			<? $_MENUS1=getDbSelect($table['s_menu'],'site='.$s.' and hidden=0 and depth=1 order by gid asc','*')?>
			<? while($_M1=db_fetch_array($_MENUS1)) { ?>
			<td>
				<a href="<?echo $_M1['redirect']?$_M1['joint']:RW('c='.$_M1['id'])?>" target="<?=$_M1['target']?>"><div class="m1"><?=$_M1['name']?></div></a>

				<? $_MENUS2=getDbSelect($table['s_menu'],'site='.$s.' and parent='.$_M1['uid'].' and hidden=0 and depth=2 order by gid asc','*'); ?>
				<? if($_MENUS2) { ?>
					<? while($_M2=db_fetch_array($_MENUS2)) { ?>
					<a href="<?echo RW('c='.$_M1['id'].'/'.$_M2['id'])?>" target="<?=$_M2['target']?>" <?if(in_array($_M2['id'],$_CA)) {?>class="on"<?}?>><div class="m2"><?=$_M2['name']?></div></a>
						<? if($_M2['isson']) { ?>
							<? $_MENUS3=getDbSelect($table['s_menu'],'site='.$s.' and parent='.$_M2['uid'].' and hidden=0 and depth=3 order by gid asc','*'); ?>
							<? while($_M3=db_fetch_array($_MENUS3)) { ?>
							<a href="<?echo RW('c='.$_M1['id'].'/'.$_M2['id'].'/'.$_M3['id'])?>" target="<?=$_M3['target']?>" <?if(in_array($_M3['id'],$_CA)) {?>class="on"<?}?>><div class="m3"><?=$_M3['name']?></div></a>
							<? } // while($_M3=db_fetch_array($_MENUS3)) ?>
						<? } ?>
					<? } //while($_M2=db_fetch_array($_MENUS2)) ?>
				<? } ?>
			</td>
			<? } ?>
			</tr>
			</table>
		</div>
	</div>
</div>

<div class="wrap">
<?php include __KIMS_CONTAINER_HEAD__?>	
</div>
