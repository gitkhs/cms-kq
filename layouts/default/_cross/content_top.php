<div id="content_top">
<?
	for($i=2; $i>=0; $i--){
		if(is_file($g['path_module'].'setting/var/menu/var.menu'.$_CA[$i].'.php')){
			include $g['path_module'].'setting/var/menu/var.menu'.$_CA[$i].'.php';
			if(!$d['setmenu']['topslide'] && !$d['setmenu']['topfixed'])	continue;

			if($d['setmenu']['topslide']){
				if($_CA[$i] != $_HM['id'] && !$d['setmenu']['topslide_sub'])	continue;
				$_idx = 1;
				$wrap	= $d['setmenu']['topslide_wide'] ? '' : 'wrap';

				echo "<div id=\"slider_top\" class=\"slider-images {$wrap}\">";
				while(true){
					if(!is_file($g['path_image'].'top_slide'.$_CA[$i].'_'.$_idx.'.jpg')) break;

					echo "<div class=\"bg".($_idx==1 ? ' first' : '')."\"><img src=\"{$g['path_image']}top_slide{$_CA[$i]}_{$_idx}.jpg\"></div>";
					$_idx++;
				}
				echo "</div>";
				echo "<script type=\"text/javascript\">slider_top = new fadeImage({id:'slider_top'});</script>";
			}

			if($d['setmenu']['topfixed']){
				if($_CA[$i] != $_HM['id'] && !$d['setmenu']['topfixed_sub'])	continue;
				$wrap	= $d['setmenu']['topfixed_wide'] ? '' : 'wrap';

				if(is_file($g['path_image'].'top_fixed'.$_CA[$i].'.jpg')){
					echo "<div class=\"static {$wrap}\">";
					echo "<img src='{$g['s']}/images/top_fixed{$_CA[$i]}.jpg'>";
					echo "</div>";
				}
			}
		}
	}
?>
</div>
