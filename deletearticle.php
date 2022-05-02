<?php
  session_start();
  require_once 'config.php';

  if(!isset($_SESSION['USER_ID'])){
    header("Location:connexion.php");
  }
  if($_SESSION['USER_ROLE'] != USER){
    header("Location:index.php");
  }

  header('Content-type: application/json');  
  if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
    $db = new mysqli($hname, $uname, $pword, $dbase);
    
    // vérifier l'existence de l'aticle
    $resultarticle = $db->query("SELECT * FROM articles WHERE id = " . $id . " LIMIT 1");
    if($resultarticle->num_rows === 0){
      $response_array['status'] = 'error';
    }
    else{
      $db->query("DELETE FROM articles WHERE id = " . $id . " LIMIT 1");
      $response_array['status'] = 'success';
    }

    echo json_encode($response_array);

  }
  else{
    header("Location:viewarticles.php");
  }
?>