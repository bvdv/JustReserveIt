<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/header.php';

require_login();

if (isset($_SESSION['role']) || isset($_SESSION['user_id'])) {
  // Do nothing, let the rest of the page proceed
} else {
    redirect_to("/public/index.php");
}

if (!isset($_GET['id'])) {
    redirect_to(url_for('/src/users/users.php'));
}
$id = $_GET['id'];
$user = Users::find_by_id($id);
if ($user == false) {
    redirect_to("/src/users/users.php");
}

if (is_post_request()) {
  // Save record using post parameters
    $args = $_POST['user'];
    $user->merge_attributes($args);
    $result = $user->save();

    if ($result === true) {
        $session->message('The user was updated successfully.');
        redirect_to("/src/users/show.php?id=" . $id);
    } else {
      // show errors
    }
} else {
  // display the form
}

?>

<div class="container">
    <?php echo display_session_message(); ?>
  <a class="back-link" href="/src/users/users.php">&laquo; Back</a>
  <h3>Edit User</h3>
  
    <?php
    echo display_errors($user->errors) . "<br>";
    ?>

  <form class="form-signin-reg" action="/src/users/edit.php?id=<?php echo h(u($id)); ?>" method="post">

    <input type="text" class="form-control" name="user[username]" value="<?php echo h($user->username); ?>" placeholder="Username">

    <input type="text" class="form-control" name="user[name]" value="<?php echo h($user->name); ?>" placeholder="Name" >

    <input type="text" class="form-control" name="user[surname]" value="<?php echo h($user->surname); ?>" placeholder="Surname" >

    <input type="text" class="form-control" name="user[email]" value="<?php echo h($user->email); ?>" placeholder="Email" >

    <input type="text" class="form-control" name="user[contacts]" value="<?php echo h($user->contacts); ?>" placeholder="Contacts" >

    <input type="text" class="form-control" name="user[document_id]" value="<?php echo h($user->document_id); ?>" placeholder="Document ID" >

    <input type="password" class="form-control" name="user[password]" value="" placeholder="Password">

    <input type="password" class="form-control" name="user[confirm_password]" value="" placeholder="Confirm Password" >

    <input type="number" name="user[user_status]" value="<?php echo h($user->user_status); ?>" class="form-control" placeholder="User status" min='0' max='1' >

    <div id="operations">
      <input class="btn btn-lg btn-primary btn-block" type="submit" value="Edit User" />
    </div>
  </form>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/footer.php'; ?>
