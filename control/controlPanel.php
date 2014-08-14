<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN">
<html>
<!-- Standard Head Part -->
<head>
<title>NUnit - Control Panel</title>
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

<!-- Main Content -->
<div id="content">

    <h2>NUnit Control Panel</h2>

    <p>This page is used to generate static versions of the site for use on hosts
	   that do not support PHP or for distribution as release documentation.</p>

    <h3><a href="control.php?p=generate&m=full">Static Website - Multiple Releases</a></h3>
    <p>This option allows you to create a static version of the entire NUnit site,
	   including the documentation for multiple releases of NUnit.</p>
	   
    <h3><a href="control.php?p=selectRelease&m=part">Static Website - Single Release</a></h3>
    <p>This option allows you to create a static version of the NUnit site containing
	   documentation for a single release - usually the latest.</p>
	   
    <h3><a href="control.php?p=selectRelease&m=docs">HTML Documentation for a Release</a></h3>
    <p>This option allows you to create stand-alone HTML documentation for distribution with a release.</p>
	   
    <h3><a href="control.php?p=selectRelease&m=print">HTML Documentation for Printing</a></h3>
    <p>This option allows you to create stand-alone HTML documentation for a release in a format suitable for printing.</p>
	   
    <h3><a href="<?php echo TARGET_PATH ?>">View Static HTML</a></h3>
    This option allows viewing the generated HTML.
    Use the BACK button to return to this page.</p>
</p>

</div>
<!-- End of Main Content -->

<!-- Submenu -->
<div id="subnav">
<ul>
  <li id="current"><a href="control.php">Control Panel</a></li>
  <ul>
    <li><a href="control.php?p=generate&mode=full">Full Site</a></li>
    <li><a href="control.php?p=selectRelease&m=part">Single Release Site</a></li>
    <li><a href="control.php?p=selectRelease&m=docs">Release Documentation</a></li>
    <li><a href="control.php?p=selectRelease&m=print">Print Documentation</a></li>
    <li><a href="<?php echo TARGET_PATH ?>">View Generated HTML</a></li>
  </ul>
</ul>
</div>  
<!-- End of Submenu -->

<!-- Standard Footer for NUnit.org -->
<div id="footer">
  Copyright &copy; 2002-2005. All Rights Reserved.
</div>
<!-- End of Footer -->


</body>
</html>

