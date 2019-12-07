<?php
session_start();
// 저장해두었던 세션을 삭제
unset($_SESSION['user_id']);

// 삭제한 후 로그인 페이지로 돌아감
echo ("<script>location.href='../View/SignIn.php';</script>");
