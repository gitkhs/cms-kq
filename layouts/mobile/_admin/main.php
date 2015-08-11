<div id="subcontent">
	<div class="smenu">
		<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;_themeConfig=detail"<?php if($_themeConfig=='detail'):?> class="on"<?php endif?>>타이틀/메뉴 설정</a>
		<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;_themeConfig=front"<?php if($_themeConfig=='front'):?> class="on"<?php endif?>>메인화면 설정</a>
	</div>
	<div  class="configbox">
	<?php include  $g['path_layout'].$d['layout']['dir'].'/_admin/_'.$_themeConfig.'.php'?>
	</div>
</div>



<script type="text/javascript">
//<![CDATA[
function colorChange(f,v)
{
	if(getId('_layout_'+f)) getId('_layout_'+f).style.color = '#'+v;
}
function configCheck(f)
{
	getIframeForAction(f);
	return confirm('정말로 변경하시겠습니까?      ');
}
function menuDrop(i,obj)
{
	if (obj.value != '')
	{
		var val = obj.value.split('|');
		getId('tmenu_'+i).value = val[0]+''+val[1];
		getId('tmenu_'+i+'_text').value = val[2];
		getId('tmenu_'+i+'_link').value = val[3];
	}
	obj.value = '';
}
function configCheck1(f)
{
	if (f.title.value == '')
	{
		alert('타이틀을 입력해 주세요.   ');
		f.title.focus();
		return false;
	}

	if (f.upfile.value != '')
	{
		var extarr = f.upfile.value.split('.');
		var filext = extarr[extarr.length-1].toLowerCase();
		var permxt = '[gif][jpg][jpeg][png]';

		if (permxt.indexOf(filext) == -1)
		{
			alert('gif/jpg/png 파일만 등록할 수 있습니다.    ');
			f.upfile.focus();
			return false;
		}
	}

	getIframeForAction(f);
	return confirm('정말로 변경하시겠습니까?      ');
}
//]]>
</script>

