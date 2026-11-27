<?php	
	perch_layout('global/header');
?>
<main>
	<div class="restrict padding-top flow">
		<script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>
		<?php perch_content('Flexible Content'); ?>
		<?php
		$cottages = perch_collection('Cottages', [
			'sort'       => '_order',
			'sort-order' => 'ASC',
			'filter'     => 'hide',
			'match'      => 'neq',
			'value'      => 'true',
			'skip-template' => true
		]);
	
		// Build a PHP array to pass to JavaScript
		$map_cottages = [];
		foreach ($cottages as $cottage) {
			if($cottage['latitude']){
			$map_cottages[] = [
				'lat'    => (float) $cottage['latitude'],
				'lng'    => (float) $cottage['longitude'],
				'name'   => htmlspecialchars($cottage['cottageName'], ENT_QUOTES),
				'sleeps' => htmlspecialchars($cottage['cottageSleeps'], ENT_QUOTES),
				'parkingpermit'   => htmlspecialchars($cottage['parkingpermit'], ENT_QUOTES),
				'petfriendly'   => htmlspecialchars($cottage['petfriendly'], ENT_QUOTES),
				'slug'   => htmlspecialchars($cottage['slug'], ENT_QUOTES),
				'image'   => htmlspecialchars($cottage['mainImage'], ENT_QUOTES),
			];
			}
		}
		?>
	
		<div id="cottages-map" style="width: 100%; height: 80vh; margin-top: 2rem;"></div>
	
		<script>
			const cottages = <?php echo json_encode($map_cottages); ?>;
	
			function initMap() {
				// Default centre — adjust to suit your area
				const defaultCenter = { lat: 54.434422, lng: -0.535100 };
	
				const map = new google.maps.Map(document.getElementById('cottages-map'), {
					zoom: 13,
					center: defaultCenter,
				});
	
				const infoWindow = new google.maps.InfoWindow();
				const bounds = new google.maps.LatLngBounds();
				
				const markers = [];
				new markerClusterer.MarkerClusterer({
					map,
					markers,
					algorithm: new markerClusterer.SuperClusterAlgorithm({ maxZoom: 16 }),
				});
				
				cottages.forEach(cottage => {
					const position = { lat: cottage.lat, lng: cottage.lng };
				
					const marker = new google.maps.Marker({
						position,
						title: cottage.name,   // note: no `map` property
					});
				
					bounds.extend(position);
				
					// Build the feature list — add more items here as you add fields
					const features = [
						`Sleeps ${cottage.sleeps}`,
						cottage.parkingpermit === 'parkingpermit' ? 'Parking' : null,
						cottage.petfriendly === 'Dogs Welcome' ? 'Dogs Welcome' : null,
					].filter(Boolean);
					
					const contentString = `
						<div class="cottage-popup">
							<img src="${cottage.image}" alt="${cottage.name}">
							<h3>${cottage.name}</h3>
							<ul>
								${features.map(f => `<li>${f}</li>`).join('')}
							</ul>
							<a class="popup-btn"
							   href="https://baytownholidaycottages.co.uk/our-cottages/property?s=${cottage.slug}">
								View property &rarr;
							</a>
						</div>`;
				
					marker.addListener('click', () => {
						infoWindow.setContent(contentString);
						infoWindow.open(map, marker);
					});
				
					markers.push(marker);
				});
	
				new markerClusterer.MarkerClusterer({
					map,
					markers,
					onClusterClick: (event, cluster, map) => {
						map.fitBounds(cluster.bounds);
						// Cap how far fitBounds is allowed to zoom in
						google.maps.event.addListenerOnce(map, 'idle', () => {
							if (map.getZoom() > 18) {
								map.setZoom(18);
							}
						});
					},
				});
				
				// Fit the map to show all markers
				if (cottages.length > 0) {
					map.fitBounds(bounds);
				}
			}
		</script>
	
		<!-- Replace YOUR_API_KEY with your actual Google Maps API key -->
		<script
			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCY8_CrfLYeSOR6_BpfwqJ6hSTsv15QGAo&callback=initMap"
			async defer>
		</script>
		<style>
			.cottage-popup {
				max-width: 240px;
				font-family: sans-serif;
				line-height: 1.5;
			}
			.cottage-popup img {
				width: 100%;
				height: 130px;
				object-fit: cover;
				border-radius: 6px;
				display: block;
				margin-bottom: 8px;
			}
			.cottage-popup h3 {
				font-size: 1rem;
				margin: 0 0 6px;
			}
			.cottage-popup ul {
				list-style: none;
				margin: 0 0 10px;
				padding: 0;
				font-size: 0.85rem;
			}
			.cottage-popup li {
				padding: 2px 0;
				border-bottom: 1px solid #eee;
			}
			.cottage-popup li:last-child {
				border-bottom: none;
			}
			.cottage-popup .popup-btn {
				display: block;
				text-align: center;
				background: #0066cc;
				color: #fff;
				text-decoration: none;
				padding: 8px 12px;
				border-radius: 6px;
				font-size: 0.85rem;
				font-weight: bold;
			}
			.cottage-popup .popup-btn:hover {
				background: #004e9e;
			}
		</style>
	</div>
</main>
<?php
	perch_layout('global/footer');
?>
