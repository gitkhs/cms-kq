<?php
$_isDragScript = true;
if ($_COOKIE['admin_menu_display'] == 'none' || ($g['mobile']&&$_SESSION['pcmode']=='Y'))
{
	$g['adm_menu_display'] = 'none';
	$g['adm_menu_margin']  = '30px';
	$g['adm_menu_margin1'] = '-290px';
	$g['adm_menu_string']  = '<img src="'.$g['img_module_skin'].'/m_open.gif" class="mopen" title="메뉴열기" alt="" />';
}
else {
	$g['adm_menu_display'] = 'block';
	$g['adm_menu_margin']  = '325px';
	$g['adm_menu_margin1']  = '0px';
	$g['adm_menu_string']  = '<img src="'.$g['img_module_skin'].'/m_close.gif" class="mclose" title="메뉴접기" alt="" />';
}
?>

<style type="text/css">
#tttrspace {display:<?php echo $g['adm_menu_display']?>;}
#menuspace {display:<?php echo $g['adm_menu_display']?>;}
#content {margin-left:<?php echo $g['adm_menu_margin']?>;}
#footer {padding:15px 0 0 <?php echo $g['adm_menu_margin']?>;}
#tabbox {position:relative;left:<?php echo $g['adm_menu_margin1']?>;}
</style>

<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/core.js"></script>
<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/events.js"></script>
<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/css.js"></script>
<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/coordinates.js"></script>
<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/drag.js"></script>
<script type="text/javascript" src="<?php echo $g['s']?>/_core/opensrc/tool-man/dragsort.js"></script>

<script type="text/javascript">
//<![CDATA[
var dragsort = ToolMan.dragsort();
function slideshowOpen()
{
	dragsort.makeListSortable(getId("moduleorder1"));
	dragsort.makeListSortable(getId("moduleorder2"));

	<?php if($g['adm_menu_display']=='block'&&$module!='admin'&&$d['admin']['autoclose']):?>
	var w = parseInt(screen.width);
	if (w < 1025)
	{
		menuFlag(getId('openhideTool'));
	}
	<?php endif?>
}
window.onload = slideshowOpen;
//]]>
</script>


