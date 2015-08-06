<?php 
include_once $g['dir_module_skin'].'_menu.php';
$levelnum = getDbData($table['s_mbrlevel'],'gid=1','*');
$levelname= getDbData($table['s_mbrlevel'],'uid='.$my['level'],'*');
?>



<div id="mypage_main">


	<div class="photo hand" onclick="goHref('<?php echo $g['url_reset']?>&amp;page=simbol');" title="사진등록"><?php if($my['photo']):?><img src="<?php echo $g['url_root']?>/_var/simbol/<?php echo $my['photo']?>" alt="<?php echo $my['photo']?>" /><?php endif?></div>
	<div class="msg">
		이 곳은 <span class="b"><?php echo $my[$_HS['nametype']]?>님</span>을 위한 공간입니다.<br />
		<span class="info">
		회원등급 : <?php echo $levelname['name']?>(<?php echo $my['level']?>/<?php echo $levelnum['uid']?>) &nbsp; 
		포인트 : <?php echo number_format($my['point'])?> &nbsp; 
		가입일 : <?php echo getDateFormat($my['d_regis'],'Y.m.d')?> (<?php echo -getRemainDate($my['d_regis'])?>일전) - 캐릭터를 바꾸시려면 사진을 터치하세요.
		</span>
	</div>
	<div class="line clear"></div>



	<div class="postbox">


		<h5>내가 등록한 게시물</h5>
		<ul>
		<?php $_POST = getDbArray($table['bbsdata'],'site='.$s.' and mbruid='.$my['uid'],'*','gid','asc',10,1)?>
		<?php while($_R=db_fetch_array($_POST)):?>
		<?php $_R['mobile']=isMobileConnect($_R['agent'])?>
		<li>
		ㆍ<a href="<?php echo getPostLink($_R)?>"><?php echo $_R['subject']?></a>
		<?php if($_R['mobile']):?><img src="<?php echo $g['img_core']?>/_public/ico_mobile.gif" class="imgpos1" alt="모바일" title="모바일(<?php echo $_R['mobile']?>)로 등록되었습니다." /><?php endif?>
		<?php if(strstr($_R['content'],'.jpg')):?><img src="<?php echo $g['img_core']?>/_public/ico_pic.gif" class="imgpos" alt="사진" title="사진" /><?php endif?>
		<?php if($_R['upload']):?><img src="<?php echo $g['img_core']?>/_public/ico_file.gif" class="imgpos" alt="첨부파일" title="첨부파일" /><?php endif?>
		<?php if($_R['hidden']):?><img src="<?php echo $g['img_core']?>/_public/ico_hidden.gif" class="imgpos" alt="비밀글" title="비밀글" /><?php endif?>
		<?php if($_R['comment']):?><span class="comment">[<?php echo $_R['comment']?><?php if($_R['oneline']):?>+<?php echo $_R['oneline']?><?php endif?>]</span><?php endif?>
		<?php if($_R['trackback']):?><span class="trackback">[<?php echo $_R['trackback']?>]</span><?php endif?>
		<?php if(getNew($_R['d_regis'],24)):?><span class="new">new</span><?php endif?>
		</li>
		<?php endwhile?>
		<?php if(!db_num_rows($_POST)):?>
		<li class="none">등록된 게시물이 없습니다.</li>
		<?php endif?>
		</ul>

		<h5>내가 등록한 댓글</h5>
		<ul>
		<?php $_POST = getDbArray($table['s_comment'],'site='.$s.' and mbruid='.$my['uid'],'*','uid','asc',10,1)?>
		<?php while($_R=db_fetch_array($_POST)):?>
		<?php $_R['mobile']=isMobileConnect($_R['agent'])?>
		<li>
		ㆍ<a href="<?php echo getCyncUrl($_R['cync'].',CMT:'.$_R['uid'])?>#CMT"><?php echo $_R['subject']?></a>
		<?php if($_R['mobile']):?><img src="<?php echo $g['img_core']?>/_public/ico_mobile.gif" class="imgpos1" alt="모바일" title="모바일(<?php echo $_R['mobile']?>)로 등록되었습니다." /><?php endif?>
		<?php if(strstr($_R['content'],'.jpg')):?><img src="<?php echo $g['img_core']?>/_public/ico_pic.gif" class="imgpos" alt="사진" title="사진" /><?php endif?>
		<?php if($_R['upload']):?><img src="<?php echo $g['img_core']?>/_public/ico_file.gif" class="imgpos" alt="첨부파일" title="첨부파일" /><?php endif?>
		<?php if($_R['hidden']):?><img src="<?php echo $g['img_core']?>/_public/ico_hidden.gif" class="imgpos" alt="비밀글" title="비밀글" /><?php endif?>
		<?php if($_R['oneline']):?><span class="comment">[<?php echo $_R['oneline']?>]</span><?php endif?>
		<?php if(getNew($_R['d_regis'],24)):?><span class="new">new</span><?php endif?>
		</li>
		<?php endwhile?>
		<?php if(!db_num_rows($_POST)):?>
		<li class="none">등록된 댓글이 없습니다.</li>
		<?php endif?>
		</ul>




		<h5>내 게시물에 달린 댓글</h5>
		<ul>
		<?php $_POST = getDbArray($table['s_comment'],'site='.$s.' and parentmbr='.$my['uid'].' and mbruid<>'.$my['uid'],'*','uid','asc',10,1)?>
		<?php while($_R=db_fetch_array($_POST)):?>
		<?php $_R['mobile']=isMobileConnect($_R['agent'])?>
		<li>
		ㆍ<a href="<?php echo getCyncUrl($_R['cync'].',CMT:'.$_R['uid'])?>#CMT"><?php echo $_R['subject']?></a>
		<?php if($_R['mobile']):?><img src="<?php echo $g['img_core']?>/_public/ico_mobile.gif" class="imgpos1" alt="모바일" title="모바일(<?php echo $_R['mobile']?>)로 등록되었습니다." /><?php endif?>
		<?php if(strstr($_R['content'],'.jpg')):?><img src="<?php echo $g['img_core']?>/_public/ico_pic.gif" class="imgpos" alt="사진" title="사진" /><?php endif?>
		<?php if($_R['upload']):?><img src="<?php echo $g['img_core']?>/_public/ico_file.gif" class="imgpos" alt="첨부파일" title="첨부파일" /><?php endif?>
		<?php if($_R['hidden']):?><img src="<?php echo $g['img_core']?>/_public/ico_hidden.gif" class="imgpos" alt="비밀글" title="비밀글" /><?php endif?>
		<?php if($_R['oneline']):?><span class="comment">[<?php echo $_R['oneline']?>]</span><?php endif?>
		<?php if(getNew($_R['d_regis'],24)):?><span class="new">new</span><?php endif?>
		</li>
		<?php endwhile?>
		<?php if(!db_num_rows($_POST)):?>
		<li class="none">등록된 댓글이 없습니다.</li>
		<?php endif?>
		</ul>


		<h5>내 댓글에 달린 한줄의견</h5>
		<ul>
		<?php $_POST = getDbArray($table['s_oneline'],'site='.$s.' and parentmbr='.$my['uid'].' and mbruid<>'.$my['uid'],'*','uid','desc',10,1)?>
		<?php while($_O=db_fetch_array($_POST)):?>
		<?php $_R=getUidData($table['s_comment'],$_O['parent'])?>
		<?php $_O['mobile']=isMobileConnect($_O['agent'])?>
		<li>
		ㆍ<a href="<?php echo getCyncUrl($_R['cync'].',CMT:'.$_R['uid'])?>#CMT"><?php echo $_O['content']?></a>
		<?php if($_O['mobile']):?><img src="<?php echo $g['img_core']?>/_public/ico_mobile.gif" class="imgpos1" alt="모바일" title="모바일(<?php echo $_O['mobile']?>)로 등록되었습니다." /><?php endif?>
		<?php if(getNew($_O['d_regis'],24)):?><span class="new">new</span><?php endif?>
		</li>
		<?php endwhile?>
		<?php if(!db_num_rows($_POST)):?>
		<li class="none">등록된 한줄의견이 없습니다.</li>
		<?php endif?>
		</ul>

	</div>
	




</div>



