<?
	$div = $div ? $div : 'counter';
	$admin_name	= array(
		'counter'=>'접속통계', 'keyword'=>'유입키워드', 'member'=>'회원관리', 'popup'=>'팝업관리', 'upfile'=>'첨부파일',
	);
	$admin_check	= array(
		'counter'=>'counter', 'keyword'=>'keyword', 'member'=>'member', 'popup'=>'popup', 'upfile'=>'upfile',
	);
?>

<div id="menubar">
<ul class="lst-right">
	<li class="f<?if($admin_check[$div]=='counter'){?> on<?}?>" onmouseover="menubar_over(this);" onmouseout="menubar_out(this);">
	<a href="<?=$g['s']?>/?r=<?=$r?>&m=setting&mod=admin&div=counter"><?=$admin_name['counter']?></a>
	</li>
	<li class="<?if($admin_check[$div]=='keyword'){?>on<?}?>" onmouseover="menubar_over(this);" onmouseout="menubar_out(this);">
	<a href="<?=$g['s']?>/?r=<?=$r?>&m=setting&mod=admin&div=keyword"><?=$admin_name['keyword']?></a>
	</li>
	<li class="<?if($admin_check[$div]=='member'){?>on<?}?>" onmouseover="menubar_over(this);" onmouseout="menubar_out(this);">
	<a href="<?=$g['s']?>/?r=<?=$r?>&m=setting&mod=admin&div=member"><?=$admin_name['member']?></a>
	</li>
	<li class="<?if($admin_check[$div]=='popup'){?>on<?}?>" onmouseover="menubar_over(this);" onmouseout="menubar_out(this);">
	<a href="<?=$g['s']?>/?r=<?=$r?>&m=setting&mod=admin&div=popup"><?=$admin_name['popup']?></a>
	</li>
	<li class="<?if($admin_check[$div]=='upfile'){?>on<?}?>" onmouseover="menubar_over(this);" onmouseout="menubar_out(this);">
	<a href="<?=$g['s']?>/?r=<?=$r?>&m=setting&mod=admin&div=upfile"><?=$admin_name['upfile']?></a>
	</li>
</ul>
<div class="clear"></div>
</div>

<?include_once $g['dir_module_mode'].'/'.$div.'.php';?>

