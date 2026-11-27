<?php

class Simple_Calendars extends PerchAPI_Factory
{
    protected $table     = 'simple_calendar';
	protected $pk        = 'simpleCalendarID';
	protected $singular_classname = 'Simple_Calendar';
	
	protected $default_sort_column = 'id';
	
	public $static_fields   = array();	
    
    public function getAccUnit($parent){
	    
	    if($parent==0){
	    	$sql = 'SELECT * FROM simple_calendar_accommodation_units ORDER BY name ASC';
	    }elseif($parent>0){
			$sql = 'SELECT * FROM simple_calendar_accommodation_units ORDER BY name ASC';    
	    }else{
		    $sql = 'SELECT * FROM simple_calendar_accommodation_units ORDER BY name ASC';  
	    }

		$data = $this->db->get_rows($sql);

	    return $data;
	    
    }
    
    public function getAccSingleUnit($id){
	      
	    $sql = 'SELECT * FROM simple_calendar_accommodation_units WHERE unitID='.$id;  
	    
		$data = $this->db->get_row($sql);

	    return $data;
	    
    }
    
    public function getAccUnits($id){
	    
	    $sql = 'SELECT * FROM simple_calendar_accommodation_units WHERE typeID="'.$id.'" ORDER BY name ASC';
		$data = $this->db->get_rows($sql);

	    return $data;
	    
    }
    
    public function unitAdd($data){
	    
	    $unit = array();
	    $unit['name'] = $data['name'];
	    $unit['slug'] = $data['slug'];

	    $insert = $this->db->insert('simple_calendar_accommodation_units', $unit);
	    
    }
    
    public function unitUpdate($data){
	    
	    $unit = array();
	    $unit['name'] = $data['name'];
	    $unit['slug'] = $data['slug'];
		$unit['maxOccupants'] = $data['maxOccupants'];
	    $unit['plusOne'] = $data['plusOne'];
	    $unit['minDiscount'] = $data['minDiscount'];
	    $unit['discountPercentage'] = $data['discountPercentage'];
	    $unit['minDiscount2'] = $data['minDiscount2'];
	    $unit['discountPercentage2'] = $data['discountPercentage2']; 
	    $unit['maxPets'] = $data['maxPets'];
	    $unit['freePets'] = $data['freePets'];
	    $unit['singlePetCharge'] = $data['singlePetCharge'];
		
		$unit['ownerEmail'] = $data['ownerEmail'];
		$unit['sendOwnerEmail'] = $data['sendOwnerEmail'];
		
		$unit['cleanerEmail'] = $data['cleanerEmail'];
		$unit['sendCleanerEmail'] = $data['sendCleanerEmail'];
		
		$unit['keyCode'] = $data['keyCode'];
		$unit['carParking'] = $data['carParking'];

	    $insert = $this->db->update('simple_calendar_accommodation_units', $unit, 'unitID', $data['unitID']);
	    
    }
    
    public function unit($id,$object){
	    
	    $sql = 'SELECT * FROM simple_calendar_accommodation_units WHERE unitID="'.$id.'"';
		  $data = $this->db->get_row($sql);

		  return $data;
    }
  
    public function unitbySlug($slug,$object){
	    
	    $sql = 'SELECT * FROM simple_calendar_accommodation_units WHERE slug="'.$slug.'"';
	  	$data = $this->db->get_row($sql);

		  return $data;
    }
    
    public function unitSlug($slug){
	    
	    $sql = 'SELECT * FROM simple_calendar_accommodation_units WHERE slug="'.$slug.'"';
		$data = $this->db->get_row($sql);

		return $data;
    }
    
    public function unitDelete($id){

	    $unitDelete = $this->db->delete('simple_calendar_accommodation_units', 'unitID', $id);
	    
    }
    
    public function unitPrice($data){
	    
	    $pricing = array();
	    $pricing['unitID'] = $data['unitID'];
	    $pricing['startDate'] = "$data[startDate_year]-$data[startDate_month]-$data[startDate_day]";
	    $pricing['endDate'] = "$data[endDate_year]-$data[endDate_month]-$data[endDate_day]";
	    $pricing['freeText'] = $data['freeText'];
	    $pricing['minStay'] = $data['minStay'];
	    $pricing['changeOver'] = $data['changeOver'];
		$pricing['strict'] = $data['strict'];
		$pricing['discount'] = $data['discount'];
	    $pricing['onenight'] = $data['onenight'];
	    $pricing['twonights'] = $data['twonights'];
	    $pricing['threenights'] = $data['threenights'];
	    $pricing['fournights'] = $data['fournights'];
	    $pricing['fivenights'] = $data['fivenights'];
	    $pricing['sixnights'] = $data['sixnights'];
	    $pricing['sevennights'] = $data['sevennights'];

	    $insert = $this->db->insert('simple_calendar_accommodation_unit_pricing', $pricing);
	    
    }
    
