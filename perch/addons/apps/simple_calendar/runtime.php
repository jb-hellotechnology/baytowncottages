<?php
    /*
        tdis file includes tde code called by tde site pages at runtime.
        If you app is admin-only tden don't include tdis file.
        
        Remember - try and be as lightweight at runtime as possble. Include only 
        what you need to, run only 100% necessary code. Make every database query
        count.
    */


	// ini_set('display_errors', 1);
	// ini_set('display_startup_errors', 1);
	// error_reporting(E_ALL);


    # Include your class files as needed - up to you.
    include('Simple_Calendars.class.php');
    include('Simple_Calendar.class.php');

	function simple_calendar_unit_pricing($slug){
		
		$API = new Simple_Calendars($API);
		$SimpleCalendar = new Simple_Calendars($API);
		
		$unitData = $SimpleCalendar->unitbySlug($slug,'');
		
		echo '<table class="d">
					<tr>
						<td colspan="5">Date Period</td>
						<td colspan="7">Price/Nights</td>
					</tr>
		            <tr>
		                <td class="first">Start Date</td>  
		                <td>End Date</td>
		                <td></td>
		                <td>Min. Stay</td>
		                <td>Changeover</td>
		                <td>1 Night</td> 
		                <td>2 Nights</td> 
		                <td>3 Nights</td> 
		                <td>4 Nights</td> 
		                <td>5 Nights</td> 
		                <td>6 Nights</td>  
		                <td>7 Nights</td>
		            </tr>';
	
		$unitPricing = $SimpleCalendar->getunitPricing_Public($slug);
		foreach($unitPricing as $price){
	
			$sDates = explode("-",$price['startDate']);
			$start = "$sDates[2]/$sDates[1]/$sDates[0]";
			
			$eDates = explode("-",$price['endDate']);
			$end = "$eDates[2]/$eDates[1]/$eDates[0]";
	
			echo "<tr>
					<td>$start</td>
					<td>$end</td>
					<td>$price[freeText]</td>
					<td>$price[minStay]</td>
					<td>$price[changeOver]</td>
					<td>"; if($price['onenight']=='0.00'){echo "-";}else{echo $price['onenight'];} echo "</td>
					<td>"; if($price['twonights']=='0.00'){echo "-";}else{echo $price['twonights'];} echo "</td>
					<td>"; if($price['threenights']=='0.00'){echo "-";}else{echo $price['threenights'];} echo "</td>
					<td>"; if($price['fournights']=='0.00'){echo "-";}else{echo $price['fournights'];} echo "</td>
					<td>"; if($price['fivenights']=='0.00'){echo "-";}else{echo $price['fivenights'];} echo "</td>
					<td>"; if($price['sixnights']=='0.00'){echo "-";}else{echo $price['sixnights'];} echo "</td>
					<td>"; if($price['sevennights']=='0.00'){echo "-";}else{echo $price['sevennights'];} echo "</td>
				</tr>";
			
		}
	
		echo '
			</table>';

/*
		if($unitData['minDiscount']>0){
			
			$discount = (100-$unitData['discountPercentage'])/100;
			
			echo "<h2>Discounted (-$unitData[discountPercentage]%) Pricing for Groups of $unitData[minDiscount] People or Fewer</h2>";
			
			echo '<table class="d">
					<tr>
						<td colspan="5">Date Period</td>
						<td colspan="7">Price/Nights</td>
					</tr>
		            <tr>
		                <td class="first">Start Date</td>  
		                <td>End Date</td>
		                <td></td>
		                <td>Min. Stay</td>
		                <td>Changeover</td>
		                <td>1 Night</td> 
		                <td>2 Nights</td> 
		                <td>3 Nights</td> 
		                <td>4 Nights</td> 
		                <td>5 Nights</td> 
		                <td>6 Nights</td>  
		                <td>7 Nights</td>
		            </tr>';
	
			$unitPricing = $SimpleCalendar->getunitPricing_Public($slug);
			foreach($unitPricing as $price){
		
				$sDates = explode("-",$price['startDate']);
				$start = "$sDates[2]/$sDates[1]/$sDates[0]";
				
				$eDates = explode("-",$price['endDate']);
				$end = "$eDates[2]/$eDates[1]/$eDates[0]";
				
				if($price['discount']=='on'){

					echo "<tr>
							<td>$start</td>
							<td>$end</td>
							<td>$price[freeText]</td>
							<td>$price[minStay]</td>
							<td>$price[changeOver]</td>
							<td>"; if($price['onenight']=='0.00'){echo "-";}else{echo number_format(floor($price['onenight'])*$discount,2);} echo "</td>
							<td>"; if($price['twonights']=='0.00'){echo "-";}else{echo number_format(floor($price['twonights'])*$discount,2);} echo "</td>
							<td>"; if($price['threenights']=='0.00'){echo "-";}else{echo number_format(floor($price['threenights'])*$discount,2);} echo "</td>
							<td>"; if($price['fournights']=='0.00'){echo "-";}else{echo number_format(floor($price['fournights'])*$discount,2);} echo "</td>
							<td>"; if($price['fivenights']=='0.00'){echo "-";}else{echo number_format(floor($price['fivenights'])*$discount,2);} echo "</td>
							<td>"; if($price['sixnights']=='0.00'){echo "-";}else{echo number_format(floor($price['sixnights'])*$discount,2);} echo "</td>
							<td>"; if($price['sevennights']=='0.00'){echo "-";}else{echo number_format(floor($price['sevennights'])*$discount,2);} echo "</td>
						</tr>";
						
				}else{
					
					echo "<tr>
							<td>$start</td>
							<td>$end</td>
							<td>$price[freeText]</td>
							<td>$price[minStay]</td>
							<td>$price[changeOver]</td>
							<td>"; if($price['onenight']=='0.00'){echo "-";}else{echo number_format(floor($price['onenight']),2);} echo "</td>
							<td>"; if($price['twonights']=='0.00'){echo "-";}else{echo number_format(floor($price['twonights']),2);} echo "</td>
							<td>"; if($price['threenights']=='0.00'){echo "-";}else{echo number_format(floor($price['threenights']),2);} echo "</td>
							<td>"; if($price['fournights']=='0.00'){echo "-";}else{echo number_format(floor($price['fournights']),2);} echo "</td>
							<td>"; if($price['fivenights']=='0.00'){echo "-";}else{echo number_format(floor($price['fivenights']),2);} echo "</td>
							<td>"; if($price['sixnights']=='0.00'){echo "-";}else{echo number_format(floor($price['sixnights']),2);} echo "</td>
							<td>"; if($price['sevennights']=='0.00'){echo "-";}else{echo number_format(floor($price['sevennights']),2);} echo "</td>
						</tr>";
						
				}
				
			}
		
			echo '
				</table>';
			
		}
*/
		
	}

  function getPricing($unit,$arrival){
    $API = new Simple_Calendars($API);
		$SimpleCalendar = new Simple_Calendars($API);
    $unitData = $SimpleCalendar->unitbySlug($unit,'');
    $dateData = $SimpleCalendar->getUnitPricingDate($arrival,$unitData['unitID']);
    return $dateData;
  }
	
	function simple_calendar_monthly_calendar($unit,$year,$month){
		
		$API = new Simple_Calendars($API);
		$SimpleCalendar = new Simple_Calendars($API);
		
		if($year == ''){
			$year = date('Y');
		}
		
		if($month == ''){
			$month = date('n');
		}
		
		$lastMonth = $month-1;
		$nextMonth = $month+1;
		
		if($month == 1){
			$lastYear = $year-1;
			$lastMonth = 12;
			$nextYear = $year;
		}elseif($month == 12){
			$nextYear = $year+1;
			$nextMonth = 1;
		}else{
			$lastYear = $year;
			$nextYear = $year;
		}
		
		$tabs = "\n\t\t\t\t";
	    $w_days = array("S","S","M","T","W","T","F");
	    $stamp = mktime(0,0,0,$month,2,$year);
	    $maxday = date("t",$stamp);
	    $thismonth = getdate($stamp);
	    $startday = $thismonth['wday'];    
		$thisYear = $lastYear+1;
		
		echo "<table class='cal-table'>
		        <tr class='cal-month'>
		            <td colspan='7'>
		            	<a class='last' href='javascript:month(\"$lastYear\",\"$lastMonth\",\"$unit\");'><i class='fa fa-arrow-left' aria-hidden='true'></i>
						</a>"; 
						echo date("F",$stamp); echo " $year"; 
						echo "<a class='next' href='javascript:month(\"$nextYear\",\"$nextMonth\",\"$unit\");'><i class='fa fa-arrow-right' aria-hidden='true'></i>
						</a>
					</td>
		        </tr>
		        <tr class='cal-days'>";
		            foreach($w_days as $d) { echo "$tabs\t\t<td>$d</td>"; }
		    echo "</tr>";
				
				$curr_month = (date("F Y")==date("F Y",$stamp))? TRUE : FALSE; // if this calendar is displaying current month
			    $today = date("j"); 
			    for ($i=0; $i<($maxday+$startday); $i++) {
			        if(($i % 7) == 0 ) echo "$tabs\t<tr class='cal-date'>";
			        
			        $day = $i - $startday + 1;
			        $curDate = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));
              $curDate2 = date("m-d", mktime(0, 0, 0, $month, $day, $year));
			        $thisDay = date("D", mktime(0, 0, 0, $month, $day, $year));
			        
			        $gapDate = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d')+2, date('Y')));
			        
			        $unitData = $SimpleCalendar->unitSlug($unit);
					$rows = $SimpleCalendar->bookingCheck($unitData['unitID'],$curDate);
					
					if($rows>0){
						$date_class = " class='un'";
						
						if($i < $startday) echo "$tabs\t\t<td></td>";
				        else echo "$tabs\t\t<td{$date_class}>". ($i - $startday + 1) . "</td>";
				        if(($i % 7) == 6 ) echo "$tabs\t</tr>\n";
						
					}else{
            
            $date_class = " class='av'";

            if($i < $startday){
              echo "$tabs\t\t<td></td>";
            }else{

              $isArrival = $SimpleCalendar->isArrival($unit,$curDate);

              if($isArrival==1 AND ($curDate2<>'12-24' AND $curDate2<>'12-25' AND $curDate2<>'12-26' AND $curDate2<>'12-31' AND $curDate2<>'01-01') AND $curDate>$gapDate){
                $date_class = " class='ar'";
                echo "$tabs\t\t
                <td{$date_class}>
                  <form method=\"post\" action=\"/booking?s=$unitData[slug]\">
                  <input type=\"hidden\" name=\"arrivalDate\" value=\"$curDate\" />
                  <input type=\"hidden\" name=\"unit\" value=\"$unit\" />
                  <input type=\"submit\" value=\"". ($i - $startday + 1) . "\" />
                  </form>
                </td>";
              }else{
                echo "$tabs\t\t<td{$date_class}>". ($i - $startday + 1) . "</td>";
              }

            }
            if(($i % 7) == 6 ){
              echo "$tabs\t</tr>\n";
            }
				        
					}
					
				}
				
			echo "$tabs</table>";
		
		echo "<table class='key'>
				<tr><td colspan='6'>Key</td></tr>
				<tr><td class='un'>1</td><td>Booked</td><td class='av'>1</td><td>Available</td><td class='ar'>1</td><td>Arrival</td></tr>
			</table>";
			
		echo '<script type="text/javascript">
			function month(year,month,unit){
				$(".monthly-calendar").append("<div class=\"loading\"><p>Loading...</p></div>");
				$( ".monthly-calendar" ).load( \'/perch/templates/simple_calendar/monthly-calendar.php?unit=\'+unit+\'&year=\'+year+\'&month=\'+month );	
			}
		</script>';	
		
	}

	function simple_calendar_monthly_calendar_all($unit,$year,$month){
		
		$API = new Simple_Calendars($API);
		$SimpleCalendar = new Simple_Calendars($API);
		
		if($year == ''){
			$year = date('Y');
		}
		
		if($month == ''){
			$month = date('n');
		}
		
		$lastMonth = $month-1;
		$nextMonth = $month+1;
		
		if($month == 1){
			$lastYear = $year-1;
			$lastMonth = 12;
			$nextYear = $year;
		}elseif($month == 12){
			$nextYear = $year+1;
			$nextMonth = 1;
		}else{
			$lastYear = $year;
			$nextYear = $year;
		}
		
		$tabs = "\n\t\t\t\t";
	    $w_days = array("S","S","M","T","W","T","F");
	    $stamp = mktime(0,0,0,$month,2,$year);
	    $maxday = date("t",$stamp);
	    $thismonth = getdate($stamp);
	    $startday = $thismonth['wday'];    
		$thisYear = $lastYear+1;
		
		$name = ucwords(str_replace("-"," ",$unit));
		
		$unitData = getunitBySlug($unit);
    
		echo "<table class='cal-table'>
            <tr>
              <td colspan='7' class='larger'><a href=\"/our-cottages/property?s=$unit\">$name</a></td>
            </tr>
		        <tr class='cal-month'>
		            <td colspan='7'>
		            	<a class='last' href='javascript:month(\"$lastYear\",\"$lastMonth\");'><i class='fa fa-arrow-left' aria-hidden='true'></i>
						</a>"; 
						echo date("F",$stamp); echo " $year"; 
						echo "<a class='next' href='javascript:month(\"$nextYear\",\"$nextMonth\");'><i class='fa fa-arrow-right' aria-hidden='true'></i>
						</a>
					</td>
		        </tr>
		        <tr class='cal-days'>";
		            foreach($w_days as $d) { echo "$tabs\t\t<td>$d</td>"; }
		    echo "</tr>";
				
				$curr_month = (date("F Y")==date("F Y",$stamp))? TRUE : FALSE; // if this calendar is displaying current month
			    $today = date("j"); 
			    for ($i=0; $i<($maxday+$startday); $i++) {
			        if(($i % 7) == 0 ) echo "$tabs\t<tr class='cal-date'>";
			        
			        $day = $i - $startday + 1;
			        $curDate = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));
					$curDate2 = date("m-d", mktime(0, 0, 0, $month, $day, $year));
			        $thisDay = date("D", mktime(0, 0, 0, $month, $day, $year));
			        
			        $gapDate = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d')+2, date('Y')));
					
					$rows = $SimpleCalendar->bookingCheck($unitData['unitID'],$curDate);
					
					if($rows>0){
						$date_class = " class='un'";
						
						if($i < $startday) echo "$tabs\t\t<td></td>";
				        else echo "$tabs\t\t<td{$date_class}>". ($i - $startday + 1) . "</td>";
				        if(($i % 7) == 6 ) echo "$tabs\t</tr>\n";
						
					}else{
            
            $date_class = " class='av'";

            if($i < $startday){
              echo "$tabs\t\t<td></td>";
            }else{

              //$isArrival = $SimpleCalendar->isArrival($unit,$curDate);

              if($isArrival==1 AND ($curDate2<>'12-24' AND $curDate2<>'12-25' AND $curDate2<>'12-26' AND $curDate2<>'12-31' AND $curDate2<>'01-01') AND $curDate>$gapDate){
                $date_class = " class='ar'";
                echo "$tabs\t\t
                <td{$date_class}>
                  <form method=\"post\" action=\"/booking\">
                  <input type=\"hidden\" name=\"arrivalDate\" value=\"$curDate\" />
                  <input type=\"hidden\" name=\"unit\" value=\"$unit\" />
                  <input type=\"submit\" value=\"". ($i - $startday + 1) . "\" />
                  </form>
                </td>";
              }else{
                echo "$tabs\t\t<td{$date_class}>". ($i - $startday + 1) . "</td>";
              }

            }
            if(($i % 7) == 6 ){
              echo "$tabs\t</tr>\n";
            }
				        
					}
					
				}
				
			echo "$tabs<tr><td colspan='7'>Sleeps $unitData[maxOccupants]"; if($unitData['maxPets']>0){ echo " &bull; Pet Friendly";} echo "</td></table>";
			
		echo '<script type="text/javascript">
			function month(year,month){
				$(".monthly-calendar").append("<div class=\"loading\"><p>Loading...</p></div>");
				$( ".monthly-calendar-all" ).load( \'/perch/templates/simple_calendar/monthly-calendar-all.php?year=\'+year+\'&month=\'+month);
			}
		</script>';	
		
	}
	
	function simple_calendar_yearly_calendar($unit,$year){
		
		$API = new Simple_Calendars($API);
		$SimpleCalendar = new Simple_Calendars($API);
		
		if($year == ''){
			$year = date('Y');
		}
		
		$lastYear = $year-1;
		$nextYear = $year+1;
			
		$month = 1;
		
		echo '<ul class="control">
				<li><a href="javascript:year('.$lastYear.',\''.$unit.'\');"><i class="fa fa-arrow-left" aria-hidden="true"></i></a></li>
				<li>'.$year.'</li>
				<li><a href="javascript:year('.$nextYear.',\''.$unit.'\');"><i class="fa fa-arrow-right" aria-hidden="true"></i></a></li>
			</ul>';
		
		while($month<=12){
			
			$tabs = "\n\t\t\t\t";
		    $w_days = array("S","S","M","T","W","T","F");
		    $stamp = mktime(0,0,0,$month,2,$year);
		    $maxday = date("t",$stamp);
		    $thismonth = getdate($stamp);
		    $startday = $thismonth['wday']; 
			
			echo "
			    <table class='cal-table'>
			        <tr class='cal-month'>
			            <td colspan='7'>";
							echo date("F",$stamp); echo " $year"; 
					echo "</td>
			        </tr>
			        <tr class='cal-days'>";
			            foreach($w_days as $d) { echo "$tabs\t\t<td>$d</td>"; }
			    echo "</tr>";
					
					$curr_month = (date("F Y")==date("F Y",$stamp))? TRUE : FALSE; // if this calendar is displaying current month
				    $today = date("j"); 
				    for ($i=0; $i<($maxday+$startday); $i++) {
				        if(($i % 7) == 0 ) echo "$tabs\t<tr class='cal-date'>";
				        
				        $day = $i - $startday + 1;
				        $curDate = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));
				        $thisDay = date("D", mktime(0, 0, 0, $month, $day, $year));
				        
				        $unitData = $SimpleCalendar->unitSlug($unit);
						$rows = $SimpleCalendar->bookingCheck($unitData['unitID'],$curDate);
						
						if($rows>0){
							$date_class = " class='un'";
							
							if($i < $startday) echo "$tabs\t\t<td></td>";
					        else echo "$tabs\t\t<td{$date_class}>". ($i - $startday + 1) . "</td>";
					        if(($i % 7) == 6 ) echo "$tabs\t</tr>\n";
							
						}else{
							$date_class = " class='av'";
							
							if($i < $startday) echo "$tabs\t\t<td></td>";
					        else echo "$tabs\t\t<td{$date_class}>". ($i - $startday + 1) . "</td>";
					        if(($i % 7) == 6 ) echo "$tabs\t</tr>\n";
					        
						}
						
					}
					
				echo "$tabs</table>";
		
			$month++;
		}
		
		echo "<table class='key'>
				<tr><td colspan='6'>Key</td></tr>
				<tr><td class='un'>1</td><td>Booked</td><td class='av'>1</td><td>Available</td></tr>
			</table>";
		
		echo '<script type="text/javascript">
			function year(year,unit){
				$( ".yearly-calendar" ).load( \'/perch/templates/simple_calendar/yearly-calendar.php?unit=\'+unit+\'&year=\'+year );	
			}
		</script>';
	}

  function getMaxNights($unit,$date){

    $API = new Simple_Calendars($API);
		$SimpleCalendar = new Simple_Calendars($API);
    
    $nights = $SimpleCalendar->getMaxNights($unit,$date);
    if($nights>14){
      $nights = 14;
    }
    
    return $nights;
    
  }

  function getMinNights($unit,$date){

    $API = new Simple_Calendars($API);
		$SimpleCalendar = new Simple_Calendars($API);
    
    $nights = $SimpleCalendar->getMinNights($unit,$date);
    
    return $nights;
    
  }

  function getMaxOccupants($unit){

    $API = new Simple_Calendars($API);
		$SimpleCalendar = new Simple_Calendars($API);
    
    $occupants = $SimpleCalendar->getMaxOccupants($unit);
    
    return $occupants;
    
  }

  function getUnitBySlug($unit){

    $API = new Simple_Calendars($API);
		$SimpleCalendar = new Simple_Calendars($API);
    
    $unitData = $SimpleCalendar->unitbySlug($unit,'');
    
    return $unitData;
    
  }

