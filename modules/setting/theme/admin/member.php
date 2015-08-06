<?
	$SITES = getDbArray($table['s_site'],'','*','gid','asc',0,1);
	$year1	= $year1  ? $year1  : substr($date['today'],0,4);
	$month1	= $month1 ? $month1 : '01';
	$day1	= $day1   ? $day1   : 1;//substr($date['today'],6,2);
	$year2	= $year2  ? $year2  : substr($date['today'],0,4);
	$month2	= $month2 ? $month2 : substr($date['today'],4,2);
	$day2	= $day2   ? $day2   : substr($date['today'],6,2);


	$sort	= $sort ? $sort : 'memberuid';
	$orderby= $orderby ? $orderby : 'desc';
	$recnum	= $recnum && $recnum < 200 ? $recnum : 20;

	$accountQue = $account ? 'site='.$account.' and ':'';
	//사이트선택적용
	//$accountQue = $account ? 'a.site='.$account.' and ':'';
	$_WHERE = $accountQue.'d_regis > '.$year1.sprintf('%02d',$month1).sprintf('%02d',$day1).'000000 and d_regis < '.$year2.sprintf('%02d',$month2).sprintf('%02d',$day2).'240000'." and admin <> 1 and id <> 'master'";
//	$_WHERE = $accountQue.'d_regis > '.$year1.sprintf('%02d',$month1).sprintf('%02d',$day1).'000000 and d_regis < '.$year2.sprintf('%02d',$month2).sprintf('%02d',$day2).'240000'." and admin <> 1";
	if ($auth) $_WHERE .= ' and auth='.$auth;
	if ($sosok) $_WHERE .= ' and sosok='.$sosok;
	if ($level) $_WHERE .= ' and level='.$level;
	if ($now_log) $_WHERE .= ' and now_log='.($now_log-1);
	if ($sex) $_WHERE .= ' and sex='.$sex;
	if ($comp) $_WHERE .= ' and comp='.$comp;

	if ($marr1)
	{
		if ($marr1==1) $_WHERE .= ' and marr1=0';
		else $_WHERE .= ' and marr1>0';
	}
	if ($mailing) $_WHERE .= ' and mailing='.($mailing-1);
	if ($sms) $_WHERE .= ' and sms='.($sms-1);

	if ($addr0)
	{
		$_WHERE .= $addr0!='NULL'?" and addr0='".$addr0."'":" and addr0=''";
	}
	if ($where && $keyw) $_WHERE .= " and ".$where." like '%".trim($keyw)."%'";

	$RCD = getDbArray($table['s_mbrdata'].' left join '.$table['s_mbrid'].' on memberuid=uid',$_WHERE,'*',$sort,$orderby,$recnum,$p);
	$NUM = getDbRows($table['s_mbrdata'].' left join '.$table['s_mbrid'].' on memberuid=uid',$_WHERE);
	$TPG = getTotalPage($NUM,$recnum);
	
	$autharr = array('','인증','보류','대기','탈퇴');
	
	include_once $g['dir_module'].'var/mbrlevel.php';
	
	$setYear = $wSet['d_regis'] ? (int)substr($wSet['d_regis'],0,4) : 2000;
?>

