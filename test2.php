<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "connection/connection.php";
$con = connect();

$sql =" SELECT meilleurScore FROM `utilisateur` WHERE identifiant = '".$_SESSION["username"]."'";

$result = $con->query($sql);



//Fetch into associative array
while ( $row = $result->fetch_assoc())  {
    $dbdata=$row;
}


//Print array in JSON format

/* current() sert à avoir l'index actuel donc dans ce cas la derniere case de $dbdata car on l'a parcouru dans la boucle while
*  au-dessus, le reste sert à transformer la valeur de score de string a int
*/
echo json_encode((int) filter_var(current($dbdata), FILTER_SANITIZE_NUMBER_INT));
?>
    