<?php
	require "functions.php";
	require "includes/header.php";
	$db = new mysqli($hname, $uname, $pword, $dbase);
	$resultarticles = $db->query("SELECT articles.*, categories.name FROM articles INNER JOIN categories ON categories.id = articles.cat_id  ORDER BY articles.dateposted DESC");
?>

<!-- le slider -->
<!--
<div class="carousel slide" id="slider" data-bs-ride="carousel" data-bs-interval="5000">
		<div class="carousel-inner">
				<div class="carousel-indicators">
						<button type="button" data-bs-slide-to="0" data-bs-target="#slider" class="active"></button>
						<button type="button" data-bs-slide-to="1" data-bs-target="#slider"></button>
				</div>
				<div class="carousel-item active">
						<img src="Images/img1.jpg" alt="">
						<div class="carousel-caption">
								<p><a href="#">lorem lorem rqsdfpjqjsfmdqkjfmqdjsf</a></p>
						</div>
				</div>
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
-->

<p id="urgent"><img src="Images/urgent.gif" width="50px" height="50px" alt="logo"> <marquee  direction="left">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Porro, incidunt, nesciunt sed sapiente nisi animi </marquee></p>
<div class="grid row">
	<?php
		if($resultarticles->num_rows > 0){
			while ($rowarticle = $resultarticles->fetch_array(MYSQLI_ASSOC)){
				echo '<div class="grid-item col-lg-4">';
					echo '<div class="d-flex flex-column">';
						echo '<div class="image_article"><img src="' . $config_imgarticle_folder . '/' . $rowarticle['imgpath'] . '" alt="' . $rowarticle['title'] . '" width="100%"></div>';
						echo '<div>';
								echo '<h5 class="article-title"><a href="article.php?id='. $rowarticle['id'] . '">'. $rowarticle['title'] . '</a></h5>';
								echo '<p class="infos-sup"><span class="auteur-article">Mamadou Moustapha Diallo</span> - <span class="heure-publication">' . date_duree($rowarticle['dateposted']) . '</span></p>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			}
		}
	?>
</div>

<?php require "includes/footer.php" ; ?>