<?php
require "config.php";
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}


if(!isset($_SESSION['USER_ID'])){
  header("Location:connexion.php");
}
else if($_SESSION['USER_ROLE'] < USER_ADMIN){
  header("Location:index.php");
}

// choisir le bon fichier de processing
if(!isset($editmode)){
  $actionpage = 'newarticle.php';
  $editmode = false;
}

// process form
// rajouter la clause pour empêcher le processing du form par cette page
if($actionpage === 'newarticle.php' && isset($_POST['submit'])){
  $title = htmlentities($_POST['title']);
  $category = (int) $_POST['category'];
  $body = htmlentities($_POST['body']);
  $image = $_FILES['photo'];
  
  if($title === ""){
    header("Location:newarticle.php?error=notitle");
  }
  else if($image['name'] === '' ||
          $image['type'] !== 'image/webp' &&
          $image['type'] !== 'image/png' &&
          $image['type'] !== 'image/jpg' &&
          $image['type'] !== 'image/jpeg')
    header('Location:newarticle.php?error=imageinvalid');
  else if($body === "")
    header("Location:newarticle.php?error=nocontent");
  else{
    $db = new mysqli($hname, $uname, $pword, $dbase);
    $catres = $db->query("SELECT * FROM categories WHERE id=" . $category);
    if($catres->num_rows !== 1)
    header("Location:newarticle.php?error=nocategory");
    else{
      
      // ajouter l'article
      $now = time();
      $imgpath = sprintf("%d.%s", $now, pathinfo($image['name'])['extension']);
      $dateposted = date('Y-m-d H:i:s', $now);

      $author_id = $_SESSION['USER_ID'];
      
      $stmt = $db->prepare("INSERT INTO articles(title, dateposted, body, imgpath, cat_id, author_id) VALUES (?, ?, ?, ?, ?, ?)");
      $stmt->bind_param('ssssii', $title, $dateposted, $body, $imgpath, $category, $author_id);
      $stmt->execute();
      
      // déplacer l'image
      move_uploaded_file($image['tmp_name'], $config_imgarticle_folder . '/' . $imgpath);

      // rediriger vers l'article en question !
      header("Location:article.php?id=" . $stmt->insert_id);
      echo "<pre>";
      //var_dump(compact('title', 'category', 'body'));
      echo "</pre>";
    }

  }

  
}
else{
  $fichier_style="css/newarticle.css";

  require "includes/header.php";
?>

<!-- Alerter l'utilisateur -->
<?php 
  if(isset($_GET['error']) && $_GET['error']){
    $alerttype = "alert-warning";
    $errorvalid = true;
    switch($_GET['error']){
      case 'notitle' :
        $msg = "Vous devez saisir un titre pour cet article !";
        break;
      case 'nocontent' :
        $msg = "Saisissez du contenu pour l'article !";
        break;
      case 'imageinvalid' :
        $msg = "Le fichier image est invalide !";
        break;
      case "nocategory" :
        $msg = "La catégorie reférencée n'existe pas !";
        break;
      default :
        $errorvalid = false;
    }

    if($errorvalid){
      echo '<div class="alert alert-dismissible alert-success ' . $alerttype . '">';
        echo '<p class="content m-0">' . $msg . '</p>';
        echo '<a class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></a>';
      echo '</div>';
    }
  }
?>

<h1 class="text-center"><?= ($editmode === true) ? "Modification d'un article" : "Nouveau article" ?></h1>

<form action="<?= $actionpage ?>" class="form" enctype="multipart/form-data" method="post" id="<?= ($editmode === true ? 'editarticle' : 'createarticle') ?>">
  <?= (isset($article_to_edit) ? '<input type="hidden" name="article_id" value="' . $article_to_edit['id'] . '" >' : '') ?>
  <div class="image-article     d-flex flex-column justify-content-center align-items-center">
    <?php
      if(isset($article_to_edit)){
        echo '<img src="' . $config_imgarticle_folder . '/' .  $article_to_edit['imgpath'] . '" width="150" alt="' . $article_to_edit['title'] . '">';
        echo "<p style='margin : 10px 0 0; font-size : 0.8em; color:#faa10e'>";        
          printf("Auteur : <span style='font-style:italic;'><strong>%s</strong> (%s)</span", ($_SESSION['USER_ID'] == $article_to_edit['author_id'] ? 'Vous' : $article_to_edit['author_name']), $article_to_edit['author_email']);
        echo "</p>";
      }
      else{
        echo '<i class="fa fa-image fa-5x"></i>';
        echo '(Aucune photo)';
      }
    ?>
  </div>
  <div class="form-group">
    <label for="title">Titre</label>
    <input type="text" class="form-control" id="title" name="title" value="<?= $article_to_edit['title'] ?? '' ?>">
  </div>
  <div class="d-flex">
    <div class="flex-fill form-group">
      <label for="category"><i class="fa fa-bars"></i> Categorie</label>
      <select name="category" id="category" class="form-select">
        <?php 
          $db = new mysqli($hname, $uname, $pword, $dbase);
          $resultcat = $db->query("SELECT * FROM categories ORDER BY name");
  
          while($rowcat = $resultcat->fetch_array(MYSQLI_ASSOC)){
            printf("<option value='%d' %s>%s</option>", $rowcat['id'], (isset($article_to_edit) && $article_to_edit['cat_id'] == $rowcat['id'] ? 'selected="selected"' : ''), $rowcat['name']);
          }
          ?>
      </select>
    </div>
    <div class="flex-fill is-valid form-group">
      <label for="photo"><i class="fa fa-photo"></i> Image (.jpg, .png, .webp)</label>
      <input type="file" id="photo" name="photo" class="form-control">
    </div>

  </div>
  <div class="form-group">
    <label for="body"><i class="fa fa-message"></i> Contenu</label>
    <textarea name="body" id="body" cols="30" rows="10" class="form-control"><?= $article_to_edit['body'] ?? '' ?></textarea>
  </div>
  <div class="form-group d-flex justify-content-center">
    <button type="submit" class="btn btn-success" name="submit"><?= ($editmode === true ? 'Modifier' : 'Publier') ?></button>
  </div>
</form>

<?php
  require "includes/footer.php";
}
?>