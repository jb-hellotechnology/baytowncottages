<?php

	// Define subnav links and titles
	
	PerchUI::set_subnav([
        [
            'page' => 'simple_calendar/accommodation',
            'label'=> 'Accommodation'
        ],
        [
            'page' => 'simple_calendar/reviews',
            'label'=> 'Reviews'
        ],
    ], $CurrentUser);
