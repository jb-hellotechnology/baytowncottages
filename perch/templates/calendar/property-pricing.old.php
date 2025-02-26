<?php if (!defined('PERCH_RUNWAY')) include($_SERVER['DOCUMENT_ROOT'].'/perch/runtime.php'); ?>
<?php

	include('library.php');
	
	Connect();
	
	$cottage = strip_tags($_GET['id']);
	
	$price2 = strip_tags($_GET['price2']);
	$price3 = strip_tags($_GET['price3']);
	$price4 = strip_tags($_GET['price4']);
	$price5 = strip_tags($_GET['price5']);
	$price6 = strip_tags($_GET['price6']);
	$price7 = strip_tags($_GET['price7']);
	
	$colspan = 0;
	
	if($price2=='1'){
		$colspan++;
	}
	if($price3=='1'){
		$colspan++;
	}
	if($price4=='1'){
		$colspan++;
	}
	if($price5=='1'){
		$colspan++;
	}
	if($price6=='1'){
		$colspan++;
	}
	if($price7=='1'){
		$colspan++;
	}
	
	echo "<table>
			<tr>
				<td colspan='5'>Date Period</td>
				<td colspan='$colspan'>Price/Nights</td>
			</tr>
			<tr>
				<td>Start</td>
				<td>End</td>
				<td></td>
				<td>Min Stay</td>
				<td>Changeover</td>";
			
			if($price2=='1'){
				echo "<td>2 Nights</td>";
			}
			if($price3=='1'){
				echo "<td>3 Nights</td>";
			}
			if($price4=='1'){
				echo "<td>4 Nights</td>";
			}
			if($price5=='1'){
				echo "<td>5 Nights</td>";
			}
			if($price6=='1'){
				echo "<td>6 Nights</td>";
			}
			if($price7=='1'){
				echo "<td>7 Nights</td>";
			}
				
		echo "</tr>";
	
	$today = date('Y-m-d');
	
	$Users = new PerchUsers;
	$CurrentUser = $Users->get_current_user();
	
	if (is_object($CurrentUser) && $CurrentUser->logged_in()) {
		$query = mysql_query("SELECT * FROM pricing WHERE propertySlug='$cottage' ORDER BY startDate ASC");
	}else{
		$query = mysql_query("SELECT * FROM pricing WHERE propertySlug='$cottage' AND endDate>='$today' ORDER BY startDate ASC");
	}

	while($data = mysql_fetch_array($query)){
		
		$sDates = explode("-",$data['startDate']);
		$start = "$sDates[2]/$sDates[1]/$sDates[0]";
		
		$eDates = explode("-",$data['endDate']);
		$end = "$eDates[2]/$eDates[1]/$eDates[0]";
		
		echo "<tr>
				<td>$start</td>
				<td>$end</td>";
				
		if (is_object($CurrentUser) && $CurrentUser->logged_in()) {
			echo "<td><input type=\"text\" name=\"freeText_$data[pricingID]\" id=\"freeText_$data[pricingID]\" value=\"$data[freeText]\" /></td>";
		}else{
			echo "<td>$data[freeText]</td>";
		}		
		
		echo "	<td>$data[minStay] Nights</td>
				<td>$data[changeover]</td>";
		
		if($price2=='1'){
			if($data['price2']=='0'){
				echo "<td>-</td>";
			}else{
				echo "<td>&pound;$data[price2]</td>";
			}
		}
		if($price3=='1'){
			if($data['price3']=='0'){
				echo "<td>-</td>";
			}else{
				echo "<td>&pound;$data[price3]</td>";
			}
		}
		if($price4=='1'){
			if($data['price4']=='0'){
				echo "<td>-</td>";
			}else{
				echo "<td>&pound;$data[price4]</td>";
			}
		}
		if($price5=='1'){
			if($data['price5']=='0'){
				echo "<td>-</td>";
			}else{
				echo "<td>&pound;$data[price5]</td>";
			}
		}
		if($price6=='1'){
			if($data['price6']=='0'){
				echo "<td>-</td>";
			}else{
				echo "<td>&pound;$data[price6]</td>";
			}
		}
		if($price7=='1'){
			if($data['price7']=='0'){
				echo "<td>-</td>";
			}else{
				echo "<td>&pound;$data[price7]</td>";
			}
		}
		
		$Users = new PerchUsers;
		$CurrentUser = $Users->get_current_user();
		
		
				
		echo "
			</tr>";
			
		if (is_object($CurrentUser) && $CurrentUser->logged_in()) {
			echo "<tr><td colspan='5'><a href='javascript:deleteDate(\"$cottage\",\"$data[pricingID]\");'>Delete</a>  &bull;  <a href='javascript:updateDate(\"$cottage\",\"$data[pricingID]\");'>Update</a></td><td colspan='$colspan'></td></tr>";
		}	
	}
	
	echo "</table>";
	
	$Users = new PerchUsers;
	$CurrentUser = $Users->get_current_user();
	
	if (is_object($CurrentUser) && $CurrentUser->logged_in()) {
		echo "<table>
			<tr>
				<td colspan='5'>Enter New Period</td>
				<td colspan='6'>Pricing/Nights</td>
			</tr>
			<form id='pricing-band' name='pricing-band' method='post'>
				<tr>
					<td>
						<label>Start Date</label><br />
						<input type='text' class='date' name='start' id='start' />
					</td>
					<td>
						<label>End Date</label><br />
						<input type='text' class='date' name='end' id='end' />
					</td>
					<td>
						<label>Free Text</label><br />
						<input type='text' name='freeText' id='freeText' />
					</td>
					<td>
						<label>Min.</label><br />
						<select name='minstay' id='minstay'>
							<option value='1'>1</option>
							<option value='2'>2</option>
							<option value='3'>3</option>
							<option value='4'>4</option>
							<option value='5'>5</option>
							<option value='6'>6</option>
							<option value='7'>7</option>
						</select>
					</td>
					<td>
						<label>Change</label><br />
						<select name='changeover' id='changeover'>
							<option value='Sat - Sat'>Sat - Sat</option>
							<option value='Fri - Fri'>Fri - Fri</option>
							<option value='Fri/Mon'>Fri/Mon</option>
							<option value='Any Day'>Any Day</option>
						</select>
					</td>
					<td>
						<label>2</label><br />
						<input type='text' class='smaller' name='price2' id='price2' />
					</td>
					<td>
						<label>3</label><br />
						<input type='text' class='smaller' name='price3' id='price3' />
					</td>
					<td>
						<label>4</label><br />
						<input type='text' class='smaller' name='price4' id='price4' />
					</td>
					<td>
						<label>5</label><br />
						<input type='text' class='smaller' name='price5' id='price5' />
					</td>
					<td>
						<label>6</label><br />
						<input type='text' class='smaller' name='price6' id='price6' />
					</td>
					<td>
						<label>7</label><br />
						<input type='text' class='smaller' name='price7' id='price7' />
					</td>
				</tr>
				<tr>
					<td colspan='11'><input type='submit' value='Save' onclick='javascript:submit()' /></td>
				</tr>
			</form>";
	}
			
	echo "</table>";
	
	echo '<script type="text/javascript">
			function submit(){
				var pStart = $("#start").val();
				var pEnd = $("#end").val();
				var pfreeText = $("#freeText").val();
				var pMinstay = $("#minstay").val();
				var pChangeover = $("#changeover").val();
				var pPrice2 = $("#price2").val();
				var pPrice3 = $("#price3").val();
				var pPrice4 = $("#price4").val();
				var pPrice5 = $("#price5").val();
				var pPrice6 = $("#price6").val();
				var pPrice7 = $("#price7").val();
				$.post( "/perch/templates/calendar/save-pricing.php", { cottage: "'.$cottage.'", start: pStart, end: pEnd, freeText: pfreeText, minstay: pMinstay, changeover: pChangeover, price2: pPrice2, price3: pPrice3, price4: pPrice4, price5: pPrice5, price6: pPrice6, price7: pPrice7 });
				$( ".property-pricing" ).load( "/perch/templates/calendar/property-pricing.php?id='.$cottage.'&price2='.$price2.'&price3='.$price3.'&price4='.$price4.'&price5='.$price5.'&price6='.$price6.'&price7='.$price7.'" );	
			}
			function deleteDate(cottage,pId){
				$.post( "/perch/templates/calendar/delete-pricing.php", { cottage: "'.$cottage.'", id: pId });
				$( ".property-pricing" ).load( "/perch/templates/calendar/property-pricing.php?id='.$cottage.'&price2='.$price2.'&price3='.$price3.'&price4='.$price4.'&price5='.$price5.'&price6='.$price6.'&price7='.$price7.'" );	
			}
			function updateDate(cottage,pId,pfreeText){
				var pfreeText = $("#freeText_"+pId).val();
				$.post( "/perch/templates/calendar/update-freetext.php", { cottage: "'.$cottage.'", id: pId, freeText: pfreeText }).done(function(data) {
				    alert(data);
				  });
				$( ".property-pricing" ).load( "/perch/templates/calendar/property-pricing.php?id='.$cottage.'&price2='.$price2.'&price3='.$price3.'&price4='.$price4.'&price5='.$price5.'&price6='.$price6.'&price7='.$price7.'" );	
			}
			$(document).ready(function(){
				$( ".date" ).datepicker({
					dateFormat: \'yy-mm-dd\'	
				});
			});
	</script>';
	
	if (is_object($CurrentUser) && $CurrentUser->logged_in()) {
		echo "<h3>Property Pricing</h3>";
		simple_calendar_unit_pricing($cottage);	
	}

?>