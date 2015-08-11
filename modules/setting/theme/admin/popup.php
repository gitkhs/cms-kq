<?
$POPUPS = getDbArray($table['s_popup'],'','*','uid','asc',0,$p);
$NUM = db_num_rows($POPUPS);
if ($uid)
{
	$R = getUidData($table['s_popup'],$uid);
}
$R['width']		= $R['width'] ? $R['width'] : 400;
$R['height']	= $R['height'] ? $R['height'] : 400;
?>

<div id="popup">
	<table class="tbl">
	<tr>
		<td class="list"><? // 팝업 리스트 ?>
			<div class="title">등록된 팝업들</div>
			<?php if($NUM):?>
			<div class="tree">
				<ul>
				<?php while($PR = db_fetch_array($POPUPS)):?>
				<li><a href="<?=$g['s']?>/?r=<?=$r?>&m=setting&mod=admin&div=popup&uid=<?php echo $PR['uid']?>"><span class="name<?php if($PR['uid']==$uid):?> on<?php endif?>"><?php echo $PR['name']?></span></a></li>
				<?php endwhile?>
				</ul>
			</div>
			<?php else:?>
			<div class="none"><img src="<?php echo $g['img_core']?>/_public/ico_notice.gif" alt="" /> 등록된 팝업이 없습니다.</div>
			<?php endif?>
			</div>
		</td>

		<td class="cont"><? // 팝업 본문 ?>
			<form name="procForm" action="<?=$g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck(this);">
			<input type="hidden" name="r" value="<?=$r?>" />
			<input type="hidden" name="a" value="<?=$mod?>" />
			<input type="hidden" name="m" value="<?=$m?>" />
			<input type="hidden" name="mod" value="<?=$mod?>" />
			<input type="hidden" name="div" value="<?=$div?>" />

			<input type="hidden" name="uid" value="<?=$R['uid']?>" />
			<input type="hidden" name="dispage" value="<?=$R['dispage']?>" />
			<input type="hidden" name="type" value="1" />
			<input type="hidden" name="term0" value="1" />
			<input type="hidden" name="actid" value="" />

			<div class="title">
				<div style="float:left;">팝업 등록정보</div>
				<div style="float:right;"><?if($NUM<10){?><a href="<?=$g['s']?>/?r=<?=$r?>&m=setting&mod=admin&div=popup&newpop=Y">새팝업 등록</a><?}?></div>
				<div class="clear"></div>
			</div>
			<div class="notice">팝업 등록은 최대 10개 까지 등록 가능 합니다.</div>

			<?if($uid || $NUM<10){?>
			<table class="tbl">
			<colgroup>
			<col width="120">
			<col>
			</colgroup>
			<tr>
				<td class="tl lnt lnb c">팝업타이틀</td>
				<td class="td lnt lnb">
					<input type="text" name="name" value="<?php echo $R['name']?>" class="input" size="50" />
					<?php if($R['uid']):?>
					<input type="button" class="btnorange" value="삭 제" onclick="{$('input[name=actid]').val('del');$('form[name=procForm]').submit();}">
					<?php endif?>
				</td>
			</tr>
			<tr>
				<td class="tl lnb c">노 출 옵 션</td>
				<td class="td lnb">
					<div class="row">
						<label><input type="checkbox" name="scroll" value="1"<?php if($R['scroll']):?> checked="checked"<?php endif?>>스크롤</label>
						<label><input type="checkbox" name="hidden" value="1"<?php if($R['hidden']):?> checked="checked"<?php endif?> />숨기기</label>
					</div>
				</td>
			</tr>
			<tr>
				<td class="tl lnb c">노 출 크 기</td>
				<td class="td lnb">
					<div class="row">
						<input type="text" name="width" value="<?php echo $R['width']?>" size="3" class="input" /> *
						<input type="text" name="height" value="<?php echo $R['height']?>" size="3" class="input" />
						(가로/세로 , 단위:픽셀)
					</div>
				</td>
			</tr>
			<tr>
				<td class="tl lnb c">노 출 위 치</td>
				<td class="td lnb sf">
					<div class="row">
						<label><input type="checkbox" name="center" value="1"<?php if($R['center']):?> checked="checked"<?php endif?>>중앙에서 위치계산</label>
					</div>
					<div class="row">
						<input type="text" name="ptop" value="<?php echo $R['ptop']?$R['ptop']:0?>" size="3" class="input" /> *
						<input type="text" name="pleft" value="<?php echo $R['pleft']?$R['pleft']:0?>" size="3" class="input" /> 
						(위쪽/왼쪽 , 단위:필셀)
					</div>
				</td>
			</tr>
			</table>

			<div class="row">
				<script type="text/javascript" src="<?=$g['path_core']?>com/smarteditor/js/HuskyEZCreator.js" charset="utf-8"></script>
				<input type="hidden" name="html" id="editFrameHtml" value="<?=$R['html']?$R['html']:'HTML'?>" />
				<input type="hidden" name="upload" id="upfilesValue" value="<?=$R['upload']?>" />
				<input type="hidden" name="content" value="<?=htmlspecialchars($R['content']);?>" />

				<textarea id="ir1" rows="16" style="width:100%;"></textarea>
				<script type="text/javascript">
					var uri = "<?=$g['path_core']?>com/smarteditor/SmartEditor2Skin.php?s=<?=$g['s']?>&r=<?=$r?>&s_file=&s_photo=Y";
					CreateEditor("ir1","content",uri);
				</script>
				<div><iframe name="upfilesFrame" id="upfilesFrame" src="<?=$g['s']?>/?r=<?=$r?>&amp;m=upload&amp;mod=n_list&amp;gparam=upfilesValue|editFrame&amp;code=<?=$R['upload']?$R['upload']:'[]'?>" width="100%" height="0" frameborder="0" scrolling="no" allowTransparency="true"></iframe></div>
			</div>

			<div class="submitbox">
				<?php if($R['uid']):?><input type="button" class="btngray" value="팝업보기" onclick="showPopup();" /><?php endif?>
				<input type="submit" class="btnblue" value="<?php echo $R['uid']?'팝업속성 변경':'새 팝업 등록'?>" onclick="{$('input[name=actid]').val('regis');}"/>
				<div class="clear"></div>
			</div>
			<?}?>

		</td>
	</tr>
	</table>
</div>

<script type="text/javascript">
function showPopup()
{
	window.open('<?php echo $g['s']?>/?r=<?php echo $r?>&system=popup.window&uid=<?php echo $R['uid']?>&iframe=Y','popview_<?php echo $R['uid']?>','left=<?php echo $R['pleft']?>,top=<?php echo $R['ptop']?>,width=<?php echo $R['width']?>,height=<?php echo $R['height']?>,scrollbars=<?php echo $R['scroll']?'yes':'no'?>,status=yes');
}
function delPop(){
}
function saveCheck(f)
{
	if (f.name.value == '')
	{
		alert('팝업타이틀을 입력해 주세요.      ');
		f.name.focus();
		return false;
	}

	if (f.width.value == "")
	{
		alert('팝업창의 가로폭을 입력해 주세요.');
		f.width.focus();
		return false;
	}
	if (f.height.value == "")
	{
		alert('팝업창의 세로폭을 입력해 주세요.');
		f.height.focus();
		return false;
	}

	f.content.value = GetEditor("ir1");
	if (f.content.value == '')
	{
		alert('내용을 입력해 주세요.       ');
		return false;
	}
	if (getId('upfilesFrame'))
	{
		frames.upfilesFrame.dragFile();
	}

	return confirm('정말로 실행하시겠습니까?         ');
}
</script>
