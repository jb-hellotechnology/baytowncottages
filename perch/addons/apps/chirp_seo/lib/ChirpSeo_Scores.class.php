<?php

class ChirpSeo_Scores extends PerchAPI_Factory
{
    protected $table     = 'chirp_seo_scores';
	protected $pk        = 'scoreID';
	protected $singular_classname = 'ChirpSeo_Score';

	protected $default_sort_column = 'scoreID';

	public $static_fields   = array('scoreID', 'url', 'readabilityScore', 'seoScore', 'pagespeedScore');

  public function find_by_url($url)
  {
      $sql = 'SELECT * FROM ' . $this->table . ' WHERE url="' . $url . '"';

      $row = $this->db->get_row($sql);

      $r = $this->return_instance($row);

      return $r;

      return false;
  }

}
