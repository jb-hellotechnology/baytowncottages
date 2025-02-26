<?php

use DaveChild\TextStatistics;

class ChirpSeo_Readability_Paragraph extends ChirpSeo_Readability_Base
{

  private $ideal_paragraph_length = 250;

  function __construct($content_for_analysis = "")
  {
    parent::__construct($content_for_analysis);

    $this->red_score = 10;
    $this->amber_score = 20;

    $this->calculate_score();
  }

  public function calculate_score() {
    $this->score = $this->analyse_text_paragraph_length($this->content_for_analysis);
  }

  public function get_description() {
    $description = "";

    if ($this->calculate_score_percentage() <= $this->red_score) {
			$description = PerchLang::get("%s%% of the paragraphs contain more than %s words, which is less than or equal to the ideal maximum of %s%%.", $this->calculate_score_percentage(), $this->ideal_paragraph_length, $this->amber_score);
		} else {
			$description = PerchLang::get("%s%% of the paragraphs contain more than %s words, which is more than the ideal maximum of %s%%.", $this->calculate_score_percentage(), $this->ideal_paragraph_length, $this->amber_score);
		}

    return $description;
  }

  public function get_traffic_light() {
    if ($this->calculate_score_percentage() >= $this->red_score) {
      return "red";
    } else if ($this->calculate_score_percentage() >= $this->amber_score) {
      return "amber";
    }

    return "green";
  }

  private function calculate_score_percentage() {
    $total_paragraphs = count($this->content_for_analysis);

    if ($this->score != 0) {
      $percentage_long_paragraphs = ($this->score / $total_paragraphs) * 100;
    } else {
      $percentage_long_paragraphs = 0;
    }

    return round($percentage_long_paragraphs, 1);
  }

  private function analyse_text_paragraph_length($paragraphs) {
    $bad_paragraphs = 0;

    foreach($paragraphs as $paragraph) {
      if (str_word_count($paragraph->text) > $this->ideal_paragraph_length) {
        $bad_paragraphs++;
      }
    }

    return $bad_paragraphs;
  }

}
