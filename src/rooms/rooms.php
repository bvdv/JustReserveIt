<?php 

include $_SERVER['DOCUMENT_ROOT'] . "/src/header.php";
// Find all rooms;
$rooms = Room::find_all();

?>

<div class="container">
    <h3>Rooms</h3>
      <?php if ( ($_SESSION['role'] === '2') && (isset($_SESSION['user_id'])) ) : ?>
      <div class="actions">
       <a class="action" href="/src/rooms/new_room.php">Add Room</a>
      </div>
      <table id="data_table">  
        <tr>
          <th>ID</th>
          <th>Room name</th>
          <th>Bed num</th>
          <th>Overview</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
        </tr>
          <?php foreach($rooms as $room) : ?>
            <tr>
              <td><?php echo h($room->id); ?></td>
              <td><?php echo h($room->room_name); ?></td>
              <td><?php echo h($room->bed_num); ?></td>
              <td><?php echo h($room->overview); ?></td>
              <td><a class="action" href="<?php echo url_for('../../src/rooms/show_room.php?id=' . h(u($room->id))); ?>">View</a></td>
              <td><a class="action" href="<?php echo url_for('../../src/reservations/new_reservation.php?id=' . h(u($room->id))); ?>">Reserve it</a></td>
              <td><a class="action" href="<?php echo url_for('../../src/rooms/edit_room.php?id=' . h(u($room->id))); ?>">Edit</a></td>
              <td><a class="action" href="<?php echo url_for('../../src/rooms/delete_room.php?id=' . h(u($room->id))); ?>">Delete</a></td>
            </tr>
          <?php 
          endforeach;
          ?>
      </table>
      <?php
        // rooms view for all
      else :
      ?>
      <table id="data_table">
        <tr>
          <th>Room title</th>
          <th>Bed num</th>
          <th>Overview</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          
        </tr>

        <?php foreach($rooms as $room) : ?>
          <tr>
            <td><?php echo h($room->room_name); ?></td>
            <td><?php echo h($room->bed_num); ?></td>
            <td><?php echo h($room->overview); ?></td>
            <td><a class="action" href="<?php echo url_for('../../src/rooms/show_room.php?id=' . h(u($room->id))); ?>">View</a></td>
            <?php if (isset($_SESSION['user_id'])) : ?>
            <td><a class="action" href="<?php echo url_for('../../src/reservations/new_reservation.php?id=' . h(u($room->id))); ?>">Reserve it</a></td>
            <?php
            endif;  ?>
          </tr>
        <?php 
        endforeach;
        endif; 
        ?>
      </table>
    <hr>
</div>


<?php 
include $_SERVER['DOCUMENT_ROOT'] . ('/src/footer.php');
?>