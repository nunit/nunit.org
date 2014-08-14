<?php

include( "build_menu.php" );

function drawNavButton( $name, $text="", $url="", $class="" )
{
   global $CurrentPageName;
    
   if ( $text == "" )
     $text = format_page_name( $name );
	 
   if ( $url == "" )
     $url = "index.php?p=$name";
		
   if ( $name == activeButton() )
     $class="active";

   if ( isSiteOffline() )
     echo "<a>$text</a>"; 
   elseif ( $class != "" )
     echo "<a href=\"$url\" class=\"$class\">$text</a>";
   else
     echo "<a href=\"$url\">$text</a>";
}

include( "template_funcs.php" );

function displayPage( $name, $html_dirs=NULL )
{
  global $CurrentPageName;
  global $CurrentPageDirectory;

  // Save name and release in globals
  $CurrentPageName = $name;

  // Initialize directory and type in globals
  $CurrentPageDirectory = HOME_DIR;
  if ( !is_array( $html_dirs ) )
     $html_dirs = array( HOME_DIR );

  // See if the site is offline
  if ( isSiteOffline() )
  {
  	 getTemplate( "offlineTemplate.php" );
  	 return;
  }
  // Make sure the page name is valid, then
  // see whether the page exists and if so, where
  // it is and what type it is...
  if ( preg_match( "/^[a-z0-9\-]*$/i", $name ) )
  {
   	 foreach( $html_dirs as $dir )
	   {
	     if ( file_exists( "$dir/$name.html" ) )
		   {
		     $CurrentPageDirectory = "$dir/";
    			getTemplate( "pageTemplate.php" );
		    	return;
		   }
		 }
  }
	
	// If we come here, display page not found 
  getTemplate( "notfoundTemplate.php" );
}

?>
