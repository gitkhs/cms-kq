<?php 
include $g['path_core'].'function/rss.func.php';
include $g['path_module'].'market/var/var.php';
$_serverinfo = explode('/',$d['market']['url']);
$_updatelist = getUrlData('http://'.$_serverinfo[2].'/__update/update.txt',10);
$_updatelist = explode("\n",$_updatelist);
$_updatelength = count($_updatelist)-1;
$_version = explode('.',$d['admin']['version']);
$recnum	=  15;
$TPG = getTotalPage($_updatelength,$recnum);
?>




<div id="Uupdate">

	<div class="tbox">
		<div class="tleft">
			<div class="title">킴스큐 원격 업데이트</div>
			<p>
				원격 업데이트를 이용하시면 킴스큐Rb를 항상 최신의 상태로 유지할 수 있습니다.<br />
				패치 및 업데이트 내용에 따라서 업데이트를 진행해 주세요.
				<a href="#." onclick="layerShowHide('guide_update','block','none');">업데이트 도움말</a><br />
			</p>
		</div>
		<div class="tright">
			<div class="version">
			<i class="gap1"><?php echo $_version[0]?></i>
			<i class="gap2"><?php echo $_version[1]?></i>
			<i class="gap3"><?php echo $_version[2]?></i>
			<div class="clear"></div>		
			</div>
		</div>
		<div class="clear"></div>
	</div>

	<div id="guide_update" class="guide hide">
	원격 업데이트는 킴스큐의 코어 및 관련 파일들을 항상 최신의 상태로 유지할 수 있는 시스템입니다.<br />
	그러나 사용자가 직접 수정하거나 커스터마이징 한 사항이 업데이트 내역에 포함되어 있을 경우 해당사항이 덧씌워 지므로 이 경우 반드시 수작업으로 패치한 후 수동 업데이트를 클릭해 주어야 합니다.<br />
	정상적으로 업데이트 되지 않았거나 재 업데이트를 원하시면 기록을 제거한 후 재시도해 주세요<br />
	이 작업은 데이터의 용량이나 처리내용에 따라서 다소 시간이 걸릴 수 있습니다.<br />
	원격 업데이는 킴스큐 1.1.0 버젼부터 지원됩니다.<br />
	</div>

	<div class="count">총 <?php echo $_updatelength?>건</div>

	<table>
	<thead>
	<tr>
	<th>버젼</th>
	<th>패치/업데이트 (변경사항)</th>
	<th>업데이트일자</th>
	<th>처리</th>
	<th>수동</th>
	<th>제거</th>
	</tr>
	</thead>
	<tbody>
	<?php $_ishistory=false?>
	<?php for($i = $_updatelength-(($p-1)*$recnum)-1; $i > $_updatelength-($p*$recnum)-1; $i--):?>
	<?php $_update=trim($_updatelist[$i]);if(!$_update)continue?>
	<?php $var1=explode(',',$_update)?>
	<?php $var2=explode(',',$_updatelist[$i-1])?>
	<tr>
	<td class="t1<?php if($var1[0]!=$var2[0]):?> bx<?php endif?>"><?php echo $var1[0]?></td>
	<td class="t2">
		<?php echo $var1[0]?>_<?php echo $var1[1]?>
		<a href="http://<?php echo $_serverinfo[2]?>/r/update/<?php echo $var1[2]?>" target="_blank">내용보기</a>
	</td>
	<td class="t3">
		<?php if(is_file($g['path_var'].'update/'.$var1[1].'.txt')):?>
		<?php $_supdate=explode(',',implode('',file($g['path_var'].'update/'.$var1[1].'.txt')))?>
		<span class="udate1_1"><?php echo getDateFormat($_supdate[0],'Y.m.d')?></span>
		<?php else:$_supdate=array()?>
		<span class="udate1_2">업데이트 전</span>
		<?php endif?>
	</td>
	<?php if(!is_file($g['path_var'].'update/'.$var1[1].'.txt')&&(is_file($g['path_var'].'update/'.$var2[1].'.txt')||!trim($var2[1]))):?>
		<td class="t4">
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;a=update&amp;type=auto&amp;ufile=<?php echo $var1[1]?>" class="btnGray01 plusBlue hand" onclick="return hrefCheck(this,true,'정말로 업데이트 하시겠습니까?');"><i><s>업데이트</s></i></a>
		</td>
		<td class="t5"><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;a=update&amp;type=manual&amp;ufile=<?php echo $var1[1]?>" class="u" title="수동 업데이트 처리" onclick="return hrefCheck(this,true,'정말로 수동으로 업데이트 처리하시겠습니까?\n수동 업데이트 처리시 원격업데이트는 건너뜁니다.');">수동</a></td>
		<td class="t6"></td>
	<?php else:?>
		<?php if(is_file($g['path_var'].'update/'.$var1[1].'.txt')):?>
		<td class="t4"><span class="udate1_1">완료</span></td>
		<td class="t5"><?php if($_supdate[1]):?><span class="udate1_2">수동</span><?php endif?></td>
		<td class="t6"><?php if(!$_ishistory):?><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;a=update&amp;type=delete&amp;ufile=<?php echo $var1[1]?>" title="업데이트기록 제거" onclick="return hrefCheck(this,true,'정말로 업데이트 기록을 제거하시겠습니까?');"><span class="udate1_2 u">제거</span></a><?php endif?></td>
		<?php $_ishistory=true?>
		<?php else:?>
		<td class="t4"><span class="udate1_2">대기중</span></td>
		<td class="t5"></td>
		<td class="t6"></td>
		<?php endif?>
	<?php endif?>
	</td>
	</tr>
	<?php endfor?>
	<?php if(!$_updatelength):?>
	<tr>
	<td class="t7" colspan="5">업데이트 대기리스트가 없습니다.</td>
	</tr>
	<?php endif?>
	</tbody>
	</table>

	<div class="pagebox01">
	<script type="text/javascript">getPageLink(10,<?php echo $p?>,<?php echo $TPG?>,'<?php echo $g['img_core']?>/page/default');</script>
	</div>

</div>

