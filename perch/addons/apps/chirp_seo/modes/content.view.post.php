<?php
echo $HTML->title_panel([
'heading' => PerchLang::get("Viewing Analysis for '%s'", PerchUtil::html($Page->pageNavText()))
], $CurrentUser);
?>

  <?php if ($error) echo $error; ?>
  <?php if ($message) echo $message; ?>

  <div class="smartbar">
      <ul>
        <li>
          <div class="breadcrumb tab-active">
            <a href="<?php echo PERCH_LOGINPATH . $API->app_nav() . '/'; ?>"><?php echo PerchLang::get('Content'); ?></a>
            <?php echo PerchUI::icon('core/o-navigate-right', 8, 'Navigate'); ?>
            <a href="#"><?php echo PerchUtil::html($Page->pageNavText()); ?></a>
           </div>
         </li>
          <li>
              <form method="post" class="smartbar-search">
                  <label><?php echo PerchUI::icon('core/o-key', 16, 'Search'); ?>
                      <input name="keywordTitle" type="text" placeholder="Keyword Title" class="search" value="<?php echo $keyword; ?>">
                  </label>
                  <input type="hidden" name="formaction" value="chirp_seo">
                  <input type="hidden" name="token" value="<?php echo $Form->get_token(); ?>">
                  <button class="button button-small action-info">Update</button>
              </form>
          </li>
          <li class="smartbar-end smartbar-util">
            <a href="<?php echo PERCH_LOGINPATH . '/core/apps/content/page/?f=pl&id=' . $Page->pageID(); ?>" title="Edit Page" class="viewext">
              <?php echo PerchUI::icon('core/document', 16, 'Page'); ?>
              <span>Edit Page</span>
            </a>
          </li>
          <li class="smartbar-util">
            <a href="<?php echo $snippet_url; ?>" title="View Page" class="viewext">
              <?php echo PerchUI::icon('core/o-world', 16, 'Page'); ?>
              <span>View Page</span>
            </a>
          </li>
      </ul>
  </div>

  <?php if ($keyword && !$error) { ?>

    <div class="inner">

      <div id="dashboard" class="dashboard">
        <div data-app="readability" class="widget">
          <div class="dash-content">
            <header>
              <h2>Readability</h2>
            </header>
          </div>
          <div class="panel clearfix">
            <div class="pulse" data-status="<?php echo $ChirpSeo_Readability->get_traffic_light(); ?>">
              <div class="status">
              </div>
            </div>
            <h2><?php echo $ChirpSeo_Readability->get_title(); ?></h2>
            <p><?php echo $ChirpSeo_Readability->get_description(); ?></p>
          </div>
        </div>
        <div data-app="seo" class="widget">
          <div class="dash-content">
            <header>
              <h2>SEO</h2>
            </header>
          </div>
          <div class="panel clearfix">
            <div class="pulse" data-status="<?php echo $ChirpSeo_Seo->get_traffic_light(); ?>">
              <div class="status">
              </div>
            </div>
            <h2><?php echo $ChirpSeo_Seo->get_title(); ?></h2>
            <p><?php echo $ChirpSeo_Seo->get_description(); ?></p>
          </div>
        </div>
      </div>
    </div>

    <h2 class="divider"><div>Google Preview</div></h2>
    <div class="inner">
      <div>
        <div class="snippet">
          <h3 class="title"><?php echo $snippet_title; ?></h3>
          <p class="url"><?php echo $snippet_url; ?></h3>
          <p class="description"><?php echo $snippet_meta_description; ?></p>
        </div>
      </div>
    </div>

    <h2 class="divider"><div>Performance</div></h2>
    <div class="inner">
      <div class="panel clearfix">
        <div id="pagescore" data-js="pagescore" data-url="<?php echo $url; ?>" data-path="<?php echo $API->app_path('chirp_seo'); ?>"></div>
      </div>
    </div>

    <h2 class="divider"><div>Readability Analysis</div></h2>
    <div class="inner">
      <div>
        <table class="collapse nested-list">
            <thead>
                <tr>
                    <th class="first"></th>
                    <th class="first"><?php echo PerchLang::get('Title'); ?></th>
                </tr>
            </thead>
            <tbody>
              <?php foreach($ChirpSeo_Readability->get_tests() as $readability_row) { ?>
                <tr>
                    <td><span class="score <?php echo $readability_row->get_traffic_light(); ?>"></span></td>
                    <td><?php echo $readability_row->get_description(); ?></td>
                </tr>
              <?php } ?>
            </tbody>
        </table>
      </div>
    </div>

    <h2 class="divider"><div>SEO Analysis</div></h2>

    <div class="inner">
      <div>
        <table class="collapse nested-list">
            <thead>
                <tr>
                    <th class="first"></th>
                    <th class="first"><?php echo PerchLang::get('Title'); ?></th>
                </tr>
            </thead>
            <tbody>
              <?php foreach($ChirpSeo_Seo->get_tests() as $seo_row) { ?>
                <tr>
                    <td><span class="score <?php echo $seo_row->get_traffic_light(); ?>"></span></td>
                    <td><?php echo $seo_row->get_description(); ?></td>
                </tr>
              <?php } ?>
            </tbody>
        </table>
    </div>
  </div>

<?php
  }
    ?>
