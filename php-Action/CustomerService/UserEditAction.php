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
  $Address      = $_POST["Address"];
  $PhoneNumber  = $_POST["PhoneNumber"];
  $Gender       = $_POST["Gender"];
  $Name         = $_POST["FirstName"] . ' '. $_POST["LastName"];
  $Email        = $_POST["Email"];
  $reg_Email = preg_match('/^[\w]([-_.]?[\w])*@[\w]([-_.]?[\w])*.[a-zA-Z]{2,3}$/i', $Email, $r2);
  // 매칭되지 않는 값이 들어올 경우 UserEdit을 실행하지 않는다
  if(!empty($Email)){
    if($reg_Email == 0){
      echo ("<script language=javascript>alert('잘못된 형식의 이메일 입력입니다.')</script>");
      echo ("<script>location.href='../UserEdit.php';</script>");
      exit();
    }
  }

  mysqli_query($connect_object, $updateUserRecord) or die("Error Occured in Updating Data in DB");
  echo ("<script language=javascript>alert('정보 수정이 완료되었습니다!')</script>");
  echo ("<script>location.href='../URL-Register.php';</script>");
