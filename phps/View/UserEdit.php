<?php
  session_start();
  $UserID = $_SESSION['user_id'];
  // 세션에 ID가 없다면, 이용할 수 없으니, SignIn 페이지로 이동
  if(!isset($UserID)){
    echo ("<script language=javascript>alert('먼저 로그인하세요!')</script>");
    echo ("<script>location.href='SignIn.php';</script>");
    exit();
  }

  require_once('../MySQLConection.php');

  // DB에서 기본 값을 빼내와, 디폴트 값으로 입력 폼에 넣어놓는다.
  $connect_object = MySQLConnection::DB_Connect('db_hw');
  // DB에서 PK (ID) 를 찾음
  $searchUserID = "
    SELECT * FROM user WHERE ID = '$UserID'
  ";

  $ret = mysqli_query($connect_object, $searchUserID);
  $row = mysqli_fetch_array($ret);

  $ID = $row['ID'];
  $PW = $row['PW'];
  $Name = $row['Name'];
  $Telephone = $row['Telephone'];
  $Position = $row['Position'];
  $Email = $row['Email'];

  ?>

<!DOCTYPE html>
<html lang="kr">
<head>
  <!-- 검색되게 쉽게 하기 위한 meta 태그 작성 -->
  <meta charset="utf-8">

  <!-- 반응형 웹페이지 구현을 위한 meta 데이터 -->
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" />

  <title>회원 정보 수정</title>
  <!-- Bootstrap 스타일 시트를 적용. min이 붙은 것은 난독화 파일이기 때문.-->
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
  <link rel="stylesheet" href="../../css/UserEdit.css">
  <!-- Favicon 적용 -->
  <link rel="shortcut icon" size="16x16" href="../../img/favicon.ico" />

</head>

