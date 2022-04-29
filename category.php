<?php
    require "config.php";
    require "functions.php";

    $db = new mysqli($hname, $uname, $pword, $dbase);
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $stmt = $db->prepare("SELECT * FROM categories WHERE id=?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $resultcat = $stmt->get_result();

        if($resultcat->num_rows == 1){
            $cat_name = $resultcat->fetch_array(MYSQLI_ASSOC)['name'];
            $querystr = "SELECT id, title, imgpath, dateposted FROM articles WHERE cat_id=?";
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
    <?php
		if($resultarticles->num_rows > 0){
			while ($rowarticle = $resultarticles->fetch_array(MYSQLI_ASSOC)){
				echo article($rowarticle);
			}
		}
    else{
      echo "<p>Il n'y a présentement aucun article pour cette catégorie.</p>";
    }
	?>
</div>

<?php require "includes/footer.php" ; ?>