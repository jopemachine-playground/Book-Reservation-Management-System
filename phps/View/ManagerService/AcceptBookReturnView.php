<?php
  // 세션에 ID가 있다면, 로그인 된 상태이므로 바로 URL-Register로 이동
  session_start();

  $UserID = $_SESSION['user_id'];

  // 세션에 ID가 없다면, 이용할 수 없으니, SignIn 페이지로 이동
  if(!isset($UserID)){
    echo ("<script language=javascript>alert('먼저 로그인하세요!')</script>");
    echo ("<script>location.href='../SignIn.php';</script>");
    exit();
  }

  require_once('../../MySQLConection.php');

  $connect_object = MySQLConnection::DB_Connect('db_hw');

  $searchReadyToReturnBook = "
    SELECT *
    FROM book
    WHERE book.ReturnRequest = 1
  ";

  $searchRes = mysqli_query($connect_object, $searchReadyToReturnBook) or die("Error Occured in Fetching data in DB");

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
          <div class="canReserve">예약 존재 여부: %s</div>
        </div>
        <button type="submit" class="btn btn-white btn-block" style="" onclick="acceptReturn($(this))">반납 승인</button>
      </div>
    ', $BookName, $ISBN, $PublishHouse, $Author);
  }

  echo sprintf('
    <div class="list-group">
      <a class="list-group-item active" style="background-color: #474747!important; color: #ffffff; border: none !important;">반납 목록</a>
      <div class="list-group-item">
        <p class="lead">반납 요청이 들어온 도서 목록입니다.</p>
        %s
      </div>
    </div>
  ', $resComponent);
