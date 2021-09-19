<?php

use Hotel\User;
use Hotel\Booking;

//Boot Application
require_once __DIR__.'/../../boot/boot.php';

// Return to home page if no user is logged in
if (empty(User::getCurrentUserId())) {
  header('Location: /');

  return;
}

// check if room id given
$roomId = $_REQUEST['room_id'];
if (empty($roomId)) {
  header('Location: /');

  return;
}

// verify csrf
$csrf = $_REQUEST['csrf'];

$user = new User();
$csrfVerify = $user->verifyCsrf($csrf);

if ($csrf ='' || !$csrfVerify) {
  return;
}

$checkInDate = $_REQUEST['check_in_date'];
$checkOutDate = $_REQUEST['check_out_date'];

// Create booking
$booking = new Booking();
$booking->insert($roomId, User::getCurrentUserId(), $checkInDate, $checkOutDate);


// Return to room page
header(sprintf('Location: http://hotel.collegelink.localhost/public/room.php?room_id=%s', $roomId));
