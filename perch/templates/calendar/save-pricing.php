<?php
	
	include('library.php');
	
	Connect();
	
	$cottage = $_POST['cottage'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$freeText = $_POST['freeText'];
	$minstay = $_POST['minstay'];
	$changeover = $_POST['changeover'];
	$price2 = $_POST['price2'];
	$price3 = $_POST['price3'];
	$price4 = $_POST['price4'];
	$price5 = $_POST['price5'];
	$price6 = $_POST['price6'];
	$price7 = $_POST['price7'];
	
	$query = mysql_query("INSERT INTO pricing (propertySlug,startDate,endDate,freeText,minStay,changeover,price2,price3,price4,price5,price6,price7) VALUES ('$cottage','$start','$end','$freeText','$minstay','$changeover','$price2','$price3','$price4','$price5','$price6','$price7')");
	
?>