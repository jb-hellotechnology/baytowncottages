<?php

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
if($pet>0){
	$pet = 'Yes - '.$pet;
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
        
$arrival = "$arrival 16:00:00";

$dates = explode("-",$arrival);
$departure = date("Y-m-d", mktime(0, 0, 0, $dates[1], $dates[2]+$nights, $dates[0]));
$departure = "$departure 10:00:00";

$bookingID = simple_calendar_make_booking($arrival,$departure,$unitID,$customerID,$cost,$deposit,$notes,$pet);

echo $bookingID;
        
?>