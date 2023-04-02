<?php

// chargement et initilation des bibliothèques globales
include_once 'Controleurs/Controleur.php';
include_once 'Controleurs/Presenter.php';


include_once 'Services/Service.php';
include_once "Services/UtilisateurCheck.php";

include_once 'Modele/AccesDonnees.php';
include_once 'Modele/AccesScore.php';
include_once "Modele/AccesUtilisateur.php";
include_once "Modele/AccesQuestion.php";

include_once 'Vue/Layout.php';
include_once 'Vue/VueAccueil.php';
include_once "Vue/VueAdmin.php";




use Controleurs\{Controleur, Presenter};
use Service\{Service, UtilisateurCheck};
use Modele\{AccesDonnees, AccesScore, AccesUtilisateur, AccesQuestion};
use Vue\{Layout, VueAccueil, VueAdmin};

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
    $accesScores = new AccesScore($bd);
    $accesUtilisateur = new AccesUtilisateur($bd);
    $accesQuestions = new AccesQuestion($bd);
} catch (PDOException $e) {
    print "Erreur de connexion : " . $e->getMessage() . "</br>";
    die();
}

// définition d'une session d'une heure
ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
session_start();

// chemin de l'URL demandée au navigateur
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// page d'accueil
if ('/sae/SAE-Serious-game/' == $uri || '/sae/SAE-Serious-game/index.php' == $uri){

    $controleur->scoreAction($accesScores, $service);

    if (isset($_POST['loginButton']) && isset($_POST['login'])) {
        $controleur->identificationAction($utilisateurCheck, $accesUtilisateur);
    }

    if (isset($_POST['signupButton']) && isset($_POST['loginSignup'])) {
        $controleur->inscriptionAction($accesUtilisateur);
    }

    if (isset($_POST['loginAdminButton']) && isset($_POST['loginAdmin'])) {
        $controleur->identificationAdminAction($accesUtilisateur);
    }

    $layout = new Layout("Vue/layout.html");
    $vueAccueil = new VueAccueil($layout, $presenter);

    if (isset($_SESSION['connecte'])) {
        if ($_SESSION['connecte'] === true) {
            echo "<script>document.getElementById('boutonconnexion').textContent = 'Se déconnecter'</script>";
            echo "<script>document.getElementById('htmlpage').style.display='none'</script>";
        }
    }

    $vueAccueil->display();
}
// page administrateur
elseif('/sae/SAE-Serious-game/index.php/admin' == $uri && isset($_SESSION['admin'])){

    $controleur->adminAction($accesQuestions, $service);

    if (isset($_POST['valider']) && isset($_POST['identifiant'])) {
        $controleur->changeQuestionAction($accesQuestions);
        header( "refresh:0;url=/sae/SAE-Serious-game/index.php/admin");
    }

    $layout = new Layout("Vue/layout.html");
    $vueAdmin = new VueAdmin($layout, $presenter);

    $vueAdmin->display();

}
// page d'erreur
else {
    header('Status: 404 Not Found');
    echo '<html><body><h1>Page introuvable</h1></body></html>';
}

if (isset($_POST['btnDeconnexion'])) {
    session_unset();
    session_destroy();
    echo "<script>document.getElementById('boutonconnexion').textContent = 'Se connecter / S\'inscrire'</script>";
}
// On ferme la connection
$bd = null;