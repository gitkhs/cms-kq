<div id="mheader">
	<div class="logo"><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>"><img src="<?php echo $g['img_core']?>/_public/rb_logo_white.png" alt="kimsq" /></a></div>
	<div class="tool">
		<img src="<?php echo $g['img_module_skin']?>/btn_admin_off.png" alt="" onclick="mLayerShow('_admin_layer_','_system_layer_',this);" />
		<img src="<?php echo $g['img_module_skin']?>/btn_tool_off.png" alt="" onclick="mLayerShow('_system_layer_','_admin_layer_',this);" />

		<div id="_admin_layer_">
			<div class="_layerbox _admin_">
			<div class="arr">▲</div>
			<div class="tt _admin_" onclick="mLayerHide();"><i>관리자 정보</i><span>×</span></div>
			<div class="mbrinfo">
				<div class="symbol"><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;mod=mypage&amp;page=simbol"><img src="<?php echo $g['s']?>/_var/simbol/<?php echo $my['photo']?$my['photo']:'0.gif'?>" alt="" /></a></div>
				<div class="name">
					<div class="namel"><?php echo $my[$_HS['nametype']]?>님</div>
					<div class="namer">
						(<?php echo $my['email']?>) <br /><br />
						마지막 접속시간 : <br />
						<?php echo getDateFormat($my['last_log'],'Y/m/d H:i')?>
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="btnbox">
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;a=logout">로그아웃</a>
			<a href="<?php echo RW('mod=mypage')?>">계정관리</a>
			</div>
			</div>
		</div>

		<div id="_system_layer_">
			<div class="_layerbox">
			<div class="arr">▲</div>
			<div class="tt" onclick="mLayerHide();"><i>시스템 설정</i><span>×</span></div>
			<ul>
			<li><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $m?>&amp;front=config"><i>환경/테마</i></a></li>
			<li><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $m?>&amp;front=switch"><i>스위치</i></a></li>
			<li><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $m?>&amp;front=update"><i>업데이트</i></a></li>
			<li><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $m?>&amp;front=admin"><i>관리자</i></a></li>
			<li><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=module"><i>모듈관리</i></a></li>
			<li><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=domain"><i>도메인연결</i></a></li>
			</ul>
			<div class="updown"><img src="<?php echo $g['img_core']?>/_public/arr_top.gif" alt="" class="filter" /><br /><img src="<?php echo $g['img_core']?>/_public/arr_bottom.gif" alt="" class="filter" /></div>
			<div class="btnbox">
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=home&amp;front=menu">메뉴</a>
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=bbs">게시판</a>
			</div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>

<div id="mwrap">
	<?php if($module=='admin'&&$front=='main'):?>

	<div id="flicking_wrapper" class="allmodule">
		<div id="flicking_wrapScroll">
			<ul>
			<li>
				<div>
			<?php $recnum = 4 * 3?>
			<?php $MODULES = getDbArray($table['s_module'],'hidden=0 and mobile=1','*','gid','asc',0,1)?>
			<?php $i=0;while($R=db_fetch_array($MODULES)):?>
			<?php if(strpos('_'.$my['adm_view'],'['.$R['id'].']')) continue;$i++?>

					<div class="module" title="<?php echo $R['id']?>">
						<div class="name<?php if(is_file($g['path_module'].$R['id'].'/lang.'.$_HS['lang'].'/admin/_mobile/var/var.menu.php')):?> nselected<?php endif?>"><span><?php echo $R['name']?></span></div>
						<div class="icon" style=""><a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=<?php echo $R['id']?><?php if($R['id']=='admin'):?>&amp;front=config<?php endif?>"><img src="<?php echo getThumbImg($g['path_module'].$R['id'].'/icon')?>" alt=")" /></a></div>
					</div>

				<?php if(!($i%$recnum)):?>
				</div>
			</li>
			<li>
				<div>	
				<?php endif?>
				<?php endwhile?>
				<?php $NUM = $i?>
				<?php $TPG = getTotalPage($NUM,$recnum)?>
				<?php if(!$NUM):?>
				<div class="none">
				모바일 관리패널에 등록된 모듈이 없습니다.<br />
				관리패널 등록은 PC모드에서만 지원됩니다.
				</div>
				<?php endif?>
				<?php if($i < ($NUM%$recnum)):?>
				</div>
			</li>
				<?php endif?>
			</ul>
		</div>
	</div>
	<div id="indicator">
		<ul>
		<?php for($i = 0; $i < $TPG; $i++):?><li><span><?php echo $i+1?></span></li><?php endfor?>
		</ul>
	</div>

