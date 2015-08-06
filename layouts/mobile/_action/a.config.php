<?php
if(!defined('__KIMS__')) exit;

checkAdmin(0);

$_tmpdfile = $g['path_layout'].$nowLayout.'/_var/_var.php';
$d['layout'] = array();
include $_tmpdfile;

$d['layout']['begin'] = 1;

if ($changeType == 'front')
{
	if ($d['layout']['mainType_layout']&&$mainType_layout)
	{
		for ($i = 1; $i < 4; $i++)
		{
			$d['layout']['bbs'.$i] = trim(${'bbs'.$i});
			$d['layout']['sort'.$i] = trim(${'sort'.$i});
			$d['layout']['bbs'.$i.'_name'] = stripslashes(trim(${'bbs'.$i.'_name'}));
			$d['layout']['bbs'.$i.'_namehide'] = trim(${'bbs'.$i.'_namehide'});
			$d['layout']['bbs'.$i.'_day'] = trim(${'bbs'.$i.'_day'});
			$d['layout']['bbs'.$i.'_num'] = trim(${'bbs'.$i.'_num'});
		}
	}
	$d['layout']['mainType_layout'] = $mainType_layout;
	$d['layout']['mainType_rb'] = $mainType_rb;
}

if ($changeType == 'detail')
{
	$tmpname	= $_FILES['upfile']['tmp_name'];
	$realname	= $_FILES['upfile']['name'];
	$fileExt	= strtolower(getExt($realname));
	$fileExt	= $fileExt == 'jpeg' ? 'jpg' : $fileExt;
	$photo		= 'logo.'.$fileExt;
	$saveFile1	= $g['path_layout'].$nowLayout.'/_var/'.$d['layout']['imglogo'];
	$saveFile2	= $g['path_layout'].$nowLayout.'/_var/'.$photo;

	if (is_uploaded_file($tmpname))
	{
		if (!strstr('[gif][jpg][png]',$fileExt))
		{
			getLink('','','gif/jpg/png 파일만 등록할 수 있습니다.','');
		}
		if (is_file($saveFile1))
		{
			unlink($saveFile1);
		}

		move_uploaded_file($tmpname,$saveFile2);
		@chmod($saveFile2,0707);
		$isize=getimagesize($saveFile2);

		$d['layout']['imglogo'] = $photo;
	}

	$d['layout']['title'] = trim($title);
	$d['layout']['title_color'] = $title_color;
	$d['layout']['imglogo_use'] = is_file($g['path_layout'].$nowLayout.'/_var/'.$d['layout']['imglogo']) ? $imglogo_use : 0;

	for ($i = 1; $i < 4; $i++)
	{
		$d['layout']['tmenu_'.$i] = ${'tmenu_'.$i};
		$d['layout']['tmenu_'.$i.'_text'] = ${'tmenu_'.$i.'_text'};
		$d['layout']['tmenu_'.$i.'_link'] = ${'tmenu_'.$i.'_link'};
	}
	$d['layout']['headerfix'] = $headerfix;
}

$fp = fopen($_tmpdfile,'w');
fwrite($fp, "<?php\n");
foreach ($d['layout'] as $key => $val)
{
	fwrite($fp, "\$d['layout']['".$key."'] = \"".$val."\";\n");
}
fwrite($fp, "?>");
fclose($fp);
@chmod($_tmpdfile,0707);

getLink('reload','parent.','','');
?>