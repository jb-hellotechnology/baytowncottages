<?php	
	perch_layout('global/header');
?>
<main>
	<div class="restrict flow padding-top">
		<p><a class="more-cottages" href="javascript:;" onclick="window.history.back();return false;">&larr; Back to Calendar</a></p>
		<?php
		perch_events_custom(array(
		    'filter'   => 'eventSlug',
		    'match'    => 'eq',
		    'value'    => perch_get('s'),
		    'template' => 'events/listing/list.html'
		));
		?>
		<h2>Archive</h2>
		<?php perch_blog_date_archive_years(); ?>
		
		<h2>Tags</h2>
		<?php perch_blog_tags(); ?>
	</div>
</main>
<?php
    perch_layout('global/footer');
?>
