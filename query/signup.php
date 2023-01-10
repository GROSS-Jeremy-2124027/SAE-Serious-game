<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../connection/connection.php";
$con = connect();

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

    $isHere = true;


    if ($username === "SELECT identifiant FROM `utilisateur` WHERE identifiant = '$username'") {
        echo "<script> alert('nom d\'utilisateur déjà utilisé'); </script>";
    }

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
        $sql = "INSERT INTO `utilisateur`(`identifiant`, `mot_de_passe`) 
                VALUES ('$username', '$hash')";

        $verification = "SELECT identifiant FROM `utilisateur` WHERE identifiant = '".$_POST["username"]."' ";
        $user = $con -> query($verification);

        if($user -> num_rows < 1){
            $insert = $con -> query($sql) or die ($con -> error);
        }
        else {
            echo "<script> alert('Pseudo déjà existant'); </script>";
        }




        if ($insert) {
            //echo "<script> alert('Nouveau compte créé ! Veuillez vous connecter à l\'aide de vos identifiants'); </script>";
            echo "SELECT identifiant FROM `utilisateur` WHERE identifiant = '$username'";
        }
        else {
            echo "<script> alert('Error: '); </script>";
        }
    }
}

?>