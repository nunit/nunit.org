<?php
  include( "nunit_constants.php" );
  require_once( PHP_DIR . "nunit_page.php" );

  $name = getarg( "p", "controlPanel" );

  include( "control/$name.php" );
?>
