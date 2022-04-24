<?php
    require "config.php";
    $db = new mysqli($hname, $uname, $pword, $dbase);
    $resultcat = $db->query('SELECT * FROM categories ORDER BY name');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Hammoolaba</title>
    <link rel="stylesheet" href="css/bootstrap.css" >
    <link rel="stylesheet" href="css/all.css" >
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
        <nav class="navbar"> 
            <ul class="nav navbar-collapse justify-content-center bg-dark">
                <li class="nav-item"><a href="index.php" class="nav-link"><i class="fa fa-home"></i> Acceuil</a></li>
                <li class="nav-item"><a href="newarticle.php" class="nav-link"><i class="fa fa-plus"></i> Nouveau</a></li>
                <li class="nav-item dropdown">
                    <a class="btn nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true"><i class="fa fa-newspaper"></i> Categories</a>
                    <div class="dropdown-menu bg-dark">
                        <a href="categorie.php" class="nav-link dropdown-item">Toutes les informations</a>
                        <?php
                            while ($rowcat = $resultcat->fetch_array(MYSQLI_ASSOC)){
                                echo "<a href='categorie.php?id=" . $rowcat['id'] . "' class='nav-link dropdown-item'>" . $rowcat['name'] . "</a>";
                            }
                        ?>
                    </div>
                </li>
                <li class="nav-item"><a href="connexion.php" class="nav-link"><i class="fa fa-user"></i> Connexion</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link"><i class="fa fa-phone"></i> Nous contacter</a></li>
            </ul>
            
        </nav>
    </header>
    
    <div class="page container shadow my-2 pt-1">

    