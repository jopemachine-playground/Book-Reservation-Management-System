<?php

  session_start();

  if(isset($_SESSION['user_id'])){
    echo "<script>location.href='../ManageService.php';</script>";
  }

  require_once('MySQLConection.php');

  $connect_object = MySQLConnection::DB_Connect('db_hw');

  // Post 방식으로 유저 데이터를 가져옴
  $ID             = $_POST["ID"];
  $PW             = $_POST["PW"];

  // DB에서 PK (ID) 를 찾음
  $searchUserID = "
    SELECT * FROM user WHERE ID = '$ID'
  ";

  $ret = mysqli_query($connect_object, $searchUserID);

  $row = mysqli_fetch_array($ret);

  if(empty($row)){
    echo ("<script language=javascript>alert('존재하지 않는 계정입니다.')</script>");
    echo ("<script>location.href='../SignIn.php';</script>");
    exit();
  }

  else if($row['PW'] != $PW){
    echo ("<script language=javascript>alert('입력하신 ID의 비밀번호가 일치하지 않습니다.')</script>");
    echo ("<script>location.href='../SignIn.php';</script>");
    exit();
  }

   $_SESSION['user_id'] = $ID;

  echo ("<script>location.href='../ManageService.php';</script>");
