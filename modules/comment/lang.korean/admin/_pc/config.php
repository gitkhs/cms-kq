<?php
include_once $g['path_module'].$module.'/var/var.php';
?>

<div id="configbox">

	<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="m" value="<?php echo $module?>" />
	<input type="hidden" name="a" value="config" />

	<div class="title">
		댓글 환경설정
	</div>

	<table>
		<tr>
			<td class="td1">
				댓글테마
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
				<option value="_pc/<?php echo $skin?>" title="<?php echo $skin?>"<?php if($d['comment']['skin_main']=='_pc/'.$skin):?> selected="selected"<?php endif?>>ㆍ<?php echo getFolderName($tdir.$skin)?>(<?php echo $skin?>)</option>
				<?php endwhile?>
				<?php closedir($dirs)?>
				</select>
				<div id="guide_skin" class="guide hide">
				지정된 테마는 댓글리스트 출력시에 적용됩니다.<br />
				적용할 댓글테마를 지정해 주세요.
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
				<option value="_mobile/<?php echo $skin?>" title="<?php echo $skin?>"<?php if($d['comment']['skin_mobile']=='_mobile/'.$skin):?> selected="selected"<?php endif?>>ㆍ<?php echo getFolderName($tdir.$skin)?>(<?php echo $skin?>)</option>
				<?php endwhile?>
				<?php closedir($dirs)?>
				</select>
			</td>
		</tr>

		<tr>
			<td class="td1">글쓰기권한</td>
			<td class="td2">
				<select name="perm_write" class="select1">
				<option value="0">&nbsp;+ 전체허용</option>
				<option value="0">--------------------------------</option>
				<?php $_LEVEL=getDbArray($table['s_mbrlevel'],'','*','uid','asc',0,1)?>
				<?php while($_L=db_fetch_array($_LEVEL)):?>
				<option value="<?php echo $_L['uid']?>"<?php if($_L['uid']==$d['comment']['perm_write']):?> selected="selected"<?php endif?>>ㆍ<?php echo $_L['name']?>(<?php echo number_format($_L['num'])?>) 이상</option>
				<?php if($_L['gid'])break; endwhile?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="td1">사진첨부권한</td>
			<td class="td2">
				<select name="perm_photo" class="select1">
				<option value="0">&nbsp;+ 전체허용</option>
				<option value="0">--------------------------------</option>
				<?php $_LEVEL=getDbArray($table['s_mbrlevel'],'','*','uid','asc',0,1)?>
				<?php while($_L=db_fetch_array($_LEVEL)):?>
				<option value="<?php echo $_L['uid']?>"<?php if($_L['uid']==$d['comment']['perm_photo']):?> selected="selected"<?php endif?>>ㆍ<?php echo $_L['name']?>(<?php echo number_format($_L['num'])?>) 이상</option>
				<?php if($_L['gid'])break; endwhile?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="td1">파일첨부권한</td>
			<td class="td2">
				<select name="perm_upfile" class="select1">
				<option value="0">&nbsp;+ 전체허용</option>
				<option value="0">--------------------------------</option>
				<?php $_LEVEL=getDbArray($table['s_mbrlevel'],'','*','uid','asc',0,1)?>
				<?php while($_L=db_fetch_array($_LEVEL)):?>
				<option value="<?php echo $_L['uid']?>"<?php if($_L['uid']==$d['comment']['perm_upfile']):?> selected="selected"<?php endif?>>ㆍ<?php echo $_L['name']?>(<?php echo number_format($_L['num'])?>) 이상</option>
				<?php if($_L['gid'])break; endwhile?>
				</select>			
			</td>
		</tr>
		<tr>
			<td class="td1">소셜연동</td>
			<td class="td2">
				<select name="snsconnect" class="select1">
				<option value="0">&nbsp;+ 연동안함</option>
				<option value="0">--------------------------------</option>
				<?php $tdir = $g['path_module'].'social/inc/'?>
				<?php if(is_dir($tdir)):?>
				<?php $dirs = opendir($tdir)?>
				<?php while(false !== ($skin = readdir($dirs))):?>
				<?php if($skin=='.' || $skin == '..')continue?>
				<option value="social/inc/<?php echo $skin?>"<?php if($d['comment']['snsconnect']=='social/inc/'.$skin):?> selected="selected"<?php endif?>>ㆍ<?php echo str_replace('.php','',$skin)?></option>
				<?php endwhile?>
				<?php closedir($dirs)?>
				<?php endif?>
				</select> (소셜모듈을 설치 후 사용가능)
			</td>
		</tr>
		<tr>
			<td class="td1">댓글제목</td>
			<td class="td2">
				<input type="checkbox" name="use_subject" value="1"<?php if($d['comment']['use_subject']):?> checked="checked"<?php endif?> />댓글제목을 사용합니다.
			</td>
		</tr>
		<tr>
			<td class="td1">글쓰기도구</td>
			<td class="td2">
				<input type="checkbox" name="edit_tool" value="1"<?php if($d['comment']['edit_tool']):?> checked="checked"<?php endif?> />글쓰기 도구를 보여줍니다. 
			</td>
		</tr>
		<tr>
			<td class="td1">글쓰기폼높이</td>
			<td class="td2">
				<input type="text" name="edit_height" value="<?php echo $d['comment']['edit_height']?>" size="5" class="input" />픽셀
			</td>
		</tr>
		<tr>
			<td class="td1">비밀글등록</td>
			<td class="td2">
				<select name="use_hidden">
				<option value="1"<?php if($d['comment']['use_hidden']==1):?> selected="selected"<?php endif?>>사용함</option>
				<option value="0"<?php if($d['comment']['use_hidden']==0):?> selected="selected"<?php endif?>>사용안함</option>
				</select>			
			</td>
		</tr>
		<tr>
			<td class="td1">댓글출력수</td>
			<td class="td2">
				<input type="text" name="recnum" value="<?php echo $d['comment']['recnum']?>" size="5" class="input" />개
			</td>
		</tr>
		<tr>
			<td class="td1">댓글정렬</td>
			<td class="td2 shift">
				<input type="radio" name="orderby1" value="asc"<?php if(!$d['comment']['orderby1']||$d['comment']['orderby1']=='asc'):?> checked="checked"<?php endif?> />최근댓글이 위로정렬
				<input type="radio" name="orderby1" value="desc"<?php if($d['comment']['orderby1']=='desc'):?> checked="checked"<?php endif?> />최근댓글이 아래로정렬
			</td>
		</tr>
		<tr>
			<td class="td1">한줄의견정렬</td>
			<td class="td2 shift">
				<input type="radio" name="orderby2" value="desc"<?php if($d['comment']['orderby2']=='desc'):?> checked="checked"<?php endif?> />최근한줄의견이 위로정렬
				<input type="radio" name="orderby2" value="asc"<?php if(!$d['comment']['orderby2']||$d['comment']['orderby2']=='asc'):?> checked="checked"<?php endif?> />최근한줄의견이 아래로정렬
			</td>
		</tr>
		<tr>
			<td class="td1">삭제제한</td>
			<td class="td2 shift">
				<input type="checkbox" name="onelinedel" value="1"<?php if($d['comment']['onelinedel']):?> checked="checked"<?php endif?> />한줄의견이 있는 댓글의 삭제를 제한합니다.
			</td>
		</tr>
		<tr>
			<td class="td1">불량글 처리</td>
			<td class="td2 shift">
				<input type="checkbox" name="singo_del" value="1"<?php if($d['comment']['singo_del']):?> checked="checked"<?php endif?> />신고수가 
				<input type="text" name="singo_del_num" value="<?php echo $d['comment']['singo_del_num']?>" size="5" class="input" />건 이상일 경우 
				<select name="singo_del_act">
				<option value="1"<?php if($d['comment']['singo_del_act']==1):?> selected="selected"<?php endif?>>자동삭제</option>
				<option value="2"<?php if($d['comment']['singo_del_act']==2):?> selected="selected"<?php endif?>>비밀처리</option>
				</select>
			</td>
		</tr>

		<tr>
			<td class="td1">제한단어</td>
			<td class="td2">
				<textarea name="badword" rows="5" cols="70" onfocus="this.style.color='#000000';" onblur="this.style.color='#ffffff';"><?php echo $d['comment']['badword']?></textarea>
			
			</td>
		</tr>
		<tr>
			<td class="td1">제한단어 처리</td>
			<td class="td2">
				<input type="radio" name="badword_action" value="0"<?php if($d['comment']['badword_action']==0):?> checked="checked"<?php endif?> />제한단어 체크하지 않음<br />
				<input type="radio" name="badword_action" value="1"<?php if($d['comment']['badword_action']==1):?> checked="checked"<?php endif?> />등록을 차단함<br />
				<input type="radio" name="badword_action" value="2"<?php if($d['comment']['badword_action']==2):?> checked="checked"<?php endif?> />제한단어를 다음의 문자로 치환하여 등록함
				<input type="text" name="badword_escape" value="<?php echo $d['comment']['badword_escape']?>" size="1" maxlength="1" class="input" />
			</td>
		</tr>
		<tr>
			<td class="td1">댓글포인트</td>
			<td class="td2">
				<input type="text" name="give_point" value="<?php echo $d['comment']['give_point']?>" size="5" class="input" />포인트지급 (등록한 댓글을 삭제시 환원됩니다)
			</td>
		</tr>
		<tr>
			<td class="td1">한줄의견포인트</td>
			<td class="td2">
				<input type="text" name="give_opoint" value="<?php echo $d['comment']['give_opoint']?>" size="5" class="input" />포인트지급 (등록한 한줄의견을 삭제시 환원됩니다)
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


