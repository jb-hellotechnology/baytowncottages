<?php if (!defined('PERCH_RUNWAY')) include($_SERVER['DOCUMENT_ROOT'].'/perch/runtime.php'); ?>
<?php

	include('library.php');
	
	Connect();

	$date = strip_tags($_GET['date']);
	$cottage = strip_tags($_GET['cottage']);
	
	$dates = explode("-",$date);
	$arrival = "$dates[2]/$dates[1]/$dates[0]";
	
	$pData = mysql_fetch_array(mysql_query("SELECT * FROM pricing WHERE startDate<='$date' AND endDate>='$date' AND propertySlug='$cottage'"));

?>

<form method="post">
	<h3>Enquiry Form</h3>
	<p>Please complete the following information and then click 'Submit' below to make your enquiry. We will contact you as soon as we can to complete your booking:</p>
	<label>Preferred Arrival Date</label>
	<input type="text" name="Arrival" id="Arrival" class="date" />
	<label>Preferred Number of Nights</label>
	<select name="Nights" id="Nights">
	<?php
		$i = 2;
		while($i<=14){
			echo "<option value='$i'>$i</option>";
			$i++;
		}		
	?>
	</select>
	<label>Adults in Group</label>
	<select name="Adults" id="Adults">
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
	</select>
	<label>Children in Group</label>
	<select name="Children" id="Children">
		<option value="0">0</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
	</select>
	<label>Infants Under 12 Months Old in Group</label>
	<select name="Infants" id="Infants">
		<option value="0">0</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
	</select>
	<label>Pets in Group</label>
	<select name="Pets" id="Pets">
		<option value="0">0</option>
		<option value="1">1</option>
		<option value="2">2</option>
	</select>
	<label>Your Name</label>
	<input type="text" name="Name" id="Name" />
	<label>Your Telephone/Mobile Number</label>
	<input type="text" name="Telephone" id="Telephone" />
	<label>Your Email Address</label>
	<input type="text" name="Email" id="Email" />
	<label>Notes/Comments</label>
	<textarea name="Notes" id="Notes"></textarea>
	<label>Ready?</label>
	<a class="button" href="javascript:submit();">Submit</a>
	<input type="hidden" name="Cottage" id="Cottage" value="<?php echo $cottage; ?>" />
</form>

<script type="text/javascript">
	function submit(){
		var pNights = $("#Nights").val();
		var pAdults = $("#Adults").val();
		var pChildren = $("#Children").val();
		var pInfants = $("#pInfants").val();
		var pPets = $("#Pets").val();
		var pName = $("#Name").val();
		var pTelephone = $("#Telephone").val();
		var pEmail = $("#Email").val();
		var pCottage = $("#Cottage").val();
		var pArrival = $("#Arrival").val();
		var pNotes = $("#Notes").val();
		$.post( "/scripts/enquiry.php", { Nights: pNights, Adults: pAdults, Children: pChildren, Infants: pInfants, Pets: pPets, Name: pName, Telephone: pTelephone, Email: pEmail, Cottage: pCottage, Arrival: pArrival, Notes: pNotes });
		$( ".enquiry-form" ).load( "/perch/templates/calendar/complete.php" );	
	}
</script>