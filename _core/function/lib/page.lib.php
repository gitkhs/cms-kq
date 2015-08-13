<?php
function LIB_getPageLink($lnum,$p,$tpage,$img)
{
	$_N = $GLOBALS['g']['pagelink'].'&amp;';
	$g_p1 = '<img src="'.$img.'/p1.gif" alt="이전 '.$lnum.' 페이지" />';
	$g_p2 = '<img src="'.$img.'/p2.gif" alt="이전 '.$lnum.' 페이지" />';
	$g_n1 = '<img src="'.$img.'/n1.gif" alt="다음 '.$lnum.' 페이지" />';
	$g_n2 = '<img src="'.$img.'/n2.gif" alt="다음 '.$lnum.' 페이지" />';
	$g_cn = '<img src="'.$img.'/l.gif" class="split" alt="" />';
	$g_q  = $p > 1 ? '<a href="'.$_N.'p=1"><img src="'.$img.'/fp.gif" alt="처음페이지" /></a>' : '<img src="'.$img.'/fp1.gif" alt="처음페이지" />';
	if($p < $lnum+1) { $g_q .= $g_p1; }
	else{ $pp = (int)(($p-1)/$lnum)*$lnum; $g_q .= '<a href="'.$_N.'p='.$pp.'">'.$g_p2.'</a>';} $g_q .= $g_cn;
	$st1 = (int)(($p-1)/$lnum)*$lnum + 1;
	$st2 = $st1 + $lnum;
	for($jn = $st1; $jn < $st2; $jn++)
	if ( $jn <= $tpage)
	($jn == $p)? $g_q .= '<span class="selected" title="'.$jn.' 페이지">'.$jn.'</span>'.$g_cn : $g_q .= '<a href="'.$_N.'p='.$jn.'" class="notselected" title="'.$jn.' 페이지">'.$jn.'</a>'.$g_cn;
	if($tpage < $lnum || $tpage < $jn) { $g_q .= $g_n1; }
	else{$np = $jn; $g_q .= '<a href="'.$_N.'p='.$np.'">'.$g_n2.'</a>'; }
	$g_q  .= $tpage > $p ? '<a href="'.$_N.'p='.$tpage.'"><img src="'.$img.'/lp.gif" alt="마지막페이지" /></a>' : '<img src="'.$img.'/lp1.gif" alt="마지막페이지" />';
	return $g_q;
}

function LIB_getBootstrapPageLink($lnum,$p,$tpage)
{
	$_N = $GLOBALS['g']['pagelink'].'&amp;';
	$g_q	= '<nav><ul class="pagination">';

	$g_q	.= $p > 1 ? '<li><a href="'.$_N.'p=1" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>' : '<li class="disabled"><span aria-hidden="true">&laquo;</span></li>';
	if($p < $lnum+1) {
		$g_q	.= '<li class="disabled"><span aria-hidden="true">&lt;</span></li>';
	}
	else{
		$pp		= (int)(($p-1)/$lnum)*$lnum;
		$g_q	.= '<li><a href="'.$_N.'p='.$pp.'"><span aria-hidden="true">&lt;</span></a></li>';
	}
	
	$st1 = (int)(($p-1)/$lnum)*$lnum + 1;
	$st2 = $st1 + $lnum;
	for($jn = $st1; $jn < $st2; $jn++) {
		if ( $jn <= $tpage) {
			$g_q	.= '<li class="'.($jn==$p ? 'active' : '').'"><a href="'.$_N.'p='.$jn.'">'.$jn.'</a></li>';
		}
	}

	if($tpage < $lnum || $tpage < $jn) {
		$g_q	.= '<li class="disabled"><span aria-hidden="true">&gt;</span></li>';
	}
	else {
		$np		= $jn;
		$g_q	.= '<li><a href="'.$_N.'p='.$np.'"><span aria-hidden="true">&gt;</span></a></li>';
	}
	$g_q	.= $tpage > $p ? '<li><a href="'.$_N.'p='.$tpage.'" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>' : '<li class="disabled"><span aria-hidden="true">&raquo;</span></li>';
	$g_q	.= '</ul></nav>';
	return $g_q;
}
?>