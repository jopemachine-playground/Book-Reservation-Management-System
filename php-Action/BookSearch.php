<?php

session_start();

require_once('MySQLConection.php');

$connect_object = MySQLConnection::DB_Connect('db_hw') or die("Error Occured in Connection to DB");

$UserID = $_SESSION['user_id'];

// 세션에 ID가 없다면, 이용할 수 없으니, SignIn 페이지로 이동
if(!isset($UserID)){
  echo ("<script language=javascript>alert('먼저 로그인하세요!')</script>");
  echo ("<script>location.href='../SignIn.php';</script>");
  exit();
}

$Content                  = $_GET["content"];
$SearchWithISBN           = $_GET["searchWithISBN"];
$SearchWithBookName       = $_GET["searchWithBookName"];

if($SearchWithISBN === "true"){
  $searchBook = "
    SELECT * FROM book WHERE ISBN LIKE \"%". $Content . "%\"
  ";
}
else {
  $searchBook = "
    SELECT * FROM book WHERE Name LIKE \"%". $Content . "%\"
  ";
}

$resComponent = "";

$searchRes = mysqli_query($connect_object, $searchBook) or die("Error Occured in Searching Data to DB");

if(mysqli_num_rows($searchRes) === 0){
  echo '해당 책이 존재하지 않습니다.';
  exit();
}

while($oneBook = mysqli_fetch_array($searchRes)){
  $resComponent .= sprintf('
    <div class="list-group">
      <div class="list-group-item">
        <div>책 제목: %s</div>
        <div>ISBN: %s</div>
        <div>출판사: %s</div>
        <div>저자: %s</div>
        <div>대출 가능 여부: %s</div>
      </div>
    </div>
  ', $oneBook[1], $oneBook[0], $oneBook[2], $oneBook[3], $oneBook[4]);
}

echo $resComponent;
