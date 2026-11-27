<?php	
	perch_layout('global/header');
?>
</section>
<section class="page">
	<section class="restrict">
		<section class="row">
			<?php perch_events_calendar(array(
				'past-events' => true,
			)); ?>
		</section>
	</section>
</section>
<?php
    perch_layout('global/footer');
?>
