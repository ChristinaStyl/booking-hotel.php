<?php

namespace Hotel;

use PDO;
use DateTime;
use Hotel\BaseService;

class RoomType extends BaseService
{
  public function getRoomTypes()
  {
    // Get all types
    return $this->fechAll('SELECT * FROM room_type');
  }
}
