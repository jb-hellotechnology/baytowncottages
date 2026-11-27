<?php

header('Content-Type: application/json');

$unit    = strip_tags($_POST['unit']    ?? '');
$arrival = strip_tags($_POST['arrival'] ?? '');
$minN    = (int) ($_POST['min']         ?? 1);
$maxN = min((int) ($_POST['max'] ?? 14), 14);

if (!$unit || !$arrival) {
	echo json_encode(['error' => 'Missing parameters']);
	exit;
}

$SimpleCalendar = new Simple_Calendars();
$unitData       = $SimpleCalendar->unitSlug($unit);

if (!$unitData) {
	echo json_encode(['error' => 'Unit not found']);
	exit;
}

$aD      = explode('-', $arrival); // [Y, m, d]
$options = [];

$blocked = ['12-24', '12-25', '12-26', '12-31', '01-01'];

for ($i = $minN; $i <= $maxN; $i++) {

	$depTimestamp = mktime(0, 0, 0, $aD[1], (int)$aD[2] + $i, $aD[0]);
	$depDate      = date('Y-m-d', $depTimestamp);
	$depDateShort = date('m-d',   $depTimestamp);
	$depDay       = date('D',     $depTimestamp);
	$depLabel     = date('l jS F Y', $depTimestamp);

	// Skip blocked departure dates
	if (in_array($depDateShort, $blocked)) {
		continue;
	}

	// Get pricing period that covers the departure date
	$pricing = $SimpleCalendar->getunitPricingDate($depDate, $unitData['unitID']);

	if ($pricing && $pricing['strict'] === 'on') {

		$changeOver = $pricing['changeOver'];
		$valid      = false;

		switch ($changeOver) {
			case 'Sat - Sat':
				$valid = ($depDay === 'Sat');
				break;
			case 'Fri - Fri':
				$valid = ($depDay === 'Fri');
				break;
			case 'Sun - Sun':
				$valid = ($depDay === 'Sun');
				break;
			case 'Mon - Mon':
				$valid = ($depDay === 'Mon');
				break;
			case 'Tue - Tue':
				$valid = ($depDay === 'Tue');
				break;
			case 'Wed - Wed':
				$valid = ($depDay === 'Wed');
				break;
			case 'Thu - Thu':
				$valid = ($depDay === 'Thu');
				break;
			case 'Fri/Mon':
				$valid = ($depDay === 'Fri' || $depDay === 'Mon');
				break;
			case 'Sat/Tue':
				$valid = ($depDay === 'Sat' || $depDay === 'Tue');
				break;
			case 'Any Day':
				// Any Day strict = depart on same day of week as arrival
				$arrDay = date('D', mktime(0, 0, 0, $aD[1], $aD[2], $aD[0]));
				$valid  = ($depDay === $arrDay);
				break;
		}

		if (!$valid) {
			continue;
		}
	}

	$options[] = [
		'nights' => $i,
		'label'  => $i . ' Night' . ($i === 1 ? '' : 's') . ' (Depart ' . $depLabel . ')',
	];
}

echo json_encode(['options' => $options]);