
<div id="pages_top">

	<div class="title">
		<div class="xl"><h2><a href="<?php echo $g['url_reset']?>">마이페이지</a></h2></div>
		<div class="xr">
		
			<ul>
			<li class="leftside"></li>
			<?php if($d['member']['mytab_post']):?><li<?php if($page=='post'):?> class="selected"<?php endif?>><a href="<?php echo $g['url_reset']?>&amp;page=post">게시물</a></li><?php endif?>
			<?php if($d['member']['mytab_comment']):?><li<?php if($page=='comment'):?> class="selected"<?php endif?>><a href="<?php echo $g['url_reset']?>&amp;page=comment">댓글</a></li><?php endif?>
			<?php if($d['member']['mytab_oneline']):?><li<?php if($page=='oneline'):?> class="selected"<?php endif?>><a href="<?php echo $g['url_reset']?>&amp;page=oneline">한줄의견</a></li><?php endif?>
			<?php if($d['member']['mytab_simbol']):?><li<?php if($page=='simbol'):?> class="selected"<?php endif?>><a href="<?php echo $g['url_reset']?>&amp;page=simbol">캐릭터</a></li><?php endif?>
			<?php if($d['member']['mytab_scrap']):?><li<?php if($page=='scrap'):?> class="selected"<?php endif?>><a href="<?php echo $g['url_reset']?>&amp;page=scrap">스크랩</a></li><?php endif?>
			<?php if($d['member']['mytab_paper']):?><li<?php if($page=='paper'):?> class="selected"<?php endif?>><a href="<?php echo $g['url_reset']?>&amp;page=paper">쪽지</a></li><?php endif?>
			<?php if($d['member']['mytab_friend']):?><li<?php if($page=='friend'):?> class="selected"<?php endif?>><a href="<?php echo $g['url_reset']?>&amp;page=friend">친구</a></li><?php endif?>
			<?php if($d['member']['mytab_point']):?><li<?php if($page=='point'):?> class="selected"<?php endif?>><a href="<?php echo $g['url_reset']?>&amp;page=point">포인트</a></li><?php endif?>
			<?php if($d['member']['mytab_log']):?><li<?php if($page=='log'):?> class="selected"<?php endif?>><a href="<?php echo $g['url_reset']?>&amp;page=log">접속기록</a></li><?php endif?>
			<li>
				<div id="morebox" class="morebox">
					<ul>
					<?php if($d['member']['mytab_info']):?><li><a href="<?php echo $g['url_reset']?>&amp;page=info">정보수정</a></li><?php endif?>
					<?php if($d['member']['mytab_pw']):?><li><a href="<?php echo $g['url_reset']?>&amp;page=pw">비번변경</a></li><?php endif?>
					<?php if($d['member']['mytab_out']):?><li><a href="<?php echo $g['url_reset']?>&amp;page=out">회원탈퇴</a></li><?php endif?>
					</ul>
				</div>
				<a onclick="morebox('morebox');">회원정보 <img src="<?php echo $g['img_core']?>/_public/ico_arr_01.gif" alt="" /></a>
			</li>
			</ul>

		</div>
		<div class="clear"></div>
	</div>
	
</div>

