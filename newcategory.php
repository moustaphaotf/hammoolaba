<?php 

if(!empty($_POST['name'])){
  $name = htmlentities($_POST['name']);
  $colortheme = htmlentities($_POST['color']);

  //die(print_r($_POST));

  require 'config.php';
  $db = new mysqli($hname, $uname, $pword, $dbase);

  $stmt = $db->prepare("SELECT * FROM categories WHERE name = ? LIMIT 1");
  $stmt->bind_param('s', $name);
  $stmt->execute();
  $resultcat = $stmt->get_result();
  $stmt->close();
  $status = false;
  if($resultcat->num_rows === 0){
    $stmt = $db->prepare("INSERT INTO categories(name, colortheme) VALUES (?, ?)");
    $stmt->bind_param('ss', $name, $colortheme);
    $stmt->execute();

    $status = true;
  }  
}

$fichier_style = 'css/newcategory.css';
require "includes/header.php";
?>

<?php if (isset($status) && $status === true) :?>
  <div class="alert alert-dismissible alert-success fade show <?=isset($exists) ?? 'd-none'?>">
    <a class="btn-close" type='button' data-bs-dismiss='alert' aria-label="Close"></a>
    <i class="fa fa-check-circle fa-2x"></i>
    La catégorie a été ajoutée avec succès
  </div>
<?php elseif(isset($status) && $status === false) : ?>
  <div class="alert alert-dismissible alert-warning fade show">
    <a class="btn-close" type='button' data-bs-dismiss='alert' aria-label="Close"></a>
    <i class="fa fa-check-circle fa-2x"></i>
    La catégorie existe déjà !
  </div>
<?php endif ?>


<h1 class="text-center">Nouvelle catégorie</h1>
<div class="d-flex flex-column align-items-center mt-4">
  <div class="category-explanation d-flex flex-column align-items-center text-center">Nos informations sont catégorisées, ceci permet de faciliter la navigation des utilisateurs.<br>
  Comment ça marche ?<br>
  Si un utilisateur est intéressé sur un topic<br>
  <div class="topics">
    <span class="badge">Culture</span>
    <span class="badge">Technologies</span>
    <span class="badge">Buzz</span>
    <span class="badge">People</span>
    <span class="badge">...</span>
  </div>
  Il n'aura qu'à choisir cette catégories et des articles liés à cette dernière lui seront proposées
</div>
</div>
<form action="" method='post' class="form mt-3">
  <div class="row">
    <div class="col-sm-6 offset-sm-3 p-3">
      <div>
        <input type="text" name='name' id='name' class='form-control text-center' placeholder="Nouvelle catégorie ...">
      </div>
      <div class='my-2 d-flex justify-content-center'>
        <div class="d-flex align-items-center shadow p-1" data-bs-toggle='tooltip' data-bs-placement='right' title="Choisir une couleur de thème">
          <label for="color" >
            <i class="fa fa-pen-fancy pe-3"></i>
          </label>
          <input type="color" id="color" name="color" class="form-control-color" value='#fabe3C'>
        </div>
      </div>
      <div class="d-flex justify-content-center">
        <button class='btn btn-success'>Ajouter</button>
      </div>
    </div>
  </div>
    
</form>
<?php  require "includes/footer.php"; ?>