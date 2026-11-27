<?php	
	perch_layout('global/header', [
	   'page_title' => perch_page_title(true),
	   'item_title' => perch_blog_post_field(perch_get('s'), 'postTitle', true),
	   'item_description' => strip_tags(perch_blog_post_field(perch_get('s'), 'excerpt', true)),
	]);
?>
</section>
<section class="page">
	<section class="restrict">
		<section class="row">
			<section class="column two-thirds">
				<?php perch_blog_post(perch_get('s')); ?>
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
