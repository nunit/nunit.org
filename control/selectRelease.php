<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN">
<html>
<!-- Standard Head Part -->
<head>
<title>NUnit - HTML Generation</title>
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

<?php
  require_once( "template_funcs.php" );
?>

<div id="content">
  
<?php
  $mode = getarg("m", "docs");
  switch( $mode )
  {
  case "part":
    echo '<h2>HTML Generation - Single Release Site</h2>';
    break;
  case "docs":
    echo '<h2>HTML Generation - Release Documentation</h2>';
	break;
  case "print":
    echo '<h2>HTML Generation - Documentation for Printing</h2>';
    break;
  }
?>

    <form>
      <input type="hidden" name="p" value="generate">
	  <input type="hidden" name="m" value="<?php echo getarg("m", "docs") ?>">
      <table>
        <tr height="40">
          <td>&nbsp;</td>
          <td>Select Release:  
            <select name="r" width="30" >
			
	   		<?php 
	  		   $docsdir = opendir( NUNIT_DOCS_DIR );
	  		   $releases = array();
	  		   while ( $release = readdir( $docsdir ) )
	  		   {
	     	   	  if ( is_dir( NUNIT_DOCS_DIR . $release ) && $release > '2.1' )
	        	     array_push( $releases, $release );
	  		   }
			   
			   sort( $releases );
			   
			   foreach( $releases as $release )
			      echo "<option>$release</option>\n";
			?>
               
            </select>
          </td>
        </tr>
        <tr height="40">
          <td colspan="2" align="right"><input type="submit" value="Generate HTML"></td>
        </tr>
      </table>
    </form>
	
</p>

</div>

<div id="subnav">
<ul>
  <li id="current"><a href="control.php">Control Panel</a></li>
  <ul>
    <li><a href="control.php?p=generate&mode=full">Full Site</a></li>
    <li <?php echo $mode=='part' ? 'id="current"' : '' ?>><a href="control.php?p=selectRelease&m=part">Single Release Site</a></li>
    <li <?php echo $mode=='docs' ? 'id="current"' : '' ?>><a href="control.php?p=selectRelease&m=docs">Release Documentation</a></li>
    <li <?php echo $mode=='print' ? 'id="current"' : '' ?>><a href="control.php?p=selectRelease&m=print">Print Documentation</a></li>
  </ul>
</div>

<!-- Standard Footer for NUnit.org -->
<!--<div id="footer">
  Copyright &copy; 2002-2005. All Rights Reserved.
</div>-->
<?php echo getFooter() ?>
<!-- End of Footer -->


</body>
</html>


