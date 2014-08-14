<?php

// Determine value of a query variable
function getarg( $name, $default="" )
{
  if ( isset($_GET[$name]) )
        return $_GET[$name];
        
  return $default;
}
  
// Return a hyperlink
function hlink($href, $text="", $class="")
{
  if ($text=="") $text = $href;
  
  if ($class == "")
  {
    return "<a href=\"$href\">$text</a>";
  }
  else
  {
    return "<a href=\"$href\" class=\"$class\">$text</a>";
  }
}

// Translate lower case page names into a more friendly
// display format for use in navigation buttons, etc.
function format_page_name( $name, $lang="" )
{
  $text = ucwords( str_replace( "_", " ", $name ) );
  $text = str_replace( " ", "&nbsp;", $text );
  
  return $text;
}

?>