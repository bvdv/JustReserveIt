<?php
/*!
  \brief Database connection functios
  \author Danil
  \version 1.0
  \date 21.06.2018

  Database connection functions for initialization
*/

/**
 * { Database connection }
 *
 * @return     mysqli  ( return DB connection )
 */
function db_connect() {
  $connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  confirm_db_connect($connection);
  return $connection;
}


/**
 * { Confirm DB connection }
 *
 * @param      <type>  $connection  The DB connection
 */
function confirm_db_connect($connection) {
  if($connection->connect_errno) {
    $msg = "Database connection failed: ";
    $msg .= $connection->connect_error;
    $msg .= " (" . $connection->connect_errno . ")";
    exit($msg);
  }
}


/**
 * { DB disconection }
 *
 * @param      <type>  $connection  Get the  current connection and disconnect from DB
 */
function db_disconnect($connection) {
  if(isset($connection)) {
    $connection->close();
  }
}

?>
