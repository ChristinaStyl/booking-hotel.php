<?php

namespace Hotel;

use PDO;
use Hotel\BaseService;

class RoomInfo extends BaseService
{
  public function getRoomInfo($room_id)
  {
    $parameters = [
      ':room_id' => $room_id,
    ];

    $sql = 'SELECT room.*, room_type.title as room_type
            FROM room
            INNER JOIN room_type ON room.type_id = room_type.type_id
            WHERE room_id = :room_id';
    // Get Room info
    return $this->fech($sql, $parameters);
  }
}
