<?php

  echo sprintf('
    <div class="list-group">
      <a class="list-group-item active" style="background-color: #474747!important; color: #ffffff; border: none !important;">회원 정보 수정</a>

      <div class="list-group-item">

        <form action="../../Action/ManagerService/CustomerInfoEditAction.php" enctype="multipart/form-data" method="post">

          <div class="form-group">
            <label for="ID">ID</label>
            <input id="ID" type="text" name="ID" class="form-control" maxlength="20" placeholder="변경할 유저의 ID를 입력하세요." title="ID를 입력하세요." autofocus required>
            <label for="IDCheck" style="display:inline;"></label>

          </div>

          <div class="form-group">
            <label for="PW">PW</label>
            <input id="PW" type="password" name="PW" class="form-control" maxlength="20" placeholder="4글자 이상, 20자 이내로 입력해주세요." title="비밀번호를 입력하세요.">
          </div>

          <br>

          <label>이름</label>

          <div class="form-group">
              <input id="Name" type="text" name="Name" class="form-control" placeholder="이름">
          </div>

          <div class="form-group">
            <label for="Email">이메일 주소</label>
            <input id="Email" type="email" name="Email" class="form-control" placeholder="이메일을 입력하세요">
          </div>

          <div class="form-group">
            <label for="Telephone">핸드폰 번호</label>
            <input id="PhoneNumber" type="phone" name="Telephone" class="form-control" placeholder="핸드폰 번호를 입력하세요">
          </div>

          <div class="form-group">
            <label for="Position">직위</label>
            <input id="PhoneNumber" type="text" name="Position" class="form-control" placeholder="교직원, 학부생, 대학원생">
          </div>

          <button type="submit" class="btn btn-dark btn-block btn-lg" style="margin-top: 120px;">정보 수정</button>
        </form>
        </div>
    </div>
  ');
