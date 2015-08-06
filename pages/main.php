<?
	include_once $g['path_core'].'com/social/naverapi.php';
	//$news1	= sendNaverSearch('부동산 모텔', 'news', 1);
	//$news2	= sendNaverSearch('부동산 숙박', 'news', 1);
?>
<style>
.news {padding:5px 0px 20px 0px;}
.news .title {padding:2px; font-size:1.3em; font-weight:bold;}
.news .title a {text-decoration:underline; color:#00c;}
.news .title .date {margin-left:20px; font-size:10pt; font-weight:normal; color:#888888;}
.news .desc {font-size:12pt; line-height:140%;}
.news .link a {color:#218d44 !important;}
</style>

<div class="wrap">
<?foreach($news1 as $_R) {?>
	<div class="news">
	<div class="title"><a href="<?=$_R->originallink?>" target="_blank"><?=$_R->title?></a> <span class="date"><?=date("Y.m.d", strtotime($_R->pubDate))?></span></div>
	<div class="desc"><? $desc=str_replace('<b>','',$_R->description); $desc=str_replace('<b>','',$desc); echo $desc;?></div>
	<div class="link"><a href="<?=$_R->originallink?>" target="_blank"><?=$_R->originallink?></a></div>
	</div>
<?}?>
<?foreach($news2 as $_R) {?>
	<div class="news">
	<div class="title"><a href="<?=$_R->originallink?>" target="_blank"><?=$_R->title?></a> <span class="date"><?=date("Y.m.d", strtotime($_R->pubDate))?></span></div>
	<div class="desc"><? $desc=str_replace('<b>','',$_R->description); $desc=str_replace('<b>','',$desc); echo $desc;?></div>
	<div class="link"><a href="<?=$_R->originallink?>" target="_blank"><?=$_R->originallink?></a></div>
	</div>
<?}?>
</div>

<div class="wrap">
<div id="mcon">
	<div class="bx-lt r1"><input type="button" value="play" onclick="goHref('<?=$g['s']?>/?c=1');"></div>
	<div class="bx-lt r2"></div>

	<div class="bx-md1 tl"></div>
	<div class="bx-md1 tr"></div>
	<div class="bx-md1 bl"></div>
	<div class="bx-md1 br"></div>

	<div class="bx-md2 r2"></div>

	<div class="bx-rt r1"></div>
	<div class="bx-rt r2"></div>
</div>
</div>