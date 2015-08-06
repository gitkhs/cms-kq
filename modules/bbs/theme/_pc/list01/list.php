<div id="bbslist">
	<? if($mod=='list') { ?><div class="subject"><?=$_HM['name']?></div><? } ?>

	<? if($my['level'] >= $admin['admin'] && $mod=='list') { ?>
	<div class="admin">
		<form name="frmAdmin" method="post" action="<?=$g['s']?>/" target="_action_frame_<?=$m?>" enctype="multipart/form-data">
		<input type="hidden" name="r" value="<?=$r?>" />
		<input type="hidden" name="m" value="<?=$m?>" />
		<input type="hidden" name="a" value="bbspush" />
		<input type="hidden" name="bbsid" value="<?=$B['id']?>" />
		<input type="hidden" name="cmd" value="" />
		
		<table class="tbl-form">
		<colgroup>
		<col width="120">
		<col>
		</colgroup>
		<tr>
			<td class="lbl">이메일</td>
			<td>
				<input type="text" name="email" size="60" value="<?=$d['bbs']['email']?>">
				<input type="submit" class="btngray" value=" 적용 ">
				<div class="row">게시물 등록시 받을 이메일 주소입력(다수메일등록시 콤마(,)로 구분)</div>
			</td>
		</tr>
		<tr>
			<td class="lbl">게시판 백업</td>
			<td>
				<span>게시판 내용을 엑셀로 받습니다.</span>
				<input type="button" class="btngray" value="내용백업" onclick="{$('input[name=a]').val('bbsbackup');$('form[name=frmAdmin]').submit();}">
			</td>
		</tr>
		<tr>
			<td class="lbl">게시판 업로드</td>
			<td>
				<input type="file" name="upData">
				<input type="button" class="btngray" value="내용업로드" onclick="{$('input[name=a]').val('bbsupload');$('form[name=frmAdmin]').submit();}">
			</td>
		</tr>
		</table>

		</form>
	</div>
	<? } ?>

	<div class="info">
	<? if($B['category']) $_catexp = explode(',',$B['category']); $_catnum = count($_catexp); ?>
	<? if($d['bbs']['category_type']) { ?>
		<div class="article tab">
			<? if($admin['admin'] <= $my['lelvel'] || $d['bbs']['perm_w'] <= $my['level']) { ?>
				<span class="write">
				<a href="<?=$g['bbs_write']?>" style="color:#fa6800;"><span class="glyphicon glyphicon-pencil"></span> 글쓰기</a>
				</span>
			<? } ?>
			<? echo number_format($NUM+count($NCD)) ?>개(<?=$p?>/<?=$TPG?>페이지)
			<? if($d['bbs']['rss']) { ?><a href="<?=$g['r']?>/?m=<?=$m?>&amp;bid=<?=$B['id']?>&amp;mod=rss" target="_blank"><img src="<?=$g['img_core']?>/_public/ico_rss.gif" alt="rss" /></a><? } ?>
		</div>
		
		<? if($B['category']) { ?>
		<div class="category tab">
		<ul>
			<li class="f <?if(!$cat) echo 'on';?>"><a href="#" onclick="{document.bbssearchf.cat.value='';document.bbssearchf.submit();}"><?=$_catexp[0]?></a></li>
			<? for($i = 1; $i < $_catnum; $i++) { if(!$_catexp[$i])continue; ?>
			<li class="<?if($cat == $_catexp[$i]) echo 'on';?>"><a href="#" onclick="{document.bbssearchf.cat.value='<?=$_catexp[$i]?>';document.bbssearchf.submit();}"><?=$_catexp[$i]?></a></li>
			<? } ?>
		</ul>
		</div>
		<? } ?>
	<? }else{ ?>
		<div class="article">
			<? if($admin['admin'] <= $my['lelvel'] || $d['bbs']['perm_w'] <= $my['level']) { ?>
				<span class="write">
				<a href="<?=$g['bbs_write']?>" style="color:#fa6800;"><span class="glyphicon glyphicon-pencil"></span> 글쓰기</a>
				</span>
			<? } ?>
			<?php echo number_format($NUM+count($NCD))?>개(<?php echo $p?>/<?php echo $TPG?>페이지)
			<?php if($d['bbs']['rss']):?><a href="<?php echo $g['r']?>/?m=<?php echo $m?>&amp;bid=<?php echo $B['id']?>&amp;mod=rss" target="_blank"><img src="<?php echo $g['img_core']?>/_public/ico_rss.gif" alt="rss" /></a><?php endif?>
		</div>
		
		<? if($B['category']) { ?>
		<div class="category sel">
			<select onchange="document.bbssearchf.cat.value=this.value;document.bbssearchf.submit();">
			<option value="">&nbsp;+ <?php echo $_catexp[0]?></option>
			<option value="" class="sline">-------------------</option>
			<? for($i = 1; $i < $_catnum; $i++) { if(!$_catexp[$i]) continue; ?>
			<option value="<?php echo $_catexp[$i]?>"<?php if($_catexp[$i]==$cat):?> selected="selected"<?php endif?>>ㆍ<?php echo $_catexp[$i]?><?php if($d['theme']['show_catnum']):?>(<?php echo getDbRows($table[$m.'data'],'site='.$s.' and notice=0 and bbs='.$B['uid']." and category='".$_catexp[$i]."'")?>)<?php endif?></option>
			<? } ?>
			</select>
		</div>
		<? } ?>
	<? } ?>
		<div class="clear"></div>
	</div>
	
	<table class="<? echo $d['bbs']['lst_type'] ? $d['bbs']['lst_type'] : 'tbl-line' ?>">
	<colgroup> 
	<col width="50"> 
	<col> 
	<col width="100"> 
	<col width="70"> 
	<col width="90"> 
	</colgroup> 

	<thead>
	<tr>
		<td class="th">번호</th>
		<td class="th"><?=$d['bbs']['lst_sbj'] ? $d['bbs']['lst_sbj'] : '제 목'?></th>
		<? if(!$d['bbs']['hideuser']) { ?>
		<td class="th"><?=$d['bbs']['lst_mbr'] ? $d['bbs']['lst_mbr'] : '작성자'?></th>
		<td class="th">조회</th>
		<? } ?>
		<td class="th">작성일</th>
	</tr>
	</thead>

	<!-- 공지 -->
	<? foreach($NCD as $R) { ?> 
	<? $R['mobile']=isMobileConnect($R['agent']); ?>
	<tr class="notify">
	<td>
		<? if($R['uid'] != $uid) { ?>
		공지
		<? } else { ?>
		<span class="now glyphicon glyphicon-forward"></span>
		<? } ?>
	</td>
	<td class="sbj">
		<a href="<?=$g['bbs_view'].$R['uid']?>">
		<? if($R['category']) { ?><span class="cat">[<?=$R['category']?>]</span><? } ?>
		<?=getStrCut($R['subject'],$d['bbs']['sbjcut'],'...')?>
		</a>
		<? if(getNew($R['d_regis'],24)) { ?><span class="new">new</span><? } ?>
	</td>
	<? if(!$d['bbs']['hideuser']) { ?>
	<td><span class="hand" onclick="getMemberLayer('<?=$R['mbruid']?>',event);"><?=$R[$_HS['nametype']]?></span></td>
	<td><?=$R['hit']?></td>
	<? } ?>
	<td><? echo getDateFormat($R['d_regis'],$d['theme']['date_viewf']); ?></td>
	</tr>
	<? } ?>
	
	<!-- 게시물 -->
	<? foreach($RCD as $R) { ?>
	<? $R['mobile']=isMobileConnect($R['agent']); ?>
	<tr>
	<td>
		<? if($R['uid'] != $uid) { ?>
		<? echo $NUM-((($p-1)*$recnum)+$_rec++); ?>
		<? }else { $_rec++; ?>
		<span class="now glyphicon glyphicon-forward"></span>
		<? } ?>
	</td>
	<td class="sbj">
		<? if($R['depth']) { ?><img src="<?=$g['img_core']?>/blank.gif" width="<?=($R['depth']-1)*13?>" height="1"><span class="dep glyphicon glyphicon-arrow-right"></span><? } ?>
		<? if($R['mobile']) { ?><span class="mob glyphicon glyphicon-phone"></span><? } ?>

		<a href="<?=$g['bbs_view'].$R['uid']?>">
		<? if($R['category']) { ?><span class="cat">[<?=$R['category']?>]</span><? } ?>
		<?=getStrCut($R['subject'],$d['bbs']['sbjcut'],'...')?>
		</a>

		<? if(strstr($R['content'],'.jpg')) { ?><span class="pic glyphicon glyphicon-picture"></span><? } ?>
		<? if($R['upload']) { ?><span class="file glyphicon glyphicon-paperclip"></span><? } ?>
		<? if($R['hidden']) { ?><span class="lock glyphicon glyphicon-lock"></span><? } ?>
		<? if($R['comment']) { ?><span class="comment">[<?=$R['comment']?><? if($R['oneline']) { ?>+<?echo $R['oneline']?><? } ?>]</span><? } ?>
		<? if(getNew($R['d_regis'],24)) { ?><span class="new">new</span><? } ?>
	</td>
	<? if(!$d['bbs']['hideuser']) { ?>
	<td><span class="hand" onclick="getMemberLayer('<?=$R['mbruid']?>',event);"><?=$R[$_HS['nametype']]?></span></td>
	<td><?=$R['hit']?></td>
	<? } ?>
	<td><? echo getDateFormat($R['d_regis'],$d['theme']['date_viewf']); ?></td>
	</tr> 
	<? } ?>


	<? if(!$NCD && !$NUM) { ?>
	<tr>
		<td>1</td>
		<td class="sbj">게시물이 없습니다.</td>
		<? if(!$d['bbs']['hideuser']) { ?>
		<td class="name">-</td>
		<td class="hit b">-</td>
		<? } ?>
		<td><? echo getDateFormat($date['totime'],$d['theme']['date_viewf']); ?></td>
	</tr> 
	<? } ?>
	
	</table>

	<div class="bottom">
		<div class="btnbox1">
		<? if($admin['admin'] <= $my['lelvel'] || $d['bbs']['perm_w'] <= $my['level']) { ?>
			<a href="<?=$g['bbs_write']?>" style="color:#fa6800;"><span class="glyphicon glyphicon-pencil"></span> 글쓰기</a>
		<? } ?>
		</div>
		<div class="btnbox2">
			<a href="<?=$g['bbs_reset']?>" style="color:#4390df;"><span class="glyphicon glyphicon-list"></span> 처음목록</a>
			<span class="dv">|</span>
			<a href="<?=$g['bbs_list']?>" style="color:#4390df;"><span class="glyphicon glyphicon-refresh"></span> 새로고침</a>
		</div>
		<div class="clear"></div>
		<div class="pagebox01">
		<?php echo getPageLink($d['theme']['pagenum'],$p,$TPG,$g['img_core'].'/page/default')?>
		</div>
	</div>

	<div class="searchform">
		<form name="bbssearchf" action="<?=$g['s']?>/">
		<input type="hidden" name="r" value="<?=$r?>" />
		<input type="hidden" name="c" value="<?=$c?>" />
		<input type="hidden" name="m" value="<?=$m?>" />
		<input type="hidden" name="bid" value="<?=$bid?>" />
		<input type="hidden" name="cat" value="<?=$cat?>" />
		<input type="hidden" name="sort" value="<?=$sort?>" />
		<input type="hidden" name="orderby" value="<?=$orderby?>" />
		<input type="hidden" name="recnum" value="<?=$recnum?>" />
		<input type="hidden" name="type" value="<?=$type?>" />
		<input type="hidden" name="iframe" value="<?=$iframe?>" />
		<input type="hidden" name="skin" value="<?=$skin?>" />

		<? if($d['theme']['search']) { ?>
		<select name="where">
		<option value="subject|tag"<? if($where=='subject|tag') { ?> selected="selected"<? } ?>>제목+태그</option>
		<option value="content"<? if($where=='content') { ?> selected="selected"<? } ?>>본문</option>
		<option value="name"<? if($where=='name') { ?> selected="selected"<? } ?>>이름</option>
		<option value="nic"<? if($where=='nic') { ?> selected="selected"<? } ?>>닉네임</option>
		</select>
		
		<input type="text" name="keyword" size="30" value="<?=$_keyword?>" class="input" />
		<input type="submit" value=" 검색 " class="btngray" />
		<? } ?>
		</form>
	</div>
</div>