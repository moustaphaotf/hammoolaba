<?php

    if(!isset($_GET['id'])){
        header("Location:index.php");
    }
    else{
        require "config.php";
        require "functions.php";
    

        $id = (int)$_GET['id'];

        $db = new mysqli($hname, $uname, $pword, $dbase);

        $resultarticle = $db->query("SELECT articles.*, categories.name AS cat_name, users.name AS author_name FROM articles INNER JOIN categories ON articles.cat_id = categories.id INNER JOIN users ON users.id = articles.author_id WHERE articles.id = " . $id);
        if($resultarticle->num_rows !== 1) {
            header("Location:index.php");
        }
        else{
            $rowarticle = $resultarticle->fetch_array(MYSQLI_ASSOC);
        }
    }
    $fichier_style = "css/article.css";
    require "includes/header.php" ;
?>

<h1 class='title text-center mx-5 mt-3'><?=$rowarticle['title']?></h1>
<p class='infos-sup'><span class="auteur-article"><?= $rowarticle['author_name'] ?></span> - <span class="heure-publication"><?= date_duree($rowarticle['dateposted']) ?></span></p>
<div class="d-flex align-items-center justify-content-center align-items-center">
    <div class="share" title="Fonctionnalités non disponnibles" data-bs-toggle='tooltip' data-bs-placement='top'>
        <a href="#" class="btn rounded-50"><i class="fa fa-facebook"></i></a>
        <a href="#" class="btn rounded-50"><i class="fa fa-twitter"></i></a>
        <a href="#" class="btn rounded-50"><i class="fa fa-whatsapp"></i></a>
    </div>
</div>
    

<div>
    <div class="d-flex align-items-center justify-content-center">
        <img src="<?= $config_imgarticle_folder . '/' . $rowarticle['imgpath'] ?>" width="600" height = "" alt="photo article"/>
    </div>
    <div class="article-body shadow-sm rounded p-2 m-3">
        <?= html_entity_decode(nl2br($rowarticle['body'])) ?>
    </div>
</div>

<!-- suggestions -->
<div class="row  m-3">
	<?php
        $resultarticle = $db->query("SELECT articles.id, title, imgpath, dateposted, users.name AS author_name FROM articles INNER JOIN users ON articles.author_id = users.id WHERE cat_id = " . $rowarticle['cat_id'] . " AND articles.id != " . $id . " ORDER BY dateposted DESC LIMIT 6");

        if($resultarticle->num_rows > 0){
            echo "<hr>";
            echo "<h3 style='color : rgba(21, 41, 76);'><i class='sun fas fa-sun'></i> Nos suggestions</h3>";
            while($rowarticle = $resultarticle->fetch_array(MYSQLI_ASSOC)){
                echo 
                '<div class="suggestion d-flex align-items-center col-md-6 col-lg-4 shadow-sm mb-2">'
                    . '<div><img src="' . $config_imgarticle_folder . '/' . $rowarticle['imgpath'] . '" width="70" alt="Image"></div>'
                    . '<div class="ms-2">'
                        . '<h4 class="article-title"><a href="article.php?id=' . $rowarticle['id'] . '">'. $rowarticle['title'] . '</a></h4>'
                        . '<p class="infos-sup"><span class="auteur-article">' . $rowarticle['author_name'] . '</span> - <span class="heure-publication">'. date_duree($rowarticle['dateposted']) . '</span></p>'
                    . '</div>'
                . '</div>';
            }
        }
    ?>
</div>
<!-- -->
<?php require "includes/footer.php" ; ?>