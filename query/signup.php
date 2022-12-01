<?php
include "../connection/connection.php";
$con = connect();

if (isset($_POST["signup"])) {
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $sql = "INSERT INTO `utilisateur`(`identifiant`, `mot_de_passe`) 
            VALUES ('$username', '$password')";

    $insert = $con -> query($sql) or die ($con -> error);

    if ($insert === TRUE) {
        echo "New record created successfully";
        // echo header("Location: ../index.html");
    }
    else {
        echo "Error: ";
    }
}

?>