<?php

  echo sprintf('
    <div class="list-group">
      <a class="list-group-item active" style="background-color: #474747!important; color: #ffffff; border: none !important;">도서 삭제</a>
        <input id="bookISBNToDelete" type="text" name="ISBN" placeholder="제거하려는 책의 ISBN을 입력하세요" />
        <button type="submit" class="btn btn-dark btn-block" style="margin-top: 35px; margin-bottom: 35px;" onclick="deleteBook($(this))">제거</button>
    </div>
  ');
