<?php	

	$item = perch_collection('Cottages', [
	   'filter' => 'slug',
	   'value' => perch_get('s'),
	   'match' => 'eq',
	   'skip-template' => true,
	]);
	$item_title = $item[0]['cottageName'].' - Sleeps '.$item[0]['cottageSleeps'].' in '.$item[0]['cottageLocation']; 

	perch_layout('global/header', [
	   'page_title' => perch_page_title(true),
	   'item_title' => $item_title,
	   'item_description' => strip_tags($item[0]['cottageShortDescription']),
	]);
?>
</section>
<section class="page">
	<section class="restrict">
		<section class="row">	
			<?php
			    if(perch_member_logged_in()){
				    PerchSystem::set_var('loggedin', 'yes');
			    }else{
				    PerchSystem::set_var('loggedin', 'no');
			    }
			    
			    perch_collection('Cottages', [
				    "filter"   => "slug",
			        "match"    => "eq",
			        "value"    => perch_get('s'),
			    ]);
			    
			    
			    
			    $item = perch_collection('Cottages', [
				   'match' => 'eq',
				   'value' => perch_get('s'),
				   'count' => 1,
				   'skip-template' => true,
				]);
				
				$item_title = $item[0]['cottageName'].' - Sleeps '.$item[0]['cottageSleeps'].' in '.$item[0]['cottageLocation']; 

				unitReviews(perch_get('s'));
			?>
		</section>
	</section>
</section>
<?php
    perch_layout('global/footer');
?>
