<?php 
  // Main entry for the NUnitLite website, now being moved
  // to it's own location, outside of NUnit.com
  
  // Define Home and PHP diretories
  $here = dirname( __FILE__ );
  $php = $here . '/php';
  define ( "HOME_DIR", "$here/" );

  // Add Home directory and PHP directory to the include path
  $current_path = ini_get( "include_path" );
  ini_set( "include_path", "$current_path:$here:$php" ); 

  // Set HOME_PATH using the url for this page.
  if ( isset( $_SERVER[ "PHP_SELF" ] ) )
    define( "HOME_PATH", dirname( $_SERVER[ "PHP_SELF" ] ) . '/' );
  else
    define( "HOME_PATH", '/' );
  
  // Include required routines
  require_once( "display_page.php" );
  require_once( "html_funcs.php" );
  
  // Get any arguments passed
  $name = getarg( "p", "home" ); 
  
  // Display the requested page
  displayPage( $name, array($here, "$here/docs", "$here/dev" ) );
?>
