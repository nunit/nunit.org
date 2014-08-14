<?php 
  // Main entry for the NUnit website.
  global $NUnitRelease;
  
  ini_set( "display_errors", 1 );
  
  // Define base directory locations used
  $here = dirname( __FILE__ );
  define ( "HOME_DIR", "$here/" );

  // Add Home directory and PHP directory to the include path
  $current_path = ini_get( "include_path" );
  if ( ! defined( "PATH_SEPARATOR" ) ) 
  {
    if ( strpos( $_ENV[ "OS" ], "Win" ) !== false )
      define( "PATH_SEPARATOR", ";" );
    else define( "PATH_SEPARATOR", ":" );
  }
  
  ini_set( "include_path", $current_path . PATH_SEPARATOR . $here . PATH_SEPARATOR . $here . DIRECTORY_SEPARATOR . "php" ); 
  
  // Set NUNIT_PATH using the url for this page.
  /*if ( isset( $_SERVER[ "PHP_SELF" ] ) )
    define( "NUNIT_PATH", dirname( $_SERVER[ "PHP_SELF" ] ) . '/' );
  else
    define( "NUNIT_PATH", '/' );*/
  
  // Include required routines
  require_once( "display_page.php" );
  require_once( "html_funcs.php" );
  
  // Get any arguments passed
  $name = getarg( "p", "home" ); 
  $rel = getarg( "r", "" );
  
  $NUnitRelease = $rel;
  $html_dirs = array( $here );
  if ( $rel != "" )
    array_push( $html_dirs, "$here/docs/$rel" );

  // Display the requested page
  displayPage( $name, $html_dirs );
?>
