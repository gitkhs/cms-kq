<?php 
$SITES = getDbArray($table['s_site'],'','*','gid','asc',0,1);
$searchset1 = array('naver','nate','daum','yahoo','google','etc');
$searchset2 = array
(
	'네이버'=>'http://search.naver.com/search.naver?query=',
	'네이트'=>'http://search.nate.com/search/all.html?q=',
	'다음'=>'http://search.daum.net/search?q=',
	'야후'=>'http://kr.search.yahoo.com/search?p=',
	'구글'=>'http://www.google.com/search?q=',
	'기타'=>$g['s'].'/?r='.$r.'&amp;mod=search&amp;keyword='
);


$year1	= $year1  ? $year1  : substr($date['today'],0,4);
$month1	= $month1 ? $month1 : substr($date['today'],4,2);
$day1	= $day1   ? $day1   : 1;
$year2	= $year2  ? $year2  : substr($date['today'],0,4);
$month2	= $month2 ? $month2 : substr($date['today'],4,2);
$day2	= $day2   ? $day2   : substr($date['today'],6,2);

$p		= $p ? $p : 1;
$recnum	= $recnum && $recnum < 200 ? $recnum : 20;
$sort	= $sort		? $sort		: 'total';
$orderby= $orderby	? $orderby	: 'desc';
$accountQue = $account ? 'site='.$account.' and ':'';

$_WHERE1= $accountQue.'date >= '.$year1.sprintf('%02d',$month1).sprintf('%02d',$day1).' and date <= '.$year2.sprintf('%02d',$month2).sprintf('%02d',$day2);
if($where) $_WHERE1 .= ' and '.$where.'>0';
$_WHERE2= 'keyword,sum(naver) as naver,sum(nate) as nate,sum(daum) as daum,sum(yahoo) as yahoo,sum(google) as google,sum(etc) as etc,sum(total) as total';
$RCD	= getDbSelect($table['s_outkey'],$_WHERE1.' group by keyword order by '.$sort.' '.$orderby.' limit 0,'.$recnum,$_WHERE2);
?> 



<form name="procForm" action="<?php echo $g['s']?>/" method="get">
<input type="hidden" name="r" value="<?php echo $r?>" />
<input type="hidden" name="m" value="<?php echo $m?>" />
<input type="hidden" name="module" value="<?php echo $module?>" />
<input type="hidden" name="front" value="<?php echo $front?>" />

