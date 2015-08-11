

<div id="cview">

	<div class="box">

		<div class="icon hand" onclick="getMemberLayer('<?php echo $R['mbruid']?>',event);"><?php if($g['member']['photo']):?><img src="<?php echo $g['url_root']?>/_var/simbol/<?php echo $g['member']['photo']?>" alt="" /><?php endif?></div>

		<div class="subject">
			<a name="CMT<?php echo $R['uid']?>"><?php echo $R['subject']?></a>
		</div>
		<div class="info">
			<div class="xleft">
				<span class="han"><?php echo $R[$_HS['nametype']]?></span> <span class="split">|</span> 
				<?php echo getDateFormat($R['d_regis'],'Y.m.d H:i')?> <span class="split">|</span> 
				<span class="han">조회</span> <span class="num"><?php echo $R['hit']?></span> <span class="split">|</span> 
				<span class="han">공감</span> <span class="num"><?php echo $R['score1']?></span> <span class="split">|</span> 
				<span class="han">비공감</span> <span class="num"><?php echo $R['score2']?></span>
			</div>
			<div class="xright">
				<a href="<?php echo $g['cment_action']?>scrap&amp;uid=<?php echo $R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return isLogin();"><img src="<?php echo $g['img_core']?>/_public/b_scrap.gif" alt="스크랩" title="스크랩" />스크랩</a>
				<a href="<?php echo $g['cment_modify'].$R['uid']?>" onclick="return cmentModify('<?php echo $R['id']?>',event);"><img src="<?php echo $g['img_module_skin']?>/btn_modify.gif" alt="수정" title="수정" />수정</a>
				<a href="<?php echo $g['cment_delete'].$R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return cmentDel('<?php echo $R['id']?>',event);"><img src="<?php echo $g['img_module_skin']?>/btn_delete.gif" alt="삭제" title="삭제" />삭제</a>
				<a href="<?php echo $g['cment_action']?>singo&amp;uid=<?php echo $R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 신고하시겠습니까?   ');"><img src="<?php echo $g['img_module_skin']?>/btn_cop.gif" alt="신고" title="신고" />신고</a>
			</div>
			<div class="clear"></div>
		</div>
		<div id="vContent" class="content">
			<?php echo getContents($R['content'],$R['html'])?>
		</div>
		<div class="scorebtn">
			<a href="<?php echo $g['cment_action']?>score&amp;value=good&amp;uid=<?php echo $R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 평가하시겠습니까?');"><img src="<?php echo $g['img_module_skin']?>/btn_s_1.gif" alt="공감" /></a>
			<a href="<?php echo $g['cment_action']?>score&amp;value=bad&amp;uid=<?php echo $R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 평가하시겠습니까?');"><img src="<?php echo $g['img_module_skin']?>/btn_s_2.gif" alt="비공감" /></a>

			<?php if($d['upload']['data']):?>
			<div class="attach">
			<ul>
			<?php foreach($d['upload']['data'] as $_u):?>
			<?php if($_u['hidden'])continue?>
			<li>
				<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=upload&amp;a=download&amp;uid=<?php echo $_u['uid']?>" title="<?php echo $_u['caption']?>"><?php echo $_u['name']?></a>
				<span class="size">(<?php echo getSizeFormat($_u['size'],1)?>)</span>
				<span class="down">(<?php echo number_format($_u['down'])?>)</span>
			</li>
			<?php endforeach?>
			</ul>
			</div>
			<?php endif?>

		</div>
		
		<div class="ttone">
			한줄의견 <?php echo $R['oneline']?>개
		</div>

		<div class="onebox">
			
			<?php foreach($OCD as $O):?>
			<?php $O['mobile']=isMobileConnect($O['agent'])?>
			<?php $g['member']=getDbData($table['s_mbrdata'],'memberuid='.$O['mbruid'],'*')?>



			<div class="oneline<?php if($R['oneline']==++$_oi):?> none<?php endif?>">
				<div class="name">
					<div class="icon hand" onclick="getMemberLayer('<?php echo $O['mbruid']?>',event);"><?php if($g['member']['photo']):?><img src="<?php echo $g['url_root']?>/_var/simbol/<?php echo $g['member']['photo']?>" alt="" /><?php endif?></div>
				</div>
				<div class="cont">
					<?php echo getContents($O['content'],$O['html'])?>
					<div>
					<?php if($O['mobile']):?><img src="<?php echo $g['img_core']?>/_public/ico_mobile.gif" class="imgpos" alt="모바일" title="모바일(<?php echo $O['mobile']?>)로 등록된 글입니다" /><?php endif?>
					<?php echo $O[$_HS['nametype']]?> | <?php echo getDateFormat($O['d_regis'],'Y.m.d H:i')?>
					<?php if(getNew($O['d_regis'],24)):?><span class="new">new</span><?php endif?>
					<a href="<?php echo $g['cment_odelete'].$O['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return oneDel('<?php echo $O['id']?>');"><img src="<?php echo $g['img_module_skin']?>/btn_delete_one.gif" alt="삭제" title="삭제" /></a>
					<a href="<?php echo $g['cment_action']?>singo_oneline&amp;uid=<?php echo $O['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 신고하시겠습니까?   ');"><img src="<?php echo $g['img_module_skin']?>/btn_cop_one.gif" alt="신고" title="신고" /></a>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<?php endforeach?>

			<div class="wbox">

				<form name="writeForm" method="post" action="<?php echo $g['s']?>/" target="_action_frame_<?php echo $m?>" onsubmit="return oneCheck(this);">
				<input type="hidden" name="r" value="<?php echo $r?>" />
				<input type="hidden" name="a" value="oneline_write" />
				<input type="hidden" name="m" value="<?php echo $m?>" />
				<input type="hidden" name="parent" value="<?php echo $R['uid']?>" />
				<input type="hidden" name="hidden" value="<?php echo $R['hidden']?>" />
				<input type="hidden" name="c" value="<?php echo $c?>" />
				<input type="hidden" name="iframe" value="<?php echo $iframe?>" />

				<table>
				<tr>
				<td width="100%"><textarea name="content" id="oneline_comment"><?php if(!$my['uid']):?>로그인하셔야 이용하실 수 있습니다.<?php endif?></textarea></td>
				<td valign="bottom"><input type="image" src="<?php echo $g['img_module_skin']?>/btn_onewrite.gif" alt="등록" /></td>
				</tr>
				</table>

				</form>

				<div id="oneline_comment_str" class="boxresize" onclick="oneline_comment_flag();">입력상자 늘리기</div>

			</div>
		</div>

	</div>
