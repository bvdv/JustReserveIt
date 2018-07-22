<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/header.php';
//only for staff
require_staff_login();

if (isset($_SESSION['role']) || isset($_SESSION['user_id'])) {
  // Do nothing, let the rest of the page proceed
} else {
    redirect_to("/public/index.php");
}

// Find all users
$users = Users::find_all();

?>


<div class="container">
    <?php echo display_session_message(); ?>
  <h3>Users</h3>
    <?php if ($_SESSION['role'] === '2') : ?>
      <a class="action" href="/src/users/new_user.php">Add User</a>
        <table class="users" id="data_table">
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Password</th>
            <th>Contacts</th>
            <th>Document ID</th>
            <th>User status</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>
          <?php foreach ($users as $user) : ?>
            <tr>
              <td><?php echo h($user->id); ?></td>
              <td><?php echo h($user->username); ?></td>
              <td><?php echo h($user->name); ?></td>
              <td><?php echo h($user->surname); ?></td>
              <td><?php echo h($user->email); ?></td>
              <td><?php echo h($user->password); ?></td>
              <td><?php echo h($user->contacts); ?></td>
              <td><?php echo h($user->document_id); ?></td>
              <td><?php echo h($user->user_status); ?></td>
              <td><a class="action" href="/src/users/show.php?id=<?php echo h(u($user->id)); ?>">View</a></td>
              <td><a class="action" href="/src/users/edit.php?id=<?php echo h(u($user->id)); ?>">Edit</a></td>
              <td><a class="action" href="/src/users/delete.php?id=<?php echo h(u($user->id)); ?>">Delete</a></td>
            </tr>
                <?php
          endforeach;
?>
        </table>  
        <?php
    elseif ($_SESSION['role'] === '1') : ?>
        <table class="users" id="data_table">
          <tr>
            <th>Username</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Contacts</th>
            <th>Document ID</th>
            <th>&nbsp;</th>
          </tr>
            <?php foreach ($users as $user) : ?>
            <tr>
              <td><?php echo h($user->username); ?></td>
              <td><?php echo h($user->name); ?></td>
              <td><?php echo h($user->surname); ?></td>
              <td><?php echo h($user->email); ?></td>
              <td><?php echo h($user->contacts); ?></td>
              <td><?php echo h($user->document_id); ?></td>
              <td><a class="action" href="/src/users/show.php?id=<?php echo h(u($user->id)); ?>">View</a></td>
            </tr>
                <?php
            endforeach;
?>
        </table>
            <?php
    elseif ($_SESSION['role'] === '0') : ?>
        <table class="users" id="data_table">
          <tr>
            <th>Username</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Contacts</th>
            <th>&nbsp;</th>
          </tr>
            <?php foreach ($users as $user) : ?>
            <tr>
              <td><?php echo h($user->username); ?></td>
              <td><?php echo h($user->name); ?></td>
              <td><?php echo h($user->surname); ?></td>
              <td><?php echo h($user->email); ?></td>
              <td><?php echo h($user->contacts); ?></td>
              <td><a class="action" href="/src/users/show.php?id=<?php echo h(u($user->id)); ?>">View</a></td>
            </tr>
                <?php
            endforeach;
    endif;
    ?>      
    </table>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/footer.php'; ?>