function getUnitByID($unitID){

    $API = new Simple_Calendars($API);
		$SimpleCalendar = new Simple_Calendars($API);
    
    $unitData = $SimpleCalendar->unit($unitID,'');
    
    return $unitData;
    
  }

function getPrice($nights,$unit,$arrival,$pet,$pay,$output,$adults,$children){
    $API = new Simple_Calendars($API);
    $SimpleCalendar = new Simple_Calendars($API);

    $arrivalDate = explode("-",$arrival);

    $unitData = $SimpleCalendar->unitbySlug($unit,'');

    $dateData = $SimpleCalendar->getUnitPricingDate($arrival,$unitData['unitID']);

    //check for booking conflict
    $conflicts = $SimpleCalendar->getConflicts("$arrival 15:00:00","$departure 10:00:00",$data['unitID']);

    //cycle through nights to calc price
    if($nights == 1){ $nightVar = 'onenight'; }
    if($nights == 2){ $nightVar = 'twonights'; }
    if($nights == 3){ $nightVar = 'threenights'; }
    if($nights == 4){ $nightVar = 'fournights'; }
    if($nights == 5){ $nightVar = 'fivenights'; }
    if($nights == 6){ $nightVar = 'sixnights'; }
    if($nights >= 7){ $nightVar = 'sevennights'; }

    $night = 0;

    while($night<$nights){

      $date = date("Y-m-d", mktime(0, 0, 0, $arrivalDate['1'], $arrivalDate['2']+$night, $arrivalDate['0']));
      $dateData = $SimpleCalendar->getUnitPricingDate($date,$unitData['unitID']);
      
      if($dateData[$nightVar]=='0.00'){

        $nightPricing = array($dateData['onenight'],$dateData['twonights'],$dateData['threenights'],$dateData['fournights'],$dateData['fivenights'],$dateData['sixnights'],$dateData['sevennights']);
        $value = max($nightPricing);

        $thisPrice = $value;

      }else{

        $thisPrice = $dateData[$nightVar];

      }

      if($nights>7){
        $tNights = 7;
      }else{
        $tNights = $nights;
      }
      $nightPrice = $thisPrice/$tNights;
      $totalPrice = $totalPrice+$nightPrice;
      
      if($nightPrice<='0'){
        $error = 1;
      }
      
      $nightPrice = round(number_format($nightPrice, 5, '.', ''));
      
      //echo $nightPrice."<br/>";

      $night++;
    }
    
    $partySize = $adults+$children;
    
    if($unitData['minDiscount2']>0 AND $partySize<=$unitData['minDiscount2'] AND $partySize>$unitData['minDiscount'] AND $unitData['discountPercentage2']>0 AND $dateData['discount']=='on' AND $partySize>0){
	    $discount = (100-$unitData['discountPercentage2'])/100;
	    $discountTotalPrice = $totalPrice*$discount;
	    $totalPrice = $discountTotalPrice;
    }elseif($unitData['minDiscount']>0 AND $partySize<=$unitData['minDiscount'] AND $unitData['discountPercentage']>0 AND $dateData['discount']=='on' AND $partySize>0){
	    $discount = (100-$unitData['discountPercentage'])/100;
	    $discountTotalPrice = $totalPrice*$discount;
	    $totalPrice = $discountTotalPrice;
    }

	if($unitData['singlePetCharge']=='yes' AND $pet>1){
		$pet = 1;
	}

    if($pet>0 AND $unitData['freePets']<>'yes'){
      $totalPrice = $totalPrice+(25*$pet);
    }
    
    $totalPrice = number_format(round($totalPrice), 2, '.', '');

    $today = date('Y-m-d');
    $diff = strtotime($arrival) - strtotime($today);
    $nights = $diff/86400;
    
    if($nights>60 AND $pay<>'on'){
      if($unitData['maxOccupants']<=2){
		  $deposit = 50.00;
	  }else{
		  $deposit = 100.00;
	  }
	  //$deposit = number_format(ceil($totalPrice/3), 2, '.', '');
	  $deposit = number_format($deposit, 2, '.', '');
    }else{
      $deposit = $totalPrice;
    }
  
    $toPay = $deposit*100;
  
    if($error==1){
      
      $HTML .= "<h3>Woops! Sorry, it looks like we're missing some pricing information and can't give you a price online.</h3>";
      $HTML .= "<p>Please call us on 01947 60677 to discuss your booking.</p>";
      
    }else{

	  if($output==1){
	      $HTML .= "<h3>Total Price</h3>";
	      $HTML .= "<p>&pound;$totalPrice";
	      if($unitData['minDiscount']>0 AND $partySize<=$unitData['minDiscount'] AND $unitData['discountPercentage']>0 AND $dateData['discount']=='on'){
		  	$HTML .= "    <em>including your group size discount of ".$unitData['discountPercentage']."%</em>";    
		  }
		  $HTML .= "</p>";
	      $HTML .= "<h3>Deposit Due Today</h3>";
	      $HTML .= "<p>&pound;$deposit</p>";
	     
	      $HTML .= "<input type=\"hidden\" name=\"cost\" value=\"$totalPrice\" />";
	      $HTML .= "<input type=\"hidden\" name=\"deposit\" value=\"$deposit\" />";
	      $HTML .= "<h3>Terms &amp; Conditions</h3>";
	      $HTML .= "<label><input type=\"checkbox\" id=\"terms\" name=\"terms\" onclick=\"javascript:checkTerms();\" /> I agree to the <a href=\"/terms\" target=\"_blank\">terms and conditions</a> of booking</label><br />";
	      $HTML .= '<span class="stripebutton" style="display:none;"><h3>Ready to Pay?</h3>';
	      $HTML .= '<button id="submit" class="button">Pay by Card</button>
				</form>';
		  $stripeDeposit = $deposit*100;
		  //$stripeDeposit = 100;
		  $HTML .= '
				<script>
					function checkTerms(){
	                  if (document.getElementById("terms").checked) {
	                   $(".stripebutton").show();
	                  } else {
	                   $(".stripebutton").hide();
	                  }
	                }
				
					$("#submit").click(function(event){
						event.preventDefault();
						$.post( "/booking/complete", $( "#payment-form" ).serialize(), function(data){
							if(data !== "error"){
								$("#booking_bookingID").val(data);
								$("form#redirect").submit();
							}else{
								alert("Booking Conflict");
							}
						});
					});
				</script>';
       }elseif($output==2){
		   $HTML = $deposit*100;
	   }else{
	      $HTML .= "<h3>Total Price</h3>";
	      $HTML .= "<p>&pound;$totalPrice";
	      if($unitData['minDiscount']>0 AND $partySize<=$unitData['minDiscount'] AND $partySize>0 AND $unitData['discountPercentage']>0){
		  	$HTML .= "    <em>based on a group size of ".$unitData['minDiscount']."</em>";    
		  }
		  $HTML .= "</p>";
	      $HTML .= "<h3>Deposit Due Today</h3>";
	      $HTML .= "<p>&pound;$deposit</p>";
       }
      
    }
  
    return $HTML;
}

