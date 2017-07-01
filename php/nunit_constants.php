<?php

/*
    Set constants for NUnit. NUnit_PATH and NUNIT_DIR
	must be defined before this file is included.
*/

  // Default NUnit Version for this site
  define( "CURRENT_NUNIT_RELEASE", "2.4" );

  // PHP Directory
  define( "PHP_DIR", NUNIT_DIR . "php/" );

  // NUnit paths, for use in URLs
  define( "NUNIT_FILES_PATH", NUNIT_PATH . "files/" );
  define( "NUNIT_IMAGE_PATH", NUNIT_PATH . "img/" );
  define( "NUNIT_DOCS_PATH", NUNIT_PATH . "docs/" );
  define( "CURRENT_DOCS_PATH", NUNIT_DOCS_PATH . CURRENT_NUNIT_RELEASE . '/' );
  
  // NUnit directories, for use in accessing file system
  define( "TARGET_DIR", NUNIT_DIR . "static/" );
  define( "NUNIT_FILES_DIR", NUNIT_DIR . "files/" );
  define( "NUNIT_IMAGE_DIR", NUNIT_DIR . "img/" );
  define( "NUNIT_DOCS_DIR", NUNIT_DIR . "docs/" );
  define( "CURRENT_DOCS_DIR", NUNIT_DOCS_DIR . CURRENT_NUNIT_RELEASE . '/' );

  // Target directory for Generating Static content
  define( "TARGET_FILES_DIR", TARGET_DIR . "files/" );
  define( "TARGET_IMAGE_DIR", TARGET_DIR . "img/" );
  define( "TARGET_DOCS_DIR", TARGET_DIR . "docs/" );
  define( "CURRENT_TARGET_DOCS_DIR", TARGET_DOCS_DIR . CURRENT_NUNIT_RELEASE . '/' );

  // URL for viewing the generated html
  define( "TARGET_PATH", NUNIT_PATH . "static/" );

  // NUnit logo and icon
  define("NUNIT_ICON", NUNIT_PATH ."favicon.ico" );
  
  // NUnit stylesheet
  define( "NUNIT_STYLESHEET", "nunit.css" );
  define( "NUNIT_STYLESHEET_DBG", "nunitDBG.css" );
  
  // NUnit copyright notices  
  define("NUNIT_COPYRIGHT_NOTICE", "Copyright &copy; 2002-2005. All Rights Reserved.");
  define("NUNIT_COPYRIGHT_NOTICE_OLD", "Copyright &copy; 2002-2004 James W. Newkirk, Alexei A. Vorontsov. All Rights Reserved.");

?>
