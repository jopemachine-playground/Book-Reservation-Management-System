<?php
  session_start();
  $UserID = $_SESSION['user_id'];

  require_once('../../MySQLConection.php');

  // DB 연결
  $connect_object = MySQLConnection::DB_Connect('db_hw');

  // 세션에 ID가 없다면, 이용할 수 없으니, SignIn 페이지로 이동
  if(!isset($UserID)){
    echo ("<script language=javascript>alert('먼저 로그인하세요!')</script>");
    echo ("<script>location.href='../../View/SignIn.php';</script>");
    exit();
  }

  $ISBN = $_POST['ISBN'];

  $deleteBook = "
    DELETE FROM book WHERE ISBN ='$ISBN'
  ";

  mysqli_query($connect_object, $deleteBook) or die("Error Occured in DELETE Data to DB");
