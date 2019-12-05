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

    <form action="php-Action/ManagerService/RegisterBookAction.php" enctype="multipart/form-data" method="post">

      <div class="form-group">
        <label for="ISBN">ISBN</label>
        <input id="ISBN" type="text" name="ISBN" class="form-control" maxlength="20" placeholder="ISBN" title="ISBN를 입력하세요." required>
      </div>

      <div class="form-group">
        <label for="BookName">책 이름</label>
        <input id="BookName" type="text" name="BookName" class="form-control" maxlength="20" placeholder="책 이름 입력하세요" title="책 이름 입력하세요" required>
      </div>

      <div class="form-group">
        <label for="PublishedHouse">출판사</label>
        <input id="PublishedHouse" type="text" name="PublishedHouse" class="form-control" maxlength="20" placeholder="출판사 입력하세요" title="출판사 입력하세요" required>
      </div>

      <div class="form-group">
        <label for="Author">저자</label>
        <input id="Author" type="text" name="Author" class="form-control" maxlength="20" placeholder="저자 입력하세요" title="저자 입력하세요" required>
      </div>

      <button type="submit" class="btn btn-dark btn-block btn-lg" style="margin-top: 120px;">등록</button>
    </form>
  ');
