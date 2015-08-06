<?php
if(!defined('__KIMS__')) exit;

$iswpiinstall = false;
$wpivfile  = './wpi.var.php';
if (file_exists($wpivfile))
{
	$iswpiinstall = true;
	include_once $wpivfile;
}
$moduledir = array();
$_oldtable = array();
$_tmptable = array();
$_tmpdfile = $g['path_var'].'db.info.php';
$_tmptfile = $g['path_var'].'table.info.php';
include_once $g['path_core'].'function/sys.func.php';
include_once $g['path_core'].'function/db.mysql.func.php';
$date = getVDate(0);

if (is_file($_tmpdfile)) getLink('./','','','');

$DB_CONNECT = @mysql_connect($dbhost.':'.$dbport,$dbuser,$dbpass);
if (!$DB_CONNECT)
{
	echo '<script type="text/javascript">parent.isSubmit=false;parent.goStep(2);</script>';
	getLink('','','DB접속 유저네임이나 패스워드 혹은 포트가 정확하지 않습니다.','');
}
$DB_SELECT = @mysql_select_db($dbname,$DB_CONNECT);
if (!$DB_SELECT)
{
	echo '<script type="text/javascript">parent.isSubmit=false;parent.goStep(2);parent.procForm.dbname.focus();</script>';
	getLink('','','DB네임이 정확하지 않습니다.','');
}

$ISRBDB = db_fetch_array(db_query('select count(*) from '.$dbhead.'_s_module',$DB_CONNECT));
if ($ISRBDB[0])
{
	echo '<script type="text/javascript">parent.isSubmit=false;parent.goStep(2);parent.procForm.dbhead.focus();</script>';
	getLink('','','이미 동일한 테이블식별자로 킴스큐Rb용 DB가 생성되어 있습니다.    \n다른 테이블식별자를 사용해 주세요.','');
}

$fp = fopen($_tmpdfile,'w');
fwrite($fp, "<?php\n");
fwrite($fp, "\$DB['host'] = \"".$dbhost."\";\n");
fwrite($fp, "\$DB['name'] = \"".$dbname."\";\n");
fwrite($fp, "\$DB['user'] = \"".$dbuser."\";\n");
fwrite($fp, "\$DB['pass'] = \"".$dbpass."\";\n");
fwrite($fp, "\$DB['head'] = \"".$dbhead."\";\n");
fwrite($fp, "\$DB['port'] = \"".$dbport."\";\n");
fwrite($fp, "\$DB['type'] = \"".$dbtype."\";\n");
fwrite($fp, "?>");
fclose($fp);
@chmod($_tmpdfile,0707);
$DB['type'] = $dbtype;
$DB['head'] = $dbhead;

if (is_file($_tmptfile)) 
{
	include_once $_tmptfile;
	$_oldtable = $table;
}

$dirh = opendir($g['path_module']); 
while(false !== ($_file = readdir($dirh))) 
{ 
	if($_file == '.' || $_file == '..') continue;

	if(is_file($g['path_module'].$_file.'/_setting/db.table.php')) 
	{	
		$table = array();
		$module= $_file;
		include_once $g['path_module'].$_file.'/_setting/db.table.php';
		include_once $g['path_module'].$_file.'/_setting/db.schema.php';

		foreach($table as $key => $val) $_tmptable[$key] = $val;
		rename($g['path_module'].$_file.'/_setting/db.table.php',$g['path_module'].$_file.'/_setting/db.table.php.done');

		$moduledir[$_file] = array($_file,count($table));
	}
	else {
		$moduledir[$_file] = array($_file,0);
	}
} 
closedir($dirh);

$fp = fopen($_tmptfile,'w');
fwrite($fp, "<?php\n");
foreach($_oldtable as $key => $val)
{
	if (!$_tmptable[$key])
	{
		fwrite($fp, "\$table['$key'] = \"$val\";\n");
	}
}
foreach($_tmptable as $key => $val)
{
	fwrite($fp, "\$table['$key'] = \"$val\";\n");
}
fwrite($fp, "?>");
fclose($fp);
@chmod($_tmptfile,0707);

include $_tmptfile;

