<?php
session_start();
require 'config.php';

if(!isset($_SESSION['USER_ID'])){
  header("Location:connexion.php");
  die();
}
else if($_SESSION['USER_ID'] < USER_ADMIN){
  header("Location:index.php");
  die();
}

if(!isset($_GET['id'])){
  header("Location:viewusers.php");
  die();
}

// vérifier l'existence de l'utilisateur à promouvoir
$id = (int)$_GET['id'];

$db = new mysqli($hname, $uname, $pword, $dbase);

$resultuser = $db->query("SELECT * FROM users WHERE id = " . $id . " LIMIT 1");

if($resultuser->num_rows === 0){
  header("Location:viewusers.php?error=nouser");
  die();
}

$rowuser = $resultuser->fetch_array(MYSQLI_ASSOC);

// vérifier que ce n'est pas l'utilisateur lui même qui veut s'auto-promouvoir
$promoter = $_SESSION['USER_ID'];
$promotee = $id;

var_dump(compact('promoter', 'promotee'));

if($promoter === $promotee){
  header("Location:viewusers.php?error=noautochange");
  die();
}

switch($rowuser['role']){
  case USER :
    $newrole = USER_ADMIN;

    $stmt = $db->prepare("INSERT INTO promotions(promoter_id, promotee_id, role, datepromoted) VALUES(?, ?, ?, NOW())");
    $stmt->bind_param('iis', $promoter, $promotee, $newrole);
    $stmt->execute();
    
    $db->query("UPDATE users SET role = " . $newrole . " WHERE id = " . $promotee . " LIMIT 1");
    break;
  case USER_ADMIN :
    $newrole = USER;

    $stmt = $db->prepare("INSERT INTO promotions(promoter_id, promotee_id, role, datepromoted) VALUES(?, ?, ?, NOW())");
    $stmt->bind_param('iis', $promoter, $promotee, $newrole);
    $stmt->execute();

    $db->query("UPDATE users SET role = " . $newrole . " WHERE id = " . $promotee . " LIMIT 1");
    break;
  case USER_SUPER :
    break;
}

header("Location:viewusers.php?id=" . $id . "&error=none");