<?php 
$dbheadstr = strlen($DB['head']);
$status_result = db_query('SHOW TABLE STATUS', $DB_CONNECT);
while ( $rows = db_fetch_assoc($status_result))
{
	if ($keyword) if (!strpos('_'.$rows['Name'],$keyword)) continue;
	if (!$alltable) if (substr($rows['Name'],0,$dbheadstr)!=$DB['head']) continue;

	$table_array[] = $rows['Name'].'|'.$rows['Rows'].'|'.$rows['Data_length'].'|'.$rows['Index_length'].'|'.$rows['Engine'].'|'.$rows['Row_format'].'|'.$rows['Collation'].'|'.$rows['Data_free'].'|';
	$sum_size = $sum_size + ($rows['Data_length'] + $rows['Index_length']);
	$sum_record = $sum_record + $rows['Rows'];
}
$data_num = count($table_array);
$TPG = intval($data_num/$recnum);
if($TPG > 0) $TPG++;
else $TPG=1;
?>



<div id="dblist">


	<form name="table_list" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>">
	<input type="hidden" name="r" value="<?php echo $r?>" />
	<input type="hidden" name="m" value="<?php echo $module?>" />
	<input type="hidden" name="a" value="action" />
	<input type="hidden" name="_a" value="" />
	<input type="hidden" name="p" value="<?php echo $p?>" />


	
<?php if($viewType == 'list'):?>

	<table>
		<colgroup> 
		<col width="30"> 
		<col width="50"> 
		<col> 
		<col width="70"> 
		<col width="70"> 
		<col width="70"> 
		<col width="70"> 
		<col width="70"> 
		<col width="70"> 
		<col width="90"> 
		<col width="50"> 
		<col width="160"> 
		<col width="130"> 
		</colgroup> 
		<thead>
		<tr>
		<th scope="col" class="split"></th>
		<th scope="col" class="split">NO</th>
		<th scope="col" class="split">NAME</th>
		<th scope="col" class="split">ROWS</th>
		<th scope="col" class="split">데이터</th>
		<th scope="col" class="split">인덱스</th>
		<th scope="col" class="split">부담</th>
		<th scope="col" class="split">종류</th>
		<th scope="col" class="split">형식</th>
		<th scope="col" class="split">Collation</th>
		<th scope="col" class="split">속성</th>
		<th scope="col" class="split">실행</th>
		<th scope="col">백업</th>
		</tr>
		</thead>


		<tbody>
		<?php for($i=($p-1)*$recnum;$i<=($p-1)*$recnum+$recnum-1;$i++) : $row = explode('|', $table_array[$i])?>
		<?php if(($data_num-$i) > 0):?>


		<tr>
		<td><input type="checkbox" name="multi<?php echo $i?>" value="<?php echo $row[0]?>" /></td>
		<td> <?php echo ($data_num-$i)?> </td>
		<td>
			<input type="text" name="new_table_<?php echo $i?>" value="<?php echo $row[0]?>" class="input" />
			<input type="button" value="변경" class="ibox" onclick="TableNameChange('<?php echo $module?>','<?php echo $row[0]?>',document.table_list.new_table_<?php echo $i?>.value,'<?php echo $p?>');" />
		</td>
		<td><?php echo number_format($row[1])?></td>
		<td><?php echo getSizeFormat($row[2],1)?></td>
		<td><?php echo getSizeFormat($row[3],1)?></td>
		<?php if(strtolower($row[4])=='myisam'):?>
		<td<?php if($row[7]):?> class="sfont1"<?php endif?>><?php echo $row[7] ? getSizeFormat($row[7],0) : '-'?></td>
		<?php else:?>
		<td>-</td>
		<?php endif?>
		<td><?php echo $row[4]?></td>
		<td><?php echo $row[5]?></td>
		<td><?php echo $row[6]?></td>
		<td><input type="button" value="속성" class="ibox" onclick="TableSkill('<?php echo $m?>&module=<?php echo $module?>','<?php echo $p?>','<?php echo $row[0]?>','property');" /></td>
		<td>
			<input type="button" value="보기" class="ibox" onclick="TableSkill('<?php echo $m?>&module=<?php echo $module?>','<?php echo $p?>','<?php echo $row[0]?>','view');"<?php if(!$row[1]):?> disabled<?php endif?> />
			<input type="button" value="삽입" class="ibox" onclick="TableSkill('<?php echo $m?>&module=<?php echo $module?>','<?php echo $p?>','<?php echo $row[0]?>','add');" />
			<input type="button" value="삭제" class="ibox" onclick="TableSkill('<?php echo $module?>','<?php echo $p?>','<?php echo $row[0]?>','delete');" />
			<input type="button" value="비움" class="ibox" onclick="TableSkill('<?php echo $module?>','<?php echo $p?>','<?php echo $row[0]?>','empty');"<?php if(!$row[1]):?> disabled<?php endif?> />
		</td>
		<td>
			<input type="button" value="구조" class="ibox" onclick="TableSkill('<?php echo $module?>','<?php echo $p?>','<?php echo $row[0]?>','dump_struct');" />
			<input type="button" value="완전" class="ibox"  onclick="TableSkill('<?php echo $module?>','<?php echo $p?>','<?php echo $row[0]?>','dump_all');"<?php if(!$row[1]):?> disabled<?php endif?> />
			<input type="button" value="엑셀" class="ibox"  onclick="TableSkill('<?php echo $module?>','<?php echo $p?>','<?php echo $row[0]?>','dump_excel');"<?php if(!$row[1]):?> disabled<?php endif?> />
		</td>
		</tr>

		<?php endif?>
		<?php endfor?>
		</tbody>

	</table>




