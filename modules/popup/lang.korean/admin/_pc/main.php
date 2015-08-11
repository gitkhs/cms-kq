<?php
$POPUPS = getDbArray($table['s_popup'],'','*','uid','asc',0,$p);
$NUM = db_num_rows($POPUPS);
if ($uid)
{
	$R = getUidData($table['s_popup'],$uid);
}
if ($R['uid'])
{
	$year1	= substr($R['term1'],0,4);
	$month1	= substr($R['term1'],4,2);
	$day1	= substr($R['term1'],6,2);
	$hour1	= substr($R['term1'],8,2);
	$min1	= substr($R['term1'],10,2);
	$year2	= substr($R['term2'],0,4);
	$month2	= substr($R['term2'],4,2);
	$day2	= substr($R['term2'],6,2);
	$hour2	= substr($R['term2'],8,2);
	$min2	= substr($R['term2'],10,2);
}
else {
	$year1	= substr($date['today'],0,4);
	$month1	= substr($date['today'],4,2);
	$day1	= substr($date['today'],6,2);
	$hour1	= 0;
	$min1	= 0;
	$year2	= substr($date['today'],0,4);
	$month2	= substr($date['today'],4,2);
	$day2	= substr($date['today'],6,2);
	$hour2	= 23;
	$min2	= 59;
	$R['width'] = 400;
	$R['height']= 400;
}
?>


