<?php

class MySQLConnection{

  private static $database_host = "localhost";
  private static $database_user = "root";
  private static $database_password = "EVPasswd";

  public static function DB_Connect($database_name){
    $connect_object = mysqli_connect(self::$database_host, self::$database_user, self::$database_password, $database_name);
    if(mysqli_connect_error($connect_object)){
      echo "MySQL 접속 오류";
      echo "오류 원인 : ", mysqli_connect_error();
      exit();
    }
    return $connect_object;
  }

}
