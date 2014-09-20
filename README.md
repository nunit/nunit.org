NUnit Website
=============

This repo contains the code of the existing NUnit website, which is expected to be replaced before the final release 
of NUnit 3.0. Major changes and reorganization should not be done here, but should wait until the new site is set up.

Until that time, we are using this repo so that all contributors can update the documentation. Once an update has
been made, the new or changed pages must be manually uploaded to the live site. Contact Charlie to do this.

Updating Documentation
======================
Documentation is contained in the docs directory, with a subdirectory for each NUnit release. It is in the form of html
fragments with a small amount of embedded php code. Functions used in the html may be found at php/html_funcs.php.

If you start updating a page that has not had any changes for a while, you may find that it contains only a single
line, similar to this...

              <?php unchangedSince("2.5.9") ?>
              
In such a case, you should first replace the file with a copy of the same file name under the subdirectory pointed to.
In the above case, you would copy docs/2.5.9/FILENAME.html to replace the file in the version you are working on.
After you have done that, you can continue to edit the file. You should not change the original file (e.g. 2.5.9) since
it provides a record of the docs from that release and is also being used by all subsequent releases.


