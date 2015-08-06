<?
	include_once $g['path_module'].'comment/var/var.php';
	include_once $g['dir_module'].'var/mbrlevel.php';
?>

<div id="comment">
	<form name="procForm" action="<?=$g['s']?>/" method="post"  target="_action_frame_<?=$m?>">
	<input type="hidden" name="r" value="<?=$r?>" />
	<input type="hidden" name="a" value="<?=$mod?>" />
	<input type="hidden" name="m" value="<?=$m?>" />
	<input type="hidden" name="mod" value="<?=$mod?>" />
	<input type="hidden" name="div" value="<?=$div?>" />
	<input type="hidden" name="actid" value="" />
	<input type="hidden" name="edit_height" value="50" />
	<input type="hidden" name="edit_tool" value="1" />

	<table class="tbl-form">
	<colgroup>
	<col width="150">
	<col>
	</colgroup>
	<tr>
		<td class="lbl">권한 설정</td>
		<td>
			<div class="row">
				<label>글쓰기</label>
				<select name="perm_write">
				<option value="">+ 전체허용</option>
				<?foreach($levelset as $_key => $_val){?>
				<option value="<?=$_key?>" <?php if($d['comment']['perm_write']==$_key):?>selected="selected"<?php endif?>>ㆍ<?=$_val?> </option>
				<?}?>
				</select>
				<span class="dv">|</span>
				<label>사진첨부</label>
				<select name="perm_photo">
				<option value="">+ 전체허용</option>
				<?foreach($levelset as $_key => $_val){?>
				<option value="<?=$_key?>" <?php if($d['comment']['perm_photo']==$_key):?>selected="selected"<?php endif?>>ㆍ<?=$_val?> </option>
				<?}?>
				</select>
				<span class="dv">|</span>
				<label>파일첨부</label>
				<select name="perm_upfile">
				<option value="">+ 전체허용</option>
				<?foreach($levelset as $_key => $_val){?>
				<option value="<?=$_key?>" <?php if($d['comment']['perm_upfile']==$_key):?>selected="selected"<?php endif?>>ㆍ<?=$_val?> </option>
				<?}?>
				</select>
			</div>
		</td>
	</tr>
	<tr>
		<td class="lbl">댓글제목</td>
		<td>
			<div class="row">
				<label><input type="checkbox" name="use_subject" value="1" <?if($d['comment']['use_subject']) echo 'checked';?>/> 댓글제목을 사용합니다.</label>
			</div>
		</td>
	</tr>
	<tr>
		<td class="lbl">비밀글</td>
		<td>
			<div class="row">
				<label><input type="radio" name="use_hidden" value="1" <?if($d['comment']['use_hidden']==1) echo 'checked';?>/> 사용함</label>
				<label><input type="radio" name="use_hidden" value="0" <?if($d['comment']['use_hidden']==0) echo 'checked';?>/> 사용안함</label>
			</div>
		</td>
	</tr>
	<tr>
		<td class="lbl">댓글출력수</td>
		<td>
			<div class="row">
				<input type="text" name="recnum" value="<?=$d['comment']['recnum']?>" size="5" class="input" />개
			</div>
		</td>
	</tr>
	<tr>
		<td class="lbl">댓글정렬</td>
		<td>
			<div class="row">
				<label><input type="radio" name="orderby1" value="asc" <?if(!$d['comment']['orderby1']||$d['comment']['orderby1']=='asc') echo 'checked="checked"';?>/> 최근댓글이 위로정렬</label>
				<label><input type="radio" name="orderby1" value="desc" <?if($d['comment']['orderby1']=='desc') echo 'checked="checked"';?>/> 최근댓글이 아래로정렬</label>
			</div>
		</td>
	</tr>
	<tr>
		<td class="lbl">한줄의견정렬</td>
		<td>
			<div class="row">
				<label><input type="radio" name="orderby2" value="desc" <?if($d['comment']['orderby2']=='desc') echo 'checked="checked"';?>/> 최근한줄의견이 위로정렬</label>
				<label><input type="radio" name="orderby2" value="asc" <?if(!$d['comment']['orderby2']||$d['comment']['orderby2']=='asc') echo 'checked="checked"';?>/> 최근한줄의견이 아래로정렬</label>
			</div>
		</td>
	</tr>
	<tr>
		<td class="lbl">삭제제한</td>
		<td>
			<div class="row">
				<label><input type="checkbox" name="onelinedel" value="1" <?if($d['comment']['onelinedel']) echo 'checked="checked"';?> />한줄의견이 있는 댓글의 삭제를 제한합니다.</label>
			</div>
		</td>
	</tr>
	<tr>
		<td class="lbl">불량글 처리</td>
		<td>
			<div class="row">
				<label><input type="checkbox" name="singo_del" value="1" <?if($d['comment']['singo_del']) echo 'checked="checked"';?> />신고수가 </label>
				<input type="text" name="singo_del_num" value="<?php echo $d['comment']['singo_del_num']?>" size="5" class="input" />건 이상일 경우 
				<label><input type="radio" name="singo_del_act" value="1" <?if($d['comment']['singo_del_act']==1) echo 'checked="checked"';?> />자동삭제 </label>
				<label><input type="radio" name="singo_del_act" value="2" <?if($d['comment']['singo_del_act']==2) echo 'checked="checked"';?> />비밀처리 </label>
			</div>
		</td>
	</tr>
	<tr>
		<td class="lbl">제한단어</td>
		<td>
			<div class="row">
				<input type="text" name="badword" value="<?=$d['comment']['badword']?>" style="width:98%;"/>
			</div>
		</td>
	</tr>
	<tr>
		<td class="lbl">제한단어 처리</td>
		<td>
			<div class="row">
				<label><input type="radio" name="badword_action" value="0"<?php if($d['comment']['badword_action']==0):?> checked="checked"<?php endif?> />제한단어 체크하지 않음</label>
				<label><input type="radio" name="badword_action" value="1"<?php if($d['comment']['badword_action']==1):?> checked="checked"<?php endif?> />등록을 차단함</label>
				<label><input type="radio" name="badword_action" value="2"<?php if($d['comment']['badword_action']==2):?> checked="checked"<?php endif?> />제한단어를 다음의 문자로 치환하여 등록함</label>
				<input type="text" name="badword_escape" value="<?php echo $d['comment']['badword_escape']?>" size="1" maxlength="1" class="input" />
			</div>
		</td>
	</tr>
	<tr>
		<td class="lbl">댓글포인트</td>
		<td>
			<div class="row">
				<input type="text" name="give_point" value="<?php echo $d['comment']['give_point']?>" size="5" class="input" />포인트지급 (등록한 댓글을 삭제시 환원됩니다)
			</div>
		</td>
	</tr>
	<tr>
		<td class="lbl">한줄의견포인트</td>
		<td>
			<div class="row">
				<input type="text" name="give_opoint" value="<?php echo $d['comment']['give_opoint']?>" size="5" class="input" />포인트지급 (등록한 한줄의견을 삭제시 환원됩니다)
			</div>
		</td>
	</tr>
	
	<tr>
		<td class="submit" colspan="2">
		<input type="submit" class="btnblue btnsz01" value="변 경"/>
		</td>
	</tr>
	</table>
	
	</form>
	
</div>