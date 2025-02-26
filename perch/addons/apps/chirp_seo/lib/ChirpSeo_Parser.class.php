<?php

use PHPHtmlParser\Dom;

class ChirpSeo_Parser
{

  protected $url;
  protected $dom;

  function __construct($url = "")
  {
    $this->url = $url;
    
    $this->dom = new Dom;
    $this->dom->loadFromUrl($url);
  }

  function get_all_contents() {
    $all = $this->dom->find('h1, h2, h3, h4, h5, p, ul');
    return $all;
  }

  function get_title_contents() {
    $titles = $this->dom->find('h1, h2, h3, h4, h5');

    return $titles;
  }

  function get_paragraph_contents() {
    $paragraphs = $this->dom->find('p, ul');

    return $paragraphs;
  }
  
  function get_image_tags() {
    $paragraphs = $this->dom->find('img');

    return $paragraphs;
  }

  function get_meta_description() {
    $meta = $this->dom->find('meta[name="description"]')[0];

    if ($meta) {
      $text = $meta->getAttribute("content");
      return $text;
    }

    return false;
  }

  function get_meta_description_snippet() {
    $snippet_meta_description = $this->get_meta_description();

    if (strlen($snippet_meta_description)> 160) {
      $snippet_meta_description = substr($snippet_meta_description, 0, 160).'...';
    }

    return $snippet_meta_description;
  }

  function get_page_title() {
    $meta = $this->dom->find('head title')[0];
    
    if ($meta) {
      $text = $meta->text;

      return $text;
    }

    return false;
  }

  function get_title_snippet() {
    $snippet_title = $this->get_page_title();

    if (strlen($snippet_title) > 55) {
      $snippet_title = substr($snippet_title, 0, 55).'...';
    }

    return $snippet_title;
  }

}
