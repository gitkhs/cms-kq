
<div id="pages_join">

	<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="c" value="<?php echo $c?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	<input type="hidden" name="front" value="<?php echo $front?>" />
	<input type="hidden" name="a" value="join" />
	<input type="hidden" name="check_id" value="0" />
	<input type="hidden" name="check_nic" value="0" />
	<input type="hidden" name="check_email" value="0" />
	<input type="hidden" name="comp" value="<?php echo $comp?>" />

	<h2>회원가입</h2>

	<div class="msg">
		<span>(*)</span> 표시가 있는 항목은 반드시 입력해야 합니다.<br />
		허위로 작성된 정보일 경우 승인이 보류되거나 임의로 삭제처리될 수 있으니 주의해 주세요.
	</div>


	<table summary="회원가입 기본정보를 입력받는 표입니다.">
	<caption>회원가입 기본정보</caption> 
	<colgroup> 
	<col width="100"> 
	<col> 
	</colgroup> 
	<thead>
	<tr>
	<th scope="col"></th>
	<th scope="col"></th>
	</tr>
	</thead>
	<tbody>
	<tr>
	<td class="key">이름(실명)<span>*</span></td>
	<td>
		<input type="text" name="name" value="<?php echo $regis_name?>" maxlength="10" class="input" />
	</td>
	</tr>
	<?php if($d['member']['form_nic']):?>
	<tr>
	<td class="key">닉네임<?php if($d['member']['form_nic_p']):?><span>*</span><?php endif?></td>
	<td>
		<input type="text" name="nic" value="" maxlength="20" class="input" />
		<input type="button" value="중복확인" class="btngray" onclick="sameCheck(this.form.nic,'hLayernic');" />
		<div class="hmsg" id="hLayernic"></div>
		<div>닉네임은 자신을 표현할 수 있는 단어로 20자까지 자유롭게 사용할 수 있습니다.</div>
	</td>
	</tr>
	<?php endif?>
	<?php if($d['member']['form_birth']):?>
	<tr>
	<td class="key">생년월일<?php if($d['member']['form_birth_p']):?><span>*</span><?php endif?></td>
	<td>
		<select name="birth_1">
		<option value="">년도</option>
		<?php for($i = substr($date['today'],0,4); $i > 1930; $i--):?>
		<option value="<?php echo $i?>"<?php if(substr($i,-2)==substr($regis_jumin1,0,2)):?> selected="selected"<?php endif?>><?php echo $i?></option>
		<?php endfor?>
		</select>
		<select name="birth_2">
		<option value="">월</option>
		<?php for($i = 1; $i < 13; $i++):?>
		<option value="<?php echo sprintf('%02d',$i)?>"<?php if($i==substr($regis_jumin1,2,2)):?> selected="selected"<?php endif?>><?php echo $i?></option>
		<?php endfor?>
		</select>
		<select name="birth_3">
		<option value="">일</option>
		<?php for($i = 1; $i < 32; $i++):?>
		<option value="<?php echo sprintf('%02d',$i)?>"<?php if($i==substr($regis_jumin1,4,2)):?> selected="selected"<?php endif?>><?php echo $i?></option>
		<?php endfor?>
		</select>
		<input type="checkbox" name="birthtype" value="1" />음력
	</td>
	</tr>
	<?php endif?>
	<?php if($d['member']['form_sex']):?>
	<tr>
	<td class="key">성별<?php if($d['member']['form_sex_p']):?><span>*</span><?php endif?></td>
	<td class="shift">
		<div class="shift">
		<input type="radio" name="sex" value="1"<?php if($regis_jumin2&&(substr($regis_jumin2,0,1)%2)==1):?> checked="checked"<?php endif?> />남성
		<input type="radio" name="sex" value="2"<?php if($regis_jumin2&&(substr($regis_jumin2,0,1)%2)==0):?> checked="checked"<?php endif?> />여성
		</div>
	</td>
	</tr>
	<?php endif?>

	<tr>
	<td class="key">아이디<span>*</span></td>
	<td>
		<input type="text" name="id" value="" maxlength="12" class="input" />
		<input type="button" value="중복확인" class="btngray" onclick="sameCheck(this.form.id,'hLayerid');" />
		<div class="hmsg" id="hLayerid"></div>
		<div>4~12자의 영문(소문자)과 숫자만 사용할 수 있습니다.</div>
	</td>
	</tr>

	<tr>
	<td class="key">비밀번호<span>*</span></td>
	<td>
		<input type="password" name="pw1" value="" maxlength="20" class="input" />
		<div>4~12자의 영문과 숫자만 사용할 수 있습니다.</div>
	</td>
	</tr>

	<tr>
	<td class="key">비번확인<span>*</span></td>
	<td>
		<input type="password" name="pw2" value="" maxlength="20" class="input" />
		<div>비밀번호를 한번 더 입력하세요. 비밀번호는 잊지 않도록 주의하시기 바랍니다.</div>
	</td>
	</tr>

	<?php if($d['member']['form_qa']):?>
	<tr>
	<td class="key">비번찾기<br />질문<?php if($d['member']['form_qa_p']):?><span>*</span><?php endif?></td>
	<td>
		<select name="_pw_q" class="lsize" onchange="this.form.pw_q.value=this.value;this.value='';this.form.pw_a.focus();">
		<option value="">&nbsp;+ 선택하십시오.</option>
		<option value="">-----------------------------------------------------------------------------</option>
		<?php $_pw_question=file($g['dir_module'].'var/pw_question.txt')?>
		<?php foreach($_pw_question as $_val):?>
		<option value="<?php echo trim($_val)?>">ㆍ<?php echo trim($_val)?></option>
		<?php endforeach?>
		</select><br />
		<div><input type="text" name="pw_q" value="" class="input lsize" /></div>
	</td>
	</tr>
	<tr>
	<td class="key">비번찾기<br />답변<?php if($d['member']['form_qa_p']):?><span>*</span><?php endif?></td>
	<td>
		<input type="text" name="pw_a" value="" class="input" />
		<div>
		비밀번호찾기 질문에 대한 답변을 혼자만 알 수 있는 단어나 기호로 입력해 주세요.<br />
		비밀번호를 찾을 때 필요하므로 반드시 기억해 주세요.
		</div>
	</td>
	</tr>
	<?php endif?>

	<tr>
	<td class="key">이메일<span>*</span></td>
	<td>
		<input type="email" name="email" value="" class="input" />
		<input type="button" value="중복확인" class="btngray" onclick="sameCheck(this.form.email,'hLayeremail');" />
		<div class="hmsg" id="hLayeremail"></div>
		<?php if($d['member']['join_auth']==3):?>
		<div>가입후 입력하신 이메일로 인증메일이 발송되며 인증을 거쳐야만 가입승인이 이루어집니다.</div>
		<?php endif?>
		<div class="remail shift"><div class="shift"><input type="checkbox" name="remail" value="1" checked="checked" />뉴스레터/공지이메일을 수신받겠습니다.</div></div>
	</td>
	</tr>

	<?php if($d['member']['form_home']):?>
	<tr>
	<td class="key">홈페이지<?php if($d['member']['form_home_p']):?><span>*</span><?php endif?></td>
	<td>
		<input type="url" name="home" value="" class="input lsize" />
	</td>
	</tr>
	<?php endif?>

	<?php if($d['member']['form_tel2']):?>
	<tr>
	<td class="key">휴대전화<?php if($d['member']['form_tel2_p']):?><span>*</span><?php endif?></td>
	<td>
		<input type="tel" name="tel2_1" value="" maxlength="3" size="4" class="input" />-
		<input type="tel" name="tel2_2" value="" maxlength="4" size="4" class="input" />-
		<input type="tel" name="tel2_3" value="" maxlength="4" size="4" class="input" />
		<div class="remail shift"><div class="shift"><input type="checkbox" name="sms" value="1" checked="checked" />알림문자를 받겠습니다.</div></div>
	</td>
	</tr>
	<?php endif?>

	<?php if($d['member']['form_tel1']):?>
	<tr>
	<td class="key">전화번호<?php if($d['member']['form_tel1_p']):?><span>*</span><?php endif?></td>
	<td>
		<input type="tel" name="tel1_1" value="" maxlength="4" size="4" class="input" />-
		<input type="tel" name="tel1_2" value="" maxlength="4" size="4" class="input" />-
		<input type="tel" name="tel1_3" value="" maxlength="4" size="4" class="input" />
	</td>
	</tr>
	<?php endif?>

	<?php if($d['member']['form_addr']):?>
	<tr>
	<td class="key">주소<?php if($d['member']['form_addr_p']):?><span>*</span><?php endif?></td>
	<td>
		<div id="addrbox">
		<div>
		<input type="number" name="zip_1" id="zip1" value="" maxlength="3" size="3" readonly="readonly" class="input" />-
		<input type="number" name="zip_2" id="zip2" value="" maxlength="3" size="3" readonly="readonly" class="input" /> 
		<input type="button" value="우편번호" class="btngray btn" onclick="OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&m=zipsearch&zip1=zip1&zip2=zip2&addr1=addr1&focusfield=addr2');" />
		</div>
		<div><input type="text" name="addr1" id="addr1" value="" readonly="readonly" class="input lsize" /></div>
		<div><input type="text" name="addr2" id="addr2" value="" class="input lsize" /></div>
		</div>
		<?php if($d['member']['form_foreign']):?>
		<div class="remail shift">
		<div class="shift"><input type="checkbox" name="foreign" value="1" onclick="foreignChk(this);" /><span id="foreign_ment">해외거주자일 경우 체크해 주세요.</span></div>
		</div>
		<?php endif?>
	</td>
	</tr>
	<?php endif?>


	<?php if($d['member']['form_job']):?>
	<tr>
	<td class="key">직업<?php if($d['member']['form_job_p']):?><span>*</span><?php endif?></td>
	<td>
		<select name="job">
		<option value="">&nbsp;+ 선택하세요</option>
		<option value="">------------------</option>
		<?php $_job=file($g['dir_module'].'var/job.txt')?>
		<?php foreach($_job as $_val):?>
		<option value="<?php echo trim($_val)?>">ㆍ<?php echo trim($_val)?></option>
		<?php endforeach?>
		</select>
	</td>
	</tr>
	<?php endif?>

	<?php if($d['member']['form_marr']):?>
	<tr>
	<td class="key">결혼기념일<?php if($d['member']['form_marr_p']):?><span>*</span><?php endif?></td>
	<td>
		<select name="marr_1">
		<option value="">년도</option>
		<?php for($i = substr($date['today'],0,4); $i > 1930; $i--):?>
		<option value="<?php echo $i?>"><?php echo $i?></option>
		<?php endfor?>
		</select>
		<select name="marr_2">
		<option value="">월</option>
		<?php for($i = 1; $i < 13; $i++):?>
		<option value="<?php echo sprintf('%02d',$i)?>"><?php echo $i?></option>
		<?php endfor?>
		</select>
		<select name="marr_3">
		<option value="">일</option>
		<?php for($i = 1; $i < 32; $i++):?>
		<option value="<?php echo sprintf('%02d',$i)?>"><?php echo $i?></option>
		<?php endfor?>
		</select>
	</td>
	</tr>
	<?php endif?>

	<?php $_add = file($g['dir_module'].'var/add_field.txt')?>
	<?php foreach($_add as $_key):?>
	<?php $_val = explode('|',trim($_key))?>
	<?php if($_val[6]) continue?>
	<tr>
	<td class="key"><?php echo $_val[1]?><?php if($_val[5]):?><span>*</span><?php endif?></td>
	<td>
	<?php if($_val[2]=='text'):?>
	<input type="text" name="add_<?php echo $_val[0]?>" class="input" style="width:<?php echo $_val[4]?>px;" value="<?php echo $_val[3]?>" />
	<?php endif?>
	<?php if($_val[2]=='password'):?>
	<input type="password" name="add_<?php echo $_val[0]?>" class="input" style="width:<?php echo $_val[4]?>px;" value="<?php echo $_val[3]?>" />
	<?php endif?>
	<?php if($_val[2]=='select'): $_skey=explode(',',$_val[3])?>
	<select name="add_<?php echo $_val[0]?>" style="width:<?php echo $_val[4]?>px;">
	<option value="">&nbsp;+ 선택하세요</option>
	<?php foreach($_skey as $_sval):?>
	<option value="<?php echo trim($_sval)?>">ㆍ<?php echo trim($_sval)?></option>
	<?php endforeach?>
	</select>
	<?php endif?>
	<?php if($_val[2]=='radio'): $_skey=explode(',',$_val[3])?>
	<div class="shift">
	<div class="shift">
	<?php foreach($_skey as $_sval):?>
	<input type="radio" name="add_<?php echo $_val[0]?>" value="<?php echo trim($_sval)?>" /><?php echo trim($_sval)?>
	<?php endforeach?>
	</div>
	</div>
	<?php endif?>
	<?php if($_val[2]=='checkbox'): $_skey=explode(',',$_val[3])?>
	<div class="shift">
	<div class="shift">
	<?php foreach($_skey as $_sval):?>
	<input type="checkbox" name="add_<?php echo $_val[0]?>[]" value="<?php echo trim($_sval)?>" /><?php echo trim($_sval)?>
	<?php endforeach?>
	</div>
	</div>
	<?php endif?>
	<?php if($_val[2]=='textarea'):?>
	<textarea name="add_<?php echo $_val[0]?>" rows="5" style="width:<?php echo $_val[4]?>px;"><?php echo $_val[3]?></textarea>
	<?php endif?>

	</tr>
	<?php endforeach?>
	</tbody>
	</table>

	<?php if($d['member']['form_comp'] && $comp):?>
	<h3>기업정보</h3>

	<table summary="회원가입 기업정보를 입력받는 표입니다.">
	<caption>회원가입 기업정보</caption> 
	<colgroup> 
	<col width="100"> 
	<col> 
	</colgroup> 
	<thead>
	<tr>
	<th scope="col"></th>
	<th scope="col"></th>
	</tr>
	</thead>
	<tbody>
	<tr>
	<td class="key">사업자번호<span>*</span></td>
	<td>
		<input type="number" name="comp_num_1" size="4" maxlength="3" class="input" /> -
		<input type="number" name="comp_num_2" size="3" maxlength="2" class="input" /> -
		<input type="number" name="comp_num_3" size="5" maxlength="5" class="input" />
		<div class="remail shift">
		<div class="shift">
		<input type="radio" name="comp_type" value="1" checked="checked" />개인
		<input type="radio" name="comp_type" value="2" />법인
		</div>
		</div>
	</td>
	</tr>
	<tr>
	<td class="key">회사명<span>*</span></td>
	<td>
		<input type="text" name="comp_name" class="input" />
	</td>
	</tr>
	<tr>
	<td class="key">대표자명<span>*</span></td>
	<td>
		<input type="text" name="comp_ceo" class="input" />
	</td>
	</tr>
	<tr>
	<td class="key">업태<span>*</span></td>
	<td>
		<input type="text" name="comp_upte" class="input" />
	</td>
	</tr>
	<tr>
	<td class="key">종목<span>*</span></td>
	<td>
		<input type="text" name="comp_jongmok" class="input" />
	</td>
	</tr>
	<tr>
	<td class="key">대표전화<span>*</span></td>
	<td>
		<input type="tel" name="comp_tel_1" value="" maxlength="4" size="4" class="input" />-
		<input type="tel" name="comp_tel_2" value="" maxlength="4" size="4" class="input" />-
		<input type="tel" name="comp_tel_3" value="" maxlength="4" size="4" class="input" />
	</td>
	</tr>
	<tr>
	<td class="key">팩스</td>
	<td>
		<input type="tel" name="comp_fax_1" value="" maxlength="4" size="4" class="input" />-
		<input type="tel" name="comp_fax_2" value="" maxlength="4" size="4" class="input" />-
		<input type="tel" name="comp_fax_3" value="" maxlength="4" size="4" class="input" />
	</td>
	</tr>
	<tr>
	<td class="key">소속부서</td>
	<td>
		<input type="text" name="comp_part" class="input" />
	</td>
	</tr>
	<tr>
	<td class="key">직책</td>
	<td>
		<input type="text" name="comp_level" class="input" />
	</td>
	</tr>
	<tr>
	<td class="key">사업장주소<span>*</span></td>
	<td>
		<div>
		<input type="number" name="comp_zip_1" id="comp_zip1" value="" maxlength="3" size="3" readonly="readonly" class="input" />-
		<input type="number" name="comp_zip_2" id="comp_zip2" value="" maxlength="3" size="3" readonly="readonly" class="input" /> 
		<input type="button" value="우편번호" class="btngray btn" onclick="OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&m=zipsearch&zip1=comp_zip1&zip2=comp_zip2&addr1=comp_addr1&focusfield=comp_addr2');" />
		</div>
		<div><input type="text" name="comp_addr1" id="comp_addr1" value="" readonly="readonly" class="input lsize" /></div>
		<div><input type="text" name="comp_addr2" id="comp_addr2" value="" class="input lsize" /></div>
	</td>
	</tr>
	</tbody>
	</table>
	<?php endif?>


	
	<div class="submitbox">
		<input type="button" value="가입취소" class="btngray" onclick="goHref('<?php echo $g['r']?>/');" />
		<input type="submit" value="회원가입" class="btnblue" />
	</div>

	</form>

