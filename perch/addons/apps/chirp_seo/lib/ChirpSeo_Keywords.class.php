<?php

class ChirpSeo_Keywords extends PerchAPI_Factory
{
    protected $table     = 'chirp_seo';
	protected $pk        = 'keywordID';
	protected $singular_classname = 'ChirpSeo_Keyword';

	protected $default_sort_column = 'keywordPageID';

	public $static_fields   = array('keywordID', 'keywordTitle', 'keywordURL', 'keywordDynamicFields');

  public function find_by_url($url)
  {
      $sql = 'SELECT * FROM ' . $this->table . ' WHERE keywordURL="' . $url . '"';

      $row = $this->db->get_row($sql);

      $r = $this->return_instance($row);

      return $r;

      return false;
  }

}
