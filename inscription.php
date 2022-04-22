<?php 
$fichier_style="css/inscription.css";
require "includes/header.php" ; ?>
<div class="main d-flex flex-column align-items-center">
    <h2>Inscription</h2>
    <form action="" method="post" class="form">
        <div class="input-group">
            <input placeholder="Nom d'utilisateur" type="text" id="username" name="username" required class="form-control">
        </div>
        <div class="input-group password">
            <input placeholder="Mot de passe" type="password" id="password1" name="password1" required class="form-control">
        </div>
        <div class="input-group password">
            <input placeholder="Confirmer le mot de passe" type="password" id="password2" name="password2" required class="form-control">
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <input type="checkbox" name="agree" required class="form-check-input"> &nbsp;
            J'accepte les <a href="conditions.php" target="_blank">conditions d'utilisation</a>.
        </div>
        <div class="btn-group d-flex justify-content-around">
            <a href="connexion.php" type="button" class="btn btn-primary btn-lg">Se connecter</a>
            <button type="submit" class="btn btn-primary btn-lg">S'inscrire</button>
        </div>
    </form>
</div>
<?php require "includes/footer.php" ; ?>