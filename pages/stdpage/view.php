<?
	// 업로드 파일 리스트
	$t['upload']['tmp'] = $R['upload'];
	$t['_pload'] = getArrayString($R['upload']);
	foreach($t['_pload']['data'] as $_val) {
		$U = getUidData($table['s_upload'],$_val);
		if (!$U['uid']) {
			$R['upload'] = str_replace('['.$_val.']','',$R['upload']);
			$t['_pload']['count']--;
		}
		else {
			$t['upload']['data'][] = $U;
		}
	}
	if ($R['upload'] != $t['upload']['tmp'])
	{
		getDbUpdate($table[$m.'data'],"upload='".$R['upload']."'",'uid='.$R['uid']);
	}
	$t['upload']['count'] = $t['_pload']['count'];
?>

<div id="stdpage_view">
	<div class="subject"><?=$_HM['name']?></div>
	<? if(!$g['mobile']){ ?>
	<div class="info">
		<div class="xright">
			<ul>
				<? if($my['level'] >= $admin['admin'] && !$g['mobile']){ ?>
				<li class="g"><a href="<?=$g['s']?>/?r=<?=$r?>&c=<?=$c?>&usp=write" style="font-weight:bold; color:#fa6800;"><span class="glyphicon glyphicon-edit"></span> <?=$R['pid'] ? '수정' : '글쓰기'?></a></li>
				<? } ?>

				<? if($t['upload']['count']) { ?><li class="g"><a href="#" onclick="showFileList(); return false;"><span class="glyphicon glyphicon-paperclip"></span> 첨부파일</a></li><? } ?>
				<li class="g"><a href="javascript:printWindow('<?=$g['s']?>/?r=<?=$r?>&c=<?=$c?>&iframe=Y&print=Y');"><span class="glyphicon glyphicon-print"></span> 인쇄</a></li>
				<li><div id="fontface"></div><img src="<?=$g['img_core']?>/_public/b_font.gif" alt="글꼴" title="글꼴" class="hand" onclick="fontFace('stdpage_content','fontface');" /></li>
				<li><img src="<?=$g['img_core']?>/_public/b_plus.gif" alt="확대" title="확대" class="hand" onclick="fontResize('stdpage_content','+');"/></li>
				<li><img src="<?=$g['img_core']?>/_public/b_minus.gif" alt="축소" title="축소" class="hand" onclick="fontResize('stdpage_content','-');" /></li>
			</ul>
		</div>
		<div class="clear"></div>
	</div>
	<? } ?>

	<? if($t['upload']['count']) { ?>
	<div id="file_list">
	<ul>
		<? foreach($t['upload']['data'] as $_u) { ?>
		<? if($_u['hidden']) continue; ?>
		<li>
			<a href="<?=$g['s']?>/?r=<?=$r?>&amp;m=upload&amp;a=download&amp;uid=<?=$_u['uid']?>" title="<?php echo $_u['caption']?>">
			<span class="glyphicon glyphicon-floppy-save"></span> <?=$_u['name']?>
			<span class="size">(<?echo getSizeFormat($_u['size'],1)?>)</span>
			<span class="down">(<?echo number_format($_u['down'])?>)</span>
			</a>
		</li>
		<? } ?>
	</ul>
	<div class="clear"></div>
	</div>
	<? } ?>
	
	<div id="stdpage_content" class="content<?=$g['mobile'] ? ' mobile' : ''?>">
		<? if($R['mapapi_pos'] == '1'){?><div id="map-api"><?=$R['mapapi']?></div><? } ?>
		<?=$R['content']?>
		<? if($R['mapapi_pos'] == '2'){?><div id="map-api"><?=$R['mapapi']?></div><? } ?>
	</div>

	<? if($my['level'] >= $admin['admin'] && !$g['mobile']){ ?>
	<div class="admin-box">
		<input type="button" class="btndef btnsz01" value="<?=$R['pid'] ? '수정' : '글쓰기'?>" onclick="goHref('<?=$g['s']?>/?r=<?=$r?>&c=<?=$c?>&usp=write');">
	</div>
	<? } ?>
	<div class="clear"></div>
</div>
<script type="text/javascript">
window.onload = onDocumentLoad;
function onDocumentLoad() {
	getId('stdpage_content').style.fontFamily = getCookie('myFontFamily');
	getId('stdpage_content').style.fontSize = getCookie('myFontSize');

	<?php if($print=='Y'):?>
	document.body.style.padding = '15px';
	self.print();
	<?php endif?>
}

function printWindow(url) {
	window.open(url,'printw','left=0,top=0,width=700px,height=600px,statusbar=no,scrollbars=yes,toolbar=yes');
}
	
$(window).load(function() {
	if(getId('map-api')) {
		var w = $('#map-api').width();
		var	src = $('#map-api').find('>iframe').attr('src');
		$('#map-api').find('>iframe').attr('src',src+'&width='+w+'&height=300');
		$('#map-api').find('>iframe').css('width',w);
		$('#map-api').find('>iframe').css('height',300);
	}
});

function showFileList() {
	if($('#file_list').css('display') == 'none') {
		$('#file_list').show();
	}
	else {
		$('#file_list').hide();
	}
}
</script>