<style type="text/css">
#flicking_wrapper {width:100%;padding:5px 0 5px 0;margin:0 auto;overflow:auto;}
#flicking_wrapScroll {position:relative;z-index:2;top:0;left:0;width:<?php echo $TPG*100?>%;float:left;}
#flicking_wrapScroll ul {list-style-type:none;position:relative;display:block;margin:0;padding:0;top:0;left:0;width:100%;height:100%;}
#flicking_wrapScroll li {display:block;float:left;width:<?php echo (int)100/$TPG?>%;}
#flicking_wrapScroll li {-webkit-background-size:<?php echo (int)100/$TPG?>%;}
#indicator {margin:10px auto;width:<?php echo $TPG*20?>px;}
#indicator ul {list-style-type:none;padding:0;margin:0;}
#indicator li {width:9px;height:9px;margin-right:10px;float:left;background:url('<?php echo $g['img_module_skin']?>/slider_off.png') no-repeat;margin-bottom:10px;}
#indicator li.active {background:url('<?php echo $g['img_module_skin']?>/slider_on.png') no-repeat;}
#indicator li span {display:none;}
</style>


	<?php else:?>
	<div class="tab01">
		<ul>
		<?php if(count($d['amenu'])):?>
		<?php foreach($d['amenu'] as $_k => $_v):?>
		<li<?php if($front == $_k):?> class="on"<?php endif?> onclick="goHref('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>&module=<?php echo $module?>&front=<?php echo $_k?><?php if($account):?>&account=<?php echo $account?><?php endif?>');"><span><?php echo $_v?></span></li>
		<?php endforeach?>
		<li class="wall">&nbsp;</li>
		<?php else:?>
		<li onclick="goHref('<?php echo $g['s']?>/?r=<?php echo $r?>&a=pcmode');"><span>PC모드 전환</span></li>
		<li class="on"><span>모듈안내</span></li>
		<li onclick="goHref('<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>');"><span>바탕화면</span></li>
		<li class="wall">&nbsp;</li>
		<?php endif?>
		</ul>
		<div class="more">
		</div>
	</div>
	<div class="loc1">
		현재위치 : <?php echo $MD['name']?><?php if($d['amenu'][$front]):?> &gt; <?php echo $d['amenu'][$front]?><?php endif?>
		<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;a=bookmark&amp;_addmodule=<?php echo $module?>&amp;_addfront=<?php echo $front?>" target="_action_frame_<?php echo $m?>"><img src="<?php echo $g['img_core']?>/_public/b_scrap.gif" class="scr" alt="" /> 북마크</a>
	</div>
	<div class="cwrap">
		<?php if(is_file($g['adm_module_varmenu'])):?>
		<?php include_once $g['adm_module']?>
		<?php else:?>


		<div class="notice">
			<div class="icon"><img src="<?php echo getThumbImg($g['path_module'].$MD['id'].'/icon')?>" alt="" /></div>
			<div class="ment">
			<div><?php echo $MD['name']?><span>(<?php echo $MD['id']?>)</span></div>
			이 모듈은 모바일 관리자테마가 포함되어 있지 않아 PC모드로만 접근할 수 있습니다.<br />
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;a=module_mobile_eject&amp;module_id=<?php echo $MD['id']?>" class="del" onclick="return confirm('정말로 제외하시겠습니까?   ');">모바일 바탕화면에서 제외하기</a><br />
			</div>
		</div>

		<?php endif?>
	</div>
	<?php endif?>


	<div class="bookmark">
		<select onchange="goAdmPage(this);">
		<option value="">&nbsp;+ 자주가는 페이지를 선택하세요</option>
		<?php $_ADMPAGE = getDbArray($table['s_admpage'],'memberuid='.$my['uid'],'*','gid','asc',0,1)?>
		<?php if(db_num_rows($_ADMPAGE)):?>
		<option value="">---------------------------------</option>
		<?php endif?>
		<?php while($_R=db_fetch_array($_ADMPAGE)):?>
		<option value="<?php echo $_R['url']?>">ㆍ<?php echo $_R['name']?></option>
		<?php endwhile?>
		<option value="">---------------------------------</option>
		<option value="<?php echo $g['s']?>/?r=<?php echo $r?>&m=<?php echo $m?>&module=<?php echo $m?>&front=bookmark">ㆍ북마크 관리</option>
		</select>
	</div>
	<div class="infobox">
		<table>
			<tr>
				<td class="td1">웹서버</td>
				<td>:</td>
				<td class="td2">
				<?php echo $_SERVER['SERVER_SOFTWARE']?>
				</td>
			</tr>
			<tr>
				<td class="td1">PHP</td>
				<td>:</td>
				<td class="td2">
				<?php echo phpversion()?>
				</td>
			</tr>
			<tr>
				<td class="td1">MySQL</td>
				<td>:</td>
				<td class="td2">
				<?php echo db_info()?> (<?php echo $DB['type']?>)
				</td>
			</tr>
			<tr>
				<td class="td1">코어</td>
				<td>:</td>
				<td class="td2">
				kimsQ-Rb <?php echo $d['admin']['version']?>
				</td>
			</tr>
		</table>
	</div>

	<div class="adv">
	<iframe src="http://ad.kimsq.com/400_40/" width="100%" height="40" frameborder="0" scrolling="no"></iframe>
	</div>

	<div class="mfooter">
		Redblock &copy; <?php echo $date['year']?>
		<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;a=logout">로그아웃</a>
		<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;a=pcmode">PC모드</a>
		<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=admin">바탕화면</a>
		<a href="<?php echo $g['s']?>/?r=<?php echo $r?>">홈페이지</a>
	</div>

