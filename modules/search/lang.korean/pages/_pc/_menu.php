<?php
$searchset = file($g['dir_module'].'var/search.list.txt');
$typeset = array
(
	'main'=>'통합',
	'post'=>'게시판',
	'comment'=>'댓글',
	'image'=>'이미지',
	'upload'=>'첨부파일',
);

$d['search']['date'] = date('YmdHis',mktime(0,0,0,substr($date['today'],4,2)-$d['search']['s_term'],substr($date['today'],6,2),$date['year']));
?>
<div id="pages_top">

	<div class="title">
		<div class="xl"><h2><a href="<?php echo $g['url_reset']?>main">통합검색</a></h2></div>
		<div class="xr">
		
			<ul>
			<li class="leftside"></li>
			<?php if($d['search']['s_bbs']):?><li<?php if($where=='post'):?> class=" selected"<?php endif?>><a href="<?php echo $g['url_reset']?>post">게시판</a></li><?php endif?>
			<?php if($d['search']['s_comment']):?><li<?php if($where=='comment'):?> class="selected"<?php endif?>><a href="<?php echo $g['url_reset']?>comment">댓글</a></li><?php endif?>
			<?php if($d['search']['s_image']):?><li<?php if($where=='image'):?> class="selected"<?php endif?>><a href="<?php echo $g['url_reset']?>image">이미지</a></li><?php endif?>
			<?php if($d['search']['s_upload']):?><li<?php if($where=='upload'):?> class="selected"<?php endif?>><a href="<?php echo $g['url_reset']?>upload">첨부파일</a></li><?php endif?>
			<?php if($d['search']['s_search']):?>
			<li>
			
				<div id="morebox" class="morebox">
					<ul>
					<?php foreach($searchset as $_val):?>
					<?php $_key=explode(',',trim($_val))?>
					<li><a href="<?php echo $_key[1].($keyword?urlencode($keyword):'')?>" target="_blank" onclick="morebox('morebox');"><?php echo $_key[0]?></a></li>
					<?php endforeach?>
					</ul>
				</div>
				<a onclick="morebox('morebox');">외부검색 <img src="<?php echo $g['img_core']?>/_public/ico_arr_01.gif" alt="" /></a>
				
			</li>
			<?php endif?>
			</ul>

		</div>
		<div class="clear"></div>
	</div>
	
</div>

<div id="s_msg">
	<span class="quot">&quot;</span>
	<span class="keyword"><?php echo $_keyword?></span>
	<span class="quot">&quot;</span>
	에 대한 <span class="b"><?php echo $typeset[$where]?></span> 검색결과입니다 
</div>
