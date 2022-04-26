<?php
require "config.php";

// process form
if(isset($_POST['submit'])){
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
      
      $stmt = $db->prepare("INSERT INTO articles(title, dateposted, body, imgpath, cat_id) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param('ssssi', $title, $dateposted, $body, $imgpath, $category);
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

  // si on soumet une image
  // si l'image est valide
  // l'afficher
  // sinon afficher un message d'erreur
?>
<h1 class="text-center">Nouveau article</h1>

<form action="" class="form" enctype="multipart/form-data" method="post">
  <div class="image-article     d-flex flex-column justify-content-center align-items-center">
    <i class="fa fa-image fa-5x"></i>
    (Aucune photo)
    <!--<img src="images/articles/macaw-6488488__340.webp" width="200" alt="">-->
  </div>
  <div class="form-group">
    <label for="title">Titre</label>
    <input type="text" class="form-control" id="title" name="title" >
  </div>
  <div class="d-flex">
    <div class="flex-fill form-group">
      <label for="category"><i class="fa fa-bars"></i> Categorie</label>
      <select name="category" id="category" class="form-select">
        <?php 
          $db = new mysqli($hname, $uname, $pword, $dbase);
          $resultcat = $db->query("SELECT * FROM categories ORDER BY name");
  
          while($rowcat = $resultcat->fetch_array(MYSQLI_ASSOC)){
            echo "<option value='" . $rowcat['id'] . "'>" . $rowcat['name'] . "</option>";
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
    <textarea name="body" id="body" cols="30" rows="10" class="form-control"></textarea>
  </div>
  <div class="form-group d-flex justify-content-center">
    <button type="submit" class="btn btn-success" name="submit">Publier</button>
  </div>
</form>

<?php
  require "includes/footer.php";
}
?>