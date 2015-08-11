<?php
// Copyright Kim Seongho 2011.02.18
define('__KIMS__',true);
error_reporting(E_ALL ^ E_NOTICE);

$path = str_replace('widgets/'.$_GET['widget'].'/'.basename($_SERVER['SCRIPT_FILENAME']),'',$_SERVER['SCRIPT_FILENAME']);

include_once $path.'_core/function/sys.func.php';
include_once $path.'_core/function/rss.func.php';

$weather_file = $path.'widgets/'.$_GET['widget'].'/data/'.$_GET['today'].'.txt';
$WT=explode('<split>',implode('',file($weather_file)));
$WTlen=count($WT)-1;
$WTCITY= getUrlData('http://www.google.com/ig/api?hl=ko&weather=,,,'.$_GET['x'].','.$_GET['y'],5);
$FDATA = explode('<forecast_conditions>',$WTCITY);
$WDATA = explode('<current_conditions>',$WTCITY);

$city_key = explode('data=' , str_replace('"','',getKRtoUTF($WDATA[1])));
$city_val1 = explode('/', $city_key[1]);
$city_val2 = explode('/', $city_key[2]);
$city_val3 = explode('/', $city_key[3]);
$city_val4 = explode('/', $city_key[4]);
$city_val5 = explode('/', $city_key[5]);
$city_val6 = explode('/', $city_key[6]);

$w['ment'] = $city_val1[0];
$w['temf'] = $city_val2[0];
$w['temc'] = $city_val3[0];
$w['humi'] = $city_val4[0];
$w['icon'] = 'http://www.google.com/ig/images/weather/'.$city_val5[4];//아이콘
$w['wind'] = $city_val6[0]; //바람

for ($i = 1; $i < 5; $i++)
{
	$fx[$i] = explode('data=',str_replace('"','',getKRtoUTF($FDATA[$i])));
	$fv[$i]['yoil'] = explode('/', $fx[$i][1]);
	$fv[$i]['row']  = explode('/', $fx[$i][2]);
	$fv[$i]['high'] = explode('/', $fx[$i][3]);
	$fv[$i]['icon'] = explode('/', $fx[$i][4]);
	$fv[$i]['ment'] = explode('/', $fx[$i][5]);
	$fv[$i]['yoil'] = $fv[$i]['yoil'][0];
	$fv[$i]['row']  = $fv[$i]['row'][0];
	$fv[$i]['high'] = $fv[$i]['high'][0];
	$fv[$i]['icon'] = 'http://www.google.com/ig/images/weather/'.$fv[$i]['icon'][4];
	$fv[$i]['ment'] = $fv[$i]['ment'][0];
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>날씨정보(<?php echo $_GET['city']?>)</title>
<style type="text/css">
body {
	margin:0;
	padding:5px;
	background:#f7f7f7;
	color:#202020;
	font-size:12px;
	font-family:dotum;
}
td {
	color:#202020;
	font-size:12px;
	font-family:dotum;
}
</style>
<script type="text/javascript">
//<![CDATA[
function cityChange(obj)
{
	var info = obj.value.split('|');
	location.href = './_view.php?widget=<?php echo $_GET['widget']?>&today=<?php echo $_GET['today']?>&city='+info[0] + '&x=' +info[1] +'&y=' +info[2];
}
function myRegionSet(obj,n)
{
	if (obj.checked == true)
	{
		setCookie('mycity',n,24*60*60);
	}
	else {
		setCookie('mycity','',24*60*60);
	}
}
function setCookie(name,value,expiredays) 
{ 
	var todayDate = new Date(); 
	todayDate.setDate( todayDate.getDate() + expiredays ); 
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";" 
}
function getCookie( name )
{
        var nameOfCookie = name + "=";
        var x = 0;
        while ( x <= document.cookie.length )
        {
                var y = (x+nameOfCookie.length);
                if ( document.cookie.substring( x, y ) == nameOfCookie ) {
                        if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 )
                                endOfCookie = document.cookie.length;
                        return unescape( document.cookie.substring( y, endOfCookie ) );
                }
                x = document.cookie.indexOf( " ", x ) + 1;
                if ( x == 0 )
                        break;
        }
        return "";
}
window.resizeTo(350,270);
//]]>
</script>
</head>

