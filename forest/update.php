<?php
require("dbconect.php");
if (isset($_POST['submit'])) {
    $db = new PDO ('mysql:dbname=forest;host=127.0.0.1; charset=utf8', 'root', '');

    $sql_update = 'UPDATE articles SET
                   title = :title,
                   article = :article
                   WHERE id = :id
                   ';

    $stmt_update = $db->prepare($sql_update);

    $stmt_update->bindValue(':title', $_POST['title'], PDO::PARAM_STR);
    $stmt_update->bindValue(':article', $_POST['article'], PDO::PARAM_STR);
    $stmt_update->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

    $stmt_update->execute();
   
    header("Location: index.php");
}

if (isset($_GET['id'])) {
try {
    $db = new PDO ('mysql:dbname=forest;host=127.0.0.1; charset=utf8', 'root', '');
    $sql_select_article = 'SELECT * FROM articles WHERE id = :id';
    $stmt_select_article = $db->prepare($sql_select_article);
    
    $stmt_select_article->bindValue(':id', $_GET['id'], PDO::PARAM_INT);

    $stmt_select_article->execute();
    // 補足：1つのレコード（横1行のデータ）のみを取得したい場合、fetch()メソッドを使えばカラム名がキーになった1次元配列を取得できる 
    $article = $stmt_select_article->fetch(PDO::FETCH_ASSOC);

    if ($article === FALSE) {
        exit('idパラメータの値が不正です。');
    }
    $sql_select_article_id = 'SELECT id FROM articles';
    $stmt_select_article_id = $db->query($sql_select_article_id);
    // SQL文の実行結果を配列で取得する
    // 補足：PDO::FETCH_COLUMNは1つのカラムの値を1次元配列（多次元ではない普通の配列）で取得する設定である
    $article_id = $stmt_select_article_id->fetchALL(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    echo 'DB接続エラー' . $e->getMessage();
}
} else {
    exit('article_idのパラメータ値が存在しません。');
}
?>

<!DOCTYPE html>
<html lang="ja">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <title>投稿編集</title>
    </head>

    <body style="background-color:#f0fff0;">

        <main>
            <article>
                <h3 class="text-center p-5">投稿記事編集</h3>
                <form action="update.php?id=<?= $_GET['id'] ?>" method="post">
                    <div class="col-6 mx-auto">
                        <div class="mb-3 row">
                            <label for="title" class="col-sm-3">投稿記事名</label>
                                <div class="col-sm-6">
                                    <input type="text" name="title" class="form-control" value="<?= $article['title'] ?>" min="10" max="1000000000" required>
                                </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="article" class="col-sm-3">記事内容</label>
                                <div class="col-sm-6">
                                    <textarea type="text" class="form-control" name="article"min="0" max="100000000" required><?= $article['article'] ?></textarea>
                                </div>
                        </div>
                    </div>    
                    <div class="d-flex justify-content-center p-3">
                        <button type="submit" class="btn btn-secondary" name="submit" value="update">更新</button>
                    </div>
                    <div class="d-flex justify-content-center p-3">
                    <a href="index.php">掲示板</a>
                    </div>
                </form>
            </article>
        </main>

        <footer>
        <p class="copyright">&copy; 会員制掲示板 All rights reserved.</p>
        </footer>
    </body>
</html>
