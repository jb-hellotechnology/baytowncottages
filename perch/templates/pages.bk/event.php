<?php	
	perch_layout('global/header');
?>
</section>
<section class="page">
	<section class="restrict">
		<section class="row">
			<section class="column two-thirds">
				<p><a class="more-cottages" href="javascript:;" onclick="window.history.back();return false;"">&larr; Back to Calendar</a></p>
				<?php
				perch_events_custom(array(
				    'filter'   => 'eventSlug',
				    'match'    => 'eq',
				    'value'    => perch_get('s'),
				    'template' => 'events/listing/list.html'
				));
				?>
			</section>
			<section class="column third">
				<h4>Archive</h4>
				<?php perch_blog_date_archive_years(); ?>
				
				<h4>Tags</h4>
				<?php perch_blog_tags(); ?>
				
				<?php perch_content('Social Stuff'); ?>
			</section>
		</section>
	</section>
</section>
<?php
    perch_layout('global/footer');
?>
