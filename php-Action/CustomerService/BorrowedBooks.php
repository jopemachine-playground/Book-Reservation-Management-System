<?php

  session_start();

  $UserID = $_SESSION['user_id'];

  require_once('../MySQLConection.php');

  // DB 연결
  $connect_object = MySQLConnection::DB_Connect('db_hw');

  // 세션에 ID가 없다면, 이용할 수 없으니, SignIn 페이지로 이동
  if(!isset($UserID)){
    echo ("<script language=javascript>alert('먼저 로그인하세요!')</script>");
    echo ("<script>location.href='../SignIn.php';</script>");
    exit();
  }

  $searchBorrowedBook = "
    SELECT *
    FROM book AS bookTbl
    RIGHT OUTER JOIN
    (SELECT *
    FROM borrow
    WHERE borrow.UserID = '$UserID') AS borrowTbl
    ON bookTbl.ISBN = borrowTbl.ISBN
    LEFT OUTER JOIN reservation AS reservationTbl
    ON reservationTbl.ISBN = bookTbl.ISBN
  ";

  $searchRes = mysqli_query($connect_object, $searchBorrowedBook) or die("Error Occured in Fetching data in DB");

  // 0 : ISBN
  // 1 : Name
  // 2 : PublishHouse
  // 3 : Author
  // 4 : ReturnReq
  // 5 : 대출한 사람의 ID
  // 10: 예약 중인 경우 예약 ID

  $resComponent = "";

  while($oneBook = mysqli_fetch_array($searchRes)){

    $ISBN = $oneBook[0];
    $BookName = $oneBook[1];
    $PublishHouse = $oneBook[2];
    $Author = $oneBook[3];
    $BorrowedUserID = $oneBook[5];

    $ReservedUserID = "예약 중이지 않습니다.";

    if(isset($oneBook[10])) {
      $ReservedUserID = "예약 중인 유저: " + $oneBook[10];
    }

    $resComponent .= sprintf('
      <div class="list-group">
        <div class="BookInfo" class="list-group-item">
          <div>책 제목: %s</div>
          <div class="ISBN">ISBN: %s</div>
          <div>출판사: %s</div>
          <div>저자: %s</div>
          <div class="canReserve">예약 존재 여부: %s</div>
        </div>
        <button type="submit" class="btn btn-white btn-block" style="" onclick="reqReturn($(this))">반납 요청</button>
      </div>
    ', $BookName, $ISBN, $PublishHouse, $Author, $ReservedUserID);
  }

  echo $resComponent;
