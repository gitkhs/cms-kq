<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

include_once $g['path_core'].'function/email.func.php';

$content = '<h4>이메일전송 테스트입니다.</h4><br />';
$content.= '이 화면을 정상적으로 확인하셨다면 이메일 전송이 정상작동중입니다.<br /><br />';

$result = getSendMail($email,$my['email'].'|'.$my['name'],'['.$_HS['name'].']이메일전송 테스트입니다.',$content,'HTML');

getLink('reload','parent.',($result ? '이메일이 전송되었습니다. 확인해 보세요.':'메일서버가 응답하지 않습니다.'),'');
?>