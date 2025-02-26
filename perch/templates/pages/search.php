<?php	
	perch_layout('global/header');
?>
<main>
	<div class="restrict padding-top flow">
	    <?php 
		    perch_content_search(perch_get('q'));
		?>
	</div>
</main>
<?php
    perch_layout('global/footer');
?>
