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
<main>
	<div class="restrict flow padding-top">	
		<?php
		    if(perch_member_logged_in()){
			    PerchSystem::set_var('loggedin', 'yes');
		    }else{
			    PerchSystem::set_var('loggedin', 'no');
		    }
			
			$reviewData = unitReviewData(perch_get('s'),$item[0]['cottageName'],$item[0]);
			
			PerchSystem::set_var('reviewsData', $reviewData);
		   
		    perch_collection('Cottages', [
			    "filter"   => "slug",
		        "match"    => "eq",
		        "value"    => perch_get('s'),
		    ]);
			
			$item_title = $item[0]['cottageName'].' - Sleeps '.$item[0]['cottageSleeps'].' in '.$item[0]['cottageLocation']; 
			echo '<div class="row">';
			unitReviews(perch_get('s'),$item[0]['cottageName'],$item[0]);
			echo '</div>';
		?>
	</div>
</main>
<script>
$(document).ready(function(){	
	const container = document.getElementById("myCarousel");
const options = {
  Dots: {
    minCount: 2,
  },
};

new Carousel(container, options);

});
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [{
	"@type": "ListItem",
	"position": 1,
	"name": "Home",
	"item": "https://baytownholidaycottages.co.uk"
  },{
	"@type": "ListItem",
	"position": 2,
	"name": "Accommodation",
	"item": "https://baytownholidaycottages.co.uk/our-cottages"
  },{
	"@type": "ListItem",
	"position": 3,
	"name": "<?= $item[0]['cottageName'] ?>"
  }]
}
</script>
<?php
    perch_layout('global/footer');
?>
