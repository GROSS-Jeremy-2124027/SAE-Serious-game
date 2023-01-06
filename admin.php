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

    <?php
        
        // Connexion à la base de données
        $servername = "mysql-networkpark.alwaysdata.net";
        $username = "291361";
        $password = "coucou18?";
        $database = "networkpark_bd";

        $db = new mysqli($servername, $username, $password, $database);


        // Checker les erreurs
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }

        // Envoi de la requête
        $query = "SELECT tupleQuestion, indice, bonneReponse, mauvaiseReponse, mauvaiseReponse2, mauvaiseReponse3, mauvaiseReponse4
        FROM question, reponse WHERE question.question_id = reponse.question_id";
        $result = $db->query($query);

        while ($row = $result->fetch_assoc()) {
    ?>

    <section>

        <h2>
            Chapitre 1 : Généralités
        </h2>
        <article>
            <div class="affichage">
                <h3>
                    Question 1 
                </h3>
                <h3>
                    Bonne réponse (1)
                </h3>
                <h3>
                    Réponses possibles (3)
                </h3>
                <h3>
                    Indice
                </h3>
            </div>
            <div class="inputs">
                <input type="text" name="chap1Question1" id="">
                <input type="text" name="chap1BonneReponse1" id="">
                <input type="text" name="chap1AutreReponse1" id="">
                <input type="text" name="chap1Indice1" id="">
            </div>
        </article>
        <article>
            <div class="affichage">
                <h3>
                    Question 2 
                </h3>
                <h3>
                    Bonne réponse (1)
                </h3>
                <h3>
                    Réponses possible (3)
                </h3>
                <h3>
                    Indice
                </h3>
            </div>
            <div class="inputs">
                <input type="text" name="chap1Question2" id="">
                <input type="text" name="chap1BonneReponse2" id="">
                <input type="text" name="chap1AutreReponse2" id="">
                <input type="text" name="chap1Indice2" id="">
            </div>
        </article>
        <article>
            <div class="affichage">
                <h3>
                    Question 3 
                </h3>
                <h3>
                    Bonne réponse (1)
                </h3>
                <h3>
                    Réponses possible (3)
                </h3>
                <h3>
                    Indice
                </h3>
            </div>
            <div class="inputs">
                <input type="text" name="chap1Question3" id="">
                <input type="text" name="chap1BonneReponse3" id="">
                <input type="text" name="chap1AutreReponse3" id="">
                <input type="text" name="chap1Indice3" id="">
            </div>
        </article>
        <article>
            <div class="affichage">
                <h3>
                    Question 4 
                </h3>
                <h3>
                    Bonne réponse (1)
                </h3>
                <h3>
                    Réponses possible (3)
                </h3>
                <h3>
                    Indice
                </h3>
            </div>
            <div class="inputs">
                <input type="text" name="chap1Question4" id="">
                <input type="text" name="chap1BonneReponse4" id="">
                <input type="text" name="chap1AutreReponse4" id="">
                <input type="text" name="chap1Indice4" id="">
            </div>
        </article>

    </section>
    <section>

        <h2>
            Chapitre 2 : Modèles OSI et TCP/IP
        </h2>
        <article>
            <div class="affichage">
                <h3>
                    Question 1 
                </h3>
                <h3>
                    Bonne réponse (1)
                </h3>
                <h3>
                    Réponses possibles (3)
                </h3>
                <h3>
                    Indice
                </h3>
            </div>
            <div class="inputs">
                <input type="text" name="chap2Question1" id="">
                <input type="text" name="chap2BonneReponse1" id="">
                <input type="text" name="chap2AutreReponse1" id="">
                <input type="text" name="chap2Indice1" id="">
            </div>
        </article>
        <article>
            <div class="affichage">
                <h3>
                    Question 2 
                </h3>
                <h3>
                    Bonne réponse (1)
                </h3>
                <h3>
                    Réponses possible (3)
                </h3>
                <h3>
                    Indice
                </h3>
            </div>
            <div class="inputs">
                <input type="text" name="chap2Question2" id="">
                <input type="text" name="chap2BonneReponse2" id="">
                <input type="text" name="chap2AutreReponse2" id="">
                <input type="text" name="chap2Indice2" id="">
            </div>
        </article>
        <article>
            <div class="affichage">
                <h3>
                    Question 3 
                </h3>
                <h3>
                    Bonne réponse (1)
                </h3>
                <h3>
                    Réponses possible (3)
                </h3>
                <h3>
                    Indice
                </h3>
            </div>
            <div class="inputs">
                <input type="text" name="chap2Question3" id="">
                <input type="text" name="chap2BonneReponse3" id="">
                <input type="text" name="chap2AutreReponse3" id="">
                <input type="text" name="chap2Indice3" id="">
            </div>
        </article>
        <article>
            <div class="affichage">
                <h3>
                    Question 4 
                </h3>
                <h3>
                    Bonne réponse (1)
                </h3>
                <h3>
                    Réponses possible (3)
                </h3>
                <h3>
                    Indice
                </h3>
            </div>
            <div class="inputs">
                <input type="text" name="chap2Question4" id="">
                <input type="text" name="chap2BonneReponse4" id="">
                <input type="text" name="chap2AutreReponse4" id="">
                <input type="text" name="chap2Indice4" id="">
            </div>
        </article>

    </section>
    <section>

        <h2>
            Chapitre 3 : Adressage IP
        </h2>
        <article>
            <div class="affichage">
                <h3>
                    <?php
                        echo $row['identifiant'] . " : " . $row['meilleurScore'] . "<br>";
                    ?>
                </h3>
                <h3>
                    Bonne réponse (1)
                </h3>
                <h3>
                    Réponses possibles (3)
                </h3>
                <h3>
                    Indice
                </h3>
            </div>

            <div class="inputs">
                <input type="text" name="chap3Question1" id="">
                <input type="text" name="chap3BonneReponse1" id="">
                <input type="text" name="chap3AutreReponse1" id="">
                <input type="text" name="chap3Indice1" id="">
            </div>
        </article>
        <article>
            <div class="affichage">
                <h3>
                    Question 2 
                </h3>
                <h3>
                    Bonne réponse (1)
                </h3>
                <h3>
                    Réponses possible (3)
                </h3>
                <h3>
                    Indice
                </h3>
            </div>
            <div class="inputs">
                <input type="text" name="chap3Question2" id="">
                <input type="text" name="chap3BonneReponse2" id="">
                <input type="text" name="chap3AutreReponse2" id="">
                <input type="text" name="chap3Indice2" id="">
            </div>
        </article>
        <article>
            <div class="affichage">
                <h3>
                    Question 3 
                </h3>
                <h3>
                    Bonne réponse (1)
                </h3>
                <h3>
                    Réponses possible (3)
                </h3>
                <h3>
                    Indice
                </h3>
            </div>
            <div class="inputs">
                <input type="text" name="chap3Question3" id="">
                <input type="text" name="chap3BonneReponse3" id="">
                <input type="text" name="chap3AutreReponse3" id="">
                <input type="text" name="chap3Indice3" id="">
            </div>
        </article>
        <article>
            <div class="affichage">
                <h3>
                    Question 4 
                </h3>
                <h3>
                    Bonne réponse (1)
                </h3>
                <h3>
                    Réponses possible (3)
                </h3>
                <h3>
                    Indice
                </h3>
            </div>
            <div class="inputs">
                <input type="text" name="chap3Question4" id="">
                <input type="text" name="chap3BonneReponse4" id="">
                <input type="text" name="chap3AutreReponse4" id="">
                <input type="text" name="chap3Indice4" id="">
            </div>
        </article>

    </section>
    <section>

        <h2>
            Chapitre 4 : Ethernet
        </h2>
        <article>
            <div class="affichage">
                <h3>
                    Question 1 
                </h3>
                <h3>
                    Bonne réponse (1)
                </h3>
                <h3>
                    Réponses possibles (3)
                </h3>
                <h3>
                    Indice
                </h3>
            </div>
            <div class="inputs">
                <input type="text" name="chap4Question1" id="">
                <input type="text" name="chap4BonneReponse1" id="">
                <input type="text" name="chap4AutreReponse1" id="">
                <input type="text" name="chap4Indice1" id="">
            </div>
        </article>
        <article>
            <div class="affichage">
                <h3>
                    Question 2 
                </h3>
                <h3>
                    Bonne réponse (1)
                </h3>
                <h3>
                    Réponses possible (3)
                </h3>
                <h3>
                    Indice
                </h3>
            </div>
            <div class="inputs">
                <input type="text" name="chap4Question2" id="">
                <input type="text" name="chap4BonneReponse2" id="">
                <input type="text" name="chap4AutreReponse2" id="">
                <input type="text" name="chap4Indice2" id="">
            </div>
        </article>
        <article>
            <div class="affichage">
                <h3>
                    Question 3 
                </h3>
                <h3>
                    Bonne réponse (1)
                </h3>
                <h3>
                    Réponses possible (3)
                </h3>
                <h3>
                    Indice
                </h3>
            </div>
            <div class="inputs">
                <input type="text" name="chap4Question3" id="">
                <input type="text" name="chap4BonneReponse3" id="">
                <input type="text" name="chap4AutreReponse3" id="">
                <input type="text" name="chap4Indice3" id="">
            </div>
        </article>
        <article>
            <div class="affichage">
                <h3>
                    Question 4 
                </h3>
                <h3>
                    Bonne réponse (1)
                </h3>
                <h3>
                    Réponses possible (3)
                </h3>
                <h3>
                    Indice
                </h3>
            </div>
            <div class="inputs">
                <input type="text" name="chap4Question4" id="">
                <input type="text" name="chap4BonneReponse4" id="">
                <input type="text" name="chap4AutreReponse4" id="">
                <input type="text" name="chap4Indice4" id="">
            </div>
            <?php
                }

                // Fermer la connection
                $db->close();

            ?>
        </article>

    </section>
    <script src="script.js"></script>
</body>
</html>