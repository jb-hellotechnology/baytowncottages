<?php	
	perch_layout('global/header');
?>
<main>
	<div class="restrict padding-top flow">
		<?php perch_content('Page Content'); ?>
		<h2>Tide Times</h2>
		<script src="https://www.tidetimes.org.uk/whitby-tide-times.js" type="text/javascript"></script>
		<br /><br />
		<h2>Weather Forecast</h2>
		<a href="https://www.accuweather.com/en/gb/robin-hoods-bay/yo22-4/current-weather/329962" class="aw-widget-legal">
		<!--
		By accessing and/or using this code snippet, you agree to AccuWeather’s terms and conditions (in English) which can be found at https://www.accuweather.com/en/free-weather-widgets/terms and AccuWeather’s Privacy Statement (in English) which can be found at https://www.accuweather.com/en/privacy.
		-->
		</a><div id="awtd1493285613688" class="aw-widget-36hour"  data-locationkey="329962" data-unit="c" data-language="en-us" data-useip="false" data-uid="awtd1493285613688" data-editlocation="false"></div><script type="text/javascript" src="https://oap.accuweather.com/launch.js"></script>
	</div>
</main>
<?php
    perch_layout('global/footer');
?>
