<?php 

include $_SERVER['DOCUMENT_ROOT'] . "/src/header.php";

require_staff_login(); 
// only for staff
if( !isset($_SESSION['role']) && !isset($_SESSION['user_id'])) {
  redirect_to("/src/rooms/rooms.php");
}

// Find all rooms;
$reservations = Reservation::find_all();

?>

<div class="container">
    <?php echo display_session_message(); ?>
    <h3>Reservations</h3>

    <table id="data_table">
      <tr>
        <th>Reservation ID</th>
        <th>Room ID</th>
        <th>Room title</th>
        <th>User ID</th>
        <th>Check_in</th>
        <th>Check_out</th>

        <!-- for admin and controller -->
        <th>Acception status</th>
        <th>&nbsp;</th>
        <?php if( (!($_SESSION['role'] !== '2') || !($_SESSION['role'] !== '1') )) : ?>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <?php endif;?>
        
      </tr>

      <?php foreach($reservations as $reservation) : ?>
        <tr>
          <td><?php echo h($reservation->id); ?></td>
          <td><?php echo h($reservation->room_id);?></td>
          <td><?php echo h($reservation->room_name); ?></td>
          <td><?php echo h($reservation->user_id); ?></td>
          <td><?php echo h($reservation->check_in); ?></td>
          <td><?php echo h($reservation->check_out); ?></td>
          <?php if ($reservation->accepted === '0') : ?>
          <td>Waiting for acceptation</td>
          <?php else : ?>
          <td>Accepted</td>
          <?php endif; ?>
          <td><a class="action" href="<?php echo url_for('../../src/reservations/show_reservation.php?id=' . h(u($reservation->id))); ?>">View</a></td>
          
          <?php 
          if( (!($_SESSION['role'] !== '2') || !($_SESSION['role'] !== '1') )) : ?>
            
              <?php if ($reservation->accepted === '1') : ?>
               <td>Done</td><!-- do nothing -->
              <?php else : ?>
                <td><a class="action" href="<?php echo url_for('../../src/reservations/edit_reservation.php?id=' . h(u($reservation->id))); ?>">Accept</a></td>
              <?php endif; ?>
              </td>
              <td><a class="action" href="<?php echo url_for('../../src/reservations/delete_reservation.php?id=' . h(u($reservation->id))); ?>">Decline</a></td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?>
    </table>   
  <hr>
</div>


<?php 
include $_SERVER['DOCUMENT_ROOT'] . ('/src/footer.php');
?>