<div id="catebody">
	<div id="category">
		<div class="title">
			등록된 팝업들
		</div>
		
		<?php if($NUM):?>
		<div class="tree">
			<ul>
			<?php while($PR = db_fetch_array($POPUPS)):?>
			<li><a href="<?php echo $g['adm_href']?>&amp;uid=<?php echo $PR['uid']?>"><span class="name<?php if($PR['uid']==$uid):?> on<?php endif?>"><?php echo $PR['name']?></span></a></li>
			<?php endwhile?>
			</ul>
		</div>
		<?php else:?>
		<div class="none">등록된 팝업이 없습니다.</div>
		<?php endif?>
	</div>


	<div id="catinfo">


		<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $module?>" />
		<input type="hidden" name="a" value="regispopup" />
		<input type="hidden" name="uid" value="<?php echo $R['uid']?>" />
		<input type="hidden" name="dispage" value="<?php echo $R['dispage']?>" />

		<div class="title">

			<div class="xleft">
				팝업 등록정보
			</div>
			<div class="xright">

				<a href="<?php echo $g['adm_href']?>&amp;newpop=Y">새팝업 등록</a>

			</div>





		</div>

		<div class="notice">
			팝업을 등록합니다.<br />
			팝업 등록갯수는 제한이 없으나 적절히 조절해 주세요.

		</div>


		<table>
			<tr>
				<td class="td1">팝업타이틀</td>
				<td class="td2">
					<input type="text" name="name" value="<?php echo $R['name']?>" class="input sname" />
					<?php if($R['uid']):?>
					<span class="btn01"><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=deletepopup&amp;uid=<?php echo $R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?     ')">삭제</a></span>
					<?php endif?>
				</td>
			</tr>
			<tr>
				<td class="td1">노 출 형 식</td>
				<td class="td2 shift">
					<input type="radio" name="type" value="0"<?php if(!$R['type']):?> checked="checked"<?php endif?> />팝업창
					<input type="radio" name="type" value="1"<?php if($R['type']):?> checked="checked"<?php endif?> />레이어
				</td>
			</tr>
			<tr>
				<td class="td1">노 출 옵 션</td>
				<td class="td2 shift">
					<input type="checkbox" name="scroll" value="1"<?php if($R['scroll']):?> checked="checked"<?php endif?>>스크롤
					<input type="checkbox" name="hidden" value="1"<?php if($R['hidden']):?> checked="checked"<?php endif?> />일시중지
				</td>
			</tr>
			<tr>
				<td class="td1">노 출 기 간</td>
				<td class="td2">
					<div class="shift"><input type="checkbox" name="term0" value="1"<?php if($R['term0']):?> checked="checked"<?php endif?> />제한없음</div>
					<select name="year1">
					<?php for($i=$date['year'];$i<$date['year']+2;$i++):?><option value="<?php echo $i?>"<?php if($year1==$i):?> selected="selected"<?php endif?>><?php echo $i?></option><?php endfor?>
					</select>
					<select name="month1">
					<?php for($i=1;$i<13;$i++):?><option value="<?php echo sprintf('%02d',$i)?>"<?php if($month1==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d',$i)?></option><?php endfor?>
					</select>
					<select name="day1">
					<?php for($i=1;$i<32;$i++):?><option value="<?php echo sprintf('%02d',$i)?>"<?php if($day1==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d',$i)?>(<?php echo getWeekday(date('w',mktime(0,0,0,$month1,$i,$year1)))?>)</option><?php endfor?>
					</select>
					<select name="hour1">
					<?php for($i=0;$i<24;$i++):?><option value="<?php echo sprintf('%02d',$i)?>"<?php if($hour1==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d',$i)?></option><?php endfor?>
					</select>:
					<select name="min1">
					<?php for($i=0;$i<60;$i++):?><option value="<?php echo sprintf('%02d',$i)?>"<?php if($min1==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d',$i)?></option><?php endfor?>
					</select>
					부터<br />
					<select name="year2">
					<?php for($i=$date['year'];$i<$date['year']+2;$i++):?><option value="<?php echo $i?>"<?php if($year2==$i):?> selected="selected"<?php endif?>><?php echo $i?></option><?php endfor?>
					</select>
					<select name="month2">
					<?php for($i=1;$i<13;$i++):?><option value="<?php echo sprintf('%02d',$i)?>"<?php if($month2==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d',$i)?></option><?php endfor?>
					</select>
					<select name="day2">
					<?php for($i=1;$i<32;$i++):?><option value="<?php echo sprintf('%02d',$i)?>"<?php if($day2==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d',$i)?>(<?php echo getWeekday(date('w',mktime(0,0,0,$month2,$i,$year2)))?>)</option><?php endfor?>
					</select>
					<select name="hour2">
					<?php for($i=0;$i<24;$i++):?><option value="<?php echo sprintf('%02d',$i)?>"<?php if($hour2==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d',$i)?></option><?php endfor?>
					</select>:
					<select name="min2">
					<?php for($i=0;$i<60;$i++):?><option value="<?php echo sprintf('%02d',$i)?>"<?php if($min2==$i):?> selected="selected"<?php endif?>><?php echo sprintf('%02d',$i)?></option><?php endfor?>
					</select>
					까지
				</td>
			</tr>
			<tr>
				<td class="td1">노 출 크 기</td>
				<td class="td2 sf">
					<input type="text" name="width" value="<?php echo $R['width']?>" size="3" class="input" /> *
					<input type="text" name="height" value="<?php echo $R['height']?>" size="3" class="input" />
					(가로/세로 , 단위:픽셀)
				</td>
			</tr>
			<tr>
				<td class="td1">노 출 위 치</td>
				<td class="td2 sf">
					<input type="text" name="ptop" value="<?php echo $R['ptop']?$R['ptop']:0?>" size="3" class="input" /> *
					<input type="text" name="pleft" value="<?php echo $R['pleft']?$R['pleft']:0?>" size="3" class="input" /> 
					(위쪽/왼쪽 , 단위:필셀)
					<input type="checkbox" name="center" value="1"<?php if($R['center']):?> checked="checked"<?php endif?>>중앙에서 위치계산
				</td>
			</tr>

			<tr>
				<td class="td1">노출사이트</td>
				<td class="td2 sf1">
					사이트별로 노출페이지 및 메뉴를 지정할 수 있습니다.<br />
					특정페이지만 출력시 : <span class="b">[페이지ID][페이지ID]...</span> 의 형식으로 출력페이지를 등록<br />
					특정메뉴만 출력시 : <span class="b">[메뉴코드][메뉴코드]...</span> 의 형식으로 출력메뉴를 등록<br />
					전체차단 체크없이 공백으로 두시면 모든페이지에 대해서 팝업이 출력됩니다.<br />
				</td>
			</tr>
			
			<?php $i=0?>
			<?php $dispagex = explode('|',$R['dispage'])?>
			<?php $SITES = getDbArray($table['s_site'],'','*','gid','asc',0,$p)?>
			<?php while($S = db_fetch_array($SITES)):?>
			<tr>
				<td class="td1"><?php echo $S['name']?></td>
				<td class="td2">
					<input type="checkbox" name="sitemembers[]" value="[<?php echo $S['uid']?>]" class="hide" checked="checked" />
					<input type="text" name="pagemembers[]" value="<?php echo str_replace('m['.$S['uid'].']','',str_replace('[s['.$S['uid'].']]','',str_replace('[c['.$S['uid'].']]','',$dispagex[$i])))?>" size="50" class="input" />
					<input type="checkbox" name="cutmembers[]" value="[<?php echo $S['uid']?>]"<?php if(strstr($dispagex[$i],'[c['.$S['uid'].']]')):?> checked="checked"<?php endif?> />전체차단
				</td>
			</tr>
			<?php $i++?>
			<?php endwhile?>
		</table>
		
		<div class="iconbox">
			<a class="hand" onclick="window.open('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>&module=filemanager&front=main&fileupload=Y&iframe=Y&pwd=./files/_etc/&pwd1=popup');" /><img src="<?php echo $g['img_core']?>/_public/ico_photo.gif" alt="" />이미지 첨부하기</a>
			<img src="<?php echo $g['img_core']?>/_public/split_01.gif" alt="" class="split" />
			<a class="hand" onclick="OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&system=popup.image&folder=./files/_etc/&sfolder=popup&iframe=Y');" /><img src="<?php echo $g['img_core']?>/_public/ico_photo.gif" alt="" />이미지 불러오기</a>
			<img src="<?php echo $g['img_core']?>/_public/split_01.gif" alt="" class="split" />
			<a class="hand" onclick="ToolCheck('layout');">레이아웃</a>
			<img src="<?php echo $g['img_core']?>/_public/split_01.gif" alt="" class="split" />
			<a class="hand" onclick="ToolCheck('table');">테이블</a>
			<img src="<?php echo $g['img_core']?>/_public/split_01.gif" alt="" class="split" />
			<a class="hand" onclick="ToolCheck('box');">박스</a>
			<img src="<?php echo $g['img_core']?>/_public/split_01.gif" alt="" class="split" />
			<a class="hand" onclick="ToolCheck('link');">링크</a>
			<img src="<?php echo $g['img_core']?>/_public/split_01.gif" alt="" class="split" />
			<a class="hand" onclick="ToolCheck('icon');">아이콘</a>
			<img src="<?php echo $g['img_core']?>/_public/split_01.gif" alt="" class="split" />
			<a class="hand" onclick="frames.editFrame.ToolboxShowHide(0);" /><img src="<?php echo $g['img_core']?>/_public/ico_edit.gif" alt="" />편집</a>
		</div>

		<input type="hidden" name="html" id="editFrameHtml" value="<?php echo $R['html']?$R['html']:'HTML'?>" />
		<input type="hidden" name="content" id="editFrameContent" value="<?php echo htmlspecialchars($R['content'])?>" />
		<iframe name="editFrame" id="editFrame" src="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=editor&amp;toolbox=Y" width="100%" height="450" frameborder="0" scrolling="no"></iframe>


		<div class="submitbox">
			<?php if($R['uid']):?><input type="button" class="btngray" value="팝업보기" onclick="showPopup();" /><?php endif?>
			<input type="submit" class="btnblue" value="<?php echo $R['uid']?'팝업속성 변경':'새 팝업 등록'?>" />
			<div class="clear"></div>
		</div>

		</form>
		

	</div>
	<div class="clear"></div>
</div>




<script type="text/javascript">
//<![CDATA[
function ToolCheck(compo)
{
	frames.editFrame.showCompo();
	frames.editFrame.EditBox(compo);
}
function showPopup()
{
	window.open('<?php echo $g['s']?>/?r=<?php echo $r?>&system=popup.window&uid=<?php echo $R['uid']?>&iframe=Y','popview_<?php echo $R['uid']?>','left=<?php echo $R['pleft']?>,top=<?php echo $R['ptop']?>,width=<?php echo $R['width']?>,height=<?php echo $R['height']?>,scrollbars=<?php echo $R['scroll']?'yes':'no'?>,status=yes');
}
function saveCheck(f)
{
	if (f.name.value == '')
	{
		alert('팝업타이틀을 입력해 주세요.      ');
		f.name.focus();
		return false;
	}

	if (f.width.value == "")
	{
		alert('팝업창의 가로폭을 입력해 주세요.');
		f.width.focus();
		return false;
	}
	if (f.height.value == "")
	{
		alert('팝업창의 세로폭을 입력해 주세요.');
		f.height.focus();
		return false;
	}
	
	
    var s = document.getElementsByName('sitemembers[]');
    var c = document.getElementsByName('cutmembers[]');
    var l = document.getElementsByName('pagemembers[]');
    var n = l.length;
    var i;
	var cs = '';

    for (i = 0; i < n; i++)
	{
		if (c[i].checked == true)
		{
			cs += '[c'+s[i].value+']';
		}
		if (l[i].value == '')
		{
			cs += '[s'+s[i].value+']' + '|';
		}
		else {
			cs += l[i].value.replace(/\[/g,'[m'+s[i].value) + '|';
		}
	}
	
	f.dispage.value = cs;
	
	frames.editFrame.getEditCode(f.content,f.html);
	if (f.content.value == '')
	{
		alert('내용을 입력해 주세요.       ');
		frames.editFrame.getEditFocus();
		return false;
	}

	return confirm('정말로 실행하시겠습니까?         ');
}
<?php if($newpop=='Y'):?>
document.procForm.name.focus();
<?php endif?>
//]]>
</script>





