<?php 
$fichier_style="css/inscription.css";
require "includes/header.php" ; ?>
<div class="main d-flex flex-column align-items-center">
    <form action="" method="post" class="form">
        <h2 class="text-center">Inscription</h2>
        <div class="input-group">
            <input placeholder="Nom complet" type="text" id="name" name="name" required class="form-control">
        </div>
        <div class="input-group">
            <input placeholder="Nom d'utilisateur" type="text" id="username" name="username" required class="form-control">
        </div>
        <div class="input-group">
            <input placeholder="Adresse email" type="text" id="email" name="email" required class="form-control">
        </div>
        <div class="input-group password">
            <input placeholder="Mot de passe" type="password" id="password1" name="password1" required class="form-control">
        </div>
        <div class="input-group password">
            <input placeholder="Confirmer le mot de passe" type="password" id="password2" name="password2" required class="form-control">
        </div>
        <div class="d-flex justify-content-center align-items-center">
            <label>
                <input type="checkbox" name="agree" required class="form-check-input"> &nbsp;
                J'accepte les <a href="conditions.php" target="_blank">conditions d'utilisation</a>.
            </label>
        </div>
        <div class="btn-group d-flex justify-content-around">
            <a href="connexion.php" type="button" class="btn btn-primary btn-lg">Se connecter</a>
            <button type="submit" class="btn btn-primary btn-lg">S'inscrire</button>
        </div>
    </form>
</div>
<?php require "includes/footer.php" ; ?>