<body>

<table width="100%" cellspacing="0" cellpadding="0">
	<tr height="50" valign="top" align="center">
		<td width="10" nowrap="nowrap"></td>
		<td width="40" nowrap="nowrap" align="center" style="padding-top:10px;">
			<img src="<?php echo $w['icon']?>" width="40" height="40" />
		</td>
		<td width="5" nowrap="nowrap"></td>
		<td align="left" width="100%" style="padding-top:7px;">

			<table width="100%" cellspacing="0" cellpadding="0">
				<tr height="14">
					<td valign="top">
						<select style="font-size:11px;font-family:dotum;color:#0674A2;" onchange="cityChange(this)">
						<?php for($i = 0; $i < $WTlen; $i++):?>
						<?php $val=explode('|',$WT[$i])?>
						<option value="<?php echo $val[0]?>|<?php echo $val[7]?>|<?php echo $val[8]?>"<?php if($_GET['city']==$val[0]):$xgi=$i?> selected="selected"<?php endif?>><?php echo $val[0]?></option>
						<?php endfor?>
						</select>
						<input type="checkbox" onclick="myRegionSet(this,'<?php echo $xgi?>')"<?php if($_COOKIE['mycity']==$xgi):?> checked="checked"<?php endif?> /><span style="font-size:11px;font-family:dotum;color:#808080;">기본지역지정</span>
					</td>
				</tr>
				<tr height="15">
					<td><?php echo date('m/d')?> <b style="font-family:굴림;color:#3D98C4;">현재</b> <span style="font-size:11px;font-family:dotum;color:#FD5939;">(<?php echo $w['ment']?>)</span></td>
				</tr>
				<tr height="11">
					<td><span style="font-size:11px;font-family:dotum;color:#808080;"><?php echo $w['humi']?> <?php echo $w['wind']?></span></td>
				</tr>
			</table>

		</td>
		<td align="right" nowrap="nowrap">
			<b style="font-family:arial;font-size:50px;color:#000000;"><?php echo $w['temc']?></b><b style="font-family:arial;font-size:15px;color:#4D4D4D;">°C</b>
		</td>
		<td width="5" nowrap="nowrap"></td>
	</tr>
	<tr height="1" bgcolor="#dfdfdf"><td colspan="6"></td></tr>
</table>

<br />

<table width="100%" cellspacing="0" cellpadding="0">
	<tr align="center">

		<?php for ($i = 1; $i < 5; $i++):?>
		<td width="25%">
		
			<table height="100" cellspacing="0" cellpadding="0">
				<tr align="center">
					<td><span style="font-size:11px;font-family:dotum;color:#808080;"><?php echo $i > 1 ? date('m/d',mktime(0,0,0,date('m'),date('d')+($i-1),date('Y'))) : ''?> (<?php echo $fv[$i]['yoil']?>)</span></td>
				</tr>
				<tr align="center">
					<td><img src="<?php echo $fv[$i]['icon']?>" width="40" height="40" /></td>
				</tr>
				<tr align="center">
					<td><span style="font-size:11px;font-family:dotum;color:#808080;"><?php echo $fv[$i]['ment']?></span></td>
				</tr>
				<tr align="center">
					<td style="font-family:arial;"><?php echo $fv[$i]['row']?>/<b><?php echo $i==1?($fv[$i]['high']>$w['temc']?$fv[$i]['high']:$w['temc']):$fv[$i]['high']?></b>°C</td>
				</tr>
			</table>

		</td>
		<?php endfor?>

	</tr>
</table>


</body>
</html>