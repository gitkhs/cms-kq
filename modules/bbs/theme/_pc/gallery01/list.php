<?
	switch($d['bbs']['thumcnt']){
	case 1: $imgw=724; $imgh=369; break;
	case 2: $imgw=354; $imgh=184; break;
	case 3: $imgw=230; $imgh=167; break;
	case 4: $imgw=169; $imgh=120; break;
	case 5: $imgw=132; $imgh=100; break;
	default : $imgw=354; $imgh=184; break;
	}
?>

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

	<div class="gallery">
		<ul>
		<!-- 공지 -->
		<? if($p<=1) { ?>
		<? foreach($NCD as $R) { ?> 
		<? $R['mobile']=isMobileConnect($R['agent']); ?>
		<? $_thumbimg = getUploadImage($R['upload'],$R['d_regis'],$R['content'],$d['theme']['picimgext'],$d['bbs']['thumcnt']); ?>
		<? $_thumbimg = $_thumbimg ? $_thumbimg : $g['img_module_skin'].'/notfound-image.jpg'; ?>
		<li>
			<div class="box<? if($R['uid'] == $uid) {echo ' now';} ?>" style="width:<?=$imgw?>px; height:<?=$imgh?>px;">
				<div class="bg" style="width:<?=$imgw?>px; height:<?=$imgh?>px;"></div>
				<a href="<?=$g['bbs_view'].$R['uid']?>">
				<div class="img" style="width:<?=$imgw?>px; height:<?=$imgh?>px; background:url(<?=$_thumbimg?>) center no-repeat; background-size:cover;"></div>
				</a>
			</div>

			<? if(!$d['bbs']['hide_sbj']) { ?>
			<div class="sbj notify<? if($R['uid'] == $uid) {echo ' now';} ?>" style="max-width:<?=$imgw?>px;">
			<? if($R['mobile']) { ?><span class="mob glyphicon glyphicon-phone"></span><? } ?>
			<?=getStrCut($R['subject'],$d['bbs']['sbjcut'],'...')?>
			<? if($R['upload']) { ?><span class="file glyphicon glyphicon-paperclip"></span><? } ?>
			<? if($R['hidden']) { ?><span class="lock glyphicon glyphicon-lock"></span><? } ?>
			<? if($R['comment']) { ?><span class="comment">[<?=$R['comment']?><? if($R['oneline']) { ?>+<?echo $R['oneline']?><? } ?>]</span><? } ?>
			<? if(getNew($R['d_regis'],24)) { ?><span class="new">new</span><? } ?>
			</div>
			<? } ?>
		</li>
		<? } ?>
		<? } ?>

		<!-- 게시물 -->
		<? foreach($RCD as $R) { ?> 
		<? $R['mobile']=isMobileConnect($R['agent']); ?>
		<? $_thumbimg = getUploadImage($R['upload'],$R['d_regis'],$R['content'],$d['theme']['picimgext'],$d['bbs']['thumcnt']); ?>
		<? $_thumbimg = $_thumbimg ? $_thumbimg : $g['img_module_skin'].'/notfound-image.jpg'; ?>
		<li>
			<div class="box<? if($R['uid'] == $uid) {echo ' now';} ?>" style="width:<?=$imgw?>px; height:<?=$imgh?>px;">
				<div class="bg" style="width:<?=$imgw?>px; height:<?=$imgh?>px;"></div>
				<a href="<?=$g['bbs_view'].$R['uid']?>">
				<div class="img" style="width:<?=$imgw?>px; height:<?=$imgh?>px; background:url(<?=$_thumbimg?>) center no-repeat; background-size:cover;"></div>
				</a>
			</div>

			<? if(!$d['bbs']['hide_sbj']) { ?>
			<div class="sbj<? if($R['uid'] == $uid) {echo ' now';} ?>" style="max-width:<?=$imgw?>px;">
			<? if($R['mobile']) { ?><span class="mob glyphicon glyphicon-phone"></span><? } ?>
			<?=getStrCut($R['subject'],$d['bbs']['sbjcut'],'...')?>
			<? if($R['upload']) { ?><span class="file glyphicon glyphicon-paperclip"></span><? } ?>
			<? if($R['hidden']) { ?><span class="lock glyphicon glyphicon-lock"></span><? } ?>
			<? if($R['comment']) { ?><span class="comment">[<?=$R['comment']?><? if($R['oneline']) { ?>+<?echo $R['oneline']?><? } ?>]</span><? } ?>
			<? if(getNew($R['d_regis'],24)) { ?><span class="new">new</span><? } ?>
			</div>
			<? } ?>
		</li>
		<? } ?>
		
		</ul>
		<div class="clear"></div>
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
		<form name="bbssearchf" action="<?php echo $g['s']?>/">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="c" value="<?php echo $c?>" />
		<input type="hidden" name="m" value="<?php echo $m?>" />
		<input type="hidden" name="bid" value="<?php echo $bid?>" />
		<input type="hidden" name="cat" value="<?php echo $cat?>" />
		<input type="hidden" name="sort" value="<?php echo $sort?>" />
		<input type="hidden" name="orderby" value="<?php echo $orderby?>" />
		<input type="hidden" name="recnum" value="<?php echo $recnum?>" />
		<input type="hidden" name="type" value="<?php echo $type?>" />
		<input type="hidden" name="iframe" value="<?php echo $iframe?>" />
		<input type="hidden" name="skin" value="<?php echo $skin?>" />

		<?php if($d['theme']['search']):?>
		<select name="where">
		<option value="subject|tag"<?php if($where=='subject|tag'):?> selected="selected"<?php endif?>>제목+태그</option>
		<option value="content"<?php if($where=='content'):?> selected="selected"<?php endif?>>본문</option>
		<option value="name"<?php if($where=='name'):?> selected="selected"<?php endif?>>이름</option>
		<option value="nic"<?php if($where=='nic'):?> selected="selected"<?php endif?>>닉네임</option>
		<option value="id"<?php if($where=='id'):?> selected="selected"<?php endif?>>아이디</option>
		<option value="term"<?php if($where=='term'):?> selected="selected"<?php endif?>>등록일</option>
		</select>
		
		<input type="text" name="keyword" size="30" value="<?php echo $_keyword?>" class="input" />
		<input type="submit" value=" 검색 " class="btngray" />
		<?php endif?>
		</form>
	</div>

	<div id="modal-box" style="position:absolute; display:none;">
		<div class="bg" style="position:absolute; background-color:#000000; opacity:0.5;"></div>
		<div class="cn" style="position:absolute; width:600px;">
			<img src="/rb/modules/bbs/theme/_pc/gallery01/image/notfound-image.jpg" style="max-width:100%;">
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	var w = $('#bbslist').width();
	var h = $('#bbslist').height();
	
	$('#modal-box').css('width',w+'px');
	$('#modal-box').css('height',h+'px');
	$('#modal-box').css('margin-top','-'+h+'px');

	$('#modal-box').find('.bg').css('width',w+'px');
	$('#modal-box').find('.bg').css('height',h+'px');
});

//$(window).load(function(){
//	for(i=0;i<arimg.length;i++){
//		var top = (<?=$imgh?> - $(arimg[i]).height())/2;
//		$(arimg[i]).css('margin-top',top+'px');
//
//		if($(arimg[i]).width() > <?=$imgw?>){
//			var left = (<?=$imgw?> - $(arimg[i]).width())/2;
//			$(arimg[i]).css('margin-left',left+'px');
//		}
//	}
//});
</script>
