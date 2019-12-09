<?php

  session_start();

  $UserID = $_SESSION['user_id'];

  // 세션에 ID가 없다면, 이용할 수 없으니, SignIn 페이지로 이동
  if(!isset($UserID)){
    echo ("<script language=javascript>alert('먼저 로그인하세요!')</script>");
    echo ("<script>location.href='../../View/SignIn.php';</script>");
    exit();
  }

  require_once('../../MySQLConection.php');

  $connect_object = MySQLConnection::DB_Connect('db_hw') or die("Error Occured in Connection to DB");

  $ISBN = $_POST["ISBN"];
  $User_Position = $_POST["Position"];

  $CurrDateTime = date("Y-m-d") . date("H:i:s");

  $BorrowID     = Hashing("sha256", $UserID . $ISBN . $CurrDateTime);

  $LoanPeriod = "";

  if($User_Position === "학부생"){
    $LoanPeriod = 10;
  }
  else if($User_Position === "대학원생"){
    $LoanPeriod = 30;
  }
  else if($User_Position === "교직원"){
    $LoanPeriod = 60;
  }

  // DB에 새 레코드 입력
  $borrow = "
    Insert INTO borrow (
      ID,
      ISBN,
      UserID,
      ReturnDueDate
      ) VALUES(
      '$BorrowID',
      '$ISBN',
      '$UserID',
      DATE_ADD(NOW(), INTERVAL $LoanPeriod DAY)
  )";

  echo $borrow;

  mysqli_query($connect_object, $borrow) or die("Error Occured in Deleting data in DB");

  function Hashing($Algorithm, $UniqueValue){
    return hash($Algorithm, $UniqueValue);
  }
