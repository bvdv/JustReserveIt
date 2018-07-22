<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/header.php';

$rooms = Room::find_all();
$reservations = Reservations::find_all();
?>



<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/footer.php';
