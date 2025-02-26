<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

class CMA_Searches extends PerchAPI_Factory
{
    protected $table     = 'cma_branchcontact';
	protected $pk        = 'branchContactID';

    
    public function getMembers($q){

	    $sql = 'SELECT * FROM '.PERCH_DB_PREFIX.'members WHERE (memberEmail LIKE "%'.$q.'%") OR (memberProperties LIKE "%'.$q.'%")';
		$data = $this->db->get_rows($sql);
		
		echo "<ul>";
		
		foreach($data AS $member){
			$memberProperties = json_decode($member['memberProperties']);
			echo "<li><a href=\"/perch/addons/apps/perch_members/edit/?id=$member[memberID]\">$memberProperties->first_name $memberProperties->last_name ($member[memberEmail]) $memberProperties->member_no</a></li>";
		}
		
		echo "</ul>";
		
    }
    
}