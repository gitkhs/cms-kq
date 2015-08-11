<?
	$usp = $usp ? $usp : 'view';
	$R = getDbData($table['s_stdpage'],'pid='.$_HM['id'].' and site='.$_HM['site'],'*');
	if ($usp == 'view') {
		if ($my['level'] < $R['level'])
			$usp = 'perm';
	}
	else {
		if ($my['level'] < $admin['admin'])
			$usp = 'perm';
	}

	require_once $g['path_page'].$mod.'/'.$usp.'.php';
?>