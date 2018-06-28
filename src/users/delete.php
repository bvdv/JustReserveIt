<?php
include $_SERVER['DOCUMENT_ROOT'] . ('/src/header.php');

require_staff_login();
//only for admin
if( ($_SESSION['role'] !== '2') && (isset($_SESSION['user_id'])) ) {
  redirect_to("/public/index.php");
}

if(!isset($_GET['id'])) {
  redirect_to("/public/index.php");
}
$id = $_GET['id'];
$user = Users::find_by_id($id);
if($user == false) {
  redirect_to("/public/index.php");
}

if(is_post_request()) {

  // Delete admin
  $result = $user->delete();
  $session->message('The user was deleted successfully.');
  redirect_to("/src/users/users.php");

} else {
  // Display form
}

?>

<div class="container">
  <?php echo display_session_message(); ?>
  <a class="back-link" href="/src/users/users.php">&laquo; Back</a>
  <h3>Delete User</h3>
  <p>Are you sure you want to delete this user?</p>
  <p class="item"><?php echo h($user->full_name()); ?></p>
    <form action="/src/users/delete.php?id=<?php echo h(u($id)); ?>" method="post">
      <div id="operations">
        <input class="btn btn-lg btn-primary btn-block" type="submit" name="commit" value="Delete User" />
      </div>
    </form>
</div>
  
<?php include $_SERVER['DOCUMENT_ROOT'] . ('/src/footer.php'); ?>
