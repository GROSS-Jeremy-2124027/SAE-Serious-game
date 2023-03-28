<?php

// chargement et initilation des bibliothèques globales
include_once 'Controleurs/Controleur.php';

include_once 'service/AnnoncesChecking.php';
include_once 'service/UserChecking.php';
include_once 'service/AnnonceCreation.php';

include_once 'Modele/AccesDonnees.php';
include_once 'Modele/AccesUtilisateur.php';
include_once 'Modele/AccesScore.php';

include_once 'Vue/Layout.php';
include_once 'Vue/VueAccueil.php';
include_once 'Vue/VueConnexion.php';
include_once 'Vue/VueConnexionAdmin.php';
include_once 'Vue/VueInscription.php';


use Controleurs\{Controleur, Presenter};
use service\{utilisateurCheck, AnnonceCreation};
use Modele\{AccesDonnees, AccesScore, AccesUtilisateur};
use Vue\{Layout, VueAccueil, VueConnexion, VueConnexionAdmin, VueInscription};


// initialisation du controleur
$controleur = new Controleur();

// initilisation du presenter
$presenter = new Presenter();

// intialisation du cas d'utilisation utilisateurCheck
$utilisateurCheck = new utilisateurCheck() ;

// initilisation de l'accès au données
try{
    $bd = new AccesDonnees();
    $scores = new AccesScore();
    $utilisateur = new AccesUtilisateur();
} catch (PDOException $e) {
    print "Erreur de connexion : " . $e->getMessage() . "</br>";
    die();
}

// définition d'une session d'une heure
ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
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

// chemin de l'URL demandée au navigateur
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// page d'accueil
if ('/index.php' == $uri){

    $controleur->accueilAction();

    $layout = new Layout("Vue/layout.html");
    $vueAccueil = new VueAccueil($layout, $presenter);

    $vueAccueil->display();

}
// page administrateur
elseif('/index.php/admin' == $uri){

    $controleur->adminAction();

    $layout = new Layout("Vue/layout.html");
    $vueAnnoncesEmploi = new ViewAnnoncesEmploi($layout, $_SESSION['login'], $presenter);

    $vueAnnoncesEmploi->display();

}
// page des différents niveaux
elseif('/index.php/niveaux' == $uri){

    $controleur->adminAction();

    $layout = new Layout("Vue/layout.html");
    $vueAdmin = new VueAdmin($layout, $presenter);

    //$vueAnnoncesEmploi->display();

}
// page d'erreur
else {
    header('Status: 404 Not Found');
    echo '<html><body><h1>Page introuvable</h1></body></html>';
}


/*// Envoi de la requête pour savoir si les cookies correspondent à un utilisateur
if (isset($_SESSION["username"]) && isset($_SESSION["password"])){
    $sql = " SELECT * FROM `utilisateur` WHERE identifiant = '".$_SESSION["username"]."' AND mot_de_passe = '".$_SESSION["password"]."' ";
    //$sql = $con->prepare($sql);
    $result = $bd->run();
}

// Envoi de la requête pour les meilleurs scores
$sql = "Select identifiant, (meilleurScore1 + meilleurScore2 + meilleurScore3 + meilleurScore4) as Sommes from utilisateur order by Sommes desc limit 5";
$result = $bd->run($sql);
*/


// On ferme la connection
$bd->fermerConnexion();