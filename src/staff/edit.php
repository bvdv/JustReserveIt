<?php

include $_SERVER['DOCUMENT_ROOT'] . '/src/header.php';
 
require_staff_login();

if (($_SESSION['role'] !== '2') && (isset($_SESSION['user_id']))) {
    redirect_to("/public/index.php");
}

if (!isset($_GET['id'])) {
    redirect_to(url_for('/src/staff/staff.php'));
}
$id = $_GET['id'];
$staff = Staff::find_by_id($id);
if ($staff == false) {
    redirect_to("/src/staff/staff.php");
}

if (is_post_request()) {
  // Save record using post parameters
    $args = $_POST['staff'];
    $staff->merge_attributes($args);
    $result = $staff->save();

    if ($result === true) {
        $session->message('The staff was updated successfully.');
        redirect_to("/src/staff/show.php?id=" . $id);
    } else {
      // show errors
    }
} else {
  // display the form
}

?>

  <div class="container">
    <?php echo display_session_message(); ?>
    <a class="back-link" href="/src/staff/staff.php">&laquo; Back</a>
    <h3>Edit Staff</h3>
    
    <?php
    echo display_errors($staff->errors) . "<br>";
     
    ?>

    <form class="form-signin-reg" action="/src/staff/edit.php?id=<?php echo h(u($id)); ?>" method="post">

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
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Edit Staff" />
      </div>
    </form>

  </div>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/footer.php';
?>
