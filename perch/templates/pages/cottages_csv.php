<?php
	$cottages = perch_collection('Cottages', [
		'sort'       => '_order',
		'sort-order' => 'ASC',
		'filter'     => 'hide',
		'match'      => 'neq',
		'value'      => 'true',
		'template'	 => 'cottages/csv.html'
	]);
?>