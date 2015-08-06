<?
$module	= 'bbs';
//$orderby= $orderby ? $orderby : 'asc';
$orderby = '';
$recnum	= $recnum && $recnum < 301 ? $recnum : 20;
$bbsque	= '';

$RCD = getDbArray($table[$module.'list'],$bbsque,'*',"id asc",$orderby,$recnum,$p);
$NUM = getDbRows($table[$module.'list'],$bbsque);
$TPG = getTotalPage($NUM,$recnum);

if ($uid)
{
	$R = getUidData($table[$module.'list'],$uid);
	if ($R['uid'])
	{
		include_once $g['path_module'].$module.'/var/var.'.$R['id'].'.php';
	}
}

// 게시판 아이디
$TMP = getDbData($table[$module.'list'],'1','IFNULL(MAX(uid),0)+1 maxid');
$bbsid = 'bbs'.substr('000'.$TMP['maxid'],-4,4);

// 회원레벨
$levelnum = getDbData($table['s_mbrlevel'],'gid=1','*');
$LVL=getDbArray($table['s_mbrlevel'],'','*','uid','asc',$levelnum['uid'],1);
while($_L=db_fetch_array($LVL)) $level_list[] = $_L;
?>

<div id="bbs">
	<table class="tbl-form">
	<tr>
		<td class="list"><? // 게시판 리스트 ?>
			<form name="bbsform" action="<?php echo $g['s']?>/" method="post" target="_orderframe_">
			<input type="hidden" name="r" value="<?php echo $r?>" />
			<input type="hidden" name="m" value="<?php echo $module?>" />
			<input type="hidden" name="a" value="bbsorder_update" />

			<?if($TPG > 1){?>
			<select class="c2" onchange="goHref('<?=$g['s']?>/?r=<?=$r?>&amp;m=<?=$m?>&amp;mod=<?=$mod?>&amp;div=<?=$div?>&amp;sort=id asc&amp;p='+this.value);">
			<?php for($i = 1; $i <= $TPG; $i++):?>
			<option value="<?php echo $i?>"<?php if($i==$p):?> selected="selected"<?php endif?>>P.<?php echo $i?></option>
			<?php endfor?>
			</select>
			<?}?>

			<?php if($NUM):?>
			<div class="tree">
				<ul id="bbsorder">
				<?php while($BR = db_fetch_array($RCD)):?>
				<li ondblclick="window.open('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $module?>&bid=<?php echo $BR['id']?>');"<?php if($BR['category']):?> class="usecat" title="<?php echo $BR['category']?>"<?php endif?>>
					<input type="checkbox" name="bbsmembers[]" value="<?php echo $BR['uid']?>" checked="checked" />
					<a href="<?=$g['s']?>/?r=<?=$r?>&amp;m=<?=$m?>&amp;mod=<?=$mod?>&amp;div=<?=$div?>&recnum=<?php echo $recnum?>&p=<?php echo $p?>&uid=<?php echo $BR['uid']?>"><span class="name<?php if($BR['uid']==$R['uid']):?> on<?php endif?>" title="<?php echo number_format($BR['num_r'])?>개"><?php echo $BR['name']?></span></a><span class="id"> [ <?php echo $BR['id']?> ]</span>
				</li>
				<?php endwhile?>
				</ul>
			</div>
			<?php else:?>
			<div class="none">등록된 게시판이 없습니다.</div>
			<?php endif?>

			</form>
		</td>

		<td class="cont"><? // 게시판 본문 관리 ?>
			<form name="procForm" action="<?php echo $g['s']?>/" method="post"  target="_action_frame_<?=$m?>">
			<input type="hidden" name="r" value="<?=$r?>" />
			<input type="hidden" name="a" value="<?=$mod?>" />
			<input type="hidden" name="m" value="<?=$m?>" />
			<input type="hidden" name="mod" value="<?=$mod?>" />
			<input type="hidden" name="div" value="<?=$div?>" />
			<input type="hidden" name="actid" value="" />

			<input type="hidden" name="uid" value="<?php echo $R['uid']?>" />
			<input type="hidden" name="bid" value="<?php echo $R['id']?>" />
			<input type="hidden" name="perm_g_list" value="<?php echo $R['perm_g_list']?>" />
			<input type="hidden" name="perm_g_view" value="<?php echo $R['perm_g_view']?>" />
			<input type="hidden" name="perm_g_write" value="<?php echo $R['perm_g_write']?>" />
			<input type="hidden" name="perm_g_down" value="<?php echo $R['perm_g_down']?>" />

			<div class="title">
				<div class="xleft">게시판 등록정보</div>
				<div class="xright">
					<a href="<?=$g['s']?>/?r=<?=$r?>&amp;m=<?=$m?>&amp;mod=<?=$mod?>&amp;div=<?=$div?>">새게시판 만들기</a>
				</div>
			</div>

			<table class="tbl-form">
			<colgroup>
			<col width="120">
			<col>
			</colgroup>
			<tr>
				<td class="lbl">게시판이름</td>
				<td>
					<div class="row">
						<input type="text" name="name" value="<?php echo $R['name']?>" size="60" />
					<?php if($R['id']):?>
						<input type="button" class="btnkhaki" value="게시판보기" onclick="window.open('<?echo RW('m='.$module.'&bid='.$R['id'])?>');">
					<?php else:?>
						아이디[<?=$bbsid?>] <input type="hidden" name="id" value="<?=$bbsid?>"/>
					<?php endif?>
					</div>
				</td>
			</tr>
			<tr>
				<td class="lbl">카 테 고 리</td>
				<td>
					<div class="row">
						<input type="text" name="category" value="<?php echo $R['category']?>" size="60" />
						<label><input type="radio" name="category_type" value="" <?if(!$d['bbs']['category_type']) echo 'checked';?>> 콤보형식</label>
						<label><input type="radio" name="category_type" value="1" <?if($d['bbs']['category_type']) echo 'checked';?>> 탭형식</label>
					</div>
					<div class="row">
						분류를 <span class="b">콤마(,)</span>로 구분해 주세요. <span class="b">첫분류는 분류제목</span>이 됩니다.<br />
						보기)구분,유머,공포,엽기,무협,기타
					</div>
				</td>
			</tr>
			<tr>
				<td class="lbl">게시판 테마</td>
				<td>
					<select name="skin" class="select1" onchange="changeTheme();">
					<option value="">&nbsp;+ 게시판 대표테마</option>
					<option value="">--------------------------------</option>
					<?php $tdir = $g['path_module'].$module.'/theme/_pc/'?>
					<?php $dirs = opendir($tdir)?>
					<?php while(false !== ($skin = readdir($dirs))):?>
					<?php if($skin=='.' || $skin == '..' || is_file($tdir.$skin))continue?>
					<option value="_pc/<?php echo $skin?>" title="<?php echo $skin?>"<?php if($d['bbs']['skin']=='_pc/'.$skin):?> selected="selected"<?php endif?>>ㆍ<?php echo getFolderName($tdir.$skin)?></option>
					<?php endwhile?>
					<?php closedir($dirs)?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="lbl">게시판 권한</td>
				<td>
					<label>리스트 조회</label>
					<select name="perm_l_list">
					<option value="">+ 전체허용</option>
					<?foreach($level_list as $_L){?>
					<option value="<?=$_L['uid']?>" <? if($d['bbs']['perm_l_list']==$_L['uid']) { ?>selected="selected"<? } ?>>ㆍ<?=$_L['name']?> </option>
					<?}?>
					<option value="<?=$admin['admin']?>" <? if($d['bbs']['perm_l_list']==$admin['admin']) { ?>selected="selected"<? } ?>>ㆍ관리자 </option>
					<option value="<?=$admin['master']?>" <? if($d['bbs']['perm_l_list']==$admin['master']) { ?>selected="selected"<? } ?>>ㆍ웹마스터 </option>
					</select>

					<span class="dv">|</span>
					<label>내용 조회</label>
					<select name="perm_l_view">
					<option value="">+ 전체허용</option>
					<?foreach($level_list as $_L){?>
					<option value="<?=$_L['uid']?>" <? if($d['bbs']['perm_l_view']==$_L['uid']) { ?>selected="selected"<? } ?>>ㆍ<?=$_L['name']?> </option>
					<?}?>
					<option value="<?=$admin['admin']?>" <? if($d['bbs']['perm_l_view']==$admin['admin']) { ?>selected="selected"<? } ?>>ㆍ관리자 </option>
					<option value="<?=$admin['master']?>" <? if($d['bbs']['perm_l_view']==$admin['master']) { ?>selected="selected"<? } ?>>ㆍ웹마스터 </option>
					</select>

					<span class="dv">|</span>
					<label>글쓰기</label>
					<select name="perm_w">
					<option value="">+ 전체허용</option>
					<?foreach($level_list as $_L){?>
					<option value="<?=$_L['uid']?>" <? if($d['bbs']['perm_w']==$_L['uid']) { ?>selected="selected"<? } ?>>ㆍ<?=$_L['name']?> </option>
					<?}?>
					<option value="<?=$admin['admin']?>" <? if($d['bbs']['perm_w']==$admin['admin']) { ?>selected="selected"<? } ?>>ㆍ관리자 </option>
					<option value="<?=$admin['master']?>" <? if($d['bbs']['perm_w']==$admin['master']) { ?>selected="selected"<? } ?>>ㆍ웹마스터 </option>
					</select>
				</td>
			</tr>

			<tr>
				<td class="lbl">게시판 옵션</td>
				<td>
					<div class="row">
						<label><input type="checkbox" name="pagree" value="1" <?if($d['bbs']['pagree']) echo 'checked';?>/> 개인정보 수집 동의</label>
						[<a href="#" onclick="OpenWindow('<?=$g['s']?>/?r=<?=$r?>&amp;m=<?=$m?>&amp;mod=master&amp;div=member_agree&amp;winmod=Y'); return false;"><b>동의서 작성</b></a>]
					</div>
					<div class="row">
						<label><input type="checkbox" name="display" value="1"<?php if($d['bbs']['display']):?> checked="checked"<?php endif?> /> 사이드 최근글/많이본글 에서 제외 시킴</label>
					</div>
				</td>
			</tr>

			<tr>
				<td class="lbl">비 밀 글</td>
				<td>
					<div class="row">
						<label><input type="radio" name="use_hidden" value=""<?php if(!$d['theme']['use_hidden']):?> checked="checked"<?php endif?> /> 사용안함</label>
						<label><input type="radio" name="use_hidden" value="1"<?php if($d['theme']['use_hidden']==1):?> checked="checked"<?php endif?> /> 사용</label>
						<label><input type="radio" name="use_hidden" value="2"<?php if($d['theme']['use_hidden']==2):?> checked="checked"<?php endif?> /> 1:1상담(무조건비밀글)</label>
					</div>
				</td>
			</tr>

			<tr>
				<td class="lbl">댓 글</td>
				<td>
					<div class="row">
						<label><input type="checkbox" name="c_hidden" value="1"<?php if($d['bbs']['c_hidden']):?> checked="checked"<?php endif?> /> 사용안함</label>
						<label><input type="checkbox" name="c_open" value="1"<?php if($d['bbs']['c_open']):?> checked="checked"<?php endif?> /> 자동펼침</label>
					</div>
				</td>
			</tr>

			<tr>
				<td class="lbl">게시글 포인트</td>
				<td>
					<div class="row">
						<input type="text" name="point1" value="<?=$d['bbs']['point1']?>" size="5"/> 게시물 작성시 포인트지급(게시물 삭제시 환원됩니다)
					</div>
				</td>
			</tr>

			<tr id="bbs_list">
				<td class="lbl">리스트형<br/>블로그형</td>
				<td>
					<div class="row">
						<table id="lst_type_tbl" class="<? echo $d['bbs']['lst_type'] ? $d['bbs']['lst_type'] : 'tbl-line' ?>" >
						<colgroup>
						<col width="50">
						<col>
						<col width="100">
						<col width="70">
						<col width="90">
						</colgroup>
						<tr>
							<td class="th">번호</td>
							<td class="th"><input type="text" name="lst_sbj" value="<?php echo $d['bbs']['lst_sbj']?$d['bbs']['lst_sbj']:'제 목'?>" size="20"/></td>
							<td class="th"><input type="text" name="lst_mbr" value="<?php echo $d['bbs']['lst_mbr']?$d['bbs']['lst_mbr']:'작성자'?>" size="20"/></td>
							<td class="th">조회</td>
							<td class="th">작성일</td>
						</tr>
						<tr>
							<td>1</td>
							<td>게시물 제목</td>
							<td>작성사</td>
							<td>1</td>
							<td><?=getDateFormat($date['totime'],'Y.m.d')?></td>
						</tr>
						</table>
					</div>
					<div class="row">
						리스트 타입
						<label><input type="radio" name="lst_type" value="tbl-line" <?if(!$d['bbs']['lst_type'] || $d['bbs']['lst_type'] == 'tbl-line') echo 'checked="checked"';?> onclick="$('#lst_type_tbl').removeClass('tbl-list');$('#lst_type_tbl').addClass('tbl-line');"/>라인</label>
						<label><input type="radio" name="lst_type" value="tbl-list" <?if($d['bbs']['lst_type'] == 'tbl-list') echo 'checked="checked"';?> onclick="$('#lst_type_tbl').removeClass('tbl-line');$('#lst_type_tbl').addClass('tbl-list');"/>박스</label>
						<span class="dv">|</span>
						<input type="text" name="recnum" value="<?php echo $d['bbs']['recnum']?$d['bbs']['recnum']:20?>" size="5"/><label>개(한페이지에 출력할 게시물의 수)</label>
						<input type="text" name="sbjcut" value="<?php echo $d['bbs']['sbjcut']?$d['bbs']['sbjcut']:34?>" size="5"/><label>자(제목이 길 경우 자르기)</label>
					</div>
				</td>
			</tr>

			<tr id="bbs_gallery">
				<td class="lbl">갤러리형<br/>리뷰형</td>
				<td>
					<div class="row">
						<label><input type="radio" name="thumcnt" value="1" <?if($d['bbs']['thumcnt'] == 1) echo 'checked="checked"';?>> 1개</label>
						<label><input type="radio" name="thumcnt" value="2" <?if(!$d['bbs']['thumcnt'] || $d['bbs']['thumcnt'] == 2) echo 'checked="checked"';?>> 2개</label>
						<label><input type="radio" name="thumcnt" value="3" <?if($d['bbs']['thumcnt'] == 3) echo 'checked="checked"';?>> 3개</label>
						<label><input type="radio" name="thumcnt" value="4" <?if($d['bbs']['thumcnt'] == 4) echo 'checked="checked"';?>> 4개</label>
						(갤러리형 일경우 리스트 이미지 갯수)
					</div>
					<div class="row">
						<label><input type="checkbox" name="hide_sbj" value="1"<?php if($d['bbs']['hide_sbj']):?> checked="checked"<?php endif?> /> 게시물 제목 숨김</label>
					</div>
				</td>
			</tr>

			<tr>
				<td class="lbl">항목추가</td>
				<td>
					<?$addinfo = explode("|",$R['addinfo']);?>
					<div class="row">* 명칭-입력받을 항목명. * 필수입력-필수입력 항목으로 텍스트만 가능.</div>
					<div class="row">* 아이템-텍스트 일경우 설명, 체크,라디오 일경우 아이템을 콤마(,)로 구분해서 선택적으로 입력 받음</div>

					<ul id="addinfo" class="addinfo">
					<?if($R['addinfo']){ foreach($addinfo as $tmp){?>
						<?$itms = explode("#",$tmp);?>
						<li>
							<select name="addinfo0[]">
								<option value="1" <?if($itms[0]==1) echo 'selected';?>>텍스트</option>
								<option value="2" <?if($itms[0]==2) echo 'selected';?>>체크</option>
								<option value="3" <?if($itms[0]==3) echo 'selected';?>>라디오</option>
							</select>
							명칭 <input type="text" name="addinfo2[]" value="<?=$itms[2]?>">
							아이템 <input type="text" name="addinfo3[]" value="<?=$itms[3]?>">
							<input type="checkbox" name="addinfo1[]" value="1" <?if($itms[1]) echo 'checked';?>> 필수입력
							<input type="button" value="삭제" class="btnred" onclick="delItem(this);">
						</li>
					<?}}?>
					</ul>

					<div class="row" style="text-align:right;"><input type="button" value="추가" class="btnkhaki" onclick="addItem();"></div>
					<script type="text/javascript">
						function addItem(){
							$('#addinfo').append('<li><select name="addinfo0[]"><option value="1">텍스트</option><option value="2">체크</option><option value="3">라디오</option></select> 명칭 <input type="text" name="addinfo2[]" value=""> 아이템 <input type="text" name="addinfo3[]" value=""> <input type="checkbox" name="addinfo1[]" value="1"> 필수입력</li>');
						}
						function delItem(t){
							$(t).parent().remove();
						}
					</script>
				</td>
			</tr>
			
			<tr>
				<td class="submit" colspan="2">
				<?if($R['uid']){?><input type="button" class="btngray btnsz01" value=" 삭제 " onclick="OnDelete()"/><?}?>
				<input type="submit" class="btnblue btnsz01" value="<?php echo $R['uid']?'게시판속성 변경':'새게시판 만들기'?>" onclick="OnWrite();"/>
				</td>
			</tr>
			</table>

			</form>
		</td>
	</tr>
	</table>