</div>






<div id="pwbox">
	<div id="chkbox">

		<div class="msg">
			<h3><img src="<?php echo $g['img_core']?>/_public/ico_notice.gif" alt="" /> 비밀번호 확인</h3>
			<div>댓글 등록시에 입력했던 비밀번호를 입력해 주세요.</div>
		</div>

		<form name="checkForm" method="post" action="<?php echo $g['s']?>/" onsubmit="return permCheck(this);">
		<input type="hidden" name="a" value="" />
		<input type="hidden" name="type" value="" />
		<input type="hidden" name="c" value="<?php echo $c?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="skin" value="<?php echo $skin?>" />
		<input type="hidden" name="iframe" value="<?php echo $iframe?>" />
		<input type="hidden" name="p" value="<?php echo $p?>" />
		<input type="hidden" name="sort" value="<?php echo $sort?>" />
		<input type="hidden" name="orderby" value="<?php echo $orderby?>" />
		<input type="hidden" name="recnum" value="<?php echo $recnum?>" />		
		<input type="hidden" name="where" value="<?php echo $where?>" />
		<input type="hidden" name="keyword" value="<?php echo $_keyword?>" />
		<input type="hidden" name="uid" value="<?php echo $R['uid']?>" />

		<div class="ibox">
			<input type="password" name="pw" class="input" />
			<input type="submit" value=" 확인 " class="btnblue" />
			<input type="button" value=" 취소 " class="btngray" onclick="cmentDelClose();" />
		</div>

		</form>
	</div>
</div>

