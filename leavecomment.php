<?php
session_start();
require "config.php";

if(isset($_POST['id'])){
  $id = (int)$_POST['id'];
  $body = htmlentities($_POST['body']);

  if(!isset($_SESSION['USER_ID'])){
    if($body !== ""){
      $datas = [
        'id' => $id,
        'body' => $body
      ];
      setcookie('comment', serialize($datas));
    }
    header("Location:connexion.php?ref=article&id=" . $id);
  }
  else{
  
    $db = new mysqli($hname, $uname, $pword, $dbase);
  
    // vérifier que l'article existe
    $resultarticle = $db->query("SELECT * FROM articles WHERE id = " . $id . " LIMIT 1");
    if($resultarticle->num_rows === 0){
      header("Location:index.php");
    }
    else{
      $stmt = $db->prepare("INSERT INTO comments(body, dateposted, author_id, article_id) VALUES(?, NOW(), ?, ?);");
      $stmt->bind_param('sii', $body, $_SESSION['USER_ID'], $id);
      $stmt->execute();
      
      header("Location:article.php?id=" . $id . "#comments");
    }
  }
}
else{
  header("Location:index.php");
}