<?php
  session_start();
  $UserID = $_SESSION['user_id'];
  // 세션에 ID가 없다면, 이용할 수 없으니, SignIn 페이지로 이동

  if(!isset($UserID)){
    echo ("<script language=javascript>alert('먼저 로그인하세요!')</script>");
    echo ("<script>location.href='../SignIn.php';</script>");
    exit();
  }

  require_once('MySQLConection.php');

  // DB 연결
  $connect_object = MySQLConnection::DB_Connect('db_hw');

  // Post 방식으로 유저 데이터를 가져옴
  $PW           = $_POST["PW"];
  $PW_Confirm   = $_POST["PW_Confirm"];

  $Name         = $_POST["Name"];
  $Email        = $_POST["Email"];
  $Telephone    = $_POST["Telephone"];
  $Position     = $_POST["Position"];

  // ID와 같은 레코드를 업데이트 한다.
  $updateUserRecord = "
    UPDATE user SET
      PW = '$PW',
      Name = '$Name',
      Email = '$Email',
      Telephone = '$Telephone',
      Position = '$Position',
      WHERE ID = '$UserID'
  ";

  mysqli_query($connect_object, $updateUserRecord) or die("Error Occured in Updating Data in DB");
  echo ("<script language=javascript>alert('정보 수정이 완료되었습니다!')</script>");
  echo ("<script>location.href='../URL-Register.php';</script>");
