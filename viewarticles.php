<?php
session_start();
require "config.php";

if(!isset($_SESSION['USER_ID'])){
  header("Location:connexion.php");
}
else if($_SESSION['USER_ROLE'] < USER_ADMIN){
  header("Location:index.php");
}

require "functions.php";

$db = new mysqli($hname, $uname, $pword, $dbase);
$resultarticles = $db->query("SELECT articles.id, dateposted, imgpath, title, users.name AS author_name, author_id, categories.name AS cat_name FROM categories INNER JOIN articles ON categories.id = articles.cat_id INNER JOIN users ON users.id = articles.author_id ORDER BY dateposted DESC, cat_name, title LIMIT 5");

$fichier_style = "css/viewarticles.css";
require "includes/header.php";
?>

<div class="row">
  <div class="col px-4 pt-2">
    <div class="alert alert-dismissible alert-success d-none">
      <p class="content m-0"></p>
      <a class="btn-close" data-bs-dismiss="alert"></a>
    </div>

    <h1 class="text-center">Articles disponnibles</h1>

    <?php if($resultarticles->num_rows === 0) : ?>
      <p>Aucun article n'est disponnible pour l'instant !</p>
    <?php else : ?>
      <table class="table table-striped table-hover align-middle user-select-none">
        <thead class="table-dark">
          <tr>
            <th>Publication</th>
            <th class="d-none d-md-table-cell">Autheur</th>
            <th class="d-none d-md-table-cell">Image</th>
            <th>Titre</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
            while($rowarticle = $resultarticles->fetch_array(MYSQLI_ASSOC)){
              echo 
                '<tr>'
                  . '<td>' . date_duree($rowarticle['dateposted']) .  '</td>'
                  . '<td  class="d-none d-md-table-cell"><i class="fa fa-user"></i> '. ($_SESSION['USER_ID'] == $rowarticle['author_id'] ? 'Vous' : $rowarticle['author_name']) . '</td>'
                  . '<td  class="d-none d-md-table-cell"><img src="' . $config_imgarticle_folder . '/' . $rowarticle['imgpath'] . '" width="100"></td>'
                  . '<td class="article-title"><a href="article.php?id=' . $rowarticle['id'] . '">' . $rowarticle['title'] . '</a></td>'
                  . '<td><div class="d-flex justify-content-center align-items-center">'
                    . '<a class="edit-article" href="editarticle.php?id=' . $rowarticle['id'] . '"><i class="fa fa-edit fa-lg"></i></a> &nbsp; &nbsp;'
                    . '<a class="delete-article" href="deletearticle.php?id=' . $rowarticle['id'] . '" data-article-id="' . $rowarticle['id'] . '"><i class="fa fa-trash fa-lg"></i></a>'
                  . '</div></td>'
              . '</tr>';
            }
          
          ?>
        </tbody>
      </table>
    <?php endif ?>
  </div>
</div>
<?php require "includes/footer.php";?>