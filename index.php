<?php require "includes/header.php"; ?>

<!-- le slider -->

<div class="carousel slide" id="slider" data-bs-ride="carousel" data-bs-interval="5000">
    <div class="carousel-inner">
        <div class="carousel-indicators">
            <button type="button" data-bs-slide-to="0" data-bs-target="#slider" class="active"></button>
            <button type="button" data-bs-slide-to="1" data-bs-target="#slider"></button>
        </div>
        <!-- Pour chaque image-->
        <div class="carousel-item active">
            <img src="Images/img1.jpg" alt="">
            <div class="carousel-caption">
                <p><a href="#">lorem lorem rqsdfpjqjsfmdqkjfmqdjsf</a></p>
            </div>
        </div>
        <!-- Pour chaque image-->
        <div class="carousel-item">
            <img src="Images/img2.jpg" alt="">
            <div class="carousel-caption">
                <p><a href="#">lorem lorem rqsdfpjqjsfmdqkjfmqdjsf</a></p>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-slide="prev" data-bs-target="#slider">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-slide="next" data-bs-target="#slider">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</div>

<p id="urgent"><img src="Images/urgent.gif" width="50px" height="50px" alt="logo"> <marquee  direction="left">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Porro, incidunt, nesciunt sed sapiente nisi animi </marquee></p>
<div class="row">

    <div class="col-md-6 col-lg-4">
        <div class="d-flex flex-column">
            <div class="image_article"><img src="images/articles/Linsan-emeutes.webp" alt="imageAtricle" width="100%"></div>
            <div>
                <h5 class="article-title"><a href="article.php">Dubreka : Un jeune brûlé vif pour soupçon de vol, la toile s’enflamme</a></h5>
                <p class='infos-sup'><span class="auteur-article">Mamadou Moustapha Diallo</span> - <span class="heure-publication">10/03/2022 15:17</span></p>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="d-flex flex-column">
            <div class="image_article"><img src="images/articles/Enseignement-technique.webp" alt="imageAtricle" width="100%"></div>
            <div>
                <h5 class="article-title"><a href="article.php">Avis d’appel d’offres du Ministère de l’Enseignement Technique et de la Formation Professionnelle pour l’acquisition d’un véhicule 4X4</a></h5>
                <p class='infos-sup'><span class="auteur-article">Mamadou Moustapha Diallo</span> - <span class="heure-publication">10/03/2022 15:17</span></p>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-4">
        <div class="d-flex flex-column">
            <div class="image_article"><img src="images/articles/Colonel-Doumbouya-Syma-Cour-Supreme-prestation-Serment.webp" alt="imageAtricle" width="100%"></div>
            <div>
                <h5 class="article-title"><a href="article.php">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Culpa, alias!</a></h5>
                <p class='infos-sup'><span class="auteur-article">Mamadou Moustapha Diallo</span> - <span class="heure-publication">10/03/2022 15:17</span></p>
            </div>
        </div>
    </div>

    
    <div class="col-md-6 col-lg-4">
        <div class="d-flex flex-column">
            <div class="image_article"><img src="images/articles/bedroom-7132435__340.webp" alt="imageAtricle" width="100%"></div>
            <div>
                <h5 class="article-title"><a href="article.php">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis, officiis.</a></h5>
                <p class='infos-sup'><span class="auteur-article">Mamadou Moustapha Diallo</span> - <span class="heure-publication">10/03/2022 15:17</span></p>
            </div>
        </div>
    </div>
        
    <div class="col-md-6 col-lg-4">
        <div class="d-flex flex-column">
            <div class="image_article"><img src="images/articles/ship-7140939__340.webp" alt="imageAtricle" width="100%"></div>
            <div>
                <h5 class="article-title"><a href="article.php">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nostrum, vero!</a></h5>
                <p class='infos-sup'><span class="auteur-article">Mamadou Moustapha Diallo</span> - <span class="heure-publication">10/03/2022 15:17</span></p>
            </div>
        </div>
    </div>
    
       
    <div class="col-md-6 col-lg-4">
        <div class="d-flex flex-column">
            <div class="image-article"><img src="images/articles/PAM-PCG.webp" alt="imageAtricle" width="100%"></div>
            <div>
                <h5 class="article-title"><a href="article.php">Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, eveniet!</a></h5>
                <p class='infos-sup'><span class="auteur-article">Mamadou Moustapha Diallo</span> - <span class="heure-publication">10/03/2022 15:17</span></p>
            </div>
        </div>
    </div>

</div>

<?php require "includes/footer.php" ; ?>