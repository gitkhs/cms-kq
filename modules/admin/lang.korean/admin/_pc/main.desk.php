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

$SITES = getDbArray($table['s_site'],'','*','gid','asc',0,1);
$year	= $year		? $year		: substr($date['today'],0,4);
$month	= $month	? $month	: substr($date['today'],4,2);
$day	= $day		? $day		: substr($date['today'],6,2);

include $g['path_core'].'function/rss.func.php';
include $g['path_module'].'market/var/var.php';
$_serverinfo = explode('/',$d['market']['url']);
$_updatelist = getUrlData('http://'.$_serverinfo[2].'/__update/update.txt',10);
$_updatelist = explode("\n",$_updatelist);
$_updatelength = count($_updatelist)-1;
$_lastupdate = explode(',',trim($_updatelist[$_updatelength-1]));
$_isnewversion = is_file($g['path_var'].'update/'.$_lastupdate[1].'.txt') ? true : false;
$_version = explode('.',$d['admin']['version']);
$_gd = gd_info();
$_yesterday = date('Ymd',mktime(0,0,0,substr($date['today'],4,2),substr($date['today'],6,2)-1,substr($date['today'],0,4)));
$accountQue='';
$_D1=getDbData($table['s_numinfo'],$accountQue."date='".$date['today']."'",'*');
$_D2=getDbData($table['s_numinfo'],$accountQue."date='".$_yesterday."'",'*');
$_D3=getDbData($table['bbsday'],$accountQue."date='".$date['today']."'",'*');
$_D4=getDbData($table['bbsday'],$accountQue."date='".$_yesterday."'",'*');
?>

