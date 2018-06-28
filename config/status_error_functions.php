<?php
/*!
  \brief Status error functions
  \author Danil
  \version 1.0
  \date 21.06.2018

  Status error functions
*/

/**
 * { Login function for checking logged user/staff }
 */
function require_login() {
  global $session;
  if(($session->staff_logged_in()) || ($session->user_logged_in())) {
  } else {
    // Do nothing, let the rest of the page proceed
    redirect_to("/public/index.php");
  }  
}

/**
 * { Staff login checking }
 */
function require_staff_login() {
  global $session;
  if(!$session->staff_logged_in()) {
    redirect_to("/public/index.php");
  } else {
    // Do nothing, let the rest of the page proceed
  }
}

/**
 * { User login checking }
 */
function require_user_login() {
  global $session;
  if(!$session->user_logged_in()) {
    redirect_to("/public/index.php");
  } else {
    // Do nothing, let the rest of the page proceed
  }
}

/**
 * { Dunction for display error }
 *
 * @param      array   $errors  Get errors array
 *
 * @return     string  ( return error description )
 */
function display_errors($errors=array()) {
  $output = '';
  if(!empty($errors)) {
    $output .= "<div class=\"errors\">";
    $output .= "Please fix the following errors:";
    $output .= "<ul>";
    foreach($errors as $error) {
      $output .= "<li>" . h($error) . "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
  }
  return $output;
}

/**
 * { Display session msg about create, update, delete }
 *
 * @return     string  ( return msg )
 */
function display_session_message() {
  global $session;
  $msg = $session->message();
  if(isset($msg) && $msg != '') {
    $session->clear_message();
    return '<div id="message">' . h($msg) . '</div>';
  }
}


?>
