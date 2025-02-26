<?php

class ChirpSeo_Seo_KeywordTitles extends ChirpSeo_Seo_Base
{

  function __construct($keyword = false, $content_for_analysis = "")
  {
    parent::__construct($keyword, $content_for_analysis);

    $this->red_score = 0;
    $this->amber_score = 0;

    $this->calculate_score();
  }

  public function calculate_score() {
    $density_count = $this->analyse_text_keyword_titles($this->content_for_analysis);

    $this->score = round($density_count, 1);
  }

  public function get_description() {
    $description = "";

    if ($this->score <= $this->red_score) {
			$description = PerchLang::get("The keyword is found %s times in your headings, which can be improved. Try and include your keyword in the headings at least once.", $this->score);
		} else {
			$description = PerchLang::get("The keyword is found %s times in your headings, great job!", $this->score);
		}

    return $description;
  }

  private function analyse_text_keyword_titles($titles) {
    if (!$this->keyword) {
      return 0;
    }

    $heading_count = 0;

    foreach($titles as $title) {
      $heading_count += substr_count(strtolower($title->text), strtolower($this->keyword));
    }

    return $heading_count;
  }
}
