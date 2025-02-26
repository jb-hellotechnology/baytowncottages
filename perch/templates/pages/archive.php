<?php	
	perch_layout('global/header');
?>
<main>
	<div class="restrict flow padding-top">
		<h1>Baytown Holiday Cottages Blog Archive</h1>
		<?php
		if ($_GET['tag']<>'') {
            echo '<h2>Posts by Tag: '.perch_blog_tag(perch_get('tag'),true).'</h2>';

            perch_blog_custom(array(
				'tag'   	 => perch_get('tag'),
				'template' => 'post_in_list.html',
            ));
        }
        
        if ($_GET['year']<>'') {
            echo '<h2>Posts by Year: '.perch_get('year').'</h2>';

            $year              = intval(perch_get('year'));
			$date_from         = $year.'-01-01 00:00:00';
			$date_to           = $year.'-12-31 23:59:59';
			$title_date_format = '%Y';
			
            perch_blog_custom(array(
				'filter'     => 'postDateTime',
				'match'      => 'eqbetween',
				'value'      => $date_from.','.$date_to,
				'template'   => $template,
				'count'      => 30,
				'template' => 'post_in_list.html',
            ));
        }
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
