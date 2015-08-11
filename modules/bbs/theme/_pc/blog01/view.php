<?php include_once $g['dir_module'].'lang.'.$_HS['lang'].'/mod/_list.php'?>

<div id="bbsview">
	<div class="subject"><?=$_HM['name']?></div>

	<div class="viewbox">

		<div class="icon hand" onclick="getMemberLayer('<?php echo $R['mbruid']?>',event);"><?php if($g['member']['photo']):?><img src="<?php echo $g['url_root']?>/_var/simbol/<?php echo $g['member']['photo']?>" alt="" /><?php endif?></div>

		<div class="subject">
			<h1><?php echo $R['subject']?></h1>
		</div>
		<div class="info">
			<div class="xleft">
				<span class="han"><?php echo $R[$_HS['nametype']]?></span> <span class="split">|</span> 
				<?php echo getDateFormat($R['d_regis'],$d['theme']['date_viewf'])?> <span class="split">|</span> 
				<span class="han">조회</span> <span class="num"><?php echo $R['hit']?></span> 
				<?php if($d['theme']['show_score1']):?><span class="split">|</span> <span class="han">공감</span> <span class="num"><?php echo $R['score1']?></span> <?php endif?>
				<?php if($d['theme']['show_score2']):?><span class="split">|</span> <span class="han">비공감</span> <span class="num"><?php echo $R['score2']?></span> <?php endif?>
			</div>
			<div class="xright">
				<ul>
				<? if($d['bbs']['perm_w'] <= $my['level']) { ?>
					<li class="g"><a href="<?=$g['bbs_write']?>" style="color:#fa6800;"><span class="glyphicon glyphicon-pencil"></span> 글쓰기</a></li>
					<li class="g"><a href="<?php echo $g['bbs_modify'].$R['uid']?>" style="color:#fa6800;"><span class="glyphicon glyphicon-edit"></span> 수정</a></li>
					<? if($d['theme']['use_reply']) { ?><li class="g"><a href="<?php echo $g['bbs_reply'].$R['uid']?>" style="color:#008287;"><span class="glyphicon glyphicon-share"></span> 답변</a></li><? } ?>
					<li class="g"><a href="<?php echo $g['bbs_delete'].$R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?');" style="color:#9a1616;"><span class="glyphicon glyphicon-trash"></span> 삭제</a></li>
				<? } ?>
				<? if($d['upload']['count']) { ?><li class="g"><a href="#" onclick="showFileList(); return false;"><span class="glyphicon glyphicon-paperclip"></span> 첨부파일</a></li><? } ?>
				<? if($d['theme']['use_print']) { ?>
					<li class="g"><a href="javascript:printWindow('<?php echo $g['bbs_print'].$R['uid']?>');"><span class="glyphicon glyphicon-print"></span> 인쇄</a></li>
				<? } ?>
				<? if($d['theme']['use_scrap']) { ?>
					<li class="g"><a href="<?php echo $g['bbs_action']?>scrap&amp;uid=<?php echo $R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return isLogin();"><span class="glyphicon glyphicon-link"></span> 스크랩</a></li>
				<? } ?>
				<? if($d['theme']['use_font']) { ?>
					<li><div id="fontface"></div><img src="<?php echo $g['img_core']?>/_public/b_font.gif" alt="글꼴" title="글꼴" class="hand" onclick="fontFace('vContent','fontface');" /></li>
					<li><img src="<?php echo $g['img_core']?>/_public/b_plus.gif" alt="확대" title="확대" class="hand" onclick="fontResize('vContent','+');"/></li>
					<li><img src="<?php echo $g['img_core']?>/_public/b_minus.gif" alt="축소" title="축소" class="hand" onclick="fontResize('vContent','-');" /></li>
				<? } ?>
				</ul>
			</div>
			<div class="clear"></div>
		</div>


		<div id="vContent" class="content">
		<? if($d['upload']['data'] && $d['theme']['show_upfile']) { ?>
			<div id="file_list">
			<ul>
			<? foreach($d['upload']['data'] as $_u) { ?>
			<? if($_u['hidden'])continue; ?>
				<li>
					<a href="<?=$g['s']?>/?r=<?=$r?>&amp;m=upload&amp;a=download&amp;uid=<?=$_u['uid']?>" title="<?=$_u['caption']?>">
					<span class="glyphicon glyphicon-floppy-save"></span> <?=$_u['name']?>
					<span class="size">(<?=getSizeFormat($_u['size'],1)?>)</span>
					</a>
				</li>
			<? } ?>
			</ul>
			<div class="clear"></div>
			</div>
		<? } ?>

		<?if($R['adddata'] && ($my['admin'] || $my['level'] >= $admin['admin'])){?>
		<div class="adddata">
			<table class="tbl-line">
			<colgroup>
			<col width="150"/>
			<col/>
			</colgroup>
			<?$adddata = explode("|",$R['adddata']);?>
			<?foreach($adddata as $_T){?>
				<?$itm = explode(":",$_T);?>
				<tr>
					<td class="lbl"><?=$itm[0]?></td>
					<td><?=$itm[1]?></td>
				</tr>
			<?}?>
			</table>
		</div>
		<?}?>

			<? echo $R['content'] ?>
			<div class="clear"></div>

			<?php if($d['theme']['show_score1']||$d['theme']['show_score2']):?>
			<div class="scorebox">
			<?php if($d['theme']['show_score1']):?>
			<a href="<?php echo $g['bbs_action']?>score&amp;value=good&amp;uid=<?php echo $R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 평가하시겠습니까?');"><img src="<?php echo $g['img_module_skin']?>/btn_s_1.gif" alt="공감" /></a> 
			<?php endif?>
			<?php if($d['theme']['show_score2']):?>
			<a href="<?php echo $g['bbs_action']?>score&amp;value=bad&amp;uid=<?php echo $R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 평가하시겠습니까?');"><img src="<?php echo $g['img_module_skin']?>/btn_s_2.gif" alt="비공감" /></a> 
			<?php endif?>
			</div>
			<?php endif?>

			<?php if($R['tag']&&$d['theme']['show_tag']):?>
			<div class="tag">
			<img src="<?php echo $g['img_core']?>/_public/ico_tag.gif" alt="태그" />
			<?php $_tags=explode(',',$R['tag'])?>
			<?php $_tagn=count($_tags)?>
			<?php $i=0;for($i = 0; $i < $_tagn; $i++):?>
			<?php $_tagk=trim($_tags[$i])?>
			<a href="<?php echo $g['bbs_orign']?>&amp;where=subject|tag&amp;keyword=<?php echo urlencode($_tagk)?>"><?php echo $_tagk?></a><?php if($i < $_tagn-1):?>, <?php endif?>
			<?php endfor?>
			</div>
			<?php endif?>

			<?php if($d['theme']['snsping']):?>
			<div class="snsbox">
			<img src="<?php echo $g['img_core']?>/_public/sns_t1.gif" alt="twitter" title="게시글을 twitter로 보내기" onclick="snsWin('t');" />
			<img src="<?php echo $g['img_core']?>/_public/sns_f1.gif" alt="facebook" title="게시글을 facebook으로 보내기" onclick="snsWin('f');" />
			</div>
			<?php endif?>
		</div>
	</div>

	<div class="bottom">
	<?if($d['bbs']['perm_w'] <= $my['level']){?>
		<a href="<?php echo $g['bbs_modify'].$R['uid']?>" style="color:#fa6800;"><span class="glyphicon glyphicon-edit"></span> 수정</a>
		<? if($d['theme']['use_reply']) { ?>
		<span class="dv">|</span>
		<a href="<?php echo $g['bbs_reply'].$R['uid']?>" style="color:#008287;"><span class="glyphicon glyphicon-share"></span> 답변</a>
		<? } ?>
		<span class="dv">|</span>
		<a href="<?php echo $g['bbs_delete'].$R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?');" style="color:#9a1616;"><span class="glyphicon glyphicon-trash"></span> 삭제</a>
		<span class="dv">|</span>
	<? } ?>
	<? if($my['level'] >= $admin['admin']) { ?>
	<!--
		<a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=admin&module=<?php echo $m?>&front=movecopy&type=multi_move&postuid=<?php echo $R['uid']?>');">이동</a>
		<span class="dv">|</span>
		<a href="javascript:OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&iframe=Y&m=admin&module=<?php echo $m?>&front=movecopy&type=multi_copy&postuid=<?php echo $R['uid']?>');">복사</a>
		<span class="dv">|</span>
	-->
	<? } ?>
		<a href="<?php echo $g['bbs_list']?>" style="color:#4390df;"><span class="glyphicon glyphicon-list"></span> 목록</a>
	</div>

	<? if(!$d['bbs']['c_hidden']) { ?>
	<div class="comment">
		<a href="#." onclick="commentShow('comment');"><span class="glyphicon glyphicon-comment"></span> 댓글 <span id="comment_num<?php echo $R['uid']?>"><?php echo $R['comment']?></span>개</a>
		<?php if(getNew($R['d_comment'],24)):?><img src="<?php echo $g['img_core']?>/_public/ico_new_01.gif" alt="new" /><?php endif?>
	</div>
	<a name="CMT"></a>
	<iframe name="commentFrame" id="commentFrame" src="<?php if(!$d['bbs']['c_hidden']&&($CMT || $d['bbs']['c_open'])):?><?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=comment&amp;skin=<?php echo $d['bbs']['c_skin']?>&amp;hidepost=<?php echo ($R['display']?0:1)?>&amp;iframe=Y&amp;cync=[<?php echo $m?>][<?php echo $R['uid']?>][uid,comment,oneline,d_comment][<?php echo $table[$m.'data']?>][<?php echo $R['mbruid']?>][m:<?php echo $m?>,bid:<?php echo $R['bbsid']?>,uid:<?php echo $R['uid']?>]&amp;CMT=<?php echo $CMT?><?php endif?>" width="100%" height="0" frameborder="0" scrolling="no" allowTransparency="true"></iframe>
	<? } ?>

