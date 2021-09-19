<?php

namespace Hotel;

use PDO;

use Hotel\BaseService;

class RoomPrices extends BaseService
{
  public function getRoomPrices()
  {
    // Get all types
    return $this->fechAll('SELECT price FROM room');
  }
}
