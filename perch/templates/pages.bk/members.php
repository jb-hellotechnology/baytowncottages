<?php	
	if(!perch_member_logged_in()){
		header("location:/register?r=".perch_get('return')."&date=".perch_get('date'));
	}
	perch_layout('global/header');
?>
</section>
<section class="page">
	<section class="restrict">
		<section class="row">
			<section class="column two-thirds split-form">
				<?php

		          PerchSystem::set_var('return', $_GET['return']);
		        
		          if(perch_member_logged_in()){
			          
			        echo '<h2 class="span">Logged In<br /><a href="/all-availability">Browse Availability &amp; Book</a></h2>';
		            
		            perch_member_form('profile.html');
		            perch_member_form('password.html');
		            
		          }else{
		            
		            perch_member_form('register.html');
		            echo "<div>";
		            perch_members_login_form();
		            perch_member_form('reset_password.html');
		            echo "</div>";
		
		          }
		          
		        ?>
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
