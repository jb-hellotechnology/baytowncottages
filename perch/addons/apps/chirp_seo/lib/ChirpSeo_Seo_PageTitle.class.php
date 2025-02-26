<?php

class ChirpSeo_Seo_PageTitle extends ChirpSeo_Seo_Base
{

  function __construct($keyword = false, $content_for_analysis = "")
  {
    parent::__construct($keyword, $content_for_analysis);

    $this->red_score = 0;
    $this->amber_score = 0.5;

    $this->calculate_score();
  }

  public function calculate_score() {
    if (!$this->keyword) {
      $this->score = 0;
      return;
    }

    if (substr_count(strtolower($this->content_for_analysis), strtolower($this->keyword)) > 0) {
      $this->score = 1;
    } else {
      $this->score = 0;
    }
  }

  public function get_description() {
    $description = "";

    if ($this->score <= $this->red_score) {
			$description = PerchLang::get("The SEO title doesn't contain the focus keyword. A good format to use is 'Primary Keyword - Secondary Keyword | Brand Name'");
		} else {
			$description = PerchLang::get("The SEO title contains the focus keyword, good job!");
		}

    return $description;
  }
}
