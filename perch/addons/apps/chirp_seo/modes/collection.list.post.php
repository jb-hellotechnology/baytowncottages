<?php
    echo $HTML->title_panel([
    'heading' => PerchLang::get("Viewing Analysis for '%s'", PerchUtil::html($Collection->collectionKey()))
    ], $CurrentUser);

    $path = $API->app_path('chirp_seo');

    if (PerchUtil::count($items)) {

        $Listing = new PerchAdminListing($CurrentUser, $HTML, $Lang, $Paging);

        $Listing->add_col([
          'title'     => 'Title',
          'sort'      => 'title',
          'value'     => function($Item) {
            $title = ChirpSeo_Util::get_title_for_collection_item($Item);
            return '<a href="view?collection=' . $Item->collectionID() . '&id=' . $Item->itemID() . '" class="primary">' . $title . '</a>';
          },
        ]);

        $Listing->add_col([
          'title'     => 'SEO Status',
          'value'     => function($Item) use ($Collection, $path) {
            $url = ChirpSeo_Util::get_set_website_url_from_collection($Collection, $Item->itemID());
            return '<span class="score loading" data-url="' . $url . '" data-type="seocontent" data-js="trafficLights" data-path="' . $path . '"><span></span><span></span><span></span><span></span></span>';
          },
        ]);

        $Listing->add_col([
          'title'     => 'Readability Status',
          'value'     => function($Item) use ($Collection, $path) {
            $url = ChirpSeo_Util::get_set_website_url_from_collection($Collection, $Item->itemID());
            return '<span class="score loading" data-url="' . $url . '" data-type="readability" data-js="trafficLights" data-path="' . $path . '"><span></span><span></span><span></span><span></span></span>';
          },
        ]);
            
        echo $Listing->render($Listing->objectify($items, 'itemID'));

      }else{
      ?>
          <div class="notification notification-info"><?php echo PerchLang::get('No items found.'); ?>
      <?php
          }
