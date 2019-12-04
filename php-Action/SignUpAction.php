<?php
require_once('MySQLConection.php');

// DB 연결
$connect_object = MySQLConnection::DB_Connect('db_hw');

// Post 방식으로 유저 데이터를 가져옴
$ID           = $_POST["ID"];
$PW           = $_POST["PW"];
$PW_Confirm   = $_POST["PW_Confirm"];
$Address      = $_POST["Name"];
$PhoneNumber  = $_POST["Email"];
$Gender       = $_POST["Telephone"];
$Email        = $_POST["Positon"];

$reg_ID       = preg_match('/^[a-zA-z]{1}[\w]{3,19}$/', $ID, $r1);
$reg_Email    = preg_match('/^[\w]([-_.]?[\w])*@[\w]([-_.]?[\w])*.[a-zA-Z]{2,3}$/i', $Email, $r2);

// 매칭되지 않는 값이 들어올 경우 UserEdit을 실행하지 않는다
if(!empty($Email)){
  if($reg_Email == 0){
    echo ("<script language=javascript>alert('잘못된 형식의 이메일 입력입니다.')</script>");
    echo ("<script>location.href='../SignUp.html';</script>");
    exit();
  }
}

// 매칭되지 않는 값이 들어올 경우 UserEdit을 실행하지 않는다
if($reg_ID == 0){
  echo ("<script language=javascript>alert('잘못된 형식의 ID 입력입니다.')</script>");
  echo ("<script>location.href='../SignUp.html';</script>");
  exit();
}

// DB에서 PK (ID) 중복 검사
$searchUserID = "
  SELECT * FROM usersinfotbl
";

$ret = mysqli_query($connect_object, $searchUserID);

// 중복 ID가 존재하는 경우 에러처리
while($row = mysqli_fetch_array($ret)){
  if($ID == $row['ID']){
    echo ("<script language=javascript>alert('중복된 ID가 있습니다.')</script>");
    echo ("<script>location.href='../SignUp.html';</script>");
    exit();
  }
}

// DB에 새 레코드 입력
$insertData = "
  Insert INTO customer (
    ID,
    PW,
    Name,
    Email,
    Telephone,
    Position,
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
echo ("<script>location.href='../SignIn.php';</script>");

mysqli_close($connect_object);
