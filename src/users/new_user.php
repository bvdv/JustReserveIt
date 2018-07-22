<?php
include $_SERVER['DOCUMENT_ROOT'] . '/src/header.php';

// require_staff_login();
// //only for admin
// if( ($_SESSION['role'] !== '2') && (isset($_SESSION['user_id'])) ) {
//   redirect_to("/public/index.php");
// }


if (is_post_request()) {
  // Create record using post parameters
    $args = $_POST['user'];
    $user = new Users($args);
    $result = $user->save();

    if ($result === true) {
        $new_id = $user->id;
        $session->message('The user was created successfully.');
        redirect_to("/src/users/show.php?id=" . $new_id);
    } else {
      // show errors
    }
} else {
  // display the form
    $user = new Users;
}

?>

<div class="container">
    <?php echo display_session_message(); ?>
  <a class="back-link" href="/src/users/users.php">&laquo; Back</a>
  <h3>Create User</h3>
  <form action="/src/users/new_user.php" method="post" class="form-signin-reg">

    <input type="text" class="form-control" name="user[username]" value="<?php echo h($user->username); ?>" placeholder="Username">


    <input type="text" class="form-control" name="user[name]" value="<?php echo h($user->name); ?>" placeholder="Name" >


    <input type="text" class="form-control" name="user[surname]" value="<?php echo h($user->surname); ?>" placeholder="Surname" >


    <input type="text" class="form-control" name="user[email]" value="<?php echo h($user->email); ?>" placeholder="Email" >


    <input type="text" class="form-control" name="user[contacts]" value="<?php echo h($user->contacts); ?>" placeholder="Contacts" >


    <input type="text" class="form-control" name="user[document_id]" value="<?php echo h($user->document_id); ?>" placeholder="Document ID" >


    <input type="password" class="form-control" name="user[password]" value="" placeholder="Password">


    <input type="password" class="form-control" name="user[confirm_password]" value="" placeholder="Confirm Password" >
    
    <?php if (($_SESSION['role'] === '2') && isset($_SESSION['user_id'])) : ?>
    <input type="number" name="user[user_status]" value="<?php echo h($user->user_status); ?>" class="form-control" placeholder="User status" min='0' max='1' >
        <?php
    endif;
?>

    <div id="operations">
      <input class="btn btn-lg btn-primary btn-block" type="submit" value="Create User" />
    </div>
    <hr>
    <?php echo display_errors($user->errors); ?>
  </form>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/src/footer.php'; ?>