$gid = 0;

$mdlarray = array('home','layout','module','market','admin','member','bbs','comment','upload');
foreach($mdlarray as $_val)
{
	$QUE = "insert into ".$table['s_module']." 
	(gid,system,hidden,mobile,name,id,tblnum,d_regis) 
	values 
	('".$gid."','1','0','1','".getFolderName($g['path_module'].$moduledir[$_val][0])."','".$moduledir[$_val][0]."','".$moduledir[$_val][1]."','".$date['totime']."')";
	db_query($QUE,$DB_CONNECT);
	$gid++;
}

$mdlarray = array('popup','filemanager','dbmanager','mobile','domain','counter','search','widget','tag','trackback','editor','rewrite','zipsearch');

foreach($mdlarray as $_val)
{
	$QUE = "insert into ".$table['s_module']." 
	(gid,system,hidden,mobile,name,id,tblnum,d_regis) 
	values 
	('".$gid."','".(strstr('[counter][widget][tag][rewrite]','['.$_val.']')?0:1)."','".(strstr('[rewrite][zipsearch]','['.$_val.']')?1:0)."','".(strstr('[rewrite][zipsearch]','['.$_val.']')?0:1)."','".getFolderName($g['path_module'].$moduledir[$_val][0])."','".$moduledir[$_val][0]."','".$moduledir[$_val][1]."','".$date['totime']."')";
	db_query($QUE,$DB_CONNECT);
	$gid++;
}

$siteid = 'home';
$QKEY = "gid,id,name,title,titlefix,icon,layout,startpage,m_layout,m_startpage,lang,open,dtd,nametype,timecal,rewrite,buffer,usescode,headercode,footercode";
$QVAL = "'0','".$siteid."','$sitename','$sitename','0','1.png','$layout','1','mobile/main.php','9','$sitelang','1','xhtml_1','nic','0','0','0','0','',''";
getDbInsert($table['s_site'],$QKEY,$QVAL);
db_query("OPTIMIZE TABLE ".$table['s_site'],$DB_CONNECT); 


$pagesarray = array
(
	'main'=>array('메인화면','3',''),
	'join'=>array('회원가입','1','./?m=member&front=join'),
	'login'=>array('로그인','1','./?m=member&front=login'),
	'mypage'=>array('마이페이지','1','./?m=member&front=mypage'),
	'search'=>array('통합검색','1','./?m=search'),
	'agreement'=>array('홈페이지 이용약관','3',''),
	'private'=>array('개인정보 취급방침','3',''),
	'postrule'=>array('게시물 게재원칙','3','')
);

$maincontent = '<iframe src="http://docs.kimsq.com/guide/rb/defaultPage_kr.php'.($iswpiinstall?'?wpi=Y':'').'" width="100%" height="650" frameborder="0" scrolling="no" allowTransparency="true"></iframe>';

foreach($pagesarray as $_key => $_val)
{
	$QUE = "insert into ".$table['s_page']." 
	(pagetype,ismain,mobile,id,category,name,perm_g,perm_l,layout,joint,hit,d_regis,d_update)
	values
	('$_val[1]','".($_key=='main'?1:0)."','".($_key=='main'?1:0)."','$_key','기본페이지','$_val[0]','','0','','$_val[2]','0','".$date['totime']."','')";
	db_query($QUE,$DB_CONNECT);

	$mfile = $g['path_page'].$_key.'.php';
	$fp = fopen($mfile,'w');
	fwrite($fp,($_key=='main'?$maincontent:$_val[0]));
	fclose($fp);
	@chmod($mfile,0707);
	$mfile = $g['path_page'].$_key.'.widget.php';
	$fp = fopen($mfile,'w');
	fwrite($fp,'');
	fclose($fp);
	@chmod($mfile,0707);
}


$QUE = "insert into ".$table['s_page']." 
(pagetype,ismain,mobile,id,category,name,perm_g,perm_l,layout,joint,hit,sosokmenu,d_regis,d_update)
values
('3','0','1','main_mobile','모바일페이지','메인화면','','0','','','0','','".$date['totime']."','')";
db_query($QUE,$DB_CONNECT);

