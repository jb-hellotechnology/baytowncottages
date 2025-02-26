<?php
  session_start();
  if($_POST['return']){
    $redirect = "/our-cottages/property?s=$_POST[return]";
    PerchSystem::redirect($redirect);
  }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
	<title><?php 
		
		if (perch_layout_has('item_title')) {
		   echo perch_layout_var('item_title', true);
		} else {perch_pages_title();}
	
	?></title>
	<meta name="viewport" content="width=device-width" />
	
	<?php
		perch_page_attributes(array(
			'template' => 'seo.html'
		));
	?>

	<link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,400i,700" rel="stylesheet"> 

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
	<link rel="stylesheet" href="/assets/css/style.css?v=<?php echo rand(); ?>" />
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/ui-lightness/jquery-ui.css" />
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script
	  src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"
	  integrity="sha256-xNjb53/rY+WmG+4L6tTl9m6PpqknWZvRt0rO1SRnJzw="
	  crossorigin="anonymous"></script>
	  
	<meta name="p:domain_verify" content="fde999de96c60450c381e1d20fa8185a"/>
	
	<meta property="og:type" content="article" />
    <meta property="og:title" content="<?php if(perch_layout_has('item_title')){echo perch_layout_var('item_title', true);}else{perch_pages_title();}?>" />
    <meta property="og:description" content="<?php if(perch_layout_has('item_description')){echo perch_layout_var('item_description', true);}else{echo perch_page_attribute('description');}?>" />
    <meta property="og:url" content="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" />
    <meta property="og:site_name" content="baytownholidaycottages.co.uk" />
    <meta property="article:published_time" content="<?php echo date('Y-m-dTH:i:s'); ?>+00:00" />
    <meta property="article:author" content="Baytown Holiday Cottages" />
    
	<link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
	<link rel="manifest" href="/assets/favicon/site.webmanifest">
	
	<script src="https://js.stripe.com/v3/"></script>
</head>
<body>
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
      
      <a href="/all-availability"><img src="/assets/images/bookonline.svg" alt="Book Online!" class="book" /></a>
			
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