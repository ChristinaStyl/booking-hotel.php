<?php
  require __DIR__.'/../boot/boot.php';

  use Hotel\RoomInfo;
  use Hotel\Favorite;
  use Hotel\User;
  use Hotel\Review;
  use Hotel\Booking;

   $info = new RoomInfo();
   $favorite = new Favorite();
   $booking = new Booking();
   $user = new User();

   // check room id
   $roomId = $_REQUEST['room_id'];

   if (empty ($roomId)){
     header('Location: intex.php');

     return;
   }

   // load room info
   $roomInfo = $info->getRoomInfo($roomId);
   if (empty ($roomInfo)){
     header('Location: intex.php');

     return;
   }

   //Get current user id
   $userId = User::getCurrentUserId();

   // Check if room is favorite for current user
   $isFavorite = $favorite->isFavorite($roomId, $userId);

   // Load all Reviews
   $review = new Review();
   $allReviews = $review->getReviewsByRoom($roomId);

   $checkInDate = $_REQUEST['check_in_date'];
   $checkOutDate = $_REQUEST['check_out_date'];

   $alreadyBooked = empty($checkInDate) || empty($checkOutDate);
   if (!$alreadyBooked){
     //Look for bookings
     $alreadyBooked = $booking->isBooked($roomId, $checkInDate, $checkOutDate);
   }

   $csrf = $user->getCsrf();
?>

