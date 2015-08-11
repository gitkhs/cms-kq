<?
	$account = $account ? $account : $s;

	include_once $g['path_core'].'function/menu.func.php';
	$SITES = getDbArray($table['s_site'],'','*','gid','asc',0,$p);
	$ISCAT = getDbRows($table['s_menu'],'site='.$account);

	if($cat)
	{
		$CINFO = getUidData($table['s_menu'],$cat);
		$ctarr = getMenuCodeToPath($table['s_menu'],$cat,0);
		$ctnum = count($ctarr);
		for ($i = 0; $i < $ctnum; $i++) $CXA[] = $ctarr[$i]['uid'];
	}

	$catcode = '';
	$is_fcategory =  $CINFO['uid'] && $vtype != 'sub';
	$is_regismode = !$CINFO['uid'] || $vtype == 'sub';
	if ($is_regismode)
	{
		$CINFO['menutype'] = '';
		$CINFO['name']	   = '';
		$CINFO['joint']	   = '';
		$CINFO['redirect'] = '';
		$CINFO['hidden']   = '';
		$CINFO['target']   = '';
		$CINFO['imghead']  = '';
		$CINFO['imgfoot']  = '';
	}
	
	$tmp	= getDbSelect($table['bbslist'],"","*");
	while($cur = db_fetch_array($tmp)){$bbslst[] = $cur;}

	$tmp	= getDbSelect($table['mInvalid'],"uid > 0 order by uid","*");
	while($cur = db_fetch_array($tmp)){$invlst[] = $cur;}
?>

