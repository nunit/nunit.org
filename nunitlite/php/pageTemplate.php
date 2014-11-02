<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0//EN\">
<html>
<!-- Standard Head Part -->
<head>
<title>NUnitLite - <?php echo currentPageName(true) ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta http-equiv="Content-Language" content="en-US">
<link rel="stylesheet" type="text/css" href="nunitlite.css">
<link rel="shortcut icon" href="favicon.ico">
</head>
<!-- End Standard Head Part -->

<body>

<?php getHeader(); ?>

<div id="content">

<?php include ( currentPageDirectory() . currentPageName() . ".html" ); ?>

</div>

<?php if ( file_exists( currentPageDirectory() . "sub_menu.txt" ) ) getSidebar(); ?>

<?php getFooter(); ?>

</body>

</html>
