<?php
$sort	= $sort ? $sort : 'gid';
$orderby= $orderby ? $orderby : 'asc';
$recnum	= $recnum && $recnum < 301 ? $recnum : 20;
$bbsque	= '';

$RCD = getDbArray($table[$module.'list'],$bbsque,'*',$sort,$orderby,$recnum,$p);
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
?>




<div id="catebody">
	<div id="category">
		<form name="bbsform" action="<?php echo $g['s']?>/" method="post" target="_orderframe_">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $module?>" />
		<input type="hidden" name="a" value="bbsorder_update" />

		<div class="title">
			<select class="c1" onchange="goHref('<?php echo $g['adm_href']?>&amp;iframe=<?php echo $iframe?>&amp;recnum='+this.value);">
			<?php for($i=30;$i<=300;$i=$i+30):?>
			<option value="<?php echo $i?>"<?php if($i==$recnum):?> selected="selected"<?php endif?>>D.<?php echo $i?></option>
			<?php endfor?>
			</select>
			<select class="c2" onchange="goHref('<?php echo $g['adm_href']?>&amp;iframe=<?php echo $iframe?>&amp;recnum=<?php echo $recnum?>&amp;p='+this.value);">
			<?php for($i = 1; $i <= $TPG; $i++):?>
			<option value="<?php echo $i?>"<?php if($i==$p):?> selected="selected"<?php endif?>>P.<?php echo $i?></option>
			<?php endfor?>
			</select>

			<a href="<?php echo $g['adm_href']?>&amp;iframe=<?php echo $iframe?>" title="게시판추가"><img src="<?php echo $g['img_core']?>/_public/btn_add.gif" alt="추가" /></a>
			<img src="<?php echo $g['img_core']?>/_public/btn_save.gif" title="순서저장" alt="save" class="hand" onclick="document.bbsform.submit();" />

		</div>
		
		<?php if($NUM):?>
		<div class="tree">
			<ul id="bbsorder">
			<?php while($BR = db_fetch_array($RCD)):?>
			<li ondblclick="window.open('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $module?>&bid=<?php echo $BR['id']?>');"<?php if($BR['category']):?> class="usecat" title="<?php echo $BR['category']?>"<?php endif?>>
				<input type="checkbox" name="bbsmembers[]" value="<?php echo $BR['uid']?>" checked="checked" />
				<a href="<?php echo $g['adm_href']?>&amp;iframe=<?php echo $iframe?>&amp;recnum=<?php echo $recnum?>&amp;p=<?php echo $p?>&amp;uid=<?php echo $BR['uid']?>"><span class="name<?php if($BR['uid']==$R['uid']):?> on<?php endif?>" title="<?php echo number_format($BR['num_r'])?>개"><?php echo $BR['name']?></span></a><span class="id">(<?php echo $BR['id']?>)</span>
			</li>
			<?php endwhile?>
			</ul>
		</div>
		<?php else:?>
		<div class="none">등록된 게시판이 없습니다.</div>
		<?php endif?>

		</form>
	</div>


	<div id="catinfo">


		<form name="procForm" action="<?php echo $g['s']?>/" method="post" enctype="multipart/form-data" onsubmit="return saveCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $module?>" />
		<input type="hidden" name="a" value="makebbs" />
		<input type="hidden" name="bid" value="<?php echo $R['id']?>" />
		<input type="hidden" name="perm_g_list" value="<?php echo $R['perm_g_list']?>" />
		<input type="hidden" name="perm_g_view" value="<?php echo $R['perm_g_view']?>" />
		<input type="hidden" name="perm_g_write" value="<?php echo $R['perm_g_write']?>" />
		<input type="hidden" name="perm_g_down" value="<?php echo $R['perm_g_down']?>" />

		<div class="title">

			<div class="xleft">
				게시판 등록정보
			</div>
			<div class="xright">
				<a href="<?php echo $g['adm_href']?>&amp;iframe=<?php echo $iframe?>">새게시판 만들기</a>
			</div>
		</div>

		<div class="notice">
			게시판의 순서를 변경하려면 게시판을 드래그 후 [save]버튼을 클릭해 주세요.<br />
			게시판을 메뉴나 페이지에 연결하면 연결메뉴/연결페이지의 설정값은 무시됩니다.
		</div>

		<table>
			<tr>
				<td class="td1">
					게시판이름					
					<img src="<?php echo $g['img_core']?>/_public/ico_q.gif" alt="도움말" title="도움말" class="hand" onclick="layerShowHide('guide_bbsidname','block','none');" />
				</td>
				<td class="td2">
					<input type="text" name="name" value="<?php echo $R['name']?>" class="input sname" />
					<?php if($R['id']):?>
					<span class="btn01"><a href="<?php echo RW('m='.$module.'&bid='.$R['id'])?>" target="_blank">게시판보기</a></span>
					<?php else:?>

					아이디 <input type="text" name="id" value="" class="input sname2" />

					<?php endif?>

					<div id="guide_bbsidname" class="guide hide">
					<span class="b">게시판이름</span> : 게시판제목에 해당되며 한글,영문등 자유롭게 등록할 수 있습니다.<br />
					<span class="b">아이디</span> : 영문 대소문자+숫자+_ 조합으로 만듭니다.<br />
					</div>

				</td>
			</tr>
			<tr>
				<td class="td1">
					카 테 고 리
					<img src="<?php echo $g['img_core']?>/_public/ico_q.gif" alt="도움말" title="도움말" class="hand" onclick="layerShowHide('guide_category','block','none');" />
				</td>
				<td class="td2">
					<input type="text" name="category" value="<?php echo $R['category']?>" class="input sname1" />
					<div id="guide_category" class="guide hide">
					분류를 <span class="b">콤마(,)</span>로 구분해 주세요. <span class="b">첫분류는 분류제목</span>이 됩니다.<br />
					보기)<span class="b">구분</span>,유머,공포,엽기,무협,기타
					</div>
				</td>
			</tr>
			<tr>
				<td class="td1">레 이 아 웃</td>
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
					<option value="<?php echo $tpl?>/<?php echo $tpl1?>"<?php if($d['bbs']['layout']==$tpl.'/'.$tpl1):?> selected="selected"<?php endif?>>ㆍ<?php echo getFolderName($g['path_layout'].$tpl)?>(<?php echo str_replace('.php','',$tpl1)?>)</option>
					<?php endwhile?>
					<?php closedir($dirs1)?>
					<?php endwhile?>
					<?php closedir($dirs)?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="td1">게시판테마</td>
				<td class="td2">
					<select name="skin" class="select1">
					<option value="">&nbsp;+ 게시판 대표테마</option>
					<option value="">--------------------------------</option>
					<?php $tdir = $g['path_module'].$module.'/theme/_pc/'?>
					<?php $dirs = opendir($tdir)?>
					<?php while(false !== ($skin = readdir($dirs))):?>
					<?php if($skin=='.' || $skin == '..' || is_file($tdir.$skin))continue?>
					<option value="_pc/<?php echo $skin?>" title="<?php echo $skin?>"<?php if($d['bbs']['skin']=='_pc/'.$skin):?> selected="selected"<?php endif?>>ㆍ<?php echo getFolderName($tdir.$skin)?>(<?php echo $skin?>)</option>
					<?php endwhile?>
					<?php closedir($dirs)?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="td1 sfont1">(모바일접속)</td>
				<td class="td2">
					<select name="m_skin" class="select1">
					<option value="">&nbsp;+ 모바일 대표테마</option>
					<option value="">--------------------------------</option>
					<?php $tdir = $g['path_module'].$module.'/theme/_mobile/'?>
					<?php $dirs = opendir($tdir)?>
					<?php while(false !== ($skin = readdir($dirs))):?>
					<?php if($skin=='.' || $skin == '..' || is_file($tdir.$skin))continue?>
					<option value="_mobile/<?php echo $skin?>" title="<?php echo $skin?>"<?php if($d['bbs']['m_skin']=='_mobile/'.$skin):?> selected="selected"<?php endif?>>ㆍ<?php echo getFolderName($tdir.$skin)?>(<?php echo $skin?>)</option>
					<?php endwhile?>
					<?php closedir($dirs)?>
					</select>
				</td>
			</tr>

			<tr>
				<td class="td1">댓 글 테 마</td>
				<td class="td2">
					<select name="c_skin" class="select1">
					<option value="">&nbsp;+ 댓글 대표테마</option>
					<option value="">--------------------------------</option>
					<?php $tdir = $g['path_module'].'comment/theme/_pc/'?>
					<?php $dirs = opendir($tdir)?>
					<?php while(false !== ($skin = readdir($dirs))):?>
					<?php if($skin=='.' || $skin == '..' || is_file($tdir.$skin))continue?>
					<option value="_pc/<?php echo $skin?>" title="<?php echo $skin?>"<?php if($d['bbs']['c_skin']=='_pc/'.$skin):?> selected="selected"<?php endif?>>ㆍ<?php echo getFolderName($tdir.$skin)?>(<?php echo $skin?>)</option>
					<?php endwhile?>
					<?php closedir($dirs)?>
					</select>
					<input type="checkbox" name="c_hidden" value="1"<?php if($d['bbs']['c_hidden']):?> checked="checked"<?php endif?> />사용안함
					<input type="checkbox" name="c_open" value="1"<?php if($d['bbs']['c_open']):?> checked="checked"<?php endif?> />자동펼침
				</td>
			</tr>
			<tr>
				<td class="td1 sfont1">(모바일접속)</td>
				<td class="td2">
					<select name="c_mskin" class="select1">
					<option value="">&nbsp;+ 모바일 대표테마</option>
					<option value="">--------------------------------</option>
					<?php $tdir = $g['path_module'].'comment/theme/_mobile/'?>
					<?php $dirs = opendir($tdir)?>
					<?php while(false !== ($skin = readdir($dirs))):?>
					<?php if($skin=='.' || $skin == '..' || is_file($tdir.$skin))continue?>
					<option value="_mobile/<?php echo $skin?>" title="<?php echo $skin?>"<?php if($d['bbs']['c_mskin']=='_mobile/'.$skin):?> selected="selected"<?php endif?>>ㆍ<?php echo getFolderName($tdir.$skin)?>(<?php echo $skin?>)</option>
					<?php endwhile?>
					<?php closedir($dirs)?>
					</select>
				</td>
			</tr>

			<tr>
				<td class="td1">
					연 결 메 뉴
					<img src="<?php echo $g['img_core']?>/_public/ico_q.gif" alt="도움말" title="도움말" class="hand" onclick="layerShowHide('guide_sosokmenu','block','none');" />				
				</td>
				<td class="td2">
					<select name="sosokmenu" class="select1">
					<option value="">&nbsp;+ 사용안함</option>
					<option value="">--------------------------------</option>
					<?php include_once $g['path_core'].'function/menu1.func.php'?>
					<?php $cat=$d['bbs']['sosokmenu']?>
					<?php getMenuShowSelect($s,$table['s_menu'],0,0,0,0,0,'')?>
					</select>
					<div id="guide_sosokmenu" class="guide hide">
					이 게시판을 메뉴에 연결하였을 경우 해당메뉴를 지정해 주세요.<br />
					연결메뉴를 지정하면 게시물수,로케이션이 동기화됩니다.<br />
					</div>
				</td>
			</tr>
			<tr>
				<td class="td1">
					소 셜 연 동
					<img src="<?php echo $g['img_core']?>/_public/ico_q.gif" alt="도움말" title="도움말" class="hand" onclick="layerShowHide('guide_snsconnect','block','none');" />	
				</td>
				<td class="td2">
					<select name="snsconnect" class="select1">
					<option value="0">&nbsp;+ 연동안함</option>
					<option value="0">--------------------------------</option>
					<?php $tdir = $g['path_module'].'social/inc/'?>
					<?php if(is_dir($tdir)):?>
					<?php $dirs = opendir($tdir)?>
					<?php while(false !== ($skin = readdir($dirs))):?>
					<?php if($skin=='.' || $skin == '..')continue?>
					<option value="social/inc/<?php echo $skin?>"<?php if($d['bbs']['snsconnect']=='social/inc/'.$skin):?> selected="selected"<?php endif?>>ㆍ<?php echo str_replace('.php','',$skin)?></option>
					<?php endwhile?>
					<?php closedir($dirs)?>
					<?php endif?>
					</select>
					<div id="guide_snsconnect" class="guide hide">
					게시물 등록시 SNS에 동시등록을 가능하게 합니다.<br />
					이 서비스를 위해서는 소셜연동 모듈을 설치해야 합니다.<br />
					</div>
				</td>
			</tr>
			<tr>
				<td class="td1">
					추 가 설 정
					<img src="<?php echo $g['img_core']?>/_public/ico_q.gif" alt="도움말" title="도움말" class="hand" onclick="layerShowHide('guide_addconfig','block','none');" />
				</td>
				<td class="td2 shift">
					<input type="checkbox" checked="checked" disabled="disabled" />권한설정
					<img src="<?php echo $g['img_core']?>/_public/ico_under.gif" alt="접기/펼치기" title="접기/펼치기" id="dm_img_addinfo" class="dm" onclick="codShowHide('menu_addinfo','block','none',this);" />
					<input type="checkbox" checked="checked" disabled="disabled" />고급설정
					<img src="<?php echo $g['img_core']?>/_public/ico_under.gif" alt="접기/펼치기" title="접기/펼치기" id="dm_img_config" class="dm" onclick="codShowHide('menu_config','block','none',this);" /><br />
					<input type="checkbox" <?php if($R['imghead']||is_file($g['path_module'].$module.'/var/code/'.$R['id'].'.header.php')):?> checked="checked"<?php endif?> disabled="disabled" />헤더삽입
					<img src="<?php echo $g['img_core']?>/_public/ico_under.gif" alt="접기/펼치기" title="접기/펼치기" id="dm_img_header" class="dm" onclick="codShowHide('menu_header','block','none',this);" />
					<input type="checkbox" <?php if($R['imgfoot']||is_file($g['path_module'].$module.'/var/code/'.$R['id'].'.footer.php')):?> checked="checked"<?php endif?> disabled="disabled" />풋터삽입
					<img src="<?php echo $g['img_core']?>/_public/ico_under.gif" alt="접기/펼치기" title="접기/펼치기" id="dm_img_footer" class="dm" onclick="codShowHide('menu_footer','block','none',this);" />

					<div id="guide_addconfig" class="guide hide">
					게시판에 더 많은 세부설정이 필요할 경우 사용합니다.<br />
					추가설정 뷰는 각각의 모드별로 마지막 접기/펼치기 값을 기억합니다.<br />
					더 세부적인 설정은 기초환경 및 테마별 설정을 이용하세요.
					</div>
				</td>
			</tr>
		</table>

		<div id="menu_addinfo" class="hide">
		<table>
			<tr>
				<td class="td1"></td>
				<td class="td2">
					<div class="guide">
					각각의 모드에 대한 회원등급/그룹별 접근권한을 설정합니다.<br />
					복수의 그룹을 선택하려면 드래그하거나 Ctrl키를 누른다음 클릭해 주세요.
					</div>
				</td>
			</tr>
			<tr>
				<td class="td1"></td>
				<td class="td2 b">
					목록접근
				</td>
			</tr>
			<tr>
				<td class="td1">허용등급</td>
				<td class="td2">
					<select name="perm_l_list" class="select1">
					<option value="0">&nbsp;+ 전체허용</option>
					<option value="0">--------------------------------</option>
					<?php $_LEVEL=getDbArray($table['s_mbrlevel'],'','*','uid','asc',0,1)?>
					<?php while($_L=db_fetch_array($_LEVEL)):?>
					<option value="<?php echo $_L['uid']?>"<?php if($_L['uid']==$d['bbs']['perm_l_list']):?> selected="selected"<?php endif?>>ㆍ<?php echo $_L['name']?>(<?php echo number_format($_L['num'])?>) 이상</option>
					<?php if($_L['gid'])break; endwhile?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="td1">
					차단그룹
				</td>
				<td class="td2">
					<select name="_perm_g_list" class="select1" multiple="multiple" size="5">
					<option value=""<?php if(!$d['bbs']['perm_g_list']):?> selected="selected"<?php endif?>>ㆍ차단안함</option>
					<?php $_SOSOK=getDbArray($table['s_mbrgroup'],'','*','gid','asc',0,1)?>
					<?php while($_S=db_fetch_array($_SOSOK)):?>
					<option value="<?php echo $_S['uid']?>"<?php if(strstr($d['bbs']['perm_g_list'],'['.$_S['uid'].']')):?> selected="selected"<?php endif?>>ㆍ<?php echo $_S['name']?>(<?php echo number_format($_S['num'])?>)</option>
					<?php endwhile?>
					</select>
				</td>
			</tr>

			<tr>
				<td class="td1"></td>
				<td class="td2 b">
					본문열람
				</td>
			</tr>
			<tr>
				<td class="td1">허용등급</td>
				<td class="td2">
					<select name="perm_l_view" class="select1">
					<option value="0">&nbsp;+ 전체허용</option>
					<option value="0">--------------------------------</option>
					<?php $_LEVEL=getDbArray($table['s_mbrlevel'],'','*','uid','asc',0,1)?>
					<?php while($_L=db_fetch_array($_LEVEL)):?>
					<option value="<?php echo $_L['uid']?>"<?php if($_L['uid']==$d['bbs']['perm_l_view']):?> selected="selected"<?php endif?>>ㆍ<?php echo $_L['name']?>(<?php echo number_format($_L['num'])?>) 이상</option>
					<?php if($_L['gid'])break; endwhile?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="td1">
					차단그룹
				</td>
				<td class="td2">
					<select name="_perm_g_view" class="select1" multiple="multiple" size="5">
					<option value=""<?php if(!$d['bbs']['perm_g_view']):?> selected="selected"<?php endif?>>ㆍ차단안함</option>
					<?php $_SOSOK=getDbArray($table['s_mbrgroup'],'','*','gid','asc',0,1)?>
					<?php while($_S=db_fetch_array($_SOSOK)):?>
					<option value="<?php echo $_S['uid']?>"<?php if(strstr($d['bbs']['perm_g_view'],'['.$_S['uid'].']')):?> selected="selected"<?php endif?>>ㆍ<?php echo $_S['name']?>(<?php echo number_format($_S['num'])?>)</option>
					<?php endwhile?>
					</select>
				</td>
			</tr>

			<tr>
				<td class="td1"></td>
				<td class="td2 b">
					글쓰기
				</td>
			</tr>
			<tr>
				<td class="td1">허용등급</td>
				<td class="td2">
					<select name="perm_l_write" class="select1">
					<option value="0">&nbsp;+ 전체허용</option>
					<option value="0">--------------------------------</option>
					<?php $d['bbs']['perm_l_write'] = $d['bbs']['perm_l_write'] == '' ? 1 : $d['bbs']['perm_l_write']?>
					<?php $_LEVEL=getDbArray($table['s_mbrlevel'],'','*','uid','asc',0,1)?>
					<?php while($_L=db_fetch_array($_LEVEL)):?>
					<option value="<?php echo $_L['uid']?>"<?php if($_L['uid']==$d['bbs']['perm_l_write']):?> selected="selected"<?php endif?>>ㆍ<?php echo $_L['name']?>(<?php echo number_format($_L['num'])?>) 이상</option>
					<?php if($_L['gid'])break; endwhile?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="td1">
					차단그룹
				</td>
				<td class="td2">
					<select name="_perm_g_write" class="select1" multiple="multiple" size="5">
					<option value=""<?php if(!$d['bbs']['perm_g_write']):?> selected="selected"<?php endif?>>ㆍ차단안함</option>
					<?php $_SOSOK=getDbArray($table['s_mbrgroup'],'','*','gid','asc',0,1)?>
					<?php while($_S=db_fetch_array($_SOSOK)):?>
					<option value="<?php echo $_S['uid']?>"<?php if(strstr($d['bbs']['perm_g_write'],'['.$_S['uid'].']')):?> selected="selected"<?php endif?>>ㆍ<?php echo $_S['name']?>(<?php echo number_format($_S['num'])?>)</option>
					<?php endwhile?>
					</select>
				</td>
			</tr>

			<tr>
				<td class="td1"></td>
				<td class="td2 b">
					다운로드
				</td>
			</tr>
			<tr>
				<td class="td1">허용등급</td>
				<td class="td2">
					<select name="perm_l_down" class="select1">
					<option value="0">&nbsp;+ 전체허용</option>
					<option value="0">--------------------------------</option>
					<?php $d['bbs']['perm_l_down'] = $d['bbs']['perm_l_down'] == '' ? 1 : $d['bbs']['perm_l_down']?>
					<?php $_LEVEL=getDbArray($table['s_mbrlevel'],'','*','uid','asc',0,1)?>
					<?php while($_L=db_fetch_array($_LEVEL)):?>
					<option value="<?php echo $_L['uid']?>"<?php if($_L['uid']==$d['bbs']['perm_l_down']):?> selected="selected"<?php endif?>>ㆍ<?php echo $_L['name']?>(<?php echo number_format($_L['num'])?>) 이상</option>
					<?php if($_L['gid'])break; endwhile?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="td1">
					차단그룹
				</td>
				<td class="td2">
					<select name="_perm_g_down" class="select1" multiple="multiple" size="5">
					<option value=""<?php if(!$d['bbs']['perm_g_down']):?> selected="selected"<?php endif?>>ㆍ차단안함</option>
					<?php $_SOSOK=getDbArray($table['s_mbrgroup'],'','*','gid','asc',0,1)?>
					<?php while($_S=db_fetch_array($_SOSOK)):?>
					<option value="<?php echo $_S['uid']?>"<?php if(strstr($d['bbs']['perm_g_down'],'['.$_S['uid'].']')):?> selected="selected"<?php endif?>>ㆍ<?php echo $_S['name']?>(<?php echo number_format($_S['num'])?>)</option>
					<?php endwhile?>
					</select>
				</td>
			</tr>
		</table>
		</div>
		
		<div id="menu_config" class="hide">
		<table>
			<tr>
				<td class="td1">
					최근글제외
					<img src="<?php echo $g['img_core']?>/_public/ico_q.gif" alt="도움말" title="도움말" class="hand" onclick="layerShowHide('guide_display','block','none');" />
				</td>
				<td class="td2 shift">
					<div class="shift">
					<input type="checkbox" name="display" value="1"<?php if($d['bbs']['display']):?> checked="checked"<?php endif?> />최근글 추출에서 제외합니다.
					</div>
					<div id="guide_display" class="guide hide">
					최근글 추출제외는 게시물등록시에 이 설정값을 따르므로<br />
					설정값을 중간에 변경하면 이전 게시물에 대해서는 적용되지 않습니다.<br />
					최근글 제외설정은 게시판 서비스전에 확정하여 주세요.<br />
					최근글에서 제외하면 통합검색에서도 제외됩니다.
					</div>
				</td>
			</tr>
			<tr>
				<td class="td1">
					쿼 리 생 략
					<img src="<?php echo $g['img_core']?>/_public/ico_q.gif" alt="도움말" title="도움말" class="hand" onclick="layerShowHide('guide_list','block','none');" />
				</td>
				<td class="td2 shift">
					<div class="shift">
					<input type="checkbox" name="hidelist" value="1"<?php if($d['bbs']['hidelist']):?> checked="checked"<?php endif?> />게시물가공 기본쿼리를 생략합니다.
					</div>
					<div id="guide_list" class="guide hide">
					종종 기본쿼리가 아닌 테마자체에서 데이터를 가공해야 하는 경우가 있습니다.<br />
					1:1상담게시판,일정관리 등 특수한 테마의 경우 쿼리생략이 요구되기도 합니다.<br />
					쿼리생략이 요구되는 테마를 사용할 경우 체크해 주세요.<br />
					</div>
				</td>
			</tr>
			<tr>
				<td class="td1">RSS발행</td>
				<td class="td2 shift">
					<div class="shift">
					<input type="checkbox" name="rss" value="1"<?php if($d['bbs']['rss']):?> checked="checked"<?php endif?> />RSS발행을 허용합니다.
					</div>
				</td>
			</tr>
			<tr>
				<td class="td1">조회수증가</td>
				<td class="td2 shift">
					<div class="shift">
					<input type="radio" name="hitcount" value="1"<?php if($d['bbs']['hitcount']):?> checked="checked"<?php endif?> />무조건증가
					<input type="radio" name="hitcount" value="0"<?php if(!$d['bbs']['hitcount']):?> checked="checked"<?php endif?> />1회만증가
					</div>
				</td>
			</tr>
			<tr>
				<td class="td1">게시물출력</td>
				<td class="td2">
					<input type="text" name="recnum" value="<?php echo $d['bbs']['recnum']?$d['bbs']['recnum']:20?>" size="5" class="input" />개(한페이지에 출력할 게시물의 수)
				</td>
			</tr>
			<tr>
				<td class="td1">제목끊기</td>
				<td class="td2">
					<input type="text" name="sbjcut" value="<?php echo $d['bbs']['sbjcut']?$d['bbs']['sbjcut']:40?>" size="5" class="input" />자(제목이 길 경우 자르기)
				</td>
			</tr>
			<tr>
				<td class="td1">새글유지시간</td>
				<td class="td2">
					<input type="text" name="newtime" value="<?php echo $d['bbs']['newtime']?$d['bbs']['newtime']:24?>" size="5" class="input" />시간(새글로 인식되는 시간)
				</td>
			</tr>

			<tr>
				<td class="td1">등록포인트</td>
				<td class="td2">
					<input type="text" name="point1" value="<?php echo $d['bbs']['point1']?$d['bbs']['point1']:0?>" size="5" class="input" />포인트지급(게시물 삭제시 환원됩니다)
				</td>
			</tr>
			<tr>
				<td class="td1">열람포인트</td>
				<td class="td2">
					<input type="text" name="point2" value="<?php echo $d['bbs']['point2']?$d['bbs']['point2']:0?>" size="5" class="input" />포인트차감
				</td>
			</tr>
			<tr>
				<td class="td1">다운포인트</td>
				<td class="td2">
					<input type="text" name="point3" value="<?php echo $d['bbs']['point3']?$d['bbs']['point3']:0?>" size="5" class="input" />포인트차감
				</td>
			</tr>
			<tr>
				<td class="td1">
					추가관리자
					<img src="<?php echo $g['img_core']?>/_public/ico_q.gif" alt="도움말" title="도움말" class="hand" onclick="layerShowHide('guide_bbsadmin','block','none');" />
				</td>
				<td class="td2">
					<input type="text" name="admin" value="<?php echo $d['bbs']['admin']?>" class="input sname" />
					<div id="guide_bbsadmin" class="guide hide">
					이 게시판에 대해서 관리자권한을 별도로 부여할 회원이 있을경우<br />
					회원아이디를 콤마(,)로 구분해서 등록해 주세요.<br />
					관리자로 지정될 경우 열람/수정/삭제등의 모든권한을 얻게 됩니다.
					</div>
				</td>
			</tr>
			<tr>
				<td class="td1">
					부 가 필 드
					<img src="<?php echo $g['img_core']?>/_public/ico_q.gif" alt="도움말" title="도움말" class="hand" onclick="layerShowHide('guide_addinfo','block','none');" />
				</td>
				<td class="td2">
					<textarea name="addinfo" class="add"><?php echo htmlspecialchars($R['addinfo'])?></textarea>
					<div id="guide_addinfo" class="guide hide">
					이 게시판에 대해서 추가적인 정보가 필요할 경우 사용합니다.<br />
					필드명은 <span class="b">[adddata]</span> 입니다. 
					</div>
				</td>
			</tr>
			<tr>
				<td class="td1">
					기본양식
					<img src="<?php echo $g['img_core']?>/_public/btn_code.gif" class="dn hand" alt="편집기" title="" onclick="editWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&system=edit.editor&iframe=Y&droparea=writeeleArea');" />
				</td>
				<td class="td2">
					<textarea name="writecode" id="writeeleArea"><?php echo htmlspecialchars($R['writecode'])?></textarea>
				</td>
			</tr>
		</table>
		</div>


		<div id="menu_header" class="hide">
		<table>
			<tr>
				<td class="td1">헤더파일</td>
				<td class="td2">
					<input type="file" name="imghead" class="upfile" />
					<?php if($R['imghead']):?>
					<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&m=admin&module=filemanager&front=main&editmode=Y&pwd=./modules/<?php echo $module?>/var/files/&file=<?php echo $R['imghead']?>" target="_blank" title="<?php echo $R['imghead']?>" class="u">파일수정</a> <a href="<?php echo $g['r']?>/?m=<?php echo $module?>&amp;a=bbs_file_delete&amp;bid=<?php echo $R['id']?>&amp;dtype=head" target="_action_frame_<?php echo $m?>" class="u" onclick="return confirm('정말로 삭제하시겠습니까?     ');">삭제</a>
					<?php else:?>
					<span>(gif/jpg/png/swf 가능)</span>
					<?php endif?>
				</td>
			</tr>
			<tr>
				<td class="td1">
					헤더코드
					<img src="<?php echo $g['img_core']?>/_public/btn_code.gif" class="dn hand" alt="편집기" title="" onclick="editWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&system=edit.editor&iframe=Y&droparea=codheadArea');" />
				</td>
				<td class="td2">
					<textarea name="codhead" id="codheadArea"><?php if(is_file($g['path_module'].$module.'/var/code/'.$R['id'].'.header.php')) echo htmlspecialchars(implode('',file($g['path_module'].$module.'/var/code/'.$R['id'].'.header.php')))?></textarea>
				</td>
			</tr>
			<tr>
				<td class="td1">
					노출위치
				</td>
				<td class="td2 shift">
					<input type="checkbox" name="inc_head_list" value="[l]"<?php if(strstr($R['puthead'],'[l]')):?> checked="checked"<?php endif?> />목록
					<input type="checkbox" name="inc_head_view" value="[v]"<?php if(strstr($R['puthead'],'[v]')):?> checked="checked"<?php endif?> />본문
					<input type="checkbox" name="inc_head_write" value="[w]"<?php if(strstr($R['puthead'],'[w]')):?> checked="checked"<?php endif?> />쓰기
				</td>
			</tr>
		</table>
		</div>

		<div id="menu_footer" class="hide">
		<table>
			<tr>
				<td class="td1">풋터파일</td>
				<td class="td2">
					<input type="file" name="imgfoot" class="upfile" />
					<?php if($R['imgfoot']):?>
					<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&m=admin&module=filemanager&front=main&editmode=Y&pwd=./modules/<?php echo $module?>/var/files/&file=<?php echo $R['imgfoot']?>" target="_blank" title="<?php echo $R['imgfoot']?>" class="u">파일수정</a> <a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=bbs_file_delete&amp;bid=<?php echo $R['id']?>&amp;dtype=foot" target="_action_frame_<?php echo $m?>" class="u" onclick="return confirm('정말로 삭제하시겠습니까?     ');">삭제</a>
					<?php else:?>
					<span>(gif/jpg/png/swf 가능)</span>
					<?php endif?>
				</td>
			</tr>
			<tr>
				<td class="td1">
					풋터코드
					<img src="<?php echo $g['img_core']?>/_public/btn_code.gif" class="dn hand" alt="편집기" title="" onclick="editWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&system=edit.editor&iframe=Y&droparea=codfootArea');" />
				</td>
				<td class="td2">
					<textarea name="codfoot" id="codfootArea"><?php if(is_file($g['path_module'].$module.'/var/code/'.$R['id'].'.footer.php')) echo htmlspecialchars(implode('',file($g['path_module'].$module.'/var/code/'.$R['id'].'.footer.php')))?></textarea>
				</td>
			</tr>
			<tr>
				<td class="td1">
					노출위치
				</td>
				<td class="td2 shift">
					<input type="checkbox" name="inc_foot_list" value="[l]"<?php if(strstr($R['putfoot'],'[l]')):?> checked="checked"<?php endif?> />목록
					<input type="checkbox" name="inc_foot_view" value="[v]"<?php if(strstr($R['putfoot'],'[v]')):?> checked="checked"<?php endif?> />본문
					<input type="checkbox" name="inc_foot_write" value="[w]"<?php if(strstr($R['putfoot'],'[w]')):?> checked="checked"<?php endif?> />쓰기
				</td>
			</tr>
		</table>
		</div>



		<div class="submitbox">
			<input type="submit" class="btnblue" value="<?php echo $R['uid']?'게시판속성 변경':'새게시판 만들기'?>" />
			<div class="clear"></div>
		</div>

		</form>
		
	</div>
	<div class="clear"></div>
