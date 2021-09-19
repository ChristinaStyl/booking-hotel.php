<?php

  require __DIR__.'/../boot/boot.php';

  use Hotel\Room;
  use Hotel\RoomType;
  use Hotel\RoomPrices;
  use Hotel\User;

  //Get current user id
  $userId = User::getCurrentUserId();

  // initialize room service
  $room = new Room();

  // Get cities
  $cities = $room->getCities();

  // Get count of Guests
  $guests = $room->getGuests();

  // Get room types
  $type = new RoomType();
  $roomTypes = $type->getRoomTypes();

  $price = new RoomPrices();
  $roomPrices = $price->getRoomPrices();

  // get page parameters
  $selectedCity = $_REQUEST['city'];
  $selectedTypeId = $_REQUEST['room_type'];
  $selectedGuests = $_REQUEST['count-guest'];
  $checkInDate = $_REQUEST['check_in_date'];
  $checkOutDate = $_REQUEST['check_out_date'];

  // print_r($selectedGuests);die;

  if (!empty($_REQUEST['min'])){
    $minprice = $_REQUEST['min'];
  }
  else {
    $minprice = 0;
  }
  if (!empty($_REQUEST['max'])){
    $maxprice = $_REQUEST['max'];
  }
  else{
    $maxprice = 5000;
  }

  // Search for rooms
  $allAvailableRooms = $room->searchRooms($selectedCity,  new DateTime($checkInDate),new DateTime ($checkOutDate), $selectedTypeId, $selectedGuests, $minprice, $maxprice);

?>

