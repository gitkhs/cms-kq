<?php
	extract($_POST);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ko" xml:lang="ko" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no,target-densitydpi=medium-dpi">
<meta name="apple-mobile-web-app-capable" content="no">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<title>홈페이지 인스톨</title>
	<style>
	label span {width:80px; display:inline-block;}
	</style>
</head>

<body>
<?php if(!$_POST['rq']) : ?>
<?php
	exec("cp _tmp/backup/index.php index.php");
?>
	<form name="frmWrite" method="post">
	<input type="hidden" name="rq" value="1">
	<div><b>DB 정보</b></div>
	<div><label><span>HOST</span> <input type="text" name="db_host" value="<?=$db_host ? $db_host : 'localhost'?>"></label></div>
	<div><label><span>PORT</span> <input type="text" name="db_port" value="<?=$db_port ? $db_port : '3306'?>"></label></div>
	<div><label><span>DB 명</span> <input type="text" name="db_name" value="<?=$db_name?>"></label></div>
	<div><label><span>아이디</span> <input type="text" name="db_user" value="<?=$db_user?>"></label></div>
	<div><label><span>비밀번호</span> <input type="text" name="db_pass" value="<?=$db_pass?>"></label></div>
	<div><label><span>헤더</span> <input type="text" name="db_head" value="<?=$db_head?>"></label></div>
	<div><input type="submit" value="설치하기"></div>
	</form>
<?php else : ?>
<?php
	include_once '_tmp/backup/db_schema.php';
	$path	= str_replace('index.php','',$_SERVER['PHP_SELF']);
	header("location:{$path}");
?>
<?php endif?>
	
</body>

</html>