<?php else:?>


		<?php for($i=($p-1)*$recnum;$i<=($p-1)*$recnum+$recnum-1;$i++) : $row = explode('|', $table_array[$i])?>
		<?php if(($data_num-$i) > 0):?>


		<div class="boxbody">
			<div class="chk"><input type="checkbox" name="multi<?php echo $i?>" value="<?php echo $row[0]?>" /></div>
			<div class="icon">
				<a href="<?php echo $g['adm_href']?>&amp;viewType=<?php echo $viewType?>&amp;type=property&amp;Xtbl=<?php echo $row[0]?>" title="구조보기"><img src="<?php echo $g['img_core']?>/file/big/db.gif" alt="" /></a>
			</div>
			<div class="name"><?php echo $row[0]?></div>
			<div class="info">
				<a href="<?php echo $g['adm_href']?>&amp;viewType=<?php echo $viewType?>&amp;type=view&Xtbl=<?php echo $row[0]?>" title="내용보기"><?php echo number_format($row[1])?> / <?php echo getSizeFormat($row[2]+$row[3],1)?></a>
			</div>
		</div>  


		<?php endif?>
		<?php endfor?>


		<div class="boxbottom"></div>

<?php endif?>



	<div class="bottom">

		<div class="pagebox02">
		<?php //echo getPageLink(10,$p,$TPG,$g['img_core'].'/page/default')?>
		<script type="text/javascript">getPageLink(10,<?php echo $p?>,<?php echo $TPG?>,'<?php echo $g['img_core']?>/page/default');</script>
		</div>


		<input type="button" value="선택" class="btngray" onclick="TableCheck('check','');" />
		<input type="button" value="취소" class="btngray" onclick="TableCheck('cancel','');" />
		<input type="button" value="반전" class="btngray" onclick="TableCheck('reverse','');" />


		<input type="button" value="삭제" class="btnblue" onclick="TableCheck('change','mt_delete');" />
		<input type="button" value="비우기" class="btnblue" onclick="TableCheck('change','mt_empty');" />
		<input type="button" value="테이블복구" class="btnblue" onclick="TableCheck('change','mt_repair');" />
		<input type="button" value="테이블최적화" class="btnblue" onclick="TableCheck('change','mt_optimize');" />

		<div>(총레코드수 : <?php echo  number_format($sum_record)?>개, 사용량 : <?php echo getSizeFormat($sum_size,2)?>)</div>
	</div>

</form>


</div>

