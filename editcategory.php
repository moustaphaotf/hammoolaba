<?php
session_start();
require_once 'config.php';

// gestion des droits

if(!isset($_SESSION['USER_ID'])){
  header("Location:connexion.php");
}
else if($_SESSION['USER_ROLE'] < USER_ADMIN){
  header("Location:index.php");
}

// processing du formulaire de modification
if(isset($_POST['submit'])){
  if(!empty($_POST['name'])){
    $id = htmlentities($_POST['id']);
    $name = htmlentities($_POST['name']);
    $color = htmlentities($_POST['color']);

    // on vérifie que le nom choisi n'existe pas déjà
    $db = new mysqli($hname, $uname, $pword, $dbase);
    $stmt = $db->prepare("SELECT * FROM categories WHERE name = ? AND id != ?");
    $stmt->bind_param('si', $name, $id);
    $stmt->execute();

    $resultcat = $stmt->get_result();

    if($resultcat->num_rows !== 0){
      $status = false;
    }
    else{
      // on met à jour les données
      $stmt = $db->prepare("UPDATE categories SET name = ?, colortheme = ? WHERE id = ? LIMIT 1");
      $stmt->bind_param('ssi', $name, $color, $id);
      $stmt->execute();

      $status = true; // tout va bien
    }
    
    header("Location:viewcategories.php");
  }
}
// on veut modifier une categorie
else if (isset($_GET['id'])){
  // chercher si la categ existe
  $id = (int)$_GET['id'];
  
  $db = new mysqli($hname, $uname, $pword, $dbase);

  $resultcat = $db->query("SELECT * FROM categories WHERE id = " . $id . " LIMIT 1");

  if($resultcat->num_rows === 0){
    header("Location:404.php");
  }
  else{
    // definition des variables puis charger l'article
    $categ_to_edit = $resultcat->fetch_array(MYSQLI_ASSOC);
    $editmode = true;
    $actionpage = "editcategory.php?id=" . $id;

    require_once "newcategory.php";
  }
}
// essai d'accès à /categorie.php ---> index.php
else{
  header("Location:index.php");
}