function simple_calendar_make_booking($startTime,$endTime,$unitID,$customerID,$cost,$paid,$notes,$pet){
  
  $API = new Simple_Calendars($API);
  $SimpleCalendar = new Simple_Calendars($API);
  
  $SimpleCalendar->makeBooking_Pending($startTime,$endTime,$unitID,$customerID,$cost,$paid,$notes,$pet);
  
  $customerData = $SimpleCalendar->customer($customerID);
  $unitData = $SimpleCalendar->unit($unitID,'');
  $memberDetails = json_decode($customerData['memberProperties'],true);
  $emailData = $SimpleCalendar->getEmail(1);

  $arrivalDates = explode(" ",$startTime);
  $arrivalDates = explode("-",$arrivalDates[0]);
  $arrival = "$arrivalDates[2]/$arrivalDates[1]/$arrivalDates[0]";
  
  $arrivalFull = date("l jS \of F Y", mktime(0, 0, 0, $arrivalDates[1], $arrivalDates[2], $arrivalDates[0]));

  $departureDates = explode(" ",$endTime);
  $departureDates = explode("-",$departureDates[0]);
  $departure = "$departureDates[2]/$departureDates[1]/$departureDates[0]";
  
  $departureFull = date("l jS \of F Y", mktime(0, 0, 0, $departureDates[1], $departureDates[2], $departureDates[0]));

  $arrivalDates = explode(" ",$startTime);
  $departureDates = explode(" ",$endTime);

  $diff = strtotime($departureDates[0]) - strtotime($arrivalDates[0]);
  $nights = $diff/86400;
  
  $booking = $SimpleCalendar->getLastBooking_Pending();
  
  return $booking['bookingID'];
  
}

