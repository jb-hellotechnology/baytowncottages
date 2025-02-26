<?php	
	perch_layout('global/header');
?>
<main>
	<div class="restrict">
		<?php perch_events_calendar(array(
			'past-events' => true,
		)); ?>
	</div>
</main>
<?php
    perch_layout('global/footer');
?>
