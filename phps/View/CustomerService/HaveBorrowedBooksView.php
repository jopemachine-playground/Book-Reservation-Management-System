<?php
  session_start();
  $UserID = $_SESSION['user_id'];

  echo sprintf('
    <div class="list-group">
      <a class="list-group-item active" style="background-color: #474747!important; color: #ffffff; border: none !important;">대출했던 도서들</a>

      <div class="list-group-item">
        <p class="lead">일정 기간 동안 대출했던 책들을 조회합니다.</p>
        <label>~ 부터: </label>
        <input type="date" id="fromDate" name="fromDate">
        <br />
        <label>~ 까지: </label>
        <input type="date" id="untilDate" name="untilDate">
        <br />
        <input type="submit" value="조회" onclick="haveBorrowedBookFetch()">
      </div>

      <div id="haveBorrowedBooks" class="list-group-item"></div>
    </div>
  ');
