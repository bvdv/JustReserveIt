<?php 
include $_SERVER['DOCUMENT_ROOT'] . ('/src/header.php');


$errors = [];
$username = '';
$password = '';

if(is_post_request()) {

  $username = $_POST['username'] ?? '';
  $password = $_POST['password'] ?? '';

  // Validations
  if(is_blank($username)) {
    $errors[] = "Username cannot be blank.";
  }
  if(is_blank($password)) {
    $errors[] = "Password cannot be blank.";
  }

  // if there were no errors, try to login
  if(empty($errors)) {
    $staff = Staff::find_by_username($username);
    
    // test if admin found and password is correct
    if($staff != false && $staff->verify_password($password)) {
      // Mark admin as logged in
      $session->login($staff);
      redirect_to("/public/index.php");
    }

    $user = Users::find_by_username($username); 
    if($user != false && $user->verify_password($password)) {
      // Mark admin as logged in
      $session->login($user);
      redirect_to("/public/index.php");
    } else {
      // username not found or password does not match
      $errors[] = "Log in was unsuccessful.";
    }

  }


}
?>

<form class="form-signin-reg" action="signin.php" method="post">
 <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
  
  <input type="username" class="form-control" name="username" value="<?php echo h($username); ?>" placeholder="Username" />
  
  <input type="password" class="form-control" name="password" value="" placeholder="Password" />
  <!-- <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div> -->
  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
  <hr>
  <?php echo display_errors($errors); ?>
</form>

<?php include $_SERVER['DOCUMENT_ROOT'] . ('/src/footer.php'); ?>