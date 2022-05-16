<?php
		require "config.php";
		require "functions.php";

		$db = new mysqli($hname, $uname, $pword, $dbase);

		if(isset($_GET['id'])){
				// définition de la page à afficher
				if(isset($_GET['page'])){
					$page = (int)$_GET['page'];
					if($page <= 0) $page = 1;
				}
				else{
					$page = 1;
				}

				// à partir de l'id passé, on cherche si la categ existe
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

<!-- Contenu de la page -->

<div class="container">
	<?php if($resultcateg->num_rows === 0) : ?>
		<h2 class="text-center">Liste des topics</h2>
		<?= "<p>Il n'y au aucun topic actuellement !</p>"?>
	<?php elseif($resultcateg->num_rows === 1): ?> <!-- Un seul topic, adapter la présentation de la page d'acceuil-->
		<?php 
			// afficher la catégorie courante
			$rowcat = $resultcateg->fetch_array(MYSQLI_ASSOC);
			echo "<h1 class='text-center'>" . $rowcat['name'] . '</h1>';
			echo "<hr>";
		?>
		<div class="row grid">
			<?php
				// puis l'ensemble des articles
				$resultarticles = $db->query("SELECT articles.id, title, dateposted, imgpath, users.name AS author_name, author_id FROM articles INNER JOIN users ON articles.author_id = users.id WHERE articles.cat_id = " . $id . " ORDER BY dateposted DESC");

				if($resultarticles->num_rows === 0){
					echo "<p>Il n'y a aucun article sur ce topic pour l'instant !";
				}
				else{
					// usage de la var $page pour déplacer le curseur au bon endroit
					$total_pages = (int)ceil($resultarticles->num_rows / MAX_ARTICLES_PER_PAGE);
					
					if($page > $total_pages) ;

					$resultarticles->data_seek(($page - 1) * MAX_ARTICLES_PER_PAGE);
					
					$i = 0;
					while($i < MAX_ARTICLES_PER_PAGE && $rowarticle = $resultarticles->fetch_array(MYSQLI_ASSOC)){
						echo article($rowarticle);
						$i++;
					}
				}
			?>
		</div>
	<?php else : ?> <!-- Plusieurs topics, faire un carousel -->
		<h2 class="text-center">Liste des topics</h2>
		<?php
			while($rowcat = $resultcateg->fetch_array(MYSQLI_ASSOC)){
				$sqlarticles = "SELECT articles.id, title, imgpath, dateposted, users.name AS author_name, author_id FROM articles INNER JOIN users ON users.id = articles.author_id WHERE cat_id = " . $rowcat['id'] . " ORDER BY dateposted DESC";
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
									. '<p class="infos-sup"><span class="auteur-article">'. ($_SESSION['USER_ID'] == $rowarticle['author_id'] ? 'Vous' :  $rowarticle['author_name']) . '</span> - <span class="heure-publication">' . date_duree($rowarticle['dateposted']) . '</span></p>'
									.	'</div>'
								.	'</div>';
						}
					echo '</div>'; // fin du carousel
				echo '</div>';
			}
		?>
	<?php endif ?>
</div>

<!-- Puis une petite pagination -->
<?php if(isset($total_pages) && $total_pages > 1) : ?>
	<hr>
	<h5 class="text-center">Articles suivants</h5>
	<?php
	var_dump($page);
	?>
	<div class="d-flex justify-content-center">
		<ul class="pagination">
			<?php
				for($i = 1; $i <= $total_pages; $i++){
					printf ('<li class="page-item"><a href="category.php?id=%d%s" class="page-link%s">%d</a></li>', $id, ($page === $i ? '' : '&page=' . $i), ($page === $i ? ' active' : ''), $i);
				}
			?>
		</ul>
	</div>
<?php endif ?>

<?php require "includes/footer.php" ; ?>