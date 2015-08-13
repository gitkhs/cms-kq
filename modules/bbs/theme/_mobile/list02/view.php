<div class="subject"><?=$_HM['name']?></div>

<div id="bbsview">
	<div class="container" style="margin-top:12px;">
		<div class="panel panel-default">
		<div class="panel-heading">
			<div class="text-left title"><?php echo $R['subject']?></div>
			<div class="text-right info">
				<span class="han"><?php echo $R[$_HS['nametype']]?></span> <span class="split">|</span> 
				<span class="han">조회</span> <span class="num"><?php echo $R['hit']?></span> <span class="split">|</span>
				<?php echo getDateFormat($R['d_regis'],$d['theme']['date_viewf'])?>
			</div>
		</div>
		<div class="panel-body">
			<? if($d['upload']['data'] && $d['theme']['show_upfile']) { ?>
			<div class="row">
			<div class="btn-group">
				<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 첨부파일 <span class="caret"></span></button>
				<ul class="dropdown-menu">
				<? foreach($d['upload']['data'] as $_u) { ?>
				<? if($_u['hidden'])continue; ?>
					<li><a href="<?=$g['s']?>/?r=<?=$r?>&amp;m=upload&amp;a=download&amp;uid=<?=$_u['uid']?>"><?=$_u['name']?> (<?=getSizeFormat($_u['size'],1)?>)</a></li>
				<? } ?>
				</ul>
			</div>
			</div>
			<? } ?>


			<?if($R['adddata'] && ($my['admin'] || $my['level'] >= $admin['admin'])){?>
			<div class="row add-data">
				<table class="table table-bordered">
				<?$adddata = explode("|",$R['adddata']);?>
				<?foreach($adddata as $_T){?>
				<?$itm = explode(":",$_T);?>
				<tr>
					<td class="active"><?=$itm[0]?></td>
					<td><?=$itm[1]?></td>
				</tr>
				<?}?>
				</table>
			</div>
			<?}?>

		
			<div class="row"><?php echo getContents($R['content'],$R['html'])?></div>
			
			<?php if($R['tag']&&$d['theme']['show_tag']):?>
			<div class="row">
			<img src="<?php echo $g['img_core']?>/_public/ico_tag.gif" alt="태그" />
			<?php $_tags=explode(',',$R['tag'])?>
			<?php $_tagn=count($_tags)?>
			<?php $i=0;for($i = 0; $i < $_tagn; $i++):?>
			<?php $_tagk=trim($_tags[$i])?>
			<a href="<?php echo $g['bbs_orign']?>&amp;where=subject|tag&amp;keyword=<?php echo urlencode($_tagk)?>"><?php echo $_tagk?></a><?php if($i < $_tagn-1):?>, <?php endif?>
			<?php endfor?>
			</div>
			<?php endif?>


			<div class="row">
				<div class="col-xs-4">
				<?php if($d['theme']['snsping']) : ?>
				<div class="snsWin">
					<span class="text-info mif-facebook" onclick="snsWin('f');"></span>
					<span class="text-info mif-twitter" onclick="snsWin('t');"></span>
				</div>
				<?php endif ?>
				</div>
				<div class="col-xs-8 text-right">
					<a href="<?php echo $g['bbs_reply'].$R['uid']?>"><span class="label label-default">답변</span></a>
					<a href="<?php echo $g['bbs_modify'].$R['uid']?>"><span class="label label-default">수정</span></a>
					<a href="<?php echo $g['bbs_delete'].$R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?');"><span class="label label-default">삭제</span></a>
					<a href="<?php echo $g['bbs_list']?>"><span class="label label-default">목록</span></a>
				</div>
			</div>
<!--		
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
-->
		</div>
  		</div>
		
		<?php if(!$d['bbs']['c_hidden']):?>
		<div class="panel panel-default">
		<div class="panel-body">
			<div class="comment">
				<a href="#." onclick="commentShow('comment');"><span class="glyphicon glyphicon-comment"></span> 댓글<span id="comment_num<?php echo $R['uid']?>"><?php echo $R['comment']?></span>개</a>
				<?php if(getNew($R['d_comment'],24)):?><img src="<?php echo $g['img_core']?>/_public/ico_new_01.gif" alt="new" /><?php endif?>
			</div>

			<a name="CMT"></a>
			<iframe name="commentFrame" id="commentFrame" src="<?php if(!$d['bbs']['c_hidden']&&($CMT || $d['bbs']['c_open'])):?><?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=comment&amp;skin=<?php echo $d['bbs']['c_mskin']?>&amp;hidepost=<?php echo ($R['display']?0:1)?>&amp;iframe=Y&amp;cync=[<?php echo $m?>][<?php echo $R['uid']?>][uid,comment,oneline,d_comment][<?php echo $table[$m.'data']?>][<?php echo $R['mbruid']?>][m:<?php echo $m?>,bid:<?php echo $R['bbsid']?>,uid:<?php echo $R['uid']?>]&amp;CMT=<?php echo $CMT?><?php endif?>" width="100%" height="0" frameborder="0" scrolling="no" allowTransparency="true"></iframe>
		</div>
  		</div>
		<?php endif?>
	</div>
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


<?php if($d['theme']['show_list']):?>
<?php include_once $g['dir_module'].'lang.'.$_HS['lang'].'/mod/_list.php'?>
<?php include_once $g['dir_module_skin'].'list.php'?>
<?php endif?>


