<?
function getTPLname($fname)
{
	global $set1;
	$nName = $set1[$fname];
	return $nName ? $nName : $fname;
}
function getFILEname($fname)
{
	global $set2;
	$fexp = explode('.',$fname);
	$nName = $set2[str_replace('.'.$fexp[count($fexp)-1],'',$fname)];
	return $nName ? $nName.'.'.$fexp[count($fexp)-1] : getKRtoUTF($fname);
}
function getDirexists($dir)
{
    $opendir = opendir($dir);
    while(false !== ($file = readdir($opendir))) {
        if($file != '.' && $file != '..' && is_dir($dir.'/'.$file)){$fex = 1; break;}
    }
    closedir($opendir);
    return $fex;
}
function getPrintdir( $nTab, $filepath, $files, $state ,$dir_ex)
{
    global $g,$pwd,$file,$step_start,$iframe;
    
    if($step_start) { $nTab = $nTab - $step_start; }
	$css = strstr($pwd,$filepath) ? 'nowdir' : 'alldir';
	$fname1 = getFolderName($filepath);
	$fname2 = getTPLname($fname1);

    echo '<div class="dir01">';
    echo '<img src="'.$g['img_module_skin'].'/blank.gif" width="'.(($nTab*17)+3).'" height="1" alt="" /> ';
    echo '<a href="'.$g['adm_href'].'&amp;pwd='.urlencode($filepath).'" title="'.$fname1.'">';
    if($state && $dir_ex) {
        echo '<img src="'.$g['img_module_skin'].'/dir_closef.gif" align="absmiddle" alt="" />';
        echo ' <img src="'.$g['img_module_skin'].'/close_dir.gif" alt=""> <span class="'.$css.'">'.$fname2;
    }
    else if (!$state && $dir_ex) {
        echo '<img src="'.$g['img_module_skin'].'/dir_openf.gif" align="absmiddle" alt="" />';
        echo ' <img src="'.$g['img_module_skin'].'/open_dir.gif" alt=""> <span class="'.$css.'">'.$fname2;
    }
    else {
        echo '<img src="'.$g['img_module_skin'].'/blank.gif" width="11" height="18" align="absmiddle" alt="" />';
        echo ' <img src="'.$g['img_module_skin'].'/close_dir.gif" alt=""> <span class="'.$css.'">'.$fname2;
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
            if( @is_dir($subDir) && ($files != '.') && ($files != '..') )
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

function getPermision($file) 
{
    $p_bin = substr(decbin(@fileperms($file)), -9) ;
    $p_arr = explode(".", substr(chunk_split($p_bin, 1,"."), 0, 17)) ;
    $perms = ""; $i = 0;
    foreach ($p_arr as $thisx) { 
        $p_char = ( $i%3==0 ? "r" : ( $i%3==1 ? "w" :"x" ) ); 
        $perms .= ( $thisx=="1" ? $p_char : "-" ) . ($i%3==2 ? "" : "" );
        $i++;
    }
    return trim($perms);
}
function getFileuser($file,$stat) 
{
    if (function_exists('posix_getpwuid'))
	{
        $filestat = stat($file);
        $getname = posix_getpwuid($filestat[$stat]);
        return $getname['name'];
    }
    else {  
        return getKRtoUTF($_SERVER['USERNAME']?$_SERVER['USERNAME']:$_ENV['USERNAME']);
    }
}
?>