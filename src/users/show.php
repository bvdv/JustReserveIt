<?php 
include $_SERVER['DOCUMENT_ROOT'] . ('/src/header.php');
//for staff and users
require_login();

if( isset($_SESSION['role']) || isset($_SESSION['user_id']) ) {
  // Do nothing, let the rest of the page proceed
} else {
  redirect_to("/public/index.php");
}


$id = $_GET['id'] ?? '1'; // PHP > 7.0

$user = Users::find_by_id($id);
$reserved_room = Reservation::find_all_by_user_id($id);

?>
 <!-- add admin name like ad as admin -->


<div class="container">
  <?php echo display_session_message(); ?>
  <a class="back-link" href="/src/users/users.php">&laquo; Back</a>
  <h3>User <?php echo h($user->full_name()); ?></h3>
    <?php if ( $_SESSION['role'] === '2' ) : ?>
    <div class="attributes">
      <dl>
        <dt>Username</dt>
        <dd><?php echo h($user->username); ?></dd>
      </dl>
      <dl>
        <dt>First name</dt>
        <dd><?php echo h($user->name); ?></dd>
      </dl>
      <dl>        
        <dt>Last name</dt>
        <dd><?php echo h($user->surname); ?></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><?php echo h($user->email); ?></dd>
      </dl>
      <dl>
        <dt>Contacts</dt>
        <dd><?php echo h($user->contacts); ?></dd>
      </dl>
      <dl>
        <dt>Document ID</dt>
        <dd><?php echo h($user->document_id); ?></dd>
      </dl>
      <dl>
        <dt>Password</dt>
        <dd><?php echo h($user->password); ?></dd>
      </dl>
      <dl>
        <dt>User status</dt>
        <dd><?php echo h($user->user_status); ?></dd>
      </dl>                  
    </div>
    <?php
    elseif ( $_SESSION['role'] === '1' ) : ?>
    <div class="attributes">
      <dl>
        <dt>Username</dt>
        <dd><?php echo h($user->username); ?></dd>
      </dl>
      <dl>
        <dt>First name</dt>
        <dd><?php echo h($user->name); ?></dd>
      </dl>
      <dl>        
        <dt>Last name</dt>
        <dd><?php echo h($user->surname); ?></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><?php echo h($user->email); ?></dd>
      </dl>
      <dl>
        <dt>Contacts</dt>
        <dd><?php echo h($user->contacts); ?></dd>
      </dl>
      <dl>
        <dt>Document ID</dt>
        <dd><?php echo h($user->document_id); ?></dd>
      </dl>
      <dl>
        <dt>User status</dt>
        <dd><?php echo h($user->user_status); ?></dd>
      </dl>                  
    </div>
    <?php 
    elseif ( $_SESSION['role'] === '0' ) : ?>
    <div class="attributes">
      <dl>
        <dt>Username</dt>
        <dd><?php echo h($user->username); ?></dd>
      </dl>
      <dl>
        <dt>First name</dt>
        <dd><?php echo h($user->name); ?></dd>
      </dl>
      <dl>        
        <dt>Last name</dt>
        <dd><?php echo h($user->surname); ?></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><?php echo h($user->email); ?></dd>
      </dl>
      <dl>
        <dt>Contacts</dt>
        <dd><?php echo h($user->contacts); ?></dd>
      </dl>
      <dl>
        <dt>User status</dt>
        <dd><?php echo h($user->user_status); ?></dd>
      </dl>                  
    </div>
    <?php
    // for user account
    elseif ( $_SESSION['status'] === '0' ) :
    ?>
    <div class="attributes">
      <dl>
        <dt>Username</dt>
        <dd><?php echo h($user->username); ?></dd>
      </dl>
      <dl>
        <dt>First name</dt>
        <dd><?php echo h($user->name); ?></dd>
      </dl>
      <dl>        
        <dt>Last name</dt>
        <dd><?php echo h($user->surname); ?></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><?php echo h($user->email); ?></dd>
      </dl>
      <dl>
        <dt>Contacts</dt>
        <dd><?php echo h($user->contacts); ?></dd>
      </dl>
      <dl>
        <dt>Document ID</dt>
        <dd><?php echo h($user->document_id); ?></dd>
      </dl>
      <dl>
        <dt>Password</dt>
        <dd><?php echo h($user->password); ?></dd>
      </dl>
      <dl>
        <dt>User status</dt>
        <dd><?php echo h($user->user_status); ?></dd>
      </dl>
      <hr>
      <dl>
        <dt>Reserved rooms</dt>
        <dd><br>
          <?php 
          foreach($reserved_room as $reservation) {

          echo "Room title: " . h($reservation->room_name) . "<br>";
          echo "From: " . h($reservation->check_in) . "<br>";
          echo "To: " . h($reservation->check_out) . "<br>";
          echo "Status: " . h($reservation->accepted) . "<br><br>";

          } 
          
          ?>
        </dd>
      </dl>                         
    </div>
    <?php
    endif;
    ?>              
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . ('/src/footer.php'); ?>