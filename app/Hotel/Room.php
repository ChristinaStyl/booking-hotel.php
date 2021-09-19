<?php

namespace Hotel;

use PDO;
use DateTime;
use Hotel\BaseService;

class Room extends BaseService
{
  public function getCities()
  {
    // Get all cities
    $sql = 'SELECT DISTINCT city FROM room';
    $rows = $this->fechAll($sql);

    // get only cities
    $cities = [];
    foreach ($rows as $row) {
      $cities[] = $row['city'];
    }
    return $cities;
  }

  public function getGuests()
  {
    // Get all cities
    $sql = 'SELECT DISTINCT count_of_guests FROM room';
    $rows = $this->fechAll($sql);

    // get only cities
    $guests = [];
    foreach ($rows as $row) {
      $guests[] = $row['count_of_guests'];
    }
    return $guests;
  }


  public function searchRooms($city, $checkInDate, $checkOutDate,  $typeId='', $Guests='', $minPrice='', $maxPrice='')
  {
    // Build query
    $sql = 'SELECT * FROM room
      WHERE city = :city AND ';
      if (!empty($minPrice)){
        $sql .= 'price >= :minprice AND ';
      }
      if (!empty($maxPrice)){
        $sql .= 'price <= :maxprice AND ';
      }
      if (!empty($typeId)){
        $sql .= 'type_id = :type_id AND ';
      }
      if (!empty($Guests)){
        $sql .= 'count_of_guests = :count_of_guests AND ';
      }
      $sql .='room_id NOT IN (
        SELECT room_id
        FROM booking
        WHERE check_in_date <= :check_out_date AND check_out_date >= :check_in_date
    )';

    $statement = $this->getPdo()->prepare($sql);

    // // Bind parameters
    $statement->bindParam(':city', $city, PDO::PARAM_STR);
    $statement->bindParam(':check_in_date', $checkInDate->format(DateTime::ATOM), PDO::PARAM_STR);
    $statement->bindParam(':check_out_date', $checkOutDate->format(DateTime::ATOM), PDO::PARAM_STR);

    if (!empty($typeId)){
      $statement->bindParam(':type_id', $typeId, PDO::PARAM_INT);
    }
    if (!empty($Guests)){
      $statement->bindParam(':count_of_guests', $Guests, PDO::PARAM_INT);
    }

    if (!empty($minPrice)){
      $statement->bindParam(':minprice', $minPrice, PDO::PARAM_INT);
    }

    if (!empty($maxPrice)){
      $statement->bindParam(':maxprice', $maxPrice, PDO::PARAM_INT);
    }

    $statement->execute();

    // // get  rooms
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }
}
