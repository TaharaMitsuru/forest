<?php
require("../dbconect.php");
session_start();
if (!isset($_SESSION['join'])) {
    header('Location: login.php');
    exit();
}

if(!empty($_POST['check'])) {
    $hash = password_hash($_SESSION['join']['password'], PASSWORD_BCRYPT);

    $stmt = $db->prepare("INSERT INTO members SET name=?, email=?, password=?");
    $stmt->execute(array(
        $_SESSION['join']['name'],
        $_SESSION['join']['email'],
        $hash
    ));

    // unset($_SESSION['join']);
    header('Location: thank.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,minmum-scale=1.0">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <title>確認画面</title>
    </head>
    <body style="background-color:#f0fff0;">
        <form action="" method="POST">


            <div class="col-6 mx-auto">
                <div class="mb-3 row">
                    <input type="hidden" name="check" value="check">
                        <p class="fs-1 fw-bold text-center p-3">会員登録</p>
                        <?php if (!empty($error) && $error === "error"): ?>
                            <p>会員登録に失敗しました。</p>
                        <?php endif ?>
                </div>        
                <br>
            
                <div class="mb-3 row">
                    <label for="name" class="col-sm-3">名前</label>
                    <div class="col-sm-6">
                        <input type="name" class="form-control" name="name" value="<?php echo htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES); ?>">
                    </div>
                    <br>
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-sm-3">メールアドレス</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars(($_SESSION['join']['email']), ENT_QUOTES); ?>">
                    </div>
                        <br>
                </div>  
                    <div class="mb-3 d-flex justify-content-center">
                        <button type="submit" class="btn btn-secondary">登録する</button>
                    </div>

                    <div class="d-flex justify-content-center p-3">
                        <a href="entry.php">変更する</a>
                    </div>
            </div>        
        </form>
    </body>
</html>
