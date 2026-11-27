<?php	
	perch_layout('global/header');
?>
<main>
	<div class="restrict flow padding-top">
		<?php perch_content('Page Content'); ?>
		<p><a href="/our-cottages/property/<?php echo perch_get('s'); ?>">Click Here to Continue Booking</a></p>
	</div>
</main>
<?php
    perch_layout('global/footer');
?>
