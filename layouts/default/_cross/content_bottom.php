<div id="content_bottom">
<?
	for($i=2; $i>=0; $i--){
		if(is_file($g['path_module'].'setting/var/menu/var.menu'.$_CA[$i].'.php')){
			include $g['path_module'].'setting/var/menu/var.menu'.$_CA[$i].'.php';
			if(!$d['setmenu']['btmfixed'])	continue;

			if($d['setmenu']['btmfixed']){
				if($_CA[$i] != $_HM['id'] && !$d['setmenu']['btmfixed_sub'])	continue;
				$wrap	= $d['setmenu']['btmfixed_wide'] ? '' : 'wrap';

				if(is_file($g['path_image'].'bottom_fixed'.$_CA[$i].'.jpg')){
					echo "<div class=\"static {$wrap}\">";
					echo "<img src='{$g['s']}/images/bottom_fixed{$_CA[$i]}.jpg'>";
					echo "</div>";
				}
			}
		}
	}
?>
</div>
