<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN">
<html>
<!-- Standard Head Part -->
<head>
<title>NUnit - HTML Generation Results</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-US">
<link rel="stylesheet" type="text/css" href="nunit.css">
<link rel="shortcut icon" href="favicon.ico">
<style type="text/css"><!--
--></style>
</head>
<!-- End Standard Head Part -->

<body>
<!-- Standard Header for NUnit.org -->
<div id="header">
  <a id="logo" href="index.html"><img src="img/logo.gif" alt="NUnit.org"></a>
  <div id="nav">
    <a href="index.php">NUnit Home</a>
    <a class="active" href="control.php">Control Panel</a>
  </div>
</div>
<!-- End of Header -->

<div id="content">

<?php
  require_once( "display_page.php" );
  
  function GetPageAsHtml( $pagename, $release )
  {
    global $NUnitRelease;
    $NUnitRelease = $release;
    $home = HOME_DIR;
    $html_dirs = array( $home, "$home/resources", "$home/develop" );
    if ( $release != "" ) array_push( $html_dirs, "$home/docs/$release" );
	
    // Start buffering output
    ob_start();
    DisplayPage( $pagename, $html_dirs );

    // Grab the buffer and close it
    $html = ob_get_contents(); 
    ob_end_clean();

    return $html;
  }

  function SaveHtmlToFile( $html, $path )
  {
      $file = fopen( $path, 'w' );
	  fputs( $file, '<!-- saved from url=(0014)about:internet -->');
      fputs( $file, $html );
      fclose( $file );
  }

  function SavePageAsHtml( $pagename, $path, $mode, $nunitRelease='' )
  {
      // Generate the html for each page
      $html = GetPageAsHtml( $pagename, $nunitRelease );

      // Modify page links - first do the special cases for each mode
	  switch( $mode )
	  {
	  case "full":
          $html = eregi_replace( 'index\.php\?p=home', 'index.html', $html );
		  break;
	  case "part":
          $html = eregi_replace( 'index\.php\?p=home', 'index.html', $html );
          $html = eregi_replace( 'index\.php\?p=documentation', 'docHome.html', $html );
		  break;
	  case "docs":
	  case "print":
          $html = eregi_replace( 'index\.php\?p=home', 'http://www.nunit.org', $html );
          $html = eregi_replace( 'index\.php\?p=documentation', 'index.html', $html );
          $html = eregi_replace( "index\.php\?p=docHome&r=$nunitRelease", 'index.html', $html );
		  break;
	  }

	  // These are the same for all modes
	  
	  // Replace links that have release specified
      $pattern = '{index\.php\?p=([^ &]+)\&r=([^ "]+)}'; // Check out this pattern
      $replace = 'docs/\\2/\\1.html';
      $html = preg_replace( $pattern, $replace, $html );

      // Replace other links
	  $pattern = '{index.php\?p=([^ "]+)}'; // Check out this pattern
      $replace = '\\1.html';
      $html = preg_replace( $pattern, $replace, $html );

      // Make all links relative by removing base part of path
	  $html = preg_replace( '{' . NUNIT_PATH . '}', '', $html );

      // Additional replacements for doc files
	  if ( $nunitRelease != '' )
      {
          $html = eregi_replace( "docs/$nunitRelease/" , '', $html );
	  
          switch ( $mode )
		  {
		  case 'full':
		      // Handle links from one version to another - shouldn't be any now
    	      //$html = preg_replace( '{docs/([^/]+)/}' , '../\\1/', $html );
			  
			  // Handle links to main directory
              $html = eregi_replace( 'index.html', '../../index.html', $html );
              $html = eregi_replace( 'download.html', '../../download.html', $html );
              $html = eregi_replace( 'documentation.html', '../../documentation.html', $html );
              $html = eregi_replace( 'community.html', '../../community.html', $html );
              $html = eregi_replace( 'resources.html', '../../resources.html', $html );
              $html = eregi_replace( 'contactUs.html', '../../contactUs.html', $html );
          	  break;

		  case 'print':
		      // Replace navigation block with a title
              $pattern = '{<div id="nav">.*</div>}siU';
			  $replace = "<h1 style=\"margin: 25px 0 10px 200px\">Using NUnit $nunitRelease</h1>";
			  $html = preg_replace( $pattern, $replace, $html );
			  
		      // Remove sidebar completely
			  $pattern = '{<!-- Submenu -->.*<!-- End of Submenu -->}siU';
			  $html = preg_replace( $pattern, '', $html );
			  		  
			  // Make the content fill the whole page width
			  $pattern = '{<div id="content">}';
			  $replace = '<div id="content" style="margin-right: 0">';
			  $html = preg_replace( $pattern, $replace, $html );
			  
			  // Same thing for the footer
			  $pattern = '{<div id="footer">}';
			  $replace = '<div id="footer" style="margin-right: 5%">';
			  $html = preg_replace( $pattern, $replace, $html );
			  
			  // Replace any links to our main pages - add others?
			  $html = eregi_replace( 'download.html', 'http://www.nunit.org/download.html', $html );
			  break;
			  
          case 'docs':
		   	  // Replace navigation block with simpler one
              $pattern = '{<div id="nav">.*</div>}siU';
              $replace = '<div id="nav">
    <a href="http://www.nunit.org">NUnit</a>
    <a class="active" href="index.html">Documentation</a>
  </div>';
              $html = preg_replace( $pattern, $replace, $html );
			  
			  // Replace any links to our main pages - add others?
			  $html = eregi_replace( 'download.html', 'http://www.nunit.org/download.html', $html );
          }
      }
  
      // Save the file
      SaveHtmlToFile( $html, $path );
  }

 /* function RemoveDir( $path )
  {
    if ( file_exists( $path ) )
    {
      unlink( $path );
    }
  }*/

  function CreateDir( $path )
  {
    if ( file_exists( $path ) ) 
    {
      echo "$path already exists<br>\n";
    }
    else 
    {
      mkdir( $path );
      echo "Creating $path<br>\n"; 
    }
  }
  
  function ProcessMainDirectory( $mode )
  {
    // Each html file in HOME_DIR is expanded
    // to a complete page in TARGET_DIR
    echo "<h4>Processing Main Directory</h4>\n<blockquote>\n"; 
    //RemoveDir( TARGET_DIR ); 
    CreateDir( TARGET_DIR );

    $dir = opendir( HOME_DIR );
	while( $filename = readdir( $dir ) )
        if ( is_file( HOME_DIR . $filename ) )
          if ( eregi( '\.html', $filename ) )
          {
            $pagename = eregi_replace( '\.html', '', $filename );
            if ( $pagename == 'home' )
              $filename = 'index.html';

            // Ignore documentation page if mode == part
            if ( $mode == 'full' || $pagename != 'documentation'  )
            {
                echo "creating $filename<br>\n";
                // Create and save the page
                SavePageAsHtml( $pagename, TARGET_DIR . $filename, $mode );
            }
     }
	   
      CopyFile ( HOME_DIR, TARGET_DIR, "nunit.css" );
      echo "</blockquote>\n";
  }

  function ProcessAllDocumentation()
  {
    // Each html file in the documentation directory is
    // expanded to a complete page while others are copied
    echo "<h4>Processing Documentation Directory</h4><blockquote>\n";
    CreateDir( TARGET_DOCS_DIR );
    echo "</blockquote>\n";

	$docsdir = opendir( NUNIT_DOCS_DIR );
	$releases = array();
	while ( $release = readdir( $docsdir ) )
	{
	 	  if ( is_dir( NUNIT_DOCS_DIR . $release ) && $release > '2.1' )
		     array_push( $releases, $release );
	}
			   
	sort( $releases );
			   
    // There should be a line here for each link in the documentation.html file
	foreach( $releases as $release )
	   CopyDocumentation( $release, "full", TARGET_DOCS_DIR . "$release/" );
	   
  }

  function CopyDocumentation( $docRelease, $mode, $target )
  {
    echo "<h4>Copying NUnit $docRelease Documentation</h4><blockquote>\n";
    $source = NUNIT_DOCS_DIR . "$docRelease/";
    CreateDir( $target ); 
    
    $file = fopen( $source . "sub_menu.txt", 'r' );
    while( $line = fgets( $file ) )
    {
        if ( $line[0] != '#' )
        {  
           $line = trim( $line );
           $parts = split( ',', $line );
           $pagename = $parts[0];
           $filename = $pagename . ".html";
           if ( $pagename == 'docHome' )
		   	  if ( $mode == 'docs' || $mode == 'print' )
               $filename = 'index.html';
 
           echo "creating $filename<br>\n";
           SavePageAsHtml( $pagename, $target . $filename, $mode, $docRelease );
    	  }
    }
    CopyFile( HOME_DIR, $target, "nunit.css" );
	CopyFile( HOME_DIR, $target, "codeFuncs.js" );
	CopyFile( HOME_DIR, $target, "favicon.ico" );
    echo "</blockquote>\n";


    echo "<h4>Copying NUnit $docRelease Files</h4><blockquote>\n";
    CreateDir( $target . "files/" );
	CopyDirectory( $source . "files/", $target . "files/" );
    echo "</blockquote>\n";

    echo "<h4>Copying NUnit $docRelease Images</h4><blockquote>\n";
    CreateDir( $target . "img/" );
    CopyDirectory( $source . "img/", $target . "img/" );   
    echo "</blockquote>\n";
  }

  function CopyDirectory( $inDir, $outDir )
  {
    $dir = opendir( $inDir );
    while( $filename = readdir( $dir ) )
      if ( is_file( $inDir . $filename ) && $filename != 'Thumbs.db' )
        CopyFile( $inDir, $outDir, $filename );
  }

  function CopyFile( $sourceDir, $targetDir, $filename )
  {
    echo( "copying $filename<br>\n" );
    copy( $sourceDir . $filename, $targetDir . $filename );
  }

  function ProcessFilesDirectory()
  {
    echo "<h4>Processing Files Directory</h4>\n<blockquote>\n";
    CreateDir( TARGET_FILES_DIR );
    CopyDirectory( NUNIT_FILES_DIR, TARGET_FILES_DIR );
    echo "</blockquote>\n";
  }

  function ProcessImageDirectory( $mode )
  {
    echo "<h4>Processing Images</h4>\n<blockquote>\n";
    CreateDir( TARGET_IMAGE_DIR );
	if ( $mode=="docs" || $mode=='print' )
	{
	  CopyFile( NUNIT_IMAGE_DIR, TARGET_IMAGE_DIR, "logo.gif" );
	  CopyFile( NUNIT_IMAGE_DIR, TARGET_IMAGE_DIR, "langfilter.gif" );
	  CopyFile( NUNIT_IMAGE_DIR, TARGET_IMAGE_DIR, "bulletOn.gif" );
	  CopyFile( NUNIT_IMAGE_DIR, TARGET_IMAGE_DIR, "bulletOff.gif" );
	}
	else
      CopyDirectory( NUNIT_IMAGE_DIR, TARGET_IMAGE_DIR );
    echo "</blockquote>\n";
  }
  
  // Main Program handles each type of build separately

  $mode = getarg( "m", "full" );
  $release = getarg( "r", "2.2" );
	
  switch( $mode )
  {
  case "full":
    echo "<h2>Generate Static HTML - Full Site</h2>";
    ProcessMainDirectory( $mode );
    ProcessImageDirectory( $mode );
    ProcessAllDocumentation();
	break;
	
  case "part":
    echo "<h2>Generate Static HTML - NUnit $release Site</h2>";
    ProcessMainDirectory( $mode );
    ProcessImageDirectory( $mode );
    CopyDocumentation( $release, $mode, TARGET_DIR );
  	break;
	
  case "docs":
    echo "<h2>Generate Static HTML - NUnit $release Docs</h2>";
    CopyDocumentation( $release, $mode, TARGET_DIR );
    break;

  case "print":
    echo "<h2>Generate Static HTML for Printing - NUnit $release Docs</h2>";
    CopyDocumentation( $release, $mode, TARGET_DIR );
    break;
  }

?>
    
</div>
  
<div id="subnav">
<ul>
  <li id="current"><a href="control.php">Control Panel</a></li>
  <ul>
    <li <?php echo $mode=='full' ? 'id="current"' : '' ?>><a href="control.php?p=generate&mode=full">Full Site</a></li>
    <li <?php echo $mode=='part' ? 'id="current"' : '' ?>><a href="control.php?p=selectRelease&m=part">Single Release Site</a></li>
    <li <?php echo $mode=='docs' ? 'id="current"' : '' ?>><a href="control.php?p=selectRelease&m=docs">Release Documentation</a></li>
    <li <?php echo $mode=='print' ? 'id="current"' : '' ?>><a href="control.php?p=selectRelease&m=print">Print Documentation</a></li>
    <li><a href="<?php echo TARGET_PATH ?>">View Generated HTML</a></li>
  </ul>
</div>

<!-- Standard Footer for NUnit.org -->
<div id="footer">
  Copyright &copy; 2002-2005. All Rights Reserved.
</div>
<!-- End of Footer -->


</body>
</html>
