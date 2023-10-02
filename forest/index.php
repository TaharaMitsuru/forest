<?php
require("dbconect.php");
session_start();

 if (!isset($_SESSION["name"])) {
  if(!isset($_SESSION["admin_id"])){
  header("Location: admin/admin_login.php");
  exit();
}
 }
     $db = new PDO('mysql:dbname=forest;host=127.0.0.1; charset=utf8', 'root', '');
 
     //articlesテーブルからid,記事内容、作成日時、更新日時をとってくる
     $sql = 'SELECT id, title, article, created, modified FROM articles';
 
     // SQL文を実行する
     $stmt = $db->query($sql);
 
     // SQL文の実行結果を配列で取得する
     $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>homepagesample</title>
  </head>

  <script>
        function js_confirm() {
           var result = confirm("削除しますか？");
           if (result == true) {
            return true;
         } else {
          return false;
         }

        }
    </script>

  <body style="background-color:#f0fff0;">
    <header>
      <h1 class="text-center p-3 mb-2 bg-light text-dark">HOME PAGE SAMPL</h1>
      <?php var_dump($_SESSION); ?>
    </header>
    <br>
    <br>

    <main>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a href="#" class="navbar-brand">menu</a>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#"></a></li>
                    </ul>

                    <form action="post" class="d-flex mb-2 col-3 mb-lg-0">
                    
                        <?php if(isset($_SESSION["name"])): ?>
                        <button class="btn btn-success text-white me-2 form-control" type="button" onclick="location.href='user/user_mypage.php'">マイページへ</button>
                        <?php endif ?>
                        
                        <button class="btn btn-info text-white me-2 form-control" type="button" onclick="location.href='create.php'">新規投稿</button>
                        
                        <?php if(isset($_SESSION["name"])): ?>
                        <button class="btn btn-secondary me-2 form-control" type="button" onclick="location.href='user/user_logout.php'">ログアウト</button>             
                        <?php elseif(isset($_SESSION["admin_id"])): ?>
                        <button class="btn btn-secondary me-2 form-control" type="button" onclick="location.href='admin/admin_logout.php'">ログアウト</button>
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
          <th>投稿名</th>
          <th>投稿内容</th>
          <th>投稿日時</th>
          <th>更新日時</th>
          <th>編集</th>
          <th>削除</th>
        </tr>  
              <?php
              if(isset($_SESSION["name"])){
                foreach($results as $result) {
                    echo "<tr><td>{$result['id']}</td>
                              <td>{$result['title']}</td>
                              <td>{$result['article']}</td>
                              <td>{$result['created']}</td>
                              <td>{$result['modified']}</td>
                              <td><button class='btn btn-outline-secondary btn btn-light' disabled><a href='update.php?id={$result['id']}'>編集</a></button></td>
                              <td><button class='btn btn-outline-secondary btn btn-light' disabled onclick='return js_confirm()'><a href='delete.php?id={$result['id']}'>削除</a></button></td> 
                              </tr>";
                }
              }
                if(isset($_SESSION["admin_id"])) {
                  foreach($results as $result) {
                    echo "<tr><td>{$result['id']}</td>
                              <td>{$result['title']}</td>
                              <td>{$result['article']}</td>
                              <td>{$result['created']}</td>
                              <td>{$result['modified']}</td>
                              <td><button class='btn btn-outline-secondary btn btn-light'><a href='update.php?id={$result['id']}'>編集</a></button></td>
                              <td><button class='btn btn-outline-secondary btn btn-light' onclick='return js_confirm()'><a href='delete.php?id={$result['id']}'>削除</a></button></td> 
                              </tr>";
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
