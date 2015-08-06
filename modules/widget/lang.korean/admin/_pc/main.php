<?php 

$step_start = 1;
$pwd_start = $g['path_widget'];

if ($option)
{
	$wdgvar=array();
	$swval=explode(',',getKRtoUTF(urldecode(str_replace('[!]','&',$option))));
	$swidget=$swval[0];
	$pwd = $pwd_start.$swidget.'/';

	foreach($swval as $_cval)
	{
		$_xval=explode('^',$_cval);
		$wdgvar[$_xval[0]]=$_xval[1];
	}
}
else {
	$pwd = $pwd ? urldecode($pwd) : $pwd_start;
	$swidget = is_file($pwd.'main.php') ? str_replace($g['path_widget'],'',$pwd) : '';
	if ($swidget) $swidget = substr($swidget,0,strlen($swidget)-1);
}


if (strstr($pwd,'..'))
{
    getLink('','','정상적인 접근이 아닙니다.','close');
}
if(!is_dir($pwd))
{
	getLink('','','존재하지 않는 폴더입니다.','close');
}

function getDirexists($dir)
{
    $opendir = opendir($dir);
    while(false !== ($file = readdir($opendir)))
	{
        if(is_dir($dir.'/'.$file) && !strstr('[.][..][image][data]',$file)){$fex = 1; break;}
    }
    closedir($opendir);
    return $fex;
}
function getPrintdir( $nTab, $filepath, $files, $state ,$dir_ex)
{
    global $g,$pwd,$file,$step_start;
    
    if($step_start) { $nTab = $nTab - $step_start; }
	$css = strstr($pwd,$filepath) ? 'nowdir' : 'alldir';
	$fname1 = getKRtoUTF($files);
	$fname2 = getFolderName($filepath);

	if (is_file($filepath.'main.php'))
	{
		$img_cdir = $g['img_module_admin'].'/ico_widget.gif';
		$img_odir = $g['img_core'].'/_public/ico_f1.png';
	}
	else {
		$img_cdir = $g['img_module_admin'].'/close_dir.gif';
		$img_odir = $g['img_module_admin'].'/open_dir.gif';
	}

    echo '<div class="dir01">';
    echo '<img src="'.$g['img_module_admin'].'/blank.gif" width="'.(($nTab*17)+3).'" height="1" alt="" /> ';
    echo '<a href="'.$g['adm_href'].'&amp;pwd='.urlencode($filepath).'" title="'.$fname1.'">';
    if($state && $dir_ex) {
        echo '<img src="'.$g['img_module_admin'].'/dir_closef.gif" align="absmiddle" alt="" />';
        echo ' <img src="'.$img_cdir.'" alt="" /> <span class="'.$css.'">'.$fname2;
    }
    else if (!$state && $dir_ex) {
        echo '<img src="'.$g['img_module_admin'].'/dir_openf.gif" align="absmiddle" alt="" />';
        echo ' <img src="'.$img_odir.'" alt="" /> <span class="'.$css.'">'.$fname2;
    }
    else {
        echo '<img src="'.$g['img_module_admin'].'/blank.gif" width="11" height="18" align="absmiddle" alt="" />';
        echo ' <img src="'.$img_cdir.'" alt="" /> <span class="'.$css.'">'.$fname2;
    }
    echo '</span></a></div>';
}
function getDirlist($dirpath,$nStep)
{
    global $pwd;
    $arrPath = explode('/', $pwd );

    if( $dir_handle = opendir($dirpath) )
    {
        while( false !== ($files = readdir($dir_handle)) )
        {
            $subDir = $dirpath.$files.'/';
            if(is_dir($subDir) && !strstr('[.][..][image][data]',$files))
            {
                getPrintdir( $nStep, $subDir, $files, !strstr($pwd,$subDir) , getDirexists($subDir) );
                if( $arrPath[$nStep+1] == $files ) {
                    getDirlist( $subDir, $nStep+1);
                }
            }
        }
    }
    closedir( $dir_handle );
}
?>



