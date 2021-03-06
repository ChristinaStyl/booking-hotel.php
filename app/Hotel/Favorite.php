<?php

namespace Hotel;

use PDO;
use Hotel\BaseService;

class Favorite extends BaseService
{
  public function isFavorite($roomId, $userId)
  {
    $parameters = [
      ':room_id' => $roomId,
      ':user_id' => $userId,
    ];

    $favorite = $this->fech('SELECT * FROM favorite WHERE room_id = :room_id AND user_id = :user_id', $parameters);
    return !empty($favorite);
  }

  public function addFavorite($roomId, $userId)
  {
      // check if favorite room already exists
      if ($this->isFavorite($roomId, $userId)) {
        return true;
      }
      $statement = $this->getPdo()->prepare('INSERT INTO favorite (room_id, user_id)
      VALUES (:room_id, :user_id)');

      // Bind parameters
      $statement->bindParam(':room_id', $roomId, PDO::PARAM_INT);
      $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);


      $rows = $statement->execute();

      return $rows ==1;
  }

  public function removeFavorite($roomId, $userId)
  {
    $statement = $this->getPdo()->prepare('DELETE FROM favorite WHERE room_id = :room_id AND user_id = :user_id');

    // Bind parameters
    $statement->bindParam(':room_id', $roomId, PDO::PARAM_INT);
    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);


    $rows = $statement->execute();

    return $rows ==1;
  }

  public function getListByUser ($userId)
  {
    $parameters = [
      ':user_id' => $userId,
    ];
    $sql = 'SELECT favorite.*, room.name
    FROM favorite
    INNER JOIN room ON favorite.room_id = room.room_id
    WHERE  user_id = :user_id';

    return $this->fechAll($sql, $parameters);
  }
}
