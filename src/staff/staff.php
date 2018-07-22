<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/header.php';
 
require_staff_login();

if (($_SESSION['role'] !== '2') && (isset($_SESSION['user_id']))) {
    redirect_to("/public/index.php");
}
  


//require_admin_login();

// Find all users
$staffs = Staff::find_all();

?>


<div class="container">
    <?php echo display_session_message(); ?>
  <h3>Staff</h3>

    <div class="actions">
      <a class="action" href="/src/staff/new_staff.php">Add staff</a>
    </div>

    <table class="staff" id="data_table">
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Name</th>
        <th>Surname</th>
        <th>Email</th>
        <th>Password</th>
        <th>Contacts</th>
        <th>Document ID</th>
        <th>Staff role</th>
        <th>Staff status</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>

        <?php foreach ($staffs as $staff) { ?>
        <tr>
          <td><?php echo h($staff->id); ?></td>
          <td><?php echo h($staff->username); ?></td>
          <td><?php echo h($staff->name); ?></td>
          <td><?php echo h($staff->surname); ?></td>
          <td><?php echo h($staff->email); ?></td>
          <td><?php echo h($staff->password); ?></td>
          <td><?php echo h($staff->contacts); ?></td>
          <td><?php echo h($staff->document_id); ?></td>
          <td><?php echo h($staff->check_role()); ?></td>
          <td><?php echo h($staff->check_staff_status()); ?></td>
          <td><a class="action" href="/src/staff/show.php?id=<?php echo h(u($staff->id)); ?>">View</a></td>
          <td><a class="action" href="/src/staff/edit.php?id=<?php echo h(u($staff->id)); ?>">Edit</a></td>
          <td><a class="action" href="/src/staff/delete.php?id=<?php echo h(u($staff->id)); ?>">Delete</a></td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <p>Staff role</p>
    <p>0 - junior</p> 
    <p>1 - Controller</p>
    <p>2 - Admin</p>
</div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . ('/src/footer.php');
?>

