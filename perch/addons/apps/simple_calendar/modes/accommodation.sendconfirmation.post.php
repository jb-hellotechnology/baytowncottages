<?php
    # Side panel
    echo $HTML->side_panel_start();
    
    echo $HTML->side_panel_end();
    
    echo $HTML->title_panel([
    'heading' => $Lang->get('Accommodation'),
    ], $CurrentUser);


    $Smartbar = new PerchSmartbar($CurrentUser, $HTML, $Lang);

	$Smartbar->add_item([
	    'active' => false,
	    'title' => '&larr; Back to Calendar',
	    'link'  => '/addons/apps/simple_calendar/accommodation',
	]);
	
	$Smartbar->add_item([
	    'active' => false,
	    'title' => 'Edit Booking',
	    'link'  => '/addons/apps/simple_calendar/accommodation/booking/edit/?id='.$_GET['id'],
	]);
	
	$Smartbar->add_item([
		'active' => true,
		'title' => 'Deposit Confirmation',
		'link'  => '/addons/apps/simple_calendar/accommodation/booking/send_confirmation/?id='.$_GET['id'],
	]);
	
	$Smartbar->add_item([
		'active' => false,
		'title' => 'Full Payment Confirmation',
		'link'  => '/addons/apps/simple_calendar/accommodation/booking/full_confirmation/?id='.$_GET['id'],
	]);
	
	$Smartbar->add_item([
	    'active' => false,
	    'title' => 'Cancel Booking',
	    'link'  => '/addons/apps/simple_calendar/accommodation/booking/delete/?id='.$_GET['id'],
	]);
	
	$Smartbar->add_item([
	    'active' => false,
	    'title' => 'Send Review Request',
	    'link'  => '/addons/apps/simple_calendar/accommodation/booking/send_reviewrequest/?id='.$_GET['id'],
	]);
	
	echo $Smartbar->render();
    
    # Main panel
    echo $HTML->main_panel_start();
   
    include('_subnav.php');

    if (isset($message)){
	    echo $message;
	}else{
	    
	    echo $HTML->heading3('Send Confirmation');
	    
	    echo $Form->form_start();
	    
	    $customerData = $SimpleCalendar->customer($booking['customerID']);
	    $unitData = $SimpleCalendar->unit($booking['unitID'],'');
	    $memberDetails = json_decode($customerData['memberProperties'],true);
	    $emailData = $SimpleCalendar->getEmail(5);
	    
	    $arrivalDates = explode(" ",$booking['startTime']);
	    $arrivalDates = explode("-",$arrivalDates[0]);
	    $arrival = "$arrivalDates[2]/$arrivalDates[1]/$arrivalDates[0]";
      
      $arrivalFull = date("l jS \of F Y", mktime(0, 0, 0, $arrivalDates[1], $arrivalDates[2], $arrivalDates[0]));
	    
	    $departureDates = explode(" ",$booking['endTime']);
	    $departureDates = explode("-",$departureDates[0]);
	    $departure = "$departureDates[2]/$departureDates[1]/$departureDates[0]";
      
      $departureFull = date("l jS \of F Y", mktime(0, 0, 0, $departureDates[1], $departureDates[2], $departureDates[0]));
	    
	    $arrivalDates = explode(" ",$booking['startTime']);
	    $departureDates = explode(" ",$booking['endTime']);
	    
	    $diff = strtotime($departureDates[0]) - strtotime($arrivalDates[0]);
		$nights = $diff/86400;
		
		$balance = $booking['cost'] - $booking['paid'];

		// Create DateTime object from the input date
		$date = new DateTime($arrivalDates[0]);
		$date->modify('-6 weeks');
		$balanceDue = $date->format('l jS \of F Y');
		
		$result = [
			'adults' => null,
			'children' => null,
			'pets' => null
		];
		
		// Extract Adults
		if (preg_match('/Adults:\s*(\d+)/', $booking['notes'], $matches)) {
			$result['adults'] = (int)$matches[1];
		}
		
		// Extract Children
		if (preg_match('/Children:\s*(\d+)/', $booking['notes'], $matches)) {
			$result['children'] = (int)$matches[1];
		}
		
		// Extract Pets - handles "Yes - 1", "No", "Yes", etc.
		if (preg_match('/Pets:\s*Yes\s*-\s*(\d+)/i', $booking['notes'], $matches)) {
			$result['pets'] = (int)$matches[1];
		} elseif (preg_match('/Pets:\s*No/i', $booking['notes'])) {
			$result['pets'] = 0;
		} elseif (preg_match('/Pets:\s*Yes/i', $booking['notes'])) {
			$result['pets'] = 1; // Assume 1 if just "Yes"
		}
		
		$memberAddress = $memberDetails['address_1'].', '.$memberDetails['address_2'].', '.$memberDetails['address_3'].', '.$memberDetails['post_code'];
		
		$placeHolders = array("{{unitName}}","{{today}}","{{bookingID}}","{{memberName}}","{{memberAddress}}","{{memberTelephone}}","{{memberEmail}}","{{bookingAdults}}","{{bookingChildren}}","{{bookingPets}}","{{bookingArrival}}","{{bookingDeparture}}","{{bookingNights}}","{{bookingCost}}","{{bookingDeposit}}","{{paymentMethod}}","{{bookingBalance}}","{{balanceDue}}","{{propertyDetails}}","{{keySafe}}");
		$emailContent = array($unitData['name'],date('d/m/Y'),"#".$booking['bookingID'],$memberDetails['first_name']." ".$memberDetails['last_name'],$memberAddress,$memberDetails['mobile'],$customerData['memberEmail'],$result['adults'],$result['children'],$result['pets'],$arrivalFull,$departureFull,$nights,$booking['cost'],$booking['paid'],'Card',$balance,$balanceDue,$unitData['carParking'],$unitData['keyCode']);

		$subject = str_replace(
		  $placeHolders,
		  $emailContent,
		  $emailData['subject']
		);
		
		$content = str_replace(
		  $placeHolders,
		  $emailContent,
		  $emailData['content']
		);
	
		echo $Form->text_field("subject","Subject",$subject);
		
		echo $Form->textarea_field("content","Content",$content);
		
		echo $Form->text_field("sendTo","Send To",$customerData['memberEmail']);
	
		echo $Form->hidden("send",'1');
	
		echo $Form->submit_field('btnSubmit', 'Send Confirmation', $API->app_path());
	
	    echo $Form->form_end();
	}

    
    echo $HTML->main_panel_end();
