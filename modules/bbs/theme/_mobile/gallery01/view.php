<div class="subject"><?=$_HM['name']?></div>

<div id="bbsview">
	<div class="viewbox">
		<div class="title"><?php echo $R['subject']?></div>
		<div class="info">
			<span class="han"><?php echo $R[$_HS['nametype']]?></span> <span class="split">|</span> 
			<span class="han">조회</span> <span class="num"><?php echo $R['hit']?></span> <span class="split">|</span>
			<?php echo getDateFormat($R['d_regis'],$d['theme']['date_viewf'])?>
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
				<col width="100"/>
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

			<?php echo getContents($R['content'],$R['html'])?>
			<div class="clear"></div>

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
		<a href="<?php echo $g['bbs_list']?>" style="color:#4390df;"><span class="glyphicon glyphicon-list"></span> 목록</a>
	</div>

	<?php if(!$d['bbs']['c_hidden']):?>
	<div class="comment">
		<a href="#." onclick="commentShow('comment');"><span class="glyphicon glyphicon-comment"></span> 댓글<span id="comment_num<?php echo $R['uid']?>"><?php echo $R['comment']?></span>개</a>
		<?php if(getNew($R['d_comment'],24)):?><img src="<?php echo $g['img_core']?>/_public/ico_new_01.gif" alt="new" /><?php endif?>
	</div>

	<a name="CMT"></a>
	<iframe name="commentFrame" id="commentFrame" src="<?php if(!$d['bbs']['c_hidden']&&($CMT || $d['bbs']['c_open'])):?><?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=comment&amp;skin=<?php echo $d['bbs']['c_mskin']?>&amp;hidepost=<?php echo ($R['display']?0:1)?>&amp;iframe=Y&amp;cync=[<?php echo $m?>][<?php echo $R['uid']?>][uid,comment,oneline,d_comment][<?php echo $table[$m.'data']?>][<?php echo $R['mbruid']?>][m:<?php echo $m?>,bid:<?php echo $R['bbsid']?>,uid:<?php echo $R['uid']?>]&amp;CMT=<?php echo $CMT?><?php endif?>" width="100%" height="0" frameborder="0" scrolling="no" allowTransparency="true"></iframe>
	<?php endif?>
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

	snsset['t'] = 'http://mobile.twitter.com/home/?status=' + enc_sbj + '+++' + enc_url;
	snsset['f'] = 'http://www.facebook.com/sharer.php?u=' + enc_url + '&t=' + enc_sbj;
	snsset['m'] = 'http://m.me2day.net/posts/new?new_post[body]=' + enc_sbj + '+++["'+enc_tit+'":' + enc_url + '+]&new_post[tags]='+enc_tag;
	snsset['y'] = 'http://yozm.daum.net/api/popup/prePost?sourceid=' + enc_url + '&prefix=' + enc_sbj;
	window.open(snsset[sns]);
}
<?php endif?>
function commentShow(type)
{
	var url;
	if (type == 'comment')
	{
		url = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=comment&skin=<?php echo $d['bbs']['c_mskin']?>&hidepost=<?php echo ($R['display']?0:1)?>&iframe=Y&cync=';
		url+= '[<?php echo $m?>][<?php echo $R['uid']?>]';
		url+= '[uid,comment,oneline,d_comment]';
		url+= '[<?php echo $table[$m.'data']?>][<?php echo $R['mbruid']?>]';
		url+= '[m:<?php echo $m?>,bid:<?php echo $R['bbsid']?>,uid:<?php echo $R['uid']?>]';
		url+= '&CMT=<?php echo $CMT?>';
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
}
window.onload = setImgSizeSetting;
//]]>
</script>


<?php include_once $g['dir_module'].'lang.'.$_HS['lang'].'/mod/_list.php'?>
<div id="bbslist">
	<div class="title">

		<div class="article">
			<a href="<?=$g['bbs_write']?>" style="color:#fa6800;"><span class="glyphicon glyphicon-pencil"></span> 글쓰기</a>
			<span class="stat"><?php echo number_format($NUM+count($NCD))?>개(<?php echo $p?>/<?php echo $TPG?>페이지)</span>
		</div>
		
		<div class="category">
			<?php if($B['category']):$_catexp = explode(',',$B['category']);$_catnum=count($_catexp)?>
			<select onchange="document.bbssearchf.cat.value=this.value;document.bbssearchf.submit();">
			<option value="">&nbsp;+ <?php echo $_catexp[0]?></option>
			<option value="" class="sline">-------------------</option>
			<?php for($i = 1; $i < $_catnum; $i++):if(!$_catexp[$i])continue;?>
			<option value="<?php echo $_catexp[$i]?>"<?php if($_catexp[$i]==$cat):?> selected="selected"<?php endif?>>ㆍ<?php echo $_catexp[$i]?><?php if($d['theme']['show_catnum']):?>(<?php echo getDbRows($table[$m.'data'],'site='.$s.' and notice=0 and bbs='.$B['uid']." and category='".$_catexp[$i]."'")?>)<?php endif?></option>
			<?php endfor?>
			</select>
			<?php endif?>
		</div>
		<div class="clear"></div>
	</div>

	<table class="tbl-line">

	<!-- 공지 -->
	<? if($p<=1) { ?>
	<? foreach($NCD as $R) { ?> 
	<? $R['mobile']=isMobileConnect($R['agent']); ?>
	<tr>
	<td class="<? if($R['uid'] == $uid) echo 'now'; ?>">
		<a href="<?=$g['bbs_view'].$R['uid']?>">
		<div class="sbj">
			<?=getStrCut($R['subject'],$d['bbs']['sbjcut'],'...')?>
			<? if(getNew($R['d_regis'],24)) { ?><span class="new">new</span><? } ?>
		</div>
		</a>
		<div class="info">
			<?=$R[$_HS['nametype']]?> <span>|</span> 
			조회 <?=$R['hit']?> <span>|</span> 
			<?=getDateFormat($R['d_regis'],'Y.m.d')?>
		</div>
	</td>
	</tr>
	<? } ?>
	<? } ?>

	<!-- 게시물 -->
	<? foreach($RCD as $R) { ?> 
	<? $R['mobile']=isMobileConnect($R['agent'])?>
	<tr>
	<td class="<? if($R['uid'] == $uid) echo 'now'; ?>">
		<a href="<?=$g['bbs_view'].$R['uid']?>">
		<div class="sbj">
			<? if($R['category']) { ?><span class="cat">[<?=$R['category']?>]</span><? } ?>
			<?=getStrCut($R['subject'],$d['bbs']['sbjcut'],'...')?>
			<? if($R['comment']) { ?><span class="comment">[<?=$R['comment']?><? if($R['oneline']) { ?>+<?echo $R['oneline']?><? } ?>]</span><? } ?>
			<? if(getNew($R['d_regis'],24)) { ?><span class="new">new</span><? } ?>
		</div>
		</a>
		<div class="info">
			<? if(strstr($R['content'],'.jpg')) { ?><span class="pic glyphicon glyphicon-picture"></span><? } ?>
			<? if($R['upload']) { ?><span class="file glyphicon glyphicon-paperclip"></span><? } ?>
			<? if($R['hidden']) { ?><span class="lock glyphicon glyphicon-lock"></span><? } ?>
		
			<?=$R[$_HS['nametype']]?> <span>|</span> 
			조회 <?=$R['hit']?> <span>|</span> 
			<?=getDateFormat($R['d_regis'],'Y.m.d')?>
		</div>
	</td>
	</tr>
	<? } ?>
	
	<? if(!$NUM) { ?>
	<tr>
		<td>등록된 게시물이 없습니다.</td>
	</tr>
	<? } ?>

	</table>

	<div class="page">
	<?php echo getPageLink($d['theme']['pagenum'],$p,$TPG,$g['img_core'].'/page/default')?>
	</div>

	<?php if($B['uid']):?>
	<div class="btnbox">
		<div class="ctrl">
			<? if($admin['admin'] <= $my['lelvel'] || $d['bbs']['perm_w'] <= $my['level']) { ?>
			<a href="<?=$g['bbs_write']?>" style="float:left; color:#fa6800;"><span class="glyphicon glyphicon-pencil"></span>쓰기</span></a>
			<? } ?>
			<a href="<?=$g['bbs_reset']?>" style="float:right; color:#4390df;"><span class="glyphicon glyphicon-list"></span>목록</span></a>
			<div class="clear"></div>
		</div>

		<div class="xl">
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
		
		<input type="text" name="keyword" value="<?php echo $_keyword?>" />
		<input type="submit" value=" 검색 " class="btnblue" />
		<?php endif?>

		</form>
		</div>
		<div class="clear"></div>
	</div>
	<?php endif?>

</div>