<div id="wrap">
	<div id="header">
		<div class="line"></div>
	</div>
	<div id="container">
		<div class="snb">
			<div class="title">
				<div class="tl">
					<a id="openhideTool" class="hand" onclick="menuFlag(this);"><?php echo $g['adm_menu_string']?></a>
				</div>
				<div id="tttrspace" class="tr">

				</div>
			</div>
			
			<div id="menuspace">

				<form name="mform" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>">
				<input type="hidden" name="r" value="<?php echo $r?>" />
				<input type="hidden" name="m" value="module" />
				<input type="hidden" name="a" value="moduleorder_update" />
				<input type="hidden" name="fnum" value="1" />

				<div class="mainmodule">
					<ul id="moduleorder1">
					<?php $i = 0?>
					<?php $MODULES = getDbArray($table['s_module'],'hidden=0','*','gid','asc',0,1)?>
					<?php while($R=db_fetch_array($MODULES)):?>
					<?php if(strpos('_'.$my['adm_view'],'['.$R['id'].']')) continue?>
					<li>
					<div class="module<?php if($R['id']==$module):?> selected<?php endif?>" title="<?php echo $R['id']?>">
						<div class="name move<?php if($R['id']==$module):?> nselected<?php endif?>" ondblclick="window.open('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $R['id']?>');"><span><?php echo $R['name']?></span></div>
						<input type="checkbox" name="modulemembers1[]" value="<?php echo $R['id']?>" checked="checked" />
						<div class="icon" onselectstart="return false;"><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $R['id']?>"><img src="<?php echo getThumbImg($g['path_module'].$R['id'].'/icon')?>" alt="<?php echo $R['name']?>(<?php echo $R['id']?>)" /></a></div>
					</div>
					</li>
					<?php $i++?>
					<?php if($i == 4) break?>
					<?php endwhile?>
					</ul>
				</div>
				<?php if($my['uid']==1):?>
				<div class="clear"></div>
				<div class="mtitle">
					<div class="xl">
						<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $m?>&amp;front=config">환경/테마</a> | 
						<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $m?>&amp;front=switch">스위치</a> | 
						<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $m?>&amp;front=update">업데이트</a> | 
						<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $m?>&amp;front=admin">관리자</a>
					</div>
					<div class="xr">
						<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=market&amp;front=pack&amp;type=module" title="모듈추가"><img src="<?php echo $g['img_core']?>/_public/btn_add.gif" alt="추가" /></a>
						<img src="<?php echo $g['img_core']?>/_public/btn_save.gif" title="순서저장" alt="save" class="hand" onclick="document.mform.submit();" />
					</div>
				</div>
				<?php endif?>
				<div class="allmodule scrollbar">
					<ul id="moduleorder2">
					<?php while($R=db_fetch_array($MODULES)):?>
					<?php if(strpos('_'.$my['adm_view'],'['.$R['id'].']')) continue?>
					<li>
					<div class="module<?php if($R['id']==$module):?> selected<?php endif?>" title="<?php echo $R['id']?>">
						<div class="name move<?php if($R['id']==$module):?> nselected<?php endif?>" ondblclick="window.open('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $R['id']?>');"><span><?php echo $R['name']?></span></div>
						<input type="checkbox" name="modulemembers1[]" value="<?php echo $R['id']?>" checked="checked" />
						<div class="icon" onselectstart="return false;"><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $R['id']?>"><img src="<?php echo getThumbImg($g['path_module'].$R['id'].'/icon')?>" alt="<?php echo $R['name']?>(<?php echo $R['id']?>)" /></a></div>
					</div>
					</li>
					<?php endwhile?>
					</ul>
				</div>

				</form>

				<div class="mbottom"></div>
			</div>

		</div>
		<div id="content">

			<div id="tabbox" class="tab01" onselectstart="return false;">
				<ul>
				<?php if(count($d['amenu'])):?>
				<?php foreach($d['amenu'] as $_k => $_v):?>
				<li<?php if($front == $_k):?> class="on"<?php endif?> onclick="goHref('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>&module=<?php echo $module?>&front=<?php echo $_k?>');"><span><?php echo $_v?></span></li>
				<?php endforeach?>
				<li class="wall">&nbsp;</li>
				<?php endif?>
				</ul>
				<div class="more">
				</div>
			</div>
			
			<div class="location">
				<div class="loc1">
					현재위치 : <?php echo $MD['name']?><?php if($d['amenu'][$front]):?> &gt; <?php echo $d['amenu'][$front]?><?php endif?>
				</div>
				<div class="loc2">
					<?php if($d['admin']['hidepannel']):?>
					<select class="select2" onchange="goAdmPage(this);">
					<option value="">&nbsp;+ 즐겨찾는 페이지</option>
					<?php $_ADMPAGE = getDbArray($table['s_admpage'],'memberuid='.$my['uid'],'*','gid','asc',0,1)?>
					<?php if(db_num_rows($_ADMPAGE)):?>
					<option value="">---------------------------------</option>
					<?php endif?>
					<?php while($_R=db_fetch_array($_ADMPAGE)):?>
					<option value="<?php echo $_R['url']?>">ㆍ<?php echo $_R['name']?></option>
					<?php endwhile?>
					<option value="">---------------------------------</option>
					<option value="<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>&module=<?php echo $m?>&front=bookmark">ㆍ페이지 관리</option>
					</select>
					<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;a=bookmark&amp;_addmodule=<?php echo $module?>&amp;_addfront=<?php echo $front?>" target="_action_frame_<?php echo $m?>"><img src="<?php echo $g['img_core']?>/_public/btn_add.gif" alt="추가" title="추가" /></a>
					<?php else:?>
					<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;a=bookmark&amp;_addmodule=<?php echo $module?>&amp;_addfront=<?php echo $front?>" target="_action_frame_<?php echo $m?>"><img src="<?php echo $g['img_core']?>/_public/b_scrap.gif" class="scr" alt="" /> 이 페이지를 즐겨찾기에 추가</a>
					<?php endif?>

				</div>
			</div>
			<div class="cwrap">
			<?php include_once $g['adm_module']?>
			</div>
		</div>
		<div class="clear"></div>	
	</div>
	<div id="footer">
		<p>
		Copyrights &copy; Redblock Allrights Reserved. Powered by kimsQ-Rb<br />
		Server Excute Time : <?php echo round(getNowTimes()-$g['time_start'],3)?> / 
		Server Software : <?php echo $_SERVER['SERVER_SOFTWARE']?> + PHP <?php echo phpversion()?> + MYSQL <?php echo db_info()?><br />
		<a href="http://validator.w3.org/check?url=referer" target="_blank" title="W3C XHTML 1.0 VALIDATION">W3C XHTML 1.0 VALIDATION</a>
		</p>
	</div>
</div>
