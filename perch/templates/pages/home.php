<?php	
	session_start();
	perch_layout('global/header', array(
		'class'=>'home'
	));
?>
<div class="hero">
	<?php perch_content('Hero Image'); ?>
</div>
<div class="property-search">
	<div class="restrict">
		<button>Property Search</button>
		<form method="get" action="/our-cottages">
			<div>
				<label for="location">Location</label>
				<select name="location" id="location">
					<option value="Lower Bay">Lower Bay</option>
					<option value="Upper Bay" <?php if(strip_tags($_GET['location'])=='Upper Bay'){echo "SELECTED";} ?>>Upper Bay</option>
					<option value="Whitby Area" <?php if(strip_tags($_GET['location'])=='Whitby Area'){echo "SELECTED";} ?>>Whitby Area</option>
				</select>
			</div>
			<div>
				<label for="wifi">WiFi <input type="checkbox" name="wifi" id="wifi" <?php if(strip_tags($_GET['wifi'])=='on'){echo "CHECKED";} ?>></label>
			</div>
			<div>
				<label for="petfriendly">Pet Friendly <input type="checkbox" name="petfriendly" id="petfriendly" <?php if(strip_tags($_GET['petfriendly'])=='on'){echo "CHECKED";} ?>></label>
			</div>
			<div>
				<label for="parking">Parking <input type="checkbox" name="parking" id="parking" <?php if(strip_tags($_GET['parking'])=='on'){echo "CHECKED";} ?>></label>
			</div>
			<div>
				<label for="sleeps">Sleeps</label>
				<select name="sleeps" id="sleeps">
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
			</div>
			<div>
				<label for="price">Order By</label>
				<select name="price" id="price">
					<option value="ASC">Price Asc.</option>
					<option value="DESC" <?php if(strip_tags($_GET['price'])=='DESC'){echo "SELECTED";} ?>>Price Desc.</option>
				</select>
			</div>
			<div>
				<input type="submit" value="Search">
			</div>
		</form>
	</div>
</div>
<main>
	<div class="row cottage-highlights">
		<div class="restrict flow">	
			<h1 class="center"><?php perch_content('Main Heading');?></h1>
			
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
			
			<p class="center"><a class="button" href="/our-cottages">View Cottages &amp; Book Online</a></p>
		</div>
	</div>
	<div class="restrict flow">
		<?php //perch_content('Page Content'); ?>
		<?php perch_content('Flexible Content'); ?>
		<h2>Read the Baytown Blog</h2>
		<?php  
			perch_blog_custom(array(
				'sort' => 'postDateTime',
				'sort-order' => 'DESC',
				'count' => 6,
			    'paginate' => false,
			    'template' => 'post_in_list.html'
			));
		?>
	</div>
</main>
<?php
    perch_layout('global/footer');
?>
