<?php
	echo $HTML->title_panel([
    'heading' => $Lang->get('Search Members'),
    ], $CurrentUser);
    
    $HTML->main_panel_start();

	echo $Form->form_start();

    echo $Form->text_field("q","Search Text",'');

    echo $Form->form_end();
	
	echo '
		<script>
			$("#q").on("input", function() {
				var qData = $("#q").val();
				console.log(qData);
			    $.post("getMembers.php", { q: qData }, function( data ){
				  $( ".result" ).html( data );
				});
			});
		</script>
	';
	
	echo '<div class="result"></div>';

	$HTML->main_panel_end();