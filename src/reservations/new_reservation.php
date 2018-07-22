<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/header.php';
//for staff and users
require_login();

if (isset($_SESSION['role']) || isset($_SESSION['user_id'])) {
  // Do nothing, let the rest of the page proceed
} else {
    redirect_to("/public/index.php");
}
?>

<?php

if (!isset($_GET['id'])) {
    redirect_to("/src/rooms/rooms.php");
}
$id = $_GET['id'];
$room = Room::find_by_id($id);

if (($room == false)) {
    redirect_to("/src/rooms/rooms.php");
}

if (is_post_request()) {
// Create record using post parameters
    $args = $_POST['reservation'];
    $reservation = new Reservation($args);

    $reservation->room_id = $room->id;
    $reservation->room_name = $room->room_name;
    $result = $reservation->save();

    if ($result === true) {
        $reservation_id = $reservation->id;
        $session->message('The room was reserved successfully.');
        redirect_to("/src/reservations/show_reservation.php?id=" . $reservation_id);
    } else {
      // show errors
    }
} else {
  // display the form
    $reservation = new Reservation;
}
?>


<div class="container">
 
    <?php echo display_session_message(); ?>
  <a class="back-link" href="/src/rooms/rooms.php">&laquo; Back </a>
    <h3>Reserve it!</h3>
      <div class="attributes">
        <dl>
          <dt>Room title</dt>
          <dd><?php echo h($room->name()); ?></dd>
        </dl>        
        <dl>
          <dt>Bed num</dt>
          <dd><?php echo h($room->bed_num); ?></dd>
        </dl>
        <dl>
          <dt>Overview</dt>
          <dd><?php echo h($room->overview); ?></dd>
        </dl>      
      </div>

  <form action="/src/reservations/new_reservation.php?id=<?php echo h(u($id)); ?>" method="post">          
    <p>Choose check-in and check-out date.</p>
    <?php echo display_errors($reservation->errors); ?>
    <input type="date"  name="reservation[check_in]" value="" placeholder="Check-in" required />
    <input type="date" name="reservation[check_out]" value="" placeholder="Check-out" required />
    <br><br>
    <div id="operations">
      <input class="btn btn-primary btn-block" type="submit" value="Reserve Room" />
    </div>
  </form>

</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/footer.php';
?>
