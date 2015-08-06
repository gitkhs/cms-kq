<div class="guide">
홈페이지 제목을 변경하거나 이미지로고 등을 설정할 수 있습니다.<br />
변경사항이 적용되지 않을 경우 새로고침해 주세요.<br /> 
</div>

<form name="themeForm" method="post" action="<?php echo $g['s']?>/" enctype="multipart/form-data" onsubmit="return configCheck1(this);">
<input type="hidden" name="r" value="<?php echo $r?>" />
<input type="hidden" name="_layoutAction" value="config" />
<input type="hidden" name="nowLayout" value="<?php echo $d['layout']['dir']?>" />
<input type="hidden" name="changeType" value="<?php echo $_themeConfig?>" />


<table>
<tr>
<td class="t1">홈페이지 제목</td>
<td class="t2">:</td>
<td class="t3">
	<input type="text" name="title" class="input" value="<?php echo $d['layout']['title']?>" />
</td>
</tr>
<tr>
<td class="t1">제목 색상</td>
<td class="t2">:</td>
<td class="t3">
	<input type="text" name="title_color" id="title_color_" class="input sf1" value="<?php echo $d['layout']['title_color']?>" maxlength="7" />
	<img src="<?php echo $g['img_core']?>/_public/btn_color.gif" class="hand" alt="" onclick="getLayerBox('<?php echo $g['s']?>/_core/opensrc/colorjack/color.php?color=<?php echo substr($d['layout']['title_color'],1,6)?>&dropf=title_color_&callback=colorChange','색상선택',220,260,event,'','b');" /> 
</td>
</tr>
<tr>
<td class="t1">이미지 로고</td>
<td class="t2">:</td>
<td class="t3">
<input type="file" name="upfile" class="file" value="" /><br />
<input type="checkbox" name="imglogo_use" value="1"<?php if($d['layout']['imglogo_use']):?> checked="checked"<?php endif?> />이미지로고 사용함
</td>
</tr>

<tr>
<td class="t1">헤더고정</td>
<td class="t2">:</td>
<td class="t3">
	<input type="checkbox" name="headerfix" value="1"<?php if($d['layout']['headerfix']):?> checked="checked"<?php endif?> />스크롤을 내려도 상단에 고정함
</td>
</tr>

<?php if(is_file($g['path_layout'].$d['layout']['dir'].'/_var/'.$d['layout']['imglogo'])):?>
<tr>
<td></td>
<td></td>
<td class="t3">
<br />
<img src="<?php echo $g['s'].'/layouts/'.$d['layout']['dir'].'/_var/'.$d['layout']['imglogo']?>" height="32" alt="" style="background:#000000;" />
<br /><br />
<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;_layoutAction=logodelete&amp;&imgType=logo&amp;nowLayout=<?php echo $d['layout']['dir']?>" onclick="return hrefCheck(this,true,'정말로 삭제하시겠습니까?');">이 로고를 삭제하기</a>
<br />
<br />
</td>
</tr>
<?php endif?>


<?php $MENULIST=getDbArray($table['s_menu'],'site='.$s.' and hidden=0 and depth=1','*','gid','asc',0,1)?>
<?php $_RCD1=array(); while($_B1=db_fetch_array($MENULIST)) $_RCD1[]=$_B1?>
<?php $BBSLIST=getDbArray($table['bbslist'],'','*','gid','asc',0,1)?>
<?php $_RCD2=array(); while($_B2=db_fetch_array($BBSLIST)) $_RCD2[]=$_B2?>

<tr>
<td class="t1">상단메뉴(1)</td>
<td class="t2">:</td>
<td class="t3">전체메뉴로 고정됩니다<br />(터치하면 모바일에 체크된 모든 메뉴가 출력됩니다)</td>
</tr>

<?php for($i=1;$i<4;$i++):?>
<tr>
<td></td>
<td></td>
<td><br /></td>
</tr>
<tr>
<td class="t1">상단메뉴(<?php echo $i+1?>)<br />메뉴제목<br />링크주소</td>
<td class="t2">:</td>
<td class="t3">
	<select class="select1" style="background:#333333;color:#ffffff;" onchange="menuDrop(<?php echo $i?>,this);">
	<option value="">&nbsp;+ 메뉴 리스트</option>
	<option value="">-------------------------------------</option>
	<?php foreach($_RCD1 as $_B1):?>
	<option value="m|<?php echo $_B1['uid']?>|<?php echo $_B1['name']?>|<?php echo RW('c='.$_B1['id'])?>">ㆍ<?php echo $_B1['name']?> (<?php echo $_B1['mobile']?'모바일':'PC'?>)</option>
	<?php endforeach?>
	<option value="">&nbsp;+ 게시판 리스트</option>
	<option value="">-------------------------------------</option>
	<?php foreach($_RCD2 as $_B2):?>
	<option value="b|<?php echo $_B2['uid']?>|<?php echo $_B2['name']?>|<?php echo RW('m=bbs&bid='.$_B2['id'])?>">ㆍ<?php echo $_B2['name']?> (<?php echo $_B2['id']?>)</option>
	<?php endforeach?>
	</select><br />
	<input type="hidden" name="tmenu_<?php echo $i?>" id="tmenu_<?php echo $i?>" value="<?php echo $d['layout']['tmenu_'.$i]?>" class="input" />
	<input type="text" name="tmenu_<?php echo $i?>_text" id="tmenu_<?php echo $i?>_text" value="<?php echo $d['layout']['tmenu_'.$i.'_text']?>" class="input" /><br />
	<input type="text" name="tmenu_<?php echo $i?>_link" id="tmenu_<?php echo $i?>_link" value="<?php echo $d['layout']['tmenu_'.$i.'_link']?>" class="input" /><br />
</td>
</tr>
<?php endfor?>

<tr>
<td></td>
<td></td>
<td>메뉴/게시판 리스트에서 선택하시면 제목 및 링크가 자동으로 입력됩니다.</td>
</tr>

<tr>
<td></td>
<td></td>
<td><br /><br /><input type="submit" value=" 변경하기 " class="btnblue" /></td>
</tr>
</table>

</form>
<br />
<br />