    public function updateunitPrice($data){
	    
	    $pricing = array();
	    $pricing['startDate'] = "$data[startDate_year]-$data[startDate_month]-$data[startDate_day]";
	    $pricing['endDate'] = "$data[endDate_year]-$data[endDate_month]-$data[endDate_day]";
	    $pricing['freeText'] = $data['freeText'];
	    $pricing['minStay'] = $data['minStay'];
	    $pricing['changeOver'] = $data['changeOver'];
        $pricing['strict'] = $data['strict'];
	    $pricing['discount'] = $data['discount'];
	    $pricing['onenight'] = $data['onenight'];
	    $pricing['twonights'] = $data['twonights'];
	    $pricing['threenights'] = $data['threenights'];
	    $pricing['fournights'] = $data['fournights'];
	    $pricing['fivenights'] = $data['fivenights'];
	    $pricing['sixnights'] = $data['sixnights'];
	    $pricing['sevennights'] = $data['sevennights'];

	    $insert = $this->db->update('simple_calendar_accommodation_unit_pricing', $pricing, 'pricingID', $data['pricingID']);
	    
    }
    
    public function getunitPricing($id){
	    
	    $today = date('Y-m-d');
	    $sql = 'SELECT * FROM simple_calendar_accommodation_unit_pricing WHERE unitID="'.$id.'" ORDER BY startDate ASC';
		  $data = $this->db->get_rows($sql);

	    return $data;
	    
    }
    
    public function getunitBySlug($slug){
	    
	    $sql = 'SELECT * FROM simple_calendar_accommodation_units WHERE slug="'.$slug.'"';
		  $data = $this->db->get_row($sql);

	    return $data;
	    
    }
  
   public function getunitPriceRow($id){
	    
	    $sql = 'SELECT * FROM simple_calendar_accommodation_unit_pricing WHERE pricingID="'.$id.'"';
		  $data = $this->db->get_row($sql);
	    return $data;
	    
    }
    
    public function getunitPricingDate($date,$id){
	    
	    $today = date('Y-m-d');
	    $sql = 'SELECT * FROM simple_calendar_accommodation_unit_pricing WHERE unitID="'.$id.'" AND startDate<="'.$date.'" AND endDate>="'.$date.'"';
		  $data = $this->db->get_row($sql);

	    return $data;
	    
    }
    
    
    public function getunitPricing_Public($slug){
	    
	    $sql = 'SELECT * FROM simple_calendar_accommodation_units WHERE slug="'.$slug.'"';
		$data = $this->db->get_rows($sql);
	    
	    $today = date('Y-m-d');
	    $sql = 'SELECT * FROM simple_calendar_accommodation_unit_pricing WHERE unitID="'.$data[0]['unitID'].'" ORDER BY startDate ASC';
		$data = $this->db->get_rows($sql);

	    return $data;
	    
    }
    
    public function unitDeletePricing($id){

	    $unitPricingDelete = $this->db->delete('simple_calendar_accommodation_unit_pricing', 'pricingID', $id);
	    
    }
    
    public function getAddons(){
	    
	    $sql = 'SELECT * FROM simple_calendar_accommodation_addons ORDER BY name ASC';
		$data = $this->db->get_rows($sql);

	    return $data;
	    
    }
    
    public function addonAdd($data){
	    
	    $addon = array();
	    $addon['name'] = $data['name'];
	    $addon['description'] = $data['description'];
	    $addon['price'] = $data['price'];

	    $insert = $this->db->insert('simple_calendar_accommodation_addons', $addon);
	    
    }
    
    public function addon($id){
	    
	    $sql = 'SELECT * FROM simple_calendar_accommodation_addons WHERE addonID='.$id;
		$data = $this->db->get_row($sql);

		return $data;
    }
    
    public function addonDelete($id){

	    $addonDelete = $this->db->delete('simple_calendar_accommodation_addons', 'addonID', $id);
	    
    }
    
    public function addonUpdate($data){
	    
	    $addon = array();
	    $addon['name'] = $data['name'];
	    $addon['description'] = $data['description'];
	    $addon['price'] = $data['price'];

	    $insert = $this->db->update('simple_calendar_accommodation_addons', $addon, 'addonID', $data['addonID']);
	    
    }
    
