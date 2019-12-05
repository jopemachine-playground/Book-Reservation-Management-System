<?php
  session_start();
  $UserID = $_SESSION['user_id'];

  require_once('MySQLConection.php');

  // DB 연결
  $connect_object = MySQLConnection::DB_Connect('db_hw');
  
  // 세션에 ID가 없다면, 이용할 수 없으니, SignIn 페이지로 이동
  if(!isset($UserID)){
    echo ("<script language=javascript>alert('먼저 로그인하세요!')</script>");
    echo ("<script>location.href='../SignIn.php';</script>");
    exit();
  }

  // DB에 UserID와 URLID가 같은 레코드를 뽑아 제거
  // ID까지 검사하는 이유는, 인증받지 않은 유저가 남의 서비스를 제거하는 것을 막기 위한 것임
  $deleteService = "
    DELETE FROM user WHERE UserID ='$UserID'
  ";

  mysqli_query($connect_object, $deleteService) or die("Error Occured in Deleting data in DB");
