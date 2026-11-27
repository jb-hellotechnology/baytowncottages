<?php
  session_start();
  if($_POST['return']){
    $redirect = "/our-cottages/property/$_POST[return]";
    PerchSystem::redirect($redirect);
  }
  
$price       = strip_tags($_GET['price']       ?? '');
$location    = strip_tags($_GET['location']    ?? '');
$sleeps      = strip_tags($_GET['sleeps']      ?? '');
$wifi        = strip_tags($_GET['wifi']        ?? '');
$petfriendly = strip_tags($_GET['petfriendly'] ?? '');
$dogs        = max(0, (int) ($_GET['dogs'] ?? 0));
$parking     = strip_tags($_GET['parking']     ?? '');
$arrival     = strip_tags($_GET['arrival']     ?? '');
$nights      = (int) ($_GET['nights']          ?? 0);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title><?php 
		
		if (perch_layout_has('item_title')) {
		   echo perch_layout_var('item_title', true);
		} else {perch_pages_title();}
	
	?></title>
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	
	<link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="/assets/css/style.css?v=<?php echo rand(); ?>">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.0/dist/fancybox/fancybox.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/carousel/carousel.thumbs.css" />
	
	<?php
		perch_page_attributes(array(
			'template' => 'seo.html'
		));
	?>

	<?php if(perch_layout_has('canonical')){ ?>
	<link rel="canonical" href="<?php echo perch_layout_var('canonical', true); ?>">
	<?php } ?>

	<meta name="p:domain_verify" content="fde999de96c60450c381e1d20fa8185a">
	<meta property="og:type" content="article">
    <meta property="og:title" content="<?php if(perch_layout_has('item_title')){echo perch_layout_var('item_title', true);}else{perch_pages_title();}?>">
    <meta property="og:description" content="<?php if(perch_layout_has('item_description')){echo perch_layout_var('item_description', true);}else{echo perch_page_attribute('description');}?>">
    <meta property="og:url" content="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:site_name" content="baytownholidaycottages.co.uk">
    
	<link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
	<link rel="manifest" href="/assets/favicon/site.webmanifest">

	<!-- Fathom - beautiful, simple website analytics -->
	<script src="https://cdn.usefathom.com/script.js" data-site="CJIFKEGV" defer></script>
	<!-- / Fathom -->
</head>
<body class="<?php perch_layout_var('class') ?>">
	<div class="contact">
		<div class="restrict">
			<a href="mailto:info@baytownholidaycottages.co.uk">info@baytownholidaycottages.co.uk</a>
			<ul class="account">
			<?php
			    if(perch_member_logged_in()){
			      echo "	<li><a href='/bookings'>Manage Account</a></li>"; 
			    }else{
			      echo "	<li><a href='/register'>Register</a> | <a href='/login'>Log In</a></li>"; 
			    }
			 ?>
			
			 <?php
			    if(perch_member_logged_in()){
			      echo "	<li><a href='/logout'>Logout</a></li>"; 
			    }
			 ?>
</ul>
			<div class="search">
				<?php perch_search_form(); ?>
	
			</div>
		</div>
	</div>
	<header>
		<div class="restrict">
			<div>
				<h2>Baytown Holiday Cottages</h2>
				<h3>Holiday Cottages to Let in Robin Hood's Bay and the North Yorkshire Coast</h3>
			</div>
			
			<a href="/all-availability" class="all-availability"><span>All Cottage Availability</span><img src="/assets/images/bookonline.svg" alt="Book Online!" class="book"></a>
			
			<div class="contact">
				<p>Get in Touch:</p>
				<ul>	
					<li class="larger">07703 457229</li>
				</ul>
			</div>
		</div>
	</header>
	<div class="navigation">
		<div class="restrict">
			<button class="menu">Menu <i class="fa fa-bars"></i></button>
			<nav>
				<button class="close"><i class="fa fa-times"></i></button>
			<?php
				// Main navigation
			    perch_pages_navigation(array(
				    'hide-extensions' => true
			    ));
		    ?>
		    </nav>
		</div>
	</div>
	
	<div class="property-search">
		<div class="restrict">
			<button>Property Search</button>
			<form method="get" action="/cottage-search">
	
				<div>
					<label for="location">Location</label>
					<select name="location">
						<option value="">Any</option>
						<option value="Lower Robin Hood's Bay" <?php if ($location === "Lower Robin Hood's Bay") echo 'selected'; ?>>Lower Bay</option>
						<option value="Upper Robin Hood's Bay" <?php if ($location === "Upper Robin Hood's Bay") echo 'selected'; ?>>Upper Bay</option>
						<option value="Fylingthorpe"           <?php if ($location === 'Fylingthorpe')          echo 'selected'; ?>>Fylingthorpe</option>
					</select>
				</div>
	
				<div>
					<label for="arrival">Arrival Date</label>
					<input type="date" name="arrival"
						   min="<?php echo date('Y-m-d', strtotime('+2 days')); ?>"
						   value="<?php echo $arrival; ?>">
				</div>
	
				<div>
					<label for="nights">Nights</label>
					<select name="nights">
						<?php foreach (range(2, 14) as $n): ?>
							<option value="<?php echo $n; ?>" <?php if ($nights === $n) echo 'selected'; ?>>
								<?php echo $n; ?>
						<?php endforeach; ?>
					</select>
				</div>
	
				<div>
					<label for="wifi">WiFi
						<input type="checkbox" name="wifi" id="wifi" <?php if ($wifi === 'on') echo 'checked'; ?>>
					</label>
				</div>
				<div>
					<label for="dogs">Dogs</label>
					<select name="dogs">
						<option value="">No Dogs</option>
						<?php foreach (range(1, 3) as $n): ?>
							<option value="<?php echo $n; ?>" <?php if ($dogs === $n) echo 'selected'; ?>>
								<?php echo $n; ?>
						<?php endforeach; ?>
					</select>
				</div>
				<div>
					<label for="parking">Parking
						<input type="checkbox" name="parking" id="parking" <?php if ($parking === 'on') echo 'checked'; ?>>
					</label>
				</div>
	
				<div>
					<label for="sleeps">Sleeps</label>
					<select name="sleeps">
						<?php foreach (range(2, 12) as $n): ?>
							<option value="<?php echo $n; ?>" <?php if ((string)$sleeps === (string)$n) echo 'selected'; ?>>
								<?php echo $n; ?>
						<?php endforeach; ?>
					</select>
				</div>
	
				<div><input type="submit" value="Search"></div>
	
			</form>
		</div>
	</div>