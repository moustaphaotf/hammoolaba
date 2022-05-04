<?php
  session_start();
  require_once 'config.php';

  if(!isset($_SESSION['USER_ID'])){
    header("Location:connexion.php");
  }
  else if($_SESSION['USER_ROLE']  < USER_ADMIN){
    header("Location:index.php");
  }

  // chercher les informations de l'utilisateur
  if(isset($_GET['id'])){
    $id = (int)$_GET['id'];
  }
  else{
    $id = $_SESSION['USER_ID'];
  }

  $db = new mysqli($hname, $uname, $pword, $dbase);

  // un seul (singulier)

  $resultuser = $db->query(
    "SELECT users.id, name, email, users.role, count(articles.id) AS total_articles
      FROM users
      LEFT JOIN articles ON users.id = articles.author_id
      WHERE users.id = " . $id . "
      GROUP BY users.id;");
  


  if($resultuser->num_rows !== 1){
    header("Location:viewusers.php?error=nouser");
  }
  // infos sans la date de promotion
  $rowuser = $resultuser->fetch_array(MYSQLI_ASSOC);
  
  $resultprom = $db->query("SELECT MAX(datepromoted) AS datepromoted FROM promotions WHERE promotee_id = " . $id . " GROUP BY promotee_id");
  $rowprom = $resultprom->fetch_array(MYSQLI_ASSOC);

  $fichier_style = "css/viewusers.css";
  require_once "includes/header.php";
?>

<div class="row">
  <div class="user col-lg-7 p-5">
    <?php 
      if(isset($_GET['error'])){
        $type = "alert-warning";
        switch($_GET['error']){
          case 'nouser' : 
            $msg = "L'utilisateur n'existe pas !";
            break;
          case 'noautochange' :
            $msg = "Vous ne pouvez pas changer votre droit !";
            break;
          case 'none';
            $msg = "Changement effectué avec succès !";
            $type = "alert-success";
            break;
        }
        echo '<div class="alert alert-dismissible fade show ' . $type . '">';
          echo '<p class="m-0"><i class="fa ' . ($type === 'alert-warning' ? 'fa-exclamation-triangle' : 'fa-check-circle') . '"></i> ' . $msg . '</p>';
          echo '<a class="btn-close" data-bs-dismiss="alert"></a>';
        echo '</div>';
      }
    ?>
    
    <h2 class="text-center"><?= ($_SESSION['USER_ID'] === $id) ? "Votre profil" : "Profil de " . $rowuser['name'] ?></h2>
    <div class="personal-infos d-flex flex-column align-items-center">
      <i class="fa fa-user-large fa-2x"></i>
      <div class="div">
        <table class="table w-auto table-borderless shadow-sm">
          <tbody>
            <tr>
              <th>Nom complet</th>
              <td style="font-weight:bold;"><?= $rowuser['name'] ?></td>
            </tr>
            <tr>
              <th>email</th>
              <td class="email" style="font-style:italic;"><?= sprintf("<a %s>%s</a>", ($rowuser['id'] == $_SESSION['USER_ID'] ? '' : "href='mailto:{$rowuser['email']}'") , $rowuser['email']) ?></td>
            </tr>
            <tr>
              <?php
                switch($rowuser['role']){
                  case USER :
                    if(isset($rowprom['datepromoted'])){
                      echo '<th>Etais admin avant</th>';
                      echo '<td>' . date('d/m/Y à g:i', strtotime($rowprom['datepromoted'])) . '</td>';
                    }
                    else{
                      echo "<th colspan='2' class='text-center'>Utilisateur simple</th>";
                    }
                    break;
                  case USER_ADMIN :
                    echo '<th>Admin depuis</th>';
                    echo '<td>' . date('d/m/Y à g:i', strtotime($rowprom['datepromoted'])) . '</td>';
                    break;
                  case USER_SUPER :
                    echo "<th colspan='2' class='text-center'>Administrateur principal</th>";
                    break;
                }
              ?>
              <!--<th><?= ''//($rowuser['role']  USER_ADMIN ? "N'est plus admin depuis" : 'Admin depuis') ?></th>
              <td><?= ''//date('d/m/Y à g:i', strtotime($rowuser['datepromoted'])) ?? 'Toujours' ?></td>-->
            </tr>
            <tr>
              <th>Articles publiés</th>
              <td><?= $rowuser['total_articles'] ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="recent-activities">
        <h4> <i class="fa fa-clock"></i> Activités récentes</h4>
        <div class='activities'>
          <?php
            $resultarticles = $db->query("SELECT articles.id, articles.dateposted, articles.author_id, categories.name AS cat_name FROM articles INNER JOIN categories ON articles.cat_id = categories.id WHERE articles.author_id = " . $id);
            if($resultarticles->num_rows === 0){
              echo "<div>Aucune activité récente" . ($id == $_SESSION['USER_ID'] ? ', allez à la chasse car "qui dors dîne"' : '') . " !</div>";
            }
            else{
              while($rowarticle = $resultarticles->fetch_array(MYSQLI_ASSOC)){
                  echo  "<div>Le " . date('d M', strtotime($rowarticle['dateposted'])) . ', ' . ($rowarticle['author_id'] == $_SESSION['USER_ID'] ? 'vous avez ' : "a ") . "posté un <strong><a class='article-link' href='article.php?id=" . $rowarticle['id'] . "'>article</a></strong> sur le topic <strong>" . $rowarticle['cat_name'] . "</strong>.</div>";
              }
            }
          ?>
        </div>
    </div>

  </div>
  <div class="users col-lg-5 p-lg-5">
    <h4 class='text-center'>Liste des utilisateurs</h4>
    <div class="table-wrapper shadow">
      
    <?php
      $resultusers = $db->query("SELECT users.id, name, email, users.role, MAX(datepromoted) AS last_prom FROM users LEFT JOIN promotions ON users.id = promotions.promotee_id GROUP BY users.id ORDER BY role DESC, last_prom IS NULL, name;");
      if($resultusers->num_rows === 0){
        echo "<p>Aucun utilisateur</p>";
      }
      else{
        $admin_to_user = '<i class="fa fa-arrow-down"></i>';
        $user_to_admin = '<i class="fa fa-arrow-up"></i>';

        echo "<table class='table table-borderless table-hover'><thead><tr class='table-dark'><th>Nom complet</th><th>Actions</th></tr></thead><tbody>";
        while($rowuser = $resultusers->fetch_array(MYSQLI_ASSOC)){
          $rowcssclass='';
          if($rowuser['role'] >= USER_ADMIN){
            $rowcssclass = 'table-secondary';
          }
          if($id == $rowuser['id']){
            $rowcssclass = 'table-primary';
          }
          echo '<tr class="' . $rowcssclass . '">';
            $usermark = '';
            if($rowuser['role'] >= USER_ADMIN){
              $usermark = "<i class='fa fa-shield'></i> ";
            }
            if($_SESSION['USER_ID'] == $rowuser['id']){
              echo '<td colspan="2" class="user-link">' . $usermark . '<a href="viewusers.php">Vous</a></td>';
            }
            else{
              echo '<td class="user-link">' . $usermark . '<a href="viewusers.php?id=' . $rowuser['id'] . '">' . $rowuser['name']. '</a></td>';
              echo '<td class="btn-action"><div>';
                echo '<a href="#"><i class="fa fa-send"></i></a>';
                if($rowuser['role'] != USER_SUPER){
                  echo '<a href="promoteuser.php?id=' . $rowuser['id'] . '">' . ($rowuser['role'] == USER ? $user_to_admin : $admin_to_user) . '</a>';
                }
              echo '</div></td>';
            }
          echo '</tr>';
        }  
        echo '<tbody></table>';
      }
    ?>
    </div>
  </div>
</div>


<?php require_once "includes/footer.php" ?>