<?php
session_start();
require_once 'config.php';

// gestion des droits

if(!isset($_SESSION['USER_ID'])){
  header("Location:connexion.php");
}
else if($_SESSION['USER_ROLE'] < USER_ADMIN){
  header("Location:index.php");
}

$db = new mysqli($hname, $uname, $pword, $dbase);
$resultcateg = $db->query("SELECT categories.id, categories.name, categories.colortheme, count(articles.id) AS total_articles FROM articles RIGHT JOIN categories ON articles.cat_id = categories.id GROUP BY categories.id, categories.name, categories.colortheme ORDER BY categories.name");

$fichier_style = "css/viewcategories.css";
require_once 'includes/header.php';
?>
<div class="row">
  <div class="col  px-4 pt-2">
    <h2 class="text-center">Topics disponnibles</h2>
  <?php if($resultcateg->num_rows === 0) : ?>
    <p>Aucun topic/catégorie n'est disponnible, <a href='newcategory.php'>ajoutez-en une</a> !</p>
  <?php else : ?>
    <table class="table table-striped align-middle">
      <thead>
        <tr class="table-dark">
          <th>#</th>
          <th>Nom</th>
          <th>Articles publiés</th>
          <th>Couleur de thème</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $i = 1;
          while($rowcat = $resultcateg->fetch_array(MYSQLI_ASSOC)){
            echo 
            '<tr>'
                . "<td>" . $i . "</td>"
                . "<td class='category-name'><a href='category.php?id=" . $rowcat['id'] . "'>" . $rowcat['name'] . "</a></td>"
                . "<td>" . $rowcat['total_articles'] . "</td>"
                . "<td><span class='badge' style='color:black; background-color:". $rowcat['colortheme'] ."'>" . (isset($rowcat['colortheme']) ? $rowcat['colortheme'] : 'Aucune') . "</span></td>"
                . "<td><div class='d-flex justify-content-center align-items-center'>"
                  . '<a class="edit-category" href="editcategory.php?id=' . $rowcat['id'] . '"><i class="fa fa-edit fa-lg"></i></a>'
                . "</div></td>"
            . '</tr>';
            $i++;
          }
        ?>
      </tbody>
    </table>
    <?php 
    
    ?>
  <?php endif ?>
    
</div>
</div>
<?php require_once 'includes/footer.php'; ?>