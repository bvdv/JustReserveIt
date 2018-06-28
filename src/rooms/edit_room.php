<?php

include $_SERVER['DOCUMENT_ROOT'] . "/src/header.php";

require_staff_login(); 
//only for admin
if( ($_SESSION['role'] !== '2') && (isset($_SESSION['user_id'])) ) {
  redirect_to("/src/rooms/rooms.php");
}


if(!isset($_GET['id'])) {
  redirect_to("/src/rooms/rooms.php");
}
$id = $_GET['id'];
$room = Room::find_by_id($id);
if($room == false) {
  redirect_to("/src/rooms/rooms.php");
}

if(is_post_request()) {

  // Save record using post parameters
  $args = $_POST['room'];
  $room->merge_attributes($args);
  $result = $room->save();

  if($result === true) {
    $_SESSION['message'] = 'The room was updated successfully.';
    redirect_to("/src/rooms/show_room.php?id=" . $id);
  } else {
    // show errors
  }

} else {

  // display the form

}

?>

<div class="container">
  <?php echo display_session_message(); ?>

  <a class="back-link" href="/src/rooms/rooms.php">&laquo; Back</a>
   <h3>Edit Room</h3>
     <?php echo display_errors($room->errors); ?>
     <form class="form-signin-reg" action="/src/rooms/edit_room.php?id=<?php echo h(u($id)); ?>" method="post">
      <input type="text" class="form-control" name="room[room_name]" value="<?php echo h($room->room_name); ?>" placeholder="Room title">

      <input type="number" class="form-control" name="room[bed_num]" value="<?php echo h($room->bed_num); ?>" placeholder="Bed number" min="1" >

      <input type="text" class="form-control" name="room[overview]" value="<?php echo h($room->overview); ?>" placeholder="Overview" >

      <div id="operations">
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Edit Room" />
      </div>
    </form>
</div>

<?php 
include $_SERVER['DOCUMENT_ROOT'] . ('/src/footer.php'); 
?>
