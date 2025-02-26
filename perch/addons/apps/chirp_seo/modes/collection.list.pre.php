<?php
    $HTML = $API->get('HTML');

    $Keywords = new ChirpSeo_Keywords($API);

    $keywords = array();

    $keywords = $Keywords->all();

    // Install only if $things is false.
    // This will run the code in activate.php so should only ever happen on first run - silently installing the app.
    if ($keywords == false) {
    	$Keywords->attempt_install();
    }

    $collectionID = (int)PerchUtil::get('id');

    $collections = false;

    if (PERCH_RUNWAY) {
      $Collections = new PerchContent_Collections();

      $Collection = $Collections->find($collectionID);

      $items = $Collection->get_items_for_editing(false, $Paging);
    }