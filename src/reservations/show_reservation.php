<?php 

include $_SERVER['DOCUMENT_ROOT'] . '/src/header.php';
//for staff and users
require_login();

if( isset($_SESSION['role']) || isset($_SESSION['user_id']) ) {
  // Do nothing, let the rest of the page proceed
} else {
  redirect_to("/public/index.php");
} 

$id = $_GET['id'] ?? '1'; // PHP > 7.0

$reserved_room = Reservation::find_by_id($id);


?>

<div class="container">
  <?php echo display_session_message(); ?>
  <a class="back-link" href="/src/reservations/reservations.php">&laquo; Back </a>
    <h3>Room: <?php echo h($reserved_room->name()); ?></h3>
      <div class="attributes">
        <dl>
          <dt>Acception status</dt>
          <dd><?php if ($reserved_room->accepted === '1') {
               echo "Accepted";
             } else {
               echo "Waiting for acceptation";
             }
            ?></dd>
          <?php if ( (($_SESSION['role'] === '2') || ($_SESSION['role'] === '1')) && ($reserved_room->accepted === '0') ) : ?>
          <?php endif; ?>    
        </dl>        
        <dl>
          <dt>Reserved</dt>
          <dd>From: <?php echo h($reserved_room->check_in); ?></dd>
          <dd>To: <?php echo h($reserved_room->check_out); ?></dd>    
        </dl>
      </div>          
</div>

<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/src/footer.php';
?>