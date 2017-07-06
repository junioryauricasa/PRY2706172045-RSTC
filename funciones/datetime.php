<?php
  $now   = new DateTime;
  $clone = $now;      
  $clone->modify( '-1 day' );

  echo $now->format( 'd/m/Y' );
?>