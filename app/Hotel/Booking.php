<?php

namespace Hotel;

use PDO;
use DateTime;
use Hotel\BaseService;

class Booking extends BaseService
{
  public function isBooked($roomId, $checkInDate, $checkOutDate)
  {
    $sql = 'SELECT room_id
            FROM booking
            WHERE room_id = :room_id AND check_in_date <= :check_out_date AND check_out_date >= :check_in_date';

    $statement = $this->getPdo()->prepare($sql);

    // // Bind parameters
    $statement->bindParam(':room_id', $roomId, PDO::PARAM_INT);
    $statement->bindParam(':check_in_date', $checkInDate, PDO::PARAM_STR);
    $statement->bindParam(':check_out_date', $checkOutDate, PDO::PARAM_STR);

    $statement->execute();

    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return count($rows) > 0;
  }
  public function insert($roomId, $userId, $checkInDate, $checkOutDate)
  {
    // Begin transaction
    $this->getPdo()->beginTransaction();

    // Get room information
    $parameters = [
      ':room_id' => $roomId,
    ];

    $roomInfo = $this->fech('SELECT * FROM room WHERE room_id = :room_id;', $parameters);
    $price = $roomInfo['price'];

    // Calculate total price
    $checkInDateTime = new DateTime($checkInDate);
    $checkOutDateTime = new DateTime($checkOutDate);
    $totaldays = $checkOutDateTime->diff($checkInDateTime)->days;
    $totalPrice = $totaldays * $price;

    // Book room

    $statement = $this->getPdo()->prepare('INSERT INTO booking (user_id, room_id, check_in_date, check_out_date,	total_price)
    VALUES (:user_id, :room_id, :check_in_date, :check_out_date, :total_price)');

    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->bindParam(':room_id', $roomId, PDO::PARAM_INT);
    $statement->bindParam(':check_in_date', $checkInDate, PDO::PARAM_STR);
    $statement->bindParam(':check_out_date', $checkOutDate, PDO::PARAM_STR);
    $statement->bindParam(':total_price', $totalPrice, PDO::PARAM_INT);

    $statement->execute();

    return $this->getPdo()->commit();
  }

  public function getListByUser ($userId)
  {
    $parameters = [
      ':user_id' => $userId,
    ];
    $sql = 'SELECT booking.*, room.name, room.city, room.area, room.photo_url, room.description_short	, room_type.title as room_type
            FROM booking
            INNER JOIN room ON booking.room_id = room.room_id
            INNER JOIN room_type ON room.type_id = room_type.type_id
            WHERE  user_id = :user_id';

    return $this->fechAll($sql, $parameters);
  }
}
