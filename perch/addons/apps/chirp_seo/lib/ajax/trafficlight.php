<?php 
  include('../../../../../core/inc/api.php');

  header('Content-type: application/json');

  $url = $_GET['url'];
  $lighttype = $_GET['lighttype'];

  $website_url = ChirpSeo_Util::get_set_website_url();
  
  if (isset($website_url) && isset($lighttype)) {

    try {
      if ($lighttype == "readability") {
        $Chirp_Seo = new ChirpSeo_ReadabilityOverview($url);
      } else {
        $Chirp_Seo = new ChirpSeo_ContentOverview($url); 
      }
  
      $light = $Chirp_Seo->get_traffic_light();
  
      $return = array();
      $return["type"] = $lighttype;
  
      if (empty($website_url)) {
        $return["light"] = "warning";
      } else {
        $return["light"] = $light;
      }
  
      echo json_encode($return);
    }  catch (Exception $e) {

      $return = array();
      $return["light"] = "warning";
      echo json_encode($return);
    }
    
  }

?>