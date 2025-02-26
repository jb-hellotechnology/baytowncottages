<?php
	
	include('library.php');
	
	Connect();
	
	$cottage = $_POST['cottage'];
	$id = $_POST['id'];
	
	$query = mysql_query("DELETE FROM pricing WHERE propertySlug='$cottage' AND pricingID='$id'");

?>