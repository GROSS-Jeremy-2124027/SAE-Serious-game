<?php
session_start();

include "../connection/connection.php";
$con = connect();

if (isset($_POST["login"])) {
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $sql = " SELECT * FROM `utilisateur` WHERE identifiant = '$username' AND mot_de_passe = '$password' ";

    $user = $con -> query($sql);

    if ($user -> num_rows > 0) {
        while($rows = $user -> fetch_assoc()) {
            echo "Welcome" . " " . $username;
        }

?>

<?php

    }
    else {
        echo "<script> alert('No record'); </script>";
        // echo "<script> document.location=  '../index.html'; </script>";
    }
}
?>