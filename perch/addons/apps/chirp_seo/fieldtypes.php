<?php

class PerchFieldType_chirpseo extends PerchFieldType
{
    public function render_inputs($details=array())
    {
      $this->render($details);
    }

    public function add_page_resources()
    {
      $Perch = Perch::fetch();
      $Perch->add_css(PERCH_LOGINPATH.'/addons/apps/chirp_seo/assets/css/seo.css');
      $Perch->add_javascript(PERCH_LOGINPATH.'/addons/apps/chirp_seo/assets/js/app.js');
    }

    private function render($details) {
      $API  = new PerchAPI(1.0, 'chirp_seo');
      $HTML   = $API->get('HTML');
      $Lang   = $API->get('Lang');
      $Paging = $API->get('Paging');

      $Pages   = new PerchContent_Pages;
      $Page  = false;
      
      $Keywords = new ChirpSeo_Keywords($API);
      $Keyword    	 = false;
      
      $error = false;
      $message = false;

      $Page = $Pages->find($details["pageID"]);

      $url = ChirpSeo_Util::get_set_website_url($Page->pagePath());

      $Keyword = $Keywords->find_by_url(ChirpSeo_Util::get_page_path_from_url($url));

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

      if ($error) echo $error;
      if ($message) echo $message;

        if ($keyword && !$error) {
      
          echo '
          <h2 class="divider"><div>Google Preview</div></h2>
          <div class="field-wrap">
            <div class="inner">
              <div>
                <div class="snippet">
                  <h3 class="title">' .  $snippet_title . ' </h3>
                  <p class="url">' .  $snippet_url . ' </h3>
                  <p class="description">' .  $snippet_meta_description . ' </p>
                </div>
              </div>
            </div>
          </div>
      
          <h2 class="divider"><div>Performance</div></h2>
          <div class="field-wrap">
            <div class="inner">
              <div class="panel clearfix">
                <div id="pagescore" data-js="pagescore" data-url="' .  $url . ' " data-path="' .  $API->app_path('chirp_seo') . '"></div>
              </div>
            </div>
          </div>
      
          <h2 class="divider"><div>Readability Analysis</div></h2>
          <div class="field-wrap">
            <div class="inner">
              <div>
                <table class="collapse nested-list">
                    <thead>
                        <tr>
                            <th class="first"></th>
                            <th class="first">' . PerchLang::get('Title') . ' </th>
                        </tr>
                    </thead>
                    <tbody>';

                      foreach($ChirpSeo_Readability->get_tests() as $readability_row) { 
                        echo '<tr>
                            <td><span class="score ' .  $readability_row->get_traffic_light() . ' "></span></td>
                            <td>' .  $readability_row->get_description() . ' </td>
                        </tr>';
                      }

            echo
                    '</tbody>
                </table>
              </div>
            </div>
          </div>
      
          <h2 class="divider"><div>SEO Analysis</div></h2>
      
          <div class="field-wrap">
            <div class="inner">
              <div>
                <table class="collapse nested-list">
                    <thead>
                        <tr>
                            <th class="first"></th>
                            <th class="first">' .  PerchLang::get('Title') . ' </th>
                        </tr>
                    </thead>
                    <tbody>';

                      foreach($ChirpSeo_Seo->get_tests() as $seo_row) {
                        echo '<tr>
                            <td><span class="score ' .  $seo_row->get_traffic_light() . ' "></span></td>
                            <td>' .  $seo_row->get_description() . ' </td>
                        </tr>';
                      }
                  echo ' </tbody>
                </table>
            </div>
          </div>
        </div>';
      }
    }
}