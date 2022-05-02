<?php 
session_start();
require_once "config.php";
if(isset($_POST['submit'])){
    $username = htmlentities($_POST['username']);
    $password = htmlentities($_POST['password']);

    // lancer une requete de vérif
    $db = new mysqli($hname, $uname, $pword, $dbase);

    $stmt = $db->prepare("SELECT * FROM users WHERE username = ? AND BINARY password = ?");
    $stmt->bind_param('ss', $username, $password);
    $stmt->execute();

    $resultuser = $stmt->get_result();

    if($resultuser->num_rows === 0){
        header("Location:connexion.php?error=nomatch");
    }
    else{
        // définir les variables de session
        $rowuser = $resultuser->fetch_array(MYSQLI_ASSOC);

        $_SESSION['USER_ID'] = $rowuser['id'];
        $_SESSION['USER_NAME'] = $rowuser['name'];
        $_SESSION['USER_USERNAME'] = $rowuser['username'];
        $_SESSION['USER_EMAIL'] = $rowuser['email'];
        $_SESSION['USER_ROLE'] = $rowuser['role'];

        // rédiriger vers la page d'acceuil
        header("Location:index.php");
    }
}
$fichier_style = "css/connexion.css";
require "includes/header.php" ; 
?>
<div class="main d-flex flex-column align-items-center">
    <?php if(isset($_GET['error']) && $_GET['error'] === 'nomatch') :?>
        <div class="alert alert-warning">
            <p class="content m-0"><i class="fas fa-exclamation-triangle"></i> Erreur : <strong>username</strong> / <strong>password</strong> invalide !</p>
        </div>
    <?php endif ?>
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
            <button type="submit" class="btn btn-primary btn-lg" name="submit">Se connecter</button>
            <a href="inscription.php" type="button" class="btn btn-primary btn-lg">S'inscrire</a>
        </div>
    </form>
    <div>
        <a href="#">Mot de passe oublié ?</a>
    </div>
</div>

<?php require "includes/footer.php" ; ?>