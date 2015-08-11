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

	<div class="info" <? if($d['bbs']['category_type']) { ?>style="border-bottom:1px solid #aaaaaa;"<? } ?>>
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

	<div class="review">
	<table class="tbl-line">
	<colgroup>
	<col width="200px"/>
	<col/>
	</colgroup>
	
	<? $imgw=180; $imgh=100; ?>
	<? if($p<=1) { ?>
	<? foreach($NCD as $R) { ?> 
	<? $R['mobile']=isMobileConnect($R['agent']); ?>
	<? $_thumbimg = getUploadImage($R['upload'],$R['d_regis'],$R['content'],$d['theme']['picimgext'],$d['bbs']['thumcnt']); ?>
	<? $_thumbimg = $_thumbimg ? $_thumbimg : $g['img_module_skin'].'/notfound-image.jpg'; ?>
	<!-- 공지 -->
	<tr class="notify">
		<td>
			<div class="box<? if($R['uid'] == $uid) {echo ' now';} ?>" style="width:<?=$imgw?>px; height:<?=$imgh?>px;">
				<div class="bg" style="width:<?=$imgw?>px; height:<?=$imgh?>px;"></div>
				<a href="<?=$g['bbs_view'].$R['uid']?>">
				<div class="img" style="width:<?=$imgw?>px; height:<?=$imgh?>px; background:url(<?=$_thumbimg?>) center no-repeat; background-size:cover;"></div>
				</a>
			</div>
		</td>
		<td>
			<a href="<?php echo $g['bbs_view'].$R['uid']?>">
			<div class="sbj <? if($R['uid'] == $uid) {echo 'now';} ?>">
			<? if($R['mobile']) { ?><span class="mob glyphicon glyphicon-phone"></span><? } ?>
			<?=getStrCut($R['subject'],$d['bbs']['sbjcut'],'...')?>
			<? if($R['upload']) { ?><span class="file glyphicon glyphicon-paperclip"></span><? } ?>
			<? if($R['hidden']) { ?><span class="lock glyphicon glyphicon-lock"></span><? } ?>
			<? if($R['comment']) { ?><span class="comment">[<?=$R['comment']?><? if($R['oneline']) { ?>+<?echo $R['oneline']?><? } ?>]</span><? } ?>
			<? if(getNew($R['d_regis'],24)) { ?><span class="new">new</span><? } ?>
			</div>
			
			<div class="con <? if($R['uid'] == $uid) {echo 'now';} ?>"><?echo getStrCut(strip_tags($R['content']),300,'')?></div>
			</a>

			<div class="inf">
				<?=$R[$_HS['nametype']]?> | 조회 : <?=$R['hit']?> | <? echo getDateFormat($R['d_regis'],$d['theme']['date_viewf'])?>
			</div>
		</td>
	</tr>
	<? } ?>
	<? } ?>

	<!-- 게시물 -->
	<? foreach($RCD as $R) { ?> 
	<? $R['mobile']=isMobileConnect($R['agent']); ?>
	<? $_thumbimg = getUploadImage($R['upload'],$R['d_regis'],$R['content'],$d['theme']['picimgext'],$d['bbs']['thumcnt']); ?>
	<? $_thumbimg = $_thumbimg ? $_thumbimg : $g['img_module_skin'].'/notfound-image.jpg'; ?>
	<tr>
		<td>
			<div class="box<? if($R['uid'] == $uid) {echo ' now';} ?>" style="width:<?=$imgw?>px; height:<?=$imgh?>px;">
				<div class="bg" style="width:<?=$imgw?>px; height:<?=$imgh?>px;"></div>
				<a href="<?=$g['bbs_view'].$R['uid']?>">
				<div class="img" style="width:<?=$imgw?>px; height:<?=$imgh?>px; background:url(<?=$_thumbimg?>) center no-repeat; background-size:cover;"></div>
				</a>
			</div>
		</td>
		<td>
			<a href="<?php echo $g['bbs_view'].$R['uid']?>">
			<div class="sbj <? if($R['uid'] == $uid) {echo 'now';} ?>">
			<? if($R['mobile']) { ?><span class="mob glyphicon glyphicon-phone"></span><? } ?>
			<?=getStrCut($R['subject'],$d['bbs']['sbjcut'],'...')?>
			<? if($R['upload']) { ?><span class="file glyphicon glyphicon-paperclip"></span><? } ?>
			<? if($R['hidden']) { ?><span class="lock glyphicon glyphicon-lock"></span><? } ?>
			<? if($R['comment']) { ?><span class="comment">[<?=$R['comment']?><? if($R['oneline']) { ?>+<?echo $R['oneline']?><? } ?>]</span><? } ?>
			<? if(getNew($R['d_regis'],24)) { ?><span class="new">new</span><? } ?>
			</div>
			
			<div class="con <? if($R['uid'] == $uid) {echo 'now';} ?>"><?echo getStrCut(strip_tags($R['content']),300,'')?></div>
			</a>

			<div class="inf">
				<?=$R[$_HS['nametype']]?> | 조회 : <?=$R['hit']?> | <? echo getDateFormat($R['d_regis'],$d['theme']['date_viewf'])?>
			</div>
		</td>
	</tr>
	<? } ?>
	
	</table>
	</div>
	
	<? if(!$NCD && !$NUM) { ?>
		<div class="clear" style="margin-top:30px;"></div>
		<div class="none">
			<div class="lo">등록된 포스트가 없습니다</div>
		</div>
	<? } ?>

	<div class="bottom">
		<div class="btnbox1">
		<?if($my['admin'] || $d['bbs']['perm_w'] <= $my['level']){ if(!($d['bbs']['lental'] == 2 && $wG['level'] < $wG['admin'])){?>
			<a href="<?=$g['bbs_write']?>" style="color:#fa6800;"><span class="glyphicon glyphicon-pencil"></span> 글쓰기</a>
		<?}}?>
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
		<option value="id"<? if($where=='id') { ?> selected="selected"<? } ?>>아이디</option>
		<option value="term"<? if($where=='term') { ?> selected="selected"<? } ?>>등록일</option>
		</select>
		
		<input type="text" name="keyword" size="30" value="<?=$_keyword?>" class="input" />
		<input type="submit" value=" 검색 " class="btngray" />
		<? } ?>
		</form>
	</div>
</div>