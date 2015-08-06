<?php
// Copyright Kim Seongho 2011.02.18
$weather_file = $g['path_widget'].$wdgvar['widget_id'].'/data/'.$date['today'].'.txt';
$weather_time = file_exists($weather_file) ? filemtime($weather_file) : 0;
if (!file_exists($weather_file) || !getNew(date('YmdHis',$weather_time),3)):
?>
<iframe src="<?php echo $g['s']?>/widgets/<?php echo $wdgvar['widget_id']?>/_put.php?widget=<?php echo $wdgvar['widget_id']?>&today=<?php echo $date['today']?>" width="0" height="0" frameborder="0" scrolling="no"></iframe>
<?php
else:
$wdata= implode('',file($weather_file));
$warr = explode('<split>',$wdata);
$wlen = count($warr);
$g['img_widget'] = $g['s'].'/widgets/'.$wdgvar['widget_id'].'/image';
?>
<span id="weatherdiv"></span>
<script type="text/javascript">
//<![CDATA[
var weather = new Array();
<?php for($i = 0; $i < $wlen; $i++):if(!$warr[$i])continue?>
weather[<?php echo $i?>] = "<?php echo $warr[$i]?>";
<?php endfor?>

function KimsqRbWeatherSlide(n)
{
	var mcity = parseInt(getCookie('mycity'));
	var i;
	var val;
	var div = getId('weatherdiv');
	var wl = weather.length;
	if (mcity)
	{	
		for (i = 0; i < wl; i++)
		{
			val = weather[i].split('|');
			if (mcity == i)
			{
				div.innerHTML = '<span title="'+val[1]+'\n'+val[4]+'\n'+val[6]+'" style="color:#666666;font-size:11px;font-family:dotum;cursor:pointer;" onclick="weatherOpen(\''+val[0]+'\',\''+val[7]+'\',\''+val[8]+'\')"><img src="<?php echo $g['img_widget']?>/'+val[5]+'.gif" style="position:relative;top:5px;left:-5px;" alt="" />' + val[0] + '<span style="color:#BA171A;font-family:arial;font-size:10px;padding-left:5px;">'+val[3]+'°C</span></span>';
				break;
			}
		}
	}
	else 
	{
		var x = n + 2 > wl ? 0 : n + 1;
		if (weather[x])
		{
			val = weather[x].split('|');
			div.innerHTML = '<span title="'+val[1]+'\n'+val[4]+'\n'+val[6]+'" style="color:#666666;font-size:11px;font-family:dotum;cursor:pointer;" onclick="weatherOpen(\''+val[0]+'\',\''+val[7]+'\',\''+val[8]+'\')"><img src="<?php echo $g['img_widget']?>/'+val[5]+'.gif" style="position:relative;top:5px;left:-5px;" alt="" />' + val[0] + '<span style="color:#BA171A;font-family:arial;font-size:10px;padding-left:5px;">'+val[3]+'°C</span></span>';
			setTimeout("KimsqRbWeatherSlide("+x+")",3000);
		}
	}
}
function weatherOpen(city,x,y)
{
	window.open('<?php echo $g['s']?>/widgets/<?php echo $wdgvar['widget_id']?>/_view.php?widget=<?php echo $wdgvar['widget_id']?>&today=<?php echo $date['today']?>&city='+city+'&x='+x+'&y='+y,'','width=350px,height=270px,scrollbars=no,resizable=no,status=yes');
}
KimsqRbWeatherSlide(-1);
//]]>
</script>
<?php endif?>