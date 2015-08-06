

<div id="catebody">
	<div id="category">
		<div class="title">
			<span class="add">
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=market&amp;front=pack&amp;type=theme" title="테마 추가"><img src="<?php echo $g['img_core']?>/_public/btn_add.gif" alt="" /></a>
			</span>
			테마리스트
		</div>
		
		<div class="tree">
			<ul>
			<?php $i=0?>
			<?php $xdir = $g['path_module'].$module.'/theme/'?>
			<?php $tdir = $xdir.'_pc/'?>
			<?php $dirs = opendir($tdir)?>
			<?php while(false !== ($skin = readdir($dirs))):?>
			<?php if($skin=='.' || $skin == '..' || is_file($tdir.$skin))continue?>
			<?php $i++?>
			<li>
				<img src="<?php echo $g['img_core']?>/_public/ico_folder_01.gif" alt="" />
				<a href="<?php echo $g['adm_href']?>&amp;theme=_pc/<?php echo $skin?>"><span class="name<?php if($theme=='_pc/'.$skin):?> on<?php endif?>"><span class="b">[P]</span><?php echo getFolderName($tdir.$skin)?></span></a><span class="id">(<?php echo $skin?>)</span>
			</li>
			<?php endwhile?>
			<?php closedir($dirs)?>
			<?php $tdir = $xdir.'_mobile/'?>
			<?php $dirs = opendir($tdir)?>
			<?php while(false !== ($skin = readdir($dirs))):?>
			<?php if($skin=='.' || $skin == '..' || is_file($tdir.$skin))continue?>
			<?php $i++?>
			<li>
				<img src="<?php echo $g['img_core']?>/_public/ico_folder_01.gif" alt="" />
				<a href="<?php echo $g['adm_href']?>&amp;theme=_mobile/<?php echo $skin?>"><span class="name<?php if($theme=='_mobile/'.$skin):?> on<?php endif?>"><span class="b">[M]</span><?php echo getFolderName($tdir.$skin)?></span></a><span class="id">(<?php echo $skin?>)</span>
			</li>
			<?php endwhile?>
			<?php closedir($dirs)?>
			</ul>
		</div>
		<?php if(!$i):?>
		<div class="none">등록된 테마가 없습니다.</div>
		<?php endif?>
	</div>


	<div id="catinfo">


		<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $module?>" />
		<input type="hidden" name="a" value="theme_config" />
		<input type="hidden" name="theme" value="<?php echo $theme?>" />
		<div class="title">

			<div class="xleft">
				테마 세부설정 변수
			</div>
			<div class="xright">
				<?php if($theme):?>
				<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=theme_delete&amp;theme=<?php echo $theme?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 이 테마를 삭제하시겠습니까?       ');">테마삭제</a>
				<?php endif?>
			</div>





		</div>
		<?php if($theme):?>

		<div class="notice">
			<span class="b"><?php echo getFolderName($xdir.$theme)?></span> 테마가 선택되었습니다.<br />
			이 테마를 사용하는 모든 게시판에 아래의 설정값이 적용됩니다.
		</div>

		<textarea name="theme_var" rows="10" cols="70"><?php echo implode('',file($g['path_module'].$module.'/theme/'.$theme.'/_var.php'))?></textarea>
		
		<div class="submitbox">
			<input type="submit" class="btnblue" value=" 확인 " />
			<div class="clear"></div>
		</div>
		<?php else:?>

		<div class="notice">
			테마가 선택되지 않았습니다. 테마를 선택해 주세요.<br />
			테마설정은 해당 테마를 사용하는 모든 게시판에 적용됩니다.
		</div>

		<ul>
		<li>테마는 게시판의 외형을 변경할 수 있는 요소입니다.</li>
		<li>테마설정은 게시판의 외형만 제어하며 게시판의 내부시스템에는 영향을 주지 않습니다.</li>
		<li>테마의 속성을 변경하면 해당테마를 사용하는 모든 게시판에 적용됩니다.</li>
		</ul>

		<?php endif?>

		</form>
		

	</div>
	<div class="clear"></div>
</div>




<script type="text/javascript">
//<![CDATA[
function saveCheck(f)
{
	return confirm('정말로 실행하시겠습니까?         ');
}
//]]>
</script>





