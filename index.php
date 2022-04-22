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
<div class="card">
    <div class="card-body">
        <div class="d-flex">
            <div class="image_article"><img src="" alt="imageAtricle"></div>
            <div>
                <h3 clas="card-title">Passeports biométriques : Les opérations d’enrôlement et de délivrance ont repris</h3>
                <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptas possimus velit porro nostrum enim. Inventore 
                sit dignissimos facere unde, atque dolor ipsum veritatis ea soluta voluptate, maxime, corporis <a href="article.php">Read more...</a>.</p>
                <p class='infos_supplementaires'><span class="auteur_article">Mamadou Moustapha Diallo</span> - <span class="heure_publication">10/03/2022 15:17</span></p>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="d-flex">
            <div class="image_article"><img src="" alt="imageAtricle"></div>
            <div>
                <h3 clas="card-title">Passeports biométriques : Les opérations d’enrôlement et de délivrance ont repris</h3>
                <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptas possimus velit porro nostrum enim. Inventore 
                sit dignissimos facere unde, atque dolor ipsum veritatis ea soluta voluptate, maxime, corporis <a href="article.php">Read more...</a>.</p>
                <p class='infos_supplementaires'><span class="auteur_article">Mamadou Moustapha Diallo</span> - <span class="heure_publication">10/03/2022 15:17</span></p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex">
            <div class="image_article"><img src="" alt="imageAtricle"></div>
            <div>
                <h3 clas="card-title">Passeports biométriques : Les opérations d’enrôlement et de délivrance ont repris</h3>
                <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptas possimus velit porro nostrum enim. Inventore 
                sit dignissimos facere unde, atque dolor ipsum veritatis ea soluta voluptate, maxime, corporis <a href="article.php">Read more...</a>.</p>
                <p class='infos_supplementaires'><span class="auteur_article">Mamadou Moustapha Diallo</span> - <span class="heure_publication">10/03/2022 15:17</span></p>
            </div>
        </div>
    </div>
</div>

<?php require "includes/footer.php" ; ?>