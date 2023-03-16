<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include "AccesDonnees.php";
$con = new AccesDonnees();

// Si clic sur le bouton se connecter
if (isset($_POST["login"])) {
    session_start();
    // On récupère l'identifiant et le mot de passe de l'utilisateur
    $_SESSION['username'] = $_POST["username"];
    $_SESSION['password'] = $_POST["password"];

    $mot_de_passe_hash = "SELECT mot_de_passe FROM `utilisateur` WHERE identifiant = '".$_SESSION["username"]."'";
    $string = $con->run($mot_de_passe_hash);
    $sql = " SELECT * FROM `utilisateur` WHERE identifiant = '".$_SESSION["username"]."'";

    $user = $con->run($sql);



    $_SESSION['connecter'] = false;
    // Si l'utilisateur existe
    if (count($user) > 0) {
        if (password_verify($_SESSION['password'], $string[0]["mot_de_passe"])) {
            // Envoi de la requête
            echo "<script> alert('Vous êtes connecté" . " " . $_SESSION["username"] . "'); </script>";
            echo "<script>window.parent.document.getElementById('htmlpage').style.display = 'none';</script>";
            echo "<script type='text/javascript'>window.parent.document.getElementById('boutonconnexion').textContent = 'Se déconnecter';</script>";
            $_SESSION['connecter'] = true;
        }
    }
    else {
        echo "<script> alert('Identifiant invalide'); </script>";
    }

}
?>
