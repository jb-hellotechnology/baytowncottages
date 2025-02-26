<?php	
	if(perch_member_logged_in()){
		header("location:/");
	}
	perch_layout('global/header');
?>
<main>
	<div class="restrict flow padding-top">
		<h1>Register with Baytown Cottages</h1>
		<p>Already registered? <a href="/login">Click here to login</a>.</p>
		<div class="split-form flow">
			<?php
	            perch_member_form('register.html');
	        ?>
		</div>
	</div>
</div>
<?php
    perch_layout('global/footer');
?>
