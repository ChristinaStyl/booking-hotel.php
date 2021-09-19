<?php

use Hotel\User;

//Boot Application
  require __DIR__.'/../../boot/boot.php';

//Return to home page if not a post request
if (strtolower($_SERVER['REQUEST_METHOD']) != 'post') {
  header('Location: /');

  return;
}

// Return to home page if there is already logged in
if (!empty(User::getCurrentUserId())) {
  header('Location: /');

  return;
}

// Verify user
$user = new User();
try {
  if (!$user->verify($_REQUEST['email'], $_REQUEST['password'])){
    header('Location: /login.php?error=Could not verify user');

    return;
  }
} catch (InvalidArgumentException $ex){
  header ('Location: /login.php?error=No user exist with the given email');

  return;
}

// Create user token  for 30 days
$userInfo = $user->getByEmail($_REQUEST['email']);
$token = $user->generateToken($userInfo['user_id']);
setcookie('user_token', $token, time()+(30*24*60*60), '/');

// Return to home ldap_control_paged_result
header('Location: http://hotel.collegelink.localhost/public/intex.php');
