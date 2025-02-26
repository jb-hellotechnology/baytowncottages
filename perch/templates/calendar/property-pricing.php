<?php if (!defined('PERCH_RUNWAY')) include($_SERVER['DOCUMENT_ROOT'].'/perch/runtime.php'); ?>
<?php

	$cottage = strip_tags($_GET['id']);
	
	echo "<h3>Property Pricing</h3>";
	simple_calendar_unit_pricing($cottage);	

?>