function simple_calendar_complete_booking($reference){
	
	$API = new Simple_Calendars($API);
	$SimpleCalendar = new Simple_Calendars($API);
	
	$booking = $SimpleCalendar->getBooking_Pending($reference);
	$SimpleCalendar->makeBooking($booking['startTime'], $booking['endTime'], $booking['unitID'], $booking['customerID'], $booking['cost'], $booking['paid'], $booking['notes'], $booking['addons']);
	
	$booking = $SimpleCalendar->getLastBooking();
	  
	return $booking['bookingID'];
	
}

function requestreviews(){
	
	$API = new Simple_Calendars($API);
	$SimpleCalendar = new Simple_Calendars($API);
	
	//GET ALL HOLIDAYS ENDING YESTERDAY
	$yesterday = date("Y-m-d", mktime(0, 0, 0, date('m'), date('d')-1, date('Y')));
	//$yesterday = '2021-01-10';
	$bookings = $SimpleCalendar->getBookingsReviews($yesterday);
	
	//LOOP THROUGH ALL HOLIDAYS AND CREATE RECORD IN REVIEWS TABLE - EMAIL GUEST BASED ON TEMPLATE
	foreach($bookings AS $booking){
		$customer = $booking['customerID'];
		$pos = strpos($booking['notes'], 'owner');
		if ($pos !== false) {
		    
		}else{
		    $unitData = $SimpleCalendar->unit($booking['unitID'],'');
		    $customerData = $SimpleCalendar->customer($customer);
		    $email = $customerData['memberEmail'];
		    //$email = 'jack@jackbarber.co.uk';

		    $json = json_decode($customerData['memberProperties'],true);
		    
		    $characters = '0123456789abcdefghijklmnopqrstuvwxyz'; 
		    $randomString = ''; 
		    $n = 255;
		  
		    for ($i = 0; $i < $n; $i++) { 
		        $index = rand(0, strlen($characters) - 1); 
		        $randomString .= $characters[$index]; 
		    } 
		    
		    $review['reviewCode'] = $randomString;
		    $review['emailAddress'] = $email;
		    $review['unitID'] = $booking['unitID'];
		    
		    $createReview = $SimpleCalendar->createReview($review);
		    
		    $emailData = $SimpleCalendar->getEmail(3);
		    
		    $placeHolders = array("{{unitName}}","{{bookingID}}","{{memberName}}","{{reviewcode}}");
			$emailContent = array($unitData['name'],"#".$booking['bookingID'],$json['first_name'],$randomString);
	
			$subject = str_replace(
			  $placeHolders,
			  $emailContent,
			  $emailData['subject']
			);
			
			$message = str_replace(
			  $placeHolders,
			  $emailContent,
			  $emailData['content']
			);
			
			$message = nl2br($message);
	
		    $headers .= 'Return-Path: info@baytownholidaycottages.co.uk' ."\r\n";
			$headers .= 'From: Baytown Holiday Cottages <info@baytownholidaycottages.co.uk>' . "\r\n";
		    $headers .= 'X-Mailer: PHP/' . phpversion(); 
		    $headers .= "\r\n";
		    $headers .= 'MIME-Version: 1.0' . "\r\n";
		    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

			mail($email, $subject, $message, $headers, "-f info@baytownholidaycottages.co.uk") or die ("Cannot sent email");
		    	    
		}
	}
	
}

