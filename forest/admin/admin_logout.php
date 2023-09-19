<?php
session_start();
if (!isset($_SESSION["admin_id"])) {
    header("Location: admin_login.php");
    exit();
  }
$_SESSION = array();
session_destroy();
?>


<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <title>ログアウト画面</title>
    </head>

    <body style="background-color:#f0fff0;">
    <?php var_dump($_SESSION) ?>
        <p class="fs-1 fw-bold text-center p-3">ログアウト完了</p>
        <p class="text-center">ログアウト処理が完了しました。</p>
            <div class="d-flex justify-content-center">
                <a href="admin_login.php">管理者ログインページ</a>
            </div>
            <div class="d-flex justify-content-center p-3">
                <a href="../user/login.php">ログインページ</a>
            </div>
    </body>
</html>