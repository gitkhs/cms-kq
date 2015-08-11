<?
//include_once $g['dir_module_skin'].'_function.php';
include_once $g['dir_module_skin'].'libs/function.php';

$step_start = 1;
$pwd_start = './files/';
$pwd = $pwd ? urldecode($pwd) : $pwd_start;
$tdir = str_replace('./','',$pwd);
$g['adm_href'] = $g['s'].'/?r='.$r.'&amp;m=setting&amp;mod=admin&amp;div=upfile&amp;winmod='.$winmod;

$path	= str_replace('/www','',$_SERVER['DOCUMENT_ROOT']);
$tmp	= shell_exec("du -s -h {$path}");
$hdsize	= substr($tmp, 0, strpos($tmp,"\t"));
$webid	= substr($path,strrpos($path,'/')+1);
?>

<div id="upfile">
	<table class="tbl-none">
	<colgroup>
	<col width="120">
	<col>
	</colgroup>
	<tr>
		<td class="tl lnt lnb c">하드 사용량</td>
		<td class="td lnt lnb"><div class="row"><b><?=$hdsize?></b> 사용중입니다.</div></td>
	</tr>
	</table>

	<table class="tbl-form">
	<tr>
		<td class="dir"><? // 디릭토리 목록 ?>
			<div class="title">
				<div><a href="<?=$g['adm_href']?>">디렉토리</a></div>
				<div class="clear"></div>
			</div>

			<div class="tree">
				<div class="dir01">
					<img src="<?=$g['img_module_skin']?>/blank.gif" width="3" height="1" alt="">
					<a href="<?=$g['adm_href']?>" title="..">
						<img src="<?=$g['img_module_skin']?>/close_dir.gif" alt=""> <span class="<?=$pwd == './files/' ? 'nowdir' : 'alldir'?>">/ 디렉토리 (최상위)</span>
					</a>
				</div>
			<?php getDirlist($pwd_start,$step_start)?>
			</div>
		</td>

		<td class="file"><? // 게시판 본문 관리 ?>
		<? if($pwd != './files/'){ ?>
		<div class="row" style="padding:10px; border-bottom:1px solid #dddddd;">
			<form name="frmFile" method="post" action="<?=$g['s']?>/" target="_action_frame_<?=$m?>">
			<input type="hidden" name="r" value="<?=$r?>" />
			<input type="hidden" name="m" value="<?=$m?>" />
			<input type="hidden" name="a" value="<?=$mod?>" />
			<input type="hidden" name="mod" value="<?=$mod?>" />
			<input type="hidden" name="div" value="<?=$div?>" />
			<input type="hidden" name="folder" value="<?=$pwd?>" />
			<input type="hidden" name="actid" value="" />
			
			<div class="row">
				<input type="button" class="btnorange" value="현재폴더 내려받기" onclick="$('input[name=actid]').val('getFile');$('form[name=frmFile]').submit();">
				현재 폴더의 자료를 압축 파일 형태로 내려 받습니다.
			</div>
			<div class="row">
				<input type="button" class="btnkhaki" value="파일 목록 받기" onclick="$('input[name=actid]').val('getList');$('form[name=frmFile]').submit();">
				전체 파일에 대한 파일명 및 폴더에 대한 목록을 엑셀로 내려 받습니다.
			</div>
			</form>
		</div>
		<? } ?>

		<?
			$files1 = array();
			$dirs = opendir($pwd);
			$i=0;
			while(false !== ($tpl = readdir($dirs)))
			{
				if(!is_file($pwd.$tpl)) continue;
				$files[] = $tpl;
				$i++;
			}
			if($files)	sort($files);
			closedir($dirs);
			$p = $p ? $p : 1;
			$recnum = 20;
			$filenum = count($files);
			$TPG = intval(($filenum)/$recnum)+1;
		?>

			<table class="tbl-none flst">
			<colgroup>
			<col width="40">
			<col>
			<col width="80">
			<col width="80">
			<col width="55">
			</colgroup>
			<tr>
				<td class="th">번호</td>
				<td class="th">파일명</td>
				<td class="th">용량</td>
				<td class="th">크기(px)</td>
				<td class="th">&nbsp;</td>
			</tr>
			<?php $j=0;for($i=($p-1)*$recnum;$i<=($p-1)*$recnum+$recnum-1;$i++):if ($files[$i]):$j++?>
			<?php $file_ext=strtolower(getExt($files[$i]))?>
			<?php $file_ext=strlen($file_ext)<5?$file_ext:'txt'?>
			<?php $IM=array();if(strstr('jpeg,jpg,gif,png,swf,ico',strtolower($file_ext)))$IM=getimagesize($tdir.$files[$i])?>

			<tr>
				<td class="tc c"><?php echo ($filenum-$i)?></td>
				<td class="tc">
					<img src="<?php echo $g['img_core']?>/file/small/<?php echo is_file($g['path_core'].'image/file/small/'.$file_ext.'.gif')?$file_ext:'unknown'?>.gif" alt="<?php echo $file_ext?>" />
					<a href="#" <?php if(strstr('jpeg,jpg,gif,png,swf,ico',$file_ext)):?> onmouseover="imgShow('<?=$tdir?>',this,<?=$IM[0]?>,event);" onmouseout="imgHide();"<?php endif?> title="<?php echo getKRtoUTF($files[$i])?>" onclick="return false;"><?php echo getFILEname($files[$i])?></a>
				</td>
				<td class="tc r"><?php echo getSizeFormat(filesize($tdir.$files[$i]),1)?></td>
				<td class="tc c">
					<?php if($IM[0]):?><?php echo $IM[0]?>*<?php echo $IM[1]?><?else:?>&nbsp;<?php endif?>
				</td>
				<td class="tc">
					<?php if(strstr('jpeg,jpg,gif,png,ico',$file_ext)):?>
					<input type="button" class="btnnavy" value="보기" onclick="imgOrignWin('<?php echo $g['url_root']?>/<?php echo $tdir.getKRtoUTF($files[$i])?>');">
					<?else:?>
					&nbsp;
					<?php endif?>
				</td>
				</tr>
				<?php endif;endfor?>
				<?php if(!$j):?>
				<tr>
					<td class="tc c" colspan="5">선택된 폴더내에 파일이 없습니다.</td>
				</tr>
				<?php endif?>
			</table>

			<div class="pagerbox">
				<div class="pagebox01">
				<script type="text/javascript">getPageLink(10,<?php echo $p?>,<?php echo $TPG?>,'<?php echo $g['img_core']?>/page/default');</script>
				</div>
			</div>
		</td>
	</tr>
	</table>
		
	<div id="hImg"></div>
</div>
