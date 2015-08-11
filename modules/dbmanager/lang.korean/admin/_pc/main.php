<?php 
$viewType=$viewType ? $viewType : 'list';
$recnum = $recnum ? $recnum : 30;
$p = $p ? $p : 1;
$orderby = $orderby == 'asc' ? 'desc' : 'asc';
?>



<div id="dbtop">


	데이터베이스 <a href="<?php echo $g['adm_href']?>&amp;viewType=<?php echo $viewType?>" class="cx">[<?php echo $DB['name']?>]</a> 
	<?php if($Xtbl):?>
	/ 테이블 <a href="<?php echo $g['adm_href']?>&amp;viewType=<?php echo $viewType?>&amp;type=view&amp;Xtbl=<?php echo $Xtbl?>" class="cx">[<?php echo $Xtbl?>]</a>
	<?php endif?>
		

	<?php if($Xtbl):?>
	
	<span class="span1">
	<input type="button" value="속성" class="btngray" onclick="TableSkill('<?php echo $m?>&module=<?php echo $module?>','1','<?php echo $Xtbl?>','property');" />
	<input type="button" value="보기" class="btngray" onclick="TableSkill('<?php echo $m?>&module=<?php echo $module?>','1','<?php echo $Xtbl?>','view');" />
	<input type="button" value="삽입" class="btngray" onclick="TableSkill('<?php echo $m?>&module=<?php echo $module?>','1','<?php echo $Xtbl?>','add');" />
	<input type="button" value="삭제" class="btngray" onclick="TableSkill('<?php echo $module?>','1','<?php echo $Xtbl?>','delete');" />
	<input type="button" value="비움" class="btngray" onclick="TableSkill('<?php echo $module?>','1','<?php echo $Xtbl?>','empty');" />
	<input type="button" value="구조백업" class="btngray" onclick="TableSkill('<?php echo $module?>','1','<?php echo $Xtbl?>','dump_struct');" />
	<input type="button" value="완전백업" class="btngray"  onclick="TableSkill('<?php echo $module?>','1','<?php echo $Xtbl?>','dump_all');" />
	<input type="button" value="엑셀백업" class="btngray"  onclick="TableSkill('<?php echo $module?>','1','<?php echo $Xtbl?>','dump_excel');" />
	</span>

	<?php else:?>	

	<form name="dbSform" action="<?php echo $g['s']?>/">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="m" value="<?php echo $m?>" />
	<input type="hidden" name="module" value="<?php echo $module?>" />
	<input type="hidden" name="viewType" value="<?php echo $viewType?>" />
	<input type="text" name="keyword" value="<?php echo $_keyword?>" class="input" />
	<input type="submit" value="검색" class="btnblue" />
	<input type="button" value="리셋" class="btngray" onclick="goHref('<?php echo $g['adm_href']?>&amp;viewType=<?php echo $viewType?>');" />
	<select name="recnum" onchange="this.form.submit();">
	<option value="10"<?php if($recnum==10):?> selected="selected"<?php endif?>>display.10</option>
	<option value="20"<?php if($recnum==20):?> selected="selected"<?php endif?>>display.20</option>
	<option value="30"<?php if($recnum==30):?> selected="selected"<?php endif?>>display.30</option>
	<option value="40"<?php if($recnum==40):?> selected="selected"<?php endif?>>display.40</option>
	<option value="50"<?php if($recnum==50):?> selected="selected"<?php endif?>>display.50</option>
	<option value="100"<?php if($recnum==100):?> selected="selected"<?php endif?>>display.100</option>
	<option value="200"<?php if($recnum==200):?> selected="selected"<?php endif?>>display.200</option>
	</select>
	<input type="checkbox" name="alltable" id="alltable" value="1"<?php if($alltable):?> checked="checked"<?php endif?> onclick="this.form.submit();" /><label for="alltable" title="데이터베이스내의 전체 테이블을 모두 출력합니다.">전체테이블</label>
	</form>

	<a href="<?php echo $g['adm_href']?>&amp;viewType=colum&amp;recnum=<?php echo $recnum?>" class="img1"><img src="<?php echo $g['img_core']?>/_public/btn_colum.gif" alt="" title="컬럼타입 보기" /></a><a href="<?php echo $g['adm_href']?>&amp;viewType=list&amp;recnum=<?php echo $recnum?>" class="img1"><img src="<?php echo $g['img_core']?>/_public/btn_list.gif" alt="" title="리스트타입 보기" /></a>


	<?php endif?>

</div>



<?php include $g['path_module'].$module.'/lang.'.$_HS['lang'].'/admin/_pc/type/main.'.($type?$type:'list').'.php'?>

