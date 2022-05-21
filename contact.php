<?php 
session_start();

$fichier_style = "css/contact.css";
require "includes/header.php" ; ?>

<div class="container">
    <div class="main row">
        <h1>Nous contacter</h1>
        <div class="col-lg-6 ">
            <table class="table">
                <tr>
                    <td>Adresse</td>
                    <td>Guinée, Mamou, Télico</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>hammoolaba@email.com</td>
                </tr>
                <tr>
                    <td>Téléphone</td>
                    <td>+224 621 000 000</td>
                </tr>
            </table>
            <h1>Suivez-nous</h1>
            <div class="lien-externes">
                <a href="http://www.facebook.com" target="blank"><i class="fa fa-facebook"></i></a>
                <a href="http://www.twitter.com" target="blank"><i class="fa fa-twitter"></i></a>
                <a href="http://instagram.com" target="blank"><i class="fa fa-instagram"></i></a>
                <a href="http://linkedin.com" target="blank"><i class="fa fa-linkedin"></i></a>
                <a href="http://google.com" target="blank"><i class="fa fa-google"></i></a>
            </div>
        </div>
        <div class="col-lg-6">
            <form action="" method="post" class="form">
                <input class="form-control" type="text" name="nom" required="required" id="nom" autofocus="autofocus" placeholder="Entrez votre nom complet" value="<?= $_SESSION['USER_NAME'] ?? '' ?>">
                <input class="form-control" type="email" name="email" required="required" id="email" placeholder="Entrez votre adresse email" value="<?= $_SESSION['USER_EMAIL'] ?? '' ?>">
                <textarea class="form-control" name="message" cols="30" rows="5" required="required" placeholder="Entrez votre message"></textarea>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require "includes/footer.php" ; ?>