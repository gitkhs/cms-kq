<?php
$SITES = getDbArray($table['s_site'],'','*','gid','asc',0,1);
$year1	= $year1  ? $year1  : substr($date['today'],0,4);
$month1	= $month1 ? $month1 : substr($date['today'],4,2);
$day1	= $day1   ? $day1   : 1;//substr($date['today'],6,2);
$year2	= $year2  ? $year2  : substr($date['today'],0,4);
$month2	= $month2 ? $month2 : substr($date['today'],4,2);
$day2	= $day2   ? $day2   : substr($date['today'],6,2);


$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 20;

$accountQue = $account ? 'site='.$account.' and ':'';
$_WHERE = $accountQue.'d_regis > '.$year1.sprintf('%02d',$month1).sprintf('%02d',$day1).'000000 and d_regis < '.$year2.sprintf('%02d',$month2).sprintf('%02d',$day2).'240000';
if ($cync) $_WHERE .= " and cync=''";
if ($where && $keyw)
{
	if (strstr('[mbruid]',$where)) $_WHERE .= " and ".$where."='".$keyw."'";
	else $_WHERE .= getSearchSql($where,$keyw,$ikeyword,'or');	
}
$RCD = getDbArray($table['s_upload'],$_WHERE,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table['s_upload'],$_WHERE);
$TPG = getTotalPage($NUM,$recnum);
?>