<body id="Background">

  <!-- bg-dark는 배경색을 지정, navbar-dark는 위쪽 nav 바의 색상을 지정 -->
  <!-- fixed-top은 위쪽에 고정시키는데 사용함 -->
  <nav id="FixedNavbar" class="navbar navbar-expand-lg navbar-dark fixed-top">

      <!-- navbar-brand는 brand를 나타내는 일종의 강조 표시 -->
      <a class="navbar-brand" href="#"><img src="../../img/book-open.svg" style="margin-right: 10px;">회원 정보 수정</a>

      <!-- 창 너비에 따라 버튼이 미디어 쿼리로, 두 종류로 나뉜다. -->
      <!-- 아래의 버튼은 창이 작을 때, 핸드폰이나 태블릿 같은 환경에서 사용할 버튼 및 a 태그 들이다.-->

      <!-- navbar-toggler는 일종의 목록을 보여주고 숨겨주는, 스위치 역할을 함.
          data-toggle은 그 목록의 id 값이 들어가야 한다.
          navbar-toggler-icon은 일종의 햄버거 버튼 (막대기 3개가 그어져 있는 아이콘)을 나타냄. -->
      <button class="navbar-toggler responsiveNone2" data-toggle="collapse" data-target="#menuCollapseList">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- ml은 margin left. 뒤에 붙는 숫자는 크기에 해당. -->
      <!-- nav-item은 하나하나의 리스트에 해당하며, nav-link는 a 태그에 해당함 -->
      <!-- responsiveNone는 반응형 페이지 구현을 위해 넣은 미디어 쿼리 -->
      <div id="menuCollapseList" class="collapse navbar-collapse responsiveNone2">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" onclick="ToMainPage();">관리 서비스로 이동</a>
          </li>
        </ul>
      </div>

      <!-- 아래의 버튼은 데스크톱에서 사용할 버튼 -->
      <div class="btn-group float-right responsiveNone">
        <button type="button" class="side_btn sizeUpOnHover"><img src="../../img/arrow-left.svg" alt="return login page" onclick="ToMainPage()"></img></button>
      </div>
  </nav>

  <!-- container는 반응형 웹페이지의 일종의 컨테이너 역할을 해 줌. -->
  <section class="container" style="padding-top: 85px;">

    <!-- lead는 강조 표시 및 글자 크기를 키우는 역할을 함 -->
    <p class="lead" style="font-size: 60px;">User Info Edit</p>

    <!-- 파일을 함께 전송하므로, enctype은 multipart/form-data 여야 한다 -->
    <!-- SubmitButtonClicked()가 true를 반환하는 경우에만 서버로 데이터를 전송한다 -->
    <form action="phps/UserEditAction.php" enctype="multipart/form-data" method="post">

      <!-- form 태그를 통해 SignInAction.php를 거쳐 로그인 함 -->
      <!-- form-group 및 form-control 은 부트스트랩 css를 적용하기 위한 태그 -->
      <div class="form-group">
        <label for="ID">ID <strong>* </strong></label>
        <input id="ID" value="<?=$ID;?>" type="text" name="ID" class="form-control" maxlength="20" placeholder="4글자 이상, 20자 이내로 입력해주세요." title="ID를 입력하세요." autofocus required disabled>
        <label for="IDCheck" style="display:inline;"></label>
      </div>

      <div class="form-group">
        <label for="PW">PW <strong>* </strong></label>
        <input id="PW" type="password" name="PW" class="form-control" maxlength="20" placeholder="4글자 이상, 20자 이내로 입력해주세요." title="비밀번호를 입력하세요." required>
      </div>

      <div class="form-group">
        <label for="PW_Confirm">PW 확인 <strong>* </strong></label>
        <input id="PW_Confirm" type="password" name="PW_Confirm" class="form-control" maxlength="20" placeholder="비밀번호를 다시 한 번 입력하세요" title="비밀번호를 다시 한 번 입력하세요." required>
      </div>

      <br>

      <!-- 이름 란은 DB에 성과 이름이 합쳐져 기록됨 -->
      <label>이름</label>
      <div class="form-group">
          <input id="Name" value="<?=$Name;?>" type="text" name="Name" class="form-control" placeholder="이름">
      </div>

      <div class="form-group">
        <label for="Email">이메일 주소</label>
        <input id="Email" value="<?=$Email;?>" type="email" name="Email" class="form-control" placeholder="이메일을 입력하세요">
      </div>

      <div class="form-group">
        <label for="Telephone">핸드폰 번호</label>
        <input id="PhoneNumber" value="<?=$Telephone;?>" type="phone" name="Telephone" class="form-control" placeholder="핸드폰 번호를 입력하세요">
      </div>

      <div class="form-group">
        <label for="Position">직위</label>
        <input id="PhoneNumber" value="<?=$Position;?>" type="text" name="Position" class="form-control" placeholder="교직원, 학부생, 대학원생">
      </div>

      <!-- btn-block을 붙이면 버튼이 container 너비에 가득차게 됨 -->
      <button type="submit" class="btn btn-dark btn-block btn-lg" style="margin-top: 120px;">정보 수정</button>
    </form>
  </section>

  <!-- 스크롤바 에러를 피하기 위해 공간을 둠 -->
  <div id="WhiteSpaceForResponsivePage"></div>

  <footer id="Copyright" class="bg-dark p-3 text-center"> &copy; 2019 DB Term Project&nbsp;</footer>

  <!-- 제이쿼리 자바스크립트 추가하기 -->
  <script src="../../lib/jquery-3.2.1.min.js"></script>
  <!-- Popper 자바스크립트 추가하기 -->
  <script src="../../lib/popper.min.js"></script>
  <!-- 부트스트랩 자바스크립트 추가하기 -->
  <script src="../../lib/bootstrap.min.js"></script>
  <!-- MDB 라이브러리 추가하기 -->
  <script src="../../lib/mdb.min.js"></script>
  <!-- 커스텀 자바스크립트 추가하기 -->
  <script src="../../js/UserEdit.js"></script>
</body>
</html>
