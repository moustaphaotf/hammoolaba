<?php
require "config.php";
if(isset($_POST['submit'])){
	$name = htmlentities($_POST['name']);
	$username = htmlentities($_POST['username']);
	$password1 = htmlentities($_POST['password1']);
	$password2 = htmlentities($_POST['password2']);
	$email = htmlentities($_POST['email']);

	if($username !== '' && $name !== '' && $password1 !== '' && $password2 !== "" && $email !== ""){
		$db = new mysqli($hname, $uname, $pword, $dbase);

		if($password1 === $password2){
			$stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
			$stmt->bind_param('s', $username);
			$stmt->execute();
			$resultuser = $stmt->get_result();

			if($resultuser->num_rows === 0){
				$stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
				$stmt->bind_param('s', $email);
				$stmt->execute();
				$resultuser = $stmt->get_result();

				if($resultuser->num_rows === 0){
					$stmt = $db->prepare("INSERT INTO users(name, username, password, email, role) VALUES(?, ?, ?, ?, ?)");
					$stmt->bind_param('sssss', $name, $username, $password1, $email, USER);
					$stmt->execute();
					
					
				}
			}

		}
	}	
	else{

	}
}
else{
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
            <button type="submit" class="register-user btn btn-primary btn-lg" name="submit" value="submit">S'inscrire</button>
        </div>
    </form>
</div>
<?php
    require "includes/footer.php" ;
} ?>