<?php
session_start();
require("../dbconect.php");
if (!empty($_POST)) {
    $password = $_POST['password'];
    $admin_id = $_POST['admin_id'];


$sql_admin = "SELECT * FROM admin WHERE password = :password and admin_id = :admin_id";
$stmt_admin = $db->prepare($sql_admin);
$stmt_admin->bindValue(':password', $password);
$stmt_admin->bindValue(':admin_id', $admin_id);
$stmt_admin->execute();

$results = $stmt_admin->fetch();

if ($results) {
    $_SESSION['admin_id'] = $results['admin_id'];
    $_SESSION['password'] = $results['password'];
    header('Location: ../index.php');
    exit();
} else {
    echo "入力値が間違っています";
    exit();
}
}
?>

<!DOCTYPE html>
<html lang="ja">

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <title>ログイン</title>
        <link rel="stylesheet" href="css/test.css" type="text/css">
    </head>

    <body style="background-color:#f0fff0;">
        <h3 class="text-center p-3">管理者ログインページ</h3>
        <form action="admin_login.php" method="post">
        <br>
        <br>

            <div class="container">
                <div class="col-6 mx-auto">
                    <div class="mb-3 row">
                        <label for="admin_id" class="col-sm-3">管理者ID</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="admin_id" value="" required>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-3">パスワード</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="password" value="" required>
                        </div>
                    </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <input type="submit" class="btn btn-secondary" name="admin_login" value="ログイン">
                    </div>
                </div>
                <div class="d-flex justify-content-center p-3">
                    <a href="admin_entry.php">管理者登録画面へ</a>
                </div>

            </div>

        </form>   
    </body>
</html>