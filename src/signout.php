<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/config/initialize.php" ;

// Log out the admin
$session->logout();

redirect_to("/public/index.php");

?>