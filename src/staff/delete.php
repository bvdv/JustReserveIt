<?php

include $_SERVER['DOCUMENT_ROOT'] . "/src/header.php";
 
require_staff_login();

if( ($_SESSION['role'] !== '2') && (isset($_SESSION['user_id'])) ) {
  redirect_to("/public/index.php");
}

if(!isset($_GET['id'])) {
  redirect_to("/public/index.php");
}
$id = $_GET['id'];
$staff = Staff::find_by_id($id);
if($staff == false) {
  redirect_to("/public/index.php");
}

if(is_post_request()) {

  // Delete saff
  $result = $staff->delete();
  $session->message('The staff was deleted successfully.');
  redirect_to("/src/staff/staff.php");

} else {
  // Display form
}

?>

<div class="container">
  <?php echo display_session_message(); ?>
  <a class="back-link" href="/src/staff/staff.php">&laquo; Back </a>
  <h3>Delete Staff</h3>
  <p>Are you sure you want to delete this staff?</p>
  <p class="item"><?php echo h($staff->full_name()); ?></p>
    <form action="/src/staff/delete.php?id=<?php echo h(u($id)); ?>" method="post">
      <div id="operations">
        <input class="btn btn-lg btn-primary btn-block" type="submit" name="commit" value="Delete Staff" />
      </div>
    </form>
</div>
  
<?php 
include $_SERVER['DOCUMENT_ROOT'] . ('/src/footer.php'); 
?>