<div id="menu">
	<table class="tbl-form">
	<colgroup>
	<col width="200"/>
	<col/>
	</colgroup>
	<tr>
		<td class="cate"><? // 카테고리 관리 ?>
			<div>
				<select onchange="goHref('<?=$g['s']?>/?r=<?=$r?>&amp;m=<?=$m?>&amp;mod=<?=$mod?>&amp;div=<?=$div?>&amp;account='+this.value);">
				<?php while($S = db_fetch_array($SITES)):?>
				<option value="<?php echo $S['uid']?>"<?php if($account==$S['uid']):?> selected="selected"<?php endif?>>ㆍ<?php echo $S['name']?></option>
				<?php endwhile?>
				<?php if(!db_num_rows($SITES)):?>
				<option value="">등록된 사이트가 없습니다.</option>
				<?php endif?>
				</select>
			</div>
			<div class="clear"></div>
		<?php if($ISCAT):?>
			<div class="joinimg"></div>
			<div class="tree<?php if(strstr($_SERVER['HTTP_USER_AGENT'],'MSIE 7')):?> ie7<?php endif?>">
			<?php if(!$_isDragScript):?>
			<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/core.js"></script>
			<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/events.js"></script>
			<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/css.js"></script>
			<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/coordinates.js"></script>
			<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/drag.js"></script>
			<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/dragsort.js"></script>
			<script type="text/javascript">
			//<![CDATA[
			var dragsort = ToolMan.dragsort();
			//]]>
			</script>
			<?php endif?>
			<script type="text/javascript">
			//<![CDATA[
			var dragsort = ToolMan.dragsort();
			var TreeImg = "<?php echo $g['img_core']?>/tree/default_none";
			var ulink = "<?=$g['s']?>/?r=<?=$r?>&amp;m=<?=$m?>&amp;mod=<?=$mod?>&amp;div=<?=$div?>&amp;account=<?php echo $account?>&amp;cat=";
			//]]>
			</script>
			<script type="text/javascript" src="<?php echo $g['s']?>/_core/js/tree.js"></script>
			<script type="text/javascript">
			//<![CDATA[
			var TREE_ITEMS = [['', null, <?php getMenuShow($account,$table['s_menu'],0,0,0,$cat,$CXA,0)?>]];
			new tree(TREE_ITEMS, tree_tpl);
			<?php echo $MenuOpen?>
			//]]>
			</script>
			</div>
		<?php endif?>
		<?php if($CINFO['isson']||(!$cat&&$ISCAT)):?>
			<form action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>">
			<input type="hidden" name="r" value="<?php echo $r?>" />
			<input type="hidden" name="m" value="<?php echo $module?>" />
			<input type="hidden" name="a" value="modifymenugid" />

			<div class="savebtn">
				<input type="image" src="<?php echo $g['img_core']?>/_public/btn_save.gif" title="순서저장" />
			</div>
			<div class="tt1">메뉴순서</div>
			<ul id="menuorder" style="/*display:none;*/">
			<?php $_MENUS=getDbSelect($table['s_menu'],'site='.$s.' and parent='.intval($CINFO['uid']).' and depth='.($CINFO['depth']+1).' order by gid asc','*')?>
			<?php while($_M=db_fetch_array($_MENUS)):?>
			<li>
				<input type="checkbox" name="menumembers[]" value="<?php echo $_M['uid']?>" checked="checked" />
				<img src="<?php echo $g['img_core']?>/_public/ico_drag.gif" alt="" class="drag" />
				<?php echo $_M['name']?>
				<?php if($_M['hidden']):?><img src="<?php echo $g['img_core']?>/_public/ico_hidden.gif" alt="" /><?php endif?>
			</li>
			<?php endwhile?>
			</ul>
			</form>
		<?php endif?>
		</td>

		<td class="cont"><? // 메뉴 본내용 관리 ?>
			<form id="procForm" name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>">
			<input type="hidden" name="r" value="<?php echo $r?>" />
			<input type="hidden" name="a" value="<?=$mod?>" />
			<input type="hidden" name="m" value="<?=$m?>" />
			<input type="hidden" name="mod" value="<?=$mod?>" />
			<input type="hidden" name="div" value="<?=$div?>" />

			<input type="hidden" name="flid" value="<?=$flid?>" />
			<input type="hidden" name="account" value="<?php echo $account?>" />
			<input type="hidden" name="cat" value="<?php echo $CINFO['uid']?>" />
			<input type="hidden" name="menutype" value="1"/>
			<input type="hidden" name="vtype" value="<?php echo $vtype?>" />
			<input type="hidden" name="depth" value="<?php echo intval($CINFO['depth'])?>" />
			<input type="hidden" name="parent" value="<?php echo intval($CINFO['uid'])?>" />
			<input type="hidden" name="perm_g" value="<?php echo $CINFO['perm_g']?>" />
			<input type="hidden" name="actid" value="" />

			<div class="title">

				<div class="xleft">

				<?php if($is_regismode):?>
					<?php if($vtype == 'sub'):?>서브메뉴 만들기<?php else:?>최상위메뉴 만들기<?php endif?>
				<?php else:?>
					메뉴 등록정보
				<?php endif?>

				</div>
				<div class="xright">

					<a href="<?=$g['s']?>/?r=<?=$r?>&amp;m=<?=$m?>&amp;mod=<?=$mod?>&amp;div=<?=$div?>&account=<?php echo $account?>&amp;type=makesite">최상위메뉴 등록</a>

				</div>
			</div>

			<div class="notice">
				<?php if($is_regismode):?>
				복수의 메뉴를 한번에 등록하시려면 메뉴명을 콤마(,)로 구분해 주세요.<br />
				보기)회사소개,커뮤니티,고객센터<br />
				<?php else:?>
				속성을 변경하려면 설정값을 변경한 후 [속성변경] 버튼을 클릭해주세요.<br />
				메뉴를 삭제하면 소속된 하위메뉴까지 모두 삭제됩니다.
				<?php endif?>
			</div>

			<table class="tbl-form">
			<colgroup>
			<col width="100">
			<col>
			</colgroup>
				<?php if($vtype == 'sub'):?>
				<tr>
					<td class="lbl">상위메뉴</td>
					<td>
						<div class="row">
							<?php for ($i = 0; $i < $ctnum; $i++): ?>
							<a href="<?php echo $g['adm_href']?>&amp;account=<?php echo $account?>&amp;cat=<?php echo $ctarr[$i]['uid']?>"><?php echo $ctarr[$i]['name']?></a>
							<?php if($i < $ctnum-1):?> &gt; <?php endif?>
							<?php $catcode .= $ctarr[$i]['id'].'/';endfor?>
						</div>
					</td>
				</tr>
				<?php else:?>
				<?php if($cat):?>
				<tr>
					<td class="lbl">상위메뉴</td>
					<td>
						<div class="row">
							<?php for ($i = 0; $i < $ctnum-1; $i++): ?>
							<a href="<?php echo $g['adm_href']?>&amp;account=<?php echo $account?>&amp;cat=<?php echo $ctarr[$i]['uid']?>"><?php echo $ctarr[$i]['name']?></a>
							<?php if($i < $ctnum-2):?> &gt; <?php endif?>
							<?php $delparent=$ctarr[$i]['uid'];$catcode .= $ctarr[$i]['id'].'/';endfor?>
							<?php if(!$delparent):?>최상위메뉴<?php endif?>
						</div>
					</td>
				</tr>
				<?php endif?>
				<?php endif?>
				<tr>
					<td class="lbl">메뉴명칭</td>
					<td>
						<div class="row">
							<input type="text" name="name" value="<?php echo $CINFO['name']?>" size="60" />
							<?php if($is_fcategory):?>
							<input type="button" class="btnkhaki" value="메뉴삭제" onclick="return deleteMenu();">
							<input type="button" class="btnkhaki" value="서브메뉴등록" onclick="goHref('<?php echo $g['s']?>/?r=<?=$r?>&amp;m=<?=$m?>&amp;mod=<?=$mod?>&amp;div=<?=$div?>&amp;account=<?php echo $account?>&amp;cat=<?php echo $cat?>&amp;vtype=sub');">
							<?php endif?>
						</div>
					</td>
				</tr>

				<tr>
					<td class="lbl">전시내용</td>
					<td>
						<div id="jointBox" class="guide">
							<div class="row">
								<input type="text" name="joint" id="jointf" value="<?php echo $CINFO['joint'] ? $CINFO['joint'] : "{$g['s']}/?r={$r}&m=home&mod=stdpage";?>" size="60" />
								<?php if($CINFO['joint']):?>
								<input type="button" class="btngreen" value="미리보기" onclick="window.open('<?php echo $CINFO['joint']?>');" />
								<?php endif?>
							</div>
							<div class="row">
								<input type="button" class="btnkhaki" value="일반페이지" onclick="$('input[name=joint]').val('<?=$g['s'].'/?r='.$r.'&m=home&mod=stdpage'?>');$('input[name=joint]').focus();"/>
								<select style="width:250px;" onchange="$('input[name=joint]').val(this.value);$('input[name=joint]').focus();">
									<option value=""> 게시판 </option>
									<?foreach($bbslst as $_R){?>
									<option value="<?=$g['s'].'/?r='.$r.'&m=bbs&bid='.$_R['id']?>"><?=$_R['name']?> [bid=<?=$_R['id']?>]</option>
									<?}?>
								</select>
							</div>
							<div class="row">
								<label>
								<input type="checkbox" name="redirect" value="1"<?php if($CINFO['redirect']):?> checked="checked"<?php endif?> />
								입력된 주소로 리다이렉트 시켜줍니다.(외부주소 링크시 사용)
								</label>
							</div>
							<div class="row">연결주소가 지정되면 이 메뉴를 호출시 해당 연결주소의 모듈이 출력됩니다.</div>
						</div>
					</td>
				</tr>

				<tr>
					<td class="lbl">메뉴옵션</td>
					<td>
						<div class="row">
						<label><input type="checkbox" name="mobile" value="1"<?php if($CINFO['mobile']):?> checked="checked"<?php endif?> /> 모바일메뉴출력</label>
						<label><input type="checkbox" name="app" value="1"<?php if($CINFO['app']):?> checked="checked"<?php endif?> /> 어플메뉴출력</label>
						<label><input type="checkbox" name="target" value="_blank"<?php if($CINFO['target']):?> checked="checked"<?php endif?> /> 새창열기</label>
						<label><input type="checkbox" name="hidden" value="1"<?php if($CINFO['hidden']):?> checked="checked"<?php endif?> /> 메뉴숨김</label>
						</div>
					</td>
				</tr>

				<!-- 권한 설정이 필요한경우 사용 -->
				<!--
				<tr>
					<td class="tl">접근 권한</td>
					<td class="tc">
						<select name="perm_l" class="select1">
						<option value="">+ 전체허용</option>
						<option value="1"<?php if($CINFO['perm_l']==1):?> selected="selected"<?php endif?>>ㆍ일반회원 </option>
						<option value="20"<?php if($CINFO['perm_l']==20):?> selected="selected"<?php endif?>>ㆍ관리자 </option>
						</select>
						게시판 연결시에만 사용, 글쓰기, 수정, 답글 등의 권한 부여시 사용.
					</td>
				</tr>
				-->
				
				<?php if($CINFO['uid']):?>
				<?if(is_file($g['dir_module'].'var/menu/var.menu'.$CINFO['id'].'.php')) include $g['dir_module'].'var/menu/var.menu'.$CINFO['id'].'.php';?>
				<?$cate = $vtype ? substr($catcode,0,strlen($catcode)-1) : $catcode.$CINFO['id'];?>
				<?$aCat = explode('/',$cate);?>
				<tr>
					<td class="lbl">메뉴주소</td>
					<td>
						<div class="row">물리주소 : <span class="hand" onclick="window.open(this.innerText);" title="접속하기"><?php echo $g['s']?>/index.php?r=<?php echo $r?>&amp;c=<?= $cate?></span><br /></div>
						<div class="row">현재주소 : <span class="link hand" onclick="window.open(this.innerText);" title="접속하기"><?php echo RW($CINFO['uid'] ? 'c='.$cate :0)?></span></div>
					</td>
				</tr>
				<?if(!$vtype){?>
				<tr>
					<td class="lbl">상단 이미지</td>
					<td>
						<div class="row">
							<label><input type="checkbox" name="topslide" value="1" <?if($d['setmenu']['topslide']) echo 'checked="checked"';?>> 슬라이딩 이미지 처리 여부</label>
							<label><input type="checkbox" name="topslide_wide" value="1" <?if($d['setmenu']['topslide_wide']) echo 'checked="checked"';?>> 이미지 와이드 처리</label>
							<label><input type="checkbox" name="topslide_sub" value="1" <?if($d['setmenu']['topslide_sub']) echo 'checked="checked"';?>> 서브메뉴 적용</label>
						</div>
						<div class="row">- 이미지명 : top_slide<?=$CINFO['id']?>_1.jpg, top_slide<?=$CINFO['id']?>_2.jpg, top_slide<?=$CINFO['id']?>_3.jpg ... (카운팅 증가)</div>
						<div class="row">
							<label><input type="checkbox" name="topfixed" value="1" <?if($d['setmenu']['topfixed']) echo 'checked="checked"';?>> 고정 이미지 처리 여부</label>
							<label><input type="checkbox" name="topfixed_wide" value="1" <?if($d['setmenu']['topfixed_wide']) echo 'checked="checked"';?>> 이미지 와이드 처리</label>
							<label><input type="checkbox" name="topfixed_sub" value="1" <?if($d['setmenu']['topfixed_sub']) echo 'checked="checked"';?>> 서브메뉴 적용</label>
						</div>
						<div class="row">- 이미지명 : top_fixed<?=$CINFO['id']?>.jpg</div>
					</td>
				</tr>

				<tr>
					<td class="lbl">하단 이미지</td>
					<td>
						<div class="row">
							<label><input type="checkbox" name="btmfixed" value="1" <?if($d['setmenu']['btmfixed']) echo 'checked="checked"';?>> 고정 이미지 처리 여부</label>
							<label><input type="checkbox" name="btmfixed_wide" value="1" <?if($d['setmenu']['btmfixed_wide']) echo 'checked="checked"';?>> 이미지 와이드 처리</label>
							<label><input type="checkbox" name="btmfixed_sub" value="1" <?if($d['setmenu']['btmfixed_sub']) echo 'checked="checked"';?>> 서브메뉴 적용</label>
						</div>
						<div class="row">- 이미지명 : bottom_fixed<?=$CINFO['id']?>.jpg</div>
					</td>
				</tr>
				<?}?>
				<?php endif?>

				<tr>
					<td class="submit" colspan="2">
						<?php if($is_fcategory && $CINFO['isson']):?>
						<div class="row">
							<label><input type="checkbox" name="subcopy" value="1"/>이 설정(메뉴숨김,레이아웃,권한)을 서브메뉴에도 일괄적용</label>
						</div>
						<?php endif?>

						<?php if($vtype=='sub'):?><input type="button" class="btndark btnsz01" value="등록취소" onclick="history.back();" /><?php endif?>
						<input type="submit" class="btnblue btnsz01" value="<?php echo $is_fcategory?'메뉴속성 변경':'신규메뉴 등록'?>" onclick="$('input[name=actid]').val('regis');"/>
						<div class="clear"></div>
					</td>
				</tr>
			</table>

			</form>
		</td>
	</tr>
	</table>

