<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/header.php';

require_staff_login(); 
// only for admin or controller
if( (($_SESSION['role'] !== '2') && ($_SESSION['role'] !== '1') ) && (isset($_SESSION['user_id'])) ) {
  redirect_to("/src/rooms/rooms.php");
}


if(!isset($_GET['id'])) {
  redirect_to("/src/reservations/reservations.php");
}
$id = $_GET['id'];
$reservation = Reservation::find_by_id($id);
if(($reservation == false)) {
  redirect_to("/src/reservations/reservations.php");
}

if(is_post_request()) {

  // Save record using post parameters
  $args = $_POST['reservation'];
  $args['accepted'] = '1';
  $reservation->merge_attributes($args);
  $result = $reservation->save();

  if($result === true) {
    $_SESSION['message'] = 'The room was accepted successfully.';
    redirect_to("/src/reservations/show_reservation.php?id=" . $id);
  } else {
    // show errors
  }
} else {
  // display the form
}

?>

<div class="container">
  <?php echo display_session_message(); ?>
  <a class="back-link" href="/src/reservations/reservations.php">&laquo; Back </a>
    <h3>Accept reservation</h3>
    
      <div class="attributes">
        <dl>
          <dt>Room title</dt>
          <dd><?php echo h($reservation->name()); ?></dd>
        </dl>
        <dl>
          <dt>Acception status</dt>
          <dd><?php if ($reservation->accepted === '1') {
               echo "Accepted";
             } else {
               echo "Waiting for acceptation";
             }
            ?></dd>
        </dl>
        <dl>
          <dt>Reserved</dt>
          <dd>From: <?php echo h($reservation->check_in); ?></dd>
          <dd>To: <?php echo h($reservation->check_out); ?></dd>    
        </dl>                           
      </div>
      <?php echo display_errors($reservation->errors) . "<br>" ?>
  <form action="/src/reservations/edit_reservation.php?id=<?php echo h(u($id)); ?>" method="post">
    <div id="operations">
      <input class="btn btn-primary btn-block" type="submit" value="Accept reservation" />
    </div>
  </form>
</div>

<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/src/footer.php';
?>
