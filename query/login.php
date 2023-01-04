<?php
session_start();

include "../connection/connection.php";
$con = connect();

// Si clic sur le bouton se connecter
if (isset($_POST["login"])) {
    
    // On récupère l'identifiant et le mot de passe de l'utilisateur
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Envoi de la requête
    $sql = " SELECT * FROM `utilisateur` WHERE identifiant = '$username' AND mot_de_passe = '$password' ";

    $user = $con -> query($sql);

    // Si l'utilisateur existe
    if ($user -> num_rows > 0) {
        while($rows = $user -> fetch_assoc()) {
            echo "<script> alert('Welcome" . " " . $username . "'); </script>";
        }
    }
    else {
        echo "<script> alert('No record'); </script>";
    } 
        
}
?>
