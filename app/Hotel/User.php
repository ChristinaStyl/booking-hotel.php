<?php

namespace Hotel;

use PDO;
use Hotel\BaseService;


class User extends BaseService
{
  // Signing key
  const TOKEN_KEY = 'asfdhkgjlr;ofijhgbfdklfsadf';

  private static $currentUserId;

  public function getByEmail($email)
  {
    $parameters = [
      ':email' => $email,
    ];
    return $this->fech('SELECT * FROM user WHERE email = :email', $parameters);
  }

  public function getByUserId($userId)
  {
    $parameters = [
      ':user_id' => $userId,
    ];
    return $this->fech('SELECT * FROM user WHERE user_id = :user_id', $parameters);
  }

  public function getList()
  {
    return $this->fechAll('SELECT * FROM user');
  }

  public function insert ($name, $email, $password)
  {
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // prepare statement
    $statement = $this->getPdo()->prepare('INSERT INTO user (name, email, password)
    VALUES (:name, :email, :password)');

    // Hash password


    // Bind parameters
    $statement->bindParam(':name', $name, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $passwordHash, PDO::PARAM_STR);

    $rows = $statement->execute();

    return $rows == 1;
  }

  // Verify user
  public function verify($email, $password)
  {
    // Step1- retrieve User
    $user = $this->getByEmail($email);

    // Step2 verify user password
    return password_verify($password, $user['password']);
  }

  public function generateToken($userId, $csrf ='')
  {
    // Create token payload
  	$payload = [
  	    'user_id' => $userId,
        'csrf'=> $csrf ?: md5(time()),
  	];
  	$payloadEncoded = base64_encode(json_encode($payload));
  	$signature = hash_hmac('sha256', $payloadEncoded, self::TOKEN_KEY);

  	return sprintf('%s.%s', $payloadEncoded, $signature);
  }

  public function getTokenPayload($token)
  {
      // Get payload and signature
      [$payloadEncoded] = explode('.', $token);

      // Get payload
      return json_decode(base64_decode($payloadEncoded), true);
  }

  public function verifyToken($token)
  {
      // Get payload
      $payload = $this->getTokenPayload($token);
      $userId = $payload['user_id'];
      $csrf = $payload['csrf'];

      // Generate signature and verify
      return $this->generateToken($userId, $csrf) == $token;
  }

  public function getCsrf()
  {
    $token = $_COOKIE['user_token'];
    $payload = self::getTokenPayload($token);

    return $payload['csrf'];
  }

  public function verifyCsrf($csrf)
  {
    return self::getCsrf() == $csrf;
  }

  public static function getCurrentUserId()
  {
    return self::$currentUserId;
  }

  public static function setCurrentUserId($userId)
  {
    self::$currentUserId = $userId;
  }
}
