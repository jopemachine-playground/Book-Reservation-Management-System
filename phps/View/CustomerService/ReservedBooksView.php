<?php
  session_start();
  $UserID = $_SESSION['user_id'];

  // 세션에 ID가 없다면, 이용할 수 없으니, SignIn 페이지로 이동
  if(!isset($UserID)) {
    echo ("<script language=javascript>alert('먼저 로그인하세요!')</script>");
    echo ("<script>location.href='../SignIn.php';</script>");
    exit();
  }

  require_once('../../MySQLConection.php');

  $connect_object = MySQLConnection::DB_Connect('db_hw') or die("Error Occured in Connection to DB");

  $searchReservedBook = "
    SELECT *
    FROM book AS bookTbl
    RIGHT OUTER JOIN
    (SELECT *
    FROM reservation
    WHERE reservation.UserID = '$UserID') AS reservationTbl
    ON bookTbl.ISBN = reservationTbl.ISBN
  ";

  $searchRes = mysqli_query($connect_object, $searchReservedBook) or die("Error Occured in Fetching data in DB");

  $resComponent = "";

  while($oneBook = mysqli_fetch_array($searchRes)){

    $ISBN = $oneBook[0];
    $BookName = $oneBook[1];
    $PublishHouse = $oneBook[2];
    $Author = $oneBook[3];

    $resComponent .= sprintf('
      <div class="list-group">
        <div class="BookInfo" class="list-group-item">
          <div>책 제목: %s</div>
          <div class="ISBN">ISBN: %s</div>
          <div>출판사: %s</div>
          <div>저자: %s</div>
        </div>
        <button type="submit" class="btn btn-white btn-block" style="" onclick="cancelReservation($(this))">예약 취소</button>
      </div>
    ', $BookName, $ISBN, $PublishHouse, $Author);
  }

  echo sprintf('
    <div class="list-group">
      <a class="list-group-item active" style="background-color: #474747!important; color: #ffffff; border: none !important;">내가 예약한 책 목록</a>
      <div class="list-group-item">
        <p class="lead">예약한 책을 조회합니다.</p>
        %s
      </div>
    </div>
  ', $resComponent);
