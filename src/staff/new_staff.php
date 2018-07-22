<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/header.php';
 
require_staff_login();

if (($_SESSION['role'] !== '2') && (isset($_SESSION['user_id']))) {
    redirect_to("/public/index.php");
}

if (is_post_request()) {
  // Create record using post parameters
    $args = $_POST['staff'];
    $staff = new Staff($args);
    $result = $staff->save();

    if ($result === true) {
        $new_id = $staff->id;
        $session->message('The staff was created successfully.');
        redirect_to("/src/staff/show.php?id=" . $new_id);
    } else {
      // show errors
    }
} else {
  // display the form
    $staff = new Staff;
}

?>

<div class="container">
    <?php echo display_session_message(); ?>
  <a class="back-link" href="/src/staff/staff.php">&laquo; Back</a>
  <h3>Create Staff</h3>
  <form action="/src/staff/new_staff.php" method="post" class="form-signin-reg">
    
    <input type="text" class="form-control" name="staff[username]" value="<?php echo h($staff->username); ?>" placeholder="Username">
    
    <input type="text" class="form-control" name="staff[name]" value="<?php echo h($staff->name); ?>" placeholder="Name" >

    <input type="text" class="form-control" name="staff[surname]" value="<?php echo h($staff->surname); ?>" placeholder="Surname" >

    <input type="text" class="form-control" name="staff[email]" value="<?php echo h($staff->email); ?>" placeholder="Email" >

    <input type="text" class="form-control" name="staff[contacts]" value="<?php echo h($staff->contacts); ?>" placeholder="Contacts" >

    <input type="text" class="form-control" name="staff[document_id]" value="<?php echo h($staff->document_id); ?>" placeholder="Document ID" >

    <input type="password" class="form-control" name="staff[password]" value="" placeholder="Password">

    <input type="password" class="form-control" name="staff[confirm_password]" value="" placeholder="Confirm Password" >

    <input type="number" name="staff[role]" value="<?php echo h($staff->role); ?>" class="form-control" placeholder="staff role" min='0' max='2' >

    <input type="number" name="staff[staff_status]" value="<?php echo h($staff->staff_status); ?>" class="form-control" placeholder="staff status" min='0' max='1' >

    <div id="operations">
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Create Staff" />
    </div>
    <hr>
    <?php echo display_errors($staff->errors); ?>
  </form>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/footer.php'; ?>

