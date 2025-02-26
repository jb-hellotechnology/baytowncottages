<?php
	
	include('library.php');
	
	Connect();
	
	$cottage = $_POST['cottage'];
	$id = $_POST['id'];
	$freeText = $_POST['freeText'];
	
	$query = mysql_query("UPDATE pricing SET freeText='$freeText' WHERE propertySlug='$cottage' AND pricingID='$id'");

	echo 'Updated!';
?>