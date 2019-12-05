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
    SELECT *
    FROM book
    LEFT OUTER JOIN borrow
    ON book.ISBN = borrow.ISBN
    LEFT OUTER JOIN reservation
    ON book.ISBN = reservation.ISBN
    WHERE book.ISBN LIKE \"%". $Content . "%\"
  ";
}
else {
  $searchBook = "
    SELECT *
    FROM book
    LEFT OUTER JOIN borrow
    ON book.ISBN = borrow.ISBN
    LEFT OUTER JOIN reservation
    ON book.ISBN = reservation.ISBN
    WHERE book.Name LIKE \"%". $Content . "%\"
  ";
}

$resComponent = "";

$searchRes = mysqli_query($connect_object, $searchBook) or die("Error Occured in Searching Data to DB");

if(mysqli_num_rows($searchRes) === 0){
  echo '해당 책이 존재하지 않습니다.';
  exit();
}

// 0 : ISBN
// 1 : Name
// 2 : PublishHouse
// 3 : Author
// 4 : ReturnReq
// 5 : 대출한 사람의 ID (대출 중인 경우)
// 12: 예약 중인 경우 예약자의 ID

while($oneBook = mysqli_fetch_array($searchRes)){

  if(empty($oneBook[4])) {
    $canBorrow = "대출 가능";
  }
  else {
    $canBorrow = "대출 중";
  }

  if(isset($oneBook[12])){
    $isBooking = "예약 중";
  }
  else{
    $isBooking = "예약 가능";
  }

  $resComponent .= sprintf('
    <div class="list-group">
      <div class="BookInfo" class="list-group-item">
        <div>책 제목: %s</div>
        <div class="ISBN">ISBN: %s</div>
        <div>출판사: %s</div>
        <div>저자: %s</div>
        <div>대출 가능 여부: %s</div>
        <div>현재 예약 여부: %s</div>
      </div>
      <button type="submit" class="btn btn-white btn-block" style="" onclick="borrow($(this))">대출</button>
      <button type="submit" class="btn btn-white btn-block" style="margin-bottom: 35px;" onclick="reserve($(this))">예약</button>
    </div>
  ', $oneBook[1], $oneBook[0], $oneBook[2], $oneBook[3], $canBorrow, $isBooking);
}

echo $resComponent;
