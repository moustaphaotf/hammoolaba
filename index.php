<?php
	require "functions.php";
	require "includes/header.php";
	$db = new mysqli($hname, $uname, $pword, $dbase);
	$resultarticles = $db->query("SELECT articles.*, categories.name FROM articles INNER JOIN categories ON categories.id = articles.cat_id  ORDER BY articles.dateposted DESC");
?>

<p id="urgent"><img src="Images/urgent.gif" width="50px" height="50px" alt="logo"> <marquee  direction="left">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Porro, incidunt, nesciunt sed sapiente nisi animi </marquee></p>
<div class="grid row">
	<?php
		if($resultarticles->num_rows > 0){
			while ($rowarticle = $resultarticles->fetch_array(MYSQLI_ASSOC)){
				echo article($rowarticle);
			}
		}
	?>
</div>

<?php require "includes/footer.php" ; ?>