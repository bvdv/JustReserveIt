<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/header.php';
 
require_staff_login();

if (isset($_SESSION['role']) && isset($_SESSION['user_id'])) {
  // Do nothing, let the rest of the page proceed
} else {
    redirect_to("/public/index.php");
}

$id = $_GET['id'] ?? '1'; // PHP > 7.0

$staff = Staff::find_by_id($id);

?>
 <!-- add admin name like ad as admin -->


<div class="container" id="show_data">
    <?php echo display_session_message(); ?>
  <a class="back-link" href="/src/staff/staff.php">&laquo; Back</a>
  <h3>Staff <?php echo h($staff->full_name()); ?></h3>
    <div class="attributes">
      <dl>
        <dt>ID</dt>
        <dd><?php echo h($staff->id); ?></dd>
      </dl>      
      <dl>
        <dt>Username</dt>
        <dd><?php echo h($staff->username); ?></dd>
      </dl>
      <dl>
        <dt>First name</dt>
        <dd><?php echo h($staff->name); ?></dd>
      </dl>
      <dl>        
        <dt>Last name</dt>
        <dd><?php echo h($staff->surname); ?></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><?php echo h($staff->email); ?></dd>
      </dl>
      <dl>
        <dt>Contacts</dt>
        <dd><?php echo h($staff->contacts); ?></dd>
      </dl>
      <dl>
        <dt>Document ID</dt>
        <dd><?php echo h($staff->document_id); ?></dd>
      </dl>
      <dl>
        <dt>Password</dt>
        <dd><?php echo h($staff->password); ?></dd>
      </dl>
      <dl>
        <dt>Staff role</dt>
        <dd><?php echo h($staff->role); ?></dd>
      </dl>       
      <dl>
        <dt>Staff status</dt>
        <dd><?php echo h($staff->staff_status); ?></dd>
      </dl>                  
    </div>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/footer.php';
?>
