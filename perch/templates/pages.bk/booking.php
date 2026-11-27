<?php
  if(!perch_member_logged_in()){
    header("location:/register/?return=".$_POST['unit']."&date=".$_POST['arrivalDate']); 
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
        <h2>Make Your Booking</h2>
        <p>
          Please complete the form below to make your booking.
        </p>
        <form method="post" id="payment-form">
 				<?php
        
          //Get Data Required for Booking
          $unit = $_POST['unit'];
          if($unit==''){
	          $unit = $_GET['unit'];
          }
          $arrivalDate = $_POST['arrivalDate'];
          if($arrivalDate==''){
	      	$arrivalDate = $_GET['date'];
	      }
          $unitData = getUnitBySlug($unit);
          $minNights = getMinNights($unit,$arrivalDate);
          $maxNights = getMaxNights($unit,$arrivalDate);
          $maxOccupants = getMaxOccupants($unit);
  
          $item = perch_collection('Cottages', [
             'match' => 'eq',
             'filter' => 'slug',
             'value' => $unit,
             'count' => 1,
             'skip-template' => true,
          ]);
          
          $petfriendly = $item[0]['petfriendly'];
          $travelcot = $item[0]['travelcot'];
          $highchair = $item[0]['highchair'];
          
          $aD = explode("-",$arrivalDate);
          $arrivalDateH = "$aD[2]/$aD[1]/$aD[0]";
          
          echo "<input type=\"hidden\" name=\"unitID\" value=\"$unitData[unitID]\" />";
          echo "<input type=\"hidden\" name=\"arrival\" value=\"$arrivalDate\" />";

          //Show Property and Date
/*
          echo "<div class=\"form_section\" id=\"property\">";
          echo "<h3>Property and Arrival Dates</h3>";
          echo "<ul>";
          echo "<li>$unitData[name]</li>";
          echo "<li>Arrival: $arrivalDateH</li>";
          echo "</div>";
*/
          PerchSystem::set_var('arrival', $arrivalDateH);
          perch_collection('Cottages', [
			    "filter"   => "slug",
		        "match"    => "eq",
		        "value"    => $unit,
		        "template" => 'cottages/mini.html'
		    ]);
          
          echo "<input type=\"hidden\" name=\"stripeDescription\" value=\"Cottage: $unitData[name] - Arrival: $arrivalDateH\" />";
          
          echo "<div class=\"form_section\" id=\"stay\">";
          echo "<h3>Your Stay</h3>";
          echo "<p>The maximum length of stay for your chosen arrival date is <strong>$maxNights nights</strong> - please choose how many nights you wish to stay.</p>";
          echo "<label>Length of Stay</label>";
          echo "<select name=\"nights\" id=\"nights\" onchange=\"javascript:getPrice();\">";
          echo "<option>Please Select</option>";
            $i = $minNights;
            $depDay = date("D", mktime(0, 0, 0, $aD[1], $aD[2]+$minNights, $aD[0]));
            while($i<=$maxNights){
              
              $add = $i;
              $date = date("m-d", mktime(0, 0, 0, $aD[1], $aD[2]+$add, $aD[0]));
              
              $thisDate = date("Y-m-d", mktime(0, 0, 0, $aD[1], $aD[2]+$add, $aD[0]));
              $unitPricing = getPricing($_POST['unit'],$thisDate);
              
              $depDate = date("l jS F Y", mktime(0, 0, 0, $aD[1], $aD[2]+$add, $aD[0]));
                
              if($unitPricing['strict']=='on'){
              
                $thisDay = date("D", mktime(0, 0, 0, $aD[1], $aD[2]+$add, $aD[0]));
                
                if($unitPricing['changeOver']=='Sat - Sat' AND $thisDay=='Sat'){
                  echo "<option value=\"$i\">$i Nights (Depart on $depDate)</option>"; 
                }elseif($unitPricing['changeOver']=='Fri - Fri' AND $thisDay=='Fri'){
                  echo "<option value=\"$i\">$i Nights (Depart on $depDate)</option>"; 
                }elseif($unitPricing['changeOver']=='Fri/Mon' AND ($thisDay=='Fri' OR $thisDay=='Mon')){
                  echo "<option value=\"$i\">$i Nights (Depart on $depDate)</option>"; 
                }elseif($unitPricing['changeOver']=='Sat/Tue' AND ($thisDay=='Sat' OR $thisDay=='Tue')){
                  echo "<option value=\"$i\">$i Nights (Depart on $depDate)</option>"; 
                }elseif($unitPricing['changeOver']=='Any Day' AND ($thisDay==$depDay)){
                  echo "<option value=\"$i\">$i Nights (Depart on $depDate)</option>"; 
                }else{
                  //echo "<option disabled value=\"$i\">$i Nights</option>"; 
                }
                
              }else{
                
                if($date=='12-24' OR $date=='12-25' OR $date=='12-26' OR $date=='12-31' OR $date=='01-01'){
                 //echo "<option disabled value=\"$i\">$i Nights</option>"; 
                }else{
                  echo "<option value=\"$i\">$i Nights (Depart on $depDate)</option>";  
                }
                
              }
              
              $i++;
              
            }
          echo "</select>
          		<div id=\"cost_top\"></div>";
          echo "</div>";
          
          //Create Booking Form
          echo "<div class=\"form_section form_grid\" id=\"you\">";
          echo "<h3>Your Details</h3>";
          echo "<div>";
          echo "<label>First Name</label>";
          echo "<input name=\"first_name\" type=\"text\" value=\"".perch_member_get('first_name')."\" />";
          echo "</div>";
          echo "<div>";
          echo "<label>Last Name</label>";
          echo "<input name=\"last_name\" type=\"text\" value=\"".perch_member_get('last_name')."\" />";
          echo "</div>";
          echo "<div>";
          echo "<label>Email Address</label>";
          echo "<input name=\"email\" type=\"email\" value=\"".perch_member_get('email')."\" />";
          echo "</div>";
          echo "<div>";
          echo "<label>Mobile Number</label>";
          echo "<input name=\"mobile\" type=\"text\" value=\"".perch_member_get('mobile')."\" />";
          echo "</div>";
          echo "<div>";
          echo "<label>Alternative Telephone Number</label>";
          echo "<input name=\"alt_mobile\" type=\"text\" value=\"".perch_member_get('alt_mobile')."\" />";
          echo "</div>";
          echo "<div>";
          echo "<label>Address 1</label>";
          echo "<input name=\"address_1\" type=\"text\" value=\"".perch_member_get('address_1')."\" />";
          echo "</div>";
          echo "<div>";
          echo "<label>Address 2</label>";
          echo "<input name=\"address_2\" type=\"text\" value=\"".perch_member_get('address_2')."\" />";
          echo "</div>";
          echo "<div>";
          echo "<label>Address 3</label>";
          echo "<input name=\"address_3\" type=\"text\" value=\"".perch_member_get('address_3')."\" />";
          echo "</div>";
          echo "<div>";
          echo "<label>Post Code</label>";
          echo "<input name=\"post_code\" type=\"text\" value=\"".perch_member_get('post_code')."\" />";
          echo "</div>";
          echo "<div>";
          echo "<label>Country</label>";
          echo "<input name=\"country\" type=\"text\" value=\"".perch_member_get('country')."\" />";
          echo "</div>";
          echo "</div>";
          
          echo "<div class=\"form_section\" id=\"party\">";
          echo "<h3>Your Party</h3>";
          echo "<p>This property can accommodate upto <strong>$maxOccupants guests</strong> - please let us know how many people of which age group will be staying.</p>";
          echo "<p class=\"partyError\"><strong></strong></p>";
          echo "<label>Adults (18+)</label>";
          echo "<select name=\"adults\" id=\"adults\" onchange=\"javascript:party($maxOccupants);\">";
            $i = 0;
            while($i<=$maxOccupants){
              echo "<option>$i</option>";
              $i++;
            }
          echo "</select>";
          echo "<label>Children (1yrs - 17yrs)</label>";
          echo "<select name=\"children\" id=\"children\" onchange=\"javascript:party($maxOccupants);\">";
            $i = 0;
            while($i<=$maxOccupants){
              echo "<option>$i</option>";
              $i++;
            }
          echo "</select>";
          echo "<label>Babies (Under 1yr)</label>";
          echo "<select name=\"babies\" id=\"babies\" onchange=\"javascript:party($maxOccupants);\">";
            $i = 0;
            while($i<=$maxOccupants){
              echo "<option>$i</option>";
              $i++;
            }
          echo "</select>";
          echo "<label>Enter the Full Names of Your Whole Party - You Need To Complete All These Fields In Order To Make Your Booking</label>";
          echo "<div id=\"names\"></div>";
          echo "</div>";
          
          echo "<div class=\"form_section\" id=\"options\">";
          echo "<h3>Options</h3>";
          if($petfriendly=='Pet Friendly'){
	          $i = 0;
	          if($unitData['freePets']=='yes'){
	          	echo '<label>This property can accommodate a maximum of '.$unitData['maxPets'].' pets. If you\'d like to bring a pet please select how many you\'ll bring. Pets are free.</label>';
	          }else if($unitData['singlePetCharge']=='yes'){
	          	echo '<label>This property can accommodate a maximum of '.$unitData['maxPets'].' pets. If you\'d like to bring a pet please select how many you\'ll bring. A charge of &pound;25 applies.</label>';  
	          }else{
		        echo '<label>This property can accommodate a maximum of '.$unitData['maxPets'].' pets. If you\'d like to bring a pet please select how many you\'ll bring. Each pet costs an additional &pound;25.</label>';  
		      }
	          echo '<select name="pet" id="pet" onchange="javascript:getPrice();">';
	          while($i<=$unitData['maxPets']){
		          echo '<option value="'.$i.'">'.$i.'</option>';
		          $i++;
	          }
	          echo '</select>';
          }
          if($highchair=='Highchair Available'){
            echo "<label><input type=\"checkbox\" name=\"highchair\" /> I require a high chair</label>";
          }
          if($travelcot=='Travel Cot Available'){
            echo "<label><input type=\"checkbox\" name=\"travelcot\" /> I require a travel cot</label>";
          }
          
          $today = date('Y-m-d');
          $diff = strtotime($arrivalDate) - strtotime($today);
          $nights = $diff/86400;

          if($nights>60){
            echo "<label><input type=\"checkbox\" name=\"payinfull\" id=\"payinfull\" /> I want to pay in full today</label>";
          }
          
          echo "<p>Please call us if you have any specific requirements you need to discuss before making your booking.</p>";
          echo "</div>";
          
          
          echo "<div class=\"form_section\" id=\"cost\" style=\"display:none;\">";
          echo "<h3>Cost &amp; Payment</h3>";
          echo "<div id=\"cost\"><p><strong>Please choose a length of stay to calculate the cost</strong></p></div>";
          echo "</div>";
?>
          <script type="text/javascript">
            function party(maxOccupants){
              
              getPrice();
              
              var error = 0;
              $('#party').removeClass('error');
              $('p.partyError strong').text('');
              $('#names').empty();
              
              var adults = parseInt($('#adults').val());
              var children = parseInt($('#children').val());
              var babies = parseInt($('#babies').val());
              
              var allowedBabies = (maxOccupants-adults-children)+1;
              
              var total = adults+children+babies;
              
              if((adults+children)>maxOccupants){
                $('#party').addClass('error');
                $('#cost').hide();
                $('p.partyError strong').text('This property cannot accommodate this combination of guests');
                var error = 1;
              }
              
              <?php
                
              if($unitData['plusOne']=='yes'){
                
              ?>
              
              if((adults+children+babies)>(maxOccupants+1)){
                $('#party').addClass('error');
                $('#cost').hide();
                $('p.partyError strong').text('This property cannot accommodate this combination of guests');
                var error = 1;
              }
                
              <?php
                
              }else{
                
              ?>
              
              if((adults+children+babies)>maxOccupants){
                $('#party').addClass('error');
                $('#cost').hide();
                $('p.partyError strong').text('This property cannot accommodate this combination of guests');
                var error = 1;
              }
              
              <?php
                
              }
                
              ?>
              
              if(error==0){
                var i = 1;
                while(i<=total){
                  $('#names').append('<input type="text" name="name_'+i+'" placeholder=\"Name '+i+'\" onkeyup="javascript:checkNames();" />');
                  i++;
                }
              }

            }
            
            function checkNames(){
              
              var error = parseInt(0);
              
              $('#names input').each(function(){
                var name = $(this).val();
                console.log(name);
                if(name==''){
                  error++;
                }
              });
              
              if(error>0){
                $('#cost').hide();
              }else{
                $('#cost').show();
              }
              
            }
          </script>
          <script type="text/javascript">
            function getPrice(){
              pNights = $('#nights').val();
              pAdults = $('#adults').val();
              pChildren = $('#children').val();      

              var pPet = '';
              
              pPet = $('#pet').val();

              
              if ($('#payinfull').is(':checked')) {
                var pPay = 'on';
              }
              
              $.post( "/getprice?r=" + Math.random(), { unit: "<?php echo $unit; ?>", arrival: "<?php echo $arrivalDate; ?>", nights: pNights, pet:pPet, pay:pPay, adults:pAdults, children:pChildren }).done(function( data ) {
                $('#cost').html(data);
              });
              $.post( "/getpricetop?r=" + Math.random(), { unit: "<?php echo $unit; ?>", arrival: "<?php echo $arrivalDate; ?>", nights: pNights, pet:pPet, pay:pPay, adults:pAdults, children:pChildren }).done(function( data ) {
                $('#cost_top').html(data);
              });
            }
          </script>
        </form>
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
