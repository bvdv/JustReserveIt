<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/header.php';

require_staff_login();
//only for admin
if (($_SESSION['role'] !== '2') && (isset($_SESSION['user_id']))) {
    redirect_to("/src/rooms/rooms.php");
}

if (is_post_request()) {
  // Create record using post parameters
    $args = $_POST['room'];
    $room = new Room($args);
    $result = $room->save();

    if ($result === true) {
        $new_id = $room->id;
        $session->message('The room was added successfully.');
        redirect_to("/src/rooms/show_room.php?id=" . $new_id);
    } else {
      // show errors
    }
} else {
  // display the form
    $room = new Room;
}

?>

<div class="container">
  <br>
  <a class="back-link" href="/src/rooms/rooms.php">&laquo; Back to </a>
  <br><br>
  <h3>Add Room</h3>

    <?php echo display_errors($room->errors); ?>

  <form class="form-signin-reg" action="/src/rooms/new_room.php" method="post">

    <input type="text" class="form-control" name="room[room_name]" value="<?php echo h($room->room_name); ?>" placeholder="Room title">

    <input type="number" class="form-control" name="room[bed_num]" value="<?php echo h($room->bed_num); ?>" placeholder="Bed number" min="1" >

    <input type="text" class="form-control" name="room[overview]" value="<?php echo h($room->overview); ?>" placeholder="Overview" >   

    <div id="operations">
      <input class="btn btn-lg btn-primary btn-block" type="submit" value="Add Room" />
    </div>
  </form>
</div>  

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/footer.php';
?>
