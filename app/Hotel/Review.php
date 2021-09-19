<?php
namespace Hotel;

use PDO;
use Hotel\BaseService;

class Review extends BaseService
{
  public function insert($roomId, $userId, $rate, $comment)
  {
    // start transactions
    $this->getPdo()->beginTransaction();


    // insert comments
    $statement = $this->getPdo()->prepare('INSERT INTO review (room_id, user_id, rate, comment)
    VALUES (:room_id, :user_id, :rate, :comment)');

    // Bind parameters
    $statement->bindParam(':room_id', $roomId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->bindParam(':rate', $rate, PDO::PARAM_INT);
    $statement->bindParam(':comment', $comment, PDO::PARAM_STR);

    $rows = $statement->execute();

    // Update room average stars
    $statement = $this->getPdo()->prepare('SELECT avg(rate) as avg_reviews, count(*) as count FROM review WHERE room_id = :room_id');

    $statement->bindParam(':room_id', $roomId, PDO::PARAM_INT);

    $statement->execute();

    $roomAverage = $statement->fetch(PDO::FETCH_ASSOC);


    $statement = $this->getPdo()->prepare('UPDATE room SET avg_reviews = :avg_reviews, count_reviews = :count_reviews
      WHERE room_id = :room_id');

    // Bind parameters
    $statement->bindParam(':room_id', $roomId, PDO::PARAM_INT);
    $statement->bindParam(':avg_reviews', $roomAverage['avg_reviews'], PDO::PARAM_STR);
    $statement->bindParam(':count_reviews', $roomAverage['count'], PDO::PARAM_INT);

    $statement->execute();
    // commit transaction
    return $this->getPdo()->commit();
  }

  public function getReviewsByRoom($roomId)
  {
    $sql = 'SELECT review.*, user.name as user_name
            FROM review
            INNER JOIN user ON review.user_id = user.user_id
            WHERE room_id = :room_id
            ORDER BY review.created_time DESC';

    $statement = $this->getPdo()->prepare($sql);

    $statement->bindParam(':room_id', $roomId, PDO::PARAM_INT);

    $statement->execute();

    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }

  public function getListByUser ($userId)
  {
    $parameters = [
      ':user_id' => $userId,
    ];
    $sql = 'SELECT review.*, room.name
    FROM review
    INNER JOIN room ON review.room_id = room.room_id
    WHERE  user_id = :user_id';

    return $this->fechAll($sql, $parameters);
  }

}
