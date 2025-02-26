<?php	
	if(perch_member_logged_in()){
		header("location:/");
	}
	perch_layout('global/header');
?>
<main>
	<div class="restrict flow padding-top">
		<h1>Login to Baytown Cottages</h1>
		<p>First time? <a href="/register">Click here to register</a>.</p>
		<div class="split-form flow">
			<?php
	            echo '<div class="flow"">';
	            if(!perch_member_logged_in()){
		            perch_members_login_form();
		            echo "<br /><br >";
		            perch_member_form('reset_password.html');
	            }
	            echo "</div>";
	          
	        ?>
		</div>
	</div>
</div>
<?php
    perch_layout('global/footer');
?>
