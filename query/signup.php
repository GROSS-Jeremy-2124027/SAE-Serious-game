<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "../connection/AccesDonnees.php";
$con = new AccesDonnees();

// Si clic sur le bouton s'inscrire
if (isset($_POST["signup"])) {

    // On récupère l'identifiant et le mot de passe de l'utilisateur
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordConfirm = $_POST["confirmPassword"];

    // Vérification des critères du mot de passe
    $has_uppercase = false;
    $has_digit = false;
    $has_special_char = false;

    // On parcourt chaque caractère du mot de passe
    for ($i = 0; $i < strlen($password); $i++) {
        $char = $password[$i];

        if (ctype_upper($char)) {
            $has_uppercase = true;
        }

        if (ctype_digit($char)) {
            $has_digit = true;
        }

        if (!ctype_alnum($char)) {
            $has_special_char = true;
        }
    }

    // Affichage des erreurs si il manque un critère
    if (strlen($password) < 8) {
        echo "<script> alert('Le mot de passe doit comporter au moins 8 caractères'); </script>";
    }

    if (strlen($username) > 10) {
        echo "<script> alert('Le pseudo est trop long'); </script>";
    }

    if (!$has_uppercase) {
        echo "<script> alert('Le mot de passe doit comporter au moins une majuscule'); </script>";
    }

    if (!$has_digit) {
        echo "<script> alert('Le mot de passe doit comporter au moins un chiffre'); </script>";
    }

    if (!$has_special_char) {
        echo "<script> alert('Le mot de passe doit comporter au moins un caractère spécial'); </script>";
    }

    if ($password !== $passwordConfirm){
        echo "<script> alert('Les mots de passe ne correspondent pas'); </script>";
    }

    // Si tout les critères sont remplis
    if (strlen($password) >= 8 && strlen($username) <= 10 && $has_uppercase && $has_digit && $has_special_char && ($password === $passwordConfirm)) {
        
        $hash = password_hash($password, PASSWORD_BCRYPT);
        // Envoi de la requête

        $verification = "SELECT identifiant FROM `utilisateur` WHERE identifiant = '".$_POST["username"]."' ";
        $user = $con->run($verification);

        if(count($user) < 1){
            $sql = "INSERT INTO `utilisateur`(`identifiant`, `mot_de_passe`) 
                VALUES ('$username', '$hash')";
            $insert = $con->runInsert($sql);
            if ($insert) {
                echo "<script> alert('Nouveau compte créé ! Veuillez vous connecter à l\'aide de vos identifiants'); </script>";
                echo "<script>window.parent.document.getElementById('htmlpage').style.display = 'none';</script>";
            }
        }
        else {
            echo "<script> alert('Pseudo déjà existant'); </script>";
        }


    }
}

?>

<!DOCTYPE html>
<html lang="fr" id="connexion">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Network Park </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="../CSS/styleConnexion.css">
</head>
<body>
<div class="container">
    <div class="forms">
        <div class="form login" id="partie1">
            <span class="title">Connexion</span>

            <form action="login.php" method="post">
                <div class="input-field">
                    <input type="text" name="username" placeholder="Entrez votre nom" required>
                    <i class="uil uil-envelope icon"></i>
                </div>
                <div class="input-field">
                    <input type="password" name="password" class="password" placeholder="Entrez votre mot de passe" required>
                    <i class="uil uil-lock icon"></i>
                    <i class="uil uil-eye-slash showHidePw"></i>
                </div>
                <p id="erreurConnection"></p>
                <div class="input-field button">
                    <input type="submit" name="login" value="Se connecter" onclick="connection()">
                </div>
            </form>
            <div class="login-signup">
                    <span class="text">Pas de compte ?
                        <a href="#" class="text signup-link">Inscrivez-vous</a>
                    </span>
            </div>
        </div>

        <!-- Formulaire d'inscription -->
        <div class="form signup" id="partie2">
            <span class="title">Inscription</span>

            <form action="signup.php" method="post">
                <div class="input-field">
                    <input type="text" name="username" placeholder="Entrez votre nom" required>
                    <i class="uil uil-envelope icon"></i>
                </div>
                <div class="input-field">
                    <input type="password" name="password" class="password" id="createPassword" placeholder="Entrez votre mot de passe" required>
                    <i class="uil uil-lock icon"></i>
                    <i class="uil uil-eye-slash showHidePw"></i>
                </div>
                <div class="input-field">
                    <input type="password" name ="confirmPassword" class="password" id="confirmPassword" placeholder="Confirmez votre mot de passe" required>
                    <i class="uil uil-lock icon"></i>
                    <i class="uil uil-eye-slash showHidePw"></i>
                </div>
                <p id="erreur"></p>
                <div class="input-field button">
                    <input type="submit" name="signup" value="S'inscrire" onclick="signup()">
                </div>
            </form>

            <div class="login-signup">
                    <span class="text"> Vous avez déjà un compte?
                        <a href="#" class="text login-link"> Connectez-vous </a>
                    </span>
            </div>
        </div>
    </div>
</div>

<script src="../JS/connexion.js"></script>
<script src="../JS/mainScript.js"></script>
</body>
</html>
