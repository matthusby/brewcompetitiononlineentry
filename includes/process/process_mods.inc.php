<?php 
/*
 * Module:      process_special_best_info.inc.php
 * Description: This module does all the heavy lifting for adding/editing info in the "special_best_info" table
 */

if (($_POST['mod_extend_function_admin'] == "") && ($_POST['mod_extend_function'] == 9)) $mod_extend_function_admin = "default"; 
else $mod_extend_function_admin = $_POST['mod_extend_function_admin'];

if ($action == "add") {
	$insertSQL = sprintf("
				INSERT INTO $mods_db_table 
				(
				mod_name,
				mod_type, 
				mod_extend_function, 
				mod_extend_function_admin, 
				mod_filename, 
				mod_description, 
				mod_permission, 
				mod_rank, 
				mod_display_rank
				) 
				VALUES 
				(
				%s, %s, %s, %s, %s,
				%s, %s, %s, %s
				)",
				GetSQLValueString(strtr($_POST['mod_name'],$html_string), "text"),
				GetSQLValueString($_POST['mod_type'], "int"),
				GetSQLValueString($_POST['mod_extend_function'], "int"),
				GetSQLValueString($mod_extend_function_admin, "text"),
				GetSQLValueString($_POST['mod_filename'], "text"),			   
				GetSQLValueString(strip_newline($_POST['mod_description']), "text"),
				GetSQLValueString($_POST['mod_permission'], "int"),
				GetSQLValueString($_POST['mod_rank'], "int"),
				GetSQLValueString($_POST['mod_display_rank'], "int")
				);

	mysql_select_db($database, $brewing);
	$Result1 = mysql_query($insertSQL, $brewing) or die(mysql_error());
	$pattern = array('\'', '"');
  	$insertGoTo = str_replace($pattern, "", $insertGoTo); 
  	header(sprintf("Location: %s", stripslashes($insertGoTo)));					   
}

if ($action == "edit") {
	$updateSQL = sprintf("
			UPDATE $mods_db_table SET 
			mod_name=%s,
			mod_type=%s, 
			mod_extend_function=%s, 
			mod_extend_function_admin=%s, 
			mod_filename=%s, 
			mod_description=%s, 
			mod_permission=%s, 
			mod_rank=%s, 
			mod_display_rank=%s
			WHERE id=%s",
			GetSQLValueString(strtr($_POST['mod_name'],$html_string), "text"),
			GetSQLValueString($_POST['mod_type'], "int"),
			GetSQLValueString($_POST['mod_extend_function'], "int"),
			GetSQLValueString($mod_extend_function_admin, "text"),
			GetSQLValueString($_POST['mod_filename'], "text"),			   
			GetSQLValueString(strip_newline($_POST['mod_description']), "text"),
			GetSQLValueString($_POST['mod_permission'], "int"),
			GetSQLValueString($_POST['mod_rank'], "int"),
			GetSQLValueString($_POST['mod_display_rank'], "int"),
			GetSQLValueString($id, "int"));

	mysql_select_db($database, $brewing);
	$Result1 = mysql_query($updateSQL, $brewing) or die(mysql_error());
	$pattern = array('\'', '"');
  	$updateGoTo = str_replace($pattern, "", $updateGoTo); 
  	header(sprintf("Location: %s", stripslashes($updateGoTo)));					   
}


?>