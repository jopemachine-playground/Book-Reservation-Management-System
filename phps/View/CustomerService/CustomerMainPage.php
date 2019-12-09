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

?>

<!DOCTYPE html>
<html lang="kr">
  <head>
    <title>도서 관리 예약 서비스</title>
    <!-- meta 데이터 정의 -->
    <meta charset="utf-8">

    <!-- 반응형 웹페이지 구현을 위한 meta 데이터 -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" />

    <link rel="stylesheet" href="../../../css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../css/CustomerMainPage.css">
    <!-- Favicon 적용 -->
    <link rel="shortcut icon" size="16x16" href="../../../img/favicon.ico" />
    <!-- loader에 대한 css 시트. https://loading.io/css/ 를 사용했다.-->
    <link rel="stylesheet" href="../../../css/loader.css">
  </head>

  <body id="Background">

    <!-- Loading 창. 로딩이 끝나면 컨테이너를 show 한다. -->
    <div id="Loader">
      <!-- 아래 div 태그 지우지 말 것 -->
      <div class="lds-grid"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
      <p>Loading..</p>
    </div>

    <div class="container">
      <!-- 인라인으로 스타일을 준 것은, bootstrap.css에서 색상 속성이 !important로 선언되어 있기 때문임. boostrap 파일을 변경하기보단, 인라인으로 새 속성을 주었음 -->
      <nav id="FixedNavbar" class="navbar navbar-expand-lg navbar-dark fixed-top">
        <img src="../../../img/book-open.svg" style="margin-right: 10px;">
        <a class="navbar-brand" href="#">도서 관리 예약 서비스</a>

        <!-- 창 너비에 따라 버튼이 미디어 쿼리로, 두 종류로 나뉜다. -->
        <!-- 아래의 버튼은 창이 작을 때, 핸드폰이나 태블릿 같은 환경에서 사용할 버튼 및 a 태그 들이다.-->
        <button class="navbar-toggler responsiveNone2" data-toggle="collapse" data-target="#navCollapse">
          <!-- 아이콘 같은 걸 넣을 때 span 태그를 사용함 -->
          <span class="navbar-toggler-icon"></span>
        </button>

        <div id="navCollapse" class="collapse navbar-collapse responsiveNone2">

          <!-- ml은 margin-left. -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="../../Action/SignOutAction.php">로그아웃</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../UserEdit.php">정보 수정</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../../Action/CustomerService/LeaveAction.php">회원 탈퇴</a>
            </li>
          </ul>
        </div>

        <!-- 아래의 버튼들은 데스크톱에서 사용할 버튼 -->

        <!-- 텍스트를 중간에 배치하기 위해 버튼들을 absoulte로 놓고 오른쪽엔 div로 따로 공간을 두었음 -->
        <!-- sizeUpOnHover가 들어간 엘리먼트는 hover 하면 크기가 커짐 -->
        <div class="btn-group float-right responsiveNone">
          <button type="button" class="btn-sm side_btn dropdown-toggle sizeUpOnHover" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="../../../img/menu.svg" alt="sidebar menu"></button>
          <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="../../Action/SignOutAction.php">로그아웃</a>
            <a class="dropdown-item" href="../UserEdit.php">정보 수정</a>
            <a class="dropdown-item" href="../../Action/CustomerService/LeaveAction.php">회원 탈퇴</a>
          </div>
        </div>

      </nav>
    </div>

    <section class="mt-1" style="padding-top: 75px; padding-left: 5%; padding-right: 5%;">
      <div class="row">
        <div class="col-md-3" style="margin-bottom: 15px;">
          <div id="SidebarBtns" class="list-group">
            <a id="CustomerService-search" href="#" class="list-group-item sideButton" onclick="selectButtons(this.id)">검색</a>
            <a id="CustomerService-reservedBook" href="#" class="list-group-item sideButton" onclick="selectButtons(this.id)">내가 예약한 도서</a>
            <a id="CustomerService-borrowedBook" href="#" class="list-group-item sideButton" onclick="selectButtons(this.id)">내가 대출한 도서</a>
            <a id="CustomerService-haveBorrowedBook" href="#" class="list-group-item sideButton" onclick="selectButtons(this.id)">대출했던 도서목록</a>
          </div>
        </div>

        <div id="ServiceSection" class="col-md-9" style="display: none;">
        </div>

      </div>
    </section>


    <div id="WhiteSpaceForResponsivePage"></div>

    <!-- p는 padding, mt는 margin-top란 의미 (Bootstrap 4 API spacing 참고) -->
    <footer id="Copyright" class="bg-dark p-3 text-center fixed-bottom"> &copy; 2019 DB Term Project&nbsp;</footer>

    <!-- 제이쿼리 자바스크립트 추가하기 -->
    <script src="../../../lib/jquery-3.2.1.min.js"></script>
    <!-- Popper 자바스크립트 추가하기 -->
    <script src="../../../lib/popper.min.js"></script>
    <!-- 부트스트랩 자바스크립트 추가하기 -->
    <script src="../../../lib/bootstrap.min.js"></script>
    <!-- MDB 라이브러리 추가하기 -->
    <script src="../../../lib/mdb.min.js"></script>
    <!-- 제이쿼리 플러그인 -->
    <script src="../../../lib/jquery.cookie.js"></script>
    <!-- 커스텀 자바스크립트 추가하기 -->
    <script src="../../../js/CustomerMainPage.js"></script>
    <!-- Chart JS 추가 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>

  </body>
</html>
