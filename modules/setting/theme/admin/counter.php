<?
	$SITES = getDbArray($table['s_site'],'','*','gid','asc',0,1);
	$year	= $year		? $year		: substr($date['today'],0,4);
	$month	= $month	? $month	: substr($date['today'],4,2);
	$day	= $day		? $day		: substr($date['today'],6,2);
	$accountQue = $account ? 'site='.$account.' and ':'';
?>

<div id="counter">

	<div style="padding:10px 0px 10px 0px;">
	<form name="procForm" action="<?=$g['s']?>/" method="get">
	<input type="hidden" name="r" value="<?=$r?>" />
	<input type="hidden" name="m" value="<?=$m?>" />
	<input type="hidden" name="mod" value="<?=$mod?>" />
	<input type="hidden" name="div" value="<?=$div?>" />
	<input type="hidden" name="account" value="<?=$_HS['uid']?>" />

		<select name="year" onchange="this.form.submit();">
		<?php for($i=$date['year'];$i>2009;$i--):?><option value="<?php echo $i?>"<?php if($year==$i):?> selected="selected"<?php endif?>><?php echo $i?>년</option><?php endfor?>
		</select>
		<select name="month" onchange="this.form.submit();">
		<?php for($i=1;$i<13;$i++):?><option value="<?php echo sprintf('%02d',$i)?>"<?php if($month==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d',$i)?>월</option><?php endfor?>
		<option value="-1"<?php if($month==-1):?> selected="selected"<?php endif?> class="mall">전체</option>
		</select>
		<input type="button" value="<?php echo substr($date['today'],0,4)?>년" class="btndef" onclick="this.form.year.value='<?php echo substr($date['today'],0,4)?>',this.form.month.value='-1',this.form.submit();" />
		<input type="button" value="<?php echo substr($date['today'],4,2)?>월" class="btndef" onclick="this.form.year.value='<?php echo substr($date['today'],0,4)?>',this.form.month.value='<?php echo substr($date['today'],4,2)?>',this.form.submit();" />
	</form>
	</div>

	<div class="list">
		<table class="tbl-list">
		<colgroup> 
		<col width="90"> 
		<col width="100"> 
		<col width="100"> 
		<col width="100"> 
		<col width="100"> 
		<col width="100"> 
		<col>
		</colgroup> 
		<tr>
			<td class="th">날짜/구분</td>
			<td class="th">순방문</td>
			<td class="th">페이지뷰</td>
			<td class="th">평균뷰</td>
			<td class="th">모바일접속</td>
			<td class="th">비율</td>
			<td class="th"></td>
		</tr>
		<?php if($month>0):?>
		<?php $numofmonth = date('t',mktime(0,0,0,$month,$i,$year))?>
		<?php for($i = 1; $i <= $numofmonth; $i++):?>
		<tr <?if(!($i%2)) echo 'class="od"';?>>
			<td><?php echo sprintf('%02d',$month)?> / <?php echo sprintf('%02d',$i)?> (<?php echo getWeekday(date('w',mktime(0,0,0,$month,$i,$year)))?>)</td>
			<?php $DayOf1=getDbData($table['s_counter'],$accountQue."date='".$year.sprintf('%02d',$month).sprintf('%02d',$i)."'",'*')?>
			<?php $DayOf2=getDbCnt($table['s_browser'],'sum(hit)',$accountQue."date='".$year.sprintf('%02d',$month).sprintf('%02d',$i)."' and browser='Mobile'")?>
			<?php $TOT1+=$DayOf1['hit']?>
			<?php $TOT2+=$DayOf1['page']?>
			<?php $TOT3+=$DayOf2?>

			<td class="rt"><b><?php echo $DayOf1['hit']?number_format($DayOf1['hit']):'&nbsp;'?></b></td>
			<td class="rt"><?php echo $DayOf1['page']?number_format($DayOf1['page']):'&nbsp;'?></td>
			<td class="rt"><?php echo $DayOf1['hit']?round($DayOf1['page']/$DayOf1['hit'],1):'&nbsp;'?></td>
			<td class="rt"><b><?php echo $DayOf2?$DayOf2:'&nbsp;'?></b></td>
			<td class="rt"><?php echo $DayOf2?round(($DayOf2/$DayOf1['hit'])*100,1).'%':'&nbsp;'?></td>
			<td class="rt"></td>
		</tr>
		<?php endfor?>
		<?php else:?>
		<?php for($i = 1; $i < 13; $i++):?>
		<tr <?if(!($i%2)) echo 'class="od"';?>>
			<td onclick="document.procForm.month.value='<?php echo sprintf('%02d',$i)?>';document.procForm.submit();"><?php echo $year?> / <?php echo sprintf('%02d',$i)?></td>
			<?php $DayOf1=getDbData($table['s_counter'],$accountQue."date like '".$year.sprintf('%02d',$i)."%'",'sum(hit),sum(page)')?>
			<?php $DayOf2=getDbCnt($table['s_browser'],'sum(hit)',$accountQue."date like '".$year.sprintf('%02d',$i)."%' and browser='Mobile'")?>
			<?php $TOT1+=$DayOf1[0]?>
			<?php $TOT2+=$DayOf1[1]?>
			<?php $TOT3+=$DayOf2?>

			<td class="rt"><b><?php echo $DayOf1[0]?number_format($DayOf1[0]):'&nbsp;'?></b></td>
			<td class="rt"><?php echo $DayOf1[1]?number_format($DayOf1[1]):'&nbsp;'?></td>
			<td class="rt"><?php echo $DayOf1[0]?round($DayOf1[1]/$DayOf1[0],1):'&nbsp;'?></td>
			<td class="rt"><b><?php echo $DayOf2?$DayOf2:'&nbsp;'?></b></td>
			<td class="rt"><?php echo $DayOf2?round(($DayOf2/$DayOf1[0])*100,1).'%':'&nbsp;'?></td>
			<td class="rt"></td>
		</tr>
		<?php endfor?>
		<?php endif?>

		<tr>
			<td><b>합 계</b></td>
			<td class="rt"><b><?php echo $TOT1?number_format($TOT1):'&nbsp;'?></b></td>
			<td class="rt"><?php echo $TOT2?number_format($TOT2):'&nbsp;'?></td>
			<td class="rt"><?php echo $TOT1?round($TOT2/$TOT1,1):'&nbsp;'?></td>
			<td class="rt"><b><?php echo $TOT3?$TOT3:'&nbsp;'?></b></td>
			<td class="rt"><?php echo $TOT3?round(($TOT3/$TOT1)*100,1).'%':'&nbsp;'?></td>
			<td class="rt"></td>
		</tr>
		</table>
	</div>
</div>