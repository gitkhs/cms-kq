<?php
function getSwitchList($pos)
{
	$incs = array();
	$dirh = opendir($GLOBALS['g']['path_switch'].$pos);
	while(false !== ($folder = readdir($dirh))) 
	{ 
		$_fins = substr($folder,0,1);
		if(strpos('_.',$_fins) || @in_array($folder,$GLOBALS['d']['switch'][$pos])) continue;
		$incs[] = $folder;
	} 
	closedir($dirh);
	return $incs;
}
$_switchset = array(
	'start'=>'스타트 스위치',
	'top'=>'탑 스위치',
	'head'=>'헤더 스위치',
	'foot'=>'풋터 스위치',
	'end'=>'엔드 스위치'
);
?>

<div id="catebody">
	<div id="category">

		<form name="bbsform" action="<?php echo $g['s']?>/" method="post" onsubmit="return orderCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $module?>" />
		<input type="hidden" name="a" value="switch_order" />
		<div class="title">
			스위치 목록
			<span class="add">
				<input type="image" src="<?php echo $g['img_core']?>/_public/btn_save.gif" title="스위치 추가/위치변경" />
			</span>
		</div>
		
		<div class="tree">

			<?php foreach($_switchset as $_key => $_val):?>
			<?php foreach(getSwitchList($_key) as $_addswitch) $d['switch'][$_key][] = $_addswitch?>
			<div class="tbox">
			<table>
			<tr class="tt">
			<td colspan="2">
			<img src="<?php echo $g['img_core']?>/_public/ico_folder_01.gif" alt="" />
			<?php echo $_val?>
			</td>
			<td class="t2">

			</td>
			</tr>
			</table>
			<ul id="_switch_<?php echo $_key?>">
			<?php foreach($d['switch'][$_key] as $_switch):?>
			<?php if(!$_switch) continue?>
			<li>
			<input type="checkbox" name="switchmembers_<?php echo $_key?>[]" value="<?php echo $_switch?>" checked="checked" class="hide" />
			<table>
			<tr>
			<td class="t0"><img src="<?php echo $g['img_core']?>/_public/ico_f3.png" alt="" /></td>
			<td class="t1">
			<a href="<?php echo $g['adm_href']?>&amp;switchdir=<?php echo $_key.'/'.$_switch?>"<?php if($_key.'/'.$_switch==$switchdir):?> class="on"<?php endif?>><?php echo getFolderName($g['path_switch'].$_key.'/'.$_switch)?></a> <span>(<?php echo str_replace('@','',$_switch)?>)</span>
			</td>
			<td class="t2">
			<a href="<?php echo $g['adm_href']?>&amp;switchdir=<?php echo $_key.'/'.$_switch?>&amp;edit=Y" title="스위치 편집"><img src="<?php echo $g['img_core']?>/_public/btn_edit.gif" alt="" /></a>
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=switch_change&amp;switch_folder=<?php echo $_key?>&amp;switch=<?php echo $_switch?>" onclick="return hrefCheck(this,true,'정말로 스위치를 <?php echo strpos($_switch,'@')?'켜':'끄'?>시겠습니까?');" title="스위치 ON/FF"><img src="<?php echo $g['img_core']?>/_public/ico_<?php echo strpos($_switch,'@')?'hide':'show'?>.gif" alt="" /></a>
			<img src="<?php echo $g['img_core']?>/_public/ico_drag.gif" class="move" alt="" title="위치변경" />
			</td>
			</tr>
			</table>
			</li>
			<?php endforeach?>
			</ul>
			</div>
			<?php endforeach?>
		
		</div>
		</form>

	</div>


	<div id="catinfo">

		<div class="title">
			<div class="xleft">
				<span class="b">등록정보</span>
			</div>
			<div class="xright">
				<?php if($switchdir):?>
				<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=switch_delete&amp;switch=<?php echo $switchdir?>" onclick="return hrefCheck(this,true,'정말로 스위치를 삭제시겠습니까?');">스위치삭제</a>
				<?php endif?>
			</div>
			<div class="clear"></div>
		</div>
		
		<?php if(!$switchdir):?>

		<div class="guidebox">
			<div class="gtt">스위치 사용 가이드</div>
			<p>
				스위치는 프로그램의 실행단계를 5개의 구역으로 분리하여 각각의 구역에 실행여부를 온/오프 할 수 있는 응용 프로그램입니다.<br />
				스위치의 실행여부는 ON/OFF 아이콘을 클릭해서 전환할 수 있습니다.<br />
				너무 많은 스위치를 동작시킬 경우 실행속도에 영향을 줄 수 있으니 꼭 필요한 스위치만 사용하세요.<br />
				스위치는 마켓모듈의 패키지설치 페이지에서 추가할 수 있습니다.<br />
			</p>
			<div class="gtt1">스위치 요소별 실행위치</div>

			<ol>
			<li><i>스타트 스위치</i> - 프로그램 시작과 함께 DB연결,주요파일 로드 후 실행됩니다.</li>
			<li><i>탑 스위치</i> - 모듈 및 레이아웃에 대한 정의후 화면출력 직전에 실행됩니다.</li>
			<li><i>헤더 스위치</i> - head 태그를 닫기 직전에 실행됩니다.</li>
			<li><i>풋터 스위치</i> - body 태그를 닫기 직전에 실행됩니다.</li>
			<li><i>엔드 스위치</i> - 화면출력을 끝내고 실행됩니다.</li>
			</ol>

			<div class="hbox">
				<div class="more"><a href="#." onclick="layerShowHide('guide_structure','block','none');">스위치 실행 스트럭처 자세히보기</a></div>

