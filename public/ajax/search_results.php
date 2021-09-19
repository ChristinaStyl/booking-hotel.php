Search results
<?php

  require __DIR__.'/../../boot/boot.php';

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


<!-- Search Result Section -->
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
            <input type="hidden" name="check_in_date" value="<?php echo $checkInDate; ?>">
            <input type="hidden" name="check_out_date" value="<?php echo $checkOutDate; ?>">
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
