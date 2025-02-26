<?php

class ChirpSeo_Base
{
  protected $red_score = 1;
  protected $amber_score = 1;
  protected $green_score = 1;
  protected $score = 0;
  protected $content_for_analysis = "";

  function __construct($content_for_analysis = "")
  {
    $this->content_for_analysis = $content_for_analysis;
  }

  public function calculate_score() {
    return 0;
  }

  public function get_traffic_light() {
    if ($this->score <= $this->red_score) {
      return "red";
    } else if ($this->score <= $this->amber_score) {
      return "amber";
    }

    return "green";
  }

  public function get_description() {
    return "";
  }

  public function get_score() {
    return $this->score;
  }
}