<div id="catebody">
	<div id="category">

		<div class="title">
			위젯리스트
			<span class="add">
			<a href="<?php echo $g['adm_href']?>&amp;widgetAdd=Y" title="위젯분류추가"><img src="<?php echo $g['img_core']?>/_public/ico_folder.gif" alt="" /></a>
			<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $m?>&amp;module=market&amp;front=pack&amp;type=widget" title="위젯추가"><img src="<?php echo $g['img_core']?>/_public/btn_add.gif" alt="추가" /></a>
			<a class="hand" onclick="OpenWindow('<?php echo $g['s']?>/?r=<?php echo $r?>&system=popup.widget&iframe=Y&isWcode=Y');"><img src="<?php echo $g['img_core']?>/_public/btn_code.gif" alt="위젯코드" title="위젯코드" /></a>
			</span>
		</div>
		
		<div class="tree">
		<?php getDirlist($pwd_start,$step_start)?>
		</div>

	</div>


	<div id="catinfo">

		<?php if($widgetAdd):?>

		<form name="procForm" action="<?php echo $g['s']?>/" method="post" target="_action_frame_<?php echo $m?>" onsubmit="return saveCheck(this);">
		<input type="hidden" name="r" value="<?php echo $r?>" />
		<input type="hidden" name="m" value="<?php echo $module?>" />
		<input type="hidden" name="a" value="regisfolder" />


		<div class="title">
			<div class="xleft">
				<span class="b">위젯분류추가</span>
			</div>
			<div class="xright">
			</div>
			<div class="clear"></div>
		</div>


		<div class="notice">
			관리가 편하도록 위젯분류를 적절히 지정하여 등록해 주세요.<br />
			위젯분류 폴더명은 영문소문자+숫자+_ 조합만 사용할 수 있습니다.
		</div>


		<table>
			<tr>
				<td class="td1">
					분류명칭
				</td>
				<td class="td2">
					<input type="text" name="name" value="" class="input sname" />
				</td>
			</tr>
			<tr>
				<td class="td1">
					폴더명칭
				</td>
				<td class="td2 shift">
					<input type="text" name="folder" value="" class="input sname" />
				</td>
			</tr>
		</table>

		<div class="submitbox">
			<input type="submit" class="btnblue" value="위젯분류등록" />
		</div>

		</form>


		<?php else:?>
		<div class="title">
			<div class="xleft">
				<span class="b">위젯안내</span> (<?php echo getFolderName($pwd)?>)
			</div>
			<div class="xright">
				<?php if($pwd != './widgets/'):?>
				<a href="<?php echo $g['s']?>/?r=<?php echo $r?>&amp;m=<?php echo $module?>&amp;a=widget_delete&amp;pwd=<?php echo $pwd?>" target="_action_frame_<?php echo $m?>" onclick="return confirm('정말로 이 위젯을 삭제하시겠습니까?       ');">위젯삭제</a>
				<?php endif?>
			</div>
			<div class="clear"></div>
		</div>
		
		<?php if($pwd == './widgets/'):?>
		<div class="none">
			<img src="<?php echo $g['img_core']?>/_public/ico_notice.gif" alt="" />
			위젯을 선택하시면 위젯 안내문서를 확인할 수 있습니다.
		</div>
		<?php else:?>
			<?php if(is_file($pwd.'main.php')):?>
				<?php if(is_file($pwd.'readme.txt')):?>
					<div class="guide">
					<textarea rows="10" cols="100"><?php readfile($pwd.'readme.txt')?></textarea>
					</div>
				<?php else:?>
					<div class="none">
						<img src="<?php echo $g['img_core']?>/_public/ico_notice.gif" alt="" />
						이 위젯은 안내문서를 제공하지 않습니다.
					</div>
				<?php endif?>
			<?php else:?>
				<div class="none">
					<img src="<?php echo $g['img_core']?>/_public/ico_notice.gif" alt="" />
					위젯분류 폴더입니다. 위젯을 선택해 주세요.
				</div>
			<?php endif?>
		<?php endif?>
		<?php endif?>
		
	</div>
	<div class="clear"></div>
</div>





<script type="text/javascript">
//<![CDATA[
function saveCheck(f)
{
	if (f.name.value == '')
	{
		alert('분류명을 입력해 주세요.   ');
		f.name.focus();
		return false;
	}
	if (f.folder.value == '')
	{
		alert('폴더명을 입력해 주세요.   ');
		f.folder.focus();
		return false;
	}
	if (!chkIdValue(f.folder.value))
	{
		alert('폴더명은 영문소문자,숫자,_만 사용할 수 있습니다.      ');
		f.folder.focus();
		return false;
	}

	return confirm('정말로 실행하시겠습니까?    ');
}
//]]>
</script>


