<?php 
$R = getDbData($table['s_mobile'],'','*');
?>
<div id="mobilebox">

	<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="m" value="<?php echo $module?>" />
	<input type="hidden" name="a" value="mobile" />
	<input type="hidden" name="checkm" value="<?php echo $R['usemobile']?$R['usemobile']:0?>" />

	<div class="title">
		모바일(스마트폰) 접속설정
	</div>

	<table>
		<tr>
			<td class="td1">모바일접속 처리</td>
			<td class="td2 shift">
				<input type="radio" name="usemobile" value="0"<?php if(!$R['usemobile']):?> checked="checked"<?php endif?> onclick="this.form.checkm.value=this.value;" />모바일 접속시

				<select name="startdomain" class="select1">
				<option value="">ㆍ사이트별 모바일모드 적용</option>
				</select><br />


				<input type="radio" name="usemobile" value="2"<?php if($R['usemobile']==2):?> checked="checked"<?php endif?> onclick="this.form.checkm.value=this.value;" />모바일 접속시 
				<select name="startdomain" class="select1">
				<option value="">&nbsp;+ 선택하세요</option>
				<option value="">--------------------------------</option>
				<?php $SITES = getDbArray($table['s_domain'],'','*','gid','asc',0,$p)?>
				<?php while($S = db_fetch_array($SITES)):?>
				<option value="http://<?php echo $S['name']?>"<?php if('http://'.$S['name']==$R['startdomain']):?> selected="selected"<?php endif?>>ㆍ<?php echo $S['name']?></option>
				<?php endwhile?>
				<?php if(!db_num_rows($SITES)):?>
				<option value="">등록된 도메인이 없습니다.</option>
				<?php endif?>
				</select>
				<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=domain&amp;type=makedomain" class="dn"><img src="<?php echo $g['img_core']?>/_public/btn_add.gif" alt="도메인추가" title="도메인추가" /></a>
				(으)로 이동<br />

				<input type="radio" name="usemobile" value="1"<?php if($R['usemobile']==1):?> checked="checked"<?php endif?> onclick="this.form.checkm.value=this.value;" />모바일 접속시
				<select name="startsite" class="select1">
				<option value="">&nbsp;+ 선택하세요</option>
				<option value="">--------------------------------</option>
				<?php $SITES = getDbArray($table['s_site'],'','*','gid','asc',0,$p)?>
				<?php while($S = db_fetch_array($SITES)):?>
				<option value="<?php echo $S['uid']?>"<?php if($S['uid']==$R['startsite']):?> selected="selected"<?php endif?>>ㆍ<?php echo $S['name']?></option>
				<?php endwhile?>
				<?php if(!db_num_rows($SITES)):?>
				<option value="">등록된 사이트가 없습니다.</option>
				<?php endif?>
				</select>
				<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=home&amp;type=makesite" class="dn"><img src="<?php echo $g['img_core']?>/_public/btn_add.gif" alt="사이트추가" title="사이트추가" /></a>
				(으)로 연결(도메인유지)<br />
			</td>
		</tr>


		<tr>
			<td class="td1">모바일AGENT 목록</td>
			<td class="td2">
				<textarea name="agentlist" class="scrollbar01"><?php echo trim(implode('',file($g['path_var'].'mobile.agent.txt')))?></textarea>
			</td>
		</tr>

		<tr>
			<td class="td1">모바일웹 미리보기</td>
			<td class="td2">
				<a href="#." onclick="getSizeWin('<?php echo RW(0)?>',800,480);">(800*480)</a>
				<a href="#." onclick="getSizeWin('<?php echo RW(0)?>',480,800);">(480*800)</a><br />
				<a href="#." onclick="getSizeWin('<?php echo RW(0)?>',960,640);">(960*640)</a>
				<a href="#." onclick="getSizeWin('<?php echo RW(0)?>',640,960);">(640*960)</a><br />
				<a href="#." onclick="getSizeWin('<?php echo RW(0)?>',480,320);">(480*320)</a>
				<a href="#." onclick="getSizeWin('<?php echo RW(0)?>',320,480);">(320*480)</a>

				<div class="notice1">
					모바일웹 미리보기는 에뮬레이터 방식이므로 실제 모바일 디바이스 환경과 일치하지 않습니다.<br />
					특히 모바일 디바이스의 화면사이즈(3~4인치)가 아닌 해상도 기준이므로 참고용으로만 사용하세요.
				</div>
				<div class="notice2">
					모바일웹 미리보기를 이용하신 후에는 반드시 PC모드로 전환하여 주세요.<br /><br />
					<input type="button" id="btnpcmodechange" class="btngray" value=" PC모드전환 " onclick="pcmodeChange();" />
				</div>
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
function pcmodeChange()
{
	frames._action_frame_<?php echo $m?>.location.href = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $module?>&a=mobilemode&value=X';
	getId('btnpcmodechange').className = 'btngray';
}
function getSizeWin(url,x,y)
{
	frames._action_frame_<?php echo $m?>.location.href = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $module?>&a=mobilemode&value=E';
	window.open(url,'','left=0,top=0,width='+x+'px,height='+y+'px,resizable=no,scrollbars=yes,status=yes');
	getId('btnpcmodechange').className = 'btnblue';
}
function saveCheck(f)
{
	if (f.checkm.value == '1')
	{
		if (f.startsite.value == '')
		{
			alert('시작사이트를 지정해 주세요.   ');
			f.startsite.focus();
			return false;
		}
	}
	if (f.checkm.value == '2')
	{
		if (f.startdomain.value == '')
		{
			alert('시작도메인을 지정해 주세요.   ');
			f.startdomain.focus();
			return false;
		}
	}
	return confirm('정말로 실행하시겠습니까?         ');
}
//]]>
</script>




