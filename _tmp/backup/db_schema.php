<?php
	$fp = fopen('_var/db.info.php','w');
	fwrite($fp, "<?php\n");
	fwrite($fp, "\$DB['host'] = \"".$db_host."\";\n");
	fwrite($fp, "\$DB['name'] = \"".$db_name."\";\n");
	fwrite($fp, "\$DB['user'] = \"".$db_user."\";\n");
	fwrite($fp, "\$DB['pass'] = \"".$db_pass."\";\n");
	fwrite($fp, "\$DB['head'] = \"".$db_head."\";\n");
	fwrite($fp, "\$DB['port'] = \"".$db_port."\";\n");
	fwrite($fp, "\$DB['type'] = \"MyISAM\";\n");
	fwrite($fp, "?>");
	fclose($fp);

	$fp = fopen('_var/table.info.php','w');
	fwrite($fp, "<?php\n");
	fwrite($fp, "\$table['s_module'] = \"".$db_head."_s_module\";\n");
	fwrite($fp, "\$table['s_admpage'] = \"".$db_head."_s_adminpage\";\n");
	fwrite($fp, "\$table['s_mobile'] = \"".$db_head."_s_mobile\";\n");
	fwrite($fp, "\$table['s_domain'] = \"".$db_head."_s_domain\";\n");
	fwrite($fp, "\$table['s_menu'] = \"".$db_head."_s_menu\";\n");
	fwrite($fp, "\$table['s_page'] = \"".$db_head."_s_page\";\n");
	fwrite($fp, "\$table['s_site'] = \"".$db_head."_s_site\";\n");
	fwrite($fp, "\$table['s_popup'] = \"".$db_head."_s_popup\";\n");
	fwrite($fp, "\$table['s_mbrid'] = \"".$db_head."_s_mbrid\";\n");
	fwrite($fp, "\$table['s_mbrdata'] = \"".$db_head."_s_mbrdata\";\n");
	fwrite($fp, "\$table['s_mbrcomp'] = \"".$db_head."_s_mbrcomp\";\n");
	fwrite($fp, "\$table['s_mbrlevel'] = \"".$db_head."_s_mbrlevel\";\n");
	fwrite($fp, "\$table['s_mbrgroup'] = \"".$db_head."_s_mbrgroup\";\n");
	fwrite($fp, "\$table['s_mbrsns'] = \"".$db_head."_s_mbrsns\";\n");
	fwrite($fp, "\$table['s_scrap'] = \"".$db_head."_s_scrap\";\n");
	fwrite($fp, "\$table['s_paper'] = \"".$db_head."_s_paper\";\n");
	fwrite($fp, "\$table['s_friend'] = \"".$db_head."_s_friend\";\n");
	fwrite($fp, "\$table['s_point'] = \"".$db_head."_s_point\";\n");
	fwrite($fp, "\$table['s_cash'] = \"".$db_head."_s_cash\";\n");
	fwrite($fp, "\$table['s_money'] = \"".$db_head."_s_money\";\n");
	fwrite($fp, "\$table['s_simbol'] = \"".$db_head."_s_simbol\";\n");
	fwrite($fp, "\$table['s_counter'] = \"".$db_head."_s_counter\";\n");
	fwrite($fp, "\$table['s_referer'] = \"".$db_head."_s_referer\";\n");
	fwrite($fp, "\$table['s_browser'] = \"".$db_head."_s_browser\";\n");
	fwrite($fp, "\$table['s_inkey'] = \"".$db_head."_s_inkey\";\n");
	fwrite($fp, "\$table['s_outkey'] = \"".$db_head."_s_outkey\";\n");
	fwrite($fp, "\$table['s_upload'] = \"".$db_head."_s_upload\";\n");
	fwrite($fp, "\$table['s_comment'] = \"".$db_head."_s_comment\";\n");
	fwrite($fp, "\$table['s_oneline'] = \"".$db_head."_s_oneline\";\n");
	fwrite($fp, "\$table['s_numinfo'] = \"".$db_head."_s_numinfo\";\n");
	fwrite($fp, "\$table['s_tag'] = \"".$db_head."_s_tag\";\n");
	fwrite($fp, "\$table['s_trackback'] = \"".$db_head."_s_trackback\";\n");
	fwrite($fp, "\$table['s_seo'] = \"".$db_head."_s_seo\";\n");
	fwrite($fp, "\$table['s_xtralog'] = \"".$db_head."_s_xtralog\";\n");
	fwrite($fp, "\$table['bbslist'] = \"".$db_head."_bbs_list\";\n");
	fwrite($fp, "\$table['bbsidx'] = \"".$db_head."_bbs_index\";\n");
	fwrite($fp, "\$table['bbsdata'] = \"".$db_head."_bbs_data\";\n");
	fwrite($fp, "\$table['bbsmonth'] = \"".$db_head."_bbs_month\";\n");
	fwrite($fp, "\$table['bbsday'] = \"".$db_head."_bbs_day\";\n");
	fwrite($fp, "\$table['bbsxtra'] = \"".$db_head."_bbs_xtra\";\n");
	fwrite($fp, "\$table['s_stdpage'] = \"".$db_head."_s_stdpage\";\n");
	fwrite($fp, "?>");
	fclose($fp);


	require './_var/db.info.php';
	require './_var/table.info.php';
	require './_core/function/db.mysql.func.php';
	require './_core/function/sys.func.php';

	$DB_CONNECT = isConnectDb($DB);

