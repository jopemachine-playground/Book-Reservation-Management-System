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

  // 현재 빌리고 있는 책들을 조회
  $searchBorrowedBook = "
    SELECT *, count(reservationTbl.ISBN) AS ReservePersonnel
    FROM book AS bookTbl
    RIGHT OUTER JOIN
    (SELECT *
    FROM borrow
    WHERE borrow.UserID = '$UserID') AS borrowTbl
    ON bookTbl.ISBN = borrowTbl.ISBN
    LEFT OUTER JOIN reservation AS reservationTbl
    ON reservationTbl.ISBN = bookTbl.ISBN
    WHERE borrowTbl.ReturnDate IS NULL
    GROUP BY bookTbl.ISBN
    ORDER BY bookTbl.ISBN
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

  if(mysqli_num_rows($searchRes) < 1){
    $resComponent = sprintf('
      <div class="list-group">
        <div class="BookInfo" class="list-group-item">
          현재 대출한 도서가 없습니다.
        </div>
      </div>
    ');
  }

  while($oneBook = mysqli_fetch_array($searchRes)){

    $ISBN = $oneBook[0];
    $BookName = $oneBook[1];
    $PublishHouse = $oneBook[2];
    $Author = $oneBook[3];
    $ReturnReq = $oneBook[4];
    $BorrowedUserID = $oneBook[5];

    $ReturnDueDate = $oneBook[10];

    $ReservePersonnel = $oneBook[15];

    $HasReturnReq = "";

    if($ReturnReq === "0") {
      $ReturnReq = "false";
    }
    else {
      $ReturnReq = "true";
    }

    $resComponent .= sprintf('
      <div class="list-group">
        <div class="BookInfo" class="list-group-item">
          <div>책 제목: %s</div>
          <div class="ISBN">ISBN: %s</div>
          <div>출판사: %s</div>
          <div>저자: %s</div>
          <div class="canReserve">예약 중인 인원: %s</div>
          <div class="canReserve">반납 요청 여부: %s</div>
          <div class="canReserve">반납 기한: %s</div>
        </div>
        <button type="submit" class="btn btn-white btn-block" style="" onclick="reqReturn($(this))">반납 요청</button>
      </div>
    ', $BookName, $ISBN, $PublishHouse, $Author, $ReservePersonnel, $ReturnReq, $ReturnDueDate);

  }

  echo sprintf('
    <div class="list-group">
      <a class="list-group-item active" style="background-color: #474747!important; color: #ffffff; border: none !important;">내가 대출한 책 목록</a>
      <div class="list-group-item">
        <p class="lead">빌린 책을 조회합니다.</p>
        %s
      </div>
    </div>
  ', $resComponent);
