<div id="clist">

	<table summary="댓글리스트입니다.">
	<caption>댓글리스트</caption> 
	<colgroup> 
	<col> 
	<col width="80"> 
	<col width="50"> 
	<col width="50"> 
	<col width="70"> 
	</colgroup> 
	<thead>
	<tr>
	<th scope="col" class="side1"></th>
	<th scope="col">이름</th>
	<th scope="col">조회</th>
	<th scope="col">공감</th>
	<th scope="col" class="side2">날짜</th>
	</tr>
	</thead>
	<tbody>

	<?php foreach($NCD as $R):?>
	<?php $R['mobile']=isMobileConnect($R['agent'])?>
	<tr class="noticetr">
	<td class="sbj">
	<img src="<?php echo $g['img_module_skin']?>/ico_notice.gif" alt="공지" class="imgpos2" />
	<?php if($R['mobile']):?><img src="<?php echo $g['img_core']?>/_public/ico_mobile.gif" class="imgpos1" alt="모바일" title="모바일(<?php echo $R['mobile']?>)로 등록된 글입니다" /><?php endif?>
	<a href="<?php echo $g['cment_view'].$R['uid']?>#CMT<?php echo $R['uid']?>" title="<?php echo getStrCut(str_replace('&nbsp;',' ',strip_tags($R['content'])),100,'...')?>" onmouseover="qTilePop(this);" onmouseout="qTilePopKill(this);"<?php if($R['uid']==$uid):?> class="b"<?php endif?>><?php echo $R['subject']?></a>
	<?php if(strstr($R['content'],'.jpg')):?><img src="<?php echo $g['img_core']?>/_public/ico_pic.gif" class="imgpos" alt="사진" title="사진" /><?php endif?>
	<?php if($R['upload']):?><img src="<?php echo $g['img_core']?>/_public/ico_file.gif" class="imgpos" alt="첨부파일" title="첨부파일" /><?php endif?>
	<?php if($R['hidden']):?><img src="<?php echo $g['img_core']?>/_public/ico_hidden.gif" class="imgpos" alt="비밀글" title="비밀글" /><?php endif?>
	<?php if($R['oneline']):?><span class="comment">[<?php echo $R['oneline']?>]</span><?php endif?>
	<?php if(getNew($R['d_regis'],24)):?><span class="new">new</span><?php endif?>
	</td>
	<td class="name"><span class="han hand" onclick="getMemberLayer('<?php echo $R['mbruid']?>',event);"><?php echo $R[$_HS['nametype']]?></span></td>
	<td><?php echo $R['hit']?></td>
	<td><?php echo $R['score1']?></td>
	<td><?php echo getDateFormat($R['d_regis'],'m.d H:i')?></td>
	</tr>
	<?php endforeach?>

	<?php $cnt=count($RCD)?>
	<?php foreach($RCD as $R):?>
	<?php $R['mobile']=isMobileConnect($R['agent'])?>
	<tr class="dotline<?php if($cnt==++$_ol):?> none<?php endif?>">
	<td class="sbj">
	<?php if($R['mobile']):?><img src="<?php echo $g['img_core']?>/_public/ico_mobile.gif" class="imgpos1" alt="모바일" title="모바일(<?php echo $R['mobile']?>)로 등록된 글입니다" /><?php endif?>
	<a href="<?php echo $g['cment_view'].$R['uid']?>#CMT<?php echo $R['uid']?>" title="<?php echo $R['hidden']?'비공개 댓글입니다.':getStrCut(str_replace('&nbsp;',' ',strip_tags($R['content'])),100,'...')?>" onmouseover="qTilePop(this);" onmouseout="qTilePopKill(this);"<?php if($R['uid']==$uid):?> class="b"<?php endif?>><?php echo $R['subject']?></a>
	<?php if(strstr($R['content'],'.jpg')):?><img src="<?php echo $g['img_core']?>/_public/ico_pic.gif" class="imgpos" alt="사진" title="사진" /><?php endif?>
	<?php if($R['upload']):?><img src="<?php echo $g['img_core']?>/_public/ico_file.gif" class="imgpos" alt="첨부파일" title="첨부파일" /><?php endif?>
	<?php if($R['hidden']):?><img src="<?php echo $g['img_core']?>/_public/ico_hidden.gif" class="imgpos" alt="비밀글" title="비밀글" /><?php endif?>
	<?php if($R['oneline']):?><span class="comment">[<?php echo $R['oneline']?>]</span><?php endif?>
	<?php if(getNew($R['d_regis'],24)):?><span class="new">new</span><?php endif?>
	</td>
	<td class="name"><span class="han hand" onclick="getMemberLayer('<?php echo $R['mbruid']?>',event);"><?php echo $R[$_HS['nametype']]?></span></td>
	<td><?php echo $R['hit']?></td>
	<td><?php echo $R['score1']?></td>
	<td><?php echo getDateFormat($R['d_regis'],'m.d H:i')?></td>
	</tr>
	<?php endforeach?>
	<?php $R=array()?>

	<?php if(!$NUM):?>
	<tr class="none">
	<td class="sbj">등록된 댓글이 없습니다.</td>
	<td>-</td>
	<td>-</td>
	<td>-</td>
	<td>-</td>
	</tr>
	<?php endif?>

	</tbody>
	</table>
	
	<div class="page pagebox01">
		<script type="text/javascript">getPageLink(10,<?php echo $p?>,<?php echo $TPG?>,'<?php echo $g['img_core']?>/page/default');</script>
	</div>
	

</div>



<div id="qTilePopDiv"></div>
<script type="text/javascript">
//<![CDATA[
if (myagent != 'ie') document.captureEvents(Event.MOUSEMOVE);
document.onmousemove = get_mouse;

var skn = getId('qTilePopDiv');
var itt = '';
//]]>
</script>
