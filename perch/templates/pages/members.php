<?php	
	if(!perch_member_logged_in()){
		header("location:/register?r=".perch_get('return')."&date=".perch_get('date'));
	}
	perch_layout('global/header');
?>
<main>
	<div class="restrict padding-top flow">
		<?php
			if(perch_member_logged_in()){
		          
		        echo '<h1 class="span">Welcome to Your Account</h1>';
		        echo '<p><a href="/all-availability">Browse Availability &amp; Book</a></p>';
		        member_bookings(perch_member_get('memberID'));
		        
		    }
		?>

			<?php

	          PerchSystem::set_var('return', $_GET['return']);

			  if(perch_member_logged_in()){
	            perch_member_form('profile.html');
	            perch_member_form('password.html');
	            
	          }else{
	            
	            perch_member_form('register.html');
	            perch_members_login_form();
	            perch_member_form('reset_password.html');
	
	          }
	          
	        ?>
	</div>
</main>
<?php
    perch_layout('global/footer');
?>
