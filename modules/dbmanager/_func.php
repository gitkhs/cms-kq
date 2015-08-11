<?php
if(!defined('__KIMS__')) exit;

function remove_remarks($sql) 
{
	$i = 0; 
	while($i < strlen($sql)) { 
		if($sql[$i] == "#" and ($sql[$i-1] == "\n" or $i==0)) { 
			$j=1;
			while($sql[$i+$j] != "\n") $j++;
			$sql = substr($sql,0,$i) . substr($sql,$i+$j);
		}
		$i++;
	}
	return($sql);
}
function split_sql_file($sql, $delimiter) 
{
	$sql = trim($sql);
	$char = "";
	$last_char = "";
	$ret = array();
	$in_string = true;

	for($i=0; $i<strlen($sql); $i++) {
		$char = $sql[$i];

		if($char == $delimiter && !$in_string) {
			$ret[] = substr($sql, 0, $i);
			$sql = substr($sql, $i + 1);
			$i = 0;
			$last_char = "";
		}

		if($last_char == $in_string && $char == ")")  $in_string = false;
		if($char == $in_string && $last_char != "\\") $in_string = false;
		elseif(!$in_string && ($char == "\"" || $char == "'") && ($last_char != "\\")) $in_string = $char;
		$last_char = $char;
	}

	if (!empty($sql)) $ret[] = $sql;
	return($ret);
}
function get_table_def($db, $table, $ctrn)
{
	global $drop;
	$schema_create = "";
	if(!empty($drop)){
		$schema_create .= "DROP TABLE IF EXISTS $table;$ctrn";
	}
	$schema_create .= "CREATE TABLE $table ($ctrn";

	$result = mysql_db_query($db, "SHOW FIELDS FROM $table");
	while ($row = mysql_fetch_array($result))
	{
		$schema_create .= "   $row[Field] $row[Type]";
		if (!empty($row["Default"]))
		{
			$schema_create .= " DEFAULT '$row[Default]'";
		}
		if ($row["Null"] != "YES")
		{
			$schema_create .= " NOT NULL";
		}
		if ($row["Extra"] != "")
		{
			$schema_create .= " $row[Extra]";
		}
		$schema_create .= ",$ctrn";
	}
	$schema_create = ereg_replace(",".$ctrn."$", "", $schema_create);
	$result = mysql_db_query($db, "SHOW KEYS FROM $table");
	while ($row = mysql_fetch_array($result)){
		$kname=$row['Key_name'];
		if (($kname != "PRIMARY") && ($row['Non_unique'] == 0)) $kname="UNIQUE|$kname";
		if(!is_array($index[$kname])){
			$index[$kname] = array();
		}
		$index[$kname][] = $row['Column_name'];
	}
	if(is_array($index))
	{
		foreach($index as $x => $columns)
		{
			$schema_create .= ",$ctrn";
			if($x == "PRIMARY"){
				$schema_create .= "   PRIMARY KEY (" . implode($columns, ", ") . ")";
			}
			else if (substr($x,0,6) == "UNIQUE") {
				$schema_create .= "   UNIQUE ".substr($x,7)." (" . implode($columns, ", ") . ")";
			}
			else {
				$schema_create .= "   KEY $x (" . implode($columns, ", ") . ")";
			}
		}
	}
	$schema_create .= "$ctrn)";
	return $schema_create;
} 


function get_excel_content($db,$table,$SQL)
{
	$result = mysql_db_query($db, "SELECT * FROM $table $SQL");
	print "<table border=1>\r\n";
		
	print "<tr bgcolor=gold align=center>\r\n";
	for($j = 0; $j < mysql_num_fields($result); $j++) {
		print "<td><b>".mysql_field_name($result,$j)."</b></td>\r\n";
	}
	print "</tr>\r\n";

	while ($row = mysql_fetch_row($result)) {
		print "<tr>\r\n";
		for($j = 0; $j < mysql_num_fields($result); $j++) {
			print "<td>".getUTFtoKR($row[$j])."</td>\r\n";

		}
		print "</tr>\r\n";
	}
	print "</table>\r\n";
}

function get_table_content($db, $table,$my_handler,$SQL)
{
	$result = mysql_db_query($db, "SELECT * FROM $table $SQL");
	$i = 0;
	while ($row = mysql_fetch_row($result))
	{
		set_time_limit(60);
		$schema_insert = "INSERT INTO $table VALUES(";
		for ($j=0; $j<mysql_num_fields($result);$j++)
		{
			if (!isset($row[$j]))
			{
				$schema_insert .= " NULL,";
			}
			elseif ($row[$j] != "")
			{
				$schema_insert .= " '".$row[$j]."',";
			}
			else 
			{
				$schema_insert .= " '',";
			}
		}
		$schema_insert = ereg_replace(",$", "", $schema_insert);
		$schema_insert .= ")";
		$my_handler(trim($schema_insert));
		$i++;
	}
	return (true);
}


function my_handler($sql_insert)
{
	global $asfile,$ctrn;
	echo "$sql_insert;$ctrn";
}
?>