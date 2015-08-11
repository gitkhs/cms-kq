<?php
include_once $g['path_module'].$module.'/var/var.php';
?>

<div id="configbox">

	<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="m" value="<?php echo $module?>" />
	<input type="hidden" name="a" value="config" />

	<div class="title">
		게시판 기초환경
	</div>

	<table>
		<tr>
			<td class="td1">
				대표테마
				<img src="<?php echo $g['img_core']?>/_public/ico_q.gif" alt="도움말" title="도움말" class="hand" onclick="layerShowHide('guide_skin','block','none');" />
			</td>
			<td class="td2">
				
				<select name="skin_main" class="select1">
				<option value="">&nbsp;+ 선택하세요</option>
				<option value="">--------------------------------</option>
				<?php $tdir = $g['path_module'].$module.'/theme/_pc/'?>
				<?php $dirs = opendir($tdir)?>
				<?php while(false !== ($skin = readdir($dirs))):?>
				<?php if($skin=='.' || $skin == '..' || is_file($tdir.$skin))continue?>
				<option value="_pc/<?php echo $skin?>" title="<?php echo $skin?>"<?php if($d['bbs']['skin_main']=='_pc/'.$skin):?> selected="selected"<?php endif?>>ㆍ<?php echo getFolderName($tdir.$skin)?>(<?php echo $skin?>)</option>
				<?php endwhile?>
				<?php closedir($dirs)?>
				</select>
				<div id="guide_skin" class="guide hide">
				지정된 대표테마는 게시판설정시 별도의 테마지정없이 자동으로 적용됩니다.<br />
				가장 많이 사용하는 테마를 지정해 주세요.
				</div>
			</td>
		</tr>
		<tr>
			<td class="td1 m">
				(모바일테마)
			</td>
			<td class="td2">
				
				<select name="skin_mobile" class="select1">
				<option value="">&nbsp;+ 선택하세요</option>
				<option value="">--------------------------------</option>
				<?php $tdir = $g['path_module'].$module.'/theme/_mobile/'?>
				<?php $dirs = opendir($tdir)?>
				<?php while(false !== ($skin = readdir($dirs))):?>
				<?php if($skin=='.' || $skin == '..' || is_file($tdir.$skin))continue?>
				<option value="_mobile/<?php echo $skin?>" title="<?php echo $skin?>"<?php if($d['bbs']['skin_mobile']=='_mobile/'.$skin):?> selected="selected"<?php endif?>>ㆍ<?php echo getFolderName($tdir.$skin)?>(<?php echo $skin?>)</option>
				<?php endwhile?>
				<?php closedir($dirs)?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="td1">
				통합보드테마
				<img src="<?php echo $g['img_core']?>/_public/ico_q.gif" alt="도움말" title="도움말" class="hand" onclick="layerShowHide('guide_total','block','none');" />
			</td>
			<td class="td2">
				
				<select name="skin_total" class="select1">
				<option value="">&nbsp;+ 통합보드 사용안함</option>
				<option value="">--------------------------------</option>
				<?php $tdir = $g['path_module'].$module.'/theme/_pc/'?>
				<?php $dirs = opendir($tdir)?>
				<?php while(false !== ($skin = readdir($dirs))):?>
				<?php if($skin=='.' || $skin == '..' || is_file($tdir.$skin))continue?>
				<option value="_pc/<?php echo $skin?>" title="<?php echo $skin?>"<?php if($d['bbs']['skin_total']=='_pc/'.$skin):?> selected="selected"<?php endif?>>ㆍ<?php echo getFolderName($tdir.$skin)?>(<?php echo $skin?>)</option>
				<?php endwhile?>
				<?php closedir($dirs)?>
				</select>
				<div id="guide_total" class="guide hide">
				통합보드란 모든 게시판의 전체 게시물을 하나의 게시판으로 출력해 주는 서비스입니다.<br />
				사용하시려면 통합보드용 테마를 지정해 주세요.<br />
				통합보드의 호출은 <a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>" target="_blank" class="b u"><?php echo $g['r']?>/?m=<?php echo $module?></a> 입니다.
				</div>
			</td>
		</tr>
		<tr>
			<td class="td1">RSS발행</td>
			<td class="td2 shift">
				<input type="checkbox" name="rss" value="1"<?php if($d['bbs']['rss']):?> checked="checked"<?php endif?> />RSS발행을 허용합니다.(개별게시판별 RSS발행은 개별게시판 설정을 따름)<br />
			</td>
		</tr>
		<tr>
			<td class="td1">게시물출력</td>
			<td class="td2">
				<input type="text" name="recnum" value="<?php echo $d['bbs']['recnum']?$d['bbs']['recnum']:20?>" size="5" class="input" />개(한페이지에 출력할 게시물의 수)
			</td>
		</tr>
		<tr>
			<td class="td1">제목끊기</td>
			<td class="td2">
				<input type="text" name="sbjcut" value="<?php echo $d['bbs']['sbjcut']?$d['bbs']['sbjcut']:40?>" size="5" class="input" />자(제목이 길 경우 자르기)
			</td>
		</tr>
		<tr>
			<td class="td1">새글유지시간</td>
			<td class="td2">
				<input type="text" name="newtime" value="<?php echo $d['bbs']['newtime']?$d['bbs']['newtime']:24?>" size="5" class="input" />시간(새글로 인식되는 시간)
			</td>
		</tr>
		<tr>
			<td class="td1">답글인식문자</td>
			<td class="td2">
				<input type="text" name="restr" value="<?php echo $d['bbs']['restr']?>" size="5" class="input" />
			</td>
		</tr>
		<tr>
			<td class="td1">삭제제한</td>
			<td class="td2 shift">
				<input type="checkbox" name="replydel" value="1"<?php if($d['bbs']['replydel']):?> checked="checked"<?php endif?> />답변글이 있는 원본글의 삭제를 제한합니다.<br />
				<input type="checkbox" name="commentdel" value="1"<?php if($d['bbs']['commentdel']):?> checked="checked"<?php endif?> />댓글이 있는 원본글의 삭제를 제한합니다.
			</td>
		</tr>
		<tr>
			<td class="td1">불량글 처리</td>
			<td class="td2 shift">
				<input type="checkbox" name="singo_del" value="1"<?php if($d['bbs']['singo_del']):?> checked="checked"<?php endif?> />신고수가 
				<input type="text" name="singo_del_num" value="<?php echo $d['bbs']['singo_del_num']?>" size="5" class="input" />건 이상일 경우 
				<select name="singo_del_act">
				<option value="1"<?php if($d['bbs']['singo_del_act']==1):?> selected="selected"<?php endif?>>자동삭제</option>
				<option value="2"<?php if($d['bbs']['singo_del_act']==2):?> selected="selected"<?php endif?>>비밀처리</option>
				</select>
			</td>
		</tr>

		<tr>
			<td class="td1">제한단어</td>
			<td class="td2">
				<textarea name="badword" rows="5" cols="70" onfocus="this.style.color='#000000';" onblur="this.style.color='#ffffff';"><?php echo $d['bbs']['badword']?></textarea>
			
			</td>
		</tr>
		<tr>
			<td class="td1">제한단어 처리</td>
			<td class="td2">
				<input type="radio" name="badword_action" value="0"<?php if($d['bbs']['badword_action']==0):?> checked="checked"<?php endif?> />제한단어 체크하지 않음<br />
				<input type="radio" name="badword_action" value="1"<?php if($d['bbs']['badword_action']==1):?> checked="checked"<?php endif?> />등록을 차단함<br />
				<input type="radio" name="badword_action" value="2"<?php if($d['bbs']['badword_action']==2):?> checked="checked"<?php endif?> />제한단어를 다음의 문자로 치환하여 등록함
				<input type="text" name="badword_escape" value="<?php echo $d['bbs']['badword_escape']?>" size="1" maxlength="1" class="input" />
			</td>
		</tr>

	</table>





	<div class="submitbox">
		<input type="submit" class="btnblue" value=" 확인 " />
	</div>

	</form>

</div>




<script type="text/javascript">
//<![CDATA[
function saveCheck(f)
{
	if (f.skin_main.value == '')
	{
		alert('대표테마를 선택해 주세요.       ');
		f.skin_main.focus();
		return false;
	}
	if (f.skin_mobile.value == '')
	{
		alert('모바일테마를 선택해 주세요.       ');
		f.skin_mobile.focus();
		return false;
	}

	return confirm('정말로 실행하시겠습니까?         ');
}
//]]>
</script>


