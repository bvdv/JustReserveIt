<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/src/header.php';

?>

    <main role="main">

      <!-- Start Reservation Area-->
      <div class="jumbotron">
        <div class="container">
          <h4 class="display-4">Just reserve it!</h4>
          <p>Make a reservation in advance.</p>
        </div>
      </div>
      <!-- End Reservation Area-->

      <div class="container">
        <!-- Example row of columns -->
        <h3>Hot offers!</h3>
        <div class="row">
          <div class="col-md-4">
            <img class="content-image img-fluid d-block mx-auto" src="assets/img/b1.jpg" alt="">
            <h2>1 Bedroom</h2>
            <p> The apartment is bright and spacious with many original features and is fully furnished and has ample storage space for a single. :) </p>
            <p><a class="btn btn-secondary" href="/src/rooms/show_room.php?id=7" role="button">View details &raquo;</a></p>
          </div>

          <div class="col-md-4">
            <img class="content-image img-fluid d-block mx-auto" src="assets/img/b2.jpg" alt="">
            <h2>2 bedroom</h2>
            <p>A very nicely presented two bedroom first floor flat.:) </p>
            <p><a class="btn btn-secondary" href="http://shawk/src/rooms/show_room.php?id=8" role="button">View details &raquo;</a></p>
          </div>

          <div class="col-md-4">
            <img class="content-image img-fluid d-block mx-auto" src="assets/img/b3.jpg" alt="">
            <h2>3 bedroom</h2>
            <p>A beautifully presented three double bedroom first floor new build apartment. :) </p>
            <p><a class="btn btn-secondary" href="http://shawk/src/rooms/show_room.php?id=13" role="button">View details &raquo;</a></p>
          </div>
        </div>

        <hr>

      </div> <!-- /container -->

    </main>

<?php 
include $_SERVER['DOCUMENT_ROOT'] . '/src/footer.php';
?>
