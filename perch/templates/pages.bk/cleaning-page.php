<?php	
	perch_layout('global/header-cleaning');
?>
</section>
<section class="page">
	<section class="restrict">
		<section class="row">
			<section class="column two-thirds">
				<?php perch_content('Page Content'); ?>
			</section>
			<section class="column third paginate-hide">
				
				<?php perch_content('Social Stuff'); ?>
          
			</section>
		</section>
	</section>
</section>
<?php
    perch_layout('global/footer');
?>