</div> 


<script type="text/javascript">
//<![CDATA[
<?php if($d['theme']['snsping']):?>
function snsWin(sns)
{
	var snsset = new Array();
	var enc_tit = "<?php echo urlencode($_HS['title'])?>";
	var enc_sbj = "<?php echo urlencode($R['subject'])?>";
	var enc_url = "<?php echo urlencode($g['url_root'].($_HS['rewrite']?($_HS['usescode']?'/'.$r:'').'/b/'.$R['bbsid'].'/'.$R['uid']:'/?'.($_HS['usescode']?'r='.$r.'&':'').'m='.$m.'&bid='.$R['bbsid'].'&uid='.$R['uid']))?>";
	var enc_tag = "<?php echo urlencode(str_replace(',',' ',$R['tag']))?>";

	snsset['t'] = 'http://twitter.com/home/?status=' + enc_sbj + '+++' + enc_url;
	snsset['f'] = 'http://www.facebook.com/sharer.php?u=' + enc_url + '&t=' + enc_sbj;
	snsset['m'] = 'http://me2day.net/posts/new?new_post[body]=' + enc_sbj + '+++["'+enc_tit+'":' + enc_url + '+]&new_post[tags]='+enc_tag;
	snsset['y'] = 'http://yozm.daum.net/api/popup/prePost?sourceid=' + enc_url + '&prefix=' + enc_sbj;
	window.open(snsset[sns]);
}
<?php endif?>
function printWindow(url) 
{
	window.open(url,'printw','left=0,top=0,width=700px,height=600px,statusbar=no,scrollbars=yes,toolbar=yes');
}
function commentShow(type)
{
	var url;
	if (type == 'comment')
	{
		url = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=comment&skin=<?php echo $d['bbs']['c_skin']?>&hidepost=<?php echo ($R['display']?0:1)?>&iframe=Y&cync=';
		url+= '[<?php echo $m?>][<?php echo $R['uid']?>]';
		url+= '[uid,comment,oneline,d_comment]';
		url+= '[<?php echo $table[$m.'data']?>][<?php echo $R['mbruid']?>]';
		url+= '[m:<?php echo $m?>,bid:<?php echo $R['bbsid']?>,uid:<?php echo $R['uid']?>]';
		url+= '&CMT=<?php echo $CMT?>';
	}
	else {
		url = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=trackback&iframe=Y&cync=';
		url+= '[<?php echo $m?>][<?php echo $R['uid']?>]';
		url+= '[m:<?php echo $m?>,bid:<?php echo $R['bbsid']?>,uid:<?php echo $R['uid']?>]';
		url+= '&TBK=<?php echo $TBK?>';
	}

	frames.commentFrame.location.href = url;
}
function setImgSizeSetting()
{
	<?php if($d['theme']['use_autoresize']):?>
	var ofs = getOfs(getId('vContent')); 
	getDivWidth(ofs.width,'vContent');
	<?php endif?>
	getId('vContent').style.fontFamily = getCookie('myFontFamily');
	getId('vContent').style.fontSize = getCookie('myFontSize');

	<?php if($TRACKBACK):?>
	commentShow('trackback');
	<?php endif?>

	<?php if($print=='Y'):?>
	document.body.style.padding = '15px';
	self.print();
	<?php endif?>
}
window.onload = setImgSizeSetting;
function showFileList() {
	if($('#file_list').css('display') == 'none') {
		$('#file_list').show();
	}
	else {
		$('#file_list').hide();
	}
}

//]]>
</script>




<div id="bbslist">

	<? if($my['level'] >= $admin['admin']) { ?>
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
		</select>
		
		<input type="text" name="keyword" size="30" value="<?php echo $_keyword?>" class="input" />
		<input type="submit" value=" 검색 " class="btngray" />
		<?php endif?>
		</form>
	</div>

</div>


