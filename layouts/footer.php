<?php if($g['mobile']) : ?>
<!-- 모바일 회사정보 -->
<div class="row">
	<div class="col-sm-3">회사명 : (주)회사이름</div>
	<div class="col-sm-3">연락처 : 02-123-4567</div>
	<div class="col-sm-3">FAX : 02-123-4567</div>
	<div class="col-sm-3">대표자 : 대표자명</div>
</div>
<div class="row">
	<div class="col-sm-6">사업자등록번호 : 111-111-1111</div>
	<div class="col-sm-6">주소 : 서울특별시 영등포구 국회대로</div>
</div>
<div class="row">
	<div class="col-sm-12">Copyright &copy; <?php echo $date['year']?> <?php echo $_SERVER['HTTP_HOST']?></div>
</div>

<?php else : ?>

<!-- 데스트탑 회사정보 -->
<div class="wrap">
	<div class="biz-info">
		<div>회사명 : (주)회사이름 | 사업자등록번호 : 111-111-1111</div>
		<div>연락처 : 02-123-4567 | FAX : 02-123-4567 | 대표자 : 대표자명</div>
		<div>주소 : 서울특별시 영등포구 국회대로</div>
	</div>
	<div class="copyright">
		Copyright &copy; <?php echo $date['year']?> <?php echo $_SERVER['HTTP_HOST']?> All rights reserved.
	</div>
</div>
<?php endif ?>