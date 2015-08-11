<?php 
if (!defined('__KIMS__')) exit;

checkAdmin(0);

include_once $g['dir_module'].'_func.php';

if ($_a == 'table_name_change')
{
	if ($old_name != trim($new_name)) {
		@mysql_query("ALTER TABLE $old_name RENAME ".trim($new_name), $DB_CONNECT); 
	}
	getLink('reload','parent.','','');
}
if ($_a == 'table_delete')
{
	@mysql_query("DROP TABLE $Xtbl", $DB_CONNECT);
	getLink('reload','parent.','','');
}
if ($_a == 'table_empty')
{
	@mysql_query("TRUNCATE TABLE $Xtbl", $DB_CONNECT);
	getLink('reload','parent.','','');
}
if ($_a == 'table_dump')
{
	if ($db_dump == 'all') {
		header("Content-disposition: filename=".$DB['name']."_bakup.sql");
	}
	else {
		header("Content-disposition: filename=".$Xtbl.".sql");
	}
	header("Content-type: application/octetstream");
	header("Pragma: no-cache");
	header("Expires: 0");

	if (eregi("Win",$_SERVER['HTTP_USER_AGENT'])) {
		$ctrn = "\r\n";
	} else {
		$ctrn = "\n";
	}
	@set_time_limit(600);

	if ($db_dump == 'all') {
		$i = 0;
		$Xtbls = mysql_list_tables($DB['name']);
		$num_tables = mysql_num_rows($Xtbls);
		while ($i < $num_tables) {
			$Xtbl = mysql_tablename($Xtbls, $i);

			print "#---------------------------------------------------------".$ctrn;
			print "# 호스트: ".$DB['host']." 선택한 디비 : ".$DB['name'].$ctrn;
			print "# 테이블 네임 : ".$Xtbl.$ctrn;
			print "# --------------------------------------------------------".$ctrn.$ctrn;
			print get_table_def($DB['name'], $Xtbl, $ctrn).";".$ctrn;

			print $ctrn.$ctrn;
			print "#---------------------------------------------------------".$ctrn;
			print "# ".$Xtbl." INSERT DATA".$ctrn;
			print "# --------------------------------------------------------".$ctrn.$ctrn;
			get_table_content($DB['name'], $Xtbl, "my_handler",urldecode($SQL));

			$i++;
		}
	}
	else {

		print "#---------------------------------------------------------".$ctrn;
		print "# 호스트: ".$DB['host']." 선택한 디비 : ".$DB['name'].$ctrn;
		print "# 테이블 네임 : ".$Xtbl.$ctrn;
		print "# --------------------------------------------------------".$ctrn.$ctrn;
		print get_table_def($DB['name'], $Xtbl, $ctrn).";".$ctrn;
		if ( $dump_type == 'dump_all') {
			print "$ctrn$ctrn";
			print "#---------------------------------------------------------".$ctrn;
			print "# ".$Xtbl." INSERT DATA".$ctrn;
			print "# --------------------------------------------------------".$ctrn.$ctrn;
			get_table_content($DB['name'], $Xtbl, "my_handler",urldecode($SQL));
		}
	}
	exit;
}

if($_a == 'table_excel')
{
	header( "Content-type: application/vnd.ms-excel" ); 
	header( "Content-Disposition: attachment; filename=".$Xtbl.".xls" ); 
	header( "Content-Description: PHP4 Generated Data" );
	get_excel_content($DB['name'], $Xtbl , urldecode($SQL));
	exit;
}

if ($_a == 'field_alter') {

	if ( $field_default || $field_default == "0" ){
		$field_default_str = "DEFAULT '".$field_default."'";
	}
	if ( $field_null ) {
		$field_null_str = "NOT NULL";
	}
	if ( $field_type != 'TEXT' && $field_type != 'MEDIUMTEXT') {
		$field_length_str = "( ".$field_length." )";
	}
	else {
		$field_default_str = "";

	}

	if ($new == 'yes') {
		if ($field_nav == '<-') {
			$field_nav_str = "FIRST";
		}
		else if ($field_nav == '->') {
			$field_nav_str = "";
		}
		else {
			$field_nav_str = "AFTER `".$field_nav."`";
		}
		$my_query = "ALTER TABLE `$Xtbl` 
		ADD `$field` $field_type$field_length_str $field_view
		$field_default_str $field_null_str $field_atinc $field_nav_str";
		@mysql_query($my_query, $DB_CONNECT);
	}
	else {
		
		$my_query = "ALTER TABLE `$Xtbl` 
		CHANGE `$field` `$field_name` $field_type$field_length_str $field_view
		$field_default_str $field_null_str $field_atinc";
		
		@mysql_query($my_query, $DB_CONNECT);
	}

	getLink('reload','parent.','','');
}

