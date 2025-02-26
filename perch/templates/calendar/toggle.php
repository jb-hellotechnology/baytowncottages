<?php
	
	include('library.php');
	
	Connect();
	
	$cottage = $_POST['cottage'];
	$date = $_POST['date'];
	
	$rows = mysql_num_rows(mysql_query("SELECT * FROM availability WHERE date='$date' AND propertySlug='$cottage'"));
	if($rows==1){
		$query = mysql_query("DELETE FROM availability WHERE date='$date' AND propertySlug='$cottage'");
	}else{
		$query = mysql_query("INSERT INTO availability (date,propertySlug) VALUES ('$date','$cottage')");
	}
	
?>