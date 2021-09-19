<?php

use Hotel\User;
use Hotel\Favorite;

//Boot Application
require_once __DIR__.'/../../boot/boot.php';


// Return to home page if no user is logged in
if (empty(User::getCurrentUserId())) {
  header('Location: /');
  return;
}

$checkInDate = $_REQUEST['check_in_date'];
$checkOutDate = $_REQUEST['check_out_date'];

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

// Set room to favorites
$favorite = new Favorite();

// add or remove room from favorites
$isFavorite = $_REQUEST['is_favorite'];
// print_r($isFavorite);die;

if (!$isFavorite) {

  $favorite->addFavorite($roomId, User::getCurrentUserId());

} else{
  $favorite->removeFavorite($roomId, User::getCurrentUserId());
}

header(sprintf('Location: http://hotel.collegelink.localhost/public/room.php?room_id=%s&check_in_date=%s&check_out_date=%s', $roomId, $checkInDate,$checkOutDate));
