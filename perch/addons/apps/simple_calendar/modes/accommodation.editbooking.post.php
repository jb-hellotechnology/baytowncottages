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
	    'active' => true,
	    'title' => 'Edit Booking',
	    'link'  => '/addons/apps/simple_calendar/accommodation/booking/edit/?id='.$_GET['id'],
	]);
	
	$Smartbar->add_item([
	    'active' => false,
	    'title' => 'Send Confirmation',
	    'link'  => '/addons/apps/simple_calendar/accommodation/booking/send_confirmation/?id='.$_GET['id'],
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

    # Main panel
    echo $HTML->main_panel_start();
   
    include('_subnav.php');
    
    if (isset($message)){ 
	    
	    echo $message;

	}else{
		
		echo $Form->form_start();
		
	    echo $HTML->heading3('Customer');
	    
	    $customers = $SimpleCalendar->getCustomers();
	    foreach($customers as $Customer){
		    $customerData = json_decode($Customer['memberProperties']);
		    $customerlist[] = array('label'=>"$customerData->first_name $customerData->last_name ($Customer[memberEmail])", 'value'=>$Customer['memberID']);
	    }
	    
	    echo $Form->select_field('customerID','',$customerlist,$booking['customerID']);	
      
      echo $HTML->para('<a href="/perch/addons/apps/perch_members/edit/?id='.$booking['customerID'].'" target="_blank">View Customer Details (opens in new window)</a>');

	    echo $HTML->heading3('Hire Period');
	    
	    echo $Form->date_field('start','Start Time', $booking['startTime'], 'y m d h i');
	   
	    echo $Form->date_field('end','End Time', $booking['endTime'], 'y m d h i');

	    echo $HTML->heading3('Unit');
	    
	    $accommodation = $SimpleCalendar->getAccUnit(-1);
	    
	    foreach($accommodation as $Accommodation){
		    $accommodationlist[] = array('label'=>$Accommodation['name'], 'value'=>$Accommodation['unitID']);
	    }
	    
	    echo $Form->select_field('unitID','',$accommodationlist,$booking['unitID']);
		
		echo $HTML->heading3('Add-Ons');
	    
	    $addons = $SimpleCalendar->getAddons();
		
		$i = 0;
		while($i<10){
			$array[] = array('label'=>$i, 'value'=>$i);
			$i++;
		}
		
		$addonsArray = json_decode($booking['addons'],true);
		
		foreach($addons as $Addon){
			echo $Form->label("addon_$Addon[addonID]","$Addon[name]");
			echo $Form->select_field("addon_$Addon[addonID]","",$array,$addonsArray['addon_'.$Addon['addonID']]);   
			echo $Form->text_field("addon__$Addon[addonID]_price","Price (each)",$addonsArray['addon_'.$Addon['addonID'].'_price']);
			$price = (float)$addonsArray['addon_'.$Addon['addonID'].'_price'];
			$addon = (float)$addonsArray['addon_'.$Addon['addonID']];
			$addoncost = $addoncost+($price*$addon);
	    }

		echo $HTML->heading3('Notes');
		
		echo $Form->textarea_field("notes","",$booking['notes']); 
		
		echo $HTML->heading3('Price');
		
		echo $Form->text_field("cost","Accommodation",$booking['cost']);
		echo $Form->text_field("addons","Add-ons",$addoncost);
		
		echo $HTML->heading3('Amount Paid');
		
		echo $Form->text_field("paid","",$booking['paid']);
		
		echo $HTML->heading3('Ready?');
	    
		echo $Form->submit_field('btnSubmit', 'Update Booking', $API->app_path());
		
		echo $Form->hidden("bookingID",$_GET['id']); 
	
	    echo $Form->form_end();
	
	}  

    echo $HTML->main_panel_end();
