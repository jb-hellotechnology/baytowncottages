<?php if (!defined('PERCH_RUNWAY')) include($_SERVER['DOCUMENT_ROOT'].'/perch/runtime.php'); ?>
<?php

	include('library.php');
	
	Connect();

	$year = strip_tags($_GET['year']);
	$month = strip_tags($_GET['month']);
	
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
	
	$cottage = strip_tags($_GET['id']);

	grid_cal($lastMonth,$nextMonth,$month,$lastYear,$nextYear,$year,$cottage);
	
	echo '<script type="text/javascript">
			function month(year,month,cottage){
				$( ".monthly-calendar" ).load( \'/perch/templates/calendar/monthly-calendar.php?id=\'+cottage+\'&year=\'+year+\'&month=\'+month );	
			}
	</script>';
	
	
		
?>

<?php
function grid_cal($lastMonth,$nextMonth,$m,$lastYear,$nextYear,$y,$cottage){
    $tabs = "\n\t\t\t\t";
    $w_days = array("S","S","M","T","W","T","F");
    $stamp = mktime(0,0,0,$m,2,$y);
    $maxday = date("t",$stamp);
    $thismonth = getdate($stamp);
    $startday = $thismonth['wday'];    
	$thisYear = $lastYear+1;
?>
 
    <table class="cal-table">
        <tr class="cal-month">
            <td colspan="7"><a class="last" href="javascript:month('<?php echo $lastYear; ?>','<?php echo $lastMonth; ?>','<?php echo $cottage; ?>');"><i class="fa fa-arrow-left" aria-hidden="true"></i>
</a> <?php echo date("F",$stamp); ?> <?php echo $y; ?> <a class="next" href="javascript:month('<?php echo $nextYear; ?>','<?php echo $nextMonth; ?>','<?php echo $cottage; ?>');"><i class="fa fa-arrow-right" aria-hidden="true"></i>
</a></td>
        </tr>
        <tr class="cal-days">
            <?php foreach($w_days as $d) { echo "$tabs\t\t<td>$d</td>"; } ?>
        </tr>
<?php
	
	$curr_month = (date("F Y")==date("F Y",$stamp))? TRUE : FALSE; // if this calendar is displaying current month
    $today = date("j"); 
    for ($i=0; $i<($maxday+$startday); $i++) {
        if(($i % 7) == 0 ) echo "$tabs\t<tr class='cal-date'>";
        
        $day = $i - $startday + 1;
        $curDate = date("Y-m-d", mktime(0, 0, 0, $m, $day, $y));
        $thisDay = date("D", mktime(0, 0, 0, $m, $day, $y));
        
        $rows = mysql_num_rows(mysql_query("SELECT * FROM availability WHERE date='$curDate' AND propertySlug='$cottage'"));
		if($rows==1){
			$date_class = " class='un'";
			
			if($i < $startday) echo "$tabs\t\t<td></td>";
	        else echo "$tabs\t\t<td{$date_class}>". ($i - $startday + 1) . "</td>";
	        if(($i % 7) == 6 ) echo "$tabs\t</tr>\n";
			
		}else{
			$date_class = " class='av'";
			
			$pData = mysql_query("SELECT * FROM pricing WHERE startDate<='$curDate' AND endDate>='$curDate' AND propertySlug='$cottage'");
			if(mysql_num_rows($pData)==1){
				$priceData = mysql_fetch_array($pData);
				if(($priceData['changeover']=='Any Day') OR ($priceData['changeover']=='Fri/Mon' AND ($thisDay=='Fri' OR $thisDay=='Mon')) OR ($priceData['changeover']=='Sat - Sat' AND ($thisDay=='Sat')) OR ($priceData['changeover']=='Fri - Fri' AND ($thisDay=='Fri'))){
			
					$date_class = " class='av arrival'";
					
					if($i < $startday) echo "$tabs\t\t<td></td>";
			        else echo "$tabs\t\t<td{$date_class}><a href=\"javascript:arrival('$curDate','$cottage');\">". ($i - $startday + 1) . "</a></td>";
			        if(($i % 7) == 6 ) echo "$tabs\t</tr>\n";
					
				}else{
					if($i < $startday) echo "$tabs\t\t<td></td>";
			        else echo "$tabs\t\t<td{$date_class}>". ($i - $startday + 1) . "</td>";
			        if(($i % 7) == 6 ) echo "$tabs\t</tr>\n";
				}
			}elseif($y==2017){
					$date_class = " class='av arrival'";
					
					if($i < $startday) echo "$tabs\t\t<td></td>";
			        else echo "$tabs\t\t<td{$date_class}><a href=\"javascript:arrival('$curDate','$cottage');\">". ($i - $startday + 1) . "</a></td>";
			        if(($i % 7) == 6 ) echo "$tabs\t</tr>\n";
			}else{
				
				$date_class = " class='av'";
					
				if($i < $startday) echo "$tabs\t\t<td></td>";
		        else echo "$tabs\t\t<td{$date_class}>". ($i - $startday + 1) . "</td>";
		        if(($i % 7) == 6 ) echo "$tabs\t</tr>\n";
				
			}
		}   
	}
	
echo "$tabs</table>";
 
}

echo "<table class='key'>
		<tr><td colspan='6'>Key</td></tr>
		<tr><td class='un'>1</td><td>Booked</td><td class='av'>1</td><td>Available</td><td class='av arrival'>1</td><td>Arrival</td></tr>
	</table>";