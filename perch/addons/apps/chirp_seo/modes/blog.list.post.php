<?php

    echo $HTML->title_panel([
      'heading' => $Lang->get('Summary'),
    ], $CurrentUser);
    
    if ($error) echo $error; 
    if ($message) echo $message;

    $path = $API->app_path('chirp_seo');

    if (PerchUtil::count($posts)) {

        $Listing = new PerchAdminListing($CurrentUser, $HTML, $Lang, $Paging);

        $Listing->add_col([
                'title'     => 'Title',
                'sort'      => 'postTitle',
                'value'     => 'postTitle',
                'edit_link' => 'view',
            ]);

          $Listing->add_col([
                  'title'     => 'SEO Status',
                  'value'     => function($Blog) use ($path) {
                    $url = ChirpSeo_Util::get_set_website_url($Blog->postURL());

                    return '<span class="score loading" data-url="' . $url . '" data-type="seocontent" data-js="trafficLights" data-path="' . $path . '"><span></span><span></span><span></span><span></span></span>';
                  },
              ]);

          $Listing->add_col([
                  'title'     => 'Readability Status',
                  'value'     => function($Blog) use ($path) {
                    $url = ChirpSeo_Util::get_set_website_url($Blog->postURL());
                    return '<span class="score loading" data-url="' . $url . '" data-type="readability" data-js="trafficLights" data-path="' . $path . '"><span></span><span></span><span></span><span></span></span>';
                  },
              ]);
            
        echo $Listing->render($posts);

      }
      ?>
