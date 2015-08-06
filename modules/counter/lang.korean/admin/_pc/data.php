<?php 
$SITES = getDbArray($table['s_site'],'','*','gid','asc',0,1);
$year	= $year		? $year		: substr($date['today'],0,4);
$month	= $month	? $month	: substr($date['today'],4,2);
$day	= $day		? $day		: substr($date['today'],6,2);
$accountQue = $account ? 'site='.$account.' and ':'';
$numarr = array(
'visit' => '방문자',
'login' => '로그인',
'mbrjoin' => '회원가입',
'mbrout' => '탈퇴',
'comment' => '댓글',
'oneline' => '한줄의견',
'upload' => '파일첨부',
'download' => '다운로드',
'rcvtrack' => '받은트랙백',
'sndtrack' => '보낸트랙백'
)

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
	<col width="60"> 
	<col width="55"> 
	<col width="55"> 
	<col width="55"> 
	<col width="55"> 
	<col width="55"> 
	<col width="55"> 
	<col width="55"> 
	<col width="70"> 
	<col width="70"> 
	<col>
	</colgroup> 
	<thead>
	<tr class="sbjtr">
		<th>날짜/구분</th>
		<?php foreach($numarr as $key => $val):?>
		<th scope="col"><?php echo $val?></th>
		<?php endforeach?>
		<th scope="col"></th>
	</tr>
	</thead>
	
	<tbody>
	<?php $_S=array()?>
	<?php if($month>0):?>
	<?php $numofmonth = date('t',mktime(0,0,0,$month,$i,$year))?>
	<?php for($i = 1; $i <= $numofmonth; $i++):?>
	<tr class="looptr">
		<td class="datetd"><?php echo sprintf('%02d',$month)?>/<?php echo sprintf('%02d',$i)?> (<?php echo getWeekday(date('w',mktime(0,0,0,$month,$i,$year)))?>)</td>
		<?php $_D=getDbData($table['s_numinfo'],$accountQue."date='".$year.sprintf('%02d',$month).sprintf('%02d',$i)."'",'*')?>
		<?php foreach($numarr as $key => $val):$_S[$key]+=$_D[$key]?>
		<td class="sumtd1"><?php echo $_D[$key]?number_format($_D[$key]):'&nbsp;'?></td>
		<?php endforeach?>
		<td></td>
	</tr>
	<?php endfor?>
	<?php else:?>
	<?php foreach($numarr as $key => $val):?>
	<?php $_sumque.='sum('.$key.'),'?>
	<?php endforeach?>
	<?php $_sumque=substr($_sumque,0,strlen($_sumque)-1)?>
	<?php for($i = 1; $i < 13; $i++):?>
	<tr class="looptr">
		<td class="datetd hand" onclick="document.procForm.month.value='<?php echo sprintf('%02d',$i)?>';document.procForm.submit();"><?php echo $year?> / <?php echo sprintf('%02d',$i)?></td>
		<?php $_D=getDbData($table['s_numinfo'],$accountQue."date like '".$year.sprintf('%02d',$i)."%'",$_sumque)?>
		<?php $j=0;foreach($numarr as $key => $val):$_S[$key]+=$_D[$j]?>
		<td class="sumtd1"><?php echo $_D[$j]?number_format($_D[$j]):'&nbsp;'?></td>
		<?php $j++;endforeach?>
		<td></td>
	</tr>
	<?php endfor?>
	<?php endif?>

	<tr class="sumtr">
		<td class="datetd"><b>합 계</b></td>
		<?php foreach($numarr as $key => $val):?>
		<td class="sumtd1"><?php echo $_S[$key]?number_format($_S[$key]):'&nbsp;'?></td>
		<?php endforeach?>
		<td></td>
	</tr>
	</tbody>
</table>

