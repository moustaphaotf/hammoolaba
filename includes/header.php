<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Hammoolaba</title>
    <link rel="stylesheet" href="css/bootstrap.css" >
    <link rel="stylesheet" href="css/font-awesome.min.css" >
    <link rel="stylesheet" href="css/index.css">
<?php 
    if(isset($fichier_style)){
        echo "<link rel='stylesheet' href='$fichier_style'>";
    }
?>
</head>
<body>
    <header>
        <div class="d-flex justify-content-between align-items-center">
            <img src="" alt="logo" id="logo">
            <h1 id="nom_site">Hammoolaba</h1>
            <ul class="link-list list-unstyled d-flex align-items-center">
                <li><a href="http://www.facebook.com"  target="blank"><i class="fa fa-facebook"></i></a></li>
                <li><a href="mailto:bintacamara58@gmail.com" target="blank"><i class="fa fa-google"></i></a></li>
                <li><a href="http://www.twitter.com" target="blank"><i class="fa fa-twitter"></i></a></li>
            </ul>
        </div>
        <nav class="navbar justify-content-center bg-dark"> 
            <ul class="nav">
                <li class="nav-item"><a href="index.php" class="nav-link">Acceuil</a></li>
                <li class="nav-item"><a href="alaune.php" class="nav-link">A la une</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Categories</a></li>
                <li class="nav-item"><a href="connexion.php" class="nav-link">Connexion</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link">Nous contacter</a></li>
            </ul>
        </nav>
    </header>
    <div id="page">