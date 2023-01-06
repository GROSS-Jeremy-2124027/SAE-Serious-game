<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title> Network Park </title>
    <link rel="stylesheet" href="CSS/styleAdmin.css">
    <link rel="stylesheet" href="CSS/styleBack.css">
    <link rel="icon" href="img/controller.png">
    <script src="JS/script.js"></script>
</head>

<body>
    <div id='stars'></div>
    <div id='stars2'></div>
    <div id='stars3'></div>

<?php

    // Informations de connexion à la base de données
    define("DB_SERVERNAME", "mysql-networkpark.alwaysdata.net");
    define("DB_USERNAME", "291361");
    define("DB_PASSWORD", "coucou18?");
    define("DB_DATABASE", "networkpark_bd");

    // Connexion à la base de données
    $db = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

    // Vérifiez si la connexion a réussi
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Préparez la requête
    $query = "SELECT * FROM question, reponse WHERE question.id_question = reponse.question_id";
    $stmt = $db->prepare($query);

    // Exécutez la requête
    $stmt->execute();

    // Récupérez le résultat
    $result = $stmt->get_result();

    // Affichez le résultat
    echo "<table border='1'>";
    echo "<tr><th>Identifiant</th><th>Tuple question</th><th>Indice</th><th>Bonne réponse</th><th>Mauvaise réponse 1</th><th>Mauvaise réponse 2</th><th>Mauvaise réponse 3</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id_question'] . "</td>";
        echo "<td>" . $row['tupleQuestion'] . "</td>";
        echo "<td>" . $row['indice'] . "</td>";
        echo "<td>" . $row['bonneReponse'] . "</td>";
        echo "<td>" . $row['mauvaiseReponse'] . "</td>";
        echo "<td>" . $row['mauvaiseReponse2'] . "</td>";
        echo "<td>" . $row['mauvaiseReponse3'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

?>
<article>
    <div class="affichage">
        <h3>
            Identifiant
        </h3>
        <input type="text" name="identifiant" id="">
    </div>
    <div class="affichage">
        <h3>
            Question 
        </h3>
        <input type="text" name="question" id="">
    </div>
    <div class="affichage">
        <h3>
            Indice
        </h3>
        <input type="text" name="indice" id="">
    </div>
    <div class="affichage">
        <h3>
            Bonne réponse
        </h3>
        <input type="text" name="bonneReponse" id="">
    </div>
    <div class="affichage">
        <h3>
            Mauvaise Réponse 1
        </h3>
        <input type="text" name="mauvaiseReponse" id="">
    </div>
    <div class="affichage">
        <h3>
            Mauvaise Réponse 2
        </h3>
        <input type="text" name="mauvaiseReponse2" id="">
    </div>
    <div class="affichage">
        <h3>
            Mauvaise Réponse 3
        </h3>
        <input type="text" name="mauvaiseReponse3" id="">
    </div>
</article>


<?php

    // Fermez la connexion
    $db->close();

?>


</body>
</html>