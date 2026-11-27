<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

perch_layout('global/header');

/**
 * Check availability for a list of cottages.
 *
 * @param array  $cottage_slugs  Slugs/IDs of cottages to check (from Perch collection)
 * @param string $arrival        Arrival date string, e.g. '2026-07-12'
 * @param int    $nights         Number of nights
 * @return array                 Slugs of cottages that ARE available
 */
function get_available_cottages(array $cottage_slugs, string $arrival, int $nights): array {
	return get_available_cottages_runtime($cottage_slugs, $arrival, $nights);
}

/**
 * Fetch raw cottage data from the Perch collection without rendering,
 * so we can inspect slugs/IDs before the availability filter is applied.
 * perch_collection() with 'return-html' => true returns rendered HTML,
 * which isn't useful here — so we use the Perch runtime directly.
 */
function get_collection_slugs(array $filters): array {

	$items = perch_collection('Cottages', [
		'template'   => 'cottages/browse.html',
		'sort'		 => '_order',
		'sort-order' => 'ASC',
		'filter' => 'hide',
		'match' => 'neq',
		'value' => 'true',
		'skip-template' => true
	]);

	if (!$items) {
		return [];
	}

	$slugs = [];
	foreach ($items as $item) {
		// Adjust the key below to whatever field uniquely identifies
		// a cottage in your availability system (slug, ID, booking ref, etc.)
		$slugs[] = $item['slug'];
	}

	return $slugs;

}

// ---------------------------------------------------------------------------
// Sanitise inputs
// ---------------------------------------------------------------------------

$price       = strip_tags($_GET['price']       ?? '');
$location    = strip_tags($_GET['location']    ?? '');
$sleeps      = strip_tags($_GET['sleeps']      ?? '');
$wifi        = strip_tags($_GET['wifi']        ?? '');
$petfriendly = strip_tags($_GET['petfriendly'] ?? '');
$dogs        = max(0, (int) ($_GET['dogs'] ?? 0));
$parking     = strip_tags($_GET['parking']     ?? '');
$arrival     = strip_tags($_GET['arrival']     ?? '');
$nights      = (int) ($_GET['nights']          ?? 0);

// Validate arrival date format
$arrival_valid = false;
if ($arrival !== '') {
	$dt = DateTime::createFromFormat('Y-m-d', $arrival);
	$arrival_valid = $dt && $dt->format('Y-m-d') === $arrival && $dt >= new DateTime('today');
}

// Availability filtering only applies when both date fields are present and valid
$filter_by_availability = $arrival_valid && $nights > 0;

// ---------------------------------------------------------------------------
// Perch filter helpers (unchanged from your original)
// ---------------------------------------------------------------------------

$wifi_eq  = ($wifi        === 'on') ? 'eq'  : 'in';
$wifi_val = ($wifi        === 'on') ? 'WiFi'           : 'WiFi, ';

$pet_eq   = ($petfriendly === 'on') ? 'eq'  : 'in';
$pet_val  = ($petfriendly === 'on') ? 'Dogs Welcome'   : 'Dogs Welcome, ';

$park_eq  = ($parking     === 'on') ? 'eq'  : 'in';
$park_val = ($parking     === 'on') ? 'parkingpermit'  : 'parkingpermit, ';
?>

<main>

	<div class="restrict flow padding-top">
	<?php

	$is_search = ($sleeps !== '');

	if (!$is_search):
		// ---- Default browse view (no search submitted) ----
		perch_content('Cottage Intro');
		perch_collection('Cottages', [
			'template'   => 'cottages/browse.html',
			'sort'       => '_order',
			'sort-order' => 'ASC',
			'filter'     => 'hide',
			'match'      => 'neq',
			'value'      => 'true',
		]);
		perch_content('Cottage Additional Info');

	else:
		// ---- Search results view ----

		$location_labels = [
			"" => "Any",
			"Lower Robin Hood's Bay" => "Lower Robin Hood's Bay",
			"Upper Robin Hood's Bay" => "Upper Robin Hood's Bay",
			"Fylingthorpe"           => "Fylingthorpe",
		];
		echo '<h2>Holiday Cottage Search Results</h2>';

		// Base Perch filters (location, sleeps, amenities, visibility)
		$perch_filters = [
			['filter' => 'cottageSleeps',   'match' => 'gte',    'value' => $sleeps],
			['filter' => 'wifi',            'match' => $wifi_eq, 'value' => $wifi_val],
			['filter' => 'parkingpermit',   'match' => $park_eq, 'value' => $park_val],
			['filter' => 'hide',            'match' => 'neq',    'value' => 'true'],
		];
		
		// Only add location when location
		if($location){
			$perch_filters[] = ['filter' => 'cottageLocation', 'match' => 'eq',     'value' => $location];
		}
		
		// Only add pet filter when dogs > 0
		if ($dogs > 0) {
			$perch_filters[] = ['filter' => 'petquantity', 'match' => 'gte', 'value' => $dogs];
		}

		// ---- Availability filter ----
		// If arrival + nights were supplied, fetch slugs from the collection
		// first, check availability, then restrict Perch to only those slugs.

		if ($filter_by_availability) {

			$all_slugs = get_collection_slugs($perch_filters);

			if (empty($all_slugs)) {
				echo '<p>No cottages match your search criteria.</p>';
			} else {
				$available_slugs = get_available_cottages($all_slugs, $arrival, $nights);

				if (empty($available_slugs)) {
					echo '<p>Sorry, no cottages are available for those dates. '
					   . 'Please try a different arrival date or duration.</p>';
				} else {
					// Add the availability restriction into the Perch filter set
					$perch_filters[] = [
						'filter' => 'slug',   // the field that matches your availability system key
						'match'  => 'in',
						'value'  => implode(',', $available_slugs),
					];
					
					//print_r($perch_filters);

					perch_collection('Cottages', [
						'template'   => 'cottages/browse.html',
						'filter'     => $perch_filters,
						'sort'       => 'cottageSleeps',
						'sort-order' => 'desc',
						'sort-type'  => 'numeric',
						'paginate'   => false,
						'count'      => 200,
					]);
				}
			}

		} else {
			// No date filter — run the standard Perch query
			perch_collection('Cottages', [
				'template'   => 'cottages/browse.html',
				'filter'     => $perch_filters,
				'sort'       => 'cottageSleeps',
				'sort-order' => 'asc',
				'sort-type'  => 'numeric',
				'paginate'   => false,
				'count'      => 200,
			]);
		}

	endif;
	?>
	</div>
</main>

<?php perch_layout('global/footer'); ?>