    public function allAvailableAccommodation($start,$end,$bookingSex){
	    
	    $sql = 'SELECT * FROM simple_calendar_accommodation_units ORDER BY name ASC';
		$data = $this->db->get_rows($sql);
		
		$list = array();
		
		foreach($data as $Accommodation){
			
			$count = $this->db->get_count('SELECT COUNT(*) FROM simple_calendar_accommodation_units WHERE parentID="'.$Accommodation['typeID'].'"');
			if($count==0){
				
				$sqlB = 'SELECT * FROM simple_calendar_accommodation_bookings WHERE 
					(startTime<="'.$start.'" AND endTime>"'.$start.'" AND typeID="'.$Accommodation['typeID'].'") OR 
					(startTime<="'.$end.'" AND endTime>"'.$end.'" AND typeID="'.$Accommodation['typeID'].'") OR 
					(startTime<="'.$start.'" AND endTime>="'.$end.'" AND typeID="'.$Accommodation['typeID'].'") OR 
					(startTime>="'.$start.'" AND endTime<="'.$end.'" AND typeID="'.$Accommodation['typeID'].'") OR 
					(startTime="'.$start.'" AND endTime="'.$end.'" AND typeID="'.$Accommodation['typeID'].'")';  
				$dataB = $this->db->get_count($sqlB);
				
				if($dataB==0){
				
					if($Accommodation['parentID']>0){
						
						//GET ANY BOOKINGS OF THE SAME TYPE
						$sqlC = 'SELECT * FROM simple_calendar_accommodation_bookings WHERE 
							(startTime="'.$start.'" AND endTime="'.$end.'" AND parentID="'.$Accommodation['parentID'].'" AND bookingSex<>"'.$bookingSex.'") OR 
							(startTime<"'.$start.'" AND endTime>"'.$end.'" AND parentID="'.$Accommodation['parentID'].'" AND bookingSex<>"'.$bookingSex.'") OR 
							(startTime<"'.$start.'" AND endTime>"'.$start.'" AND parentID="'.$Accommodation['parentID'].'" AND bookingSex<>"'.$bookingSex.'") OR 
							(startTime<"'.$end.'" AND endTime>"'.$end.'" AND parentID="'.$Accommodation['parentID'].'" AND bookingSex<>"'.$bookingSex.'")';  
						$dataC = $this->db->get_count($sqlC);
						
						if($dataC==0){
						
							$sql = 'SELECT * FROM simple_calendar_accommodation_units WHERE typeID='.$Accommodation['parentID'];
							$parent = $this->db->get_row($sql);
							$list[] = array('name'=>"$parent[name] - $Accommodation[name]", 'typeID'=>$Accommodation['typeID']);
						
						}
					}else{
						$list[] = array('name'=>"$Accommodation[name]", 'typeID'=>$Accommodation['typeID']);	
					}
				
				}
			}
			
		}
		
		sort($list);

	    return $list;
	    
    }
    
    public function isAvailableAccommodation($start,$end,$typeID,$bookingID){
	    
	    $sql = 'SELECT * FROM simple_calendar_accommodation_units WHERE typeID="'.$typeID.'"';
		$data = $this->db->get_rows($sql);
		
		foreach($data as $Accommodation){
				
			$sqlB = 'SELECT * FROM simple_calendar_accommodation_bookings WHERE 
				(startTime<="'.$start.'" AND endTime>"'.$start.'" AND typeID="'.$Accommodation['typeID'].'" AND bookingID<>"'.$bookingID.'") OR 
				(startTime<="'.$end.'" AND endTime>"'.$end.'" AND typeID="'.$Accommodation['typeID'].'" AND bookingID<>"'.$bookingID.'") OR 
				(startTime<="'.$start.'" AND endTime>="'.$end.'" AND typeID="'.$Accommodation['typeID'].'" AND bookingID<>"'.$bookingID.'") OR 
				(startTime>="'.$start.'" AND endTime<="'.$end.'" AND typeID="'.$Accommodation['typeID'].'" AND bookingID<>"'.$bookingID.'") OR 
				(startTime="'.$start.'" AND endTime="'.$end.'" AND typeID="'.$Accommodation['typeID'].'" AND bookingID<>"'.$bookingID.'")';  
			$dataB = $this->db->get_count($sqlB);
			
			if($dataB==0){
				
				return 0;
			
			}else{
				
				return 1;
				
			}

		}
	    
    }
    
    public function bookingAdd($booking){
	    
	    $insert = $this->db->insert('simple_calendar_accommodation_bookings', $booking);
	    
    }
    
    public function getBookings(){
	    
		$sql = 'SELECT * FROM simple_calendar_accommodation_bookings ORDER BY bookingID ASC';  
	   
		$data = $this->db->get_rows($sql);

	    return $data;
	    
    }
    
    public function getBookingsReviews($date){
	    
		$sql = 'SELECT * FROM simple_calendar_accommodation_bookings WHERE endTime="'.$date.' 10:00:00"';  
	   
		$data = $this->db->get_rows($sql);

	    return $data;
	    
    }
    
