<?php

class ChirpSeo_ContentOverview
{
  protected $score = 0;
  protected $red_score = 33;
  protected $amber_score = 66;
  protected $keyword = false;
  protected $cache = false;
  protected $tests = [];

  function __construct($url, $from_cache = true)
  {

    $this->cache = $from_cache;
    
    $ChirpScores = new ChirpSeo_Scores();
    $Score = $ChirpScores->find_by_url(ChirpSeo_Util::get_page_path_from_url($url));

    if ($from_cache) {
      if ($Score && $Score->seoScore() != null) {
        $this->score = $Score->seoScore();
        return;
      }
    } 

    $ChirpKeywords = new ChirpSeo_Keywords();
    $Keyword    	 = false;

    $Keyword = $ChirpKeywords->find_by_url(ChirpSeo_Util::get_page_path_from_url($url));

		if (is_object($Keyword)) {
			$details = $Keyword->to_array();
      $keyword = $Keyword->keywordTitle();
		} else {
      $keyword = false;
    }

    $this->keyword = $keyword;

    $ChirpSeo_Parser = new ChirpSeo_Parser($url);

    $all_content = $ChirpSeo_Parser->get_all_contents();
    $paragraphs = $ChirpSeo_Parser->get_paragraph_contents();
    $titles = $ChirpSeo_Parser->get_title_contents($url);
    $page_title = $ChirpSeo_Parser->get_page_title($url);
    $meta_description = $ChirpSeo_Parser->get_meta_description($url);
    $image_tags = $ChirpSeo_Parser->get_image_tags($url);

    $Seo_KeywordDensity = new ChirpSeo_Seo_KeywordDensity($keyword, $all_content);
    $Seo_KeywordTitles = new ChirpSeo_Seo_KeywordTitles($keyword, $titles);
    $Seo_PageTitle = new ChirpSeo_Seo_PageTitle($keyword, $page_title);
    $Seo_PageTitleLength = new ChirpSeo_Seo_PageTitleLength($keyword, $page_title);
    $Seo_MetaDescription = new ChirpSeo_Seo_MetaDescription($keyword, $meta_description);
    $Seo_ImageAltTags = new ChirpSeo_Seo_ImageAltTags($keyword, $image_tags);

    $this->tests = [$Seo_PageTitle, $Seo_MetaDescription, $Seo_KeywordDensity, $Seo_KeywordTitles, $Seo_PageTitleLength, $Seo_ImageAltTags];

    $tests_green = array_filter($this->tests, array(new ChirpSeo_Util, 'filter_traffic_light_green'));
    $this->score = round(count($tests_green) / count($this->tests) * 100, 1);

    if ($Score) {
      $Score->update([
        'seoScore' => $this->score
      ]);
    } else {
      $ChirpScores->create([
        'url' => ChirpSeo_Util::get_page_path_from_url($url),
        'seoScore' => $this->score
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
      $description = PerchLang::get("Your Search Engine Optimisation could be improved. Check the suggestions below.");
    } else if ($this->score <= $this->amber_score) {
      $description = PerchLang::get("Your Search Engine Optimisation is good, you're doing mighty fine!");
    } else {
      $description = PerchLang::get("Your Search Engine Optimisation is on point. &#128076;");
    }

    return $description;
  }
}