<div id="member">
	<form name="procForm" action="<?=$g['s']?>/" method="get">
	<input type="hidden" name="r" value="<?=$r?>" />
	<input type="hidden" name="m" value="<?=$m?>" />
	<input type="hidden" name="mod" value="<?=$mod?>" />
	<input type="hidden" name="div" value="<?=$div?>" />

	<div class="row">
		<select name="year1">
		<?php for($i=$date['year'];$i>=$setYear;$i--):?><option value="<?php echo $i?>"<?php if($year1==$i):?> selected="selected"<?php endif?>><?php echo $i?>년</option><?php endfor?>
		</select>
		<select name="month1">
		<?php for($i=1;$i<13;$i++):?><option value="<?php echo sprintf('%02d',$i)?>"<?php if($month1==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d',$i)?>월</option><?php endfor?>
		</select>
		<select name="day1">
		<?php for($i=1;$i<32;$i++):?><option value="<?php echo sprintf('%02d',$i)?>"<?php if($day1==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d',$i)?>일(<?php echo getWeekday(date('w',mktime(0,0,0,$month1,$i,$year1)))?>)</option><?php endfor?>
		</select> ~
		<select name="year2">
		<?php for($i=$date['year'];$i>=$setYear;$i--):?><option value="<?php echo $i?>"<?php if($year2==$i):?> selected="selected"<?php endif?>><?php echo $i?>년</option><?php endfor?>
		</select>
		<select name="month2">
		<?php for($i=1;$i<13;$i++):?><option value="<?php echo sprintf('%02d',$i)?>"<?php if($month2==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d',$i)?>월</option><?php endfor?>
		</select>
		<select name="day2">
		<?php for($i=1;$i<32;$i++):?><option value="<?php echo sprintf('%02d',$i)?>"<?php if($day2==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d',$i)?>일(<?php echo getWeekday(date('w',mktime(0,0,0,$month2,$i,$year2)))?>)</option><?php endfor?>
		</select>

		<input type="button" class="btndef" value="기간적용" onclick="this.form.submit();" />
		<input type="button" class="btndef" value="어제" onclick="dropDate('<?php echo date('Ymd',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-1,substr($date['today'],0,4)))?>','<?php echo date('Ymd',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-1,substr($date['today'],0,4)))?>');" />
		<input type="button" class="btndef" value="오늘" onclick="dropDate('<?php echo $date['today']?>','<?php echo $date['today']?>');" />
		<input type="button" class="btndef" value="일주" onclick="dropDate('<?php echo date('Ymd',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-7,substr($date['today'],0,4)))?>','<?php echo $date['today']?>');" />
		<input type="button" class="btndef" value="한달" onclick="dropDate('<?php echo date('Ymd',mktime(0,0,0,substr($date['today'],4,2)-1,substr($date['today'],6,2),substr($date['today'],0,4)))?>','<?php echo $date['today']?>');" />
		<input type="button" class="btndef" value="당월" onclick="dropDate('<?php echo substr($date['today'],0,6)?>01','<?php echo $date['today']?>');" />
		<input type="button" class="btndef" value="전월" onclick="dropDate('<?php echo date('Ym',mktime(0,0,0,substr($date['today'],4,2)-1,substr($date['today'],6,2),substr($date['today'],0,4)))?>01','<?php echo date('Ym',mktime(0,0,0,substr($date['today'],4,2)-1,substr($date['today'],6,2),substr($date['today'],0,4)))?>31');" />
		<input type="button" class="btndef" value="전체" onclick="dropDate('<?=date('Ymd', strtotime($wSet['d_regis']))?>','<?php echo $date['today']?>');" />
	</div>

	<div class="row">
		<select name="auth" onchange="this.form.submit();">
		<option value="">회원인증</option>
		<option value="">--------</option>
		<option value="1"<?php if($auth == 1):?> selected="selected"<?php endif?>><?php echo $autharr[1]?></option>
		<option value="2"<?php if($auth == 2):?> selected="selected"<?php endif?>><?php echo $autharr[2]?></option>
		<option value="3"<?php if($auth == 3):?> selected="selected"<?php endif?>><?php echo $autharr[3]?></option>
		<option value="4"<?php if($auth == 4):?> selected="selected"<?php endif?>><?php echo $autharr[4]?></option>
		</select>

		<select name="level" onchange="this.form.submit();">
		<option value="">회원등급</option>
		<option value="">--------</option>
		<?foreach($levelset as $_key => $_val){?>
		<option value="<?=$_key?>" <?php if($d['bbs']['perm_w']==$_key):?>selected="selected"<?php endif?>>ㆍ<?=$_val?> </option>
		<?}?>
		</select>
		
		<select name="sex" onchange="this.form.submit();">
		<option value="">회원성별</option>
		<option value="">--------</option>
		<option value="1"<?php if($sex == 1):?> selected="selected"<?php endif?>>남성</option>
		<option value="2"<?php if($sex == 2):?> selected="selected"<?php endif?>>여성</option>
		</select>

		<select name="now_log" onchange="this.form.submit();">
		<option value="">현재접속</option>
		<option value="">--------</option>
		<option value="2"<?php if($now_log == 2):?> selected="selected"<?php endif?>>온라인</option>
		<option value="1"<?php if($now_log == 1):?> selected="selected"<?php endif?>>오프라인</option>
		</select>

		<select name="marr1" onchange="this.form.submit();">
		<option value="">결혼여부</option>
		<option value="">--------</option>
		<option value="1"<?php if($marr1 == 1):?> selected="selected"<?php endif?>>미혼</option>
		<option value="2"<?php if($marr1 == 2):?> selected="selected"<?php endif?>>기혼</option>
		</select>

		<select name="mailing" onchange="this.form.submit();">
		<option value="">메일수신</option>
		<option value="">--------</option>
		<option value="2"<?php if($mailing == 2):?> selected="selected"<?php endif?>>동의</option>
		<option value="1"<?php if($mailing == 1):?> selected="selected"<?php endif?>>동의안함</option>
		</select>

		<!--
		<select name="sms" onchange="this.form.submit();">
		<option value="">문자수신</option>
		<option value="">--------</option>
		<option value="2"<?php if($sms == 2):?> selected="selected"<?php endif?>>동의</option>
		<option value="1"<?php if($sms == 1):?> selected="selected"<?php endif?>>동의안함</option>
		</select>
		-->
	</div>

	<div class="row">
		<select name="sort" onchange="this.form.submit();">
		<option value="memberuid"<?php if($sort=='memberuid'):?> selected="selected"<?php endif?>>가입일</option>
		<option value="level"<?php if($sort=='level'):?> selected="selected"<?php endif?>>회원등급</option>
		<!--
		<option value="point"<?php if($sort=='point'):?> selected="selected"<?php endif?>>보유포인트</option>
		<option value="usepoint"<?php if($sort=='usepoint'):?> selected="selected"<?php endif?>>사용포인트</option>
		<option value="cash"<?php if($sort=='cash'):?> selected="selected"<?php endif?>>보유적립금</option>
		<option value="money"<?php if($sort=='money'):?> selected="selected"<?php endif?>>보유예치금</option>
		-->
		<option value="last_log"<?php if($sort=='last_log'):?> selected="selected"<?php endif?>>최근접속</option>
		<option value="birth1"<?php if($sort=='birth1'):?> selected="selected"<?php endif?>>나이</option>
		<option value="birth2"<?php if($sort=='birth2'):?> selected="selected"<?php endif?>>생년월일</option>
		</select>

		<select name="orderby" onchange="this.form.submit();">
		<option value="desc"<?php if($orderby=='desc'):?> selected="selected"<?php endif?>>역순</option>
		<option value="asc"<?php if($orderby=='asc'):?> selected="selected"<?php endif?>>정순</option>
		</select>

		<select name="recnum" onchange="this.form.submit();">
		<option value="20"<?php if($recnum==20):?> selected="selected"<?php endif?>>20명</option>
		<option value="35"<?php if($recnum==35):?> selected="selected"<?php endif?>>35명</option>
		<option value="50"<?php if($recnum==50):?> selected="selected"<?php endif?>>50명</option>
		<option value="75"<?php if($recnum==75):?> selected="selected"<?php endif?>>75명</option>
		<option value="90"<?php if($recnum==90):?> selected="selected"<?php endif?>>90명</option>
		</select>
		<select name="where">
		<option value="name"<?php if($where=='name'):?> selected="selected"<?php endif?>>이름</option>
		<option value="id"<?php if($where=='id'):?> selected="selected"<?php endif?>>아이디</option>
		</select>

		<input type="text" name="keyw" value="<?php echo stripslashes($keyw)?>" class="input" />

		<input type="submit" value="검색" class="btnblue" />
		<input type="button" value="리셋" class="btndef" onclick="location.href='<?=$g['s']?>/?r=<?=$r?>&m=setting&mod=admin&div=member';" />
	</div>
	</form>


	<div class="row" style="font-size:11px;text-align:right;">
		<div ><?php echo number_format($NUM)?>명(<?php echo $p?>/<?php echo $TPG?>페이지)</div>
	</div>

	<form name="frmWrite" method="post" action="<?=$g['s']?>/" target="_action_frame_<?=$m?>">
	<input type="hidden" name="r" value="<?=$r?>" />
	<input type="hidden" name="a" value="<?=$mod?>" />
	<input type="hidden" name="m" value="<?=$m?>" />
	<input type="hidden" name="mod" value="<?=$mod?>" />
	<input type="hidden" name="div" value="<?=$div?>" />
	<input type="hidden" name="actid" value="" />

	<table class="tbl-line">
	<colgroup> 
	<col width="30">
	<col width="50">
	<col width="50">
	<col width="90"> 
	<col>
	<col width="80"> 
	<col width="150"> 
	<col width="100"> 
	<col width="70">
	<col width="70"> 
	<col width="70"> 
	</colgroup> 
	<tr>
		<td class="th"><img src="<?php echo $g['img_core']?>/_public/ico_check_01.gif" alt="선택/반전" class="hand" onclick="chkFlag('mbrmembers[]');" /></td>
		<td class="th">번호</td>
		<td class="th">인증</td>
		<td class="th">아이디</td>
		<td class="th">이름</td>
		<td class="th">등급</td>
		<td class="th">연락처</td>
		<td class="th">이메일</td>
		<td class="th">포인트</td>
		<td class="th">최근접속</td>
		<td class="th">가입일</td>
	</tr>
	<?php while($R=db_fetch_array($RCD)):?>
	<tr>
		<td><input type="checkbox" name="mbrmembers[]" value="<?php echo $R['memberuid']?>" /></td>
		<td><?php echo ($NUM-((($p-1)*$recnum)+$_recnum++))?></td>
		<td><?php echo $autharr[$R['auth']]?></td>
		<td><?php echo $R['id']?></td>
		<td class="lt name" onclick="getLayerBoxModal('<?=$g['s']?>/?r=<?=$r?>&m=setting&mod=admin&div=member_detail&mbruid=<?=$R['memberuid']?>&iframe=Y','사용자 정보',960,0,'',false,'');"><?php echo $R['name']?></td>
		<td><?php echo $levelset[$R['level']]?></td>
		<td><?php echo $R['tel2']?$R['tel2']:$R['tel1']?></td>
		<td><?php echo $R['email']?></td>
		<td><?php echo $R['point']?></td>
		<td><?php echo -getRemainDate($R['last_log'])?>일</td>
		<td><?php echo getDateFormat($R['d_regis'],'Y.m.d')?></td>
	</tr>
	<?php endwhile?>
	</table>

	<?php if(!$NUM):?>
	<div style="padding:10px;text-align:center;"><img src="<?php echo $g['img_core']?>/_public/ico_notice.gif" alt="" /> 조건에 해당하는 회원이 없습니다.</div>
	<?php endif?>
	
	<div class="pagebox01"><? echo getPageLink(10,$p,$TPG,$g['img_core'].'/page/default')?></div>

	<div class="">
		<table class="tbl-form">
		<colgroup>
		<col width="120">
		<col>
		<col width="120">
		<col>
		</colgroup>
		<tr>
			<td class="lbl">인증/등급</td>
			<td>
				<select name="adm_auth">
				<option value="">회원인증</option>
				<option value="">--------</option>
				<option value="1"><?=$autharr[1]?></option>
				<option value="2"><?=$autharr[2]?></option>
				<option value="3"><?=$autharr[3]?></option>
				<option value="4"><?=$autharr[4]?></option>
				</select>

				<select name="adm_level">
				<option value="">회원등급</option>
				<option value="">--------</option>
				<?foreach($levelset as $_key => $_val){?>
				<option value="<?=$_key?>">ㆍ<?=$_val?> </option>
				<?}?>
				</select>

				<input type="button" class="btnblue" value="적용" onclick="$('input[name=actid]').val('auth');$('form[name=frmWrite]').submit();">
				<div class="row">선택된 회원의 인증/등급을 관리 합니다.</div>
			</td>
			<td class="lbl">비번초기화</td>
			<td>
				<input type="button" class="btnblue" value="비밀번호초기화" onclick="$('input[name=actid]').val('initpwd');$('form[name=frmWrite]').submit();">
				<div class="row">선택된 회원 비밀번호를 초기화(1111) 합니다.</div>
			</td>
		</tr>
		<tr>
			<td class="lbl">포인트관리</td>
			<td colspan="3">
				포인트 <input type="text" name="pointval" size="6">
				지급사유 <input type="text" name="pointcon" size="50">
				<label><input type="radio" name="pointknd" value="1"> 지급</label>
				<label><input type="radio" name="pointknd" value="2"> 차감</label>
				<input type="button" class="btnblue" value="적용" onclick="$('input[name=actid]').val('point');$('form[name=frmWrite]').submit();">
				<div class="row">선택된 회원의 포인트를 관리 합니다. <b>이 작업은 한명씩만 가능합니다.</b></div>
			</td>
		</tr>
		<tr>
			<td class="lbl">회원등록</td>
			<td colspan="3">
				<select id="mbradd_level">
				<option value="">회원등급</option>
				<option value="">--------</option>
				<?foreach($levelset as $_key => $_val){?>
				<option value="<?=$_key?>" <?php if($d['bbs']['perm_w']==$_key):?>selected="selected"<?php endif?>>ㆍ<?=$_val?> </option>
				<?}?>
				</select>
				아이디 <input type="text" id="mbradd_id">
				이름 <input type="text" id="mbradd_name">
				<input type="button" class="btnorange" value="등 록" onclick="onMemberAdd()">
				등록 비밀번호는 (1111) 입니다.
			</td>
		</tr>
		</table>
	</div>
	
	</form>

</div>

<form name="frmExp" method="post" action="<?=$g['s']?>/" target="_action_frame_<?=$m?>">
<input type="hidden" name="r" value="<?=$r?>" />
<input type="hidden" name="a" value="<?=$mod?>" />
<input type="hidden" name="m" value="<?=$m?>" />
<input type="hidden" name="mod" value="<?=$mod?>" />
<input type="hidden" name="div" value="<?=$div?>_exp" />
<input type="hidden" name="actid" value="" />
<input type="hidden" name="mbradd_level" value="" />
<input type="hidden" name="mbradd_id" value="" />
<input type="hidden" name="mbradd_name" value="" />
</form>

<script type="text/javascript">
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
function onMemberAdd() {
	var frm		= $('form[name=frmExp]');
	var level	= $('#mbradd_level').val();
	var id		= $('#mbradd_id').val();
	var name	= $('#mbradd_name').val();
	
	if(level == '') {
		alert('회원 등급을 선택하세요.');
		return;
	}
	if(id == '') {
		alert('회원 아이디를 입력하세요.');
		return;
	}
	if(name == '') {
		alert('회원 이름을 입력하세요.');
		return;
	}

	frm.find('input[name=actid]').val('memberadd');
	frm.find('input[name=mbradd_level]').val(level);
	frm.find('input[name=mbradd_id]').val(id);
	frm.find('input[name=mbradd_name]').val(name);

	frm.submit();
}
</script>
