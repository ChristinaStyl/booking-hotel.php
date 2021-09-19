<?php

  require __DIR__.'/../boot/boot.php';

  use Hotel\Room;
  use Hotel\RoomType;
  use Hotel\User;

  // Get cities
  $room = new Room();
  $cities = $room->getCities();

  // Get room types
  $type = new RoomType();
  $roomTypes = $type->getRoomTypes();

  $userId = User::getCurrentUserId();
 ?>

<!DOCTYPE>
<html >
  <head>
    <meta charset="utf-8">
    <title> Home </title>
    <link rel="shortcut icon" href="assets\images\booking.png">

    <link  href="CSS\intex-style.css" rel="stylesheet"/>
    <link  href="assets/css/fontawesome.min.css" rel="stylesheet"/>

    <link
      rel="stylesheet"
      href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css"
    />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets\css\jquery-ui.theme.css">
  </head>


  <body>
    <header class="intex-menu">
      <span id="hotel" href="#"></i>Hotels</span>
      <span id="home" href="#"><i class="fas fa-home"></i>Home |</span>
      <a id="register"
      <?php if (!empty($userId)){ ?>
        href="http://hotel.collegelink.localhost/public/intex.php">
      <?php }else {?>
        href="./register.php">
      <?php } ?>
      <i class="fas fa-user-plus"></i>Sign up |</a>

      <?php if (!empty($userId)){?>
        <a id="logout" href="actions/logout.php">Log out <i class="fas fa-sign-out-alt"></i></a>
      <?php } else {?>
        <a id="login" href="./login.php"><i class="fas fa-sign-in-alt"></i>Login |</a>
      <?php } ?>

      <?php if (!empty($userId)){ ?>
        <a id="user"  href="./profile.php">| <i class="fas fa-user"></i>Profile</a>
      <?php } ?>



    </header>

    <main>
      <section class="image">
        <div class="box">
          <form name="searchForm" method="get" action="list.php"  onsubmit="return validateForm()">
            <!-- Select City -->
            <div class="city-type">
              <select  name="city"  id="city">
                <option value="" disabled selected class="stable">City *</option>
                <?php
                  foreach ($cities as $city) {
                ?>
                  <option value="<?php echo $city; ?>"><?php echo $city; ?></option>
                <?php } ?>
              </select>

            <!-- select room type -->
              <div class="right">
                <select name="room_type" id="room-type" >
                  <option value="" disabled selected class="stable">Room Type</option>
                  <?php
                    foreach ($roomTypes as $roomType) {
                  ?>
                    <option value="<?php echo $roomType['type_id']; ?>"><?php echo $roomType['title']; ?></option>
                  <?php } ?>
                </select>

              </div>
            </div>

            <!-- Checkin-Chekout -->
            <div class="Checkin-checkout" id="Checkin-checkout">
              <input id="check_in_date" name="check_in_date"  type="text" placeholder="Check-in Date *" class="checkin"/>
              <input id="check_out_date" name="check_out_date" type="text" placeholder="Check-out Date *"class="checkout"/>
              <div class="text-danger error1">Cannot select a date in the past.</div>
              <div class="text-danger error2">Checkout date is greater than Checkin date.</div>
            </div>
            <!-- Search button -->
            <div >
              <button disabled type="submit" class="Search-button" id="search">Search</button>
            </div>
          </form>
        </div>
      </section>
    <main>

    <footer>
      <p>© CollegLink 2021</>

    </footer>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="./JS/datepicker.js"></script>
    <script src="./JS/validate-checkin-checkout.js"></script>
  </body>
</html>
