<?php
include_once $g['path_core'].'function/menu.func.php';
$ISCAT = getDbRows($table['s_domain'],'');


if($cat)
{
	$CINFO = getUidData($table['s_domain'],$cat);
	$ctarr = getMenuCodeToPath($table['s_domain'],$cat,0);
	$ctnum = count($ctarr);
	for ($i = 0; $i < $ctnum; $i++) $CXA[] = $ctarr[$i]['uid'];
}

$is_fcategory =  $CINFO['uid'] && $vtype != 'sub';
$is_regismode = !$CINFO['uid'] || $vtype == 'sub';
if ($is_regismode)
{
	$CINFO['name'] = '';
	$CINFO['site'] = '';
}
?>


<div id="catebody">
	<div id="category">
		<div class="title">
			연결도메인
		</div>
		<?php if($ISCAT):?>
		<div class="joinimg"></div>
		<div class="tree<?php if(strstr($_SERVER['HTTP_USER_AGENT'],'MSIE 7')):?> ie7<?php endif?>">
		<script type="text/javascript">
		//<![CDATA[
		var TreeImg = "<?php echo $g['img_core']?>/tree/default_none";
		var ulink = "<?php echo $g['adm_href']?>&amp;cat=";
		//]]>
		</script>
		<script type="text/javascript" src="<?php echo $g['url_root']?>/_core/js/tree.js"></script>
		<script type="text/javascript">
		//<![CDATA[
		<?php $icontitle=1?>
		var TREE_ITEMS = [['', null, <?php getMenuShow(0,$table['s_domain'],0,0,0,$cat,$CXA,0)?>]];
		new tree(TREE_ITEMS, tree_tpl);
		<?php echo $MenuOpen?>
		//]]>
		</script>
		</div>
		<?php else:?>
		<div class="none">등록된 도메인이 없습니다.</div>
		<?php endif?>
	</div>


	<div id="catinfo">


		<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $module?>" />
		<input type="hidden" name="a" value="regisdomain" />
		<input type="hidden" name="account" value="<?php echo $account?>" />
		<input type="hidden" name="cat" value="<?php echo $CINFO['uid']?>" />
		<input type="hidden" name="depth" value="<?php echo intval($CINFO['depth'])?>" />
		<input type="hidden" name="parent" value="<?php echo intval($CINFO['uid'])?>" />
		<input type="hidden" name="vtype" value="<?php echo $vtype?>" />

		<div class="title">

			<div class="xleft">
			
			<?php if($is_regismode):?>
				<?php if($vtype == 'sub'):?>서브도메인 등록<?php else:?>메인도메인 등록<?php endif?>
			<?php else:?>
				도메인 등록정보
			<?php endif?>
			
			</div>
			<div class="xright">

				<a href="<?php echo $g['adm_href']?>&amp;type=makedomain">메인도메인 등록</a>

			</div>





		</div>

		<div class="notice">
			도메인을 등록하면 도메인별로 사이트를 연결할 수 있습니다.<br />
			1차도메인 및 서브도메인을 구분할 수 있으며 포트지정에 대해서도 적용됩니다.<br />
			도메인을 동록하지 않으면 개설된 사이트중 첫번째 사이트에 접속됩니다.
		</div>

		<table>
			<?php if($vtype == 'sub'):?>
			<tr>
				<td class="td1">소속도메인</td>
				<td class="td2 b">
				<?php for ($i = 0; $i < $ctnum; $i++) :?>
				<a href="<?php echo $g['adm_href']?>&amp;cat=<?php echo $ctarr[$i]['uid']?>"><?php echo $ctarr[$i]['name']?></a>
				<?php if($i < $ctnum-1):?> &gt; <?php endif?> 
				<?php endfor?>
				</td>
			</tr>
			<?php else:?>
			<?php if($cat):?>
			<tr>
				<td class="td1">소속도메인</td>
				<td class="td2 b">
				<?php for ($i = 0; $i < $ctnum-1; $i++) :?>
				<a href="<?php echo $g['adm_href']?>&amp;cat=<?php echo $ctarr[$i]['uid']?>"><?php echo $ctarr[$i]['name']?></a>
				<?php if($i < $ctnum-2):?> &gt; <?php endif?> 
				<?php $delparent=$ctarr[$i]['uid'];endfor?>
				<?php if(!$delparent):?>최상위도메인<?php endif?>
				</td>
			</tr>
			<?php endif?>
			<?php endif?>
			<tr>
				<td class="td1"><?php if($vtype=='sub'):?>서브도메인<?php else:?>도메인주소<?php endif?></td>
				<td class="td2">
					<input type="text" name="name" value="<?php echo $CINFO['name']?>" class="input sname" />
					<?php if($is_fcategory):?>
					<span class="btn01"><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=deletedomain&amp;cat=<?php echo $cat?>&amp;parent=<?php echo $delparent?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?     ')">도메인삭제</a></span>
					<?php if($CINFO['depth']==1):?>
					<span class="btn01"><a href="<?php echo $g['adm_href']?>&amp;cat=<?php echo $cat?>&amp;vtype=sub">서브도메인 등록</a></span>
					<?php endif?>
					<?php endif?>
				</td>
			</tr>

			<tr>
				<td class="td1">연결사이트</td>
				<td class="td2">
					<select name="site" class="select1">
					<option value="">&nbsp;+ 선택하세요</option>
					<option value="">--------------------------------</option>
					<?php $SITES = getDbArray($table['s_site'],'','*','gid','asc',0,$p)?>
					<?php while($S = db_fetch_array($SITES)):?>
					<option value="<?php echo $S['uid']?>"<?php if($CINFO['site']==$S['uid'] || $selsite==$S['uid']):?> selected="selected"<?php endif?>>ㆍ<?php echo $S['name']?></option>
					<?php endwhile?>
					<?php if(!db_num_rows($SITES)):?>
					<option value="">등록된 사이트가 없습니다.</option>
					<?php endif?>
					</select>
					<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=home&amp;type=makesite" class="dn"><img src="<?php echo $g['img_core']?>/_public/btn_add.gif" alt="사이트추가" title="사이트추가" /></a>
				</td>
			</tr>

		</table>
		
		<div class="submitbox">
			<?php if($cat):?><input type="button" class="btngray" value="접속하기" onclick="viewDomainMode('<?php echo $CINFO['name']?>');" /><?php endif?>
			<?php if($vtype=='sub'):?><input type="button" class="btngray" value="등록취소" onclick="history.back();" /><?php endif?>
			<input type="submit" class="btnblue" value="<?php echo $is_fcategory?'도메인속성 변경':($vtype=='sub'?'서브도메인 등록':'신규도메인 등록')?>" />
			<div class="clear"></div>
		</div>

		</form>
		

	</div>
	<div class="clear"></div>
</div>




<script type="text/javascript">
//<![CDATA[
function viewDomainMode(domain)
{
	var ux = location.href.split('?');
	var us = ux[0].split('/');
	var uh = 'http://'+domain+'/'+us[us.length-2].replace('index.php','')+'/';

	window.open(uh);
}
function saveCheck(f)
{
	if (f.name.value == '')
	{
		alert('도메인을 입력해 주세요.      ');
		f.name.focus();
		return false;
	}
	if (f.site.value == '')
	{
		alert('연결사이트를 지정해 주세요.      ');
		f.site.focus();
		return false;
	}
	return confirm('정말로 실행하시겠습니까?         ');
}
<?php if($type=='makedomain'):?>
document.procForm.name.focus();
<?php endif?>
//]]>
</script>