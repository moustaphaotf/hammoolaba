<?php
	require "functions.php";
	require "includes/header.php";
	$db = new mysqli($hname, $uname, $pword, $dbase);
	$resultarticles = $db->query("SELECT articles.id, title, imgpath, dateposted, name AS cat_name, colortheme FROM articles INNER JOIN categories ON categories.id = articles.cat_id  ORDER BY articles.dateposted DESC");
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
				//var_dump($articles);
				for($i = 0; $i < count($articles); $i++){
					printf("<strong><span class='badge' style='color : black; background-color:%s;'>%s :</span></strong> ", $articles[$i]['colortheme'] ?? 'gray', $articles[$i]['cat_name']);
					printf("<a href='article.php?id=%d'>%s</a>&nbsp;&nbsp;%s", $articles[$i]['id'], $articles[$i]['title'], ($i < count($articles) - 1 ? ' / &nbsp;' : ''));
				}
			}
		?>
	</marquee>
</div>

<div class="grid row">
	<?php
		$resultarticles->data_seek(0);
		if($resultarticles->num_rows > 0){
			while ($rowarticle = $resultarticles->fetch_array(MYSQLI_ASSOC)){
				echo article($rowarticle);
			}
		}
	?>
</div>

<?php require "includes/footer.php" ; ?>