</div>

<iframe name="_orderframe_" class="hide"></iframe>

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
function editWindow(url) 
{
	window.open(url,'','left=0,top=0,width=800px,height=750px,statusbar=no,scrollbars=no,toolbar=no,resizable=yes');
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
    var l1 = f._perm_g_list;
    var n1 = l1.length;
    var l2 = f._perm_g_view;
    var n2 = l2.length;
    var l3 = f._perm_g_write;
    var n3 = l3.length;
    var l4 = f._perm_g_down;
    var n4 = l4.length;
    var i;
	var s1 = '';
	var s2 = '';
	var s3 = '';
	var s4 = '';

	for	(i = 0; i < n1; i++)
	{
		if (l1[i].selected == true && l1[i].value != '')
		{
			s1 += '['+l1[i].value+']';
		}
	}
	for	(i = 0; i < n2; i++)
	{
		if (l2[i].selected == true && l2[i].value != '')
		{
			s2 += '['+l2[i].value+']';
		}
	}
	for	(i = 0; i < n3; i++)
	{
		if (l3[i].selected == true && l3[i].value != '')
		{
			s3 += '['+l3[i].value+']';
		}
	}
	for	(i = 0; i < n4; i++)
	{
		if (l4[i].selected == true && l4[i].value != '')
		{
			s4 += '['+l4[i].value+']';
		}
	}
	f.perm_g_list.value = s1;
	f.perm_g_view.value = s2;
	f.perm_g_write.value = s3;
	f.perm_g_down.value = s4;

	if (f.name.value == '')
	{
		alert('게시판이름을 입력해 주세요.     ');
		f.name.focus();
		return false;
	}
	if (f.bid.value == '')
	{
		if (f.id.value == '')
		{
			alert('게시판아이디를 입력해 주세요.      ');
			f.id.focus();
			return false;
		}
		if (!chkFnameValue(f.id.value))
		{
			alert('게시판아이디는 영문 대소문자/숫자/_ 만 사용가능합니다.      ');
			f.id.value = '';
			f.id.focus();
			return false;
		}
	}
	return confirm('정말로 실행하시겠습니까?         ');
}
function slideshowOpen()
{
	var cc = getCookie('ck_menu_config');
	var ch = getCookie('ck_menu_header');
	var cf = getCookie('ck_menu_footer');
	var ca = getCookie('ck_menu_addinfo');
	
	if (cc == 'block')
	{
		getId('menu_config').style.display = cc;
		getId('dm_img_config').src = getId('dm_img_config').src.replace('ico_under','ico_over');
	}
	if (ch == 'block')
	{
		getId('menu_header').style.display = ch;
		getId('dm_img_header').src = getId('dm_img_header').src.replace('ico_under','ico_over');
	}
	if (cf == 'block')
	{
		getId('menu_footer').style.display = cf;
		getId('dm_img_footer').src = getId('dm_img_footer').src.replace('ico_under','ico_over');
	}
	if (ca == 'block')
	{
		getId('menu_addinfo').style.display = ca;
		getId('dm_img_addinfo').src = getId('dm_img_addinfo').src.replace('ico_under','ico_over');
	}
}

window.onload = function()
{
	<?php if($NUM):?>
	dragsort.makeListSortable(getId("bbsorder"));
	<?php endif?>

	parent.getId('_modal_on_').style.height = '90%';
	var xy = getOfs(parent.getId('_modal_on_'));
	parent.getId('_modal_on_').children[1].children[0].style.height = (xy.height-39) + 'px';
	document.procForm.name.focus();

	slideshowOpen();
}
//]]>
</script>

