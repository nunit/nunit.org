<?php getHeader(); ?>

<div id="content">

<?php include ( currentPageDirectory() . currentPageName() . ".html" ); ?>

</div>

<?php if ( file_exists( currentPageDirectory() . "sub_menu.txt" ) ) getSidebar(); ?>

<?php getFooter(); ?>