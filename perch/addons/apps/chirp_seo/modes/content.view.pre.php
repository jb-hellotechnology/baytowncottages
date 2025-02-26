<?php

    $Pages   = new PerchContent_Pages;
    $Page  = false;

    // Find the page
    if (PerchUtil::get('id')) {
        $id = PerchUtil::get('id');

  			$Page = $Pages->find($id);
    }

    // Check we have a page
    if (!$Page || !is_object($Page)) {
        PerchUtil::redirect($API->app_path());
    }

    $url = ChirpSeo_Util::get_set_website_url($Page->pagePath());
    $details = $Page->to_array();

  	$Keywords = new ChirpSeo_Keywords($API);
		$Keyword    	 = false;
		$pageId  	 = false;
    $message   = false;
    $error = false;

    if (PerchUtil::get('id')) {
			$pageId = PerchUtil::get('id');
      $Keyword = $Keywords->find_by_url(ChirpSeo_Util::get_page_path_from_url($url));
    }

		$Template   = $API->get('Template');
    $Template->set('chirp_seo/keyword.html', 'seo');

		$Form = $API->get('Form');
		$tags = $Template->find_all_tags_and_repeaters();

		$Form->set_required_fields_from_template($Template, $details);

    if ($Form->submitted()) {
			$fixed_fields = $Form->receive(array('keywordTitle'));
			$data		 = $Form->get_posted_content($Template, $Keywords, $Keyword);

			$data = array_merge($data, $fixed_fields);
      $data["keywordURL"] = ChirpSeo_Util::get_page_path_from_url($url);

    	if (is_object($Keyword)) {
    	    $Keyword->update($data);
			} else {
    	    $Keyword = $Keywords->create($data);
    	}

			if (is_object($Keyword)) {
          $message = $HTML->success_message('Keyword updated.');
      } else {
          $message = $HTML->failure_message('Sorry, error occured.');
      }

    }

    if (is_object($Keyword)) {
			$details = $Keyword->to_array();
      $keyword = $Keyword->keywordTitle();
		} else {
      $keyword = false;
      $error = '<div class="notification notification-warning">' . PerchLang::get("To analyse your page, please set a keyword.") . '</div>';
    }

    try {
      $ChirpSeo_Seo = new ChirpSeo_ContentOverview($url, false);
      $ChirpSeo_Readability = new ChirpSeo_ReadabilityOverview($url, false);

      $ChirpSeo_Parser = new ChirpSeo_Parser($url);

      $snippet_url = $url;
      $snippet_title = $ChirpSeo_Parser->get_title_snippet();
      $snippet_meta_description = $ChirpSeo_Parser->get_meta_description_snippet();

    } catch (Exception $e) {
      $error = '<div class="notification notification-warning">' . PerchLang::get("An error occurred. Please ensure you have set the correct website URL in %s Settings %s", '<a href="' . PERCH_LOGINPATH . '/core/settings">', '</a>') . '</div>';
    }