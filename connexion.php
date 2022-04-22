<?php 
$fichier_style = "css/connexion.css";
require "includes/header.php" ; 
?>
<div class="main d-flex flex-column align-items-center">
    <h2>Connexion</h2>
    <form action="" method="post" class="form">
        <div class="input-group">
            <span class="input-group-text"><i class="fa fa-user"></i></span>
            <input placeholder="Nom d'utilisateur" type="text" id="username" name="username" required class="form-control">
        </div>
        <hr>
        <div class="input-group password">
            <span class="input-group-text"><i class="fa fa-key"></i></span>
            <input placeholder="Mot de passe" type="password" id="password" name="password" required class="form-control">
        </div>
        <div class="btn-group d-flex justify-content-around">
            <button type="submit" class="btn btn-primary btn-lg">Se connecter</button>
            <a href="inscription.php" type="button" class="btn btn-primary btn-lg">S'inscrire</a>
        </div>
    </form>
    <div>
        <a href="#">Mot de passe oublié ?</a>
    </div>
</div>

<?php require "includes/footer.php" ; ?>