    public function booking($bookingID){
	    
		$sql = 'SELECT * FROM simple_calendar_accommodation_bookings WHERE bookingID='.$bookingID;  
	   
		$data = $this->db->get_row($sql);

	    return $data;
	    
    }
    
    public function groupBookings($bookingGroup){
	    
		$sql = 'SELECT * FROM simple_calendar_accommodation_bookings WHERE bookingGroup="'.$bookingGroup.'"';  
	   
		$data = $this->db->get_rows($sql);

	    return $data;
	    
    }
    
    public function bookingUpdate($data,$id){

		$update = $this->db->update('simple_calendar_accommodation_bookings', $data, 'bookingID', $id);
	    
    }
    
    public function bookingDelete($id){

	    $bookingDelete = $this->db->delete('simple_calendar_accommodation_bookings', 'bookingID', $id);
	    
    }
    
    public function getEmails(){
	    
	    $sql = 'SELECT * FROM simple_calendar_accommodation_emails ORDER BY subject ASC';
		$data = $this->db->get_rows($sql);

	    return $data;
	    
    }
    
    public function getEmail($id){
	    
	    $sql = 'SELECT * FROM simple_calendar_accommodation_emails WHERE emailID="'.$id.'"';
		$data = $this->db->get_row($sql);

	    return $data;
	    
    }
    
    public function emailAdd($data){
	    
	    $email = array();
	    $email['subject'] = $data['subject'];
	    $email['content'] = $data['content'];
	    
	    $insert = $this->db->insert('simple_calendar_accommodation_emails', $email);
	    
    }
    
    public function emailUpdate($data){
	    
	    $email = array();
	    $email['subject'] = $data['subject'];
	    $email['content'] = $data['content'];
	    $id = $data['emailID'];
	    
	    $insert = $this->db->update('simple_calendar_accommodation_emails', $email, 'emailID', $id);
	    
    }
    
    public function emailDelete($data){
	    
	    $email = array();
	    $id = $data['emailID'];
	    
	    $insert = $this->db->delete('simple_calendar_accommodation_emails', 'emailID', $id);
	    
    }
    
    public function getCustomers(){
	    
	    $sql = 'SELECT * FROM perch3_members ORDER BY memberEmail ASC';
		$data = $this->db->get_rows($sql);

	    return $data;
	    
    }
    
    public function customer($id){
	    
	    $sql = 'SELECT * FROM perch3_members WHERE memberID="'.$id.'"';
		$data = $this->db->get_row($sql);

	    return $data;
	    
    }
	
	public function customerByEmail($email){
		
		$sql = 'SELECT * FROM perch3_members WHERE memberEmail="'.$email.'"';
		$data = $this->db->get_row($sql);
	
		return $data;
		
	}
    
    public function createReview($review){
	    
	    $insert = $this->db->insert('simple_calendar_reviews', $review);
	    
    }
    
    public function getReviewData($reviewcode){
	    
	    $sql = 'SELECT * FROM simple_calendar_reviews WHERE reviewCode="'.$reviewcode.'"';
		$data = $this->db->get_row($sql);

	    return $data;
	    
    }
    
    public function getReview($reviewID){
	    
	    $sql = 'SELECT * FROM simple_calendar_reviews WHERE reviewID="'.$reviewID.'"';
		$data = $this->db->get_row($sql);

	    return $data;
	    
    }
    
     public function getReviews($unitID){
	    
	    $sql = 'SELECT * FROM simple_calendar_reviews WHERE unitID="'.$unitID.'" AND published="yes" ORDER BY timestamp DESC';
		$data = $this->db->get_rows($sql);

	    return $data;
	    
    }
    
    public function logReview($review){
	    
	    $sql = 'UPDATE simple_calendar_reviews SET rating="'.$review['rating'].'", comments="'.$review['comments'].'", timestamp="'.$review['timestamp'].'" WHERE reviewCode="'.$review['reviewCode'].'"';
		$data = $this->db->execute($sql);

	    return $data;
	    
    }
    
    public function getAllReviews(){
	    
	    $sql = 'SELECT * FROM simple_calendar_reviews ORDER BY reviewID DESC';
		$data = $this->db->get_rows($sql);

	    return $data;
	    
    }
    
    public function deleteReview($id){
	    
	    $sql = 'DELETE FROM simple_calendar_reviews WHERE reviewID="'.$id.'"';
		$data = $this->db->execute($sql);
	    
    }
    
    public function updateReview($review){
	    
	    $sql = 'UPDATE simple_calendar_reviews SET rating="'.$review['rating'].'", comments="'.$review['comments'].'", published="'.$review['published'].'" WHERE reviewID="'.$review['reviewID'].'"';
		$data = $this->db->execute($sql);
	    
    }
    
