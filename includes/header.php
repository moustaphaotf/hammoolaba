<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once "config.php";
    $db = new mysqli($hname, $uname, $pword, $dbase);
    $resultcat = $db->query('SELECT categories.id, categories.name, categories.colortheme FROM categories INNER JOIN articles ON categories.id = articles.cat_id GROUP BY categories.id, categories.name, categories.colortheme ORDER BY name');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Hammoolaba</title>
    <link rel="stylesheet" href="css/bootstrap.css" >
    <link rel="stylesheet" href="css/all.css" >
    <link rel="stylesheet" href="css/font-awesome.min.css" >
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/slick-theme.css">
    <link rel="stylesheet" href="css/index.css">
<?php 
    if(isset($fichier_style)){
        echo "<link rel='stylesheet' href='$fichier_style'>";
    }
?>
</head>
<body>
    <header class="card mb-3">
        <div class="text-light d-flex flex-column justify-content-center align-items-center flex-md-row justify-content-md-between">
            <img src="" alt="logo" id="logo">
            <h1>hammoolaba</h1>
            <span class="d-none d-md-inline-block"><svg fill='currentColor' version="1.0" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 128 128"><path d="M49.6 5.3c-13.6 8-13.5 10.7.8 18.6 8.6 4.7 10 5.2 12.2 4.2 1.5-.7 2.7-2.2 3.1-4.2.6-2.9.7-3 4.7-2.4 20.4 3.4 35 17.4 39.2 37.8 2.8 13.3-1.2 28.4-10.4 39-4.1 4.7-4.6 6.7-1.7 6.7 1.9 0 9-9.2 11.9-15.5 3.4-7.2 4.5-12.6 4.6-22.1 0-19.6-10.4-36.1-28.4-44.9-6.9-3.4-20.4-6.4-22.6-5-.5.3-1 2.2-1 4.1 0 2-.5 3.4-1.2 3.4-1.9 0-17.2-9.3-17.2-10.5C43.6 13.3 58.7 4 60.7 4c.8 0 1.3 1.3 1.3 3.5 0 1.9.3 3.5.8 3.5 5.8.3 16.6 2.5 21.5 4.5 4 1.6 6.5 2.1 7.1 1.5 2.4-2.4-9.3-7.6-19.5-8.7-4.5-.4-5.9-1-5.9-2.2C66 3.4 63 0 60.7 0c-1.2.1-6.2 2.4-11.1 5.3z"/><path d="M95.5 18.9c-.3.6 3 4.5 7.3 8.8 12 11.8 17.2 24.2 17.2 40.6 0 25.4-17.7 47.9-42.5 54.2-24.9 6.3-52.5-6.4-63.9-29.6-4.3-8.6-6.8-20.1-4.8-22.1 2.3-2.3 4.5.5 5.9 7.3 5.6 27.7 32.7 44.9 61.1 38.9 6.3-1.4 17.6-7.2 18-9.3.5-2.5-1.5-2.1-9 1.7-27.6 14-60.9-2.6-66.9-33.3-.7-3.5-2.1-7.3-3.1-8.3C10.9 63.9 4 67.1 4 72.7c0 5.6 3.1 15.8 7.1 23.4C20.9 115 42.5 128 64 128c27.7 0 52.5-20.2 58.6-47.7 4.7-21.3-3.4-44.5-20.4-58.7-4.6-3.8-5.7-4.2-6.7-2.7z"/><path d="M50.1 41.6c-2.3 3-2.4 3.3-1.3 5.2 1.1 1.7 3.9.5 4.5-1.9.8-2.8 5.1-2.2 5.5.7.2 1.6-1.2 3.5-5.2 6.9-4.8 4-5.6 5.2-5.6 8.2v3.4l7.8-.3c6-.2 7.7-.6 7.7-1.8 0-1.1-1.4-1.6-5.2-1.8-2.9-.2-5.3-.6-5.3-1s2.3-2.8 5.2-5.3c4.3-3.7 5.1-5.1 5.1-7.9 0-6.7-9-9.7-13.2-4.4zM68.6 47.5c-2.5 4.7-4.6 9.2-4.6 10 0 1.1 1.2 1.5 5 1.5 4.7 0 5 .2 5 2.5 0 1.8.5 2.5 2 2.5s2-.7 2-2.5c0-1.6.6-2.5 1.5-2.5.8 0 1.5-.9 1.5-1.9 0-1-.7-2.1-1.5-2.5-.8-.3-1.5-1.5-1.5-2.6 0-1.3-.7-2-2-2s-2 .7-2 2c0 2-2.5 3.8-3.6 2.7-.3-.3.8-3.2 2.5-6.6 3.4-6.6 3.8-9.1 1.7-9.1-.8 0-3.5 3.8-6 8.5zM43.2 70.7c.3 1.7 2 1.8 21.3 1.8 18 0 21-.2 21-1.5s-3.2-1.5-21.3-1.8c-20-.2-21.3-.1-21 1.5zM56.2 80.7c.3 4.4 3.5 6 4.5 2.4.4-1.6 1.3-2.1 3.9-2.1 1.9 0 3.4.4 3.4.9s-2 4.4-4.5 8.7C58.7 99.1 58 102 60.8 102 63.2 102 72 85.3 72 80.6V77H55.9l.3 3.7z"/></svg></span>
        </div>
        <nav class="navbar navbar-expand-md flex-column align-items-center"> 
            <div class='mb-2'>
                <button data-bs-toggle="collapse" data-bs-target="#menu" aria-expanded="true" aria-haspopup="true" class="btn-nav-action action-open d-md-none btn"><i class="fa fa-bars text-light"></i></button>
                <!--<button class="btn-nav-action action-close d-md-none btn"><i class="fa fa-close text-light"></i></button>-->
            </div>
            <ul class="nav navbar-nav navbar-collapse collapse mb-1" id="menu">
                <li class="nav-item w-100 w-md-auto"><a href="index.php" class="nav-link"><i class="fa fa-home"></i> Acceuil</a></li>
                <?php if(isset($_SESSION['USER_ID']) && $_SESSION['USER_ROLE'] >= USER_ADMIN) : ?>
                    <li class="nav-item w-100 w-md-auto"><a href="newarticle.php" class="nav-link"><i class="fa fa-plus"></i> Nouveau</a></li>
                <?php endif ?>
                
                <li class="nav-item w-100 w-md-auto dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true"><i class="fa fa-newspaper"></i> Categories</a>
                    <div class="dropdown-menu bg-dark">
                        <a href="category.php" class="nav-link dropdown-item">Toutes les informations</a>
                        <hr class="dropdown-divider">
                        <?php
                            while ($rowcat = $resultcat->fetch_array(MYSQLI_ASSOC)){
                                echo "<a href='category.php?id=" . $rowcat['id'] . "' class='nav-link dropdown-item'>" . $rowcat['name'] . "</a>";
                            }
                        ?>
                    </div>
                </li>
                <!-- Affichage du bon boutton de connexion/deconnexion -->
                <?php if(isset($_SESSION['USER_ID'])) : ?>
                    <li class="nav-item w-100 w-md-auto"><a href="deconnexion.php" class="nav-link"><i class="fa fa-user"></i> Déconnexion</a></li>
                <?php else : ?>
                    <li class="nav-item w-100 w-md-auto"><a href="connexion.php" class="nav-link"><i class="fa fa-user"></i> Connexion</a></li>
                <?php endif ?>

                <li class="nav-item w-100 w-md-auto"><a href="contact.php" class="nav-link"><i class="fa fa-phone"></i> Contact</a></li>
                <?php if(isset($_SESSION['USER_ID']) && $_SESSION['USER_ROLE'] >= USER_ADMIN) : ?>
                    <li class="nav-item w-100 w-md-auto dropdown">
                        <a class="nav-link dropdown-toggle" role="button" aria-expanded="false" aria-haspopup="true" data-bs-toggle="dropdown"><i class="fa fa-shield"></i> Admin</a>
                        <div class="dropdown-menu bg-dark">
                            <a href="newarticle.php" class="nav-link">Nouveau article</a>
                            <a href="viewarticles.php" class="nav-link">Lister les articles</a>
                            <hr class="dropdown-divider">
                            <a href="newcategory.php" class="nav-link">Nouveau topic</a>
                            <a href="viewcategories.php" class="nav-link">Lister les topics</a>
                            <hr class="dropdown-divider">
                            <a href="viewusers.php" class="nav-link">Lister les utilisateurs</a>
                        </div>
                    </li>
                <?php endif ?>
            </ul>
            
        </nav>
    </header>
    
    <div class="page container shadow my-2 py-1 bg-light rounded">

    