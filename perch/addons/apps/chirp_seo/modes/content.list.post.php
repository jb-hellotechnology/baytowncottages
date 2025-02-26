<?php

    echo $HTML->title_panel([
      'heading' => $Lang->get('Summary'),
    ], $CurrentUser);

    if ($error) echo $error; 
    if ($message) echo $message;

    $path = $API->app_path('chirp_seo');

        if (PerchUtil::count($pages)) {

          $Listing = new PerchAdminListing($CurrentUser, $HTML, $Lang, $Paging);

          $Listing->add_col([
                  'title'     => 'Title',
                  'sort'      => 'pageNavText',
                  'value'     => 'pageNavText',
                  'edit_link' => 'content/view',
              ]);

          $Listing->add_col([
                  'title'     => 'SEO Status',
                  'value'     => function($Page) use ($path) {
                    $url = ChirpSeo_Util::get_set_website_url($Page->pagePath());

                    return '<span class="score loading" data-url="' . $url . '" data-type="seocontent" data-js="trafficLights" data-path="' . $path . '"><span></span><span></span><span></span><span></span></span>';
                  },
              ]);

          $Listing->add_col([
                  'title'     => 'Readability Status',
                  'value'     => function($Page) use ($path) {
                    $url = ChirpSeo_Util::get_set_website_url($Page->pagePath());
                    return '<span class="score loading" data-url="' . $url . '" data-type="readability" data-js="trafficLights" data-path="' . $path . '"><span></span><span></span><span></span><span></span></span>';
                  },
              ]);

          echo $Listing->render($pages);

        }else{
        ?>
            <div class="notification notification-info"><?php echo PerchLang::get('No pages with regions found.'); ?>
        <?php
            }
