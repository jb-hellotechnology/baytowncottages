<?php
    $HTML = $API->get('HTML');

    $Keywords = new ChirpSeo_Keywords($API);

    $keywords = array();
    $error = false;
    $message = false;

    $keywords = $Keywords->all();

    // Install only if $things is false.
    // This will run the code in activate.php so should only ever happen on first run - silently installing the app.
    if ($keywords == false) {
    	$Keywords->attempt_install();
    }

    $products = false;

    if (class_exists('PerchShop_Products')) {
      $Products = new PerchShop_Products($API);

      if (PerchUtil::count($Products->all())) {
        $products = $Products->get_for_admin_listing($Paging);
      }
    }

    $url = ChirpSeo_Util::get_set_website_url();

    if (empty($url)) {
      $error = '<div class="notification notification-warning">' . PerchLang::get("An error occurred. Please ensure you have set the correct website URL in %s Settings %s (e.g. http://yourdomain.co.uk)", '<a href="' . PERCH_LOGINPATH . '/core/settings">', '</a>') . '</div>';
    }

    if (!PerchUtil::count($products)) {
      $message = '<div class="notification notification-info">' . PerchLang::get('No products found. This section is for Perch Shop product analysis.') . '</div>';
    }