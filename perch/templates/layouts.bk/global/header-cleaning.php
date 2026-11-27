<?php
  session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
	<title><?php 
		
		if (perch_layout_has('item_title')) {
		   echo perch_layout_var('item_title', true)." - ";
		} else {echo "";}
		perch_pages_title();
	
	?></title>
	<meta name="viewport" content="width=device-width" />

	<link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,400i,700" rel="stylesheet"> 

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
	<link rel="stylesheet" href="/assets/css/style.css?v=0.1" />
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/ui-lightness/jquery-ui.css" />
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script
	  src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"
	  integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw="
	  crossorigin="anonymous"></script>
	  
</head>
<body class="cleaning">
	<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.9&appId=674143562698942";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	<section class="contact">
		<section class="restrict">
			<a href="mailto:info@baytownholidaycottages.co.uk?subject=Website Enquiry">info@baytownholidaycottages.co.uk</a>
			<div id="google_translate_element"></div><script type="text/javascript">
			function googleTranslateElementInit() {
			  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, gaTrack: true, gaId: 'UA-98230454-1'}, 'google_translate_element');
			}
			</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
      <ul class="account">
        <?php
            if(perch_member_logged_in()){
              echo "<li><a href='/bookings'>Manage Account</a></li>"; 
            }else{
              echo "<li><a href='/bookings'>Register/Log In</a></li>"; 
            }
         ?>
        
         <?php
            if(perch_member_logged_in()){
              echo "<li><a href='/logout'>Logout</a></li>"; 
            }
         ?>
      </ul>
			<section class="search">
				<?php perch_search_form(); ?>
			</section>
		</section>
	</section>
	<header>
		<section class="restrict">
			<h1>Baytown Holiday Cottages</h1>
			<h2>Holiday Cottages to Let in Robin Hood's Bay and the North Yorkshire Coast</h2>
			
			<section class="contact">
				<ul>	
					<li>Get in Touch:</li>
					<li class="larger">07703 457229</li>
					<li class="larger"></li>
					<li class="inline"><a href="http://instagram.com/baytownholidaycottages" target="_blank"><i class="fa fa-instagram fa-3x"></i></a></li>
					<li class="inline"><a href="https://www.facebook.com/Baytowncottages/" target="_blank"><i class="fa fa-facebook-official fa-3x"></i></a></li>
					<li class="inline"><a href="http://twitter.com/baytowncottages" target="_blank"><i class="fa fa-twitter fa-3x"></i></a></li>
					<li class="inline"><a href="https://www.pinterest.co.uk/baytownholidaycottages/" target="_blank"><i class="fa fa-pinterest fa-3x"></i></a></li>
				</ul>
			</section>
			
			<section class="reviews">
				
			</section>
		</section>
	</header>
	<nav>
		<a class="menu">Menu <i class="fa fa-bars"></i></a>
	<?php
		// Main navigation
	    perch_pages_navigation(array(
		    'hide-extensions' => true
	    ));
    ?>
    
    <section class="section-nav">
	    <?php 
		    $url =  perch_page_url(array(
			    'hide-extensions'    => true,
			    'hide-default-doc'   => true,
			    'add-trailing-slash' => false,
			    'include-domain'     => false,
			), true);
			
			if($url<>'/'){
			    perch_pages_navigation(array(
				    'from-path'=>'*',
				    'from-level'=>1,
				)); 
			}
		?>
    </section>
	</nav>
	<section class="property-search">
		<section class="restrict">
			<form method="get" action="/our-cottages">
				<h3>Search:</h3>
				<label>Order By</label>
				<select name="price">
					<option value="ASC">Price Asc.</option>
					<option value="DESC" <?php if(strip_tags($_GET['price'])=='DESC'){echo "SELECTED";} ?>>Price Desc.</option>
				</select>
				<label>Location</label>
				<select name="location">
					<option value="Lower Bay">Lower Bay</option>
					<option value="Upper Bay" <?php if(strip_tags($_GET['location'])=='Upper Bay'){echo "SELECTED";} ?>>Upper Bay</option>
					<option value="Whitby Area" <?php if(strip_tags($_GET['location'])=='Whitby Area'){echo "SELECTED";} ?>>Whitby Area</option>
				</select>
				<label>WiFi <input type="checkbox" name="wifi" <?php if(strip_tags($_GET['wifi'])=='on'){echo "CHECKED";} ?>/></label>
				
				<label>Pet Friendly <input type="checkbox" name="petfriendly" <?php if(strip_tags($_GET['petfriendly'])=='on'){echo "CHECKED";} ?>/></label>
				
				<label>Parking <input type="checkbox" name="parking" <?php if(strip_tags($_GET['parking'])=='on'){echo "CHECKED";} ?>/></label>
				
				<label>Sleeps</label>
				<select name="sleeps">
					<option value="2">2</option>
					<option value="3" <?php if(strip_tags($_GET['sleeps'])=='3'){echo "SELECTED";} ?>>3</option>
					<option value="4" <?php if(strip_tags($_GET['sleeps'])=='4'){echo "SELECTED";} ?>>4</option>
					<option value="5" <?php if(strip_tags($_GET['sleeps'])=='5'){echo "SELECTED";} ?>>5</option>
					<option value="6" <?php if(strip_tags($_GET['sleeps'])=='6'){echo "SELECTED";} ?>>6</option>
					<option value="7" <?php if(strip_tags($_GET['sleeps'])=='7'){echo "SELECTED";} ?>>7</option>
					<option value="8" <?php if(strip_tags($_GET['sleeps'])=='8'){echo "SELECTED";} ?>>8</option>
          <option value="9" <?php if(strip_tags($_GET['sleeps'])=='9'){echo "SELECTED";} ?>>9</option>
          <option value="10" <?php if(strip_tags($_GET['sleeps'])=='10'){echo "SELECTED";} ?>>10</option>
				</select>
				<input type="submit" value="Go" />
			</form>
		</section>
	</section>