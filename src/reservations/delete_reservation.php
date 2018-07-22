<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/header.php';

require_staff_login();
// only for admin or controller
if ((($_SESSION['role'] !== '2') && ($_SESSION['role'] !== '1') ) && (isset($_SESSION['user_id']))) {
    redirect_to("/src/rooms/rooms.php");
}

if (!isset($_GET['id'])) {
    redirect_to("/public/index.php");
}
$id = $_GET['id'];
$reservation = Reservation::find_by_id($id);
if ($reservation == false) {
    redirect_to("/public/index.php");
}

if (is_post_request()) {
    $result = $reservation->delete();
    $session->message('The reservation was declined successfully.');
    redirect_to("/src/reservations/reservations.php");
} else {
  // Display form
}

?>

<div class="container">
    <?php echo display_session_message(); ?>
  <a class="back-link" href="/src/reservations/reservations.php">&laquo; Back </a>
  <h3>Decline Reservation</h3>
  <p>Are you sure you want to decline this reservation?</p>
  <p class="item"><?php echo h($reservation->id); ?></p>
    <form action="/src/reservations/delete_reservation.php?id=<?php echo h(u($id)); ?>" method="post">
      <div id="operations">
        <input class="btn btn-lg btn-primary btn-block" type="submit" name="commit" value="Decline reservation" />
      </div>
    </form>
</div>
  
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/footer.php';
?>
