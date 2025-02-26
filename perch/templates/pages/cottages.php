<?php	
	perch_layout('global/header');
?>
<main>
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
	<div class="restrict flow padding-top">
		<?php
			
			$price = strip_tags($_GET['price']);
			$location = strip_tags($_GET['location']);
			$sleeps = strip_tags($_GET['sleeps']);
			$wifi = strip_tags($_GET['wifi']);
			$petfriendly = strip_tags($_GET['petfriendly']);
			$parking = strip_tags($_GET['parking']);
			
			if($wifi=='on'){
				$wifi_eq = 'eq';
				$wifi_val = "WiFi";
			}else{
				$wifi_eq = 'in';
				$wifi_val = "WiFi, ";
			}
			
			if($petfriendly=='on'){
				$pet_eq = 'eq';
				$pet_val = "Pet Friendly";
			}else{
				$pet_eq = 'in';
				$pet_val = "Pet Friendly, ";
			}
			
			if($parking=='on'){
				$park_eq = 'eq';
				$park_val = "Parking Permit";
			}else{
				$park_eq = 'in';
				$park_val = "Parking Permit, ";
			}
			
			if($price=='' OR $location=='' OR $sleeps==''){
				
				perch_content('Cottage Intro');

			    perch_collection('Cottages', [
					'template'   => 'cottages/browse.html',
					'sort'		 => '_order',
					'sort-order' => 'ASC',
					'filter' => 'hide',
				    'match' => 'neq',
				    'value' => 'true'
			    ]); 
			    
			    perch_content('Cottage Additional Info');

		    }else{
			    
			    if($location=='Lower Bay'){
				    echo '<h2>Our Cottages in Lower Robin Hood\'s Bay</h2>';
			    }elseif($location=='Upper Bay'){
				    echo '<h2>Our Cottages in Upper Robin Hood\'s Bay</h2>';
			    }elseif($location=='Whitby Area'){
				    echo '<h2>Our Cottages in the Surrounding Area</h2>';
			    }
			    
			   
			    
			    if($price=='ASC' OR $price=='DESC'){
			    
				    perch_collection('Cottages', [
						'template'   =>'cottages/browse.html',
						'filter'=>array(
					        array(
					            'filter'=>'cottageSleeps',
					            'match'=>'gte',
								'value'=>$sleeps
					        ),
					        array(
					            'filter'=>'cottageLocation',
					            'match'=>'eq',
								'value'=>$location
					        ),
					        array(
					            'filter'=>'wifi',
					            'match'=>$wifi_eq,
								'value'=>$wifi_val
					        ),
					        array(
					            'filter'=>'petfriendly',
					            'match'=>$pet_eq,
								'value'=>$pet_val
					        ),
					        array(
					            'filter'=>'parkingpermit',
					            'match'=>$park_eq,
								'value'=>$park_val
					        ),
					        array(
						        'filter' => 'hide',
							    'match' => 'neq',
							    'value' => 'true'
					        )
					    ),
					    'sort'=>'maxPrice',
					    'sort-order'=>$price,
					    'sort-type'=>'numeric',
						'paginate'=>false,
						'count'=>200
					]);
				
				}else{
					
					perch_collection('Cottages', [
						'template'   =>'cottages/browse.html',
						'filter'=>array(
					        array(
					            'filter'=>'cottageSleeps',
					            'match'=>'gte',
								'value'=>$sleeps
					        ),
					        array(
					            'filter'=>'cottageLocation',
					            'match'=>'eq',
								'value'=>$location
					        ),
					    ),
						'paginate'=>false,
						'count'=>200
					]);
					
				}
				
			}
		?>	
	</div>
</main>
<?php
    perch_layout('global/footer');
?>
