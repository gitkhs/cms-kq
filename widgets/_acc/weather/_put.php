<?php
// Copyright Kim Seongho 2011.02.18
define('__KIMS__',true);
error_reporting(E_ALL ^ E_NOTICE);

$path = str_replace('widgets/'.$_GET['widget'].'/'.basename($_SERVER['SCRIPT_FILENAME']),'',$_SERVER['SCRIPT_FILENAME']);

include_once $path.'_core/function/sys.func.php';
include_once $path.'_core/function/rss.func.php';

$weather_file = './data/'.$_GET['today'].'.txt';

$WI = Array( 
	'haze.gif' => 101, 
	'sunny.gif' => 102, 
	'mostly_sunny.gif' => 103, 
	'cloudy.gif' => 104, 
	'mostly_cloudy.gif' => 105, 
	'rain.gif' => 106, 
	'fog.gif' => 107, 
	'chance_of_rain.gif' => 108, 
	'thunderstorm.gif' => 109, 
	'chance_of_storm.gif' => 110, 
	'chance_of_snow.gif' => 111, 
	'snow.gif' => 112, 
	'storm.gif' => 113
);

$WT= getUrlData('http://www.google.com/ig/cities?output=xml&hl=ko&country=kr',5);
$FDATA = explode('<city>',$WT);
$FLEN  = count($FDATA);

$fp = fopen($weather_file,'w');
for ($i = 0; $i < $FLEN; $i++)
{
	if ($i)
	{
		$fx[$i] = explode('data=',str_replace('"','',getKRtoUTF($FDATA[$i])));
		$fv[$i]['city'] = explode('/', $fx[$i][1]);
		$fv[$i]['x']  = explode('/', $fx[$i][2]);
		$fv[$i]['y'] = explode('/', $fx[$i][3]);
		$fv[$i]['city'] = $fv[$i]['city'][0];
		$fv[$i]['x']  = $fv[$i]['x'][0];
		$fv[$i]['y'] = $fv[$i]['y'][0];
	}
	else {
		$fv[$i]['city'] = '서울';
		$fv[$i]['x']  = '37500000';
		$fv[$i]['y'] = '126930000';
	}

	$WTCITY = getUrlData('http://www.google.com/ig/api?hl=ko&weather=,,,'.$fv[$i]['x'].','.$fv[$i]['y'],5);
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
	$w['icon'] = $WI[$city_val5[4]] ? $WI[$city_val5[4]] : 105;
	$w['wind'] = $city_val6[0];
	fwrite($fp , $fv[$i]['city'].'|'.$w['ment'].'|'.$w['temf'].'|'.$w['temc'].'|'.$w['humi'].'|'.$w['icon'].'|'.$w['wind'].'|'.$fv[$i]['x'].'|'.$fv[$i]['y'].'<split>');
}
fclose($fp);
?>