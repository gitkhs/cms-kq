<?php
$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 301 ? $recnum : 30;
$bbsque	= 'uid';

if ($where && $keyw)
{
	if (strstr('[id]',$where)) $bbsque .= " and ".$where."='".$keyw."'";
	else $bbsque .= getSearchSql($where,$keyw,$ikeyword,'or');	
}

$RCD = getDbArray($table[$module.'list'],$bbsque,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table[$module.'list'],$bbsque);
$TPG = getTotalPage($NUM,$recnum);

$_LEVELNAME = array('l0'=>'전체허용');
$_LEVELDATA=getDbArray($table['s_mbrlevel'],'','*','uid','asc',0,1);
while($_L=db_fetch_array($_LEVELDATA)) $_LEVELNAME['l'.$_L['uid']] = $_L['name'].' 이상';
?>



<div id="bbslist">

	<div class="sbox">
		<form name="procForm" action="<?php echo $g['s']?>/" method="get">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="module" value="<?php echo $module?>" />
		<input type="hidden" name="front" value="<?php echo $front?>" />

		<div>
		<select name="sort" onchange="this.form.submit();">
		<option value="gid"<?php if($sort=='gid'):?> selected="selected"<?php endif?>>지정순서</option>
		<option value="uid"<?php if($sort=='uid'):?> selected="selected"<?php endif?>>개설일</option>
		<option value="num_r"<?php if($sort=='num_r'):?> selected="selected"<?php endif?>>게시물수</option>
		<option value="d_last"<?php if($sort=='d_last'):?> selected="selected"<?php endif?>>최근게시</option>
		</select>
		<select name="orderby" onchange="this.form.submit();">
		<option value="desc"<?php if($orderby=='desc'):?> selected="selected"<?php endif?>>역순</option>
		<option value="asc"<?php if($orderby=='asc'):?> selected="selected"<?php endif?>>정순</option>
		</select>

		<select name="recnum" onchange="this.form.submit();">
		<?php for($i=30;$i<=300;$i=$i+30):?>
		<option value="<?php echo $i?>"<?php if($i==$recnum):?> selected="selected"<?php endif?>><?php echo $i?>개</option>
		<?php endfor?>
		</select>
		<select name="where">
		<option value="name"<?php if($where=='name'):?> selected="selected"<?php endif?>>게시판명</option>
		<option value="id"<?php if($where=='id'):?> selected="selected"<?php endif?>>아이디</option>
		</select>

		<input type="text" name="keyw" value="<?php echo stripslashes($keyw)?>" class="input" />

		<input type="submit" value="검색" class="btnblue" />
		<input type="button" value="리셋" class="btngray" onclick="location.href='<?php echo $g['adm_href']?>';" />

		<a href="#." class="add" onclick="crLayer('게시판 추가','<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $module?>&amp;front=makebbs&amp;iframe=Y','iframe',800,650,'5%');"><img src="<?php echo $g['img_core']?>/_public/btn_add.gif" alt="추가" />새 게시판 만들기</a>
		</div>

		</form>
	</div>


	<div class="info">

		<div class="article">
			<?php echo number_format($NUM)?>개(<?php echo $p?>/<?php echo $TPG?>페이지)
		</div>
		
		<div class="category">

		</div>
		<div class="clear"></div>
	</div>

	<div class="bbsbody">
		<form name="listForm" action="<?php echo $g['s']?>/" method="post">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $module?>" />
		<input type="hidden" name="a" value="" />


		<table>
		<colgroup> 
		<col width="30"></col> 
		<col width="40"></col> 
		<col width="70"></col> 
		<col width="200"></col> 
		<col width="50"></col> 
		<col width="70"></col> 
		<col width="30"></col> 
		<col width="30"></col> 
		<col width="30"></col> 
		<col width="30"></col> 
		<col width="30"></col> 
		<col width="60"></col> 
		<col width="60"></col> 
		<col width="60"></col> 
		<col width="60"></col> 
		<col></col> 
		</colgroup> 
		<thead>
		<tr>
		<th scope="col" class="side1"><img src="<?php echo $g['img_core']?>/_public/ico_check_01.gif" class="hand" alt="" onclick="chkFlag('bbs_members[]');" /></th>
		<th scope="col">번호</th>
		<th scope="col">아이디</th>
		<th scope="col">게시판명</th>
		<th scope="col">게시물</th>
		<th scope="col">최근게시</th>
		<th scope="col">분류</th>
		<th scope="col">연결</th>
		<th scope="col">소셜</th>
		<th scope="col">헤더</th>
		<th scope="col">풋터</th>
		<th scope="col">레이아웃</th>
		<th scope="col">접근권한</th>
		<th scope="col">포인트</th>
		<th scope="col">관리</th>
		<th scope="col" class="side2"></th>
		</tr>
		</thead>
		<tbody>
		<?php while($R=db_fetch_array($RCD)):?>
		<?php $L=getOverTime($date['totime'],$R['d_last'])?>
		<?php $d=array();include $g['path_module'].$module.'/var/var.'.$R['id'].'.php'?>
		<tr>
		<td><input type="checkbox" name="bbs_members[]" value="<?php echo $R['uid']?>" /></td>
		<td><?php echo $NUM-((($p-1)*$recnum)+$_rec++)?></td>
		<td class="bid"><a href="<?php echo RW('m='.$module.'&bid='.$R['id'])?>" target="_blank"><?php echo $R['id']?></a></td>
		<td class="sbj tooltip">
			<input type="text" name="name_<?php echo $R['uid']?>" value="<?php echo $R['name']?>" />
			<span class="_right _r150 _w200">
			<b>최신글제외</b> : <?php echo $d['bbs']['display']?'Yes':'No'?><br />
			<b>쿼리생략</b> : <?php echo $d['bbs']['hidelist']?'Yes':'No'?><br />
			<b>RSS발행</b> : <?php echo $d['bbs']['rss']?'Yes':'No'?><br />
			<b>조회수증가</b> : <?php echo $d['bbs']['hitcount']?'계속증가':'1회만증가(세션적용)'?><br />
			<b>게시물출력수</b> : <?php echo $d['bbs']['recnum']?>개<br />
			<b>제목끊기</b> : <?php echo $d['bbs']['sbjcut']?>자<br />
			<b>새글유지</b> : <?php echo $d['bbs']['newtime']?>시간<br />
			<b>추차관리자</b> : <?php echo $d['bbs']['admin']?$d['bbs']['admin']:'없음'?><br /><i></i>
			</span>
		</td>
		<td><?php echo number_format($R['num_r'])?></td>
		<td class="lst"><?php echo $R['d_last']?($L[1]<3?$L[0].$lang['sys']['time'][$L[1]].'전':getDateFormat($R['d_last'],'Y.m.d')):''?><?php if(getNew($R['d_last'],24)):?> <u>new</u><?php endif?></td>
		<td class="cat"><?php echo $R['category']?'<span>Y</span>':'N'?></td>
		<td class="cat"><?php echo $d['bbs']['sosokmenu']?'<span>Y</span>':'N'?></td>
		<td class="cat"><?php echo $d['bbs']['snsconnect']?'<span>Y</span>':'N'?></td>
		<td class="cat"><?php echo $R['imghead']||is_file($g['path_module'].$module.'/var/code/'.$R['id'].'.header.php')?'<span>Y</span>':'N'?></td>
		<td class="cat"><?php echo $R['imgfoot']||is_file($g['path_module'].$module.'/var/code/'.$R['id'].'.footer.php')?'<span>Y</span>':'N'?></td>
		<td class="lay tooltip">
			<?php echo $d['bbs']['layout']?'<i>Y</i>':'N'?> / <?php echo $d['bbs']['skin']?'<i>Y</i>':'N'?> / <?php echo $d['bbs']['c_skin']?'<i>Y</i>':'N'?>
			<span class="_left _l250 _w250">
			<b>레이아웃</b> : <?php echo $d['bbs']['layout']?'':'사이트 대표레이아웃'?><br />
			<b>게시판테마</b>(pc) : <?php echo $d['bbs']['skin']?getFolderName( $g['path_module'].$module.'/theme/'.$d['bbs']['skin']).'('.basename($d['bbs']['skin']).')':'대표테마'?><br />
			<b>게시판테마</b>(mobile) :  <?php echo $d['bbs']['m_skin']?getFolderName( $g['path_module'].$module.'/theme/'.$d['bbs']['m_skin']).'('.basename($d['bbs']['m_skin']).')':'대표테마'?><br />
			<b>댓글테마</b>(pc) : <?php echo $d['bbs']['cskin']?getFolderName( $g['path_module'].'comment/theme/'.$d['bbs']['cskin']).'('.basename($d['bbs']['cskin']).')':'대표테마'?><br />
			<b>댓글테마</b>(mobile) :  <?php echo $d['bbs']['c_mskin']?getFolderName( $g['path_module'].'comment/theme/'.$d['bbs']['c_mskin']).'('.basename($d['bbs']['c_mskin']).')':'대표테마'?><br /><i></i>
			</span>
		</td>
		<td class="perm tooltip">
			<?php echo $d['bbs']['perm_l_list']?> / <?php echo $d['bbs']['perm_l_view']?> / <?php echo $d['bbs']['perm_l_write']?>
			<span class="_left _l150 _w150">
			<b>목록</b> : <?php echo $_LEVELNAME['l'.$d['bbs']['perm_l_list']]?><br />
			<b>열람</b> : <?php echo $_LEVELNAME['l'.$d['bbs']['perm_l_view']]?><br />
			<b>쓰기</b> : <?php echo $_LEVELNAME['l'.$d['bbs']['perm_l_write']]?><br />
			<b>다운</b> : <?php echo $_LEVELNAME['l'.$d['bbs']['perm_l_down']]?><br /><i></i>
			</span>
		</td>
		<td class="perm tooltip">
			<?php echo number_format($d['bbs']['point1'])?> / <?php echo number_format($d['bbs']['point2'])?> / <?php echo number_format($d['bbs']['point3'])?>
			<span class="_left _l150 _w150">
			<b>등록</b> : <?php echo number_format($d['bbs']['point1'])?>P 지급<br />
			<b>열람</b> : <?php echo number_format($d['bbs']['point2'])?>P 차감<br />
			<b>다운</b> : <?php echo number_format($d['bbs']['point3'])?>P 차감<br /><i></i>
			</span>
		</td>
		<td class="mng">
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=deletebbs&amp;uid=<?php echo $R['uid']?>" onclick="return hrefCheck(this,true,'삭제하시면 모든 게시물이 지워지며 복구할 수 없습니다.\n정말로 삭제하시겠습니까?');" class="del">삭제</a>
			<a href="#." onclick="crLayer('게시판 설정','<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $module?>&amp;front=makebbs&amp;iframe=Y&amp;uid=<?php echo $R['uid']?>','iframe',800,650,'5%');">설정</a>		</td>
		<td></td>
		</tr>
		<?php endwhile?>
		<?php if(!$NUM):?>
		<tr>
		<td colspan="15" class="none">게시판이 없습니다.</td>
		<td class="none"></td>
		</tr> 
		<?php endif?>
		</tbody>
		</table>

		<div class="pagebox01">
		<script type="text/javascript">getPageLink(10,<?php echo $p?>,<?php echo $TPG?>,'<?php echo $g['img_core']?>/page/default');</script>
		</div>	

		<input type="button" value="선택/해제" class="btngray" onclick="chkFlag('bbs_members[]');" />
		<input type="button" value="수정" class="btnblue" onclick="actCheck('multi_config');" />
		</form>
	</div>



</div>



<script type="text/javascript">
//<![CDATA[
function actCheck(act)
{
	var f = document.listForm;
    var l = document.getElementsByName('bbs_members[]');
    var n = l.length;
	var j = 0;
    var i;
	var s = '';

    for (i = 0; i < n; i++)
	{
		if(l[i].checked == true)
		{
			j++;
			s += '['+l[i].value+']';
		}
	}
	if (!j)
	{
		alert('선택된 게시판이 없습니다.      ');
		return false;
	}
	
	if (act == 'multi_config')
	{
		if(confirm('정말로 실행하시겠습니까?    '))
		{
			getIframeForAction(f);
			f.a.value = act;
			f.submit();
		}
	}
	return false;
}

//]]>
</script>