</div>





<?php if(!$g['lib_jquery']):?>
<script type="text/javascript" src="<?php echo $g['img_module_skin']?>/js/jquery.min.js"></script>
<?php endif?>
<script type="text/javascript" src="<?php echo $g['img_module_skin']?>/js/iscroll.js"></script>
<script type="text/javascript">
//<![CDATA[
function mLayerShow(m1,m2,obj)
{
	obj.src = obj.src.replace('_off.','_on.');
	getId(m1).style.display = 'block';
	getId(m2).style.display = 'none';
}
function mLayerHide()
{
	getId('mheader').children[1].children[0].src = getId('mheader').children[1].children[0].src.replace('_on.','_off.');
	getId('mheader').children[1].children[1].src = getId('mheader').children[1].children[1].src.replace('_on.','_off.');
	getId('_admin_layer_').style.display = 'none';
	getId('_system_layer_').style.display = 'none';
}

$(document).ready(function() {
  var iscroll = new iScroll('flicking_wrapper', {
    snap: 'li',
    momentum: false,
    hScrollbar: false,
    vScrollbar: false,
    onScrollEnd: function() {
      $('#indicator li').each(function(i, node) {
        if(i === iscroll.currPageX) {
          $(node).addClass('active');
        } else {
          $(node).removeClass('active');
        }
      });
    }
  });
  iscroll.scrollToPage(0);
});
window.onload = function() {window.scrollTo(0,1);}
//]]>
</script>

