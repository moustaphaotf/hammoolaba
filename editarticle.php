<?php
session_start();
require_once 'config.php';


if(!isset($_SESSION['USER_ID'])){
  header("Location:connexion.php");
}
else if($_SESSION['USER_ROLE'] < USER_ADMIN){
  header("Location:index.php");
}

// le formulaire d'édition a été soumis
if(isset($_POST['submit'])){
  $id = (int)$_POST['article_id'];
  $title = htmlentities($_POST['title']);
  $category = (int) $_POST['category'];
  $body = htmlentities($_POST['body']);
  $image = $_FILES['photo'];

  // on vérifie qu'un article existe bien avec cet ID
  $db = new mysqli($hname, $uname, $pword, $dbase);

  $resultarticle = $db->query("SELECT * FROM articles WHERE id = " . $id);
  if($resultarticle->num_rows === 0){
    header("Location:404.php");
  }
  else{
    // on procède à la vérification des variables
    //die("Et voilà ça marche");
    if($title === ""){
      header("Location:editarticle.php?id=" . $id . "&error=notitle");
    }
    else if($image['name'] !== '' &&
      $image['type'] !== 'image/webp' &&
      $image['type'] !== 'image/png' &&
      $image['type'] !== 'image/jpg' &&
      $image['type'] !== 'image/jpeg'){
      header("Location:editarticle.php?id=" . $id . '&error=imageinvalid');
    }
    else if($body === ""){
      header("Location:editarticle.php?id=" . $id . "&error=nocontent");
    }
    else{
      $resultcat = $db->query("SELECT * FROM categories WHERE id = " . $category);
      if($resultcat->num_rows === 0){
        header("Location:editarticle.php?id=" . $id . "&error=nocategory");
      }
      else{
        // toutes les variables sont valides, procéder à la mise à jour !

        $rowtoedit = $resultarticle->fetch_array(MYSQLI_ASSOC);
        if($image['name'] !== ''){
          $now = time();
          unlink($config_imgarticle_folder . '/' . $rowtoedit['imgpah']);
          $imgpath = sprintf("%d.%s", $now, pathinfo($image['name'])['extension']);
        }
        else{
          $imgpath = $rowtoedit['imgpath'];
        }

        $stmt = $db->prepare("UPDATE articles SET title = ?, body = ?, imgpath = ?, cat_id = ? WHERE id = ? LIMIT 1");
        $stmt->bind_param('sssii', $title, $body, $imgpath, $category, $id);
        $stmt->execute();
        
        // déplacer l'image
        move_uploaded_file($image['tmp_name'], $config_imgarticle_folder . '/' . $imgpath);

        // rediriger vers l'article en question !
        header("Location:article.php?id=" . $id);
      }
    }
  }
}
// on veut éditer un article particulier
else if(isset($_GET['id'])){
  $id = (int)$_GET['id'];
  
  $db = new mysqli($hname, $uname, $pword, $dbase);
  
  $resultarticle = $db->query("SELECT articles.*, users.name AS author_name, users.email AS author_email FROM articles INNER JOIN users ON users.id = articles.author_id WHERE articles.id = " . $id);
  
  if($resultarticle->num_rows === 0){
    require "404.php";
  }
  else{
    // définir le script qui se charge du processing
    $actionpage = 'editarticle.php?id=' . $id;

    // definir la variable contenant les informations de l'article à modifier
    $article_to_edit = $resultarticle->fetch_array((MYSQLI_ASSOC));

    // inclure le formulaire

    $editmode = true;
    require_once "newarticle.php";
  }
}
// on n'a voulu accéder à /editarticle.php
else{
  header("Location:index.php");
}

?>