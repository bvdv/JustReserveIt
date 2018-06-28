<?php
/*!
  \brief Functions list
  \author Danil
  \version 1.0
  \date 21.06.2018

  Functions list
*/

/**
 * { Return server root path }
 *
 * @param      string  $script_path  The script path
 *
 * @return     string  ( Server root path )
 */
function url_for($script_path) {
  // add the leading '/' if not present
  if($script_path[0] != '/') {
    $script_path = "/" . $script_path;
  }
  return WWW_ROOT . $script_path;
}

/**
 * { URL-encodes string }
 *
 * @param      string  $string  The string
 *
 * @return     <type>  ( Returns a string in which all non-alphanumeric characters except -_...  )
 */
function u($string="") {
  return urlencode($string);
}

/**
 * { URL-encode according to RFC 3986 }
 *
 * @param      string  $string  The string
 *
 * @return     <type>  ( Returns a string )
 */
function raw_u($string="") {
  return rawurlencode($string);
}

/**
 * { Convert special characters to HTML entities }
 *
 * @param      string  $string  The string
 *
 * @return     <type>  ( The converted string.  )
 */
function h($string="") {
  return htmlspecialchars($string);
}

/**
 * { 404 Not Found }
 */
function error_404() {
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  exit();
}

/**
 * { 500 Internal Server Error }
 */
function error_500() {
  header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
  exit();
}

/**
 * { Redirect funcion }
 *
 * @param      <type>  $location  Get location for redirect
 */
function redirect_to($location) {
  header("Location: " . $location);
  exit;
}

/**
 * Determines if post request.
 *
 * @return     boolean  True if post request, False otherwise.
 */
function is_post_request() {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

/**
 * Determines if get request.
 *
 * @return     boolean  True if get request, False otherwise.
 */
function is_get_request() {
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}

// PHP on Windows does not have a money_format() function.
// This is a super-simple replacement.
if(!function_exists('money_format')) {
  function money_format($format, $number) {
    return '$' . number_format($number, 2);
  }
}


?>
