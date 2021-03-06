<?php

//Are we live?
if(!defined('LIVE')) DEFINE('LIVE', false);

//errors are emailed here:
DEFINE('CONTACT_EMAIL', 'autoharp319@gmail.com');

//Determine location of files and the URL of the site:
define ('BASE_URI', 'D:\\inetpub\\wwwroot\\LocalUser\\caolson\\WEB260\\ex2-2\\');
define ('BASE_URL', 'wcet3.waketech.edu/caolson/WEB260/ex2-2');
define ('MYSQL', BASE_URI . '/includes/mysql.inc.php');

define('BOX_BEGIN', '<!-- box begin --><div class="box alt">
  <div class="left-top-corner"><div class="right-top-corner">
  <div class="border-top"></div></div></div><div class="border-left">
  <div class="border-right"><div class="inner">');
define('BOX_END', '</div></div></div><div class="left-bot-corner">
  <div class="right-bot-corner"><div class="border-bot"></div>
  </div></div></div><!-- box end -->');


//Error Handler
function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars) {
  //Build the error message:
  $message = "An error occurred in script '$e_file' on line $e_line:\n$e_message\n";
  //Add the backtrace:
  $message .= "<pre>" . print_r(debug_backtrace(), 1) . "</pre>\n";
  //Or just append $e_vars to the message:
  //$message .= "<pre>" . print_r ($e_vars. 1) . "</pre>\n";

  if (!LIVE) {
    //Show the error in the browser
    echo '<div class="error">' . nl2br($message) . '</div>';
  } else { //Development (print the error).
    //Send the error in an email:
    error_log($message, 1, CONTACT_EMAIL, 'From:caolson@my.waketech.edu');
    //Only print an error message in the browser if the error isn't a notice:
    if ($e_number != E_NOTICE) {
      echo '<div class="error">A system error occurred. We appologize for the inconvenience.</div>';
    }
  } //End of $live IF-ELSE.

  return true; //So that PHP doesn't try to handle the error too.

} //End of my_error_handler() definition

//Use my error handler:
set_error_handler ('my_error_handler');
