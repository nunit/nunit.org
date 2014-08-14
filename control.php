<?php 
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
  if ( isset( $_SERVER[ "PHP_SELF" ] ) )
    define( "NUNIT_PATH", dirname( $_SERVER[ "PHP_SELF" ] ) . '/' );
  else
    define( "NUNIT_PATH", '/' );
  
    // The following are only used for file generation
  define( "NUNIT_FILES_DIR", HOME_DIR . "files/" );
  define( "NUNIT_IMAGE_DIR", HOME_DIR . "img/" );
  define( "NUNIT_DOCS_DIR", HOME_DIR . "docs/" );

  // Target directories for Generating Static content
  define( "TARGET_DIR", HOME_DIR . "static/" );
  define( "TARGET_FILES_DIR", TARGET_DIR . "files/" );
  define( "TARGET_IMAGE_DIR", TARGET_DIR . "img/" );
  define( "TARGET_DOCS_DIR", TARGET_DIR . "docs/" );

  // URL for viewing the generated html
  define( "TARGET_PATH", NUNIT_PATH . "static/" );

  // Include required routines
  require_once( "display_page.php" );
  require_once( "html_funcs.php" );
  
  // Get any arguments passed
  $name = getarg( "p", "controlPanel" ); 
  
// Display the requested page
  include( "control/$name.php" );
?>
