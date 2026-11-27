<?php	
	if(perch_member_logged_in()){
		header("location:/");
	}
	perch_layout('global/header');
?>
</section>
<section class="page">
	<section class="restrict">
		<section class="row">
			<section class="column two-thirds split-form">
				<?php

		            perch_member_form('register.html');
		            echo "<div>";
		            if(!perch_member_logged_in()){
			            perch_members_login_form();
			            perch_member_form('reset_password.html');
		            }
		            echo "</div>";
		          
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
