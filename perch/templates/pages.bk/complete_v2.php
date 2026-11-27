<?php
  session_start();
  if($_SESSION['bookingMade']=='1'){
    header("location:/"); 
  }
?>
<?php	
	perch_layout('global/header');
?>
</section>
<section class="page">
	<section class="restrict">
		<section class="row">
			<section class="column two-thirds">
        <?php
			  
              echo "<h2>Booking Success</h2>";
              echo "<p>We've emailed you a booking confirmation and will be in touch about your holiday in due course.</p>";
        
        ?>
			</section>
			<section class="column third paginate-hide">
				
				<?php perch_content('Social Stuff'); ?>
          
			</section>
		</section>
	</section>
</section>
<?php
    perch_layout('global/footer_complete');
?>