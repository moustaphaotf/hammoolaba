<?php

require "config.php";
require "functions.php";

$db = new mysqli($hname, $uname, $pword, $dbase);
$resultarticles = $db->query("SELECT articles.id, dateposted, imgpath, title, name AS cat_name FROM categories INNER JOIN articles ON categories.id = articles.cat_id ORDER BY dateposted DESC, cat_name, title LIMIT 5");

$fichier_style = "css/viewarticles.css";
require "includes/header.php";
?>

<div class="row">
<h1 class="text-center">Articles disponnibles</h1>

  <?php if($resultarticles->num_rows === 0) : ?>
    <p>Aucun article n'est disponnible pour l'instant !</p>
  <?php else : ?>
    <div class="col px-4 pt-2">
      <table class="table table-striped table-hover align-middle user-select-none">
        <thead class="table-dark">
          <tr>
            <th class="d-none d-md-table-cell">#</th>
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
                  . '<td  class="d-none d-md-table-cell">' . $rowarticle['id'] . '</td>'
                  . '<td>' . date_duree($rowarticle['dateposted']) .  '</td>'
                  . '<td  class="d-none d-md-table-cell"><i class="fa fa-user"></i> Admin</td>'
                  . '<td  class="d-none d-md-table-cell"><img src="' . $config_imgarticle_folder . '/' . $rowarticle['imgpath'] . '" width="100"></td>'
                  . '<td class="article-title"><a href="article.php?id=' . $rowarticle['id'] . '">' . $rowarticle['title'] . '</a></td>'
                  . '<td class="actions">'
                    . '<a href="editarticle.php?id=' . $rowarticle['id'] . '"><i class="fa fa-edit fa-lg"></i></a> &nbsp; &nbsp;'
                    . '<a href="deletearticle.php?id=' . $rowarticle['id'] . '"><i class="fa fa-trash fa-lg"></i></a>'
                  . '</td>'
              . '</tr>';
            }
          
          ?>
        </tbody>
      </table>
    </div>
  <?php endif ?>
</div>
<?php require "includes/footer.php";?>