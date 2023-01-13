<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "../connection/connection.php";
$con = connect();

function set_url()
{
    echo("<script> window.parent.location.href = '../admin.php' </script>");
}

// Si clic sur le bouton se connecter
if (isset($_POST["loginAdmin"])) {
    session_start();
    // On récupère l'identifiant et le mot de passe de l'utilisateur
    $_SESSION['username'] = $_POST["username"];
    $_SESSION['password'] = $_POST["password"];

    $mot_de_passe_hash = "SELECT mot_de_passe FROM `utilisateur` WHERE identifiant = '".$_SESSION["username"]."'";
    $string = $con ->query($mot_de_passe_hash) ->fetch_assoc();
    $sql = " SELECT * FROM `utilisateur` WHERE identifiant = '".$_SESSION["username"]."'";

    $user = $con -> query($sql);

    // Si l'utilisateur existe
    if ($user -> num_rows > 0) {
        while($rows = $user -> fetch_assoc()) {
            if (password_verify($_SESSION['password'], current($string))) {
                // Envoi de la requête
                echo "<script> alert('Vous êtes connecté" . " " . $_SESSION["username"] . "'); </script>";
                echo "<script>window.parent.document.getElementById('htmlpage').style.display = 'none';</script>";
                echo "<script type='text/javascript'>window.parent.document.getElementById('boutonAdministrateur').textContent = 'Se déconnecter';</script>";
            }
        }
    }
    else {
        echo "<script> alert('Identifiant invalide'); </script>";
        session_abort();
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
            <span class="title">Administrateur</span>

            <form action="loginAdmin.php" method="post">
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
                    <input type="submit" name="loginAdmin" value="Se connecter" onclick="connection()">
                </div>
            </form>
        </div>
    </div>
</div>

<script src="JS/connexion.js"></script>
<script src="JS/mainScript.js"></script>
</body>
</html>