function reviewform($reviewcode){
	
	$API = new Simple_Calendars($API);
	$SimpleCalendar = new Simple_Calendars($API);
	
	$reviewData = $SimpleCalendar->getReviewData($reviewcode);
	$unit = $SimpleCalendar->unit($reviewData['unitID'],'');

	if($reviewData['rating']==NULL){
		echo '<h2>Leave Us a Review</h2>
				<form method="post" class="review">
				<label>Rating</label>
				<p>How would you rate your stay in <strong>'.$unit['name'].'</strong>?</p>
				<select name="rating">
					<option value="5">&#9734;&#9734;&#9734;&#9734;&#9734;</option>
					<option value="4">&#9734;&#9734;&#9734;&#9734;</option>
					<option value="3">&#9734;&#9734;&#9734;</option>
					<option value="2">&#9734;&#9734;</option>
					<option value="1">&#9734;</option>
				</select>
				<label>Comments</label>
				<p>Please tell us a bit about why you enjoyed your visit to Robin Hood&rsquo;s Bay so much.</p>
				<textarea name="comments"></textarea>
				<p>Click below to save your review - once you&rsquo;ve done this it cannot be altered.</p>
				<input type="submit" value="Submit Review" />
				</form>';
	}else{
		echo "<h2>Thanks for submitting your review!</h2>";
	}
	
}

