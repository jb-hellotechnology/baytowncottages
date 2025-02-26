<?php

	PerchUI::set_subnav([
		[
			'page'=>[

					'perch_events',
					'perch_events/delete',
					'perch_events/edit'
			],
			 'label'=>'Add/Edit'
		],
		[
			'page'=>[

					'perch_events/categories',
					'perch_events/categories/edit',
					'perch_events/categories/delete',

			],
			 'label'=>'Categories', 'priv'=>'perch_events.categories.manage'
		],
	], $CurrentUser);
