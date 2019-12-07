<?php

  echo sprintf('
    <div class="list-group">
      <a class="list-group-item active" style="background-color: #474747!important; color: #ffffff; border: none !important;">회원 강제 탈퇴</a>
        <input id="customerIDToDelete" type="text" name="ISBN" placeholder="제거하려는 회원의 ID을 입력하세요" />
        <button type="submit" class="btn btn-dark btn-block" style="margin-top: 35px; margin-bottom: 35px;" onclick="withdrawCustomer($(this))">제거</button>
    </div>
  ');