function logreview($review){
	
	$API = new Simple_Calendars($API);
	$SimpleCalendar = new Simple_Calendars($API);
	
	$log = $SimpleCalendar->logReview($review);
	
}

function unitReviews($slug,$cottagename){
	
	$API = new Simple_Calendars($API);
	$SimpleCalendar = new Simple_Calendars($API);
	
	$unit = $SimpleCalendar->unitbySlug($slug,'');
	
	$reviews = $SimpleCalendar->getReviews($unit['unitID']);
	
	if($reviews){
		echo '<div class="reviews-block flow"><h2>Reviews</h2>';
		
		foreach($reviews as $review){
			echo '<div class="review"><p class="rating">';
				if($review['rating']=='5'){
					echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
				}elseif($review['rating']=='4'){
					echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
				}elseif($review['rating']=='3'){
					echo '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
				}elseif($review['rating']=='2'){
					echo '<i class="fa fa-star"></i><i class="fa fa-star"></i>';
				}elseif($review['rating']=='1'){
					echo '<i class="fa fa-star"></i>';
				}
			echo '</p><p>'.$review['comments'].'</p></div>';
		}
		
		echo '</div>';
	}
	
}

function member_bookings($id){
	$API = new Simple_Calendars($API);
	$SimpleCalendar = new Simple_Calendars($API);
	
	$future = $SimpleCalendar->member_future_bookings($id);
	$past = $SimpleCalendar->member_past_bookings($id);
	
	if($future){
		echo "<h2>Your Future Bookings</h2><ul>";
		foreach($future as $booking){
			$unit = $SimpleCalendar->getAccSingleUnit($booking['unitID']);
			$starts = explode(" ", $booking['startTime']);
			$starts = explode("-",$starts[0]);
			$start = "$starts[2]/$starts[1]/$starts[0]";
			$ends = explode(" ", $booking['endTime']);
			$ends = explode("-",$ends[0]);
			$end = "$ends[2]/$ends[1]/$ends[0]";
			echo "<li><a href='/our-cottages/property?s=".$unit['slug']."'>".$unit['name']."</a> | ".$start." - ".$end."</li>";
		}
		echo "</ul>";
	}
	
	if($past){
		echo "<h2>Your Past Bookings</h2><ul>";
		foreach($past as $booking){
			$unit = $SimpleCalendar->getAccSingleUnit($booking['unitID']);
			$starts = explode(" ", $booking['startTime']);
			$starts = explode("-",$starts[0]);
			$start = "$starts[2]/$starts[1]/$starts[0]";
			$ends = explode(" ", $booking['endTime']);
			$ends = explode("-",$ends[0]);
			$end = "$ends[2]/$ends[1]/$ends[0]";
			if($unit['name']){
				echo "<li><a href='/our-cottages/property?s=".$unit['slug']."'>".$unit['name']."</a> | ".$start." - ".$end."</li>";
			}
		}
		echo "</ul>";
	}
}

