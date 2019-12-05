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
      <a class="list-group-item active" style="background-color: #474747!important; color: #ffffff; border: none !important;">책 검색 및 대출, 예약</a>
      <div class="list-group-item">
        <input id="searchWithBookName" type="radio" name="fruit" checked="checked" value="searchWithBookName" /> 책 제목
        <input id="searchWithISBN" type="radio" name="fruit" value="searchWithISBN" /> ISBN
          <p class="lead">검색할 책의 제목이나 ISBN을 입력하세요.</p>
          <div class="form-group">
            <input id="searchBar" type="text" name="Position" class="form-control" placeholder="책의 제목이나 ISBN을 입력">
          </div>
          <button type="submit" class="btn btn-dark btn-block" style="margin-top: 35px; margin-bottom: 35px;" onclick="search()">검색</button>
          <div id="searchContent">
      </div>
    </div>
  ');
