<?php
use Hotel\User;
use Hotel\Review;

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

// Add Review
$review = new Review();
$review->insert($roomId, User::getCurrentUserId(), $_REQUEST['rate'], $_REQUEST['comment']);

// Get all Reviews
$roomReviews = $review->getReviewsByRoom($roomId);
$counter = count($roomReviews);

// Load user
$user = new User();
$userInfo = $user->getByUserId(User::getCurrentUserId());

?>

<!-- HTML code -->
<div class="vl">
<div class="old-reviews">
  <h2><?php echo sprintf('%d. %s', $counter, $userInfo['name']);?>
    <?php
      for ($i=1; $i <=5 ; $i++) {
        if ($_REQUEST['rate'] >= $i) {
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
  <h5 class="date">Add time: <?php echo (new DateTime())->format('Y-m-d H:i:s'); ?></h5>
  <p><?php echo  $_REQUEST['comment']?></p>
</div>