<div class="sbox">
	<select name="account" class="account" onchange="this.form.submit();">
	<option value="">&nbsp;+ 전체사이트</option>
	<option value="">---------------------------</option>
	<?php while($S = db_fetch_array($SITES)):?>
	<option value="<?php echo $S['uid']?>"<?php if($account==$S['uid']):?> selected="selected"<?php endif?>>ㆍ<?php echo $S['name']?></option>
	<?php endwhile?>
	<?php if(!db_num_rows($SITES)):?>
	<option value="">등록된 사이트가 없습니다.</option>
	<?php endif?>
	</select>
	
	<div>
	<select name="year1">
	<?php for($i=$date['year'];$i>2009;$i--):?><option value="<?php echo $i?>"<?php if($year1==$i):?> selected="selected"<?php endif?>><?php echo $i?>년</option><?php endfor?>
	</select>
	<select name="month1">
	<?php for($i=1;$i<13;$i++):?><option value="<?php echo sprintf('%02d',$i)?>"<?php if($month1==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d',$i)?>월</option><?php endfor?>
	</select>
	<select name="day1">
	<?php for($i=1;$i<32;$i++):?><option value="<?php echo sprintf('%02d',$i)?>"<?php if($day1==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d',$i)?>일(<?php echo getWeekday(date('w',mktime(0,0,0,$month1,$i,$year1)))?>)</option><?php endfor?>
	</select> ~
	<select name="year2">
	<?php for($i=$date['year'];$i>2009;$i--):?><option value="<?php echo $i?>"<?php if($year2==$i):?> selected="selected"<?php endif?>><?php echo $i?>년</option><?php endfor?>
	</select>
	<select name="month2">
	<?php for($i=1;$i<13;$i++):?><option value="<?php echo sprintf('%02d',$i)?>"<?php if($month2==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d',$i)?>월</option><?php endfor?>
	</select>
	<select name="day2">
	<?php for($i=1;$i<32;$i++):?><option value="<?php echo sprintf('%02d',$i)?>"<?php if($day2==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d',$i)?>일(<?php echo getWeekday(date('w',mktime(0,0,0,$month2,$i,$year2)))?>)</option><?php endfor?>
	</select>

	<input type="button" class="btngray" value="기간적용" onclick="this.form.submit();" />
	<input type="button" class="btngray" value="어제" onclick="dropDate('<?php echo date('Ymd',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-1,substr($date['today'],0,4)))?>','<?php echo date('Ymd',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-1,substr($date['today'],0,4)))?>');" />
	<input type="button" class="btngray" value="오늘" onclick="dropDate('<?php echo $date['today']?>','<?php echo $date['today']?>');" />
	<input type="button" class="btngray" value="일주" onclick="dropDate('<?php echo date('Ymd',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-7,substr($date['today'],0,4)))?>','<?php echo $date['today']?>');" />
	<input type="button" class="btngray" value="한달" onclick="dropDate('<?php echo date('Ymd',mktime(0,0,0,substr($date['today'],4,2)-1,substr($date['today'],6,2),substr($date['today'],0,4)))?>','<?php echo $date['today']?>');" />
	<input type="button" class="btngray" value="당월" onclick="dropDate('<?php echo substr($date['today'],0,6)?>01','<?php echo $date['today']?>');" />
	<input type="button" class="btngray" value="전월" onclick="dropDate('<?php echo date('Ym',mktime(0,0,0,substr($date['today'],4,2)-1,substr($date['today'],6,2),substr($date['today'],0,4)))?>01','<?php echo date('Ym',mktime(0,0,0,substr($date['today'],4,2)-1,substr($date['today'],6,2),substr($date['today'],0,4)))?>31');" />
	<input type="button" class="btngray" value="전체" onclick="dropDate('20090101','<?php echo $date['today']?>');" />
	</div>

	<div>
	<select name="where" onchange="this.form.submit();">
	<option value="">전체유입량</option>
	<option value="naver"<?php if($where=='naver'):?> selected="selected"<?php endif?>>네이버</option>
	<option value="nate"<?php if($where=='nate'):?> selected="selected"<?php endif?>>네이트</option>
	<option value="daum"<?php if($where=='daum'):?> selected="selected"<?php endif?>>다음</option>
	<option value="yahoo"<?php if($where=='yahoo'):?> selected="selected"<?php endif?>>야후</option>
	<option value="google"<?php if($where=='google'):?> selected="selected"<?php endif?>>구글</option>
	<option value="etc"<?php if($where=='etc'):?> selected="selected"<?php endif?>>기타</option>
	</select>
	<select name="recnum" onchange="this.form.submit();">
	<option value="10" class="all"<?php if($recnum==10):?> selected="selected"<?php endif?>>10개</option>
	<option value="20"<?php if($recnum==20):?> selected="selected"<?php endif?>>20개</option>
	<option value="35"<?php if($recnum==35):?> selected="selected"<?php endif?>>35개</option>
	<option value="50"<?php if($recnum==50):?> selected="selected"<?php endif?>>50개</option>
	<option value="75"<?php if($recnum==75):?> selected="selected"<?php endif?>>75개</option>
	<option value="100"<?php if($recnum==100):?> selected="selected"<?php endif?>>100개</option>
	</select>
	</div>
</div>
</form>



<table cellspacing="1">
	<colgroup> 
	<col width="50"> 
	<col width="200"> 
	<col width="73"> 
	<col width="73"> 
	<col width="73"> 
	<col width="73"> 
	<col width="73"> 
	<col width="73"> 
	<col width="95"> 
	<col>
	</colgroup>
	<thead>
	<tr class="sbjtd">
		<th width="50">순위</th>
		<th>유입키워드</th>
		<?php $i=0;foreach($searchset2 as $key=>$val):?>
		<th scope="col"><a href="<?php echo $val?>" target="_blank"><?php if($key=='기타'):?>기타<?php else:?><img src="<?php echo $g['img_module_admin']?>/ico_<?php echo $searchset1[$i]?>.gif" alt="<?php echo strtoupper($searchset1[$i])?>" /><?php endif?></a></th>
		<?php $i++;endforeach?>
		<th scope="col" class="b">합 계</th>
		<th scope="col"></th>
	</tr>
	</thead>
	<tbody>
<?php $j=0;while($G=db_fetch_array($RCD)):$j++?>

	<tr class="rooptd<?php echo (++$i%2)?>">
		<td class="number"><?php echo $j?></td>
		<td class="b"><?php echo $G['keyword']?></td>
		<?php $k=0;foreach($searchset2 as $key=>$val):?>
		<td><a href="<?php echo $val.urlencode($G['keyword'])?>" target="_blank"><?php echo $G[$searchset1[$k]]?$G[$searchset1[$k]]:''?></a></td>
		<?php $k++;endforeach?>
		<td class="etc"><?php echo number_format($G['total'])?></td>
		<td></td>
	</tr>

<?php endwhile?>
	</tbody>
</table>
<?php if(!$j):?>
	<div class="nodata"><img src="<?php echo $g['img_core']?>/_public/ico_notice.gif" alt="" /> 지정된 기간내에 유입된 키워드가 없습니다.</div>
<?php endif?>


<script type="text/javascript">
//<![CDATA[
function dropDate(date1,date2)
{
	var f = document.procForm;
	f.year1.value = date1.substring(0,4);
	f.month1.value = date1.substring(4,6);
	f.day1.value = date1.substring(6,8);
	
	f.year2.value = date2.substring(0,4);
	f.month2.value = date2.substring(4,6);
	f.day2.value = date2.substring(6,8);

	f.submit();
}
//]]>
</script>
