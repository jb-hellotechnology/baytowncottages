<?php
	
	function Connect()
	{
		$dbh=mysql_connect ("localhost", "rhbcottages", "PRhfxyGWJSfVNHzA") or die ('I cannot connect to the database because: ' . mysql_error());
		mysql_select_db ("rhbcottages"); 
	}
	
?>