<?php	
	perch_layout('global/header');
?>
<main>
	<div class="restrict padding-top flow">
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
	</div>
</main>
<?php
    perch_layout('global/footer');
?>