    public function getNights($arrival,$departure){
		
		$diff = strtotime($departure) - strtotime($arrival);
		
		return $diff/86400;
		
    }
    
    public function getConflicts($arrival,$departure,$unitID){
	  
	    $sql = 'SELECT * FROM simple_calendar_accommodation_bookings WHERE 
				(startTime<="'.$arrival.'" AND endTime>"'.$arrival.'" AND unitID="'.$unitID.'") OR 
				(startTime<="'.$departure.'" AND endTime>"'.$departure.'" AND unitID="'.$unitID.'") OR 
				(startTime<="'.$arrival.'" AND endTime>="'.$departure.'" AND unitID="'.$unitID.'") OR 
				(startTime>="'.$arrival.'" AND endTime<="'.$departure.'" AND unitID="'.$unitID.'") OR 
				(startTime="'.$arrival.'" AND endTime="'.$departure.'" AND unitID="'.$unitID.'")';  
		// $sql = 'SELECT COUNT(*) FROM simple_calendar_accommodation_bookings
		// WHERE unitID = "' . $unitID . '"
		//   AND DATE(startTime) <  "' . $departure . '"
		//   AND DATE(endTime)   >  "' . $arrival   . '"';
		$conflicts = $this->db->get_count($sql);
		
		return $conflicts;
		
		// Use DATE() to strip the time component from stored datetime values,
		// allowing clean comparison against plain Y-m-d arrival/departure strings.
		// Logic: overlap exists when booking starts before our departure
		// AND ends after our arrival. Same-day changeover (endTime = arrival
		// or startTime = departure) is NOT a conflict.
		
		// $sql = 'SELECT COUNT(*) FROM simple_calendar_accommodation_bookings
		// 		WHERE unitID = "' . $unitID . '"
		// 		  AND DATE(startTime) <  "' . $departure . '"
		// 		  AND DATE(endTime)   >  "' . $arrival   . '"';
		// 
		// return $this->db->get_count($sql);
		
    }
    
    public function getConflictsB($arrival,$departure,$unitID,$bookingID){
	  
	    $sqlB = 'SELECT * FROM simple_calendar_accommodation_bookings WHERE 
				(startTime<="'.$arrival.'" AND endTime>"'.$arrival.'" AND unitID="'.$unitID.'") AND bookingID<>"'.$bookingID.'" OR 
				(startTime<="'.$departure.'" AND endTime>"'.$departure.'" AND unitID="'.$unitID.'") AND bookingID<>"'.$bookingID.'"  OR 
				(startTime<="'.$arrival.'" AND endTime>="'.$departure.'" AND unitID="'.$unitID.'") AND bookingID<>"'.$bookingID.'"  OR 
				(startTime>="'.$arrival.'" AND endTime<="'.$departure.'" AND unitID="'.$unitID.'") AND bookingID<>"'.$bookingID.'"  OR 
				(startTime="'.$arrival.'" AND endTime="'.$departure.'" AND unitID="'.$unitID.'") AND bookingID<>"'.$bookingID.'"';  
		$conflicts = $this->db->get_count($sqlB);
		
		return $conflicts;
		
    }
    
    public function bookingCheck($unit,$date){
	    
	    $sql = 'SELECT * FROM simple_calendar_accommodation_bookings WHERE unitID="'.$unit.'" AND startTime<="'.$date.' 23:59:00" AND endTime>="'.$date.' 12:00:00"';  
		$rows = $this->db->get_count($sql);
		
		return $rows;
	    
    }
  
