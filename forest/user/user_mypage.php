<?php
require("../dbconect.php");
session_start();
if (!isset($_SESSION["name"])) {
    header('Location: login.php');
    exit();
}
$db = new PDO('mysql:dbname=forest;host=127.0.0.1; charset=utf8', 'root', '');
 
     //viewのuser_mypageからnameとtitle article をとる
     $sql_mypage = 'SELECT id, name, title, article, created, modified FROM user_mypage';
 
     // SQL文を実行する
     $stmt_mypage = $db->query($sql_mypage);
 
     // SQL文の実行結果を配列で取得する
     $mypages = $stmt_mypage->fetchAll(PDO::FETCH_ASSOC);

?>








<!DOCTYPE>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>マイページ</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
    </head>
    <body style="background-color:#f0fff0;">
    <header>
    <h1 class="text-center p-3 mb-2 bg-light text-dark">マイページ</h1>
    <?php var_dump($_SESSION); ?>
    <h1><?php echo $_SESSION['name'] . "さんようこそ"; ?></h1>
    </header>
    <br>
    <br>
    <main>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a href="#" class="navbar-brand">最近の投稿一覧</a>
 

                    <form action="post" class="d-flex mb-2 col-3 mb-lg-0">
                        <button class="btn btn-success text-white me-2 form-control" type="button" onclick="location.href='../index.php'">掲示板へ</button>
                        <?php if(isset($_SESSION["name"])): ?>
                        <button class="btn btn-secondary me-2 form-control" type="button" onclick="location.href='user_logout.php'">ログアウト</button>
                        <?php endif ?>                  
                    </form>
             </div>
          </nav>
          <br>
          <br>
          <br>    
    <table class="table">
        <tr class="table-info">
          <th>ID</th>
          <th>投稿者</th>
          <th>投稿タイトル</th>
          <th>投稿内容</th>
          <th>投稿日時</th>
        </tr>  
              <?php
            //   print_r($mypages);
              if(isset($_SESSION["name"])){
                foreach($mypages as $mypage) {
                    if($mypage['name'] == $_SESSION["name"]){
                    echo "<tr><td>{$mypage['id']}</td>
                              <td>{$mypage['name']}</td>
                              <td>{$mypage['title']}</td>
                              <td>{$mypage['article']}</td>
                              <td>{$mypage['created']}</td>
                              </tr>";
                    }
                }
              }
              ?>

    </table>
    </main>
    
    <footer>
        <p class="copyright">&copy; 会員制掲示板 All rights reserved.</p>
    </footer>

    </body>
</html>