function cancel_booking($reference){
	$API = new Simple_Calendars($API);
	$SimpleCalendar = new Simple_Calendars($API);
	  
	$SimpleCalendar->cancelBooking($reference);	
}

function record_payment($reference, $payment){
	$API = new Simple_Calendars($API);
	$SimpleCalendar = new Simple_Calendars($API);
	  
	$SimpleCalendar->recordPayment($reference, $payment);
}

function send_confirmation($reference){
	
	$API = new Simple_Calendars($API);
	$SimpleCalendar = new Simple_Calendars($API);

	$defaultEmail = 'info@baytownholidaycottages.co.uk';
	
	$booking = $SimpleCalendar->booking($reference, false);
	
	$customerData = $SimpleCalendar->customer($booking['customerID']);
	$unitData = $SimpleCalendar->unit($booking['unitID'],'');
	$memberDetails = json_decode($customerData['memberProperties'],true);
	$emailData = $SimpleCalendar->getEmail(1);
	
	$arrivalDates = explode(" ",$booking['startTime']);
	$arrivalDates = explode("-",$arrivalDates[0]);
	$arrival = "$arrivalDates[2]/$arrivalDates[1]/$arrivalDates[0]";
	
	$arrivalFull = date("l jS \of F Y", mktime(0, 0, 0, $arrivalDates[1], $arrivalDates[2], $arrivalDates[0]));
	
	$departureDates = explode(" ",$booking['endTime']);
	$departureDates = explode("-",$departureDates[0]);
	$departure = "$departureDates[2]/$departureDates[1]/$departureDates[0]";
	
	$departureFull = date("l jS \of F Y", mktime(0, 0, 0, $departureDates[1], $departureDates[2], $departureDates[0]));
	
	$arrivalDates = explode(" ",$booking['startTime']);
	$departureDates = explode(" ",$booking['endTime']);
	
	$diff = strtotime($departureDates[0]) - strtotime($arrivalDates[0]);
	$nights = $diff/86400;
	
	$placeHolders = array("{{unitName}}","{{bookingID}}","{{memberName}}","{{bookingArrival}}","{{bookingDeparture}}","{{bookingNights}}","{{bookingCost}}","{{bookingPaid}}");
	$emailContent = array($unitData['name'],"#".$booking['bookingID'],$memberDetails['first_name'],$arrivalFull,$departureFull,$nights,$booking['cost'],$booking['paid']);
	
	$subject = str_replace(
	$placeHolders,
	$emailContent,
	$emailData['subject']
	);
	
	$message = str_replace(
	$placeHolders,
	$emailContent,
	$emailData['content']
	);

	// SEND EMAIL
	
	  $to = $customerData['memberEmail'];
	  $message = nl2br($message);
	
	  $headers = 'From: ' . $defaultEmail . "\r\n" .
	  'X-Mailer: PHP/' . phpversion(); $header .= "\r\n";
	  $headers .= 'MIME-Version: 1.0' . "\r\n";
	  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	  $headers .= 'Cc: info@baytownholidaycottages.co.uk' . "\r\n";
	
	  mail($to, $subject, $message, $headers);
		
}

function latest_booking($id){
	
	$SimpleCalendar = new Simple_Calendars($API);
	
	if($id){
		$booking = $SimpleCalendar->latest_booking($id);
		$unit = $SimpleCalendar->getAccSingleUnit($booking['unitID']);
		
		echo "<div class='well'><h2>Booking Details</h2><br /><h3>".$unit['name']."</h3><p>".nl2br($booking['notes'])."</p></div>";
	}
	
}