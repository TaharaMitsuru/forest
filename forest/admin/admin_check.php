<?php
require("../dbconect.php");
session_start();
if (!isset($_SESSION['admin_join'])) {
    header('Location: admin_login.php');
    exit();
}

if(!empty($_POST['check'])) {

    $stmt = $db->prepare("INSERT INTO admin SET admin_id=?, password=?");
    $stmt->execute(array(
        $_SESSION['admin_join']['admin_id'],
        $_SESSION['admin_join']['password'],
    ));

    // unset($_SESSION['join']);
    header('Location: admin_thank.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minmum-scale=1.0">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <title>管理者確認画面</title>
    </head>
    <body style="background-color:#f0fff0;">
        <form action="" method="POST">

        <?php var_dump($_SESSION) ?>
            <div class="col-6 mx-auto">
                <div class="mb-3 row">
                    <input type="hidden" name="check" value="check">
                        <p class="fs-1 fw-bold text-center p-3">管理者登録</p>
                        <?php if (!empty($error) && $error === "error"): ?>
                            <p>管理者登録に失敗しました。</p>
                        <?php endif ?>
                </div>        
                <br>
            
                <div class="mb-3 row">
                    <label for="admin_id" class="col-sm-3">管理者ID</label>
                    <div class="col-sm-6">
                        <input type="admin_id" class="form-control" name="admin_id" value="<?php echo htmlspecialchars($_SESSION['admin_join']['admin_id'], ENT_QUOTES); ?>">
                    </div>
                    <br>
                </div>

                <div class="mb-3 row">
                    <label for="password" class="col-sm-3">パスワード</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control" name="password" value="<?php echo htmlspecialchars(($_SESSION['admin_join']['password']), ENT_QUOTES); ?>">
                    </div>
                        <br>
                </div>  
                    <div class="mb-3 d-flex justify-content-center">
                        <button type="submit" class="btn btn-secondary">登録する</button>
                    </div>

                    <div class="d-flex justify-content-center p-3">
                        <a href="admin_entry.php">変更する</a>
                    </div>
            </div>        