</div>


<script type="text/javascript">
//<![CDATA[
var orderopen = false;
function orderOpen()
{
	if (orderopen == false)
	{
		getId('menuorder').style.display = 'block';
		orderopen = true;
	}
	else {
		getId('menuorder').style.display = 'none';
		orderopen = false;
	}
}
function codShowHide(layer,show,hide,img)
{
	if(getId(layer).style.display != show)
	{
		getId(layer).style.display = show;
		img.src = img.src.replace('ico_under','ico_over');
		setCookie('ck_'+layer,show,1);
	}
	else
	{
		getId(layer).style.display = hide;
		img.src = img.src.replace('ico_over','ico_under');
		setCookie('ck_'+layer,hide,1);
	}
}
function saveCheck(f)
{

    var l1 = f._perm_g;
    var n1 = l1.length;
    var i;
	var s1 = '';

	for	(i = 0; i < n1; i++)
	{
		if (l1[i].selected == true && l1[i].value != '')
		{
			s1 += '['+l1[i].value+']';
		}
	}

	f.perm_g.value = s1;

	if (f.account.value == '')
	{
		alert('사이트가 등록되지 않았습니다.      ');
		return false;
	}
	if (f.name.value == '')
	{
		alert('메뉴명칭을 입력해 주세요.      ');
		f.name.focus();
		return false;
	}
	if (f.id)
	{
		if (f.id.value == '')
		{
			alert('메뉴코드를 입력해 주세요.      ');
			f.id.focus();
			return false;
		}
		if (!chkFnameValue(f.id.value))
		{
			alert('메뉴코드는 영문대소문자/숫자/_/- 만 사용할 수 있습니다.      ');
			f.id.focus();
			return false;
		}
	}
	if (f.menutype.value == '1')
	{
		if (f.joint.value == '')
		{
			alert('모듈을 연결해 주세요.      ');
			f.joint.focus();
			return false;
		}
	}
	return confirm('정말로 실행하시겠습니까?         ');
}
function  deleteMenu(){
	if(confirm('정말로 삭제하시겠습니까?')){
		$("input[name=parent]").val('<?=$delparent?>');
		$("input[name=actid]").val('delete');
		$("#procForm").submit();
	}
	
	return false;
}
function slideshowOpen()
{
	if(getId('menuorder')) dragsort.makeListSortable(getId("menuorder"));
}
slideshowOpen();
<?php if($type == 'makesite'):?>
document.procForm.name.focus();
<?php endif?>
//]]>
</script>
