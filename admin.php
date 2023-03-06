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
    <header>

        <div>
            <a href="index.php">
                <button class="boutonRetour" onclick="connexionPage()">
                    Retour 
                </button>
            </a>
        </div>
        
    </header>
    <section>
    <h1>
        Administrateur
    </h1>
    <h2>
        Informations
    </h2>
    <p>
        Pour modifier les questions et réponses il suffit de mettre l'id correspondant à la question dans la première case
        puis remplir les autres case comme vous le souhaitez.
    </p>

<?php
    include_once "connection/AccesDonnees.php";

    $db = new AccesDonnees();

    // Préparez la requête et envoyez la requête
    $query = "SELECT * FROM question, reponse WHERE question.id_question = reponse.question_id";
    $result = $db->run($query);


    // Affichez le résultat
    echo "<table>";
    echo "<tr><th>Identifiant</th><th>Tuple question</th><th>Indice</th><th>Bonne réponse</th><th>Mauvaise réponse 1</th><th>Mauvaise réponse 2</th><th>Mauvaise réponse 3</th></tr>";
    for ($i = 0; $i < count($result); $i++) {
        echo "<tr>";
        echo "<td>" . $result[$i]['id_question'] . "</td>";
        echo "<td>" . $result[$i]['tupleQuestion'] . "</td>";
        echo "<td>" . $result[$i]['indice'] . "</td>";
        echo "<td>" . $result[$i]['bonneReponse'] . "</td>";
        echo "<td>" . $result[$i]['mauvaiseReponse'] . "</td>";
        echo "<td>" . $result[$i]['mauvaiseReponse2'] . "</td>";
        echo "<td>" . $result[$i]['mauvaiseReponse3'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

?>
    </section>
    <section>
        <form action="admin.php" method="post">
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
            <div class="affichage">
                <button class="boutonValider" value="valider" name="valider">Valider</button>
            </div>
        </form>
    </section>

<?php
    if (isset($_POST["valider"])) {


        $identifiant = $_POST["identifiant"];
        $question = $_POST["question"];
        $indice = $_POST["indice"];
        $bonneReponse = $_POST["bonneReponse"];
        $mauvaiseReponse = $_POST["mauvaiseReponse"];
        $mauvaiseReponse2 = $_POST["mauvaiseReponse2"];
        $mauvaiseReponse3 = $_POST["mauvaiseReponse3"];


        // Préparation de la requête de mise à jour de la table "question"
        $query1 = "UPDATE `question` SET `tupleQuestion` = '$question', `indice` = '$indice' WHERE `id_question` = '$identifiant'";
        
        $updateQuestion = $db -> runInsert($query1);

        // Préparation de la requête de mise à jour de la table "reponse"
        $query2 = "UPDATE `reponse` SET `bonneReponse` = '$bonneReponse', `mauvaiseReponse` = '$mauvaiseReponse', `mauvaiseReponse2` = '$mauvaiseReponse2', 
        `mauvaiseReponse3` = '$mauvaiseReponse3' WHERE `question_id` = '$identifiant'";

        $updtateReponse = $db -> runInsert($query2);
    }

?>


</body>
</html>