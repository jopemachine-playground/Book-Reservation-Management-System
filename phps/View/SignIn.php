<?php
  // 세션에 ID가 있다면, 로그인 된 상태이므로 바로 URL-Register로 이동
  session_start();

  if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != "manager"){
    echo "<script>location.href='../View/CustomerService/CustomerMainPage.php';</script>";
  }
  else if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == "manager"){
    echo "<script>location.href='../View/ManagerService/ManagerMainPage.php';</script>";
  }

?>

<!DOCTYPE html>
<html lang="kr">
<head>
  <!-- 검색되게 쉽게 하기 위한 meta 태그 작성 -->
  <meta charset="utf-8">

  <!-- 반응형 웹페이지 구현을 위한 meta 데이터 -->
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" />

  <title>로그인</title>

  <!-- Bootstrap 스타일 시트를 적용. min이 붙은 것은 난독화 파일이기 때문.-->
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
  <!-- 커스텀 스타일 시트 -->
  <link rel="stylesheet" href="../../css/SignIn.css">
  <!-- Favicon 적용 -->
  <link rel="shortcut icon" size="16x16" href="../../img/favicon.ico" />

</head>

<body id="Background">

  <!-- container는 반응형 웹페이지의 일종의 컨테이너 역할을 해 줌. -->
  <div class="container">

    <!-- bg-dark는 배경색을 지정, navbar-dark는 위쪽 nav 바의 색상을 지정 -->
    <!-- 크기에 관해선 다음을 참조 => They work for all breakpoints: xs (<=576px), sm (>=576px), md (>=768px), lg (>=992px) or xl (>=1200px)): -->
    <nav id="FixedNavbar" class="navbar navbar-expand-lg navbar-dark fixed-top">
      <!-- navbar-brand는 brand를 나타내는 일종의 강조 표시 -->

      <a class="navbar-brand" href="./SignIn.php" style="float: left !important;"><img src="../../img/smile.svg" style="margin-right: 10px;">도서 관리 서비스</a>

    </nav>

    <section style="padding-top:100px;">
      <!-- lead는 강조 표시 및 글자 크기를 키우는 역할을 함 -->
      <p id="Title" class="lead">Login</p>
      <p id="Title-lead" class="lead">도서 관리 시스템에 로그인하세요.</p>

      <form action="../Action/SignInAction.php" onsubmit="return SubmitButtonClicked()" method="post">
        <div class="form-group">
          <label for="ID">ID </label>
          <!-- autofocuse를 통해 쉽게 로그인할 수 있게 도움 -->
          <input type="text" name="ID" class="ID form-control" placeholder="ID를 입력하세요" autofocus required>
        </div>
        <div class="form-group">
          <label for="PW">PW </label>
          <input type="password" name="PW" class="PW form-control" placeholder="비밀번호를 입력하세요" required>
        </div>
        <!-- 부트스트랩의 btn-block을 통한 스타일링 (버튼을 한 row로 만들어 집어넣을 수 있다) -->
        <button type="submit" class="btn btn-dark btn-block" style="margin-top: 70px;">로그인</button>
      </form>
    </section>

    <!-- Sign Up 표시 -->
    <a id="AnchorForSignUp" href="../../SignUp.html">Sign Up</a>

    <!-- 스크롤바 에러를 피하기 위해 공간을 둠. 더 적당한 방법을 찾아 고치고 싶음-->
    <div id="WhiteSpaceForResponsivePage"></div>

  </div>

  <footer id="Copyright" class="bg-dark p-3 text-center fixed-bottom"> &copy; 2019 DB Term Project&nbsp;</footer>

  <!-- 제이쿼리 자바스크립트 추가하기 -->
  <script src="../../lib/jquery-3.2.1.min.js"></script>
  <!-- Popper 자바스크립트 추가하기 -->
  <script src="../../lib/popper.min.js"></script>
  <!-- 부트스트랩 자바스크립트 추가하기 -->
  <script src="../../lib/bootstrap.min.js"></script>
  <!-- MDB 라이브러리 추가하기 -->
  <script src="../../lib/mdb.min.js"></script>
  <!-- 커스텀 자바스크립트 추가하기 -->
  <script src="../../js/SignIn.js"></script>

</body>
</html>
