<?php

// charge et initialise les bibliothèques globales
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


use Controleurs\Controleur;
use service\{utilisateurCheck, AnnonceCreation};
use Modele\{AccesDonnees, AccesScore, AccesUtilisateur};
use Vue\{Layout, VueAccueil, VueConnexion, VueConnexionAdmin, VueInscription};


// initialisation du controleur
$controleur = new Controleur();

// intialisation du cas d'utilisation service\UserChecking
$utilisateurCheck = new utilisateurCheck() ;

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

// Authentification et création du compte (sauf pour le formulaire de connexion et la route de déconnexion)
if ( '/annonces/' != $uri and '/annonces/index.php' != $uri and '/annonces/index.php/logout' != $uri ){

    $error = $controller->authenticateAction($userCheck, $dataUsers);

    if( $error != null )
    {
        $uri='/annonces/index.php/error' ;
        if( $error == 'bad login or pwd' or $error == 'not connected')
            $redirect = '/annonces/index.php';
    }
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


// Fermer la connection
$bd->fermerConnexion();





// chemin de l'URL demandée au navigateur
// (p.ex. /annonces/index.php)
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// définition d'une session d'une heure
ini_set('session.gc_maxlifetime', 3600);
session_set_cookie_params(3600);
session_start();




// route la requête en interne
// i.e. lance le bon contrôleur en fonction de la requête effectuée
if ( '/annonces/' == $uri || '/annonces/index.php' == $uri || '/annonces/index.php/logout' == $uri) {
    // affichage de la page de connexion

    session_destroy();
    $layout = new Layout("gui/layoutLogged.html" );
    $vueLogin = new ViewLogin( $layout );

    $vueLogin->display();
}
elseif ( '/annonces/index.php/annonces' == $uri ){

    //traitement de l'insertion d'una annonce si necessaire
    if (isset($_POST['contractType'])){
        $controller->annonceCreationAction($_SESSION['login'], $_POST, $dataAnnonces, $annonceCreation);
    }

    // affichage de toutes les annonces

    $controller->annoncesAction($dataAnnonces, $annoncesCheck);

    $layout = new Layout("gui/layoutLogged.html" );
    $vueAnnonces= new ViewAnnonces( $layout,  $_SESSION['login'], $presenter);

    $vueAnnonces->display();
}
elseif ( '/annonces/index.php/post' == $uri
    && isset($_GET['id'])) {
    // Affichage d'une annonce

    $controller->postAction($_GET['id'], $dataAnnonces, $annoncesCheck);

    $layout = new Layout("gui/layoutLogged.html" );
    $vuePost= new ViewPost( $layout,  $presenter );

    $vuePost->display();
}
elseif('/annonces/index.php/annoncesEmploi' == $uri){

    $controller->annoncesAction($apiEmploi, $annoncesCheck);

    $layout = new Layout("gui/layoutLogged.html");
    $vueAnnoncesEmploi = new ViewAnnoncesEmploi($layout, $_SESSION['login'], $presenter);

    $vueAnnoncesEmploi->display();
}
elseif ('/annonces/index.php/offreEmploi' == $uri
    && isset($_GET['id'])){
    $controller->postAction($_GET['id'], $apiEmploi, $annoncesCheck);

    $layout = new Layout("gui/layoutLogged.html");
    $vuePostEmploi = new ViewOffreEmploi($layout, $_SESSION['login'], $presenter);

    $vuePostEmploi->display();
}
elseif ( '/annonces/index.php/annoncesAlternance' == $uri ){
    // Affichage de toutes les entreprises offrant de l'alternance

    $controller->annoncesAction($apiAlternance, $annoncesCheck);

    $layout = new Layout("gui/layoutLogged.html" );
    $vueAnnoncesAlternance= new ViewAnnoncesAlternance( $layout,  $_SESSION['login'], $presenter);

    $vueAnnoncesAlternance->display();
}
elseif ( '/annonces/index.php/companyAlternance' == $uri
    && isset($_GET['id'])) {
    // Affichage d'une entreprise offrant de l'alternance

    //$controller->postAction($_GET['id'], $apiAlternance, $annoncesCheck);

    $layout = new Layout("gui/layoutLogged.html" );
    $vuePostAlternance = new ViewCompanyAlternance( $layout,  $_SESSION['login'], $presenter );

    $vuePostAlternance->display();
}
elseif ( '/annonces/index.php/createAnnonce' == $uri ){
    // Affichage du formulaire de création d'annonce

    $layout = new Layout("gui/layoutLogged.html" );
    $vueCreatAnnonce = new ViewCreateAnnonce( $layout );

    $vueCreatAnnonce->display();
}
elseif ( '/annonces/index.php/error' == $uri ){
    // Affichage d'un message d'erreur

    $layout = new Layout("gui/layout.html" );
    $vueError = new ViewError( $layout, $error, $redirect );

    $vueError->display();
}
else {
    header('Status: 404 Not Found');
    echo '<html><body><h1>My Page NotFound</h1></body></html>';
}

?>