  public function isArrival($slug,$date){
    
    $sql = 'SELECT * FROM simple_calendar_accommodation_units WHERE slug="'.$slug.'"';
		$data = $this->db->get_rows($sql);

	$sql = 'SELECT * FROM simple_calendar_accommodation_unit_pricing WHERE startDate<="'.$date.'" AND endDate>="'.$date.'" AND unitID="'.$data[0]['unitID'].'" ORDER BY startDate ASC';
		$data = $this->db->get_rows($sql);
    
    $today = date('Y-m-d', strtotime('+2 days'));
    
    $dates = explode("-",$date);
    $day = date("D", mktime(0, 0, 0, $dates[1], $dates[2], $dates[0]));

    $sql = 'SELECT * FROM simple_calendar_accommodation_bookings WHERE unitID="'.$data[0]['unitID'].'" AND startTime>="'.$date.'" ORDER BY startTime ASC LIMIT 1';
	$bookingData = $this->db->get_rows($sql);
    $arrDates = explode(" ",$bookingData[0]['startTime']);
    $nextArrival = $arrDates[0];
    $nights = 0 - ((strtotime($date) - strtotime($nextArrival)) / 86400);
    $nights++;
    
    if($nights<0){
      $nights = 14;
    }

	if($data[0]['changeOver']=='Any Day' AND $date>$today AND $nights>$data[0]['minStay']){
      return 1;
    }elseif($data[0]['changeOver']=='Fri - Fri' AND $day=='Fri' AND $date>$today AND $nights>$data[0]['minStay']){
	  return 1;
	}elseif($data[0]['changeOver']=='Sat - Sat' AND $day=='Sat' AND $date>$today AND $nights>$data[0]['minStay']){
      return 1;
    }elseif($data[0]['changeOver']=='Sun - Sun' AND $day=='Sun' AND $date>$today AND $nights>$data[0]['minStay']){
	  return 1;
	}elseif($data[0]['changeOver']=='Mon - Mon' AND $day=='Mon' AND $date>$today AND $nights>$data[0]['minStay']){
	  return 1;
	}elseif($data[0]['changeOver']=='Tue - Tue' AND $day=='Tue' AND $date>$today AND $nights>$data[0]['minStay']){
	  return 1;
	}elseif($data[0]['changeOver']=='Wed - Wed' AND $day=='Wed' AND $date>$today AND $nights>$data[0]['minStay']){
	  return 1;
	}elseif($data[0]['changeOver']=='Thu - Thu' AND $day=='Thu' AND $date>$today AND $nights>$data[0]['minStay']){
	  return 1;
	}elseif($data[0]['changeOver']=='Fri/Mon' AND ($day=='Fri' OR $day=='Mon') AND $date>$today AND $nights>$data[0]['minStay']){
      return 1;
    }elseif($data[0]['changeOver']=='Sat/Tue' AND ($day=='Sat' OR $day=='Tue') AND $date>$today AND $nights>$data[0]['minStay']){
      return 1;
    }
    
  }
  
  public function getMaxNights($unit,$date){

    $sql = 'SELECT * FROM simple_calendar_accommodation_units WHERE slug="'.$unit.'"';
		$data = $this->db->get_rows($sql);
    
    $sql = 'SELECT * FROM simple_calendar_accommodation_bookings WHERE unitID="'.$data[0]['unitID'].'" AND startTime>="'.$date.'" ORDER BY startTime ASC LIMIT 1';
		$bookingData = $this->db->get_rows($sql);
    $arrDates = explode(" ",$bookingData[0]['startTime']);
    $nextArrival = $arrDates[0];
    $nights = 0 - ((strtotime($date) - strtotime($nextArrival)) / 86400);
    if($nights<0){
      $nights = 14;
    }
    
    return $nights;
    
  }
  
  public function getMinNights($unit,$date){

    $sql = 'SELECT * FROM simple_calendar_accommodation_units WHERE slug="'.$unit.'"';
		$data = $this->db->get_rows($sql);
    
    $sql = 'SELECT * FROM simple_calendar_accommodation_unit_pricing WHERE startDate<="'.$date.'" AND endDate>="'.$date.'" AND unitID="'.$data[0]['unitID'].'" ORDER BY startDate ASC';
		$data = $this->db->get_rows($sql);
    
    $nights = $data[0]['minStay'];
    
    return $nights;
    
  }
  
  public function getMaxOccupants($unit){

    $sql = 'SELECT * FROM simple_calendar_accommodation_units WHERE slug="'.$unit.'"';
		$data = $this->db->get_rows($sql);
    
    return $data[0]['maxOccupants'];
    
  }
  
  public function makeBooking($startTime,$endTime,$unitID,$customerID,$cost,$paid,$notes,$addons){
      $booking = array();
	  $booking['startTime'] = $startTime;
      $booking['endTime'] = $endTime;
      $booking['unitID'] = $unitID;
      $booking['customerID'] = $customerID;
      $booking['cost'] = $cost;
      $booking['paid'] = $paid;
      $booking['notes'] = $notes;
	  $booking['addons'] = $addons;
	    
	    $insert = $this->db->insert('simple_calendar_accommodation_bookings', $booking);
  }
  
  public function makeBooking_Pending($startTime,$endTime,$unitID,$customerID,$cost,$paid,$notes,$pet){

		$booking = array();
		$booking['startTime'] = $startTime;
		$booking['endTime'] = $endTime;
		$booking['unitID'] = $unitID;
		$booking['customerID'] = $customerID;
		$booking['cost'] = $cost;
		$booking['paid'] = $paid;
		$booking['notes'] = $notes;
		if($pet>0){
			$booking['addons'] = '{"addon_12":"'.$pet.'","addon_12_price":"25.00"}';
		}
		  
		  $insert = $this->db->insert('simple_calendar_accommodation_bookings_pending', $booking);
	}
  
  public function cancelBooking($bookingID){
	  if($bookingID>0){
	    $sql = 'DELETE FROM simple_calendar_accommodation_bookings WHERE bookingID='.$bookingID;
	    $data = $this->db->execute($sql);
  	  }
  }
  
