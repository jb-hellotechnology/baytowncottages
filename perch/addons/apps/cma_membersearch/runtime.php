<?php
    /*
        This file includes the code called by the site pages at runtime.
        If you app is admin-only then don't include this file.
        
        Remember - try and be as lightweight at runtime as possble. Include only 
        what you need to, run only 100% necessary code. Make every database query
        count.
    */
   
    

    # Include your class files as needed - up to you.
    include('cma_membersearches.class.php');
    include('cma_membersearch.class.php');