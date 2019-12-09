<?php
  session_start();
  $UserID = $_SESSION['user_id'];

  require_once('../../MySQLConection.php');

  $connect_object = MySQLConnection::DB_Connect('db_hw') or die("Error Occured in Connection to DB");


  // 세션에 ID가 없다면, 이용할 수 없으니, SignIn 페이지로 이동
  if(!isset($UserID)) {
    echo ("<script language=javascript>alert('먼저 로그인하세요!')</script>");
    echo ("<script>location.href='../SignIn.php';</script>");
    exit();
  }

  // 현재 빌렸던 책들을 모두 조회
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
    WHERE borrowTbl.ReturnDate IS NOT NULL
  ";

  $searchRes = mysqli_query($connect_object, $searchBorrowedBook) or die("Error Occured in Fetching data in DB");

  // 0 : ISBN
  // 1 : Name
  // 2 : PublishHouse
  // 3 : Author
  // 4 : ReturnReq
  // 8 : 대출 DateTime
  // 9 : 반납 DateTime

  $resComponent = "";

  while($oneBook = mysqli_fetch_array($searchRes)){

    $ISBN = $oneBook[0];
    $BookName = $oneBook[1];
    $PublishHouse = $oneBook[2];
    $Author = $oneBook[3];

    $LoanDate = $oneBook[8];
    $ReturnedDate = $oneBook[9];

    $resComponent .= sprintf('
      <div class="list-group">
        <div class="BookInfo" class="list-group-item">
          <div>책 제목: %s</div>
          <div class="ISBN">ISBN: %s</div>
          <div>출판사: %s</div>
          <div>저자: %s</div>
          <div>대출날짜: %s</div>
          <div>반납날짜: %s</div>
        </div>
      </div>
    ', $BookName, $ISBN, $PublishHouse, $Author, $LoanDate, $ReturnedDate);
  }

  echo sprintf('
    <div class="list-group">
      <a class="list-group-item active" style="background-color: #474747!important; color: #ffffff; border: none !important;">대출했던 도서들</a>
      <div class="list-group-item">
        <p class="lead">대출했던 책들의 목록을 조회합니다.</p>
        %s
      </div>
    </div>
  ', $resComponent);
