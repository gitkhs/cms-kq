<?php 
include_once $g['dir_module_skin'].'_menu.php';


$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 200 ? $recnum : $d['search']['s_num2'];

$bbsque = 'site='.$s." and type<>2 and hidden=0 and d_regis > ".$d['search']['date'];
$bbsque .= getSearchSql('name|caption',$keyword,$ikeyword,'or');
$RCD = getDbArray($table['s_upload'],$bbsque,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table['s_upload'],$bbsque);
$TPG = getTotalPage($NUM,$recnum);
?>



<?php if($NUM):?>
<div id="s_upload">

	<div class="subtitle">
		<div class="xleft">첨부파일(검색결과 <?php echo number_format($NUM)?>개)</div>
		<div class="xright"><a href="<?php echo $g['url_reset']?>">통합검색</a></div>
		<div class="clear"></div>
	</div>


	<table summary="접속기록 리스트입니다.">
	<caption>접속기록</caption> 
	<colgroup> 
	<col> 
	<col width="70"> 
	<col width="60"> 
	<col width="80"> 
	</colgroup> 
	<thead>
	<tr>
	<th scope="col" class="side1">파일명</th>
	<th scope="col">사이즈</th>
	<th scope="col">다운로드</th>
	<th scope="col" class="side2">등록일</th>
	</tr>
	</thead>
	<tbody>

	<?php while($R=db_fetch_array($RCD)):?>
	<tr>
	<td class="name"><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=upload&amp;a=download&amp;uid=<?php echo $R['uid']?>" title="<?php echo $R['caption']?>"><?php echo $R['name']?></a></td>
	<td><?php echo getSizeFormat($R['size'],1)?></td>
	<td><?php echo number_format($R['down'])?></td>
	<td><?php echo getDateFormat($R['d_regis'],'Y.m.d')?></td>
	</tr> 
	<?php endwhile?>

	</tbody>
	</table>

</div>
<div class="pagebox01">
<script type="text/javascript">getPageLink(10,<?php echo $p?>,<?php echo $TPG?>,'<?php echo $g['img_core']?>/page/default');</script>
</div>
<?php else:?>
<div id="s_result">
<img src="<?php echo $g['img_core']?>/_public/ico_notice.gif" alt="" />
검색결과가 없습니다.
</div>
<?php endif?>

