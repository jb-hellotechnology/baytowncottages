<?php

class ChirpSeo_Seo_PageTitleLength extends ChirpSeo_Seo_Base
{
  private $lower_limit = 50;
  private $upper_limit = 60;

  function __construct($keyword = false, $content_for_analysis = "")
  {
    parent::__construct($keyword, $content_for_analysis);

    $this->calculate_score();
  }

  public function calculate_score() {
    $this->score = strlen($this->content_for_analysis);
  }

  public function get_traffic_light() {
    if ($this->score >= $this->lower_limit && $this->score <= $this->upper_limit) {
      return "green";
    }

    return "red";
  }

  public function get_description() {
    $description = "";

    if ($this->score >= $this->lower_limit && $this->score <= $this->upper_limit) {
			$description = PerchLang::get("The page title is %s characters! Ideal length is %s-%s characters, good job!", $this->score, $this->lower_limit, $this->upper_limit);
		} else {
      $description = PerchLang::get("The page title is %s characters! Work at it. Ideal length is %s-%s characters.", $this->score, $this->lower_limit, $this->upper_limit);
		}

    return $description;
  }
}