</div>

<script type="text/javascript">
//<![CDATA[
function foreignChk(obj)
{
	if (obj.checked == true)
	{
		getId('addrbox').style.display = 'none';
		getId('foreign_ment').innerHTML= '해외거주자 입니다.';
	}
	else {
		getId('addrbox').style.display = 'block';
		getId('foreign_ment').innerHTML= '해외거주자일 경우 체크해 주세요.';
	}
}
function sameCheck(obj,layer)
{

	if (!obj.value)
	{
		eval('obj.form.check_'+obj.name).value = '0';
		getId(layer).innerHTML = '';
		alert('값을 입력한 후 중복확인버튼을 터치해 주세요.   ');
		obj.focus();
		return false;
	}
	else
	{
		if (obj.name == 'id')
		{
			if (obj.value.length < 4 || obj.value.length > 12 || !chkIdValue(obj.value))
			{
				obj.form.check_id.value = '0';
				obj.focus();
				getId(layer).innerHTML = '사용할 수 없는 아이디입니다.';
				return false;
			}
		}
		if (obj.name == 'email')
		{
			if (!chkEmailAddr(obj.value))
			{
				obj.form.check_email.value = '0';
				obj.focus();
				getId(layer).innerHTML = '이메일형식이 아닙니다.';
				return false;
			}
		}

		frames._action_frame_<?php echo $m?>.location.href = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>&a=same_check&fname=' + obj.name + '&fvalue=' + obj.value + '&flayer=' + layer;
	}
}
function saveCheck(f)
{
	if (f.name.value == '')
	{
		alert('이름을 입력해 주세요.');
		f.name.focus();
		return false;
	}
	<?php if($d['member']['form_nic_p']):?>
	if (f.check_nic.value == '0')
	{
		alert('닉네임을 확인해 주세요.');
		f.nic.focus();
		return false;
	}
	<?php endif?>
	<?php if($d['member']['form_birth']&&$d['member']['form_birth_p']):?>
	if (f.birth_1.value == '')
	{
		alert('생년월일을 지정해 주세요.');
		f.birth_1.focus();
		return false;
	}
	if (f.birth_2.value == '')
	{
		alert('생년월일을 지정해 주세요.');
		f.birth_2.focus();
		return false;
	}
	if (f.birth_3.value == '')
	{
		alert('생년월일을 지정해 주세요.');
		f.birth_3.focus();
		return false;
	}
	<?php endif?>
	<?php if($d['member']['form_sex']&&$d['member']['form_sex_p']):?>
	if (f.sex[0].checked == false && f.sex[1].checked == false)
	{
		alert('성별을 선택해 주세요.  ');
		return false;
	}
	<?php endif?>
	if (f.check_id.value == '0')
	{
		alert('아이디를 확인해 주세요.');
		f.id.focus();
		return false;
	}

	if (f.pw1.value == '')
	{
		alert('패스워드를 입력해 주세요.');
		f.pw1.focus();
		return false;
	}
	if (f.pw2.value == '')
	{
		alert('패스워드를 한번더 입력해 주세요.');
		f.pw2.focus();
		return false;
	}
	if (f.pw1.value != f.pw2.value)
	{
		alert('패스워드가 일치하지 않습니다.');
		f.pw1.focus();
		return false;
	}

	<?php if($d['member']['form_qa']&&$d['member']['form_qa_p']):?>
	if (f.pw_q.value == '')
	{
		alert('비밀번호 찾기 질문을 입력해 주세요.');
		f.pw_q.focus();
		return false;
	}
	if (f.pw_a.value == '')
	{
		alert('비밀번호 찾기 답변을 입력해 주세요.');
		f.pw_a.focus();
		return false;
	}
	<?php endif?>


	if (f.check_email.value == '0')
	{
		alert('이메일을 확인해 주세요.');
		f.email.focus();
		return false;
	}

	<?php if($d['member']['form_home']&&$d['member']['form_home_p']):?>
	if (f.home.value == '')
	{
		alert('홈페이지 주소를 입력해 주세요.');
		f.home.focus();
		return false;
	}
	<?php endif?>


	<?php if($d['member']['form_tel2']&&$d['member']['form_tel2_p']):?>
	if (f.tel2_1.value == '')
	{
		alert('휴대폰번호를 입력해 주세요.');
		f.tel2_1.focus();
		return false;
	}
	if (f.tel2_2.value == '')
	{
		alert('휴대폰번호를 입력해 주세요.');
		f.tel2_2.focus();
		return false;
	}
	if (f.tel2_3.value == '')
	{
		alert('휴대폰번호를 입력해 주세요.');
		f.tel2_3.focus();
		return false;
	}
	<?php endif?>

	<?php if($d['member']['form_tel1']&&$d['member']['form_tel1_p']):?>
	if (f.tel1_1.value == '')
	{
		alert('전화번호를 입력해 주세요.');
		f.tel1_1.focus();
		return false;
	}
	if (f.tel1_2.value == '')
	{
		alert('전화번호를 입력해 주세요.');
		f.tel1_2.focus();
		return false;
	}
	if (f.tel1_3.value == '')
	{
		alert('전화번호를 입력해 주세요.');
		f.tel1_3.focus();
		return false;
	}
	<?php endif?>

	<?php if($d['member']['form_addr']&&$d['member']['form_addr_p']):?>
	if (!f.foreign || f.foreign.checked == false)
	{
		if (f.addr1.value == ''||f.addr2.value == '')
		{
			alert('주소를 입력해 주세요.');
			f.addr2.focus();
			return false;
		}
	}
	<?php endif?>


	<?php if($d['member']['form_job']&&$d['member']['form_job_p']):?>
	if (f.job.value == '')
	{
		alert('직업을 선택해 주세요.');
		f.job.focus();
		return false;
	}
	<?php endif?>

	<?php if($d['member']['form_marr']&&$d['member']['form_marr_p']):?>
	if (f.marr_1.value == '')
	{
		alert('결혼기념일을 지정해 주세요.');
		f.marr_1.focus();
		return false;
	}
	if (f.marr_2.value == '')
	{
		alert('결혼기념일을 지정해 주세요.');
		f.marr_2.focus();
		return false;
	}
	if (f.marr_3.value == '')
	{
		alert('결혼기념일을 지정해 주세요.');
		f.marr_3.focus();
		return false;
	}
	<?php endif?>

	
	var radioarray;
	var checkarray;
	var i;
	var j = 0;

	<?php foreach($_add as $_key):?>
	<?php $_val = explode('|',trim($_key))?>
	<?php if(!$_val[5]||$_val[6]) continue?>

	<?php if($_val[2]=='text' || $_val[2]=='password' || $_val[2]=='select' || $_val[2]=='textarea'):?>
	if (f.add_<?php echo $_val[0]?>.value == '')
	{
		alert('<?php echo $_val[1]?>이(가) <?php echo $_val[2]=='select'?'선택':'입력'?>되지 않았습니다.     ');
		f.add_<?php echo $_val[0]?>.focus();
		return false;
	}
	<?php endif?>
	<?php if($_val[2]=='radio'):?>
	j = 0;
	radioarray = f.add_<?php echo $_val[0]?>;
	for (i = 0; i < radioarray.length; i++)
	{
		if (radioarray[i].checked == true) j++;
	}
	if (!j)
	{
		alert('<?php echo $_val[1]?>이(가) 선택되지 않았습니다.     ');
		radioarray[0].focus();
		return false;
	}
	<?php endif?>
	<?php if($_val[2]=='checkbox'):?>
	j = 0;
	checkarray = document.getElementsByName("add_<?php echo $_val[0]?>[]");
	for (i = 0; i < checkarray.length; i++)
	{
		if (checkarray[i].checked == true) j++;
	}
	if (!j)
	{
		alert('<?php echo $_val[1]?>이(가) 선택되지 않았습니다.     ');
		checkarray[0].focus();
		return false;
	}
	<?php endif?>
	<?php endforeach?>


	<?php if($d['member']['form_comp'] && $comp):?>
	if (f.comp_num_1.value == '')
	{
		alert('사업자등록번호를 입력해 주세요.     ');
		f.comp_num_1.focus();
		return false;
	}
	if (f.comp_num_2.value == '')
	{
		alert('사업자등록번호를 입력해 주세요.     ');
		f.comp_num_2.focus();
		return false;
	}
	if (f.comp_num_3.value == '')
	{
		alert('사업자등록번호를 입력해 주세요.     ');
		f.comp_num_3.focus();
		return false;
	}

	if (f.comp_name.value == '')
	{
		alert('회사명을 입력해 주세요.     ');
		f.comp_name.focus();
		return false;
	}
	if (f.comp_ceo.value == '')
	{
		alert('대표자명을 입력해 주세요.     ');
		f.comp_ceo.focus();
		return false;
	}
	if (f.comp_upte.value == '')
	{
		alert('업태를 입력해 주세요.     ');
		f.comp_upte.focus();
		return false;
	}
	if (f.comp_jongmok.value == '')
	{
		alert('종목을 입력해 주세요.     ');
		f.comp_jongmok.focus();
		return false;
	}
	if (f.comp_tel_1.value == '')
	{
		alert('대표전화번호를 입력해 주세요.');
		f.comp_tel_1.focus();
		return false;
	}
	if (f.comp_tel_2.value == '')
	{
		alert('대표전화번호를 입력해 주세요.');
		f.comp_tel_2.focus();
		return false;
	}

	if (f.comp_addr1.value == '')
	{
		alert('사업장주소를 입력해 주세요.');
		f.comp_addr2.focus();
		return false;
	}
	<?php endif?>


	return confirm('정말로 가입하시겠습니까?       ');
}
//]]>
</script>


