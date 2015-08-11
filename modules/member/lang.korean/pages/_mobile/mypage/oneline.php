<?php
include_once $g['dir_module_skin'].'_menu.php';

$sort	= $sort ? $sort : 'uid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 200 ? $recnum : 20;

$bbsque = 'mbruid='.$my['uid'].' and site='.$s;
if ($where && $keyword)
{
	if (strstr('[name][nic][id][ip]',$where)) $bbsque .= " and ".$where."='".$keyword."'";
	else if ($where == 'term') $bbsque .= " and d_regis like '".$keyword."%'";
	else $bbsque .= getSearchSql($where,$keyword,$ikeyword,'or');
}
$RCD = getDbArray($table['s_oneline'],$bbsque,'*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table['s_oneline'],$bbsque);
$TPG = getTotalPage($NUM,$recnum);
?>


<div id="bbslist">

	<div class="infox">

		<div class="article">
			<?php echo number_format($NUM)?>개(<?php echo $p?>/<?php echo $TPG?>페이지)
		</div>
		
		<div class="category">

		</div>
		<div class="clear"></div>
	</div>


	<?php while($R=db_fetch_array($RCD)):?> 
	<?php $_R=getUidData($table['s_comment'],$R['parent'])?>
	<?php $R['mobile']=isMobileConnect($R['agent'])?>
	<div class="list<?php if($R['uid'] == $uid):?> dselected<?php endif?>" onclick="goHref('<?php echo getCyncUrl($_R['cync'].',CMT:'.$_R['uid'])?>#CMT');">
		<div class="sbj">
			<?php if($R['mobile']):?><img src="<?php echo $g['img_core']?>/_public/ico_mobile.gif" class="imgpos" alt="모바일" title="모바일(<?php echo $R['mobile']?>)로 등록된 글입니다" /><?php endif?>
			<span class="subject"><?php echo getStrCut($R['content'],50,'..')?></span>
			<?php if(getNew($R['d_regis'],24)):?><span class="new">new</span><?php endif?>
		</div>
		<div class="info">
			<?php echo getDateFormat($R['d_regis'],'Y.m.d H:i')?>
		</div>
	</div>
	<?php endwhile?> 



	<?php if(!$NUM):?>
	<div class="none">등록된 한줄의견이 없습니다.</div>
	<?php endif?>


	<div class="pagebox01">
	<script type="text/javascript">getPageLink(10,<?php echo $p?>,<?php echo $TPG?>,'<?php echo $g['img_core']?>/page/default');</script>
	</div>


	<div class="searchform">
		<form name="bbssearchf" action="<?php echo $g['s']?>/">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<?php if($_mod):?>
		<input type="hidden" name="mod" value="<?php echo $_mod?>" />
		<?php else:?>
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="front" value="<?php echo $front?>" />
		<?php endif?>
		<input type="hidden" name="page" value="<?php echo $page?>" />
		<input type="hidden" name="sort" value="<?php echo $sort?>" />
		<input type="hidden" name="orderby" value="<?php echo $orderby?>" />
		<input type="hidden" name="recnum" value="<?php echo $recnum?>" />
		<input type="hidden" name="type" value="<?php echo $type?>" />
		<input type="hidden" name="iframe" value="<?php echo $iframe?>" />
		<input type="hidden" name="skin" value="<?php echo $skin?>" />

		<select name="where">
		<option value="content"<?php if($where=='content'):?> selected="selected"<?php endif?>>내용</option>
		</select>
		
		<input type="text" name="keyword" size="30" value="<?php echo $_keyword?>" class="input" />
		<input type="submit" value=" 검색 " class="btngray" />
		</form>
	</div>

</div>

