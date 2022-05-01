<?php
		require "config.php";
		require "functions.php";

		$db = new mysqli($hname, $uname, $pword, $dbase);
		if(isset($_GET['id'])){
				$id = (int)$_GET['id'];
				$querystr = "SELECT categories.*, count(articles.id) AS total_articles FROM categories INNER JOIN articles ON categories.id = articles.cat_id WHERE articles.cat_id = " . $id;
				$resultcateg = $db->query($querystr);

				if($resultcateg->num_rows === 0){
						header("Location:404.php");
				}
		}
		else{
				$querystr = "SELECT categories.*, count(articles.id) AS total_articles FROM categories INNER JOIN articles ON categories.id = articles.cat_id GROUP BY categories.id, categories.name ORDER BY categories.name";
				$resultcateg = $db->query($querystr);
		}

		$fichier_style = "css/category.css";
		require "includes/header.php" ;
?>

<div class="container">
	<h2 class="text-center">Liste des topics</h2>
	<?php if($resultcateg->num_rows === 0) : ?>
		<?= "<p>Il n'y au aucun topic actuellement !</p>"?>
	<?php elseif($resultcateg->num_rows === 1): ?> <!-- Un seul topic, adapter la présentation de la page d'acceuil-->
			<?= "voilà un" ?>
	<?php else : ?> <!-- Plusieurs topics, faire un carousel -->
		<?php
			while($rowcat = $resultcateg->fetch_array(MYSQLI_ASSOC)){
				$sqlarticles = "SELECT articles.id, title, imgpath, dateposted, users.name AS author_name FROM articles INNER JOIN users ON users.id = articles.author_id WHERE cat_id = " . $rowcat['id'] . " ORDER BY dateposted DESC";
				$resultarticles = $db->query($sqlarticles);
				echo '<div class="category px-4 mb-2  shadow rounded">';
					echo '<h3 class="category-name my-1"><span class="badge" style="color : black; background-color:' . ($rowcat['colortheme'] ?? 'gray') . '">' . $rowcat['total_articles'] . '</span>&nbsp;&nbsp' . $rowcat['name'] . '</h3>';
					echo '<hr>';
					echo '<div class="myCarousel m">';
						while($rowarticle = $resultarticles->fetch_array(MYSQLI_ASSOC)){
							echo
								'<div class="shadow-sm p-1">'
										.	'<img class="img" src="' . $config_imgarticle_folder . '/' . $rowarticle['imgpath'] . '" alt="' . $rowarticle['title'] . '" width="98%" style="margin:auto;">'
									.	'<div class="">'
									. '<h5 class="article-title"><a href="article.php?id=' . $rowarticle['id'] . '">' . $rowarticle['title'] . '</a></h5>'
									. '<p class="infos-sup"><span class="auteur-article">'. $rowarticle['author_name'] . '</span> - <span class="heure-publication">' . date_duree($rowarticle['dateposted']) . '</span></p>'
									.	'</div>'
								.	'</div>';

						}
					echo '</div>'; // fin du carousel
				echo '</div>';
			}
		?>
	<?php endif ?>
</div>


<?php require "includes/footer.php" ; ?>