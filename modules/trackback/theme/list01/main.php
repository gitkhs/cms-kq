<div id="clist">
	<div class="urlbox">
		<?php if($send == 'Y'&&($d['trackback']['perm_write']<=$my['level']||$my['admin'])):?>
			<form name="sendform" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return sendCheck(this);">
			<input type="hidden" name="r" value="<?php echo $r?>" />
			<input type="hidden" name="m" value="<?php echo $m?>" />
			<input type="hidden" name="a" value="send_trackback" />
			받을주소 : <input type="text" name="trackback" value="" class="input" />
			<input type="image" src="<?php echo $g['img_module_skin']?>/btn_send.gif" alt="보내기" class="vgap" />
			<a href="<?php echo $g['track_list']?>"><img src="<?php echo $g['img_module_skin']?>/btn_cancel.gif" alt="취소" class="vgap" /></a>
			</form>

			<?php $SRCD=getDbSelect($table['s_trackback'],"parent='".$cyncArr['data'][0].$cyncArr['data'][1]."' and type=2 order by uid desc",'*')?>
			<?php if(db_num_rows($SRCD)):?>
			<ul>
			<?php while($_R = db_fetch_array($SRCD)):?>
			<li>
			<a href="<?php echo $_R['url']?>" target="_blank"><?php echo $_R['url']?></a> 
			<span class="date">(<?php echo getDateFormat($_R['d_regis'],'Y.m.d H:i')?>)</span>
			<?php if($my['admin']):?>
			<a href="<?php echo $g['track_delete'].$_R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?');"><img src="<?php echo $g['img_core']?>/_public/btn_del_s01.gif" alt="삭제" title="삭제" /></a>
			<?php endif?>
			</li>
			<?php endwhile?>
			</ul>
			<?php endif?>

		<?php else:?>
		<div class="url">
			<span>트랙백주소 : <a id="trackbackUrl">http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']?>/<?php echo $r?>/<?php echo $cyncArr['data'][0]?>/<?php echo $cyncArr['data'][1]?></a></span>
			<a href="#." class="copy" onclick="copyStr(getId('trackbackUrl').innerHTML);"><img src="<?php echo $g['img_module_skin']?>/btn_urlcopy.gif" alt="복사" title="복사" /></a>
		</div>
		<div class="btn">
			<?php if($d['trackback']['perm_write']<=$my['level']||$my['admin']):?><a href="<?php echo $g['track_list']?>&amp;send=Y"><img src="<?php echo $g['img_module_skin']?>/btn_track.gif" alt="이글을 엮인글로 보내기" /></a><?php endif?>
		</div>
		<div class="clear"></div>
		<?php endif?>
	</div>



	<table summary="트랙백리스트입니다.">
	<caption>트랙백리스트</caption> 
	<colgroup> 
	<col width="15">
	<col> 
	<col width="150">
	<col width="100">
	<col width="70">
	</colgroup> 
	<thead>
	<tr>
	<th scope="col" class="side1"></th>
	<th scope="col"></th>
	<th scope="col">보낸이</th>
	<th scope="col">보낸곳</th>
	<th scope="col" class="side2">날짜</th>
	</tr>
	</thead>
	<tbody>

	<?php $cnt=count($RCD)?>
	<?php foreach($RCD as $R):?>
	<tr class="dotline<?php if($cnt==++$_ol):?> none<?php endif?>">
	<td class="del">
	<?php if($my['admin']):?>
	<a href="<?php echo $g['track_delete'].$R['uid']?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 삭제하시겠습니까?');"><img src="<?php echo $g['img_core']?>/_public/btn_del_s01.gif" alt="삭제" title="삭제" /></a>
	<?php endif?>
	</td>
	<td class="sbj">
	<a href="<?php echo $R['url']?>" target="_blank" title="<?php echo getStrCut(htmlspecialchars(strip_tags($R['content'])),100,'...')?>" onmouseover="qTilePop(this);" onmouseout="qTilePopKill(this);"><?php echo $R['subject']?></a>
	<?php if(getNew($R['d_regis'],24)):?><span class="new">new</span><?php endif?>
	</td>
	<td class="name"><a href="<?php echo $R['url']?>" target="_blank"><?php echo $R['name']?></a></td>
	<td class="url"><?php echo getDomain($R['url'])?></td>

	<td><?php echo getDateFormat($R['d_regis'],'m.d : H:i')?></td>
	</tr>
	<?php endforeach?>

	<?php if(!$NUM):?>
	<tr class="none">
	<td>-</td>
	<td class="sbj">엮인글이 없습니다.</td>
	<td>-</td>
	<td></td>
	<td>-</td>
	</tr>
	<?php endif?>

	</tbody>
	</table>
	
	<div class="page pagebox01">
		<script type="text/javascript">getPageLink(10,<?php echo $p?>,<?php echo $TPG?>,'<?php echo $g['img_core']?>/page/default');</script>
	</div>
	


</div>


<div id="qTilePopDiv"></div>
<script type="text/javascript">
//<![CDATA[
if (myagent != 'ie') document.captureEvents(Event.MOUSEMOVE);
document.onmousemove = get_mouse;

var skn = getId('qTilePopDiv');
var itt = '';

function qTilePop(obj)
{
    var content ='<div style="width:300px;line-height:150%;font-family:dotum;color:#666666;border:#999999 solid 1px;padding:3px;background:lightyellow;">'+obj.title+'</div>';
	skn.style.position= 'absolute';
	skn.style.display = 'block';
	skn.style.zIndex = '1';
	itt = obj.title;
	obj.title = '';
	skn.innerHTML = content;
}
function get_mouse(e) 
{
    var x = myagent != 'ie' ? e.pageX : event.x+(document.body.scrollLeft || document.documentElement.scrollLeft);
    var y = myagent != 'ie' ? e.pageY : event.y+(document.body.scrollTop || document.documentElement.scrollTop);
    skn.style.left = (x - 0) + 'px';
    skn.style.top  = (y + 20) + 'px';
}
function qTilePopKill(obj) 
{
	obj.title = itt;
	itt = '';
	skn.style.top = '10000';
	skn.style.display = 'none';
}
function sendCheck(f)
{
	if (f.trackback.value == '')
	{
		alert('보낼주소를 입력해 주세요.    ');
		f.trackback.focus();
		return false;
	}
	return confirm('정말로 이 글을 입력하신 주소로 보내시겠습니까?      ');
}
function frameSetting()
{
	var obj = parent.getId(frames.name);
	if(obj)
	{
		obj.style.height = parseInt(document.body.scrollHeight) + 'px';
		if(parent.getId('trackback_num<?php echo $cyncArr['data'][1]?>'))
		{
			parent.getId('trackback_num<?php echo $cyncArr['data'][1]?>').innerHTML = '<?php echo $NUM?>';
		}
	}
}
window.onload = frameSetting;
//]]>
</script>