<div id="menubox">
<ul>
<?php $_MENUS1=getDbSelect($table['s_menu'],'site='.$s.' and hidden=0 and depth=1 and mobile=1 order by gid asc','*')?>
<?php $_NUM=db_num_rows($_MENUS1)?>
<?php $_i=0; while($_M1=db_fetch_array($_MENUS1)):$_i++?>
<li class="m1<?php if($_M1['id']==$c):?> selected1<?php endif?><?php if($_NUM==$_i):?> noline<?php endif?>">
<a href="<?php echo $_M1['redirect']?$_M1['joint']:RW('c='.$_M1['id'])?>" target="<?php echo $_M1['target']?>">
<?php echo $_M1['name']?>
<?php if($_M1['num']):?><span class="num">(<?php echo $_M1['num']?>)</span><?php endif?>
<?php if(getNew($_M1['d_last'],$d['layout']['newhour'])):?><span class="new">new</span><?php endif?>
</a>
</li>
<?php if($_M1['isson']):?>
<?php $_MENUS2=getDbSelect($table['s_menu'],'site='.$s.' and parent='.$_M1['uid'].' and hidden=0 and depth=2 and mobile=1 order by gid asc','*')?>
<?php while($_M2=db_fetch_array($_MENUS2)):?>
<li class="m2<?php if($_M1['id'].'/'.$_M2['id']==$c):?> selected2<?php endif?>">
<a href="<?php echo RW('c='.$_M1['id'].'/'.$_M2['id'])?>" target="<?php echo $_M2['target']?>">
+ <?php echo $_M2['name']?>
<?php if($_M2['num']):?><span class="num">(<?php echo $_M2['num']?>)</span><?php endif?>
<?php if(getNew($_M2['d_last'],$d['layout']['newhour'])):?><span class="new">new</span><?php endif?>
</a>
</li>
<?php if($_M2['isson']):?>
<?php $_MENUS3=getDbSelect($table['s_menu'],'site='.$s.' and parent='.$_M2['uid'].' and hidden=0 and depth=3 and mobile=1 order by gid asc','*')?>
<?php while($_M3=db_fetch_array($_MENUS3)):?>
<li class="m3<?php if($_M1['id'].'/'.$_M2['id'].'/'.$_M3['id']==$c):?> selected3<?php endif?>">
<a href="<?php echo RW('c='.$_M1['id'].'/'.$_M2['id'].'/'.$_M3['id'])?>" target="<?php echo $_M3['target']?>">
ㆍ<?php echo $_M3['name']?><?php if($_M3['num']):?>
<?php if(getNew($_M3['d_last'],$d['layout']['newhour'])):?><span class="new">new</span><?php endif?>
<span class="num">(<?php echo $_M3['num']?>)</span><?php endif?>
</a>
</li>
<?php endwhile?>
<?php endif?>
<?php endwhile?>
<?php endif?>
<?php endwhile?>
<?php if(!$_i):?>
<li class="m1 nomenu"><a>등록된 메뉴가 없습니다.</a></li>
<?php endif?>
<?php if($my['admin']):?>
<li class="m1 admpage"><a href="<?php echo RW('m=admin')?>">관리자페이지</a></li>
<?php endif?>
</ul>
</div>
