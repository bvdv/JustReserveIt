<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/header.php';

require_staff_login();
//only for admin
if (($_SESSION['role'] !== '2') && (isset($_SESSION['user_id']))) {
    redirect_to("/src/rooms/rooms.php");
}

if (!isset($_GET['id'])) {
    redirect_to("/src/rooms/rooms.php");
}
$id = $_GET['id'];
$room = Room::find_by_id($id);
if ($room == false) {
    redirect_to("/src/rooms/rooms.php");
}

if (is_post_request()) {
  // Delete room
    $result = $room->delete();
    $_SESSION['message'] = 'The room was deleted successfully.';
    redirect_to("/src/rooms/rooms.php");
} else {
  // Display form
}

?>

<div class="container">
    <?php echo display_session_message(); ?>
  <a class="back-link" href="/src/rooms/rooms.php">&laquo; Back </a>
  <h1>Delete Room</h1>
    <p>Are you sure you want to delete this room?</p>
    <p class="item"><?php echo h($room->name()); ?></p>
    <form action="/src/rooms/delete_room.php?id=<?php echo h(u($id)); ?>" method="post">
      <div id="operations">
        <input class="btn btn-lg btn-primary btn-block" type="submit" name="commit" value="Delete Room" />
      </div>
    </form>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/footer.php';
?>
