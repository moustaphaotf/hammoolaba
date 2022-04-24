<?php

    if(!isset($_GET['id'])){
        header("Location:index.php");
    }
    else{
        require "config.php";
        require "functions.php";
    

        $id = (int)$_GET['id'];

        $db = new mysqli($hname, $uname, $pword, $dbase);

        $resultarticle = $db->query("SELECT articles.*, categories.name FROM articles INNER JOIN categories ON articles.cat_id = categories.id WHERE articles.id = " . $id);
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

<h1 class='text-center'><?=$rowarticle['title']?></h1>
<p class='infos-sup'><span class="auteur-article">Mamadou Madjou Bah</span> - <span class="heure-publication"><?= date_duree($rowarticle['dateposted']) ?></span></p>
<div class="share d-flex align-items-center justify-content-center align-items-center">
    <a href="#" class="btn rounded-50"><i class="fa fa-facebook"></i></a>
    <a href="#" class="btn rounded-50"><i class="fa fa-twitter"></i></a>
    <a href="#" class="btn rounded-50"><i class="fa fa-whatsapp"></i></a>
    <a href="#" class="btn rounded-50"><i class="fa fa-facebook"></i></a>
</div>
<div class="card">
    <div class="d-flex align-items-center justify-content-center">
        <img src="<?= $config_imgarticle_folder . '/' . $rowarticle['imgpath'] ?>" width="600" height = "" alt="photo article"/>
    </div>
    <div class="card-body">
        <?= html_entity_decode(nl2br($rowarticle['body'])) ?>
    </div>
</div>
<!-- commentaires -->
<div class="row shadow">
    <h3>Commentaires</h3>
</div>
<!-- suggestions -->
<div class="row shadow">
    <h3>Nos suggestions</h3>
    <div class="suggestion d-flex align-items-center col-md-6 col-lg-4">
        <div><img src="Images/articles/hatching-7098132__340.webp" width="70" alt=""></div>
        <div class="ms-2">
            <h4 class="article-title"><a href="#">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Optio, voluptates.</a></h4>
            <p class="infos-sup"><span class="auteur-article">Fatoumata Binta Camara</span> - <span class="heure-publication">22/04/2022 14:52</span></p>
        </div>
    </div>
    <div class="suggestion d-flex align-items-center col-md-6 col-lg-4">
        <div><img src="Images/articles/ship-7140939__340.webp" width="70" alt=""></div>
        <div class="ms-2">
            <h4 class="article-title"><a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum, porro?</a></h4>
            <p class="infos-sup"><span class="auteur-article">Fatoumata Binta Camara</span> - <span class="heure-publication">22/04/2022 14:52</span></p>
        </div>
    </div>
    
    <div class="suggestion d-flex align-items-center col-md-6 col-lg-4">
        <div><img src="Images/articles/bedroom-7132435__340.webp" width="70" alt=""></div>
        <div class="ms-2">
            <h4 class="article-title"><a href="#">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Numquam, doloribus!</a></h4>
            <p class="infos-sup"><span class="auteur-article">Fatoumata Binta Camara</span> - <span class="heure-publication">22/04/2022 14:52</span></p>
        </div>
    </div>
    
    <div class="suggestion d-flex align-items-center col-md-6 col-lg-4">
        <div><img src="Images/articles/Linsan-emeutes.webp" width="70" alt=""></div>
        <div class="ms-2">
            <h4 class="article-title"><a href="#">Dubreka : Un jeune brûlé vif pour soupçon de vol, la toile s’enflamme</a></h4>
            <p class="infos-sup"><span class="auteur-article">Fatoumata Binta Camara</span> - <span class="heure-publication">22/04/2022 14:52</span></p>
        </div>
    </div>
    
    <div class="suggestion d-flex align-items-center col-md-6 col-lg-4">
        <div><img src="Images/articles/Colonel-Doumbouya-Syma-Cour-Supreme-prestation-Serment.webp" width="70" alt=""></div>
        <div class="ms-2">
            <h4 class="article-title"><a href="#">Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae, dolore.</a></h4>
            <p class="infos-sup"><span class="auteur-article">Fatoumata Binta Camara</span> - <span class="heure-publication">22/04/2022 14:52</span></p>
        </div>
    </div>
    
    <div class="suggestion d-flex align-items-center col-md-6 col-lg-4">
        <div><img src="Images/articles/PAM-PCG.webp" width="70" alt=""></div>
        <div class="ms-2">
            <h4 class="article-title"><a href="#">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dignissimos, fuga.</a></h4>
            <p class="infos-sup"><span class="auteur-article">Fatoumata Binta Camara</span> - <span class="heure-publication">22/04/2022 14:52</span></p>
        </div>
    </div>
</div>
<!-- -->
<?php require "includes/footer.php" ; ?>