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

<div id="content">
  
    <h2>HTML Generation</h2>
   
    <form>
      <input type="hidden" name="p" value="generate">
      <table>
        <tr>
          <td><input type="radio" name="m" value="full" checked></td>
          <td>Generate full site with multiple releases of documentation</td>
        </tr>
        <tr>
          <td><input type="radio" name="m" value="part"></td>
          <td>Generate web site for a single release of NUnit</td>       
        </tr>
        <tr>
          <td><input type="radio" name="m" value="docs" onclick="ShowFull()"></td>
          <td>Generate documentation for a single release of NUnit</td>       
        </tr>
        <tr height="40">
          <td>&nbsp;</td>
          <td>Release for single-release options:  
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
    <li id="current"><a href="control.php?p=htmlGeneration">Html Generation</a></li>
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


