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
	    'title' => 'Calendar',
	    'link'  => '/addons/apps/simple_calendar/accommodation',
	]);
	
	$Smartbar->add_item([
	    'active' => false,
	    'title' => 'Units',
	    'link'  => '/addons/apps/simple_calendar/accommodation/units',
	]);
	
	$Smartbar->add_item([
	    'active' => false,
	    'title' => 'Emails',
	    'link'  => '/addons/apps/simple_calendar/accommodation/emails',
	]);
	
	$Smartbar->add_item([
	    'active' => false,
	    'title' => 'Add-Ons',
	    'link'  => '/addons/apps/simple_calendar/accommodation/addons',
	]);
	
	echo $Smartbar->render();
    
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
	    
	    echo $Form->select_field('customerID','',$customerlist);	

	    echo $HTML->heading3('Hire Period');
	    
	    echo $Form->date_field('start','Start Time', date('Y-m-d 16:00'), 'y m d h i');
	   
	    echo $Form->date_field('end','End Time', date('Y-m-d 10:00'), 'y m d h i');

	    echo $HTML->heading3('Unit');
	    
	    $accommodation = $SimpleCalendar->getAccUnit(-1);
	    
	    foreach($accommodation as $Accommodation){
		    $accommodationlist[] = array('label'=>"$Accommodation[name]", 'value'=>$Accommodation['unitID']);
	    }
	    
	    echo $Form->select_field("unitID","",$accommodationlist,'');
		
		echo $HTML->heading3('Add-Ons');
	    
	    $addons = $SimpleCalendar->getAddons();
		
		$i = 0;
		while($i<10){
			$array[] = array('label'=>$i, 'value'=>$i);
			$i++;
		}
		
		foreach($addons as $Addon){
			echo $Form->label("addon_$Addon[addonID]","$Addon[name] - £$Addon[price]");
			echo $Form->select_field("addon_$Addon[addonID]","",$array,'');   
	    }

		echo $HTML->heading3('Notes');
		
		echo $Form->textarea_field("notes",""); 
		
		echo $HTML->heading3('Ready?');
	    
		echo $Form->submit_field('btnSubmit', 'Process Booking', $API->app_path());
	
	    echo $Form->form_end();
	
	}  

    echo $HTML->main_panel_end();
