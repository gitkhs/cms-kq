<?php 
include_once $g['dir_module_skin'].'_menu.php';


$sort	= $sort ? $sort : 'uid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 200 ? $recnum : $d['search']['s_num2'];

$bbsque = 'site='.$s.' and display=1 and d_regis > '.$d['search']['date'];
$bbsque .= getSearchSql('subject|content',$keyword,$ikeyword,'or');
$RCD = getDbArray($table['s_comment'],$bbsque,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table['s_comment'],$bbsque);
$TPG = getTotalPage($NUM,$recnum);
?>

<?php if($NUM):?>
<div id="s_comment">

	<div class="subtitle">
		<div class="xleft">댓글(검색결과 <?php echo number_format($NUM)?>개)</div>
		<div class="xright"><a href="<?php echo $g['url_reset']?>">통합검색</a></div>
		<div class="clear"></div>
	</div>


	<div class="postbox">

<?php while($R=db_fetch_array($RCD)):?>

	<div class="sbjbox">
		<a href="<?php echo getCyncUrl($R['cync'].',CMT:'.$R['uid'])?>#CMT" class="subject"><?php echo $R['subject']?></a>
		<?php if(strstr($R['content'],'.jpg')):?><img src="<?php echo $g['img_core']?>/_public/ico_pic.gif" class="imgpos" alt="사진" title="사진" /><?php endif?>
		<?php if($R['upload']):?><img src="<?php echo $g['img_core']?>/_public/ico_file.gif" class="imgpos" alt="첨부파일" title="첨부파일" /><?php endif?>
		<?php if($R['oneline']):?><span class="comment">[<?php echo $R['oneline']?>]</span><?php endif?>

		<span class="info">
			<?php echo getDateFormat($R['d_regis'],'Y.m.d H:i')?> | 
			<?php echo $R[$_HS['nametype']]?>
		</span>
	</div>
	<div class="shotcont"><?php echo getStrCut(str_replace('&nbsp;',' ',strip_tags($R['content'])),150,'...')?></div>

<?php endwhile?> 

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