//모듈리스트
$_tmp = db_query( "select count(*) from ".$table['s_module'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_module']." (
gid			INT				DEFAULT '0'		NOT NULL,
system		TINYINT			DEFAULT '0'		NOT NULL,
hidden		TINYINT			DEFAULT '0'		NOT NULL,
mobile		TINYINT			DEFAULT '0'		NOT NULL,
name		VARCHAR(200)	DEFAULT ''		NOT NULL,
id			VARCHAR(30)		DEFAULT ''		NOT NULL,
tblnum		INT				DEFAULT '0'		NOT NULL,
d_regis		VARCHAR(14)		DEFAULT ''		NOT NULL,
KEY gid(gid),
KEY system(system),
KEY hidden(hidden),
KEY mobile(mobile),
KEY id(id)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_module'],$DB_CONNECT); 
}
//관리자즐겨찾는페이지
$_tmp = db_query( "select count(*) from ".$table['s_admpage'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_admpage']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
memberuid	INT				DEFAULT '0'		NOT NULL,
gid			INT				DEFAULT '0'		NOT NULL,
name		VARCHAR(200)	DEFAULT ''		NOT NULL,
url			VARCHAR(200)	DEFAULT ''		NOT NULL,
KEY memberuid(memberuid),
KEY gid(gid)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_admpage'],$DB_CONNECT); 
}

//모바일
$_tmp = db_query( "select count(*) from ".$table['s_mobile'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_mobile']." (
usemobile	TINYINT			DEFAULT '0'		NOT NULL,
startsite	INT				DEFAULT '0'		NOT NULL,
startdomain	VARCHAR(50)		DEFAULT ''		NOT NULL
) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_mobile'],$DB_CONNECT); 
}

//도메인
$_tmp = db_query( "select count(*) from ".$table['s_domain'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_domain']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
gid			INT				DEFAULT '0'		NOT NULL,
isson		TINYINT			DEFAULT '0'		NOT NULL,
parent		INT				DEFAULT '0'		NOT NULL,
depth		TINYINT			DEFAULT '0'		NOT NULL,
name		VARCHAR(100)	DEFAULT ''		NOT NULL,
site		INT				DEFAULT '0'		NOT NULL,
KEY gid(gid),
KEY parent(parent),
KEY depth(depth),
KEY name(name),
KEY site(site)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_domain'],$DB_CONNECT); 
}

//사이트
$_tmp = db_query( "select count(*) from ".$table['s_site'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_site']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
gid			INT				DEFAULT '0'		NOT NULL,
id			VARCHAR(20)		DEFAULT ''		NOT NULL,
name		VARCHAR(50)		DEFAULT ''		NOT NULL,
title		VARCHAR(100)	DEFAULT ''		NOT NULL,
titlefix	TINYINT			DEFAULT '0'		NOT NULL,
icon		VARCHAR(50)		DEFAULT ''		NOT NULL,
layout		VARCHAR(50)		DEFAULT ''		NOT NULL,
startpage	INT				DEFAULT '0'		NOT NULL,
theme		VARCHAR(10)		DEFAULT ''		NOT NULL,
m_layout	VARCHAR(50)		DEFAULT ''		NOT NULL,
m_startpage	INT				DEFAULT '0'		NOT NULL,
lang		VARCHAR(20)		DEFAULT ''		NOT NULL,
open		TINYINT			DEFAULT '0'		NOT NULL,
dtd			VARCHAR(10)		DEFAULT ''		NOT NULL,
nametype	VARCHAR(5)		DEFAULT ''		NOT NULL,
timecal		TINYINT			DEFAULT '0'		NOT NULL,
rewrite		TINYINT			DEFAULT '0'		NOT NULL,
buffer		TINYINT			DEFAULT '0'		NOT NULL,
usescode	TINYINT			DEFAULT '0'		NOT NULL,
headercode	TEXT			NOT NULL,
footercode	TEXT			NOT NULL,
KEY gid(gid),
KEY id(id),
KEY open(open)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_site'],$DB_CONNECT); 
}

//메뉴
$_tmp = db_query( "select count(*) from ".$table['s_menu'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_menu']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
gid			INT				DEFAULT '0'		NOT NULL,
site		INT				DEFAULT '0'		NOT NULL,
isson		TINYINT			DEFAULT '0'		NOT NULL,
parent		INT				DEFAULT '0'		NOT NULL,
depth		TINYINT			DEFAULT '0'		NOT NULL,
id			VARCHAR(50)		DEFAULT ''		NOT NULL,
menutype	TINYINT			DEFAULT '0'		NOT NULL,
mobile		TINYINT			DEFAULT '0'		NOT NULL,
app			TINYINT			DEFAULT '0'		NOT NULL,
hidden		TINYINT			DEFAULT '0'		NOT NULL,
reject		TINYINT			DEFAULT '0'		NOT NULL,
name		VARCHAR(50)		DEFAULT ''		NOT NULL,
target		VARCHAR(20)		DEFAULT ''		NOT NULL,
redirect	TINYINT			DEFAULT '0'		NOT NULL,
joint		VARCHAR(250)	DEFAULT ''		NOT NULL,
perm_g		VARCHAR(200)	DEFAULT ''		NOT NULL,
perm_l		TINYINT			DEFAULT '0'		NOT NULL,
layout		VARCHAR(50)		DEFAULT ''		NOT NULL,
imghead		VARCHAR(100)	DEFAULT ''		NOT NULL,
imgfoot		VARCHAR(100)	DEFAULT ''		NOT NULL,
puthead		TINYINT			DEFAULT '0'		NOT NULL,
putfoot		TINYINT			DEFAULT '0'		NOT NULL,
num			INT				DEFAULT '0'		NOT NULL,
d_last		VARCHAR(14)		DEFAULT ''		NOT NULL,
addinfo		TEXT			NOT NULL,
KEY gid(gid),
KEY site(site),
KEY parent(parent),
KEY depth(depth),
KEY id(id),
KEY mobile(mobile),
KEY app(app),
KEY hidden(hidden)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_menu'],$DB_CONNECT); 
}

//페이지
$_tmp = db_query( "select count(*) from ".$table['s_page'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_page']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
pagetype	TINYINT			DEFAULT '0'		NOT NULL,
ismain		TINYINT			DEFAULT '0'		NOT NULL,
mobile		TINYINT			DEFAULT '0'		NOT NULL,
id			VARCHAR(50)		DEFAULT ''		NOT NULL,
category	VARCHAR(50)		DEFAULT ''		NOT NULL,
name		VARCHAR(200)	DEFAULT ''		NOT NULL,
perm_g		VARCHAR(200)	DEFAULT ''		NOT NULL,
perm_l		TINYINT			DEFAULT '0'		NOT NULL,
layout		VARCHAR(50)		DEFAULT ''		NOT NULL,
joint		VARCHAR(250)	DEFAULT ''		NOT NULL,
hit			INT				DEFAULT '0'		NOT NULL,
sosokmenu	VARCHAR(100)	DEFAULT ''		NOT NULL,
d_regis		VARCHAR(14)		DEFAULT ''		NOT NULL,
d_update	VARCHAR(14)		DEFAULT ''		NOT NULL,
KEY ismain(ismain),
KEY mobile(mobile),
KEY id(id),
KEY category(category)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_page'],$DB_CONNECT); 
}


// 팝업
$_tmp = db_query( "select count(*) from ".$table['s_popup'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_popup']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
hidden		TINYINT			DEFAULT '0'		NOT NULL,
term0		TINYINT			DEFAULT '0'		NOT NULL,
term1		VARCHAR(14)		DEFAULT ''		NOT NULL,
term2		VARCHAR(14)		DEFAULT ''		NOT NULL,
name		VARCHAR(50)		DEFAULT ''		NOT NULL,
content		TEXT			NOT NULL,
html		VARCHAR(4)		DEFAULT ''		NOT NULL,
upload		TEXT			NOT NULL,
center		TINYINT			DEFAULT '0'		NOT NULL,
ptop		INT				DEFAULT '0'		NOT NULL,
pleft		INT				DEFAULT '0'		NOT NULL,
width		INT				DEFAULT '0'		NOT NULL,
height		INT				DEFAULT '0'		NOT NULL,
scroll		TINYINT			DEFAULT '0'		NOT NULL,
type		TINYINT			DEFAULT '0'		NOT NULL,
dispage		TEXT			DEFAULT ''		NOT NULL,
KEY hidden(hidden)) ENGINE=".$DB['type']." CHARSET=UTF8");                    
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_popup'],$DB_CONNECT); 
}

//회원아이디데이터
$_tmp = db_query( "select count(*) from ".$table['s_mbrid'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_mbrid']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
site		INT				DEFAULT '0'		NOT NULL,
id			VARCHAR(50)		DEFAULT ''		NOT NULL,
pw			VARCHAR(50)		DEFAULT ''		NOT NULL,
KEY site(site),
KEY id(id)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_mbrid'],$DB_CONNECT); 
}

//회원기본데이터
$_tmp = db_query( "select count(*) from ".$table['s_mbrdata'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_mbrdata']." (
memberuid	INT				PRIMARY KEY		NOT NULL,
site		INT				DEFAULT '0'		NOT NULL,
auth		TINYINT			DEFAULT '0'		NOT NULL,
sosok		INT				DEFAULT '0'		NOT NULL,
level		INT				DEFAULT '0'		NOT NULL,
comp		TINYINT			DEFAULT '0'		NOT NULL,
admin		TINYINT			DEFAULT '0'		NOT NULL,
adm_view	TEXT			NOT NULL,
email		VARCHAR(50)	 	DEFAULT ''		NOT NULL,
name		VARCHAR(30)	 	DEFAULT ''		NOT NULL,
nic			VARCHAR(50)		DEFAULT ''		NOT NULL,
grade		VARCHAR(20)		DEFAULT ''		NOT NULL,
photo		VARCHAR(200)	DEFAULT ''		NOT NULL,
home		VARCHAR(100)	DEFAULT ''		NOT NULL,
sex			TINYINT			DEFAULT '0'		NOT NULL,
birth1		SMALLINT		DEFAULT '0'		NOT NULL,
birth2		SMALLINT(4)		UNSIGNED ZEROFILL DEFAULT '0000' NOT NULL,
birthtype	TINYINT			DEFAULT '0'		NOT NULL,
tel1		VARCHAR(14)		DEFAULT ''		NOT NULL,
tel2		VARCHAR(14)		DEFAULT ''		NOT NULL,
zip			VARCHAR(6)		DEFAULT ''		NOT NULL,
addr0		VARCHAR(6)		DEFAULT ''		NOT NULL,
addr1		VARCHAR(200)	DEFAULT ''		NOT NULL,
addr2		VARCHAR(100)	DEFAULT ''		NOT NULL,
job			VARCHAR(30)		DEFAULT ''		NOT NULL,
marr1		SMALLINT		DEFAULT '0'		NOT NULL,
marr2		SMALLINT(4)		UNSIGNED ZEROFILL DEFAULT '0000' NOT NULL,
sms			TINYINT			DEFAULT '0'		NOT NULL,
mailing		TINYINT			DEFAULT '0'		NOT NULL,
smail		TINYINT			DEFAULT '0'		NOT NULL,
point		INT				DEFAULT '0'		NOT NULL,
usepoint	INT				DEFAULT '0'		NOT NULL,
money		INT				DEFAULT '0'		NOT NULL,
cash		INT				DEFAULT '0'		NOT NULL,
num_login	INT				DEFAULT '0'		NOT NULL,
pw_q		VARCHAR(250)	DEFAULT ''		NOT NULL,
pw_a		VARCHAR(100)	DEFAULT ''		NOT NULL,
now_log		TINYINT			DEFAULT '0'		NOT NULL,
last_log	VARCHAR(14)		DEFAULT ''		NOT NULL,
last_pw		VARCHAR(8)		DEFAULT ''		NOT NULL,
is_paper	TINYINT			DEFAULT '0'		NOT NULL,
d_regis		VARCHAR(14)		DEFAULT ''		NOT NULL,
tmpcode		VARCHAR(50)		DEFAULT ''		NOT NULL,
sns			TEXT			NOT NULL,
addfield	TEXT			NOT NULL,
KEY site(site),
KEY auth(auth),
KEY comp(comp),
KEY sosok(sosok),
KEY level(level),
KEY admin(admin),
KEY email(email),
KEY name(name),
KEY nic(nic),
KEY sex(sex),
KEY birth1(birth1),
KEY birth2(birth2),
KEY birthtype(birthtype),
KEY addr0(addr0),
KEY job(job),
KEY marr1(marr1),
KEY marr2(marr2),
KEY sms(sms),
KEY mailing(mailing),
KEY smail(smail),
KEY point(point),
KEY usepoint(usepoint),
KEY now_log(now_log),
KEY d_regis(d_regis)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_mbrdata'],$DB_CONNECT); 
}

//회원기업데이터
$_tmp = db_query( "select count(*) from ".$table['s_mbrcomp'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_mbrcomp']." (
memberuid	INT				PRIMARY KEY		NOT NULL,
comp_num	INT			 	DEFAULT '0'		NOT NULL,
comp_type	TINYINT			DEFAULT '0'		NOT NULL,
comp_name	VARCHAR(50)	 	DEFAULT ''		NOT NULL,
comp_ceo	VARCHAR(30)	 	DEFAULT ''		NOT NULL,
comp_upte		VARCHAR(100)	DEFAULT ''		NOT NULL,
comp_jongmok	VARCHAR(100)	DEFAULT ''		NOT NULL,
comp_tel	VARCHAR(14)	 	DEFAULT ''		NOT NULL,
comp_fax	VARCHAR(14)	 	DEFAULT ''		NOT NULL,
comp_zip	VARCHAR(6)	 	DEFAULT ''		NOT NULL,
comp_addr0	VARCHAR(6)		DEFAULT ''		NOT NULL,
comp_addr1	VARCHAR(200)	DEFAULT ''		NOT NULL,
comp_addr2	VARCHAR(100)	DEFAULT ''		NOT NULL,
comp_part	VARCHAR(30)		DEFAULT ''		NOT NULL,
comp_level	VARCHAR(20)		DEFAULT ''		NOT NULL,
KEY comp_num(comp_num),
KEY comp_type(comp_type),
KEY comp_name(comp_name),
KEY comp_ceo(comp_ceo),
KEY comp_addr0(comp_addr0)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_mbrcomp'],$DB_CONNECT); 
}

//접속카운트
$_tmp = db_query( "select count(*) from ".$table['s_counter'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_counter']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
site		INT				DEFAULT '0'		NOT NULL,
date		CHAR(8)			DEFAULT ''		NOT NULL,
hit			INT				DEFAULT '0'		NOT NULL,
page		INT				DEFAULT '0'		NOT NULL,
KEY site(site),
KEY date(date)) ENGINE=".$DB['type']." CHARSET=UTF8");                    
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_counter'],$DB_CONNECT); 
}

//접속레퍼러
$_tmp = db_query( "select count(*) from ".$table['s_referer'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_referer']." (
uid			BIGINT			PRIMARY KEY		NOT NULL AUTO_INCREMENT,
site		INT				DEFAULT '0'		NOT NULL,
mbruid		INT				DEFAULT '0'		NOT NULL,
ip			VARCHAR(15)		DEFAULT ''		NOT NULL,
referer		VARCHAR(200)	DEFAULT ''		NOT NULL,
agent		VARCHAR(200)	DEFAULT ''		NOT NULL,
d_regis		VARCHAR(14)		DEFAULT ''		NOT NULL,
KEY site(site),
KEY mbruid(mbruid),
KEY d_regis(d_regis)) ENGINE=".$DB['type']." CHARSET=UTF8");                    
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_referer'],$DB_CONNECT); 
}

//브라우져
$_tmp = db_query( "select count(*) from ".$table['s_browser'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_browser']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
site		INT				DEFAULT '0'		NOT NULL,
date		CHAR(8)			DEFAULT ''		NOT NULL,
browser		VARCHAR(10)		DEFAULT ''		NOT NULL,
hit			INT				DEFAULT '0'		NOT NULL,
KEY site(site),
KEY date(date),
KEY browser(browser)) ENGINE=".$DB['type']." CHARSET=UTF8");                    
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_browser'],$DB_CONNECT); 
}

//내부키워드
$_tmp = db_query( "select count(*) from ".$table['s_inkey'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_inkey']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
site		INT				DEFAULT '0'		NOT NULL,
date		CHAR(8)			DEFAULT ''		NOT NULL,
keyword		VARCHAR(50)		DEFAULT ''		NOT NULL,
hit			INT				DEFAULT '0'		NOT NULL,
KEY site(site),
KEY date(date),
KEY keyword(keyword)) ENGINE=".$DB['type']." CHARSET=UTF8");                    
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_inkey'],$DB_CONNECT); 
}

//외부키워드
$_tmp = db_query( "select count(*) from ".$table['s_outkey'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_outkey']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
site		INT				DEFAULT '0'		NOT NULL,
date		CHAR(8)			DEFAULT ''		NOT NULL,
keyword		VARCHAR(50)		DEFAULT ''		NOT NULL,
naver		INT				DEFAULT '0'		NOT NULL,
nate		INT				DEFAULT '0'		NOT NULL,
daum		INT				DEFAULT '0'		NOT NULL,
yahoo		INT				DEFAULT '0'		NOT NULL,
google		INT				DEFAULT '0'		NOT NULL,
etc			INT				DEFAULT '0'		NOT NULL,
total		INT				DEFAULT '0'		NOT NULL,
KEY site(site),
KEY date(date),
KEY keyword(keyword)) ENGINE=".$DB['type']." CHARSET=UTF8");                    
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_outkey'],$DB_CONNECT); 
}

//첨부파일데이터
$_tmp = db_query( "select count(*) from ".$table['s_upload'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_upload']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
gid			INT				DEFAULT '0'		NOT NULL,
hidden		TINYINT			DEFAULT '0'		NOT NULL,
tmpcode		VARCHAR(20)		DEFAULT ''		NOT NULL,
site		INT				DEFAULT '0'		NOT NULL,
mbruid		INT				DEFAULT '0'		NOT NULL,
type		TINYINT			DEFAULT '0'		NOT NULL,
ext			VARCHAR(4)		DEFAULT '0'		NOT NULL,
fserver		TINYINT			DEFAULT '0'		NOT NULL,
url			VARCHAR(150)	DEFAULT ''		NOT NULL,
folder		VARCHAR(30)		DEFAULT ''		NOT NULL,
name		VARCHAR(250)	DEFAULT ''		NOT NULL,
tmpname		VARCHAR(100)	DEFAULT ''		NOT NULL,
thumbname	VARCHAR(100)	DEFAULT ''		NOT NULL,
size		INT				DEFAULT '0'		NOT NULL,
width		INT				DEFAULT '0'		NOT NULL,
height		INT				DEFAULT '0'		NOT NULL,
caption		TEXT			NOT NULL,
down		INT				DEFAULT '0'		NOT NULL,
d_regis		VARCHAR(14)		DEFAULT ''		NOT NULL,
d_update	VARCHAR(14)		DEFAULT ''		NOT NULL,
cync		VARCHAR(250)	DEFAULT ''		NOT NULL,
KEY gid(gid),
KEY tmpcode(tmpcode),
KEY site(site),
KEY mbruid(mbruid),
KEY type(type),
KEY ext(ext),
KEY name(name),
KEY d_regis(d_regis)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_upload'],$DB_CONNECT); 
}


//댓글데이터
$_tmp = db_query( "select count(*) from ".$table['s_comment'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_comment']." (
uid			INT				PRIMARY KEY		NOT NULL,
site		INT				DEFAULT '0'		NOT NULL,
parent		VARCHAR(30)		DEFAULT '0'		NOT NULL,
parentmbr	INT				DEFAULT '0'		NOT NULL,
display		TINYINT			DEFAULT '0'		NOT NULL,
hidden		TINYINT			DEFAULT '0'		NOT NULL,
notice		TINYINT			DEFAULT '0'		NOT NULL,
name		VARCHAR(30)		DEFAULT ''		NOT NULL,
nic			VARCHAR(50)		DEFAULT ''		NOT NULL,
mbruid		INT				DEFAULT '0'		NOT NULL,
id			VARCHAR(16)		DEFAULT ''		NOT NULL,
pw			VARCHAR(50)		DEFAULT ''		NOT NULL,
subject		VARCHAR(200)	DEFAULT ''		NOT NULL,
content		TEXT			NOT NULL,
html		VARCHAR(4)		DEFAULT ''		NOT NULL,
hit			INT				DEFAULT '0'		NOT NULL,
down		INT				DEFAULT '0'		NOT NULL,
oneline		INT				DEFAULT '0'		NOT NULL,
score1		INT				DEFAULT '0'		NOT NULL,
score2		INT				DEFAULT '0'		NOT NULL,
singo		INT				DEFAULT '0'		NOT NULL,
point		INT				DEFAULT '0'		NOT NULL,
d_regis		VARCHAR(14)		DEFAULT ''		NOT NULL,
d_modify	VARCHAR(14)		DEFAULT ''		NOT NULL,
d_oneline	VARCHAR(14)		DEFAULT ''		NOT NULL,
upload		TEXT			NOT NULL,
ip			VARCHAR(25)	 	DEFAULT ''		NOT NULL,
agent	 	VARCHAR(150)	DEFAULT ''		NOT NULL,
cync		VARCHAR(250)	DEFAULT ''		NOT NULL,
sns			VARCHAR(100)	DEFAULT ''		NOT NULL,
adddata		TEXT			NOT NULL,
KEY site(site),
KEY parent(parent),
KEY parentmbr(parentmbr),
KEY display(display),
KEY hidden(hidden),
KEY notice(notice),
KEY mbruid(mbruid),
KEY subject(subject),
KEY d_regis(d_regis)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_comment'],$DB_CONNECT); 
}

//한줄의견데이터
$_tmp = db_query( "select count(*) from ".$table['s_oneline'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_oneline']." (
uid			INT				PRIMARY KEY		NOT NULL,
site		INT				DEFAULT '0'		NOT NULL,
parent		INT				DEFAULT '0'		NOT NULL,
parentmbr	INT				DEFAULT '0'		NOT NULL,
hidden		TINYINT			DEFAULT '0'		NOT NULL,
name		VARCHAR(30)		DEFAULT ''		NOT NULL,
nic			VARCHAR(30)		DEFAULT ''		NOT NULL,
mbruid		INT				DEFAULT '0'		NOT NULL,
id			VARCHAR(16)		DEFAULT ''		NOT NULL,
content		TEXT			NOT NULL,
html		VARCHAR(4)		DEFAULT ''		NOT NULL,
singo		INT				DEFAULT '0'		NOT NULL,
point		INT				DEFAULT '0'		NOT NULL,
d_regis		VARCHAR(14)		DEFAULT ''		NOT NULL,
d_modify	VARCHAR(14)		DEFAULT ''		NOT NULL,
ip			VARCHAR(25)	 	DEFAULT ''		NOT NULL,
agent	 	VARCHAR(150)	DEFAULT ''		NOT NULL,
adddata		TEXT			NOT NULL,
KEY site(site),
KEY parent(parent),
KEY parentmbr(parentmbr),
KEY hidden(hidden),
KEY mbruid(mbruid),
KEY d_regis(d_regis)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_oneline'],$DB_CONNECT); 
}

//일별수량
$_tmp = db_query( "select count(*) from ".$table['s_numinfo'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_numinfo']." (
date		CHAR(8)			DEFAULT ''		NOT NULL,
site		INT				DEFAULT '0'		NOT NULL,
visit		INT				DEFAULT '0'		NOT NULL,
login		INT				DEFAULT '0'		NOT NULL,
comment		INT				DEFAULT '0'		NOT NULL,
oneline		INT				DEFAULT '0'		NOT NULL,
rcvtrack	INT				DEFAULT '0'		NOT NULL,
sndtrack	INT				DEFAULT '0'		NOT NULL,
upload		INT				DEFAULT '0'		NOT NULL,
download	INT				DEFAULT '0'		NOT NULL,
mbrjoin		INT				DEFAULT '0'		NOT NULL,
mbrout		INT				DEFAULT '0'		NOT NULL,
KEY date(date),
KEY site(site)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_numinfo'],$DB_CONNECT); 
}

//태그
$_tmp = db_query( "select count(*) from ".$table['s_tag'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_tag']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
site		INT				DEFAULT '0'		NOT NULL,
date		CHAR(8)			DEFAULT ''		NOT NULL,
keyword		VARCHAR(50)		DEFAULT ''		NOT NULL,
hit			INT				DEFAULT '0'		NOT NULL,
KEY site(site),
KEY date(date),
KEY keyword(keyword)) ENGINE=".$DB['type']." CHARSET=UTF8");                    
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_tag'],$DB_CONNECT); 
}


//트랙백데이터
$_tmp = db_query( "select count(*) from ".$table['s_trackback'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_trackback']." (
uid			INT				PRIMARY KEY		NOT NULL,
site		INT				DEFAULT '0'		NOT NULL,
type		TINYINT			DEFAULT '0'		NOT NULL,
parent		VARCHAR(30)		DEFAULT '0'		NOT NULL,
parentmbr	INT				DEFAULT '0'		NOT NULL,
url			VARCHAR(150)	DEFAULT ''		NOT NULL,
name		VARCHAR(200)	DEFAULT ''		NOT NULL,
subject		VARCHAR(200)	DEFAULT ''		NOT NULL,
content		TEXT			NOT NULL,
d_regis		VARCHAR(14)		DEFAULT ''		NOT NULL,
d_modify	VARCHAR(14)		DEFAULT ''		NOT NULL,
cync		VARCHAR(250)	DEFAULT ''		NOT NULL,
KEY site(site),
KEY type(type),
KEY parent(parent),
KEY parentmbr(parentmbr),
KEY d_regis(d_regis)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_trackback'],$DB_CONNECT); 
}

//회원레벨테이블
$_tmp = db_query( "select count(*) from ".$table['s_mbrlevel'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_mbrlevel']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
gid			INT				DEFAULT '0'		NOT NULL,
name		VARCHAR(30)		DEFAULT ''		NOT NULL,
num			INT				DEFAULT '0'		NOT NULL,
login		INT				DEFAULT '0'		NOT NULL,
post		INT				DEFAULT '0'		NOT NULL,
comment		INT				DEFAULT '0'		NOT NULL,
KEY gid(gid)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_mbrlevel'],$DB_CONNECT); 
}
//회원그룹테이블
$_tmp = db_query( "select count(*) from ".$table['s_mbrgroup'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_mbrgroup']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
name		VARCHAR(30)		DEFAULT ''		NOT NULL,
gid			TINYINT			DEFAULT '0'		NOT NULL,
num			INT				DEFAULT	'0'		NOT NULL,
KEY gid(gid)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_mbrgroup'],$DB_CONNECT); 
}
//포인트테이블
$_tmp = db_query( "select count(*) from ".$table['s_point'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_point']." (
uid			BIGINT			PRIMARY KEY		NOT NULL AUTO_INCREMENT,
my_mbruid	INT				DEFAULT '0'		NOT NULL,
by_mbruid	INT				DEFAULT '0'		NOT NULL,
price		INT				DEFAULT '0'		NOT NULL,
content		TEXT			NOT NULL,
d_regis		VARCHAR(14)		DEFAULT ''		NOT NULL,
KEY my_mbruid(my_mbruid),
KEY by_mbruid(by_mbruid),
KEY d_regis(d_regis)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_point'],$DB_CONNECT); 
}
//적립금테이블
$_tmp = db_query( "select count(*) from ".$table['s_cash'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_cash']." (
uid			BIGINT			PRIMARY KEY		NOT NULL AUTO_INCREMENT,
my_mbruid	INT				DEFAULT '0'		NOT NULL,
by_mbruid	INT				DEFAULT '0'		NOT NULL,
price		INT				DEFAULT '0'		NOT NULL,
content		TEXT			NOT NULL,
d_regis		VARCHAR(14)		DEFAULT ''		NOT NULL,
KEY my_mbruid(my_mbruid),
KEY by_mbruid(by_mbruid),
KEY d_regis(d_regis)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_cash'],$DB_CONNECT); 
}
//예치금테이블
$_tmp = db_query( "select count(*) from ".$table['s_money'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_money']." (
uid			BIGINT			PRIMARY KEY		NOT NULL AUTO_INCREMENT,
my_mbruid	INT				DEFAULT '0'		NOT NULL,
by_mbruid	INT				DEFAULT '0'		NOT NULL,
price		INT				DEFAULT '0'		NOT NULL,
content		TEXT			NOT NULL,
d_regis		VARCHAR(14)		DEFAULT ''		NOT NULL,
KEY my_mbruid(my_mbruid),
KEY by_mbruid(by_mbruid),
KEY d_regis(d_regis)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_money'],$DB_CONNECT); 
}
//쪽지테이블
$_tmp = db_query( "select count(*) from ".$table['s_paper'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_paper']." (
uid			BIGINT			PRIMARY KEY		NOT NULL AUTO_INCREMENT,
parent		INT				DEFAULT '0'		NOT NULL,
my_mbruid	INT				DEFAULT '0'		NOT NULL,
by_mbruid	INT				DEFAULT '0'		NOT NULL,
inbox		TINYINT			DEFAULT '0'		NOT NULL,
content		TEXT			NOT NULL,
html		VARCHAR(4)		DEFAULT ''		NOT NULL,
upload		TEXT			NOT NULL,
d_regis		VARCHAR(14)		DEFAULT ''		NOT NULL,
d_read		VARCHAR(14)		DEFAULT ''		NOT NULL,
KEY parent(parent),
KEY my_mbruid(my_mbruid),
KEY by_mbruid(by_mbruid),
KEY inbox(inbox),
KEY d_regis(d_regis),
KEY d_read(d_read)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_paper'],$DB_CONNECT); 
}
//친구테이블
$_tmp = db_query( "select count(*) from ".$table['s_friend'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_friend']." (
uid			BIGINT			PRIMARY KEY		NOT NULL AUTO_INCREMENT,
rel			TINYINT			DEFAULT '0'		NOT NULL,
my_mbruid	INT				DEFAULT '0'		NOT NULL,
by_mbruid	INT				DEFAULT '0'		NOT NULL,
category	VARCHAR(50)		DEFAULT ''		NOT NULL,
d_regis		VARCHAR(14)		DEFAULT ''		NOT NULL,
KEY rel(rel),
KEY my_mbruid(my_mbruid),
KEY by_mbruid(by_mbruid),
KEY d_regis(d_regis)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_friend'],$DB_CONNECT); 
}
//스크랩테이블
$_tmp = db_query( "select count(*) from ".$table['s_scrap'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_scrap']." (
uid			BIGINT			PRIMARY KEY		NOT NULL AUTO_INCREMENT,
mbruid		INT				DEFAULT '0'		NOT NULL,
category	VARCHAR(50)		DEFAULT ''		NOT NULL,
subject		VARCHAR(200)	DEFAULT ''		NOT NULL,
url			VARCHAR(250)	DEFAULT ''		NOT NULL,
d_regis		VARCHAR(14)		DEFAULT ''		NOT NULL,
KEY mbruid(mbruid),
KEY d_regis(d_regis)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_scrap'],$DB_CONNECT); 
}

//캐릭터테이블
$_tmp = db_query( "select count(*) from ".$table['s_simbol'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_simbol']." (
uid			BIGINT			PRIMARY KEY		NOT NULL AUTO_INCREMENT,
mbruid		INT				DEFAULT '0'		NOT NULL,
gid			INT				DEFAULT '0'		NOT NULL,
photo		VARCHAR(100)	DEFAULT ''		NOT NULL,
d_regis		VARCHAR(14)		DEFAULT ''		NOT NULL,
KEY mbruid(mbruid),
KEY d_regis(d_regis)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_simbol'],$DB_CONNECT); 
}

//SNS테이블
$_tmp = db_query( "select count(*) from ".$table['s_mbrsns'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_mbrsns']." (
memberuid	INT				PRIMARY KEY		NOT NULL,
st			VARCHAR(40)		DEFAULT ''		NOT NULL,
sf			VARCHAR(40)		DEFAULT ''		NOT NULL,
sm			VARCHAR(40)		DEFAULT ''		NOT NULL,
sy			VARCHAR(40)		DEFAULT ''		NOT NULL,
KEY st(st),
KEY sf(sf),
KEY sm(sm),
KEY sy(sy)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_mbrsns'],$DB_CONNECT); 
}
//SEO테이블
$_tmp = db_query( "select count(*) from ".$table['s_seo'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_seo']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
rel			TINYINT			DEFAULT '0'		NOT NULL,
parent		INT				DEFAULT '0'		NOT NULL,
subject		VARCHAR(200)	DEFAULT ''		NOT NULL,
title		VARCHAR(200)	DEFAULT ''		NOT NULL,
keywords	VARCHAR(200)	DEFAULT ''		NOT NULL,
description	VARCHAR(200)	DEFAULT ''		NOT NULL,
classification	VARCHAR(200)	DEFAULT ''		NOT NULL,
replyto		VARCHAR(50)		DEFAULT ''		NOT NULL,
language	CHAR(2)			DEFAULT ''		NOT NULL,
build		VARCHAR(14)		DEFAULT ''		NOT NULL,
KEY rel(rel),
KEY parent(parent)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_seo'],$DB_CONNECT); 
}
//확장로그
$_tmp = db_query( "select count(*) from ".$table['s_xtralog'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_xtralog']." (
module		VARCHAR(30)		DEFAULT ''		NOT NULL,
parent		INT				DEFAULT '0'		NOT NULL,
down		TEXT			NOT NULL,
score1		TEXT			NOT NULL,
score2		TEXT			NOT NULL,
singo		TEXT			NOT NULL,
KEY module(module),
KEY parent(parent)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_xtralog'],$DB_CONNECT); 
}

//게시판리스트
$_tmp = db_query( "select count(*) from ".$table['bbslist'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['bbslist']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
gid			INT				DEFAULT '0'		NOT NULL,
id			VARCHAR(30)		DEFAULT ''		NOT NULL,
name		VARCHAR(200)	DEFAULT ''		NOT NULL,
category	TEXT			NOT NULL,
num_r		INT				DEFAULT '0'		NOT NULL,
d_last		VARCHAR(14)		DEFAULT ''		NOT NULL,
d_regis		VARCHAR(14)		DEFAULT ''		NOT NULL,
imghead		VARCHAR(100)	DEFAULT ''		NOT NULL,
imgfoot		VARCHAR(100)	DEFAULT ''		NOT NULL,
puthead		VARCHAR(20)		DEFAULT ''		NOT NULL,
putfoot		VARCHAR(20)		DEFAULT ''		NOT NULL,
addinfo		TEXT			NOT NULL,
writecode	TEXT			NOT NULL,
KEY gid(gid),
KEY id(id)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['bbslist'],$DB_CONNECT); 
}

//게시판인덱스
$_tmp = db_query( "select count(*) from ".$table['bbsidx'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['bbsidx']." (
site		INT				DEFAULT '0'		NOT NULL,
notice		TINYINT			DEFAULT '0'		NOT NULL,
bbs			INT				DEFAULT '0'		NOT NULL,
gid			double(11,2)	DEFAULT '0.00'	NOT NULL,
KEY site(site),
KEY notice(notice),
KEY bbs(bbs,gid),
KEY gid(gid)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['bbsidx'],$DB_CONNECT); 
}

//게시판데이터
$_tmp = db_query( "select count(*) from ".$table['bbsdata'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['bbsdata']." (
uid			INT				PRIMARY KEY		NOT NULL AUTO_INCREMENT,
site		INT				DEFAULT '0'		NOT NULL,
gid			double(11,2)	DEFAULT '0.00'	NOT NULL,
bbs			INT				DEFAULT '0'		NOT NULL,
bbsid		VARCHAR(30)		DEFAULT ''		NOT NULL,
depth		TINYINT			DEFAULT '0'		NOT NULL,
parentmbr	INT				DEFAULT '0'		NOT NULL,
display		TINYINT			DEFAULT '0'		NOT NULL,
hidden		TINYINT			DEFAULT '0'		NOT NULL,
notice		TINYINT			DEFAULT '0'		NOT NULL,
name		VARCHAR(30)		DEFAULT ''		NOT NULL,
nic			VARCHAR(50)		DEFAULT ''		NOT NULL,
mbruid		INT				DEFAULT '0'		NOT NULL,
id			VARCHAR(16)		DEFAULT ''		NOT NULL,
pw			VARCHAR(50)		DEFAULT ''		NOT NULL,
category	VARCHAR(100)	DEFAULT ''		NOT NULL,
subject		VARCHAR(200)	DEFAULT ''		NOT NULL,
content		MEDIUMTEXT		NOT NULL,
html		VARCHAR(4)		DEFAULT ''		NOT NULL,
tag			VARCHAR(200)	DEFAULT ''		NOT NULL,
hit			INT				DEFAULT '0'		NOT NULL,
down		INT				DEFAULT '0'		NOT NULL,
comment		INT				DEFAULT '0'		NOT NULL,
oneline		INT				DEFAULT '0'		NOT NULL,
trackback	INT				DEFAULT '0'		NOT NULL,
score1		INT				DEFAULT '0'		NOT NULL,
score2		INT				DEFAULT '0'		NOT NULL,
singo		INT				DEFAULT '0'		NOT NULL,
point1		INT				DEFAULT '0'		NOT NULL,
point2		INT				DEFAULT '0'		NOT NULL,
point3		INT				DEFAULT '0'		NOT NULL,
point4		INT				DEFAULT '0'		NOT NULL,
d_regis		VARCHAR(14)		DEFAULT ''		NOT NULL,
d_modify	VARCHAR(14)		DEFAULT ''		NOT NULL,
d_comment	VARCHAR(14)		DEFAULT ''		NOT NULL,
d_trackback	VARCHAR(14)		DEFAULT ''		NOT NULL,
upload		TEXT			NOT NULL,
ip			VARCHAR(25)	 	DEFAULT ''		NOT NULL,
agent	 	VARCHAR(150)	DEFAULT ''		NOT NULL,
sns			VARCHAR(100)	DEFAULT ''		NOT NULL,
adddata		TEXT			NOT NULL,
KEY site(site),
KEY gid(gid),
KEY bbs(bbs),
KEY bbsid(bbsid),
KEY parentmbr(parentmbr),
KEY display(display),
KEY notice(notice),
KEY mbruid(mbruid),
KEY category(category),
KEY subject(subject),
KEY tag(tag),
KEY d_regis(d_regis)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['bbsdata'],$DB_CONNECT); 
}
//게시판월별수량
$_tmp = db_query( "select count(*) from ".$table['bbsmonth'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['bbsmonth']." (
date		CHAR(6)			DEFAULT ''		NOT NULL,
site		INT				DEFAULT '0'		NOT NULL,
bbs			INT				DEFAULT '0'		NOT NULL,
num			INT				DEFAULT '0'		NOT NULL,
KEY date(date),
KEY site(site),
KEY bbs(bbs)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['bbsmonth'],$DB_CONNECT); 
}
//게시판일별수량
$_tmp = db_query( "select count(*) from ".$table['bbsday'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['bbsday']." (
date		CHAR(8)			DEFAULT ''		NOT NULL,
site		INT				DEFAULT '0'		NOT NULL,
bbs			INT				DEFAULT '0'		NOT NULL,
num			INT				DEFAULT '0'		NOT NULL,
KEY date(date),
KEY site(site),
KEY bbs(bbs)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['bbsday'],$DB_CONNECT); 
}
//확장데이터
$_tmp = db_query( "select count(*) from ".$table['bbsxtra'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['bbsxtra']." (
parent		INT				DEFAULT '0'		NOT NULL,
site		INT				DEFAULT '0'		NOT NULL,
bbs			INT				DEFAULT '0'		NOT NULL,
down		TEXT			NOT NULL,
score1		TEXT			NOT NULL,
score2		TEXT			NOT NULL,
singo		TEXT			NOT NULL,
KEY parent(parent),
KEY site(site),
KEY bbs(bbs)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['bbsxtra'],$DB_CONNECT); 
}

// 기본페이지
$_tmp = db_query( "select count(*) from ".$table['s_stdpage'], $DB_CONNECT );
if ( !$_tmp ) {
$_tmp = ("

CREATE TABLE ".$table['s_stdpage']." (
pid			VARCHAR(13)		DEFAULT ''		NOT NULL,
site		INT				DEFAULT '0'		NOT NULL,
level		TINYINT			DEFAULT '0'		NOT NULL,
content		MEDIUMTEXT		NOT NULL,
mapapi		MEDIUMTEXT		NOT NULL,
mapapi_pos	TINYINT			DEFAULT '0'		NOT NULL,
hit			INT				DEFAULT '0'		NOT NULL,
d_regis		VARCHAR(14)		DEFAULT ''		NOT NULL,
d_modify	VARCHAR(14)		DEFAULT ''		NOT NULL,
upload		TEXT			NOT NULL,
PRIMARY KEY (pid),
KEY site (site),
KEY d_regis(d_regis)) ENGINE=".$DB['type']." CHARSET=UTF8");                            
db_query($_tmp, $DB_CONNECT);
db_query("OPTIMIZE TABLE ".$table['s_stdpage'],$DB_CONNECT); 
}


	// 기본값 입력
	// ==========
	
	// 모듈 정보 입력
	$gid = 0;
	$g['path_module'] = './modules/';
	$moduledir = array();
	$dirh = opendir($g['path_module']); 
	while(false !== ($_file = readdir($dirh))) 
	{ 
		if($_file == '.' || $_file == '..') continue;
		$moduledir[$_file] = array($_file,0);
	}
	
	$mdlarray = array('home','layout','module','market','admin','member','bbs','comment','upload');
	foreach($mdlarray as $_val) {
		$QUE = "insert into ".$table['s_module']." 
		(gid,system,hidden,mobile,name,id,tblnum,d_regis) 
		values 
		('".$gid."','1','0','1','".getFolderName($g['path_module'].$moduledir[$_val][0])."','".$moduledir[$_val][0]."','".$moduledir[$_val][1]."',date_format(now(),'%Y%m%d%H%i%s'))";
		db_query($QUE,$DB_CONNECT);
		$gid++;
	}
	$mdlarray = array('popup','filemanager','dbmanager','mobile','domain','counter','search','widget','tag','trackback','editor','rewrite','zipsearch');
	foreach($mdlarray as $_val) {
		$QUE = "insert into ".$table['s_module']." 
		(gid,system,hidden,mobile,name,id,tblnum,d_regis) 
		values 
		('".$gid."','".(strstr('[counter][widget][tag][rewrite]','['.$_val.']')?0:1)."','".(strstr('[rewrite][zipsearch]','['.$_val.']')?1:0)."','".(strstr('[rewrite][zipsearch]','['.$_val.']')?0:1)."','".getFolderName($g['path_module'].$moduledir[$_val][0])."','".$moduledir[$_val][0]."','".$moduledir[$_val][1]."',date_format(now(),'%Y%m%d%H%i%s'))";
		db_query($QUE,$DB_CONNECT);
		$gid++;
	}

	// 사이트 정보 입력
	$siteid = 'home';
	$QKEY = "gid,id,name,title,titlefix,icon,layout,startpage,theme,m_layout,m_startpage,lang,open,dtd,nametype,timecal,rewrite,buffer,usescode,headercode,footercode";
	$QVAL = "'0','".$siteid."','site name','site title','0','1.png','default/main.php','1','t001','mobile/main.php','10','korean','1','xhtml_1','nic','0','0','0','0','',''";
	getDbInsert($table['s_site'],$QKEY,$QVAL);
	db_query("OPTIMIZE TABLE ".$table['s_site'],$DB_CONNECT); 

	// 페이지 정보 입력
	$pagesarray = array
	(
		'main'=>array('메인화면','3',''),
		'join'=>array('회원가입','1','./?m=member&front=join'),
		'login'=>array('로그인','1','./?m=member&front=login'),
		'mypage'=>array('마이페이지','1','./?m=member&front=mypage'),
		'search'=>array('통합검색','1','./?m=search'),
		'agreement'=>array('홈페이지 이용약관','3',''),
		'private'=>array('개인정보 취급방침','3',''),
		'postrule'=>array('게시물 게재원칙','3',''),
		'stdpage'=>array('기본페이지','3','')
	);
	foreach($pagesarray as $_key => $_val)
	{
		$QUE = "insert into ".$table['s_page']." 
		(pagetype,ismain,mobile,id,category,name,perm_g,perm_l,layout,joint,hit,d_regis,d_update)
		values
		('$_val[1]','".($_key=='main'?1:0)."','".($_key=='main'?1:0)."','$_key','기본페이지','$_val[0]','','0','".($_key=='main'?'default/zone.php':'')."','$_val[2]','0',date_format(now(),'%Y%m%d%H%i%s'),'')";
		db_query($QUE,$DB_CONNECT);
	}
	$QUE = "insert into ".$table['s_page']." 
	(pagetype,ismain,mobile,id,category,name,perm_g,perm_l,layout,joint,hit,sosokmenu,d_regis,d_update)
	values
	('3','0','1','main_mobile','모바일페이지','메인화면','','0','','','0','',date_format(now(),'%Y%m%d%H%i%s'),'')";
	db_query($QUE,$DB_CONNECT);
	
	// 관리자 정보 입력
	db_query("insert into ".$table['s_mbrid']." (site,id,pw)values('1','root','".md5('r55tpwd')."')",$DB_CONNECT);
	$QUE = "insert into ".$table['s_mbrdata']." 
	(memberuid,site,auth,sosok,level,comp,admin,adm_view,
	email,name,nic,grade,photo,home,sex,birth1,birth2,birthtype,tel1,tel2,zip,
	addr0,addr1,addr2,job,marr1,marr2,sms,mailing,smail,point,usepoint,money,cash,num_login,pw_q,pw_a,now_log,last_log,last_pw,is_paper,d_regis,tmpcode,sns,addfield)
	values
	('1','1','1','1','20','0','1','',
	'','관리자[root]','관리자','','','','0','0','0','0','','','',
	'','','','','0','0','1','1','0','0','0','0','0','1','','','1',date_format(now(),'%Y%m%d%H%i%s'),'".$date['today']."','0',date_format(now(),'%Y%m%d%H%i%s'),'','','')";
	db_query($QUE,$DB_CONNECT);

	db_query("insert into ".$table['s_mbrid']." (site,id,pw)values('1','master','".md5('!234')."')",$DB_CONNECT);
	$QUE = "insert into ".$table['s_mbrdata']." 
	(memberuid,site,auth,sosok,level,comp,admin,adm_view,
	email,name,nic,grade,photo,home,sex,birth1,birth2,birthtype,tel1,tel2,zip,
	addr0,addr1,addr2,job,marr1,marr2,sms,mailing,smail,point,usepoint,money,cash,num_login,pw_q,pw_a,now_log,last_log,last_pw,is_paper,d_regis,tmpcode,sns,addfield)
	values
	('2','1','1','1','19','0','0','',
	'','웹마스터','웹마스터','','','','0','0','0','0','','','',
	'','','','','0','0','1','1','0','0','0','0','0','1','','','1',date_format(now(),'%Y%m%d%H%i%s'),'".$date['today']."','0',date_format(now(),'%Y%m%d%H%i%s'),'','','')";
	db_query($QUE,$DB_CONNECT);

	db_query("insert into ".$table['s_mbrid']." (site,id,pw)values('1','admin','".md5('!234')."')",$DB_CONNECT);
	$QUE = "insert into ".$table['s_mbrdata']." 
	(memberuid,site,auth,sosok,level,comp,admin,adm_view,
	email,name,nic,grade,photo,home,sex,birth1,birth2,birthtype,tel1,tel2,zip,
	addr0,addr1,addr2,job,marr1,marr2,sms,mailing,smail,point,usepoint,money,cash,num_login,pw_q,pw_a,now_log,last_log,last_pw,is_paper,d_regis,tmpcode,sns,addfield)
	values
	('3','1','1','1','18','0','0','',
	'','관리자','관리자','','','','0','0','0','0','','','',
	'','','','','0','0','1','1','0','0','0','0','0','1','','','1',date_format(now(),'%Y%m%d%H%i%s'),'".$date['today']."','0',date_format(now(),'%Y%m%d%H%i%s'),'','','')";
	db_query($QUE,$DB_CONNECT);

	// 그룹정보 입력
	$sosokset = array('A그룹','B그룹','C그룹');
	$i = 0;
	foreach ($sosokset as $_val)
	{
		getDbInsert($table['s_mbrgroup'],'gid,name,num',"'".$i."','".$_val."','0'");
		$i++;
	}
	for ($i = 1; $i < 21; $i++)
	{
		getDbInsert($table['s_mbrlevel'],'gid,name,num,login,post,comment',"'".($i==10?1:0)."','레벨".$i."','0','0','0','0'");
	}
	
	// 메뉴 입력
	db_query("insert into {$table['s_menu']}(gid,site,isson,parent,depth,id,menutype,mobile,app,hidden,reject,name,target,redirect,joint,perm_g,perm_l,layout,imghead,imgfoot,puthead,putfoot,num,d_last,addinfo) values('1','1','1','0','1','1','1','1','0','0','0','사이트 소개','','0','/{$DB['head']}/?m=home&mod=stdpage','','0','','','','0','0','0','','')",$DB_CONNECT);
	db_query("insert into {$table['s_menu']}(gid,site,isson,parent,depth,id,menutype,mobile,app,hidden,reject,name,target,redirect,joint,perm_g,perm_l,layout,imghead,imgfoot,puthead,putfoot,num,d_last,addinfo) values('1','1','0','1','2','2','1','1','0','0','0','인사말','','0','/{$DB['head']}/?m=home&mod=stdpage','','0','','','','0','0','0','','')",$DB_CONNECT);
	db_query("insert into {$table['s_menu']}(gid,site,isson,parent,depth,id,menutype,mobile,app,hidden,reject,name,target,redirect,joint,perm_g,perm_l,layout,imghead,imgfoot,puthead,putfoot,num,d_last,addinfo) values('2','1','0','1','2','3','1','1','0','0','0','오시는길','','0','/{$DB['head']}/?m=home&mod=stdpage','','0','','','','0','0','0','','')",$DB_CONNECT);
	db_query("insert into {$table['s_menu']}(gid,site,isson,parent,depth,id,menutype,mobile,app,hidden,reject,name,target,redirect,joint,perm_g,perm_l,layout,imghead,imgfoot,puthead,putfoot,num,d_last,addinfo) values('2','1','1','0','1','4','1','1','0','0','0','포트폴리오','','0','/{$DB['head']}/?m=home&mod=stdpage','','0','','','','0','0','0','','')",$DB_CONNECT);
	db_query("insert into {$table['s_menu']}(gid,site,isson,parent,depth,id,menutype,mobile,app,hidden,reject,name,target,redirect,joint,perm_g,perm_l,layout,imghead,imgfoot,puthead,putfoot,num,d_last,addinfo) values('1','1','0','4','2','5','1','1','0','0','0','개요','','0','/{$DB['head']}/?m=home&mod=stdpage','','0','','','','0','0','0','','')",$DB_CONNECT);
	db_query("insert into {$table['s_menu']}(gid,site,isson,parent,depth,id,menutype,mobile,app,hidden,reject,name,target,redirect,joint,perm_g,perm_l,layout,imghead,imgfoot,puthead,putfoot,num,d_last,addinfo) values('2','1','0','4','2','6','1','1','0','0','0','이벤트','','0','/{$DB['head']}/?m=home&mod=stdpage','','0','','','','0','0','0','','')",$DB_CONNECT);
	db_query("insert into {$table['s_menu']}(gid,site,isson,parent,depth,id,menutype,mobile,app,hidden,reject,name,target,redirect,joint,perm_g,perm_l,layout,imghead,imgfoot,puthead,putfoot,num,d_last,addinfo) values('3','1','0','4','2','7','1','1','0','0','0','갤러리','','0','/{$DB['head']}/?m=home&mod=stdpage','','0','','','','0','0','0','','')",$DB_CONNECT);
	db_query("insert into {$table['s_menu']}(gid,site,isson,parent,depth,id,menutype,mobile,app,hidden,reject,name,target,redirect,joint,perm_g,perm_l,layout,imghead,imgfoot,puthead,putfoot,num,d_last,addinfo) values('3','1','1','0','1','8','1','1','0','0','0','커뮤니티','','0','/{$DB['head']}/?m=home&mod=stdpage','','0','','','','0','0','0','','')",$DB_CONNECT);
	db_query("insert into {$table['s_menu']}(gid,site,isson,parent,depth,id,menutype,mobile,app,hidden,reject,name,target,redirect,joint,perm_g,perm_l,layout,imghead,imgfoot,puthead,putfoot,num,d_last,addinfo) values('1','1','0','8','2','9','1','1','0','0','0','공지사항','','0','/{$DB['head']}/?m=home&mod=stdpage','','0','','','','0','0','0','','')",$DB_CONNECT);
	db_query("insert into {$table['s_menu']}(gid,site,isson,parent,depth,id,menutype,mobile,app,hidden,reject,name,target,redirect,joint,perm_g,perm_l,layout,imghead,imgfoot,puthead,putfoot,num,d_last,addinfo) values('2','1','0','8','2','10','1','1','0','0','0','최신뉴스','','0','/{$DB['head']}/?m=home&mod=stdpage','','0','','','','0','0','0','','')",$DB_CONNECT);
	db_query("insert into {$table['s_menu']}(gid,site,isson,parent,depth,id,menutype,mobile,app,hidden,reject,name,target,redirect,joint,perm_g,perm_l,layout,imghead,imgfoot,puthead,putfoot,num,d_last,addinfo) values('3','1','0','8','2','11','1','1','0','0','0','자료실','','0','/{$DB['head']}/?m=home&mod=stdpage','','0','','','','0','0','0','','')",$DB_CONNECT);
	db_query("insert into {$table['s_menu']}(gid,site,isson,parent,depth,id,menutype,mobile,app,hidden,reject,name,target,redirect,joint,perm_g,perm_l,layout,imghead,imgfoot,puthead,putfoot,num,d_last,addinfo) values('4','1','1','0','1','12','1','1','0','0','0','사이트 문의','','0','/{$DB['head']}/?m=home&mod=stdpage','','0','','','','0','0','0','','')",$DB_CONNECT);
	db_query("insert into {$table['s_menu']}(gid,site,isson,parent,depth,id,menutype,mobile,app,hidden,reject,name,target,redirect,joint,perm_g,perm_l,layout,imghead,imgfoot,puthead,putfoot,num,d_last,addinfo) values('1','1','0','12','2','13','1','1','0','0','0','FAQ','','0','/{$DB['head']}/?m=home&mod=stdpage','','0','','','','0','0','0','','')",$DB_CONNECT);
	db_query("insert into {$table['s_menu']}(gid,site,isson,parent,depth,id,menutype,mobile,app,hidden,reject,name,target,redirect,joint,perm_g,perm_l,layout,imghead,imgfoot,puthead,putfoot,num,d_last,addinfo) values('2','1','0','12','2','14','1','1','0','0','0','견적문의','','0','/{$DB['head']}/?m=home&mod=stdpage','','0','','','','0','0','0','','')",$DB_CONNECT);
?>