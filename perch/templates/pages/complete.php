<?php
  if(!perch_member_logged_in()){
    header("location:/bookings/"); 
  }
?>
<?php	
	perch_layout('global/header');
?>
<main>
	<div class="restrict flow padding-top">
        <?php
        
          require_once($_SERVER['DOCUMENT_ROOT'].'/perch/addons/apps/simple_calendar/stripe-php-master/init.php');
        
          $first_name = $_POST['first_name'];
          $last_name = $_POST['last_name'];
          $email = $_POST['email'];
          $mobile = $_POST['mobile'];
          $alt_mobile = $_POST['alt_mobile'];
          $address_1 = $_POST['address_1'];
          $address_2 = $_POST['address_2'];
          $address_3 = $_POST['address_3'];
          $post_code = $_POST['post_code'];
          $country = $_POST['country'];
          $adults = $_POST['adults'];
          $children = $_POST['children'];
          $babies = $_POST['babies'];
          $party = $adults+$children+$babies;
          $i = 1;
          $names = '';
          while($i<=$party){
            $names .= $_POST['name_'.$i].", ";
            $i++;
          }
          $names = substr($names,0,-2);
          $pet = $_POST['pet'];
          if($pet=='on'){
            $pet = 'Yes (1)';
          }else{
            $pet = 'No';
          }
          $highchair = $_POST['highchair'];
          if($highchair=='on'){
            $highchair = 'Yes';
          }else{
            $highchair = 'No';
          }
          $travelcot = $_POST['travelcot'];
          if($travelcot=='on'){
            $travelcot = 'Yes';
          }else{
            $travelcot = 'No';
          }
          $nights = $_POST['nights'];
          $unitID = $_POST['unitID'];
          $customerID = perch_member_get('memberID');
          $arrival = $_POST['arrival'];
          $cost = $_POST['cost'];
          $deposit = $_POST['deposit'];
        
          $unitData = getUnitByID($unitID);
        
          $arrivalDates = explode("-",$arrival);
          $arrivalFull = date("l jS \of F Y", mktime(0, 0, 0, $arrivalDates[1], $arrivalDates[2], $arrivalDates[0]));
        
          $notes = "Booked by:
$first_name $last_name
$address_1
$address_2 $address_3
$post_code
$country

Mob: $mobile
Alt Phone: $alt_mobile

Email: $email

Party:
Adults: $adults
Children: $children
Babies: $babies

Names: $names

Arrival Date: $arrivalFull
Nights: $nights

Pets: $pet
High Chair: $highchair
Travelcot: $travelcot

Total Cost: £$cost
Amount Paid: £$deposit";

          $description = "Baytown Holiday Cottages Booking: $unitData[name], $nights Nights from $arrival";
        
          if($customerID<>'' AND $unitID<>'' AND $nights<>'' AND $arrival<>''){

            //Take Stripe Payment
            \Stripe\Stripe::setApiKey("");
            
            $stripeToken  = $_POST['stripeToken'];
            $stripeEmail  = $_POST['stripeEmail'];

            $toPay = $deposit*100;
            
            // Charge the user's card:
            $charge = \Stripe\Charge::create(array(
              "amount" => $toPay,
              "currency" => "gbp",
              "description" => $description,
              "source" => $stripeToken,
              "receipt_email" => $stripeEmail,
            ));
            
            if($charge->failure_code==NULL){
            
              $arrival = "$arrival 16:00:00";

              $dates = explode("-",$arrival);
              $departure = date("Y-m-d", mktime(0, 0, 0, $dates[1], $dates[2]+$nights, $dates[0]));
              $departure = "$departure 10:00:00";

              $bookingID = simple_calendar_make_booking($arrival,$departure,$unitID,$customerID,$cost,$deposit,$notes);

              echo "<h2>Booking Success</h2>";
              echo "<p>Your booking information:</p>";
              $notes = nl2br($notes);
              echo "<p>$notes</p>";
              echo "<p>Please keep a copy of this page for your records.</p>";
              echo "<p>We've emailed you a booking confirmation and will be in touch about your holiday in due course.</p>";
              
            }else{
              
              echo "<h2>Oops! Your Booking Failed</h2>";
              echo "<p>Failure Code: ".$charge->failure_code."</p>";
              echo "<p>Please call us and let us know you saw this failure code.</p>";
              
            }

          }	
        
        ?>
	</div>
</main>
<?php
    perch_layout('global/footer');
?>
