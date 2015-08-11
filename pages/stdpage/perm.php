<?
	$mbrlevel = getDbData($table['s_mbrlevel'],"uid={$R['level']}",'*');
?>
<div id="stdpage_perm">
	<div class="subject"><?=$_HM['name']?></div>
	
	<h3>서비스 안내</h3>
	
	<ul>
	<li>요청하신 페이지는 권한(<b><?=$mbrlevel['name']?></b>)이 있어야 접근하실 수 있습니다.</li>
	<li>로그인하신 후에 이용하세요.</li>
	<li>로그인을 하신 후에도 이 페이지가 출력되면 회원등급 권한이 없는 경우입니다.</li>
	</ul>
	
</div>