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

  $connect_object = MySQLConnection::DB_Connect('db_hw');

  $FromDate = $_POST['FromDate'];
  $UntilDate = $_POST['UntilDate'];

  $FromDate = str_replace('-', '', $FromDate);
  $UntilDate = str_replace('-', '', $UntilDate);

  $selectTopten = "
    SELECT *, COUNT(ID) AS BorrowCnt
    FROM borrow
    GROUP BY UserID
    HAVING LoanDate BETWEEN STR_TO_DATE('$FromDate', '%Y%m%d%s') AND STR_TO_DATE('$UntilDate', '%Y%m%d%s')
    ORDER BY BorrowCnt
  ";

  $searchRes = mysqli_query($connect_object, $selectTopten) or die("Error Occured in Fetching data in DB");

  $index = 0;

  $resComponent = "";

  if(mysqli_num_rows($searchRes) < 1){
    echo sprintf('
      <div class="list-group">
        <div class="BookInfo" class="list-group-item">
          조회기간에 대출된 책이 없습니다.
        </div>
      </div>
    ');
    exit();
  }

  while($index++ < 10 and $oneBook = mysqli_fetch_array($searchRes)){

    $UserID = $oneBook[2];
    $BorrowCnt = $oneBook[6];

    $resComponent .= sprintf('
      <div class="list-group">
        <div class="BookInfo" class="list-group-item">
          <p class="lead">%s위</p>
          <div>유저 : %s</div>
          <div>대출 수: %s</div>
        </div>
      </div>
    ', $index, $UserID, $BorrowCnt);
  }

  echo $resComponent;
