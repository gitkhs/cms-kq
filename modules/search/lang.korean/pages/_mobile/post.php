<?php 
include_once $g['dir_module_skin'].'_menu.php';

$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 200 ? $recnum : $d['search']['s_num2'];

$bbsque = 'site='.$s.' and display=1 and d_regis > '.$d['search']['date'];
if ($bbsuid) $bbsque .= ' and bbs='.$bbsuid;
$bbsque .= getSearchSql('subject|tag',$keyword,$ikeyword,'or');
$RCD = getDbArray($table['bbsdata'],$bbsque,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table['bbsdata'],$bbsque);
$TPG = getTotalPage($NUM,$recnum);
?>

<div id="s_post">

	<div class="subtitle">
		<div class="xleft">
		
			<select onchange="goHref('<?php echo $g['url_reset']?>post&bbsuid='+this.value);">
			<option value="">&nbsp;+ 게시판(전체)</option>
			<option value="">---------------------</option>
			<?php echo $_BBS = getDbArray($table['bbslist'],'','*','gid','asc',0,1)?>
			<?php while($_B=db_fetch_array($_BBS)):?>
			<?php if(strstr(','.$d['search']['s_cutbbs'].',',','.$_B['id'].',')) continue?>
			<option value="<?php echo $_B['uid']?>"<?php if($bbsuid==$_B['uid']):?> selected="selected"<?php endif?>>ㆍ<?php echo $_B['name']?>(<?php echo $_B['num_r']?>)</option>
			<?php endwhile?>
			</select>
			
			(검색결과 <?php echo number_format($NUM)?>개)</div>
		<div class="xright"><a href="<?php echo $g['url_reset']?>">통합검색</a></div>
		<div class="clear"></div>
	</div>


	<div class="postbox">
<?php if($NUM):?>
<?php while($R=db_fetch_array($RCD)):?>
<?php $B = getUidData($table['bbslist'],$R['bbs'])?>

	<div class="sbjbox">
		<a href="<?php echo getPostLink($R)?>" class="subject"><?php echo $R['subject']?></a>
		<?php if(strstr($R['content'],'.jpg')):?><img src="<?php echo $g['img_core']?>/_public/ico_pic.gif" class="imgpos" alt="사진" title="사진" /><?php endif?>
		<?php if($R['upload']):?><img src="<?php echo $g['img_core']?>/_public/ico_file.gif" class="imgpos" alt="첨부파일" title="첨부파일" /><?php endif?>
		<?php if($R['comment']):?><span class="comment">[<?php echo $R['comment']?><?php if($R['oneline']):?>+<?php echo $R['oneline']?><?php endif?>]</span><?php endif?>

		<span class="info">
			<?php echo getDateFormat($R['d_regis'],'Y.m.d H:i')?> | 
			<?php echo $R[$_HS['nametype']]?> |
			<a href="<?php echo RW('m=bbs&bid='.$R['bbsid'])?>" target="_blank"><?php echo $B['name']?></a>
		</span>
	</div>
	<div class="shotcont"><?php echo getStrCut(str_replace('&nbsp;',' ',strip_tags($R['content'])),150,'...')?></div>

<?php endwhile?> 

<div class="pagebox01">
<script type="text/javascript">getPageLink(10,<?php echo $p?>,<?php echo $TPG?>,'<?php echo $g['img_core']?>/page/default');</script>
</div>

<?php else:?>
<div id="s_result1">
<img src="<?php echo $g['img_core']?>/_public/ico_notice.gif" alt="" />
검색결과가 없습니다.
</div>
<?php endif?>

	</div>

</div>


