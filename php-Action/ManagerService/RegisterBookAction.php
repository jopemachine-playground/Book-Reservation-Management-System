<?php
  session_start();
  $UserID = $_SESSION['user_id'];

  require_once('../MySQLConection.php');

  // DB 연결
  $connect_object = MySQLConnection::DB_Connect('db_hw');

  // 세션에 ID가 없다면, 이용할 수 없으니, SignIn 페이지로 이동
  if(!isset($UserID)){
    echo ("<script language=javascript>alert('먼저 로그인하세요!')</script>");
    echo ("<script>location.href='../../SignIn.php';</script>");
    exit();
  }

  $ISBN = $_POST['ISBN'];
  $Name = $_POST['BookName'];
  $PublishedHouse = $_POST['PublishedHouse'];
  $Author = $_POST['Author'];

  // DB에 새 레코드 입력
  $insertData = "
    Insert INTO book (
      ISBN,
      Name,
      PublishedHouse,
      Author
      ) VALUES(
      '$ISBN',
      '$Name',
      '$PublishedHouse',
      '$Author'
  )";

  echo $insertData;

  mysqli_query($connect_object, $insertData) or die("Error Occured in inserting Data to DB");

  echo ("<script language=javascript>alert('등록 완료!')</script>");
