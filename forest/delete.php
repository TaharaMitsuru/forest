<?php
require("dbconect.php");
    $db = new PDO ('mysql:dbname=forest;host=127.0.0.1; charset=utf8', 'root', '');

    $sql_delete = 'DELETE FROM articles WHERE id = :id';
    $stmt_delete = $db->prepare($sql_delete);

    $stmt_delete->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt_delete->execute();

    $count = $stmt_delete->rowCount();
    header("Location: index.php");
?>