<!DOCTYPE>
<html>
  <head>
    <meta charset="utf-8">
    <title> Search Results </title>
    <link rel="shortcut icon" href="assets\images\booking.png">


    <link  href="CSS\room-style.css" rel="stylesheet"/>
    <link  href="CSS\list-style.css" rel="stylesheet"/>
    <link  href="CSS\intex-style.css" rel="stylesheet"/>
    <link  href="assets/css/fontawesome.min.css" rel="stylesheet"/>

    <link
      rel="stylesheet"
      href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css"
    />

     <link rel="stylesheet" href="assets\css\jquery-ui.theme.css">

  </head>
  <body>
    <header>
      <div class="menu">
        <span id="hotel" href="#"></i>Hotels</span>
        <a id="home" href="./intex.php"><i class="fas fa-home"></i>Home</a>
        <a id="user"
        <?php if (empty($userId)){ ?>
          href="http://hotel.collegelink.localhost/public/intex.php">
        <?php }else {?>
          href="./profile.php">
        <?php } ?>
        | <i class="fas fa-user"></i>Profile</a>
      </div>
      <hr class="menu-line">

    </header>

    <main class="container list-section">
      <!-- Filter section mobile version -->
      <div id="mySidebar" class="sidebar">
         <a href="javascript:void(0)" class="closebtn" onclick="closeFilter()"><i class="fas fa-times"></i></a>
         <section class="filter-mob">
           <h1>FIND THE PERFECT HOTEL</h1>
           <!-- Select count of Guests -->
           <form class="searchForm" action="list.php" method="get">
             <div class="city-type">
               <select name="count-guest" id="count-guest" >
                 <option value="" disabled selected class="stable"> Count of Guests</option>
                 <?php
                   foreach ($guests as $guest) {
                 ?>
                 <option <?php echo $selectedGuests == $guest ? 'selected="selected"' : ''?>
                 value="<?php echo $guest; ?>"><?php echo $guest; ?></option>
                 <?php } ?>
               </select>
             </div>

             <!-- select room type -->
             <div class="city-type">
               <select name="room_type" id="room-type" >
                 <option value="" disabled selected class="stable">Room Type</option>
                 <?php
                   foreach ($roomTypes as $roomType) {
                 ?>
                 <option <?php echo $selectedTypeId == $roomType['type_id'] ? 'selected="selected"' : ''?>
                  value="<?php echo $roomType['type_id']; ?>"><?php echo $roomType['title']; ?></option>
                 <?php  } ?>
               </select>
             </div>

               <!-- Select City -->
               <div class="city-type">
                 <select name="city" id="city">
                   <option value="" disabled selected class="stable">City</option>
                   <?php
                     foreach ($cities as $city) {
                   ?>
                   <option <?php echo $selectedCity == $city ? 'selected="selected"' : ''?>
                     value="<?php echo $city; ?>"><?php echo $city; ?></option>
                   <?php } ?>
                 </select>
               </div>

               <div class="filter-price">
                 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
                 <div class="rangeslider">
                   <span class="range_min light left"><?php echo $minprice; ?> €</span>
                   <span class="range_max light right"><?php echo $maxprice; ?> €</span>
                   <input class="min" name="min" type="range" min="0" max="5000"
                    value="<?php echo $minprice; ?>" />
                   <input class="max" name="max" type="range" min="0" max="5000"
                    value="<?php echo $maxprice; ?>"  />
                 </div>
                 <ul class="min-max">
                   <h3 class="min-lef">PRICE MIN.</h3>
                   <h3 class="max-rig">PRICE MAX.</h3>
                 </ul>
               </div>

               <!-- Checkin-Chekout -->
              <div id="Checkin-checkout-mob" >
                 <div class="Checkin-checkout">
                   <input id="check_in_date-mob" name="check_in_date" type="text" placeholder="Check-in Date" class="checkin"
                   value="<?php echo $checkInDate; ?>"/>
                 </div>
                 <div class="Checkin-checkout">
                   <input id="check_out_date-mob" name="check_out_date" type="text" placeholder="Check-out Date"class="checkout"
                   value="<?php echo $checkOutDate; ?>" />
                 </div>
                 <div id="error-mob"></div>
              </div>
               <!-- Find button -->
               <div>
                 <button class="find-button mob-button">FIND HOTEL</button>
               </div>
             </form>
           </div>
         </section>
       </div>
       <div id="mob-filter">
         <button class="openbtn" onclick="openFilter()"><i class="fas fa-filter"></i>Filter</button>
       </div>

        <!-- Filter Section -->
        <section class="filter">
          <h1>FIND THE PERFECT HOTEL</h1>
          <form class="searchForm" action="list.php" method="get">
            <div class="city-type">
              <select name="count-guest" id="count-guest" >
                <option value="" disabled selected class="stable">Count of Guests</option>
                <?php
                  foreach ($guests as $guest) {
                ?>
                <option class="new" <?php echo $selectedGuests == $guest ? 'selected="selected"' : ''?>
                value="<?php echo $guest; ?>"><?php echo $guest; ?></option>
                <?php } ?>
              </select>
            </div>
            <!-- select room type -->
            <div class="city-type">
              <select name="room_type" id="room-type" >
                <option value="" disabled selected class="stable"> Room Type</option>
                <?php
                  foreach ($roomTypes as $roomType) {
                ?>
                <option <?php echo $selectedTypeId == $roomType['type_id'] ? 'selected="selected"' : ''?>
                 value="<?php echo $roomType['type_id']; ?>"><?php echo $roomType['title']; ?></option>
                <?php  } ?>
              </select>
            </div>

            <!-- Select City -->
            <div class="city-type">
              <select name="city" id="city">
                <option value="" disabled selected class="stable">City</option>
                <?php
                  foreach ($cities as $city) {
                ?>
                  <option <?php echo $selectedCity == $city ? 'selected="selected"' : ''?>
                    value="<?php echo $city; ?>"><?php echo $city; ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="filter-price">
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
              <div class="rangeslider">

                  <span class="range_min light left"><?php echo $minprice; ?> €</span>
                  <span class="range_max light right"><?php echo $maxprice; ?> €</span>
                  <input class="min" name="min" type="range" min="0" max="5000"
                    value="<?php echo $minprice; ?>" />
                  <input class="max" name="max" type="range" min="0" max="5000"
                    value="<?php echo $maxprice; ?>" />
              </div>
              <ul class="min-max">
                <h3>PRICE MIN.</h3>
                <h3 class="max-rig">PRICE MAX.</h3>
              </ul>
            </div>

            <!-- Checkin-Chekout -->
            <div id="Checkin-checkout-" >
              <div class="Checkin-checkout">
                <input  id="check_in_date" name="check_in_date" type="text" placeholder="Check-in Date" class="checkin"
                value="<?php echo $checkInDate; ?>"/>
              </div>
              <div class="Checkin-checkout">
                <input id="check_out_date" name="check_out_date" type="text" placeholder="Check-out Date" class="checkout"
                value="<?php echo $checkOutDate; ?>"/>
              </div>
              <div id="error" style="color:red;"></div>
            </div>
              <!-- Find button -->
            <div>
              <button class="find-button">FIND HOTEL</button>
            </div>
          </form>
          <!-- Select count of Guests -->
        </section>

        <!-- Search Result Section -->
        <div id="results-container">
          <section class="results">
            <h1>Search Results</h1>
            <!-- Search results -->
            <?php
              foreach ($allAvailableRooms as $availableRoom) {
            ?>
            <div class="row">
              <!-- image -->
              <div class="hotel-img">
                <img src="./assets/images/<?php echo $availableRoom['photo_url']; ?>" alt="">
              </div>
              <!-- hotel info -->
              <div class="hotel-info">
                <!-- hotel name -->
                <h3 class="list-name"><?php echo $availableRoom['name']; ?></h3>
                <!-- location -->
                <ul>
                  <h3 class="list-city"><?php echo $availableRoom['city']; ?>, </h3>
                  <!-- <h4>, </h4> -->
                  <h3 class="list-area"><?php echo $availableRoom['area']; ?></h3>
                </ul>
                <!-- description -->
                <p><?php echo $availableRoom['description_short']; ?>
                </p>
                <!-- go to room button -->

                <form class="" action="room.php" method="get">
                    <p align="right">
                      <input type="hidden" id="room_id"  name="room_id" value="<?php echo $availableRoom['room_id']; ?>">
                      <input type="hidden" id="check_in_date" name="check_in_date" value="<?php echo $checkInDate; ?>">
                      <input type="hidden" id="check_out_date" name="check_out_date" value="<?php echo $checkOutDate; ?>">
                      <button type="submit" name="room-button" class="go-room">
                        Go to Room Page</button>
                    </p>
                </form>
              </div>
            </div>
            <!-- room informations -->
            <div class="row">
              <!-- cost per night -->
              <div class="night-cost">
                <h3 class="per-night">Per Night: <?php echo $availableRoom['price']; ?>	€</h3>
              </div>
              <!-- type and guests  -->
              <div class="guests-type">
                  <div class="list-guests">
                    <h3>Count of Guests: <?php echo $availableRoom['count_of_guests']; ?></h3>
                  </div>

                  <div class="list-type">
                    <h3>Type of Room: <?php
                      foreach ($roomTypes as $roomType) {
                        if ($availableRoom['type_id'] == $roomType['type_id']) {
                          echo $roomType['title'];
                        }
                      }?>
                    </h3>
                  </div>
              </div>
            </div>
            <?php } ?>
            <?php
              if (count($allAvailableRooms) == 0) {
            ?>
              <h2 class="no-rooms" style="color:#DA0000;font-size:28px;text-align:center;"> There are no rooms!!!</h2>
            <?php } ?>
            <hr class="map-line">
          </section>
        </div>

    </main>
    <footer>
      <button onclick="topFunction()" id="toTopBtn" title="Go to top"></button>

      <p>© CollegLink 2021</>
    </footer>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="./JS/datepicker.js"></script>
    <script src="./JS/\price-range.js"></script>
    <script src="./JS/mobile-filter.js"></script>
    <script src="./JS/toTopButton.js"></script>
    <script src="./assets/pages/search.js"></script>
    <script src="./JS/validation-filter.js"></script>

  </body>
</html>
