<?php 
include_once $g['dir_module_skin'].'_menu.php';
$recnum = $d['search']['s_num1'];
$result = false;
?>




<!-- 포스트 -->
<?php if($d['search']['s_bbs']):?>
<?php
$_searchsql = getSearchSql('subject|tag',$keyword,$ikeyword,'or');
$RCD = getDbArray($table['bbsdata'],'site='.$s.' and display=1 and d_regis > '.$d['search']['date'].$_searchsql,'*','gid','asc',$recnum,$p);
$NUM = getDbRows($table['bbsdata'],'site='.$s.' and display=1 and d_regis > '.$d['search']['date'].$_searchsql);
?>
<?php if($NUM):$result=true?>
<div id="s_post">

	<div class="subtitle">
		<div class="xleft">게시판(검색결과 <?php echo number_format($NUM)?>개)</div>
		<div class="xright"><?php if($NUM > $recnum):?><a href="<?php echo $g['url_reset']?>post">more</a><?php endif?></div>
		<div class="clear"></div>
	</div>


	<div class="postbox">

<?php while($R=db_fetch_array($RCD)):?>
<?php $B = getUidData($table['bbslist'],$R['bbs'])?>
<?php $_link = getPostLink($R)?>
	<div class="sbjbox">
		<a href="<?php echo $_link?>" class="subject"><?php echo $R['subject']?></a>
		<a href="<?php echo $_link?>" target="_blank"><img src="<?php echo $g['img_core']?>/_public/ico_blank.gif" alt="" title="새창으로보기" /></a>
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

	</div>

</div>
<?php endif?>
<?php endif?>
<!-- //포스트 -->



<!-- 댓글 -->
<?php if($d['search']['s_comment']):?>
<?php
$_searchsql = getSearchSql('subject|content',$keyword,$ikeyword,'or');
$RCD = getDbArray($table['s_comment'],'site='.$s.' and display=1 and d_regis > '.$d['search']['date'].$_searchsql,'*','uid','asc',$recnum,$p);
$NUM = getDbRows($table['s_comment'],'site='.$s.' and display=1 and d_regis > '.$d['search']['date'].$_searchsql);
?>
<?php if($NUM):$result=true?>
<div id="s_comment">

	<div class="subtitle">
		<div class="xleft">댓글(검색결과 <?php echo number_format($NUM)?>개)</div>
		<div class="xright"><?php if($NUM > $recnum):?><a href="<?php echo $g['url_reset']?>comment">more</a><?php endif?></div>
		<div class="clear"></div>
	</div>


	<div class="postbox">

<?php while($R=db_fetch_array($RCD)):?>
<?php $_link = getCyncUrl($R['cync'].',CMT:'.$R['uid'])?>
	<div class="sbjbox">
		<a href="<?php echo $_link?>#CMT" class="subject"><?php echo $R['subject']?></a>
		<a href="<?php echo $_link?>#CMT" target="_blank"><img src="<?php echo $g['img_core']?>/_public/ico_blank.gif" alt="" title="새창으로보기" /></a>
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
<?php endif?>
<?php endif?>
<!-- //댓글 -->



<!-- 이미지 -->
<?php if($d['search']['s_image']):?>
<?php
$_searchsql = getSearchSql('name|caption',$keyword,$ikeyword,'or');
$RCD = getDbArray($table['s_upload'],'site='.$s." and type=2 and ext='jpg' and d_regis > ".$d['search']['date'].$_searchsql,'*','gid','asc',$recnum,$p);
$NUM = getDbRows($table['s_upload'],'site='.$s." and type=2 and ext='jpg' and d_regis > ".$d['search']['date'].$_searchsql);
?>
<?php if($NUM):$result=true?>
<div id="s_image">

	<div class="subtitle">
		<div class="xleft">이미지(검색결과 <?php echo number_format($NUM)?>개)</div>
		<div class="xright"><?php if($NUM > $recnum):?><a href="<?php echo $g['url_reset']?>image">more</a><?php endif?></div>
		<div class="clear"></div>
	</div>


	<div class="imgbox">

<?php while($R=db_fetch_array($RCD)):?>
<?php $_link = getCyncUrl($R['cync'])?>

		<div class="pic">
		<div class="photo">
		<a href="<?php echo $_link?>" target="_blank"><img src="<?php echo $R['url'].$R['folder'].'/'.$R['thumbname']?>" alt="" title="<?php echo $R['caption']?$R['caption']:$R['name']?>" /></a>
		</div>
		<div class="info"><a href="<?php echo $_link?>" target="_blank"><?php echo $R['caption']?$R['caption']:$R['name']?></a></div>
		<div class="date"><?php echo getDateFormat($R['d_regis'],'Y.m.d H:i')?></div>
		</div>

<?php endwhile?> 
		<div class="clear"></div>
	</div>

</div>
<?php endif?>
<?php endif?>
<!-- //이미지 -->


<!-- 첨부파일 -->
<?php if($d['search']['s_upload']):?>
<?php
$_searchsql = getSearchSql('name|caption',$keyword,$ikeyword,'or');
$RCD = getDbArray($table['s_upload'],'site='.$s." and type<>2 and hidden=0 and d_regis > ".$d['search']['date'].$_searchsql,'*','gid','asc',$recnum,$p);
$NUM = getDbRows($table['s_upload'],'site='.$s." and type<>2 and hidden=0 and d_regis > ".$d['search']['date'].$_searchsql);
?>
<?php if($NUM):$result=true?>
<div id="s_upload">

	<div class="subtitle">
		<div class="xleft">첨부파일(검색결과 <?php echo number_format($NUM)?>개)</div>
		<div class="xright"><?php if($NUM > $recnum):?><a href="<?php echo $g['url_reset']?>upload">more</a><?php endif?></div>
		<div class="clear"></div>
	</div>


	<table summary="접속기록 리스트입니다.">
	<caption>접속기록</caption> 
	<colgroup> 
	<col> 
	<col width="100"> 
	<col width="100"> 
	<col width="120"> 
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
	<td><?php echo getDateFormat($R['d_regis'],'Y.m.d H:i')?></td>
	</tr> 
	<?php endwhile?>

	</tbody>
	</table>

</div>
<?php endif?>
<?php endif?>
<!-- //첨부파일 -->



<?php if(!$result):?>
<div id="s_result">
<img src="<?php echo $g['img_core']?>/_public/ico_notice.gif" alt="" />
검색결과가 없습니다.
</div>
<?php endif?>