  public function recordPayment($bookingID, $payment){
	  $sql = 'UPDATE simple_calendar_accommodation_bookings SET paid="'.$payment.'" WHERE bookingID='.$bookingID;
	  $data = $this->db->execute($sql);
  }
  
  public function recordBalancePayment($bookingID, $payment){
		$sql = 'UPDATE simple_calendar_accommodation_bookings SET paid = paid + "'.$payment.'" WHERE bookingID='.$bookingID;
		$data = $this->db->execute($sql);
	}
  
  public function getLastBooking(){
    $sql = 'SELECT * FROM simple_calendar_accommodation_bookings ORDER BY bookingID DESC LIMIT 1';
	$data = $this->db->get_row($sql);

	return $data;
  }
  
  public function getLastBooking_Pending(){
	  $sql = 'SELECT * FROM simple_calendar_accommodation_bookings_pending ORDER BY bookingID DESC LIMIT 1';
	  $data = $this->db->get_row($sql);
  
	  return $data;
	}
	
	public function getBooking_Pending($id){
	  $sql = 'SELECT * FROM simple_calendar_accommodation_bookings_pending WHERE bookingID='.$id;
	  $data = $this->db->get_row($sql);
	
	  return $data;
	}
  
  public function member_future_bookings($id){
	  $date = date('Y-m-d');
	  $sql = 'SELECT * FROM simple_calendar_accommodation_bookings WHERE customerID="'.$id.'" AND startTime>="'.$date.'" ORDER BY startTime ASC';
	  $data = $this->db->get_rows($sql);

	  return $data;
  }
  
  public function member_past_bookings($id){
	  $date = date('Y-m-d');
	  $sql = 'SELECT * FROM simple_calendar_accommodation_bookings WHERE customerID="'.$id.'" AND startTime<="'.$date.'" ORDER BY startTime DESC';
	  $data = $this->db->get_rows($sql);

	  return $data;
  }
  
  public function latest_booking($id){
	  $sql = 'SELECT * FROM simple_calendar_accommodation_bookings WHERE customerID="'.$id.'" ORDER BY bookingID DESC LIMIT 1';
	  $data = $this->db->get_row($sql);
	  
	  return $data;
  }
  
  public function owner_bookings($email, $time){

	  if($time == 'future'){
		$date = date('Y-m-d');
	    $sql = "SELECT b.*
		FROM simple_calendar_accommodation_bookings b
		INNER JOIN simple_calendar_accommodation_units u ON b.unitID = u.unitID
		WHERE u.ownerEmail = '".$email."'
		AND b.startTime>='".$date."'
		ORDER BY b.startTime ASC;";
	    $data = $this->db->get_rows($sql);
	  }else{
		$date = date('Y-m-d');
		$sql = "SELECT b.*
		FROM simple_calendar_accommodation_bookings b
		INNER JOIN simple_calendar_accommodation_units u ON b.unitID = u.unitID
		WHERE u.ownerEmail = '".$email."'
		AND b.startTime<='".$date."'
		ORDER BY b.startTime DESC;";
		$data = $this->db->get_rows($sql);
	  }
	  return $data;
	  
  }
  
  public function cleaner_bookings($email, $time){
		
		if($time == 'future'){
		  $date = date('Y-m-d');
		  $sql = "SELECT b.*
		  FROM simple_calendar_accommodation_bookings b
		  INNER JOIN simple_calendar_accommodation_units u ON b.unitID = u.unitID
		  WHERE u.cleanerEmail = '".$email."'
		  AND b.startTime>='".$date."'
		  ORDER BY b.startTime ASC LIMIT 20;";
		  $data = $this->db->get_rows($sql);
		}else{
		  $date = date('Y-m-d');
		  $sql = "SELECT b.*
		  FROM simple_calendar_accommodation_bookings b
		  INNER JOIN simple_calendar_accommodation_units u ON b.unitID = u.unitID
		  WHERE u.cleanerEmail = '".$email."'
		  AND b.startTime<='".$date."'
		  ORDER BY b.startTime DESC;";
		  $data = $this->db->get_rows($sql);
		}
		
		return $data;
		
	}
	
	/**
	 * Given a list of cottage slugs, return only those available
	 * for the requested arrival date and number of nights.
	 *
	 * Checks three things per cottage:
	 *  1. Booking conflicts (reuses existing getConflicts logic)
	 *  2. Minimum stay requirement for the arrival date's pricing period
	 *  3. Valid changeover day for the arrival date's pricing period
	 *
	 * @param array  $slugs    Cottage slugs from the Perch collection
	 * @param string $arrival  Arrival date in Y-m-d format
	 * @param int    $nights   Number of nights requested
	 * @return array           Slugs of cottages that pass all checks
	 */
	
