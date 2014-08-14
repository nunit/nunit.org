<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN">
<html>
<!-- Standard Head Part -->
<head>
<title>NUnit - <?php echo currentPageName(true); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-US">
<meta name="norton-safeweb-site-verification" content="tb6xj01p4hgo5x-8wscsmq633y11-e6nhk-bnb5d987bseanyp6p0uew-pec8j963qlzj32k5x9h3r2q7wh-vmy8bbhek5lnpp5w4p8hocouuq39e09jrkihdtaeknua" />
<link rel="stylesheet" type="text/css" href="nunit.css">
<link rel="shortcut icon" href="favicon.ico">
</head>
<!-- End Standard Head Part -->

<body>

<!-- Standard Header for NUnit.org -->
<div id="header">
  <a id="logo" href="index.php?p=home"><img src="img/logo.gif" alt="NUnit.org" title="NUnit.org"></a>
  <div id="nav">
  
<?php
  drawNavButton( "home" );
  drawNavButton( "download" );
  drawNavButton( "documentation" );
/*
  drawNavButton( "extensions" );
  drawNavButton( "resources" );

  drawNavButton( "community", "Development" );
 */
  if (isWikiOffline())
    drawNavButton( "wiki", "Wiki", "#", "disabled" );
  else
    drawNavButton( "wiki", "Wiki", "./wiki" );

  if (file_exists("./blogs"))
    drawNavButton( "blog", "Blog", "./blogs" );
  else
    drawNavButton( "blog", "Blog", "./blogs", "disabled" );

  drawNavButton( "contactUs", "Contact&nbsp;Us" );
?>

  </div>
</div>
<!-- End of Header -->
