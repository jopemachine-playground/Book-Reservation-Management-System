<?php
  session_start();
  $UserID = $_SESSION['user_id'];

  // 세션에 ID가 없다면, 이용할 수 없으니, SignIn 페이지로 이동
  if(!isset($UserID)){
    echo ("<script language=javascript>alert('먼저 로그인하세요!')</script>");
    echo ("<script>location.href='../SignIn.php';</script>");
    exit();
  }

  echo sprintf('
    <div class="list-group">
      <a class="list-group-item active" style="background-color: #474747!important; color: #ffffff; border: none !important;">책 검색</a>
      <div class="list-group-item">
        <p class="lead">검색할 책 제목을 입력하세요.</p>
          <div class="form-group">
            <input id="PhoneNumber" type="text" name="Position" class="form-control" placeholder="책 제목">
            <button type="button">검색</button>
          </div>
      </div>
    </div>
  ');