	public function getAvailableSlugs(array $slugs, string $arrival, int $nights): array {
	
		$today     = date('Y-m-d');
		$departure = date('Y-m-d', strtotime($arrival . ' +' . $nights . ' days'));
		$arrDay    = date('D', strtotime($arrival));
	
		if ($arrival <= $today) {
			return [];
		}
	
		$available = [];
	
		foreach ($slugs as $slug) {

			$unit = $this->unitSlug($slug);
			if (!$unit) {
				continue;
			}
			$unitID = $unit['unitID'];
	
			// --- Check 1: No booking conflicts ---
			if ($this->getConflicts($arrival, $departure, $unitID) > 0) {
				continue;
			}
	
			// Short breaks (under a full week) are exempt from the
			// minStay / changeover-day rules below. Those rules exist to
			// govern full-week bookings only, so a 2-night stay should
			// never be blocked by a minStay of 7.
			if ($nights < 7) {
				$available[] = $slug;
				continue;
			}
	
			// --- Check 2 & 3: Pricing period rules (minStay + changeOver) ---
			// NOTE: this query is vulnerable to SQL injection via $unitID/$arrival
			// if either can come from user input. If your $this->db wrapper
			// supports prepared statements (e.g. $wpdb->prepare), use that here.
			$sql = 'SELECT * FROM simple_calendar_accommodation_unit_pricing
					WHERE unitID   = "' . $unitID . '"
					  AND startDate <= "' . $arrival . '"
					  AND endDate   >= "' . $arrival . '"
					ORDER BY startDate ASC
					LIMIT 1';
			$pricing = $this->db->get_row($sql);
	
			if ($pricing) {
	
				$minStay    = (int) $pricing['minStay'];
				$changeOver = $pricing['changeOver'];
				$validArrival = false;
				
				if($slug=='fernleigh-robin-hoods-bay'){
					echo $changeOver;
				}
	
				switch ($changeOver) {
	
					case 'Any Day':
						$validArrival = ($nights >= $minStay);
						break;
	
					case 'Fri - Fri':
						$validArrival = ($arrDay === 'Fri' && $nights >= $minStay && $nights % 7 === 0);
						break;
	
					case 'Sat - Sat':
						$validArrival = ($arrDay === 'Sat' && $nights >= $minStay && $nights % 7 === 0);
						break;
	
					case 'Sun - Sun':
						$validArrival = ($arrDay === 'Sun' && $nights >= $minStay && $nights % 7 === 0);
						break;
	
					case 'Mon - Mon':
						$validArrival = ($arrDay === 'Mon' && $nights >= $minStay && $nights % 7 === 0);
						break;
	
					case 'Tue - Tue':
						$validArrival = ($arrDay === 'Tue' && $nights >= $minStay && $nights % 7 === 0);
						break;
	
					case 'Wed - Wed':
						$validArrival = ($arrDay === 'Wed' && $nights >= $minStay && $nights % 7 === 0);
						break;
	
					case 'Thu - Thu':
						$validArrival = ($arrDay === 'Thu' && $nights >= $minStay && $nights % 7 === 0);
						break;
	
					case 'Fri/Mon':
						// Short-break clauses removed: nights < 7 already
						// returned above, so only full-week multiples remain.
						$validArrival = ($arrDay === 'Fri' && $nights % 7 === 0)
									 || ($arrDay === 'Mon' && $nights % 7 === 0);
						break;
	
					case 'Sat/Tue':
						$validArrival = ($arrDay === 'Sat' && $nights % 7 === 0)
									 || ($arrDay === 'Tue' && $nights % 7 === 0);
						break;
	
					default:
						$validArrival = true;
						break;
				}
	
				if (!$validArrival) {
					continue;
				}
			}
	
			$available[] = $slug;
		}
	
		return $available;
	}
	
	function get_cottage_bookings($cottage){
		
		$sql = 'SELECT * FROM simple_calendar_accommodation_units WHERE slug="'.$cottage.'"';
		$unitData = $this->db->get_row($sql);
		
		$sql = 'SELECT startTime, endTime
		 FROM simple_calendar_accommodation_bookings
		 WHERE unitID = '.$unitData['unitID'].'
		 AND endTime >= NOW()
		 ORDER BY startTime ASC';
		 
		$rows = $this->db->get_rows($sql);
		
		// Map to the format the iCal builder expects
		$bookings = [];
		if (is_array($rows)) {
			foreach ($rows as $row) {
				$bookings[] = [
					'start' => date('Y-m-d', strtotime($row['startTime'])),
					'end'   => date('Y-m-d', strtotime($row['endTime'])),
					'label' => 'Booked',
				];
			}
		}
		
		return $bookings;	
		
	}
    
}
