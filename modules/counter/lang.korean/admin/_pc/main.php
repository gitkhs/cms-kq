<?php 
$SITES = getDbArray($table['s_site'],'','*','gid','asc',0,1);
$year	= $year		? $year		: substr($date['today'],0,4);
$month	= $month	? $month	: substr($date['today'],4,2);
$day	= $day		? $day		: substr($date['today'],6,2);
$accountQue = $account ? 'site='.$account.' and ':'';
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
	- 
	<select name="year" onchange="this.form.submit();">
	<?php for($i=$date['year'];$i>2009;$i--):?><option value="<?php echo $i?>"<?php if($year==$i):?> selected="selected"<?php endif?>><?php echo $i?>년</option><?php endfor?>
	</select>
	<select name="month" onchange="this.form.submit();">
	<?php for($i=1;$i<13;$i++):?><option value="<?php echo sprintf('%02d',$i)?>"<?php if($month==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d',$i)?>월</option><?php endfor?>
	<option value="-1"<?php if($month==-1):?> selected="selected"<?php endif?> class="mall">전체</option>
	</select>

	<input type="button" value="<?php echo substr($date['today'],0,4)?>년" class="btngray" onclick="this.form.year.value='<?php echo substr($date['today'],0,4)?>',this.form.month.value='-1',this.form.submit();" />
	<input type="button" value="<?php echo substr($date['today'],4,2)?>월" class="btngray" onclick="this.form.year.value='<?php echo substr($date['today'],0,4)?>',this.form.month.value='<?php echo substr($date['today'],4,2)?>',this.form.submit();" />

</div>

</form>


<table cellspacing="1">
	<colgroup> 
	<col width="65"> 
	<col width="100"> 
	<col width="100"> 
	<col width="100"> 
	<col width="100"> 
	<col width="100"> 
	<col>
	</colgroup> 
	<thead>
	<tr class="sbjtr">
		<th scope="col">날짜/구분</th>
		<th scope="col">순방문</th>
		<th scope="col">페이지뷰</th>
		<th scope="col">평균뷰</th>
		<th scope="col">모바일접속</th>
		<th scope="col">비율</th>
		<th scope="col"></th>
	</tr>
	</thead>
	
	<tbody>
	<?php if($month>0):?>
	<?php $numofmonth = date('t',mktime(0,0,0,$month,$i,$year))?>
	<?php for($i = 1; $i <= $numofmonth; $i++):?>
	<tr class="looptr">
		<td class="datetd"><?php echo sprintf('%02d',$month)?>/<?php echo sprintf('%02d',$i)?> (<?php echo getWeekday(date('w',mktime(0,0,0,$month,$i,$year)))?>)</td>
		<?php $DayOf1=getDbData($table['s_counter'],$accountQue."date='".$year.sprintf('%02d',$month).sprintf('%02d',$i)."'",'*')?>
		<?php $DayOf2=getDbCnt($table['s_browser'],'sum(hit)',$accountQue."date='".$year.sprintf('%02d',$month).sprintf('%02d',$i)."' and browser='Mobile'")?>
		<?php $TOT1+=$DayOf1['hit']?>
		<?php $TOT2+=$DayOf1['page']?>
		<?php $TOT3+=$DayOf2?>

		<td class="sumtd1"><?php echo $DayOf1['hit']?number_format($DayOf1['hit']):'&nbsp;'?></td>
		<td class="sumtd1"><?php echo $DayOf1['page']?number_format($DayOf1['page']):'&nbsp;'?></td>
		<td class="sumtd1"><?php echo $DayOf1['hit']?round($DayOf1['page']/$DayOf1['hit'],1):'&nbsp;'?></td>
		<td class="sumtd2"><?php echo $DayOf2?$DayOf2:'&nbsp;'?></td>
		<td class="sumtd2"><?php echo $DayOf2?round(($DayOf2/$DayOf1['hit'])*100,1).'%':'&nbsp;'?></td>
		<td></td>
	</tr>
	<?php endfor?>
	<?php else:?>
	<?php for($i = 1; $i < 13; $i++):?>
	<tr class="looptr">
		<td class="datetd hand" onclick="document.procForm.month.value='<?php echo sprintf('%02d',$i)?>';document.procForm.submit();"><?php echo $year?> / <?php echo sprintf('%02d',$i)?></td>
		<?php $DayOf1=getDbData($table['s_counter'],$accountQue."date like '".$year.sprintf('%02d',$i)."%'",'sum(hit),sum(page)')?>
		<?php $DayOf2=getDbCnt($table['s_browser'],'sum(hit)',$accountQue."date like '".$year.sprintf('%02d',$i)."%' and browser='Mobile'")?>
		<?php $TOT1+=$DayOf1[0]?>
		<?php $TOT2+=$DayOf1[1]?>
		<?php $TOT3+=$DayOf2?>

		<td class="sumtd1"><?php echo $DayOf1[0]?number_format($DayOf1[0]):'&nbsp;'?></td>
		<td class="sumtd1"><?php echo $DayOf1[1]?number_format($DayOf1[1]):'&nbsp;'?></td>
		<td class="sumtd1"><?php echo $DayOf1[0]?round($DayOf1[1]/$DayOf1[0],1):'&nbsp;'?></td>
		<td class="sumtd2"><?php echo $DayOf2?$DayOf2:'&nbsp;'?></td>
		<td class="sumtd2"><?php echo $DayOf2?round(($DayOf2/$DayOf1[0])*100,1).'%':'&nbsp;'?></td>
		<td></td>
	</tr>
	<?php endfor?>
	<?php endif?>

	<tr class="sumtr">
		<td class="datetd"><b>합 계</b></td>
		<td class="sumtd1"><?php echo $TOT1?number_format($TOT1):'&nbsp;'?></td>
		<td class="sumtd1"><?php echo $TOT2?number_format($TOT2):'&nbsp;'?></td>
		<td class="sumtd1"><?php echo $TOT1?round($TOT2/$TOT1,1):'&nbsp;'?></td>
		<td class="sumtd2"><?php echo $TOT3?$TOT3:'&nbsp;'?></td>
		<td class="sumtd2"><?php echo $TOT3?round(($TOT3/$TOT1)*100,1).'%':'&nbsp;'?></td>
		<td></td>
	</tr>
	</tbody>
</table>