if ($_a == 'field_delete') {
	@mysql_query("ALTER TABLE `$Xtbl` DROP `$field`", $DB_CONNECT);
	getLink('reload','parent.','','');
}
if ($_a == 'field_primary') {
	@mysql_query("ALTER TABLE `$Xtbl` DROP PRIMARY KEY , ADD PRIMARY KEY (`$field`)", $DB_CONNECT);
	getLink('reload','parent.','','');
}
if ($_a == 'field_index') {
	@mysql_query("ALTER TABLE `$Xtbl` ADD INDEX (`$field`) ", $DB_CONNECT);
	getLink('reload','parent.','','');
}
if ($_a == 'field_unique') {
	@mysql_query("ALTER TABLE `$Xtbl` ADD UNIQUE (`$field`) ", $DB_CONNECT);
	getLink('reload','parent.','','');
}
if ($_a == 'field_fulltext') {
	@mysql_query("ALTER TABLE `$Xtbl` ADD FULLTEXT (`$field`) ", $DB_CONNECT);
	getLink('reload','parent.','','');
}
if ($_a == 'field_primary1') {
	@mysql_query("ALTER TABLE `$Xtbl` DROP PRIMARY KEY", $DB_CONNECT);
	getLink('reload','parent.','','');
}
if ($_a == 'field_index1') {
	@mysql_query("ALTER TABLE `$Xtbl` DROP INDEX `$field`", $DB_CONNECT);
	getLink('reload','parent.','','');
}

if ($_a == 'mt_delete') {	
	foreach($_POST as $key => $value)
	{
		if(substr($key,0,5) == 'multi') {
			@mysql_query("DROP TABLE `$value`;", $DB_CONNECT);
		}
	}
	getLink('reload','parent.','','');
}
if ($_a == 'mt_empty') {
	foreach($_POST as $key => $value)
	{
		if(substr($key,0,5) == 'multi') {
			@mysql_query("TRUNCATE TABLE `$value`", $DB_CONNECT);
		}
	}
	getLink('reload','parent.','','');
}
if ($_a == 'mt_optimize') {
	foreach($_POST as $key => $value)
	{
		if(substr($key,0,5) == 'multi') {
			@mysql_query("OPTIMIZE TABLE `$value`", $DB_CONNECT);
		}
	}
	getLink('reload','parent.','','');
}
if ($_a == 'mt_repair') {
	foreach($_POST as $key => $value)
	{
		if(substr($key,0,5) == 'multi') {
			@mysql_query("REPAIR TABLE `$value`", $DB_CONNECT);
		}
	}
	getLink('reload','parent.','','');
}
if ($_a == 'record_delete') {
	@mysql_query("DELETE FROM $Xtbl WHERE $wehre='$value'",$DB_CONNECT);
	getLink('reload','parent.','','');
}
if ($_a == 'record_update')
{

	if($ggg_save_type == 'update') {
		foreach($_POST as $key => $val)
		{
			if (substr($key,0,4) != 'ggg_' && $key != 'r' && $key != 'm' && $key != 'a' && $key != '_a' && $key != 'uid') {
				if (${ggg_f_.$key}) {
					$sq .= "$key=${ggg_f_.$key}(".$val."), "; 
				}
				else {
					$sq .= "$key='".$val."', "; 
				}
			}
		}
		$query = "UPDATE $ggg_table SET ".substr($sq,0,strlen($sq)-2)." WHERE $ggg_where='$ggg_value'";

		@mysql_query($query,$DB_CONNECT);
	}
	else {
		$i = 0;
		foreach($_POST as $key => $val)
		{
			if (substr($key,0,4) != 'ggg_' && $key != 'r' && $key != 'm' && $key != 'a' && $key != '_a') {
				if ($i == 0) {$ggg_where = $key; $ggg_value = $val; }
				$sq .= "$key, ";
				if (${ggg_f_.$key}) {
					$sq1 .= "${ggg_f_.$key}(".$val."), "; 
				}
				else {
					$sq1 .= "'".$val."', ";
				}
				$i++;
			}
		}
		@mysql_query("INSERT INTO $ggg_table (".substr($sq,0,strlen($sq)-2).") VALUES (".substr($sq1,0,strlen($sq1)-2).")",$DB_CONNECT);
	}

	getLink($g['s'].'/?r='.$r.'&m=admin&module='.$m.'&type=view&Xtbl='.$ggg_table,'parent.','','');
}
?>