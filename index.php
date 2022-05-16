<?php
	require_once "config.php";
	require_once "functions.php";
	$db = new mysqli($hname, $uname, $pword, $dbase);
	$resultarticles = $db->query("SELECT articles.id, title, imgpath, dateposted, categories.name AS cat_name, colortheme, users.name AS author_name, author_id FROM articles INNER JOIN categories ON categories.id = articles.cat_id INNER JOIN users ON users.id = articles.author_id ORDER BY articles.dateposted DESC");
	if(isset($_GET['page'])){
		$page = (int)($_GET['page']);
		if($page <= 0){
			header("Location:index.php");
			die();
		}
	}
	else{
		$page = 1;
	}
	require "includes/header.php";
?>

<div class="urgent shadow rounded d-flex align-items-center mb-2">
	<img src="Images/urgent.gif" width="50px" height="50px" alt="logo">
	<marquee  direction="left">
			<?php
				if($resultarticles->num_rows > 0){
					// récuperer tous les articles
					$articles = $resultarticles->fetch_all(MYSQLI_ASSOC);
					
					// conserver seulement les 10 premiers
					$articles = array_slice($articles, 0, 10);

					// mélanger
					shuffle($articles);

					echo "<p>";
					for($i = 0; $i < count($articles); $i++){
						printf("<strong><span class='badge' style='color : black; background-color:%s;'>%s :</span></strong> ", $articles[$i]['colortheme'] ?? 'gray', $articles[$i]['cat_name']);
						printf("<a href='article.php?id=%d'>%s</a>&nbsp;&nbsp;%s", $articles[$i]['id'], $articles[$i]['title'], ($i < count($articles) - 1 ? ' / &nbsp;' : ''));
					}
					echo "</p>";
				}
			?>
	</marquee>
</div>

<div class="grid row">
	<?php
		if($resultarticles->num_rows > 0){
			$total_pages = (int)ceil($resultarticles->num_rows / MAX_ARTICLES_PER_PAGE);

			if($page > $total_pages) $page = $total_pages;

			$resultarticles->data_seek(($page - 1) * MAX_ARTICLES_PER_PAGE);

			$i = 0;
			while ($i < MAX_ARTICLES_PER_PAGE && $rowarticle = $resultarticles->fetch_array(MYSQLI_ASSOC)){
				echo article($rowarticle);
				$i++;
			}
		}
	?>
</div>

<?php if($resultarticles->num_rows > 0 && $total_pages > 1) : ?>
	<hr>
	<div>
		<h5 class="text-center">Articles suivants</h5>
		<div class="d-flex justify-content-center">
			<ul class="pagination">
				<?php
					for($i = 1; $i <= $total_pages; $i++){
						printf('<li class="page-item"><a href="index.php%s" class="page-link%s">%d</a></li>', ($i === 1 ? '' : '?page=' . $i), ($i === $page ? ' active' : ''), $i);
					}
				?>
			</ul>
		</div>
	</div>
<?php endif ?>
<?php require_once "includes/footer.php" ; ?>