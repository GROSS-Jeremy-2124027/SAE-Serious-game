<?php

// chargement et initilation des bibliothèques globales
include_once 'Controleurs/Controleur.php';
include_once 'Controleurs/Presenter.php';


include_once 'Services/Service.php';
include_once "Services/UtilisateurCheck.php";

include_once 'Modele/AccesDonnees.php';
include_once 'Modele/AccesScore.php';
include_once "Modele/AccesUtilisateur.php";

include_once 'Vue/Layout.php';
include_once 'Vue/VueAccueil.php';
//include_once 'Vue/VueConnexionAdmin.php';
//include_once 'Vue/VueInscription.php';


use Controleurs\{Controleur, Presenter};
use Service\{Service, UtilisateurCheck};
use Modele\{AccesDonnees, AccesScore, AccesUtilisateur};
use Vue\{Layout, VueAccueil, VueConnexion, VueConnexionAdmin, VueInscription};

// initialisation du controleur
$controleur = new Controleur();

// intialisation du cas d'utilisation Service
$service = new Service() ;

// initilisation du presenter
$presenter = new Presenter($service);

$utilisateurCheck = new UtilisateurCheck();


// initilisation de l'accès au données
$donnees = null;
try{
    $bd = new AccesDonnees();
    $scores = new AccesScore($bd);
    $AccesUtilisateur = new AccesUtilisateur($bd);
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
if ('/sae/SAE-Serious-game/' == $uri || '/sae/SAE-Serious-game/index.php' == $uri){

    $controleur->scoreAction($scores, $service);

    if (isset($_POST['loginButton']) && isset($_POST['login'])) {
        $controleur->identificationAction($utilisateurCheck, $AccesUtilisateur);
    }

    $layout = new Layout("Vue/layout.html");
    $vueAccueil = new VueAccueil($layout, $presenter);

    $vueAccueil->display();
}
// page administrateur
elseif('/sae/SAE-Serious-game/index.php/admin' == $uri){

    $controleur->adminAction();

    $layout = new Layout("Vue/layout.html");
    $vueAdmin = new VueAdmin();

    $vueAdmin->display();

}
// page des différents niveaux
elseif('/sae/SAE-Serious-game/index.php/niveaux' == $uri){

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
$bd = null;