$mobilemaincontent = '<h3 style="border-bottom:#dfdfdf dotted 2px;padding:0 0 10px 0;font-size:13px;">'."\n";
$mobilemaincontent.= '<img src="<?php echo $g[\'img_core\']?>/_public/ico_notice.gif" alt="" style="position:relative;top:2px;left:-2px;" />모바일 웹사이트가 개설되었습니다'."\n";
$mobilemaincontent.= '</h3>'."\n\n";
$mobilemaincontent.= '<p style="color:#666666;line-height:150%;padding:0 0 0 5px;">'."\n";
$mobilemaincontent.= '손님께서는 모바일기기(<?php echo $g[\'mobile\']?>)로 접속하셨습니다.<br />'."\n";
$mobilemaincontent.= '이 페이지는 모바일 메인페이지의 전시내용을 변경하거나 편집을 통해 변경할 수 있습니다.<br />'."\n";
$mobilemaincontent.= '자세한 것은 킴스큐Rb 모바일 웹사이트 관련 매뉴얼을 참고하세요.'."\n";
$mobilemaincontent.= '</p>'."\n\n";
$mobilemaincontent.= '<p style="text-align:right;padding:20px 10px 0 0;font-size:11px;color:#c0c0c0;">'."\n";
$mobilemaincontent.= 'Powered by kimsQ<span style="color:#ff0000;font-weight:bold;">Rb</span>'."\n";
$mobilemaincontent.= '</p>'."\n";

$mfile = $g['path_page'].'main_mobile.php';
$fp = fopen($mfile,'w');
fwrite($fp,$mobilemaincontent);
fclose($fp);
@chmod($mfile,0707);
$mfile = $g['path_page'].'main_mobile.widget.php';
$fp = fopen($mfile,'w');
fwrite($fp,'');
fclose($fp);
@chmod($mfile,0707);

db_query("insert into ".$table['s_mbrid']." (site,id,pw)values('1','$id','".md5($pw1)."')",$DB_CONNECT);
$QUE = "insert into ".$table['s_mbrdata']." 
(memberuid,site,auth,sosok,level,comp,admin,adm_view,
email,name,nic,grade,photo,home,sex,birth1,birth2,birthtype,tel1,tel2,zip,
addr0,addr1,addr2,job,marr1,marr2,sms,mailing,smail,point,usepoint,money,cash,num_login,pw_q,pw_a,now_log,last_log,last_pw,is_paper,d_regis,tmpcode,sns,addfield)
values
('1','1','1','1','1','0','1','',
'$email','$name','관리자','','','','0','0','0','0','','','',
'','','','','0','0','1','1','0','0','0','0','0','1','킴스큐 설치시에 입력한 회원비밀번호는?','$pw1','1','".$date['totime']."','".$date['today']."','0','".$date['totime']."','','','')";
db_query($QUE,$DB_CONNECT);

$sosokset = array('A그룹','B그룹','C그룹','D그룹','E그룹','F그룹','G그룹','H그룹');
$i = 0;
foreach ($sosokset as $_val)
{
	getDbInsert($table['s_mbrgroup'],'gid,name,num',"'".$i."','".$_val."','".(!$i?1:0)."'");
	$i++;
}
for ($i = 1; $i < 101; $i++)
{
	getDbInsert($table['s_mbrlevel'],'gid,name,num,login,post,comment',"'".($i==20?1:0)."','레벨".$i."','".($i==1?1:0)."','0','0','0'");
}

setcookie('svshop', $id.'|'.$pw1, time()+60*60*24*30, '/');

$_SESSION['mbr_uid'] = 1;
$_SESSION['mbr_pw']  = md5($pw1);

$fp = fopen($g['path_module'].'admin/var/users/'.$id.'.widget.php','w');
fwrite($fp,'');
fclose($fp);
@chmod($g['path_module'].'admin/var/users/'.$id.'.widget.php',0707);


if ($iswpiinstall)
{
	unlink($wpivfile);
	getLink('./','','설치가 완료되었습니다. 홈페이지로 이동합니다.','');
}

getLink('./','parent.','설치가 완료되었습니다. 홈페이지로 이동합니다.','');
?>