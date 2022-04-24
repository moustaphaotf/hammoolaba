<?php
    require "config.php";
    $db = new mysqli($hname, $uname, $pword, $dbase);
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $stmt = $db->prepare("SELECT * FROM categories WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $resultcat = $stmt->get_result();

        if($resultcat->num_rows == 1){
            $cat_name = $resultcat->fetch_array(MYSQLI_ASSOC)['name'];
            $querystr = "SELECT * FROM articles WHERE cat_id=?";
            $stmt = $db->prepare($querystr);
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $resultarticles = $stmt->get_result();
        }
        else{
            header("Location:404.php");
            die();
        }
    }
    else{
        $querystr = "SELECT * FROM articles";
        $resultarticles = $db->query($querystr);
    }
    require "includes/header.php" ;
    if(isset($cat_name)){
        echo '<h1 class= "nom-categorie"><i class="fa fa-folder text-success"></i> ' . $cat_name . '</h1>';
    }
    else{
        echo '<h1 class= "nom-categorie"><i class="fa fa-folder text-success"></i> Toutes les informations</h1>';
    }
?>


<div class="row">
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
            <div class="image-article"><img src="images/articles/PAM-PCG.webp" alt="imageAtricle" width="100%"></div>
            <div>
                <h5 class="article-title"><a href="article.php">Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, eveniet!</a></h5>
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
            <div class="image_article"><img src="images/articles/ship-7140939__340.webp" alt="imageAtricle" width="100%"></div>
            <div>
                <h5 class="article-title"><a href="article.php">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nostrum, vero!</a></h5>
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
						<div class="image_article"><img src="images/articles/Linsan-emeutes.webp" alt="imageAtricle" width="100%"></div>
						<div>
								<h5 class="article-title"><a href="article.php">Dubreka : Un jeune brûlé vif pour soupçon de vol, la toile s’enflamme</a></h5>
								<p class='infos-sup'><span class="auteur-article">Admin</span> - <span class="heure-publication">10/03/2022 15:17</span></p>
						</div>
				</div>
		</div>
</div>

<?php require "includes/footer.php" ; ?>