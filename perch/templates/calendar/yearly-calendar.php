<?php if (!defined('PERCH_RUNWAY')) include($_SERVER['DOCUMENT_ROOT'].'/perch/runtime.php'); ?>
<?php

	include('library.php');
	
	Connect();

	$year = strip_tags($_GET['year']);
	
	if($year == ''){
		$year = date('Y');
	}
	
	$last = $year-1;
	$next = $year+1;
	
	$cottage = strip_tags($_GET['id']);
	
	$Users = new PerchUsers;
	$CurrentUser = $Users->get_current_user();

	echo '<ul class="control">
				<li><a href="javascript:year('.$last.',\''.$cottage.'\');"><i class="fa fa-arrow-left" aria-hidden="true"></i>
</a></li>
				<li>'.$year.'</li>
				<li><a href="javascript:year('.$next.',\''.$cottage.'\');"><i class="fa fa-arrow-right" aria-hidden="true"></i>
</a></li>
			</ul>
			
	';
			
	
	
	$month = 1;
	while($month<=12){
		grid_cal($month,$year,$cottage);
		$month++;
	}
			
	echo '<script type="text/javascript">
			function year(year,cottage){
				$( ".yearly-calendar" ).load( \'/perch/templates/calendar/yearly-calendar.php?id=\'+cottage+\'&year=\'+year );	
			}
			function toggleDate(pDate,year,cottage){
				$.post( "/perch/templates/calendar/toggle.php", { date: pDate, cottage: cottage } );
				$( ".yearly-calendar" ).load( \'/perch/templates/calendar/yearly-calendar.php?id=\'+cottage+\'&year=\'+year );	
			}
	</script>
	<table class="key clear">
		<tr><td colspan="4">Key</td></tr>
		<tr><td class="un">1</td><td>Booked</td><td class="av">1</td><td>Available</td></tr>
	</table>';
	
	
		
?>

<?php
function grid_cal($m,$y,$cottage){
    $tabs = "\n\t\t\t\t";
    $w_days = array("S","S","M","T","W","T","F");
    $stamp = mktime(0,0,0,$m,2,$y);
    $maxday = date("t",$stamp);
    $thismonth = getdate($stamp);
    $startday = $thismonth['wday'];    
?>
 
    <table class="cal-table">
        <tr class="cal-month">
            <td colspan="7"><?php echo date("F",$stamp); ?></td>
        </tr>
        <tr class="cal-days">
            <?php foreach($w_days as $d) { echo "$tabs\t\t<td>$d</td>"; } ?>
        </tr>
<?php
	
	$Users = new PerchUsers;
	$CurrentUser = $Users->get_current_user();
	
	if (is_object($CurrentUser) && $CurrentUser->logged_in()) {
		$today = date("j"); 
	    for ($i=0; $i<($maxday+$startday); $i++) {
	        if(($i % 7) == 0 ) echo "$tabs\t<tr class='cal-date'>";
	        
	        $day = $i - $startday + 1;
	        $curDate = date("Y-m-d", mktime(0, 0, 0, $m, $day, $y));
	        
	        $rows = mysql_num_rows(mysql_query("SELECT * FROM availability WHERE date='$curDate' AND propertySlug='$cottage'"));
			if($rows==1){
				$date_class = " class='un'";
			}else{
				$date_class = " class='av'";
			}
	        
	        if($i < $startday) echo "$tabs\t\t<td></td>";
	        else echo "$tabs\t\t<td{$date_class}><a href='javascript:toggleDate(\"$curDate\",\"$y\",\"$cottage\");'>". ($i - $startday + 1) . "</a></td>";
	        if(($i % 7) == 6 ) echo "$tabs\t</tr>\n";
		}
	}else{
		$curr_month = (date("F Y")==date("F Y",$stamp))? TRUE : FALSE; // if this calendar is displaying current month
	    $today = date("j"); 
	    for ($i=0; $i<($maxday+$startday); $i++) {
	        	        if(($i % 7) == 0 ) echo "$tabs\t<tr class='cal-date'>";
	        
	        $day = $i - $startday + 1;
	        $curDate = date("Y-m-d", mktime(0, 0, 0, $m, $day, $y));
	        
	        $rows = mysql_num_rows(mysql_query("SELECT * FROM availability WHERE date='$curDate' AND propertySlug='$cottage'"));
			if($rows==1){
				$date_class = " class='un'";
			}else{
				$date_class = " class='av'";
			}
	        
	        if($i < $startday) echo "$tabs\t\t<td></td>";
	        else echo "$tabs\t\t<td{$date_class}>". ($i - $startday + 1) . "</td>";
	        if(($i % 7) == 6 ) echo "$tabs\t</tr>\n";
		}    
    }
echo "$tabs</table>";
 
}