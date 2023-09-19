<?php
require('../dbconect.php');
session_start();

if (!empty($_POST)) {
    $email = $_POST['email'];
    $name = $_POST['name'];


$sql_user = "SELECT * FROM members WHERE email = :email and name = :name";
$stmt_user = $db->prepare($sql_user);
$stmt_user->bindValue(':email', $email);
$stmt_user->bindValue(':name', $name);
$stmt_user->execute();

$results = $stmt_user->fetch(); 

if ($results) {
    $_SESSION['email'] = $results['email'];
    $_SESSION['name'] = $results['name'];
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
     <header>
        <h3 class="text-center p-3">ログインページ</h3>
     </header>
     
     <form action="login.php" method="post">
        <div class="col-6 mx-auto">
            <div class="mb-3 row">
                <label for="email" class="col-sm-3">メールアドレス</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email" value="" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="name" class="col-sm-3">ニックネーム</label>
                <div class="col-sm-6">
                    <input type="name" class="form-control" name="name" value="" required>
                </div>
            </div>
            <div class="mb-3 d-flex justify-content-center">
                <input type="submit" class="btn btn-secondary" name="login" value="ログイン">
            </div>
        </div>
        <div class="d-flex justify-content-center p-3">
            <a href="entry.php">会員登録画面へ</a>
        </div>
     </form>
  </body>
</html>