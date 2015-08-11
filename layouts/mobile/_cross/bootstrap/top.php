<!-- 부트스트랩 스타일 -->
<link href="<?=$g['path_core']?>css/bootstrap/bootstrap.<?=$d['config']['theme_bootstrap']?>.min.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<link type="text/css" rel="stylesheet" charset="utf-8" href="<?php echo $g['url_layout']?>/_cross/<?=$d['config']['site_theme_mobile']?>/theme.<?=$d['config']['theme_bootstrap']?>.css<?php echo $g['wcache']?>" />
<link type="text/css" rel="stylesheet" charset="utf-8" href="<?php echo $g['url_layout']?>/_cross/<?=$d['config']['site_theme_mobile']?>/theme_cus.css<?php echo $g['wcache']?>" />

<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">

		<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
		
			<a class="navbar-brand" href="<?=$g['s'].'/?r='.$r?>"><?=$_HS['name']?></a>
		</div>

		<div id="navbar" class="navbar-collapse collapse">
		<ul class="nav navbar-nav">
			<?php $_MENUS1=getDbSelect($table['s_menu'],'site='.$s.' and hidden=0 and depth=1 and mobile=1 order by gid asc','*')?>
			<?php $_NUM=db_num_rows($_MENUS1)?>
			<?php $_i=0; while($_M1=db_fetch_array($_MENUS1)):$_i++?>
			
			<?php if($_M1['isson']):?>
			<?php $_MENUS2=getDbSelect($table['s_menu'],'site='.$s.' and parent='.$_M1['uid'].' and hidden=0 and depth=2 and mobile=1 order by gid asc','*')?>
            <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_M1['name']?> <span class="caret"></span></a>
<ul class="dropdown-menu" role="menu">
<?php while($_M2=db_fetch_array($_MENUS2)):?>
<li class="<?php if(in_array($_M2['id'],$_CA)):?>active<?endif?>"><a href="<?php echo RW('c='.$_M1['id'].'/'.$_M2['id'])?>"><?php echo $_M2['name']?></a></li>
<?php endwhile	// _MENUS2?>
</ul>
			</li>
			<?php else: ?>
			<li class="<?if(in_array($_M1['id'],$_CA)):?>active<?endif?>"><a href="<?php echo $_M1['redirect']?$_M1['joint']:RW('c='.$_M1['id'])?>"><?php echo $_M1['name']?></a></li>
			<?php endif?>

			<?php endwhile?>
		</ul>

		<ul class="nav navbar-nav navbar-right">
			<? if($my['uid']) { ?>
			<li><a href="#" onclick="pageLogout();">Logout</a></li>
			<? } else { ?>
			<li><a href="<?=$g['s']?>/?mod=login">Login</a></li>
			<? } ?>
		</ul>
		</div><!--/.nav-collapse -->
	</div>
</nav>


<? include_once $g['path_core'].'com/social/facebook.php'?>
<script type="text/javascript">
	function pageLogout() {
		<? if($_SESSION['sns_login'] == 'f') { ?>
			FB.logout(function(response) { goHref('<?=$g['s']?>/?r=<?=$r?>&a=logout'); });
		<? } else { ?>
			goHref('<?=$g['s']?>/?r=<?=$r?>&a=logout');
		<? } ?>
	}
</script>
