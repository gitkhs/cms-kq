<?
	$R	= getDbData("{$table['s_mbrdata']} left join {$table['s_mbrid']} on memberuid=uid","memberuid='{$mbruid}'","*");
	include_once $g['dir_module'].'var/mbrlevel.php';

	
	$qTbl	= $table['s_point'];
	$qDat	= "*";
	$qWhe	= "my_mbruid='{$mbruid}'";
	if($price){
		if($price == '1')
			$qWhe	.= " and price > 0";
		else if($price == '2')
			$qWhe	.= " and price < 0";
	}

	$qSrt	= "uid";
	$qOdr	= "desc";
	$qNum	= 20;
	
	$RCD	= getDbArray($qTbl,$qWhe,$qDat,$qSrt,$qOdr,$qNum,$p);
	$NUM	= getDbRows($qTbl,$qWhe);
	$TPG	= getTotalPage($NUM,$qNum);
?>

<div id="member_detail">

	<div class="sbj">기본 항목</div>
	<table class="tbl-form">
	<colgroup>
	<col width="100">
	<col width="200">
	<col width="100">
	<col width="200">
	<col width="100">
	<col>
	</colgroup>
	<tr>
		<td class="lbl">아이디</td>
		<td><?=$R['id']?></td>
		<td class="lbl">이름</td>
		<td><?=$R['name']?></td>
		<td class="lbl">가입일</td>
		<td><?=getDateFormat($R['d_regis'],'Y.m.d H:i')?></td>
	</tr>
	<tr>
		<td class="lbl">등급</td>
		<td><?=$levelset[$R['level']]?></td>
		<td class="lbl">연락처</td>
		<td><?=$R['tel2']?$R['tel2']:$R['tel1']?></td>
		<td class="lbl">이메일</td>
		<td><?=$R['email']?></td>
	</tr>
	<tr>
		<td class="lbl">메일수신</td>
		<td><?=$R['mailing']?'Y':'N'?></td>
		<td class="lbl">SMS수신</td>
		<td><?=$R['sms']?'Y':'N'?></td>
		<td class="lbl">최근접속</td>
		<td><?php echo -getRemainDate($R['last_log'])?>일</td>
	</tr>
	<tr>
		<td class="lbl"></td>
		<td></td>
		<td class="lbl">보유포인트</td>
		<td><span class="pt1"><b><?=$R['point']?></b></span></td>
		<td class="lbl">사용포인트</td>
		<td><span class="pt2"><b><?=$R['usepoint']?></b></span></td>
	</tr>
	<tr>
		<td class="lbl">주소</td>
		<td colspan="5"><?=$R['addr1']?> <?=$R['addr2']?></td>
	</tr>
	</table>

	<div class="row">
		<form name="frmSrch" method="get" action="<?=$g['s']?>/">
		<input type="hidden" name="r" value="<?=$r?>" />
		<input type="hidden" name="c" value="<?=$c?>" />
		<input type="hidden" name="m" value="<?=$m?>" />
		<input type="hidden" name="mod" value="<?=$mod?>" />
		<input type="hidden" name="div" value="<?=$div?>" />
		<input type="hidden" name="mbruid" value="<?=$mbruid?>" />
		<input type="hidden" name="iframe" value="<?=$iframe?>" />
		<div style="float:left;padding:20px 0px 5px 0px;"><b>포인트 내역</b></div>
		<div style="float:right;padding:20px 0px 5px 0px;">
			<label><input type="radio" name="price" value="" <?if(!$price) echo 'checked="checked"';?> onclick="$('form[name=frmSrch]').submit();"> 전체</label>
			<label><input type="radio" name="price" value="1" <?if($price == 1) echo 'checked="checked"';?> onclick="$('form[name=frmSrch]').submit();"> 지급</label>
			<label><input type="radio" name="price" value="2" <?if($price == 2) echo 'checked="checked"';?> onclick="$('form[name=frmSrch]').submit();"> 차감</label>
		</div>
		<div style="clear"></div>
		</form>
	</div>

	<table class="tbl-line">
	<colgroup>
	<col width="50">
	<col width="100">
	<col width="120">
	<col>
	<col width="120">
	</colgroup>
	<tr>
		<td class="th">번호</td>
		<td class="th">포인트</td>
		<td class="th">지급자</td>
		<td class="th">내용</td>
		<td class="th">날짜</td>
	</tr>
	<? while($_R=db_fetch_array($RCD)){ ?>
	<tr>
		<td><? echo $NUM-((($p-1)*$qNum)+$_rec++); ?></td>
		<td><span style="color:<?=$_R['price']>0 ? '#ff0000':'#0000ff' ;?>;"><?=number_format($_R['price'])?></span></td>
		<td>
		<? $M1=getDbData($table['s_mbrdata'],'memberuid='.$_R['by_mbruid'],'*'); echo $M1['name'] ? $M1['name'] : '시스템';?>
		</td>
		<td class="lt"><?=strip_tags($_R['content'])?></td>
		<td><?=getDateFormat($_R['d_regis'],'Y.m.d H:i')?></td>
	</tr>
	<? } ?>
	<? if(!$NUM){ ?>
	<tr>
		<td colspan="5">조회 내역이 존재 하지 않습니다.</td>
	</tr>
	<? } ?>
	</table>
	
	<div class="pagebox01"><? echo getPageLink(10,$p,$TPG,$g['img_core'].'/page/default')?></div>

</div>
