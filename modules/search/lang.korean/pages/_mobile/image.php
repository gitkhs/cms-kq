<?php 
include_once $g['dir_module_skin'].'_menu.php';


$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 200 ? $recnum : $d['search']['s_num2'];

$bbsque = 'site='.$s." and type=2 and ext='jpg' and d_regis > ".$d['search']['date'];
$bbsque .= getSearchSql('name|caption',$keyword,$ikeyword,'or');
$RCD = getDbArray($table['s_upload'],$bbsque,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table['s_upload'],$bbsque);
$TPG = getTotalPage($NUM,$recnum);
?>



<?php if($NUM):?>
<div id="s_image">

	<div class="subtitle">
		<div class="xleft">이미지(검색결과 <?php echo number_format($NUM)?>개)</div>
		<div class="xright"><a href="<?php echo $g['url_reset']?>">통합검색</a></div>
		<div class="clear"></div>
	</div>


	<div class="imgbox">

<?php while($R=db_fetch_array($RCD)):?>
<?php $_link = getCyncUrl($R['cync'])?>

		<div class="pic">
		<div class="photo">
		<a href="<?php echo $_link?>"><img src="<?php echo $R['url'].$R['folder'].'/'.$R['thumbname']?>" alt="" title="<?php echo $R['caption']?$R['caption']:$R['name']?>" /></a>
		</div>
		<div class="info"><a href="<?php echo $_link?>"><?php echo $R['caption']?$R['caption']:$R['name']?></a></div>
		<div class="date"><?php echo getDateFormat($R['d_regis'],'Y.m.d H:i')?></div>
		</div>

<?php endwhile?> 
		<div class="clear"></div>
	</div>

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

