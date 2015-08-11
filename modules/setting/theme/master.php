<?
	$div = $div ? $div : 'setting';
	$master_name	= array(
		'setting'=>'기본설정', 'menu'=>'메뉴', 'bbs'=>'게시판', 'comment'=>'댓글', 'member'=>'회원가입설정',
		'theme'=>'테마설정', 'image'=>'이미지관리', 'topbanner'=>'상단배너',
		'editmain'=>'메인페이지', 'editfooter'=>'하단페이지', 'addpage'=>'별도페이지',
		'installmodule'=>'모듈설치',
	);
	$master_check	= array(
		'setting'=>'setting', 'menu'=>'setting', 'bbs'=>'setting', 'comment'=>'setting', 'member'=>'setting',
		'theme'=>'theme', 'image'=>'theme', 'topbanner'=>'theme',
		'editmain'=>'theme', 'editfooter'=>'theme', 'addpage'=>'theme',
		'installmodule'=>'installmodule',
	);
?>
<div id="menubar">
<div class="left"><b><?=$master_name[$div]?></b></div>
<ul class="lst-right">
	<li class="f<?if($master_check[$div]=='theme'){?> on<?}?>" onmouseover="menubar_over(this);" onmouseout="menubar_out(this);">
	<div class="sub-box">
		<dl>
		<dt><a href="<?=$g['s']?>/?r=<?=$r?>&m=setting&mod=master&div=image"><?=$master_name['image']?></a></dt>
		<dt><a href="<?=$g['s']?>/?r=<?=$r?>&m=setting&mod=master&div=topbanner"><?=$master_name['topbanner']?></a></dt>
		<dt><a href="<?=$g['s']?>/?r=<?=$r?>&m=setting&mod=master&div=editmain"><?=$master_name['editmain']?></a></dt>
		<dt><a href="<?=$g['s']?>/?r=<?=$r?>&m=setting&mod=master&div=editfooter"><?=$master_name['editfooter']?></a></dt>
		<dt><a href="<?=$g['s']?>/?r=<?=$r?>&m=setting&mod=master&div=addpage"><?=$master_name['addpage']?></a></dt>
		</dl>
	</div>
	<a href="<?=$g['s']?>/?r=<?=$r?>&m=setting&mod=master&div=theme"><?=$master_name['theme']?></a>
	</li>
	<li class="<?if($master_check[$div]=='setting'){?> on<?}?>" onmouseover="menubar_over(this);" onmouseout="menubar_out(this);">
	<div class="sub-box">
		<dl>
		<dt><a href="<?=$g['s']?>/?r=<?=$r?>&m=setting&mod=master&div=menu"><?=$master_name['menu']?></a></dt>
		<dt><a href="<?=$g['s']?>/?r=<?=$r?>&m=setting&mod=master&div=bbs"><?=$master_name['bbs']?></a></dt>
		<dt><a href="<?=$g['s']?>/?r=<?=$r?>&m=setting&mod=master&div=comment"><?=$master_name['comment']?></a></dt>
		<dt><a href="<?=$g['s']?>/?r=<?=$r?>&m=setting&mod=master&div=member"><?=$master_name['member']?></a></dt>
		</dl>
	</div>
	<a href="<?=$g['s']?>/?r=<?=$r?>&m=setting&mod=master&div=setting"><?=$master_name['setting']?></a>
	</li>
	<li class="<?if($master_check[$div]=='installmodule'){?> on<?}?>">
	<a href="<?=$g['s']?>/?r=<?=$r?>&m=setting&mod=master&div=installmodule"><?=$master_name['installmodule']?></a>
	</li>
</ul>	
<div class="clear"></div>
</div>

<?include_once $g['dir_module_mode'].'/'.$div.'.php';?>

<script type="text/javascript">
</script>
