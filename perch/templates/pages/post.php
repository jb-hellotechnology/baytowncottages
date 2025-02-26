<?php	
	perch_layout('global/header', [
	   'page_title' => perch_page_title(true),
	   'item_title' => perch_blog_post_field(perch_get('s'), 'postTitle', true),
	   'item_description' => strip_tags(perch_blog_post_field(perch_get('s'), 'excerpt', true)),
	]);
?>
<main>
	<div class="restrict padding-top flow">
		<?php perch_blog_post(perch_get('s')); ?>
		<h2>Archive</h2>
		<?php perch_blog_date_archive_years(); ?>
		
		<h2>Tags</h2>
		<?php perch_blog_tags(); ?>
	</div>
</main>
<?php
    perch_layout('global/footer');
?>
