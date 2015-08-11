<?php
$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 91 ? $recnum : 30;

$RCD = getDbArray($table['s_module'],'','*',$sort,$orderby,$recnum,$p);
$NUM = getDbRows($table['s_module'],'');
$TPG = getTotalPage($NUM,$recnum);

if (!$id)
{
	$id = 'home';
}
$R = getDbData($table['s_module'],"id='".$id."'",'*');
?>

<div id="catebody">
	<div id="category">
		<form name="mform1" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $module?>" />
		<input type="hidden" name="a" value="moduleorder_update" />
		<input type="hidden" name="fnum" value="2" />

		<div class="title">
			<select class="c1" onchange="goHref('<?php echo $g['adm_href']?>&amp;recnum='+this.value);">
			<?php for($i=15;$i<=100;$i=$i+15):?>
			<option value="<?php echo $i?>"<?php if($i==$recnum):?> selected="selected"<?php endif?>>D.<?php echo $i?></option>
			<?php endfor?>
			</select>
			<select class="c2" onchange="goHref('<?php echo $g['adm_href']?>&amp;recnum=<?php echo $recnum?>&amp;p='+this.value);">
			<?php for($i = 1; $i <= $TPG; $i++):?>
			<option value="<?php echo $i?>"<?php if($i==$p):?> selected="selected"<?php endif?>>P.<?php echo $i?></option>
			<?php endfor?>
			</select>
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=market&amp;front=pack&amp;type=module" title="모듈추가"><img src="<?php echo $g['img_core']?>/_public/btn_add.gif" alt="추가" /></a>
			<img src="<?php echo $g['img_core']?>/_public/btn_save.gif" title="순서저장" alt="save" class="hand" onclick="document.mform1.submit();" />

		</div>
		
		<div class="tree">
			<ul id="moduleorder3">
			<?php while($BR = db_fetch_array($RCD)):?>
			<li class="move<?php if($BR['system']):?> system<?php endif?>" ondblclick="window.open('<?php echo $g['r']?>/?m=<?php echo $BR['id']?>');">
				<input type="checkbox" name="modulemembers2[]" value="<?php echo $BR['id']?>" checked="checked" />
				&nbsp;&nbsp;&nbsp;&nbsp;<a class="hand" onclick="showCheck('<?php echo $BR['id']?>','<?php echo $BR['hidden']?>');"><img src="<?php echo $g['img_core']?>/_public/ico_<?php echo $BR['hidden']?'hide':'show'?>.gif" class="eye2" alt="" title="모듈패널 디스플레이상태 변경" /></a>&nbsp;&nbsp;&nbsp;&nbsp;
				<span class="hand" onclick="mobileCheck('<?php echo $BR['id']?>','<?php echo $BR['mobile']?>');"><img src="<?php echo $g['img_core']?>/_public/ico_mobile.gif" alt=""<?php if(!$BR['mobile']):?> class="mobilehide"<?php endif?> /></span>&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="<?php echo $g['adm_href']?>&amp;recnum=<?php echo $recnum?>&amp;p=<?php echo $p?>&amp;id=<?php echo $BR['id']?>"><span class="name<?php if($BR['id']==$R['id']):?> on<?php endif?>"><?php echo $BR['name']?></span><span class="id">(<?php echo $BR['id']?>)</span></a>
			</li>
			<?php endwhile?>
			</ul>
		</div>

		</form>
	</div>


	<div id="catinfo">


		<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" enctype="multipart/form-data" onsubmit="return saveCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $module?>" />
		<input type="hidden" name="moduleid" value="<?php echo $R['id']?>" />
		<input type="hidden" name="a" value="moduleinfo_update" />

		<div class="title">

			<div class="xleft">
				모듈 등록정보
			</div>
			<div class="xright">
				<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=market&amp;front=pack&amp;type=module">모듈추가</a>
			</div>

		</div>

		<div class="notice">
			<div class="icon"><img src="<?php echo getThumbImg($g['path_module'].$R['id'].'/icon')?>" width="60" height="60" alt="" /></div>
			<div class="ment">
			<div><?php echo $R['name']?><span>(<?php echo $R['id']?>)</span></div>
			선택된 모듈에 대한 등록정보입니다.<br />
			시스템 기본모듈은 삭제할 수 없습니다.<br />
			</div>
			<div class="clear"></div>
		</div>

	
		<table>
			<tr>
				<td class="td1">모듈아이디</td>
				<td class="td2 b">
					<?php echo $R['id']?>
				</td>
			</tr>
			<tr>
				<td class="td1">모 듈 이 름</td>
				<td class="td2">
					<input type="text" name="name" value="<?php echo $R['name']?>" class="input sname" />
					<?php if(!$R['system']):?>
					<span class="btn01"><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=module_delete&amp;moduleid=<?php echo $R['id']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('관련파일/DB데이터가 모두 삭제됩니다.\n정말로 삭제하시겠습니까?     ')">모듈삭제</a></span>
					<?php endif?>
				</td>
			</tr>
			<tr>
				<td class="td1">모듈아이콘</td>
				<td class="td2">
					<input type="file" name="upfile" value="" class="input supload" />
					<div>gif/jpg/png 파일가능 - 60*60픽셀 사이즈로 자동조정됩니다</div>
				</td>
			</tr>
			<tr>
				<td class="td1">모듈감추기</td>
				<td class="td2 shift">
					<input type="checkbox" name="hidden" value="1"<?php if($R['hidden']):?> checked="checked"<?php endif?> />모듈패널(모듈리스트)에서 출력제외
				</td>
			</tr>
			<tr>
				<td class="td1">모바일관리</td>
				<td class="td2 shift">
					<input type="checkbox" name="mobile" value="1"<?php if($R['mobile']):?> checked="checked"<?php endif?> />모바일전용 관리자페이지에 출력함
				</td>
			</tr>
			<tr>
				<td class="td1">테이블생성</td>
				<td class="td2">
					<?php if($R['tblnum']):?>
					DB테이블 <?php echo $R['tblnum']?>개가 생성되었습니다.
					<?php else:?>
					이 모듈은 DB테이블을 생성하지 않습니다.
					<?php endif?>
				</td>
			</tr>
			<tr>
				<td class="td1">모듈등록일</td>
				<td class="td2">
					<?php echo getDateFormat($R['d_regis'],'Y/m/d')?>
				</td>
			</tr>
			<tr>
				<td class="td1">포함언어팩</td>
				<td class="td2">
					<?php $i=0?>
					<?php $dirs = opendir($g['path_module'].$R['id'].'/')?>
					<?php while(false !== ($tpl = readdir($dirs))):?>
					<?php if(substr($tpl,0,5)!='lang.')continue?>
					<?php $reallang = str_replace('lang.','',$tpl)?>
					<span class="b"><?php echo getFolderName($g['path_var'].'language/'.$reallang)?></span>(<?php echo $reallang?>)<br />
					<?php $i++; endwhile?>
					<?php closedir($dirs)?>
					<?php if(!$i):?>
					<span class="b">언어팩이 없는 모듈입니다</span>
					<?php endif?>
				</td>
			</tr>
		</table>


		<div class="submitbox">
			<?php if($R['id']):?>
			<input type="button" class="btngray" value="모듈실행" onclick="window.open('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $R['id']?>');" />
			<input type="button" class="btngray" value="모듈관리" onclick="goHref('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>&amp;module=<?php echo $R['id']?>');" />
			<?php endif?>
			<input type="submit" class="btnblue" value="<?php echo $R['id']?'모듈속성 변경':'모듈추가'?>" />
			<div class="clear"></div>
		</div>

		</form>
		
	</div>
	<div class="clear"></div>
</div>




<script type="text/javascript">
//<![CDATA[
function saveCheck(f)
{
	if (f.name.value == '')
	{
		alert('모듈이름을 입력해 주세요.     ');
		f.name.focus();
		return false;
	}
	return confirm('정말로 실행하시겠습니까?         ');
}
function showCheck(id,hidden)
{
	frames._action_frame_<?php echo $m?>.location.href = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $module?>&a=moduleshow_update&moduleid=' + id + '&hidden=' + hidden;
}
function mobileCheck(id,mobile)
{
	frames._action_frame_<?php echo $m?>.location.href = '<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $module?>&a=modulemobile_update&moduleid=' + id + '&mobile=' + mobile;
}
//]]>
</script>



