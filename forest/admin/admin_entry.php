<?php
require('../dbconect.php');
session_start();

if (!empty($_POST)) {
    if ($_POST['admin_id'] === "") {
        $error['admin_id'] ="blank";
    }
    if ($_POST['password'] === "") {
        $error['password'] ="blank";
    }

    if (!isset($error)) {
        $admin = $db->prepare('SELECT COUNT(*) as cnt FROM admin WHERE password=?');
        $admin->execute(array($_post['password']));

        $record = $admin->fetch();
        if ($record['cnt'] > 0) {
            $error['password'] = 'duplicate';
        }
    }

    if (!isset($error)) {
        $_SESSION['admin_join'] = $_POST;
        header('Location: admin_check.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <title>管理者登録</title>
    </head>

    <body style="background-color:#f0fff0;">
        <h3 class="text-center p-3">管理者登録画面</h3>
        <br>
        <form action="" method="post">

            <div class="col-6 mx-auto">
                <div class="mb-3 row">
                    <label for="admin_id" class="col-sm-3">管理者ID</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="admin_id">
                        <?php if (!empty($error["admin_id"]) && $error['admin_id'] === 'blank'): ?>
                            <p>名前を入力してください。</p>
                        <?php endif ?>    
                        <br>
                    </div>
                </div>
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
            <div class="mb-3 d-flex justify-content-center p-3">
                <button type="submit" class="btn btn-secondary">確認する</button>
            </div>    
        </form>
    </body>
</html>