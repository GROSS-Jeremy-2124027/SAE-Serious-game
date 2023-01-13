<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title> Network Park </title>
    <link rel="stylesheet" href="CSS/mainStyle.css">
    <link rel="stylesheet" href="CSS/styleBack.css">
    <link rel="icon" href="img/controller.png">
    <script src="JS/mainScript.js"></script>
</head>
<body>
    <div id='etoile'></div>
    <div id='etoile2'></div>
    <div id='etoile3'></div>
    <header>  
        <div>
            <button class="boutonAdministrateur" onclick="administrateurPage()" id="boutonAdministrateur">
                Administrateur 
            </button>
            <div id="pageAdmin">
                <object id="htmlpageAdmin" type="text/html" data="formAdmin.php" width="436" height="500"></object>
            </div>
        </div>
        <div>
            <button class="boutonConnexion" onclick="connexionPage()" id="boutonconnexion">
                Se connecter / S'inscrire 
            </button>
            <div id="pageConnexion">
                <object id="htmlpage" type="text/html" data="query/login.php" width="436" height="500"></object>
            </div>
        </div>
    </header>
        <h1>
            Network Park
        </h1>
    <div class="section" id="sectionMenu">
        <div id="description">
            <p id="textDescription">
                Network Park est un serious game pour tout apprendre sur les Réseaux informatique !
                Apprenez à résoudre des tâches d'adressage IP, les différents modèles (TCP/UDP, OSI, IP)...
            </p>
        </div>

        <div id="menuHistoire">
            <div id="histoire">
                <h2 id="titreHistoire">
                    Histoire
                </h2>
                <div id="histoire-image-text">
                    <img id="imgAlien" src="img/alien.png" alt="Image de l'Alien">
                    <p id="textHistoire">
                        Je suis Bloop l'extraterrestre, spaceTrooper. Un vaisseau a été percuté par un astéroïde et maintenant
                        plusieurs personnes sont bloquées dans plusieurs pièces du vaisseau. Chaque niveau correspond à une pièce 
                        du vaisseau. Mon objectif est de résoudre des tâches pour parvenir à libérer ces personnes.
                    </p>
                </div>
            </div>
        </div>

        <div id="menu">
            <button class="boutonJouer" onclick="menuLvl()" id="boutonJouer">
                Commencer
            </button>
        </div>
        <a id="menulvl">
        </a>
    </div>
    <div class="section" id="sectionScore">
        <div id="scores">
            <h2>
                Meilleurs scores :
            </h2>
            <ul>
            <?php
                session_start();

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
                
                // Envoi de la requête pour savoir si les cookies correspondent à un utilisateur
                if (isset($_SESSION["username"]) && isset($_SESSION["password"])){
                    $sql = " SELECT * FROM `utilisateur` WHERE identifiant = '".$_SESSION["username"]."' AND mot_de_passe = '".$_SESSION["password"]."' ";
                    $user = $db -> query($sql);
                    //Si l'utilisateur existe
                    /*if ($user -> num_rows > 0) {
                        while($rows = $user -> fetch_assoc()) {
                            echo "<script> alert('Vous êtes connecté" . " " . $_SESSION["username"] . "'); </script>";
                        }
                    }*/
                }

                // Envoi de la requête pour les meilleurs scores
                $query = "Select identifiant, ROUND((meilleurScore1 + meilleurScore2 + meilleurScore3 + meilleurScore4)/4) as Average from utilisateur order by Average desc limit 5";
                $result = $db->query($query);
                
                
                // Affichage des meilleurs scores
                while ($row = $result->fetch_assoc()) {

                ?>
                    <li>
                        <?php
                            echo $row['identifiant'] . " : " . $row['Average'] . "<br>";
                        ?>
                    </li>

                <?php
                }

                // Fermer la connection
                $db->close();

            ?>

            </ul>
        </div>
    </div>
    <script src="JS/mainScript.js"></script>
</body>
</html>