<?php 

include $_SERVER['DOCUMENT_ROOT'] . "/src/header.php"; 

$id = $_GET['id'] ?? '1'; // PHP > 7.0

$room = Room::find_by_id($id);


?>

<div class="container">
  <?php echo display_session_message(); ?>
  <a class="back-link" href="/src/rooms/rooms.php">&laquo; Back </a>
    <h3>Room: <?php echo h($room->name()); ?></h3>
      <div class="attributes">
        <dl>
          <dt>Bed num</dt>
          <dd><?php echo h($room->bed_num); ?></dd>
        </dl>
        <dl>
          <dt>Overview</dt>
          <dd><?php echo h($room->overview); ?></dd>
        </dl>
      </div>          
</div>

<?php 
include $_SERVER['DOCUMENT_ROOT'] . ('/src/footer.php'); 
?>