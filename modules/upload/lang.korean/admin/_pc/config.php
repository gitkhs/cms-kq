<?php include_once $g['path_module'].$module.'/var/var.php'?>

<div id="configbox">

	<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="m" value="<?php echo $module?>" />
	<input type="hidden" name="a" value="config" />

	<input type="hidden" name="use_fileservera" value="<?php echo $d['upload']['use_fileserver']?>" />
	<input type="hidden" name="ftp_host" value="<?php echo $d['upload']['ftp_host']?>" />
	<input type="hidden" name="ftp_port" value="<?php echo $d['upload']['ftp_port']?>" />
	<input type="hidden" name="ftp_user" value="<?php echo $d['upload']['ftp_user']?>" />
	<input type="hidden" name="ftp_pass" value="<?php echo $d['upload']['ftp_pass']?>" />
	<input type="hidden" name="ftp_folder" value="<?php echo $d['upload']['ftp_folder']?>" />
	<input type="hidden" name="ftp_urlpath" value="<?php echo $d['upload']['ftp_urlpath']?>" />

	<div class="title">
		첨부파일 설정
	</div>


	<div class="notice">
		첨부파일 설정은 이 모듈을 사용하는 모든 곳에 일괄 적용됩니다.<br />
		첨부권한은 이 모듈을 사용하는 부모모듈의 설정을 따릅니다.<br />
		첨부파일은 ./files/ 폴더이하에 YYYY/MM/DD 형태의 폴더구성으로 저장되며 파일명은 암호화처리됩니다.
	</div>


	<table>
		<tr>
			<td class="td1">첨부파일 테마</td>
			<td class="td2">
				
				<select name="theme" class="select1">
				<option value="">&nbsp;+ 선택하세요</option>
				<option value="">------------------------------------</option>
				<?php $dirs = opendir($g['path_module'].$module.'/theme')?>
				<?php while(false !== ($tpl = readdir($dirs))):?>
				<?php if($tpl=='.' || $tpl == '..')continue?>
				<option value="<?php echo $tpl?>"<?php if($d['upload']['theme']==$tpl):?> selected="selected"<?php endif?>>ㆍ<?php echo getFolderName($g['path_module'].$module.'/theme/'.$tpl)?>(<?php echo $tpl?>)</option>
				<?php endwhile?>
				<?php closedir($dirs)?>
				</select>

			</td>
		</tr>
		<tr>
			<td class="td1">일반파일 첨부</td>
			<td class="td2">
				<input type="text" name="maxnum_file" value="<?php echo $d['upload']['maxnum_file']?>" size="5" class="input" />개
				(<input type="text" name="maxsize_file" value="<?php echo $d['upload']['maxsize_file']?>" size="5" class="input" />MB이내)
			</td>
		</tr>
		<tr>
			<td class="td1">사진파일 첨부</td>
			<td class="td2">
				<input type="text" name="maxnum_img" value="<?php echo $d['upload']['maxnum_img']?>" size="5" class="input" />개
				(<input type="text" name="maxsize_img" value="<?php echo $d['upload']['maxsize_img']?>" size="5" class="input" />MB이내)
				<div class="guide">
				현재 서버에서 허용하고 있는 1회 최대 첨부용량은 <span class="b"><?php echo str_replace('M','',ini_get('upload_max_filesize'))?>MB</span>입니다.
				</div>
			</td>
		</tr>
		<tr>
			<td class="td1">일반파일 명칭</td>
			<td class="td2">
				<input type="text" name="name_file" value="<?php echo $d['upload']['name_file']?>" size="10" class="input" />
				허용확장자 : 
				<input type="text" name="ext_file" value="<?php echo $d['upload']['ext_file']?>" size="30" class="input" />
			</td>
		</tr>
		<tr>
			<td class="td1">사진파일 명칭</td>
			<td class="td2">
				<input type="text" name="name_img" value="<?php echo $d['upload']['name_img']?>" size="10" class="input" />
				허용확장자 : 
				<input type="text" name="ext_img" value="<?php echo $d['upload']['ext_img']?>" size="30" class="input" />
			</td>
		</tr>
		<tr>
			<td class="td1">사진삽입 사이즈</td>
			<td class="td2">
				<select name="width_img">
				<option value="240"<?php if($d['upload']['width_img']=='240'):?> selected="selected"<?php endif?>>240px</option>
				<option value="320"<?php if($d['upload']['width_img']=='320'):?> selected="selected"<?php endif?>>320px</option>
				<option value="400"<?php if($d['upload']['width_img']=='400'):?> selected="selected"<?php endif?>>400px</option>
				<option value="480"<?php if($d['upload']['width_img']=='480'):?> selected="selected"<?php endif?>>480px</option>
				<option value="640"<?php if($d['upload']['width_img']=='640'):?> selected="selected"<?php endif?>>640px</option>
				<option value="720"<?php if($d['upload']['width_img']=='720'):?> selected="selected"<?php endif?>>720px</option>
				<option value="1024"<?php if($d['upload']['width_img']=='1024'):?> selected="selected"<?php endif?>>1024px</option>
				</select>
				(사진이 본문에 삽입될때 사진의 가로사이즈)
			</td>
		</tr>
		<tr>
			<td class="td1">첨부제한 파일</td>
			<td class="td2">
				<input type="text" name="ext_cut" value="<?php echo $d['upload']['ext_cut']?>" size="55" class="input" />
				<div class="guide">
				파일첨부시 모든파일에 대해서 파일명 필터링이 이루어지므로 php 관련파일을 첨부해도 안전합니다.<br />
				그래도 제한하려면 *.php *.php3 *.html *.inc *.cgi *.pl *.js 를 등록해 주세요.
				</div>
			</td>
		</tr>
		<tr>
			<td class="td1">일반첨부 지원</td>
			<td class="td2 shift">
				<input type="checkbox" name="use_classicup" value="1"<?php if($d['upload']['use_classicup']):?> checked="checked"<?php endif?> />플래쉬 업로더가 작동안되는 환경에서 일반 파일첨부를 가능하게 합니다.
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
	if (f.theme.value == '')
	{
		alert('테마를 선택해 주세요.       ');
		f.theme.focus();
		return false;
	}
	return confirm('정말로 실행하시겠습니까?         ');
}
//]]>
</script>
