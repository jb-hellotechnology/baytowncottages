<?php

class ChirpSeo_Seo_Base extends ChirpSeo_Base
{

  protected $keyword = "";

  function __construct($keyword = false, $content_for_analysis = "")
  {
    $this->keyword = $keyword;
    $this->content_for_analysis = $content_for_analysis;
  }

}
