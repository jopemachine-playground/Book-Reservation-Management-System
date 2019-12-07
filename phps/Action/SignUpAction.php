<?php
  require_once('../MySQLConection.php');

  // DB 연결
  $connect_object = MySQLConnection::DB_Connect('db_hw');

  // Post 방식으로 유저 데이터를 가져옴
  $ID           = $_POST["ID"];
  $PW           = $_POST["PW"];
  $PW_Confirm   = $_POST["PW_Confirm"];
  $Name         = $_POST["Name"];
  $Email        = $_POST["Email"];
  $Telephone    = $_POST["Telephone"];
  $Position     = $_POST["Position"];

  // DB에서 PK (ID) 중복 검사
  $searchUserID = "
    SELECT * FROM user
  ";

  $ret = mysqli_query($connect_object, $searchUserID);

  // 중복 ID가 존재하는 경우 에러처리
  while($row = mysqli_fetch_array($ret)){
    if($ID == $row['ID']){
      echo ("<script language=javascript>alert('중복된 ID가 있습니다.')</script>");
      echo ("<script>location.href='../../SignUp.html';</script>");
      exit();
    }
  }

  // DB에 새 레코드 입력
  $insertData = "
    Insert INTO user (
      ID,
      PW,
      Name,
      Email,
      Telephone,
      Position
      ) VALUES(
      '$ID',
      '$PW',
      '$Name',
      '$Email',
      '$Telephone',
      '$Position'
  )";

  mysqli_query($connect_object, $insertData) or die("Error Occured in Inserting Data to DB");

  echo ("<script language=javascript>alert('회원가입이 완료되었습니다!')</script>");
  echo ("<script>location.href='../View/SignIn.php';</script>");

  mysqli_close($connect_object);