<!DOCTYPE>
<htlm>
  <head>
    <meta charset="utf-8">
    <title> Room </title>
    <link rel="shortcut icon" href="assets\images\booking.png">

    <link  href="CSS\room-style.css" rel="stylesheet"/>
    <link  href="CSS\intex-style.css" rel="stylesheet"/>
    <link  href="CSS\list-style.css" rel="stylesheet"/>
    <link  href="assets/css/fontawesome.min.css" rel="stylesheet"/>

    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="./assets/pages/room.js"></script>

  </head>

  <body>
    <header>
      <div class="menu">
        <span id="hotel"></i>Hotels</span>
        <a id="home" href="./intex.php"><i class="fas fa-home"></i>Home </a>

        <a id="user"
        <?php if (empty($userId)){ ?>
          href="http://hotel.collegelink.localhost/public/intex.php">
        <?php }else {?>
          href="./profile.php">
        <?php } ?>
        | <i class="fas fa-user"></i>Profile</a>
      <hr class="menu-line">
    </header>

    <main class="container">
        <!-- Title -->
        <div class="room-title">
          <ul class="title">
            <h3 class="name"><?php echo $roomInfo['name']; ?> - <?php echo $roomInfo['city']; ?>,
            <?php echo $roomInfo['area']; ?> | Reviews: </h3>
            <div class="stars title-reviews">
              <?php
                $roomAvrReview = $roomInfo['avg_reviews'] ;
                for ($i=1; $i <=5 ; $i++) {
                  if ($roomAvrReview >= $i) {
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
            <h4>|</h4>
            <div class="favorite col-md-1" id="favorite-container">
              <form id="favoriteForm" class="favoriteForm" name="favoriteForm" method="POST" action="actions/favorite.php">
                <a href="#" onclick="postFunction()">
                <input type="hidden" name="check_in_date" value="<?php echo $checkInDate; ?>">
                <input type="hidden" name="check_out_date" value="<?php echo $checkOutDate; ?>">
                <input type="hidden" name="room_id" value="<?php echo $roomId;?>">
                <input type="hidden" name="csrf" value="<?php echo $csrf?>">
                <input type="hidden" name="is_favorite" value="<?php echo $isFavorite ? '1' : '0'; ?>">
                <div class="search_stars_div">
                  <ul class="fav_stars" style="list-style-type:none;">
                    <li  class="heart <?php echo $isFavorite ? 'selected'  : ' ';?>" id="fav"><i class="fas fa-heart"></i></li>
                  </ul>
                </div>
               </a>
             </form>
             <script>
                function postFunction() {
                    document.getElementById("favoriteForm").submit();
                }
            </script>
            </div>
            <div class="title-cost">
              <h3 class="cost">Per Night: <?php echo $roomInfo['price']; ?>€</h3>
            </div>
          </ul>
        </div>

        <!-- room image -->
        <div class="room-image">
          <img src="./assets/images/<?php echo $roomInfo['photo_url']; ?>" alt="">
        </div>

        <!-- Room information -->
        <div class="room-info">
          <ul class="info">
            <div class="user-info">
              <h3><i class="fas fa-user"></i> <?php echo $roomInfo['count_of_guests']; ?> <br>
              COUNT OF GUESTS</h3>
            </div>
            <div class="guests-info">
              <h3><i class="fas fa-bed"></i> <?php echo $roomInfo['room_type']; ?> <br>
              TYPE OF ROOM</h3>
            </div>
            <div class="parking-info">
              <h3><i class="fas fa-car"></i> <?php echo $roomInfo['parking'] == 1 ? "Yes" : 'No';?> <br>
              PARKING</h3>
            </div>
            <div class="wifi-info">
              <h3><i class="fas fa-wifi"></i> <?php echo $roomInfo['wifi'] == 1 ? "Yes" : 'No'; ?> <br>
              WIFI</h3>
            </div>
            <div class="pet-info">
              <h3><i class="fas fa-paw"></i> <?php echo $roomInfo['pet_friendly'] == 1 ? "Yes" : 'No'; ?> <br>
              PET FRIENDLY</h3>
            </div>
          </ul>

        </div>

        <!-- Room description -->
        <div class="room-descreiption">
          <div class="vl">
            <h1>Room Descreiption</h1>
            <p><?php echo $roomInfo['description_long']; ?></p>
          </div>
          <div class="booking-buttons">
            <?php
            if ($alreadyBooked) {
            ?>
              <button disabled type="button" name="button" class="booked">Already Booked</button>
            <?php } else { ?>
              <form name="bookingForm" action="actions/book.php" method="post">
                <input type="hidden" name="room_id" value="<?php echo $roomId;?>">
                <input type="hidden" name="csrf" value="<?php echo $csrf?>">
                <input type="hidden" name="check_in_date" value="<?php echo $checkInDate; ?>">
                <input type="hidden" name="check_out_date" value="<?php echo $checkOutDate; ?>">
                <button type="submit" class="book">Book Now</button>
              </form>
            <?php } ?>
          </div>

        </div>

        <!-- Map -->
        <div class="map" id="googleMap" style="width:100%;height:400px;">
          <iframe src="http://maps.google.com/maps?q=<?php echo $roomInfo['location_lat'];?>,<?php echo $roomInfo['location_long'];?>&z=15&output=embed"
            style="width:100%;height:400px;" ></iframe>
          <hr class="map-line">
        </div>

        <!-- Reviews -->
        <section class="reviews">
          <h1>Reviews</h1>
          <div id="reviews-container">
            <?php
              foreach ($allReviews as $counter => $review) {
             ?>
              <div class="vl">
                <div class="old-reviews">
                  <h2><?php echo sprintf('%d. %s', $counter + 1, $review['user_name']);?>
                    <?php
                      for ($i=1; $i <=5 ; $i++) {
                        if ($review['rate'] >= $i) {
                          ?>
                          <i class="fas fa-star" style="color:#ffd043;"></i>
                          <?php
                        } else {
                          ?>
                          <i class="fas fa-star" style="color:#dddddd"></i>
                          <?php
                        }
                      }
                    ?>
                  </h2>
                  <h5 class="date">Add time: <?php echo $review['created_time']; ?></h5>
                  <p><?php echo htmlentities($review['comment']);?></p>
                </div>
              </div>
            <?php } ?>
          </div>
          <div class="vl">
            <h1>Add review</h1>
            <div class="add-review" id="add-review">
              <form name="reviewForm"class="reviewForm" action="actions/review.php" method="post">
                <input type="hidden" name="room_id" value="<?php echo $roomId ?>">
                <input type="hidden" name="csrf" value="<?php echo $csrf?>">
                <h2>
                    <div class="rate">
                      <input type="radio" id="star5" name="rate" value="5" />
                      <label for="star5" title="text">5 stars</label>
                      <input type="radio" id="star4" name="rate" value="4" />
                      <label for="star4" title="text">4 stars</label>
                      <input type="radio" id="star3" name="rate" value="3" />
                      <label for="star3" title="text">3 stars</label>
                      <input type="radio" id="star2" name="rate" value="2" />
                      <label for="star2" title="text">2 stars</label>
                      <input type="radio" id="star1" name="rate" value="1" />
                      <label for="star1" title="text">1 star</label>
                    </div>
                </h2>
                <div class="review-textarea">
                  <textarea id="note" name="comment" placeholder="Review" class="textbox"></textarea>
                  <button disabled type="submit" name="button" id="review-button">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </section>
    </main>
    <footer>
      <button onclick="topFunction()" id="toTopBtn" title="Go to top"></button>

      <p>© CollegLink 2021</>
    </footer>
    <script src="./JS/toTopButton.js"></script>
    <script src="./JS/validation-reviews.js"></script>

  </body>
</html>
