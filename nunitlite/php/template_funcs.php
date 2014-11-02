<?php

// Methods intended to be called from an included page

function currentPageName( $format=false )
{
   global $CurrentPageName;
   if ( $format ) 
      return format_page_name( $CurrentPageName );
   else
      return $CurrentPageName;
}

function currentPageDirectory()
{
  global $CurrentPageDirectory;
  return $CurrentPageDirectory;
}

function activeButton()
{
   global $ActiveButton;
   return $ActiveButton;
}

function nunitRelease()
{
   global $NUnitRelease;
   return $NUnitRelease;
}

// Embed a link to another NUnit page. Use this form
// for a non-documentation page. Alternatively, just
// code the link directly in the HTML.
function nunit_link( $name, $text, $class="" )
{
  return hlink( "index.php?p=$name", $text, $class="" );
}

// Embed a link to an NUnit documentation page, without
// bothering to specify the release - this allows simply
// copying pages from one release to another, without
// changing the release numbers.
function nunit_doc_link( $name, $text, $class="", $rel="" )
{
   if ( $rel == "" ) $rel = nunitRelease();
   return hlink( "index.php?p=$name", $text, $class );
   /*return hlink( "index.php?p=$name&r=$rel", $text, $class );*/
}

// Embed a link to a file in the main NUnit files directory
function nunit_file( $filename, $text="", $class="" )
{
   if ( $text == "" ) $text = $filename;
   return hlink( "files/$filename", $text="", $class );
}

// Embed a link to a file associated with a particular
// release of the documentation.
function nunit_doc_file( $filename, $text="", $class="" )
{
   global $NUnitRelease;
   
   if ( $text == "" ) $text = $filename;
   return hlink( "docs/$NUnitRelease/files/$filename", $text, $class );
}

// Embed an image tag referring to an image in the main
// NUnit image directory.
function nunit_img( $filename, $title="" )
{
   if ( $title == "" )
   	  return "<img src=\"img/$filename\">";
   else
      return "<img src=\"img/$filename\" alt=\"$title\" title=\"$title\">";
}

// Embed an image tag for an image associated with a 
// particular release of the documentation
function nunit_doc_img( $filename, $title="" )
{
   global $NUnitRelease;
   
   $path = "docs/$NUnitRelease/img/$filename";
   if ( $title == "" )
   	  return "<img src=\"$path\">";
   else
      return "<img src=\"$path\" alt=\"$title\" title=\"$title\">";
}

// Display the current page using a particular template.
// The template is first looked for in the directory
// containing the page. If not found, the path is used.
function getTemplate( $fileName )
{
  global $CurrentPageDirectory;
  $dir = $CurrentPageDirectory;
  if ( $dir != "" && file_exists( $dir . $fileName ) )
     include( $dir . $fileName );
  else
     include( $fileName );
}

function getHeader()
{
   getTemplate( "header.php" );
}

function getNavBar($active=NULL)

{  global $ActiveButton;
   if ( $active != NULL )
      $ActiveButton = $active;
   
   getTemplate( "navbar.php" );
}

function getFooter()
{
   getTemplate( "footer.php" );
}

function getSidebar()
{
   getTemplate( "sidebar.php" );
}

function getMenu()
{
   DrawMenu( currentPageDirectory() . "sub_menu.txt" );
}

?>
