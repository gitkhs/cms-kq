<div id="footer">
	<div id="searchbox" class="search">
		<form action="<?php echo $g['s']?>/">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="mod" value="search" />
		<input type="text" id="m_keyword" name="keyword" value="<?php echo $_keyword?>" class="inputx" onblur="searchBlur();" />
		<input type="image" value="검색" src="<?php echo $g['img_layout']?>/btn_search.gif" class="submit" />
		</form>
	</div>
	<div class="foot">
		<div class="btnbox">
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;a=pcmode">PC모드</a>
			<?php if($my['uid']):?>
			<a href="<?php echo RW('mod=mypage')?>">나의계정</a>
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;a=logout">로그아웃</a>
			<?php else:?>
			<a href="<?php echo RW('mod=login')?>">로그인</a>
			<a href="<?php echo RW('mod=join')?>">회원가입</a>
			<?php endif?>
			<a href="#." onclick="searchBox();">검색</a>
			<a href="#">맨위로</a>
		</div>
		<div class="link">
			<span><?php echo $_SERVER['HTTP_HOST']?> &copy; <?php echo $date['year']?></span> <i></i>
			<a href="<?php echo RW('mod=agreement')?>">이용약관</a> <i></i>
			<a href="<?php echo RW('mod=private')?>">개인정보 취급방침</a>
		</div>
	</div>
</div>
