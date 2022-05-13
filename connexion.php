<?php 
session_start();
require_once "config.php";
require_once 'functions.php';

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
        $path = with_get($_SERVER['SCRIPT_NAME']);

        if(count($_GET) === 0){
            $path .= '?error=nomatch';
        }
        else{
            $path .= '&error=nomatch';
        }
        header("Location:" . $path);
    }
    else{
        // définir les variables de session
        $rowuser = $resultuser->fetch_array(MYSQLI_ASSOC);

        $_SESSION['USER_ID'] = $rowuser['id'];
        $_SESSION['USER_NAME'] = $rowuser['name'];
        $_SESSION['USER_USERNAME'] = $rowuser['username'];
        $_SESSION['USER_EMAIL'] = $rowuser['email'];
        $_SESSION['USER_ROLE'] = (int)$rowuser['role'];

        // rédiriger vers la page d'acceuil
        if(isset($_GET['ref'])){
            switch($_GET['ref']){
                case 'article' :
                    $id = (isset($_GET['id']) ? (int)$_GET['id'] : 0) ;
                    header("Location:article.php?id=" . $id . "#comments");
                    break;
                default :
                    header("Location:index.php");
                    break;
            }
        }
        else{
            header("Location:index.php");
        }
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
    <form action="<?=with_get($_SERVER['SCRIPT_NAME']) ?>" method="post" class="form">
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