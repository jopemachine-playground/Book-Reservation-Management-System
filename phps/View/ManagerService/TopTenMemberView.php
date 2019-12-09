<?php
  session_start();
  $UserID = $_SESSION['user_id'];

  // 세션에 ID가 없다면, 이용할 수 없으니, SignIn 페이지로 이동
  if(!isset($UserID)) {
    echo ("<script language=javascript>alert('먼저 로그인하세요!')</script>");
    echo ("<script>location.href='../SignIn.php';</script>");
    exit();
  }

  echo sprintf('
    <div class="list-group">
      <a class="list-group-item active" style="background-color: #474747!important; color: #ffffff; border: none !important;">Top 10</a>
      <div class="list-group-item">
        <p class="lead">일정 기간 동안 가장 대출을 많이한 회원들을 조회합니다.</p>
        <label>~ 부터: </label>
        <input class="form-control" type="datetime-local" id="fromDate" name="fromDate">
        <br />
        <label>~ 까지: </label>
        <input class="form-control" type="datetime-local" id="untilDate" name="untilDate">
        <br />
        <button type="submit" class="btn btn-dark btn-block" style="margin-top: 20px;" onclick="toptenFetch()">조회</button>
      </div>
      <div class="list-group-item" id="toptenContent">
      </div>
    </div>
  ');
