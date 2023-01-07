<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$servername = "mysql-networkpark.alwaysdata.net";
$username = "291361";
$password = "coucou18?";
$database = "networkpark_bd";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_errno) {
    printf("Failed to connect to database");
    exit();
}
//Fetch 3 rows from actor table
$result = $conn->query("SELECT * FROM utilisateur WHERE id=28");

//Initialize array variable
$dbdata = array();

//Fetch into associative array
while ( $row = $result->fetch_assoc())  {
    $dbdata[]=$row;
}

//Print array in JSON format
echo json_encode($dbdata);
?>
