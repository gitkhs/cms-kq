<?php
if ($p > 200) getLink('','','200페이지까지만 조회가능합니다.','-1');

$SITES = getDbArray($table['s_site'],'','*','gid','asc',0,1);
$year1	= $year1  ? $year1  : substr($date['today'],0,4);
$month1	= $month1 ? $month1 : substr($date['today'],4,2);
$day1	= $day1   ? $day1   : substr($date['today'],6,2);
$year2	= $year2  ? $year2  : substr($date['today'],0,4);
$month2	= $month2 ? $month2 : substr($date['today'],4,2);
$day2	= $day2   ? $day2   : substr($date['today'],6,2);

$recnum	= $recnum && $recnum < 200 ? $recnum : 20;
$sort	= $sort		? $sort		: 'uid';
$orderby= $orderby	? $orderby	: 'desc';

$accountQue = $account ? 'site='.$account.' and ':'';

$_WHERE = $accountQue.'d_regis > '.$year1.sprintf('%02d',$month1).sprintf('%02d',$day1).'000000 and d_regis < '.$year2.sprintf('%02d',$month2).sprintf('%02d',$day2).'240000';
if ($where && $keyw) $_WHERE .= " and ".$where." like '%".trim($keyw)."%'";

$RCD = getDbArray($table['s_referer'],$_WHERE,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table['s_referer'],$_WHERE);
$TPG = getTotalPage($NUM,$recnum);
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
	<select name="sort" onchange="this.form.submit();">
	<option value="uid"<?php if($sort=='uid'):?> selected="selected"<?php endif?>>접속순</option>
	</select>
	<select name="recnum" onchange="this.form.submit();">
	<option value="20"<?php if($recnum==20):?> selected="selected"<?php endif?>>20개</option>
	<option value="35"<?php if($recnum==35):?> selected="selected"<?php endif?>>35개</option>
	<option value="50"<?php if($recnum==50):?> selected="selected"<?php endif?>>50개</option>
	<option value="75"<?php if($recnum==75):?> selected="selected"<?php endif?>>75개</option>
	<option value="90"<?php if($recnum==90):?> selected="selected"<?php endif?>>90개</option>
	</select>
	<select name="where">
	<option value="ip"<?php if($where=='ip'):?> selected="selected"<?php endif?>>IP</option>
	<option value="id"<?php if($where=='id'):?> selected="selected"<?php endif?>>회원UID</option>
	<option value="referer"<?php if($where=='referer'):?> selected="selected"<?php endif?>>접속경로</option>
	</select>

	<input type="text" name="keyw" value="<?php echo stripslashes($keyw)?>" class="input" />

	<input type="submit" value="검색" class="btnblue" />
	<input type="button" value="리셋" class="btngray" onclick="location.href='<?php echo $g['adm_href']?>';" />
	</div>
</div>


</form>


<form name="listForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>">
<input type="hidden" name="r" value="<?php echo $r?>" />
<input type="hidden" name="m" value="<?php echo $module?>" />
<input type="hidden" name="a" value="" />

<table cellspacing="1">
	<colgroup> 
	<col width="30"> 
	<col width="50"> 
	<col width="100"> 
	<col width="80"> 
	<col width="190"> 
	<col width="80"> 
	<col width="120">
	<col width="120">
	<col>
	</colgroup>
	<thead>
	<tr>
		<th scope="col"><img src="<?php echo $g['img_core']?>/_public/ico_check_01.gif" alt="선택/반전" class="hand" onclick="chkFlag('members[]');" /></th>
		<th scope="col">번호</th>
		<th scope="col">IP</th>
		<th scope="col">회원여부</th>
		<th scope="col">접속경로</th>
		<th scope="col">브라우져</th>
		<th scope="col">키워드</th>
		<th scope="col">접속시간</th>
		<th scope="col"></th>
	</tr>
	</thead>
	<tbody>
<?php $j=0;while($R=db_fetch_array($RCD)):$j++?>
<?php $_engine = getSearchEngine($R['referer'])?>
<?php $_outkey = getKeyword($R['referer'])?>
<?php $_browse = getBrowzer($R['agent'])?>
<?php $_domain = getDomain($R['referer'])?>
<?php $_mobile = isMobileConnect($R['agent'])?>

	<tr class="rooptd<?php echo (++$i%2)?>">
		<td class="check"><input type="checkbox" name="members[]" value="<?php echo $R['uid']?>" /></td>
		<td class="number"><?php echo ($NUM-((($p-1)*$recnum)+$_recnum++))?></td>
		<td class="name"><a href="#." onclick="whoisSearch('<?php echo $R['ip']?>');" title="후이즈 IP정보"><?php echo $R['ip']?></a></td>
		<td>
			<?php if($R['mbruid']):?>
			<?php $M=getDbData($table['s_mbrdata'],'memberuid='.$R['mbruid'],'*')?>
			<a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=member&front=manager&page=log&mbruid=<?php echo $M['memberuid']?>');" title="접속기록"><?php echo $M[$_HS['nametype']]?></a>
			<?php endif?>
		</td>
		<td><a href="<?php echo $R['referer']?>" target="_blank"><?php if($_engine=='etc'):?><?php echo $_domain?><?php else:?><img src="<?php echo $g['img_module_admin']?>/ico_<?php echo $_engine?>.gif" title="<?php echo $_domain?>" /><?php endif?></a></td>
		<td class="agent">
		<?php if($_mobile):?>
		<img src="<?php echo $g['img_core']?>/_public/ico_mobile.gif" class="imgpos" alt="모바일" title="모바일(<?php echo $_mobile?>)접속" />
		<?php endif?>		
		<?php echo strtoupper($_browse)?>
		</td>
		<td><a href="<?php echo $R['referer']?>" target="_blank" class="keyword"><?php echo $_outkey?></a></td>
		<td><?php echo getDateFormat($R['d_regis'],'Y.m.d H:i:s')?></td>
		<td></td>
	</tr>

<?php endwhile?>
	</tbody>
</table>
<?php if(!$j):?>
	<div class="nodata"><img src="<?php echo $g['img_core']?>/_public/ico_notice.gif" alt="" /> 지정된 기간내에 유입된 접속기록이 없습니다.</div>
<?php endif?>

<div class="pagebox01">
	<script type="text/javascript">getPageLink(10,<?php echo $p?>,<?php echo $TPG?>,'<?php echo $g['img_core']?>/page/default');</script>
</div>


<div class="prebox">
	<input type="button" class="btngray" value="선택/해제" onclick="chkFlag('members[]');" />
	<input type="button" class="btnblue" value="삭제" onclick="actQue('referer_delete');" />
</div>

</form>

<form name="whois_search_form">
<input type="hidden" name="domain_name" value="" />
</form>

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
function actQue(flag)
{
	var f = document.listForm;
    var l = document.getElementsByName('members[]');
    var n = l.length;
    var i;
	var j=0;
	var s='';

	for	(i = 0; i < n; i++)
	{
		if (l[i].checked == true)
		{
			j++;
			s += l[i].value +',';
		}
	}
	if (!j)
	{
		alert('내역을 선택해 주세요.     ');
		return false;
	}
	
	
	if (flag == 'referer_delete')
	{
		if (!confirm('정말로 삭제하시겠습니까?     '))
		{
			return false;
		}
	}
	f.a.value = flag;
	f.submit();
}
function whoisSearch(ip)
{
	var f = document.whois_search_form;

		f.domain_name.value = ip;
		f.target	= "_blank";
		f.method	= "post";
		f.action	= "http://whois.kisa.or.kr/result.php";
		f.submit();
}
//]]>
</script>
