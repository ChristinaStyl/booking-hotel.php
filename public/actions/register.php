<?php

use Hotel\User;

//Boot Application
require_once __DIR__.'/../../boot/boot.php';


//Return to home page if not a post rewuest
if (mb_strtolower($_SERVER['REQUEST_METHOD']) != 'post') {
  header('Location: /');

  return;
}

// Create a new User
$user = new User();
$user->insert($_REQUEST['name'], $_REQUEST['email'], $_REQUEST['password']);

// retrieve user
$userInfo = $user->getByEmail($_REQUEST['email']);

// Generate token
$token = $user->generateToken($userInfo['user_id']);

//set setcookie
setcookie('user_token', $token, time()+(30*24*60*60), '/');

// Return to home ldap_control_paged_result
header('Location: http://hotel.collegelink.localhost/public/intex.php');
