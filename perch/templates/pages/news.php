<?php	
	perch_layout('global/header');
?>
<main>
	<div class="restrict flow padding-top">
		<h1>Baytown Holiday Cottages Blog</h1>
		<?php perch_blog_recent_posts(12); ?>
		
		<h2>Archive</h2>
		<?php perch_blog_date_archive_years(); ?>
		
		<h2>Tags</h2>
		<?php perch_blog_tags(); ?>
	</div>
</main>
<?php
    perch_layout('global/footer');
?>
