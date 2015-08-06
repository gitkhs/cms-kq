<?
	include_once $g['dir_module'].'var/mbrlevel.php';
	include_once $g['dir_module'].'var/_theme.php';
	include_once $g['path_module'].'member/var/var.join.php';
?>
<div id="member">
	<form id="frmWrite" method="post" action="<?=$g['s']?>/" target="_action_frame_<?=$m?>">
	<input type="hidden" name="r" value="<?=$r?>" />
	<input type="hidden" name="a" value="<?=$mod?>" />
	<input type="hidden" name="m" value="<?=$m?>" />
	<input type="hidden" name="div" value="<?=$div?>" />

	<table class="tbl-form">
	<colgroup> 
		<col width="150px"> 
		<col> 
		<col width="150px"> 
		<col> 
	</colgroup> 

	<tr>
		<td class="lbl">가입승인처리</td>
		<td>
			<label><input type="radio" name="join_auth" value="1" <?if($d['member']['join_auth']==1) echo 'checked="checked"';?>> 즉시승인</label>
			<label><input type="radio" name="join_auth" value="2" <?if($d['member']['join_auth']==2) echo 'checked="checked"';?>> 관리자승인</label>
		</td>
		<td class="lbl">탈퇴후 재가입</td>
		<td>
			<label><input type="radio" name="join_rejoin" value="0" <?if(!$d['member']['join_rejoin']) echo 'checked="checked"';?>> 허용</label>
			<label><input type="radio" name="join_rejoin" value="1" <?if($d['member']['join_rejoin']) echo 'checked="checked"';?>> 허용안함</label>
		</td>
	</tr>
	<tr>
		<td class="lbl">사용제한 아이디</td>
		<td>
			<input type="text" name="join_cutid" value="<?=$d['member']['join_cutid']?>">
			<div class="row">콤마(,)로 구분해서 입력해 주세요.</div>
		</td>
		<td class="lbl">사용제한 닉네임</td>
		<td>
			<input type="text" name="join_cutnic" value="<?=$d['member']['join_cutnic']?>">
			<div class="row">콤마(,)로 구분해서 입력해 주세요.</div>
		</td>
	</tr>
	<tr>
		<td class="lbl">약관/개인정보</td>
		<td>
			<label><input type="radio" name="form_agree" value="0"  <?if(!$d['member']['form_agree']) echo 'checked="checked"';?>> 생략</label>
			<label><input type="radio" name="form_agree" value="1"  <?if($d['member']['form_agree']) echo 'checked="checked"';?>> 동의얻음</label>
			[<a href="#" onclick="OpenWindow('<?=$g['s']?>/?r=<?=$r?>&amp;m=<?=$m?>&amp;mod=master&amp;div=member_agree&amp;winmod=Y'); return false;"><b>동의서 작성</b></a>]
		</td>
		<td class="lbl">가입완료 메시지</td>
		<td>
			<input type="text" name="join_pointmsg" value="<?=$d['member']['join_pointmsg']?>">
		</td>
	</tr>
	<tr>
		<td class="lbl">회원등급 관리</td>
		<td colspan="3">
			<?
			$level_val = '';
			foreach($levelset as $_val)
				$level_val .= ','.$_val;
			$level_val = substr($level_val,1);
			?>
			<input type="text" name="level_val" size="120" value="<?=$level_val?>">
			<div class="row">등급관리 명칭을 콤마(,)로 구분해서 입력 해주세요.</div>
		</td>
	</tr>
	<tr>
		<td class="lbl">입력 받을 항목</td>
		<td colspan="3">
			<ul class="optlst">
				<?$pilsuset = array('아이디','이메일','패스워드','이름');?>
				<?foreach($pilsuset as $_val){?>
				<li><label><input type="checkbox" checked="checked" disabled="disabled"><?=$_val?></label> - <label><input type="checkbox"  checked="checked" disabled="disabled">필수입력</label></li>
				<?}?>

				<?$opset = array('qa'=>'비번찾기질답','tel2'=>'휴대폰','tel1'=>'집전화','addr'=>'주소','nic'=>'닉네임','birth'=>'생년월일','sex'=>'성별','home'=>'홈페이지','job'=>'직업','marr'=>'결혼기념일')?>
				<?foreach($opset as $_key => $_val){?>
				<li><label><input type="checkbox" name="form_<?=$_key?>" value="1" <?if($d['member']['form_'.$_key]) echo 'checked="checked"';?>><?=$_val?></label> - <label><input type="checkbox" name="form_<?=$_key?>_p" value="1" <?if($d['member']['form_'.$_key.'_p']) echo 'checked="checked"';?>>필수입력</label></li>
				<?}?>
			</ul>
			<div class="clear"></div>
		</td>
	</tr>
	<tr>
		<td class="lbl">추가 입력 항목</td>
		<td colspan="3">
			<div class="row">서비스도중 양식을 추가하면 이미 가입한 회원에 대해서는 반영되지 않습니다.</div>
			<table class="tbl-line">
			<colgroup> 
				<col width="100"> 
				<col width="100"> 
				<col> 
				<col width="80"> 
				<col width="60"> 
				<col width="60"> 
				<col width="60"> 
			</colgroup> 
			<tr>
				<td class="th">명칭</td>
				<td class="th">형식</td>
				<td class="th">속성 (항목을 콤마(,)로 구분)</td>
				<td class="th">넓이(px)</td>
				<td class="th">필수</td>
				<td class="th">숨김</td>
				<td class="th"></td>
			</tr>
			
			<?php $_add = file($g['path_module'].'member/var/add_field.txt')?>
			<?php foreach($_add as $_key):?>
			<?php $_val = explode('|',trim($_key))?>
			<tr>
			<td class="c"><input type="text" name="add_name_<?php echo $_val[0]?>" size="13" value="<?php echo $_val[1]?>" class="input" /></td>
			<td class="c">
				<input type="checkbox" name="addFieldMembers[]" value="<?php echo $_val[0]?>" checked="checked" class="hide" />
				<select name="add_type_<?php echo $_val[0]?>">
				<option value="text"<?php if($_val[2]=='text'):?> selected="selected"<?php endif?>>TEXT</option>
				<option value="password"<?php if($_val[2]=='password'):?> selected="selected"<?php endif?>>PASSWORD</option>
				<option value="select"<?php if($_val[2]=='select'):?> selected="selected"<?php endif?>>SELECT</option>
				<option value="radio"<?php if($_val[2]=='radio'):?> selected="selected"<?php endif?>>RADIO</option>
				<option value="checkbox"<?php if($_val[2]=='checkbox'):?> selected="selected"<?php endif?>>CHECKBOX</option>
				<option value="textarea"<?php if($_val[2]=='textarea'):?> selected="selected"<?php endif?>>TEXTAREA</option>
				</select>
			</td>
			<td class="c"><input type="text" name="add_value_<?php echo $_val[0]?>" size="50" value="<?php echo $_val[3]?>" class="input" /></td>
			<td class="c"><input type="text" name="add_size_<?php echo $_val[0]?>" size="4" value="<?php echo $_val[4]?>" class="input" /></td>
			<td class="c"><input type="checkbox" name="add_pilsu_<?php echo $_val[0]?>" value="1"<?php if($_val[5]):?> checked="checked"<?php endif?> /></td>
			<td class="c"><input type="checkbox" name="add_hidden_<?php echo $_val[0]?>" value="1"<?php if($_val[6]):?> checked="checked"<?php endif?> /></td>
			<td class="c"><input type="button" value="삭제" class="btnred" onclick="delField(this.form,'<?php echo $_val[0]?>');" /></td>
			</tr>
			<?php endforeach?>
			
			<tr class="addline">
			<td class="c"><input type="text" name="add_name" size="13" class="input" /></td>
			<td class="c">
				<select name="add_type">
				<option value="text">TEXT</option>
				<option value="password">PASSWORD</option>
				<option value="select">SELECT</option>
				<option value="radio">RADIO</option>
				<option value="checkbox">CHECKBOX</option>
				<option value="textarea">TEXTAREA</option>
				</select>
			</td>
			<td class="c"><input type="text" name="add_value" size="50" class="input" /></td>
			<td class="c"><input type="text" name="add_size" size="4" class="input" /></td>
			<td class="c"><input type="checkbox" name="add_pilsu" /></td>
			<td class="c"><input type="checkbox" name="add_hidden" /></td>
			<td class="c"><input type="button" value="추가" class="btnorange" onclick="addField(this.form);" /></td>
			</tr>

			</table>
		</td>
	</tr>
	<tr>
		<td class="submit" colspan="4">
			<input type="submit" class="btnblue btnsz01" value="확 인">
		</td>
	</td>

	</table>
	
	</form>
</div>


<script type="text/javascript">
function addField(f)
{
	if (f.add_name.value == '')
	{
		alert('명칭을 입력해 주세요.  ');
		f.add_name.focus();
		return false;
	}
	f.submit();
}
function delField(f,dval)
{
	if (confirm('정말로 삭제하시겠습니까?   '))
	{
		var l = document.getElementsByName('addFieldMembers[]');
		var n = l.length;
		var i;

		for (i = 0; i < n; i++)
		{
			if (dval == l[i].value)
			{
				l[i].checked = false;
			}
		}
		f.submit();
	}
}
</script>
