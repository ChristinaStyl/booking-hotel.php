<?php

require __DIR__.'/../../boot/boot.php';

use Hotel\User;
$user = new User();

setcookie('user_token', $token1, time()+(30*24*60*60), '/');

// Return to home ldap_control_paged_result
header('Location: http://hotel.collegelink.localhost/public/intex.php');
