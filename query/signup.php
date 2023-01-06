<?php
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
    if (strlen($password) >= 8 && $has_uppercase && $has_digit && $has_special_char && ($password === $passwordConfirm)) {
        
        // Envoi de la requête
        $sql = "INSERT INTO `utilisateur`(`identifiant`, `mot_de_passe`) 
                VALUES ('$username', '$password')";

        $insert = $con -> query($sql) or die ($con -> error);
        $valider = true;

        if ($valider === true) {
                echo "<script> alert('Nouveau compte créé ! Veuillez vous connecter à l'aide de vos identifiants'); </script>";
        }
        else {   
            echo "<script> alert('Error: je sais pas '); </script>";
        }
    }    
}

?>