<div id="admdesk">

	<div class="aside">

		<div class="desk">
			<div class="t1">오늘의 현황 <s>|</s> <i><?php echo getDateFormat($date['totime'],'Y.m.d')?> (<?php echo getWeekday($date['toweek'])?>요일)</i></div>
			<table cellspacing="1" bgcolor="">
			<thead>
			<tr>
			<th>방문자</th>
			<th>로그인</th>
			<th>회원가입</th>
			<th>게시글</th>
			<th>댓글</th>
			<th>한줄의견</th>
			<th>파일첨부</th>
			<th>다운로드</th>
			</tr>
			</thead>
			<tbody>
			<tr>
			<td class="v1 tooltip">
				<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=counter&amp;front=data"><?php echo number_format($_D1['visit'])?></a><s>(<?php echo number_format($_D2['visit'])?>)</s>
				<span class="_right _r150 _w150">
				괄호안의 수치는 <b>어제</b> 집계된 데이터입니다. 
				<i></i>
				</span>
			</td>
			<td><?php echo number_format($_D1['login'])?><s>(<?php echo number_format($_D2['login'])?>)</s></td>
			<td><?php echo number_format($_D1['mbrjoin'])?><s>(<?php echo number_format($_D2['mbrjoin'])?>)</s></td>
			<td><?php echo number_format($_D3['num'])?><s>(<?php echo number_format($_D4['num'])?>)</s></td>
			<td><?php echo number_format($_D1['comment'])?><s>(<?php echo number_format($_D2['comment'])?>)</s></td>
			<td><?php echo number_format($_D1['oneline'])?><s>(<?php echo number_format($_D2['oneline'])?>)</s></td>
			<td><?php echo number_format($_D1['upload'])?><s>(<?php echo number_format($_D2['upload'])?>)</s></td>
			<td><?php echo number_format($_D1['download'])?><s>(<?php echo number_format($_D2['download'])?>)</s></td>
			</tr>
			</tbody>
			</table>
		</div>

		<div class="stitle">
			<div class="t1"><span>접속통계 (<?php echo getDateFormat($date['today'],'Y/m')?>)</span></div>
			<div class="t2"><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=counter">더보기</a></div>
			<div class="clear"></div>
		</div>


		<div class="counter">

			<table cellspacing="1">
				<colgroup> 
				<col width="65"></col> 
				<col width="80"></col> 
				<col width="80"></col> 
				<col width="80"></col> 
				<col width="80"></col> 
				<col width="80"></col> 
				</colgroup> 
				<thead>
				<tr class="sbjtr">
					<th scope="col">날짜/구분</th>
					<th scope="col">순방문</th>
					<th scope="col">페이지뷰</th>
					<th scope="col">평균뷰</th>
					<th scope="col">모바일접속</th>
					<th scope="col">비율</th>
				</tr>
				</thead>
				
				<tbody>
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
				</tr>
				<?php endfor?>
				<tr class="sumtr">
					<td class="datetd"><b>합 계</b></td>
					<td class="sumtd1 b"><?php echo $TOT1?number_format($TOT1):'&nbsp;'?></td>
					<td class="sumtd1 b"><?php echo $TOT2?number_format($TOT2):'&nbsp;'?></td>
					<td class="sumtd1 b"><?php echo $TOT1?round($TOT2/$TOT1,1):'&nbsp;'?></td>
					<td class="sumtd2 b"><?php echo $TOT3?$TOT3:'&nbsp;'?></td>
					<td class="sumtd2 b"><?php echo $TOT3?round(($TOT3/$TOT1)*100,1).'%':'&nbsp;'?></td>
				</tr>
				</tbody>
			</table>
		</div>

	</div>
	<div class="bside">

		<div class="stitle">
			<div class="t1"><span>시스템 환경</span></div>
			<div class="t2"><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=admin&amp;front=config">더보기</a></div>
			<div class="clear"></div>
		</div>
		<div class="sysinfo">
			<table>
			<tr>
			<td class="td1">웹서버</td>
			<td>:</td>
			<td class="td2"><?php echo $_SERVER['SERVER_SOFTWARE']?></td>
			</tr>
			<tr>
			<td class="td1">PHP 버젼</td>
			<td>:</td>
			<td class="td2"><?php echo phpversion()?></td>
			</tr>
			<tr>
			<td class="td1">MySQL 버젼</td>
			<td>:</td>
			<td class="td2"><?php echo db_info()?> (<?php echo $DB['type']?>)</td>
			</tr>
			<tr>
			<td class="td1">GD 버젼</td>
			<td>:</td>
			<td class="td2"><?php echo $_gd['GD Version']?></td>
			</tr>
			<tr>
			<td class="td1">킴스큐 버젼</td>
			<td>:</td>
			<td class="td2"><?php echo $d['admin']['version']?></td>
			</tr>
			</table>
		</div>

		<div class="stitle">
			<div class="t1"><span>업데이트</span></div>
			<div class="t2"><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=admin&amp;front=update">더보기</a></div>
			<div class="clear"></div>
		</div>

		<div class="version">
		<i class="gap1"><?php echo $_version[0]?></i>
		<i class="gap2"><?php echo $_version[1]?></i>
		<i class="gap3"><?php echo $_version[2]?></i>
		<div class="clear"></div>		
		</div>
		<div class="newcheck">
			<?php if($_isnewversion):?>
			<div class="existsnone">
				현재 설치된 킴스큐는 최신버젼입니다.<br />
				새로운 업데이트가 있을 경우 이곳에 알려드립니다.<br />
			</div>
			<?php else:?>
			<div class="existsnew">
				새로 등록된 업데이트가 있습니다.<br />
				지금 업데이트하시겠습니까?<br />
				<span>(대기상태인 최신 업데이트 : <?php echo $_lastupdate[0]?> - <?php echo getDateFormat($_lastupdate[1],'Y.m.d')?>)</span>
				<div>
				<a href="http://<?php echo $_serverinfo[2]?>/r/update/<?php echo $_lastupdate[2]?>" target="_blank"><i>관련정보 확인하기</i></a>
				<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=admin&amp;front=update" class="up"><i>지금 업데이트</i></a>
				</div>
			</div>
			<?php endif?>
		</div>

		<div class="stitle">
			<div class="t1"><span>스위치</span></div>
			<div class="t2"><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin&amp;module=admin&amp;front=switch">더보기</a></div>
			<div class="clear"></div>
		</div>

		
		<div class="tree">

			<?php foreach($_switchset as $_key => $_val):?>
			<?php foreach(getSwitchList($_key) as $_addswitch) $d['switch'][$_key][] = $_addswitch?>
			<div class="tbox">
			<table>
			<tr class="tt">
			<td colspan="2"><?php echo $_val?></td>
			<td class="t2"></td>
			</tr>
			</table>
			<?php foreach($d['switch'][$_key] as $_switch):?>
			<?php if(!$_switch) continue?>
			<table>
			<tr>
			<td class="t0"><img src="<?php echo $g['img_core']?>/_public/ico_f3.png" alt="" /></td>
			<td class="t1">
			<?php echo getFolderName($g['path_switch'].$_key.'/'.$_switch)?> <span>(<?php echo str_replace('@','',$_switch)?>)</span>
			</td>
			<td class="t2">
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=switch_change&amp;switch_folder=<?php echo $_key?>&amp;switch=<?php echo $_switch?>&amp;reload=Y" onclick="return hrefCheck(this,true,'정말로 스위치를 <?php echo strpos($_switch,'@')?'켜':'끄'?>시겠습니까?');" title="스위치 ON/FF"><img src="<?php echo $g['img_core']?>/_public/ico_<?php echo strpos($_switch,'@')?'hide':'show'?>.gif" alt="" /></a>
			</td>
			</tr>
			</table>
			<?php endforeach?>
			</div>
			<?php endforeach?>
		
		</div>

	</div>
	<div class="clear"></div>

</div>

