<?php
  session_start();
  if($_SESSION['bookingMade']=='1'){
    header("location:/"); 
  }
?>
<?php	
	perch_layout('global/header');
?>
<main>
	<div class="restrict flow padding-top">
		<div class="textarea flow">
        <?php
        echo "<h1>Booking Success</h1>";
		echo "<p>We've emailed you a booking confirmation and will be in touch about your holiday in due course.</p>";
		latest_booking(perch_member_get('memberID'));
        echo "<p>Now you can begin looking forward to your holiday in Robin Hood's Bay!</p>";
        echo "<p>Thanks for booking with Baytown Holiday Cottages,<br /><em>Sam and Sian</em></p>";
        ?>
		</div>
	</div>
	<div class="restrict flow">
		<?php //perch_content('Page Content'); ?>
		<?php perch_content('Flexible Content'); ?>
		<h2>The Baytown Blog</h2>
		<?php  
			perch_blog_custom(array(
				'sort' => 'postDateTime',
				'sort-order' => 'DESC',
				'count' => 6,
			    'paginate' => false,
			    'template' => 'post_in_list.html'
			));
		?>
	</div>
</main>
<?php
    perch_layout('global/footer');
?>