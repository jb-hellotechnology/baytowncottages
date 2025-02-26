<?php	
	perch_layout('global/header');
?>
</section>
<section class="page">
	<section class="restrict">
		<section class="row">
			<section class="column two-thirds">
				<h2>Archive</h2>
				<?php
				if ($_GET['tag']<>'') {
		            echo '<h3>Posts by Tag: '.perch_blog_tag(perch_get('tag'),true).'</h3>';
		
		            perch_blog_custom(array(
						'tag'   	 => perch_get('tag'),
						'template' => 'post_in_list.html',
                    ));
		        }
		        
		        if ($_GET['year']<>'') {
		            echo '<h3>Posts by Year: '.perch_get('year').'</h3>';
		
		            $year              = intval(perch_get('year'));
					$date_from         = $year.'-01-01 00:00:00';
					$date_to           = $year.'-12-31 23:59:59';
					$title_date_format = '%Y';
					
		            perch_blog_custom(array(
						'filter'     => 'postDateTime',
						'match'      => 'eqbetween',
						'value'      => $date_from.','.$date_to,
						'template'   => $template,
						'count'      => 10,
						'template' => 'post_in_list.html',
		            ));
		        }
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
