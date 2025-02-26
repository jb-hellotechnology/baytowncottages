<?php	
	perch_layout('global/header');
?>
</section>
<section class="page">
	<section class="restrict">
		<section class="row">
      <?php
        perch_content('Page Content');
      ?>
      <div class="monthly-calendar-all">
        <p><strong>Loading calendars&hellip;</strong></p>
      </div>
			<script type="text/javascript">
				$(document).ready(function(){
					$( ".monthly-calendar-all" ).load( '/perch/templates/simple_calendar/monthly-calendar-all.php' );
				});
				</script>
		</section>
	</section>
</section>
<?php
    perch_layout('global/footer');
?>
