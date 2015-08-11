<div class="guide">
<span class="b">메인화면을 꾸미는 방법은 2가지가 있습니다.</span><br /><br />
첫번재 - 킴스큐 콘텐츠 연결하기(PC모드에서만 꾸밀 수 있습니다)<br />
두번째 - 이 레이아웃의 전용 메인화면 사용하기<br />
원하시는 것을 선택해 주세요. 두가지 모두 선택할 수 있습니다.<br />
</div>

<form name="themeForm" method="post" action="<?php echo $g['s']?>/" onsubmit="return configCheck(this);">
<input type="hidden" name="r" value="<?php echo $r?>" />
<input type="hidden" name="_layoutAction" value="config" />
<input type="hidden" name="nowLayout" value="<?php echo $d['layout']['dir']?>" />
<input type="hidden" name="changeType" value="<?php echo $_themeConfig?>" />

<table>
<tr>
<td class="t1">메인설정</td>
<td class="t2">:</td>
<td class="t3 shift">
	<div class="shift">
	<label><input type="checkbox" name="mainType_rb" value="1"<?php if($d['layout']['mainType_rb']):?> checked="checked"<?php endif?> />킴스큐 콘텐츠 연결</label><br />
	<label><input type="checkbox" name="mainType_layout" value="1"<?php if($d['layout']['mainType_layout']):?> checked="checked"<?php endif?> />이 레이아웃의 전용 메인화면</label><br />
	</div>
</td>
</tr>
<?php if($d['layout']['mainType_layout']):?>
<?php $BBSLIST=getDbArray($table['bbslist'],'','*','gid','asc',0,1)?>
<?php $_RCD=array(); while($_B=db_fetch_array($BBSLIST)) $_RCD[]=$_B?>
<?php $_pset=array('상단','중간','하단')?>

<?php for($_i=1;$_i<4;$_i++):?>
<tr>
<td></td>
<td><br /><br /></td>
<td></td>
</tr>
<tr>
<td class="t1">출력대상(<?php echo $_pset[$_i-1]?>)</td>
<td class="t2">:</td>
<td class="t3">
	<select name="bbs<?php echo $_i?>" class="select1">
	<option value="n"<?php if($d['layout']['bbs'.$_i]=='n'):?> selected="selected"<?php endif?>>ㆍ출력안함</option>
	<option value="0"<?php if($d['layout']['bbs'.$_i]=='0'):?> selected="selected"<?php endif?>>ㆍ게시판 전체</option>
	<?php foreach($_RCD as $_B):?>
	<option value="<?php echo $_B['uid']?>"<?php if($d['layout']['bbs'.$_i]==$_B['uid']):?> selected="selected"<?php endif?>>ㆍ<?php echo $_B['name']?>(<?php echo $_B['id']?>)</option>
	<?php endforeach?>
	</select>
</td>
</tr>
<tr>
<td class="t1">정렬/기간/갯수</td>
<td class="t2">:</td>
<td class="t3">
	<select name="sort<?php echo $_i?>">
	<option value="gid,asc"<?php if($d['layout']['sort'.$_i]=='gid,asc'):?> selected="selected"<?php endif?>>등록순</option>
	<option value="hit,desc"<?php if($d['layout']['sort'.$_i]=='hit,desc'):?> selected="selected"<?php endif?>>조회순</option>
	<option value="score1,desc"<?php if($d['layout']['sort'.$_i]=='score1,desc'):?> selected="selected"<?php endif?>>추천순</option>
	<option value="comment,desc"<?php if($d['layout']['sort'.$_i]=='comment,desc'):?> selected="selected"<?php endif?>>댓글순</option>
	<option value="down,desc"<?php if($d['layout']['sort'.$_i]=='down,desc'):?> selected="selected"<?php endif?>>다운순</option>
	</select>
	<input type="text" name="bbs<?php echo $_i?>_day" value="<?php echo $d['layout']['bbs'.$_i.'_day']?>" class="input sf" />일내
	<select name="bbs<?php echo $_i?>_num">
	<?php for($i=1;$i<21;$i++):?>
	<option value="<?php echo $i?>"<?php if($d['layout']['bbs'.$_i.'_num']==$i):?> selected="selected"<?php endif?>><?php echo $i?>개</option>
	<?php endfor?>
	</select>
</td>
</tr>
<tr>
<td class="t1">제목</td>
<td class="t2">:</td>
<td class="t3">
	<input type="text" name="bbs<?php echo $_i?>_name" value="<?php echo stripslashes($d['layout']['bbs'.$_i.'_name'])?>" class="input" /><br />
	<input type="checkbox" name="bbs<?php echo $_i?>_namehide" value="1"<?php if($d['layout']['bbs'.$_i.'_namehide']):?> checked="checked"<?php endif?> />제목숨김
</td>
</tr>
<?php endfor?>


<?php endif?>
<tr>
<td></td>
<td></td>
<td><br /><br /><input type="submit" value=" 변경하기 " class="btnblue" /></td>
</tr>
</table>

</form>

<br />
<br />
