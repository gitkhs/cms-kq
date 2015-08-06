<?php include_once $g['path_module'].$module.'/var/var.search.php'?>

<div id="searchbox">

	<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck(this);">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="m" value="<?php echo $module?>" />
	<input type="hidden" name="a" value="config" />

	<div class="title">
		통합검색 설정
	</div>

	<table>
		<tr>
			<td class="td1">검색요소</td>
			<td class="td2 shift">
				
				<input type="checkbox" name="s_bbs" value="1"<?php if($d['search']['s_bbs']):?> checked="checked"<?php endif?> />게시판<br />
				<input type="checkbox" name="s_comment" value="1"<?php if($d['search']['s_comment']):?> checked="checked"<?php endif?> />댓글<br />
				<input type="checkbox" name="s_image" value="1"<?php if($d['search']['s_image']):?> checked="checked"<?php endif?> />이미지<br />
				<input type="checkbox" name="s_upload" value="1"<?php if($d['search']['s_upload']):?> checked="checked"<?php endif?> />첨부파일<br />
				<input type="checkbox" name="s_search" value="1"<?php if($d['search']['s_search']):?> checked="checked"<?php endif?> />외부검색<br />
				<div class="guide">
				통합검색에서 제외할 요소는 체크를 해제해 주세요.
				</div>
			</td>
		</tr>


		<tr>
			<td class="td1">검색결과수</td>
			<td class="td2">
				통합검색시 <input type="text" name="s_num1" size="5" value="<?php echo $d['search']['s_num1']?>" class="input" />개<br />
				세부검색시 <input type="text" name="s_num2" size="5" value="<?php echo $d['search']['s_num2']?>" class="input" />개
			</td>
		</tr>

		<tr>
			<td class="td1">검색범위</td>
			<td class="td2">
				<select name="s_term">
				<option value="360"<?php if($d['search']['s_term']==360):?> selected="selected"<?php endif?>>전체</option>
				<option value="36"<?php if($d['search']['s_term']==36):?> selected="selected"<?php endif?>>최근 3년</option>
				<option value="24"<?php if($d['search']['s_term']==24):?> selected="selected"<?php endif?>>최근 2년</option>
				<option value="12"<?php if($d['search']['s_term']==12):?> selected="selected"<?php endif?>>최근 1년</option>
				<option value="6"<?php if($d['search']['s_term']==6):?> selected="selected"<?php endif?>>최근 6개월</option>
				<option value="3"<?php if($d['search']['s_term']==3):?> selected="selected"<?php endif?>>최근 3개월</option>
				<option value="1"<?php if($d['search']['s_term']==1):?> selected="selected"<?php endif?>>최근 한달</option>
				</select>

				<div class="guide">
				검색양에 따라 처리속도가 느려질 수 있습니다.<br />
				적절한 기간을 지정해 주세요.
				</div>
			</td>
		</tr>
		<tr>
			<td class="td1">레이아웃</td>
			<td class="td2">
				<select name="layout" class="select1">
				<option value="">&nbsp;+ 사이트 대표레이아웃</option>
				<?php $dirs = opendir($g['path_layout'])?>
				<?php while(false !== ($tpl = readdir($dirs))):?>
				<?php if($tpl=='.' || $tpl == '..' || $tpl == '_blank' || is_file($g['path_layout'].$tpl))continue?>
				<?php $dirs1 = opendir($g['path_layout'].$tpl)?>
				<option value="">--------------------------------</option>
				<?php while(false !== ($tpl1 = readdir($dirs1))):?>
				<?php if(!strstr($tpl1,'.php') || $tpl1=='_main.php')continue?>
				<option value="<?php echo $tpl?>/<?php echo $tpl1?>"<?php if($d['search']['layout']==$tpl.'/'.$tpl1):?> selected="selected"<?php endif?>>ㆍ<?php echo getFolderName($g['path_layout'].$tpl)?>(<?php echo str_replace('.php','',$tpl1)?>)</option>
				<?php endwhile?>
				<?php closedir($dirs1)?>
				<?php endwhile?>
				<?php closedir($dirs)?>
				</select>
			</td>
		</tr>
		<tr>
			<td class="td1">소속메뉴</td>
			<td class="td2">
				<select name="sosokmenu" class="select1">
				<option value="">&nbsp;+ 사용안함</option>
				<option value="">--------------------------------</option>
				<?php include_once $g['path_core'].'function/menu1.func.php'?>
				<?php $cat=$d['search']['sosokmenu']?>
				<?php getMenuShowSelect($s,$table['s_menu'],0,0,0,0,0,'')?>
				</select>
			</td>
		</tr>
	</table>

	<table class="hide">
		<tr>
			<td class="td1">외부검색 리스트</td>
			<td class="td2">
				<textarea name="s_searchlist" class="scrollbar01"><?php echo trim(implode('',file($g['path_module'].$module.'/var/search.list.txt')))?></textarea>
				<div class="guide">
				검색엔진명과 검색URL을 콤마(,)로 구분해서 등록해 주세요.<br />
				외부검색을 이용해 검색어를 선택된 검색엔진으로 연결해 줍니다.
				</div>
			</td>
		</tr>
	<table>

	<div class="submitbox">
		<input type="submit" class="btnblue" value=" 확인 " />
	</div>

	</form>

</div>




<script type="text/javascript">
//<![CDATA[
function saveCheck(f)
{
	return confirm('정말로 실행하시겠습니까?         ');
}
//]]>
</script>




