<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);	
*/
?>
<h4>Results for '<?php echo $_POST['q']; ?>':</h4>
<?php

# include the API
include('../../../core/inc/api.php');
    
$API  = new PerchAPI(1.0, 'cma_membersearch');

# include your class files
include('cma_membersearches.class.php');
include('cma_membersearch.class.php');

$Searches = new CMA_Searches($API);

$data = $Searches->getMembers($_POST['q']);