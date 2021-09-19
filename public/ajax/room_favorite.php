<?php

use Hotel\User;
use Hotel\Favorite;

//Boot Application
require_once __DIR__.'/../../boot/boot.php';

// Return to home page if no user is logged in
if (empty(User::getCurrentUserId())) {
  echo "No current user for this operation.";
  die;
}

// check if room id given
$roomId = $_REQUEST['room_id'];
if (empty($roomId)) {
  echo "No room is given for this operation.";
  die;
}


// verify csrf
$csrf = $_REQUEST['csrf'];

$user = new User();
$csrfVerify = $user->verifyCsrf($csrf);

if ($csrf ='' || !$csrfVerify) {
  echo "This is an invalid request.";
  return;
}

// Set room to favorites
$favorite = new Favorite();

// add or remove room from favorites
$isFavorite = $_REQUEST['is_favorite'];

if (!$isFavorite) {
  $status = $favorite->addFavorite($roomId, User::getCurrentUserId());

} else{
  $status = $favorite->removeFavorite($roomId, User::getCurrentUserId());
}

// Return operation status
header('Content-Type: application/json');
echo json_encode([
  'status' => $status,
  'is_favorite' => !$isFavorite,
]);
