<?php	
	perch_layout('global/header');
?>
</section>
<section class="page">
	<section class="restrict">
		<section class="row">
			<section class="column two-thirds">
				<?php 
					
					if($_POST){
						//LOG REVIEW
						$review['reviewCode'] = perch_get('review');
						$review['rating'] = $_POST['rating'];
						$review['comments'] = strip_tags($_POST['comments']);
						$review['timestamp'] = date('Y-m-d H:i:s');
						logreview($review);
					}
					
					reviewform(perch_get('review')); 
				
				?>
			</section>
			<section class="column third paginate-hide">
				<?php perch_content('Social Stuff'); ?>
			</section>
		</section>
	</section>
</section>
<?php
    perch_layout('global/footer');
?>
