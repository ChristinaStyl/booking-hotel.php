<?php

require __DIR__.'/../boot/boot.php';

use Hotel\Favorite;
use Hotel\User;
use Hotel\Review;
use Hotel\Booking;

$favorite = new Favorite();
$booking = new Booking();
$review = new Review();

// checked if user exists
$userId = User::getCurrentUserId();
if (empty (User::getCurrentUserId())){
  header('Location: intex.php');
  return;
}

// Get all favorites
$userFavorites = $favorite->getListByUser($userId);

// Get all reviews
$userReviews = $review->getListByUser($userId);

// Get all bookings
$userBookings = $booking->getListByUser($userId);
// print_r($userBookings);die;

 ?>

<!DOCTYPE>
<html>
  <head>
    <meta charset="utf-8">
    <title>Profile </title>
    <link rel="shortcut icon" href="assets\images\booking.png">

    <link  href="CSS\room-style.css" rel="stylesheet"/>
    <link  href="CSS\list-style.css" rel="stylesheet"/>
    <link  href="CSS\intex-style.css" rel="stylesheet"/>
    <link  href="CSS\profile-style.css" rel="stylesheet"/>
    <link  href="assets/css/fontawesome.min.css" rel="stylesheet"/>
  </head>
  <body>
    <header>
      <div class="menu">
        <span id="hotel" href="#"></i>Hotels</span>
        <a id="home" href="./intex.php"><i class="fas fa-home"></i>Home |</a>
        <span id="user" href="#"><i class="fas fa-user"></i>Profile |</span>
        <a id="logout" href="actions/logout.php">Log out <i class="fas fa-sign-out-alt"></i>|</a>

      </div>
      <hr class="menu-line">
    </header>

    <main class="container list-section">

       <div id="mySidebar" class="sidebar">
         <a href="javascript:void(0)" class="closebtn" onclick="closeFavorites()"><i class="fas fa-times"></i></a>
         <section class="filter-mob favorites-reviews">
           <div class="profile-favorites">
             <h1>FAVORITES</h1>
             <?php if (count($userFavorites) > 0) {
              ?>
               <ol>
                 <?php
                   foreach ($userFavorites as $favorite) {
                 ?>
                   <li class="fav-name">
                     <a href="http://hotel.collegelink.localhost/public//room.php?room_id=<?php echo $favorite['room_id'] ?>"><?php echo $favorite['name']; ?></a>
                   </li>
                 <?php } ?>
               </ol>
             <?php } else { ?>
               <h4>You don't have  any favorite Hotel</h4>
             <?php } ?>
           </div>
         </section>
       </div>
       <div id="mob-favorites">
         <button class="openbtn" onclick="openFavorites()"><i class="fas fa-heart"></i>Favorites</button>
       </div>

       <div id="mySidebar2" class="sidebar2">
          <a href="javascript:void(0)" class="closebtn" onclick="closeReviews()"><i class="fas fa-times"></i></a>
          <section class="filter-mob favorites-reviews">
            <div class="profile-reviews">
              <h1>REVIEWS</h1>
              <?php if (count($userReviews) > 0) {
               ?>
                <ol>
                  <?php
                    foreach ($userReviews as $review) {
                  ?>
                    <li class="my-reviews">
                      <a href="http://hotel.collegelink.localhost/public//room.php?room_id=<?php echo $review['room_id'] ?>"><?php echo $review['name']; ?></a>
                      <div class="stars">
                        <?php
                          for ($i=1; $i <=5 ; $i++) {
                            if ($review['rate'] >= $i) {
                        ?>
                              <i class="fas fa-star checked"></i>
                              <?php
                            } else {
                              ?>
                              <i class="fas fa-star"></i>
                        <?php
                            }
                          }
                        ?>
                      </div>
                    </li>
                  <?php } ?>
                </ol>
              <?php } else {?>
                <h4>You don't have  made any review yet</h4>
              <?php } ?>
            </div>
          </section>
        </div>
        <div id="mob-reviews">
          <button class="openbtn" onclick="openReviews()"><i class="fas fa-star"></i>Reviews</button>
        </div>


      <section class=" filter favorites-reviews">
        <div class="profile-favorites">
          <h1>FAVORITES</h1>
          <?php if (count($userFavorites) > 0) {
           ?>
            <ol>
              <?php
                foreach ($userFavorites as $favorite) {
              ?>
                <li class="fav-name">
                  <a href="http://hotel.collegelink.localhost/public//room.php?room_id=<?php echo $favorite['room_id'] ?>"><?php echo $favorite['name']; ?></a>
                </li>
              <?php } ?>
            </ol>
          <?php } else { ?>
            <h4>You don't have  any favorite Hotel</h4>
          <?php } ?>
        </div>
        <div class="profile-reviews">
          <h1>REVIEWS</h1>
          <?php if (count($userReviews) > 0) {
           ?>
            <ol>
              <?php
                foreach ($userReviews as $review) {
              ?>
                <li class="my-reviews">
                  <a href="http://hotel.collegelink.localhost/public//room.php?room_id=<?php echo $review['room_id'] ?>"><?php echo $review['name']; ?></a>
                  <div class="stars">
                    <?php
                      for ($i=1; $i <=5 ; $i++) {
                        if ($review['rate'] >= $i) {
                    ?>
                          <i class="fas fa-star checked"></i>
                          <?php
                        } else {
                          ?>
                          <i class="fas fa-star"></i>
                    <?php
                        }
                      }
                    ?>
                  </div>
                </li>
              <?php } ?>
            </ol>
          <?php } else {?>
            <h4>You don't have  made any review yet</h4>
          <?php } ?>
        </div>
      </section>

      <!-- My bookings Section -->
      <section class="results my-bookings">
        <h1>My bookings</h1>
        <?php if (count($userBookings) > 0) {
           foreach ($userBookings as $booking) {
         ?>
            <!-- booking results -->
            <div class="row">
              <!-- image -->
              <div class="hotel-img">
                <img src="./assets/images/<?php echo $booking['photo_url']; ?>" alt="">
              </div>
              <!-- hotel info -->
              <div class="hotel-info">
                <!-- hotel name -->
                <h3 class="list-name"><?php echo $booking['name']; ?></h3>
                <!-- location -->
                <ul>
                  <h3 class="list-city"><?php echo $booking['city']; ?>,</h3>
                  <h3 class="list-area"><?php echo $booking['area']; ?></h3>
                </ul>
                <!-- description -->
                <p><?php echo $booking['description_short']; ?></p>
                <form class="" action="room.php" method="get">
                    <p align="right">
                      <input type="hidden" id="room_id"  name="room_id" value="<?php echo $booking['room_id']; ?>">
                      <button type="submit" name="room-button" class="go-room">
                        Go to Room Page</button>
                    </p>
                </form>
              </div>
            </div>
            <!-- room informations -->
            <div class="row">
              <!-- cost per night -->
              <div class=" night-cost total-cost">
                <h3 class="per-night total-cost">Total Cost: <?php echo $booking['total_price']; ?>€</h3>
              </div>
              <!-- type and guests  -->
              <div class="guests-type booking-info">
                  <div class="list-guests checkin">
                    <h3>Check-in Date: <?php echo $booking['check_in_date']; ?></h3>
                  </div>
                  <div class="list-type checkout">
                    <h3>Check-in Date: <?php echo $booking['check_out_date']; ?></h3>
                  </div>
                  <div class="list-type">
                    <h3>Type of Room: <?php echo $booking['room_type']; ?></h3>
                  </div>
              </div>
            </div>
            <hr class="map-line">
        <?php }
            } else {?>
          <h4>You don't have any booking</h4>
        <?php } ?>
      </section>
    </main>
    <footer>
      <button onclick="topFunction()" id="toTopBtn" title="Go to top"></button>

      <p>© CollegLink 2021</>
    </footer>

    <script src="./JS/mobile-fav.js"></script>
    <script src="./JS/toTopButton.js"></script>

  </body>
</html>
