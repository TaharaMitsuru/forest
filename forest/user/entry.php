<?php
require('../dbconect.php');
session_start();

if (!empty($_POST)) {
    if ($_POST['name'] === "") {
        $error['name'] ="blank";
    }
    if ($_POST['email'] === "") {
        $error['email'] ="blank";
    }
    if ($_POST['password'] === "") {
        $error['password'] ="blank";
    }

    if (!isset($error)) {
        $member = $db->prepare('SELECT COUNT(*) as cnt FROM members WHERE email=?');
        $member->execute(array($_post['email']));

        $record = $member->fetch();
        if ($record['cnt'] > 0) {
            $error['email'] = 'duplicate';
        }
    }

    if (!isset($error)) {
        $_SESSION['join'] = $_POST;
        header('Location: check.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <title>会員登録をする</title>
    </head>

    <body style="background-color:#f0fff0;">
        <h3 class="text-center p-3">会員登録画面</h3>
        <form action="" method="post">
            <div class="col-6 mx-auto">
                <div class="mb-3 row">
                    <label for="name" class="col-sm-3">名前</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="name">
                        <?php if (!empty($error["name"]) && $error['name'] === 'blank'): ?>
                            <p>名前を入力してください。</p>
                        <?php endif ?>    
                        <br>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-3">email</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" name="email">
                        <?php if (!empty($error["email"]) && $error['email'] === 'blank'): ?>
                            <p>メールアドレスを入力してください。</p>
                        <?php elseif (!empty($error["email"]) && $error['email'] === 'blank'): ?>
                            <p>そのメールアドレスは使用されています。</p>
                        <?php endif ?>               
                    </div>
                </div>
                <br>
                <div class="mb-3 row">
                    <label for="password" class="col-sm-3">パスワード</label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="password">
                            <?php if (!empty($error["password"]) && $error['password'] === 'blank'): ?>
                                <p>パスワードを入力してください。</p>
                            <?php endif ?>
                        </div>
                </div>
            </div>        
            <div class="mb-3 d-flex justify-content-center">
                <button type="submit" class="btn btn-secondary">確認する</button>
            </div>    
        </form>
    </body>
</html>