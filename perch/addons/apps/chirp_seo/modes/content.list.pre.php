<?php
    // Try to update
    $Settings = $API->get('Settings');

    if ($Settings->get('chirp_update')->val()!='1.2.1') {
        PerchUtil::redirect($API->app_path().'/update/');
    }

    $Pages      = new PerchContent_Pages;

    $HTML = $API->get('HTML');

    $Paging->set_per_page(20);

    $allpages = $Pages->get_by('pageHidden', '', 'pageTreePosition', $Paging);

    $pages = array();

    foreach($allpages as $Page) {
      $page = $Page->to_array();
      $pages[] = $Page;
    }

    $Keywords = new ChirpSeo_Keywords($API);

    $keywords = array();
    $error = false;
    $message = false;

    $url = ChirpSeo_Util::get_set_website_url();

    if (empty($url)) {
      $error = '<div class="notification notification-warning">' . PerchLang::get("An error occurred. Please ensure you have set the correct website URL in %s Settings %s (e.g. http://yourdomain.co.uk)", '<a href="' . PERCH_LOGINPATH . '/core/settings">', '</a>') . '</div>';
    }

    $keywords = $Keywords->all();

    // Install only if $things is false.
    // This will run the code in activate.php so should only ever happen on first run - silently installing the app.
    if ($keywords == false) {
    	$Keywords->attempt_install();
    }
 