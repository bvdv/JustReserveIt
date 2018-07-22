<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/config/initialize.php' ; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Just Reserve It!</title>

    <!-- Bootstrap, jQuery-Ui core CSS -->
    <link href="/public/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/assets/css/jquery-ui.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/public/assets/css/main.css" rel="stylesheet">
    
  </head>

  <body>
    <!-- Start Header Area --> 
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="container" align="center">
        <a class="navbar-brand" href="/public/index.php">Just Reserve It!</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="/src/rooms/rooms.php">Rooms</a>
            </li> 
            <?php if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) : ?>
            <li class="nav-item">
              <a class="nav-link" href="/src/reservations/reservations.php">Reservations</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="/src/users/users.php">Users</a>
            </li>
                <?php if ($_SESSION['role'] === '2') : ?>
                <li class="nav-item">
                  <a class="nav-link" href="/src/staff/staff.php">Staff</a>
                </li>
                    <?php
                endif;
            endif;

if (isset($_SESSION['status'])) : ?>
            <li class="nav-item">
              <a class="nav-link" href="/src/users/show.php?id=<?php echo $_SESSION['user_id'] ?>">Your account</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/src/signout.php">Sign out</a>
            </li>                        
<?php elseif (isset($_SESSION['role'])) : ?>
            <li class="nav-item">
              <a class="nav-link" href="/src/staff/show.php?id=<?php echo $_SESSION['user_id'] ?>">Your account</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/src/signout.php">Sign out</a>
            </li>                       
<?php else : ?>
            <li class="nav-item">
              <a class="nav-link" href="/src/signin.php">Sign in</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/src/users/new_user.php">Register</a>
            </li>            
<?php endif;?>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Header Area -->