<div id="uplist">



	<div class="sbox">
		<form name="procForm" action="<?php echo $g['s']?>/" method="get">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="module" value="<?php echo $module?>" />
		<input type="hidden" name="front" value="<?php echo $front?>" />

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
		<?php for($i=$date['year'];$i>2000;$i--):?><option value="<?php echo $i?>"<?php if($year1==$i):?> selected="selected"<?php endif?>><?php echo $i?>년</option><?php endfor?>
		</select>
		<select name="month1">
		<?php for($i=1;$i<13;$i++):?><option value="<?php echo sprintf('%02d',$i)?>"<?php if($month1==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d',$i)?>월</option><?php endfor?>
		</select>
		<select name="day1">
		<?php for($i=1;$i<32;$i++):?><option value="<?php echo sprintf('%02d',$i)?>"<?php if($day1==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d',$i)?>일(<?php echo getWeekday(date('w',mktime(0,0,0,$month1,$i,$year1)))?>)</option><?php endfor?>
		</select> ~
		<select name="year2">
		<?php for($i=$date['year'];$i>2000;$i--):?><option value="<?php echo $i?>"<?php if($year2==$i):?> selected="selected"<?php endif?>><?php echo $i?>년</option><?php endfor?>
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
		<option value="gid"<?php if($sort=='gid'):?> selected="selected"<?php endif?>>등록일</option>
		<option value="down"<?php if($sort=='down'):?> selected="selected"<?php endif?>>다운</option>
		<option value="size"<?php if($sort=='size'):?> selected="selected"<?php endif?>>사이즈</option>
		</select>
		<select name="orderby" onchange="this.form.submit();">
		<option value="desc"<?php if($orderby=='desc'):?> selected="selected"<?php endif?>>역순</option>
		<option value="asc"<?php if($orderby=='asc'):?> selected="selected"<?php endif?>>정순</option>
		</select>

		<select name="recnum" onchange="this.form.submit();">
		<option value="20"<?php if($recnum==20):?> selected="selected"<?php endif?>>20개</option>
		<option value="35"<?php if($recnum==35):?> selected="selected"<?php endif?>>35개</option>
		<option value="50"<?php if($recnum==50):?> selected="selected"<?php endif?>>50개</option>
		<option value="75"<?php if($recnum==75):?> selected="selected"<?php endif?>>75개</option>
		<option value="90"<?php if($recnum==90):?> selected="selected"<?php endif?>>90개</option>
		</select>
		<select name="where">
		<option value="name"<?php if($where=='name'):?> selected="selected"<?php endif?>>파일명</option>
		<option value="caption"<?php if($where=='caption'):?> selected="selected"<?php endif?>>캡션</option>
		<option value="mbruid"<?php if($where=='mbruid'):?> selected="selected"<?php endif?>>회원UID</option>
		</select>

		<input type="text" name="keyw" value="<?php echo stripslashes($keyw)?>" class="input" />

		<input type="submit" value="검색" class="btnblue" />
		<input type="button" value="리셋" class="btngray" onclick="location.href='<?php echo $g['adm_href']?>';" />

		<input type="checkbox" id="cync_check" name="cync" value="1"<?php if($cync):?> checked="checked"<?php endif?> onclick="this.form.submit();" /><label for="cync_check">미사용파일</label>

		</div>

		</form>
	</div>


	<div class="info">

		<div class="article">
			<?php echo number_format($NUM)?>개(<?php echo $p?>/<?php echo $TPG?>페이지)
		</div>
		
		<div class="category">
			<a href="<?php echo $g['s']?>/?<?php echo $r?>&amp;m=<?php echo $m?>&module=filemanager&front=main&pwd=.%2Ffiles%2F" target="_blank" class="u">파일탐색기</a>
		</div>
		<div class="clear"></div>
	</div>



	<form name="listForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="m" value="<?php echo $module?>" />
	<input type="hidden" name="a" value="" />


	<table summary="전체 첨부파일리스트 입니다.">
	<caption>첨부파일</caption> 
	<colgroup> 
	<col width="30"> 
	<col width="50"> 
	<col width="220">
	<col width="35">
	<col width="80">
	<col width="120">
	<col width="80"> 
	<col width="60"> 
	<col width="50"> 
	<col width="90">
	<col>
	</colgroup> 
	<thead>
	<tr>
	<th scope="col" class="side1"><img src="<?php echo $g['img_core']?>/_public/ico_check_01.gif" class="hand" alt="" onclick="chkFlag('upfile_members[]');" /></th>
	<th scope="col">번호</th>
	<th scope="col">파일명</th>
	<th scope="col">사용처</th>
	<th scope="col">소유자</th>
	<th scope="col">서버</th>
	<th scope="col">폴더</th>
	<th scope="col">사이즈</th>
	<th scope="col">다운</th>
	<th scope="col">날짜</th>
	<th scope="col" class="side2"></th>
	</tr>
	</thead>
	<tbody>

	<?php while($R=db_fetch_array($RCD)):?>
	<?php $tdir=$R['url'].$R['folder'].'/'?>
	<?php $file_ext=getExt($R['name'])?>

	<tr>
	<td><input type="checkbox" name="upfile_members[]" value="<?php echo $R['uid']?>" /></td>
	<td>
		<?php echo $NUM-((($p-1)*$recnum)+$_rec++)?>
	</td>
	<td class="sbj" title="<?php echo addslashes($R['caption'])?>">
		<img src="<?php echo $g['img_core']?>/file/small/<?php echo is_file($g['path_core'].'image/file/small/'.$file_ext.'.gif')?$file_ext:'unknown'?>.gif" alt="<?php echo $file_ext?>" />
		<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=download&amp;uid=<?php echo $R['uid']?>" title="<?php echo $R['tmpname']?>"<?php if(strstr('jpeg,jpg,gif,png,swf',$file_ext)):?> onmouseover="imgShow('<?php echo $tdir?>',this,<?php echo $R['width']?>,event);" onmouseout="imgHide();"<?php endif?>><?php echo $R['name']?></a>
		<?php if(getNew($R['d_regis'],24)):?><span class="new">new</span><?php endif?>
	</td>
	<td>
	<?php if($R['cync']):?>
	<a href="<?php echo getCyncUrl($R['cync'])?>" target="_blank"><img src="<?php echo $g['img_core']?>/_public/ico_blank.gif" alt="보기" title="보기" /></a>
	<?php endif?>
	</td>
	<?php if($R['mbruid']):?>
	<?php $M=getDbData($table['s_mbrdata'],'memberuid='.$R['mbruid'],'*')?>
	<td><a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&m=member&front=manager&iframe=Y&page=post&mbruid=<?php echo $R['mbruid']?>');" title="소유자정보"><?php echo $M[$_HS['nametype']]?></a></td>
	<?php else:?>
	<td>비회원</td>
	<?php endif?>
	<td><?php echo getDomain($R['url'])?></td>
	<td><?php echo $R['folder']?></td>
	<td><?php echo getSizeFormat($R['size'],1)?></td>
	<td><?php echo $R['down']?></td>
	<td><?php echo getDateFormat($R['d_regis'],'Y.m.d H:i')?></td>
	<td></td>
	</tr> 
	<?php endwhile?> 

	<?php if(!$NUM):?>
	<tr>
	<td><input type="checkbox" disabled="disabled" /></td>
	<td>1</td>
	<td class="sbj1">첨부파일이 없습니다.</td>
	<td class="hit b">-</td>
	<td class="hit b">-</td>
	<td class="hit b">-</td>
	<td class="hit b">-</td>
	<td class="hit b">-</td>
	<td class="hit b">-</td>
	<td class="hit b">-</td>
	<td></td>
	</tr> 
	<?php endif?>

	</tbody>
	</table>

	<div class="pagebox01">
	<script type="text/javascript">getPageLink(10,<?php echo $p?>,<?php echo $TPG?>,'<?php echo $g['img_core']?>/page/default');</script>
	</div>

	<input type="button" value="선택/해제" class="btngray" onclick="chkFlag('upfile_members[]');" />
	<input type="button" value="삭제" class="btnblue" onclick="actCheck('multi_delete');" />
	</form>



</div>

<div id="hImg"></div>

<script type="text/javascript">
//<![CDATA[
function imgShow(tdir,obj,w,e)
{
	var xy = getEventXY(e);

	if (w > 300)
	{
		var xw = 'width=300';
	}
	else {
		var xw = 'width='+w;
	}

	getId('hImg').style.display = 'block';
	getId('hImg').style.top = parseInt(xy.y) + 'px'
	getId('hImg').style.left = (parseInt(xy.x) + 20) + 'px';


	if (obj.innerHTML.indexOf('.swf') != -1)
	{
		getId('hImg').innerHTML = '<div style="background:#ffffff;border:#000000 solid 4px;"><embed src="'+tdir+obj.title+'" '+xw+' style="padding:5px;"></embed></div>';
	}
	else {
		getId('hImg').innerHTML = '<div style="background:#ffffff;border:#000000 solid 4px;"><img src="'+tdir+obj.title+'" '+xw+' style="padding:5px;" /></div>';
	}
}
function imgHide()
{
	getId('hImg').style.display = 'none';
}
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
function actCheck(act)
{
	var f = document.listForm;
    var l = document.getElementsByName('upfile_members[]');
    var n = l.length;
	var j = 0;
    var i;

    for (i = 0; i < n; i++)
	{
		if(l[i].checked == true)
		{
			j++;
		}
	}
	if (!j)
	{
		alert('선택된 파일이 없습니다.      ');
		return false;
	}
	if (act == 'multi_delete')
	{
		if (confirm('정말로 삭제하시겠습니까?        '))
		{
			f.a.value = act;
			f.submit();
		}
	}

	return false;
}
//]]>
</script>
