<?php
if(!defined('__KIMS__')) exit;
checkAdmin(0);
?>

<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<textarea id="codesrc"><?php echo htmlspecialchars(implode('',file($g['path_tmp'].'backup/'.str_replace('/','_',str_replace('./','',$folder).getUTFtoKR($oldfile)).'.bak')))?></textarea>
<script type="text/javascript">
parent.document.getElementById('editboxarea').value = document.getElementById('codesrc').value;
alert('백업파일 소스를 새로 불러왔습니다.');
</script>

<?php exit?>