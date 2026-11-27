<?php
  $price = getPrice($_POST['nights'],$_POST['unit'],$_POST['arrival'],$_POST['pet'],$_POST['pay'],1,$_POST['adults'],$_POST['children']);
  echo $price;
?>