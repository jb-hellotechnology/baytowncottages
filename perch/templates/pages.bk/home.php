<?php	
	session_start();
	perch_layout('global/header');
?>
<section class="hero">
	<?php perch_content('Hero Image'); ?>
  
</section>
<section class="property-search">
	<section class="restrict">
		<form method="get" action="/our-cottages">
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
			<input type="submit" value="Search" />
		</form>
	</section>
</section>
<section class="page">
	<section class="row cottage-highlights">
		<section class="restrict">	
			<h2 class="center"><?php perch_content('Main Heading');?></h2>
			
			<?php
			    perch_collection('Cottages', [
					'template'   =>'cottages/browse.html',
					'count'		 => '3',
					'sort'		 => 'cottageName',
					'sort-order' => 'RAND',
					'filter' => 'hide',
				    'match' => 'neq',
				    'value' => 'true'
			    ]); 
			?>	
			
			<p><a class="button" href="/our-cottages">View All &amp; Book Online</a></p>
		</section>
	</section>
	<section class="restrict">
		<section class="row">
			<section class="column two-thirds">
        <?php perch_content('Events'); ?>
				<?php perch_content('Page Content'); ?>
			</section>
			<section class="column third paginate-hide">
				<?php perch_blog_recent_posts(16); ?>
			</section>
		</section>
	</section>
</section>
<?php
    perch_layout('global/footer_home');
?>