<fieldset id="guide_structure" class="structure hide">
<legend>[ 킴스큐 실행 프로세스 ]</legend>
<pre>
	<i>- 프로그램 시작 -</i>
	<i>- DB연결 -</i>
	<i>- 주요파일 로드 -</i>

	<span>[스타트 스위치]</span>

	<i>- 모듈 정의 -</i>
	<i>- 레이아웃 정의 -</i> 

	<span>[탑 스위치]</span>
	<fieldset>
	<legend>[ 화면에 출력되는 부분 ]</legend>
	&lt;html&gt;
	&lt;head&gt;

		<i>- 기초 헤더 -</i>
		<span>[헤더 스위치]</span>

	&lt;/head&gt;
	&lt;body&gt;
		
		<i>- 콘텐츠 영역 -</i>
		<span>[풋터 스위치]</span>

	&lt;/body&gt;
	&lt;/html&gt;
	</fieldset>

	<span>[엔드 스위치]</span>
</pre>
</fieldset>

			</div>
		</div>


		<?php else:?>
			<?php if($edit=='Y'):?>


			<form name="procForm" action="<?php echo $g['s']?>/" method="post" onsubmit="return saveCheck(this);">
			<input type="hidden" name="r" value="<?php echo $r?>" />
			<input type="hidden" name="m" value="<?php echo $module?>" />
			<input type="hidden" name="a" value="switch_edit" />
			<input type="hidden" name="switch" value="<?php echo $switchdir?>" />
			
			<br />
			<table>
				<tr>
					<td class="td1">
						스위치명칭
					</td>
					<td class="td2">
						<input type="text" name="name" value="<?php echo getFolderName($g['path_switch'].$switchdir)?>" class="input sname" />
					</td>
				</tr>
			</table>

			<textarea name="switch_code"><?php echo implode('',file($g['path_switch'].$switchdir.'/main.php'))?></textarea>

			<div class="submitbox">
				<input type="submit" class="btnblue" value="스위치 편집" />
			</div>

			</form>

			<?php else:?>
			<?php if(is_file($g['path_switch'].$switchdir.'/readme.txt')):?>
				<div class="guide">
				<div class="help"><?php echo getContents(nl2br(implode('',file($g['path_switch'].$switchdir.'/readme.txt'))),'HTML')?></div>
				</div>
			<?php else:?>
				<div class="none">
					<img src="<?php echo $g['img_core']?>/_public/ico_notice.gif" alt="" />
					이 스위치는 안내문서를 제공하지 않습니다.
				</div>
			<?php endif?>
			<?php endif?>
		<?php endif?>
	</div>
	<div class="clear"></div>
</div>



<?php if(!$_isDragScript):?>
<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/core.js"></script>
<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/events.js"></script>
<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/css.js"></script>
<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/coordinates.js"></script>
<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/drag.js"></script>
<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/dragsort.js"></script>
<?php endif?>

<script type="text/javascript">
//<![CDATA[
function orderCheck(f)
{
	getIframeForAction(f);
	return confirm('스위치 위치를 이 순서로 저장하시겠습니까?    ');
}
function saveCheck(f)
{
	if (f.name.value == '')
	{
		alert('스위치명을 입력해 주세요.   ');
		f.name.focus();
		return false;
	}

	getIframeForAction(f);
	return confirm('정말로 실행하시겠습니까?    ');
}
var dragsort = ToolMan.dragsort();
dragsort.makeListSortable(getId('_switch_start'));
dragsort.makeListSortable(getId('_switch_top'));
dragsort.makeListSortable(getId('_switch_head'));
dragsort.makeListSortable(getId('_switch_foot'));
dragsort.makeListSortable(getId('_switch_end'));
//]]>
</script>

