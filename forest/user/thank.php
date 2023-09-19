<?php
session_start();
if(!isset($_SESSION['join'])){
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
        <title>会員登録完了</title>
    </head>
    <body style="background-color:#f0fff0;">
        <h3 class="text-center p-5">会員登録が完了しました。</h3>
        <br>
        <div class="d-flex justify-content-center p-3">
            <a href="login.php"><button class="btn btn-secondary">ログインページに移動</button></a>
        </div>
    </body>
</html>