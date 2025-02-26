<?php

class ChirpSeo_ReadabilityOverview
{
  protected $score = 0;
  protected $red_score = 33;
  protected $amber_score = 66;
  protected $cache = false;
  protected $tests = [];

  function __construct($url, $from_cache = true)
  {
    $this->cache = $from_cache;
    
    $ChirpScores = new ChirpSeo_Scores();
    $Score = $ChirpScores->find_by_url(ChirpSeo_Util::get_page_path_from_url($url));

    if ($from_cache) {
      if ($Score && $Score->readabilityScore() != null) {
        $this->score = $Score->readabilityScore();
        return;
      }
    } 

    $ChirpSeo_Parser = new ChirpSeo_Parser($url);
    $all_content = $ChirpSeo_Parser->get_all_contents();
    $paragraphs = $ChirpSeo_Parser->get_paragraph_contents();

    $Readability_FleschKincaid = new ChirpSeo_Readability_FleschKincaid($paragraphs);
    $Readability_Paragraph = new ChirpSeo_Readability_Paragraph($paragraphs);
    $Readability_Sentence = new ChirpSeo_Readability_Sentence($paragraphs);
    $Readability_PageLength = new ChirpSeo_Readability_PageLength($all_content);

    $this->tests = [$Readability_FleschKincaid, $Readability_Paragraph, $Readability_Sentence, $Readability_PageLength];

    $tests_green = array_filter($this->tests, array(new ChirpSeo_Util, 'filter_traffic_light_green'));
    $this->score = round(count($tests_green) / count($this->tests) * 100, 1);

    if ($Score) {
      $Score->update([
        'readabilityScore' => $this->score
      ]);
    } else {
      $ChirpScores->create([
        'url' => ChirpSeo_Util::get_page_path_from_url($url),
        'readabilityScore' => $this->score
      ]);
    }
  }

  public function get_tests() {
    return $this->tests;
  }

  public function get_traffic_light() {
    if ($this->score <= $this->red_score) {
      return "red";
    } else if ($this->score <= $this->amber_score) {
      return "amber";
    }

    return "green";
  }

  public function get_title() {
    if ($this->score <= $this->red_score) {
      $title = "Get to work!";
    } else if ($this->score <= $this->amber_score) {
      $title = "Good job!";
    } else {
      $title = "Nailed it!";
    }

    return $title;
  }

  public function get_description() {
    if ($this->score <= $this->red_score) {
      $description = PerchLang::get("Your readability could be improved. Check the suggestions.");
    } else if ($this->score <= $this->amber_score) {
      $description = PerchLang::get("Your readability is good, you're on the right track!");
    } else {
      $description = PerchLang::get("Your readability is really good, gold star for you!");
    }

    return $description;
  }
}
