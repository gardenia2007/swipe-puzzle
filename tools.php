<?php
	include_once("config.php");
	function db_setup() 
	{
		mysql_connect("localhost", "root", "");
		mysql_select_db("wbpuzzle");
		mysql_query("set names 'utf8'");
	}

	function redirect($route)
	{
		header("Location: " . WEB_ROOT . $route);
	}
?>
