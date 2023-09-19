<?php
require("dbconect.php");
session_start();
if (!isset($_SESSION["name"])) {
    if (!isset($_SESSION["admin_id"])) {
    header("Location: user/login.php");
    exit();
  }
}

if (isset($_POST['submit'])) {
    $db = new PDO ('mysql:dbname=forest;host=127.0.0.1; charset=utf8', 'root', '');

    $sql_insert = 'INSERT INTO articles (title, article, article_name) VALUES (:title, :article, :article_name)';

    $stmt_insert = $db->prepare($sql_insert);

    $stmt_insert->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
    $stmt_insert->bindValue(':article', $_POST['article'], PDO::PARAM_STR);
    $stmt_insert->bindValue(':article_name', $_SESSION["name"], PDO::PARAM_STR);
    $stmt_insert->execute();
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="css/bootstrap.min.css">
     <title>新規投稿</title>
</head>
<body style="background-color:#f0fff0;">
    <article>
        <h3 class="text-center p-3">新規投稿</h3>

        <form action="create.php" method="post">
            <input type="hidden" name="article_name" value="<?php $_SESSION["name"] ?>">
        <div class="col-6 mx-auto">
            <div class="mb-3 row">
                <label for="title" class="col-sm-3">投稿タイトル</label>
                <!-- <?php var_dump($article_name); ?> -->
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="title" min="0" max="100000000" required>
                </div>
            </div>
            
            <div class="mb-3 row">
                <label for="article" class="col-sm-3">投稿内容</label>
                <div class="col-sm-6">
                    <textarea type="text" class="form-control" name="article" min="0" max="100000000" required></textarea>
                </div>
            </div>
            <div class="d-flex justify-content-center p-3">
                <button type="submit" class="btn btn-secondary" name="submit" value="create">登録</button>
            </div>
        </div>
        <div class="d-flex justify-content-center p-3">
            <?php if(isset($_SESSION["admin_id"])): ?>
            <a href="admin/admin.php">管理者掲示板に戻る</a>
            <?php elseif (isset($_SESSION["name"])): ?>
            <a href="index.php">掲示板に戻る</a>
            <?php endif ?>
        </div>
        </form>
    </article>

    <footer>
      <p class="copyright">&copy; 会員制掲示板 All rights reserved.</p>
    </footer>

</body>
</html>