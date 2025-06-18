<?php	
	perch_layout('global/header');
?>
<main>
	<div class="restrict padding-top flow">
		<?php
			perch_content('Page Content');
		?>
		<div>
			<p><strong>Jump to Month:</strong></p>
			<select onchange="jump()" id="month">
				<?php
				$i = 0;
				while($i<=11){
					$dateA = date("Y-m", mktime(0, 0, 0, date('m')+$i, 1, date('Y')));
					$dateB = date("F Y", mktime(0, 0, 0, date('m')+$i, 1, date('Y')));
					echo '<option value="'.$dateA.'">'.$dateB.'</option>';
					$i++;
				}
				?>
			</select>
		</div>
		<div class="monthly-calendar-all">
			<p><strong>Loading calendars&hellip;</strong></p>
		</div>
		<script type="text/javascript">
		$(document).ready(function(){
			$( ".monthly-calendar-all" ).load( '/perch/templates/simple_calendar/monthly-calendar-all.php' );
		});
		function jump(){
			var date = $('#month').val();
			const parts = date.split("-");
			$(".monthly-calendar").append("<div class=\"loading\"><p>Loading...</p></div>");
			$( ".monthly-calendar-all" ).load("/perch/templates/simple_calendar/monthly-calendar-all.php?year="+parts[0]+"&month="+parts[1]);
		}
		</script>
	</div>
<main>
<?php
    perch_layout('global/footer');
?>
