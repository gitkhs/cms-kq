<?php
function getSwitchList($pos)
{
	$incs = array();
	$dirh = opendir($GLOBALS['g']['path_switch'].$pos);
	while(false !== ($folder = readdir($dirh))) 
	{ 
		$_fins = substr($folder,0,1);
		if(strpos('_.',$_fins) || @in_array($folder,$GLOBALS['d']['switch'][$pos])) continue;
		$incs[] = $folder;
	} 
	closedir($dirh);
	return $incs;
}
$_switchset = array(
	'start'=>'스타트 스위치',
	'top'=>'탑 스위치',
	'head'=>'헤더 스위치',
	'foot'=>'풋터 스위치',
	'end'=>'엔드 스위치'
);
?>

<div id="category">

	<div class="title">
		스위치 목록
	</div>
	
	<div class="tree">

		<?php foreach($_switchset as $_key => $_val):?>
		<?php foreach(getSwitchList($_key) as $_addswitch) $d['switch'][$_key][] = $_addswitch?>
		<div class="tbox">
		<table>
		<tr class="tt">
		<td colspan="2">
		<img src="<?php echo $g['img_core']?>/_public/ico_folder_01.gif" alt="" />
		<?php echo $_val?>
		</td>
		<td class="t2">

		</td>
		</tr>
		</table>
		<ul id="_switch_<?php echo $_key?>">
		<?php foreach($d['switch'][$_key] as $_switch):?>
		<?php if(!$_switch) continue?>
		<li>
		<table>
		<tr>
		<td class="t0"><img src="<?php echo $g['img_core']?>/_public/ico_f3.png" alt="" /></td>
		<td class="t1">
		<?php echo getFolderName($g['path_switch'].$_key.'/'.$_switch)?> <span>(<?php echo str_replace('@','',$_switch)?>)</span>
		</td>
		<td class="t2">
		<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=switch_change&amp;switch_folder=<?php echo $_key?>&amp;switch=<?php echo $_switch?>" onclick="return hrefCheck(this,true,'정말로 스위치를 <?php echo strpos($_switch,'@')?'켜':'끄'?>시겠습니까?');" title="스위치 ON/FF"><img src="<?php echo $g['img_core']?>/_public/ico_<?php echo strpos($_switch,'@')?'hide':'show'?>.gif" alt="" /></a>
		</td>
		</tr>
		</table>
		</li>
		<?php endforeach?>
		</ul>
		</div>
		<?php endforeach?>
	
	</div>

</div>