</div>

<script type="text/javascript">
function OnWrite()
{
	if ($('input[name=name]').val() == '')
	{
		alert('게시판이름을 입력해 주세요.     ');
		$('input[name=name]').focus();
		return false;
	}
	if ($('input[name=bid]').val() == '')
	{
		if ($('input[name=id]').val() == '')
		{
			alert('게시판아이디를 입력해 주세요.      ');
			$('input[name=id]').focus();
			return false;
		}
		if (!chkFnameValue($('input[name=id]').val()))
		{
			alert('게시판아이디는 영문 대소문자/숫자/_ 만 사용가능합니다.      ');
			$('input[name=id]').val('');
			$('input[name=id]').focus();
			return false;
		}
	}

	$('input[name=actid]').val('regis');
	$('form[name=procForm]').submit();
}
function OnDelete()
{
	$('input[name=actid]').val('del');
	if(confirm('정말로 삭제하시겠습니까?'))
		$('form[name=procForm]').submit();
}
function changeTheme() {
	var	v = $('select[name=skin]').val();
	$('#bbs_list').hide();
	$('#bbs_gallery').hide();
	
	switch(v) {
	case '_pc/list01':
	case '_pc/blog01':
	case '':
		$('#bbs_list').show();
		break;
	case '_pc/gallery01':
	case '_pc/review01':
		$('#bbs_gallery').show();
		break;
	}
}
$(document).ready(function() {
	changeTheme();
});
</script>
