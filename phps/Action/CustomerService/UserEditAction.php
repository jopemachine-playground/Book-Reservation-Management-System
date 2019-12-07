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

  // DB 연결
  $connect_object = MySQLConnection::DB_Connect('db_hw');

  $PW = $_POST['PW'];
  $Name = $_POST['Name'];
  $Telephone = $_POST['Telephone'];
  $Position = $_POST['Position'];
  $Email = $_POST['Email'];

  $updateUserRecord = "
    UPDATE user SET
      PW = '$PW',
      Name = '$Name',
      Email = '$Email',
      Telephone = '$Telephone',
      Position = '$Position'
      WHERE ID = '$UserID'
  ";

  mysqli_query($connect_object, $updateUserRecord) or die("Error Occured in Updating Data in DB");

  echo ("<script language=javascript>alert('정보 수정이 완료되었습니다!')</script>");

  echo ("<script>location.href='../View/CustomerService/CustomerMainPage.php';</script>");
