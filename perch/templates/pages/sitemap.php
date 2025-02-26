<?php
 header('Content-type: application/xml');
 include('perch/runtime.php');
 echo '<?xml version="1.0" encoding="UTF-8"?>
 <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
 perch_pages_navigation(array(
     'template' => 'sitemap.html',
     'add-trailing-slash' => true,
     'flat' => true,
     'hide-extensions' => true
 ));
 perch_pages_navigation(array(
     'template' => 'sitemap.html',
     'add-trailing-slash' => true,
     'flat' => true,
     'hide-extensions' => true
 )); 
 perch_blog_custom(array(
     'template' => 'sitemap-blog.html',
     'sort'=>'postDateTime',
     'sort-order'=>'DESC',
     'count' => 3000
 ));
 perch_collection('Cottages', [
	'template'   => 'cottages/sitemap-cottages.html',
	'sort'		 => '_order',
	'sort-order' => 'ASC',
	'filter' => 'hide',
    'match' => 'neq',
    'value' => 'true'
 ]);
 echo '</urlset>';
 ?>