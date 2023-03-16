<?php

include "Modele/AccesDonnees.php";

try{
    $bd = new AccesDonnees();
    $scores = new AccesScore();
    $utilisateur = new AccesUtilisateur();
} catch (PDOException $e) {
    print "Erreur de connexion : " . $e->getMessage() . "</br>";
    die();
}

session_start();

$_SESSION['connecter'] = false;
if ($_SESSION['connecter'] === true) {
    echo "<script>document.getElementById('boutonconnexion').textContent = 'Se déconnecter'</script>";
    echo "<script>document.getElementById('htmlpage').style.display='none'</script>";
}
if (isset($_POST['btnDeconnexion'])) {
    session_unset();
    echo "<script>document.getElementById('boutonconnexion').textContent = 'Se connecter / S\'inscrire'</script>";
    echo "<script>window.location.href = window.location.href</script>";
}

// Connexion à la base de données
$bd = new AccesDonnees();

// Envoi de la requête pour savoir si les cookies correspondent à un utilisateur
if (isset($_SESSION["username"]) && isset($_SESSION["password"])){
    $sql = " SELECT * FROM `utilisateur` WHERE identifiant = '".$_SESSION["username"]."' AND mot_de_passe = '".$_SESSION["password"]."' ";
    //$sql = $con->prepare($sql);
    $result = $bd->run();
}

// Envoi de la requête pour les meilleurs scores
$sql = "Select identifiant, (meilleurScore1 + meilleurScore2 + meilleurScore3 + meilleurScore4) as Sommes from utilisateur order by Sommes desc limit 5";
$result = $bd->run($sql);

// Affichage des meilleurs scores
for ($i = 0; $i < count($result); $i++) {
    ?>
    <li>
        <?php
            echo $result[$i]['identifiant'] . " : " . $result[$i]['Sommes'] . "<br>";
        ?>
    </li>

    <?php
}

// Fermer la connection
$bd->fermerConnexion();