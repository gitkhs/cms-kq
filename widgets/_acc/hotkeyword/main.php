<?php 
include_once $g['path_core'].'function/search.func.php';

$wdgvar['t1'] = 7;
$wdgvar['t2'] = 0;
$wdgvar['limit'] = 10;

$d_regis1 = date('Ymd',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-$wdgvar['t1'],substr($date['today'],0,4)));
$d_regis2 = date('Ymd',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-$wdgvar['t2'],substr($date['today'],0,4)));

$WHEREIS1 = 'where date between '.$d_regis1.' and '.$d_regis2.' and site='.$s;
$MBRQUE1  = db_query('SELECT *,sum(hit) as total FROM '.$table['s_inkey'].' '.$WHEREIS1.' group by keyword order by total desc LIMIT 0,'.$wdgvar['limit'],$DB_CONNECT);
$WHEREIS2 = "where date='".$date['today']."' and site=".$s;
$MBRQUE2  = db_query('SELECT *,sum(hit) as total FROM '.$table['s_inkey'].' '.$WHEREIS2.' group by keyword order by total desc LIMIT 0,'.$wdgvar['limit'],$DB_CONNECT);

$tabsid = 'tab'.filterstr(microtime());
$g['img_widget'] = $g['s'].'/widgets/'.$wdgvar['widget_id'].'/image';
?>

<div class="widget_search01">

	<ul class="tab">
	<li id="<?php echo $tabsid?>0" class="split on" onclick="searchTab(0,'<?php echo $tabsid?>');">주간 검색어 <img src="<?php echo $g['img_widget']?>/arr_01.gif" id="<?php echo $tabsid?>i0" alt="" /></li>
	<li id="<?php echo $tabsid?>1" onclick="searchTab(1,'<?php echo $tabsid?>');">현재 검색어 <img src="<?php echo $g['img_widget']?>/arr_01.gif" id="<?php echo $tabsid?>i1" alt="" class="hidden" /></li>
	</ul>

	<div id="<?php echo $tabsid?>_0">
		<ol class="table">
			<?php $n=$j=0?>
			<?php while($VK=db_fetch_array($MBRQUE1)):?>
			<?php if(!$VK['uid'])continue?>
			<?php $LN=getAgoGrade(getGradeArr($wdgvar['t1'],$wdgvar['t2']),$VK['keyword'],$wdgvar['t1']*2,$wdgvar['t1'])?>
			<?php $n++;$j++?>
			<li>
				<img src="<?php echo $g['img_widget']?>/num1/<?php echo $n?>.gif" alt="" />
				<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;mod=search&amp;keyword=<?php echo urlencode($VK['keyword'])?>"><?php echo getStrCut($VK['keyword'],$keyvar['cut'],'')?></a>
				<span><img src="<?php echo $g['img_widget']?>/ico_<?php echo getSicon($LN,$j+1)?>.gif" alt="" /> <?php echo getNumChange($LN,$j+1)?></span>
			</li>
			<?php endwhile?>
			<?php for($j=$n;$j<$wdgvar['limit'];$j++):?>
			<li></li>
			<?php endfor?>
		</ol>
		<div class="term">
			기간 : 
			<script type="text/javascript">getDateFormat('<?php echo $d_regis1?>','xxxx.xx.xx')</script> ~ 
			<script type="text/javascript">getDateFormat('<?php echo $d_regis2?>','xxxx.xx.xx')</script>
		</div>
	</div>

	<div id="<?php echo $tabsid?>_1" class="hide">
		<ol class="table">
			<?php $n=$j=0?>
			<?php while($VK=db_fetch_array($MBRQUE2)):?>
			<?php $LN=getAgoGrade(getGradeArr(1,1),$VK['keyword'],1,1)?>
			<?php $n++;$j++?>
			<li>
				<img src="<?php echo $g['img_widget']?>/num1/<?php echo $j?>.gif" alt="" />
				<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;mod=search&amp;keyword=<?php echo urlencode($VK['keyword'])?>"><?php echo getStrCut($VK['keyword'],$keyvar['cut'],'')?></a>
				<span><img src="<?php echo $g['img_widget']?>/ico_<?php echo getSicon($LN,$j+1)?>.gif" alt="" /> <?php echo getNumChange($LN,$j+1)?></span>
			</li>
			<?php endwhile?>
			<?php for($j=$n;$j<$wdgvar['limit'];$j++):?>
			<li></li>
			<?php endfor?>
		</ol>
		<div class="term">
			기간 : <script type="text/javascript">getDateFormat('<?php echo $date[totime]?>','xxxx.xx.xx xx:xx')</script> 현재기준
		</div>
	</div>

</div>
