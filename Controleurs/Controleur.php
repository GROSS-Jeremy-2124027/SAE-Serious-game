<?php
include "../Modele/AccesUtilisateur.php";
class Controleur{

    // Méthode pour vérifier une connexion
    public function identificationAction($utilisateurCheck, $utilisateur){
        $utilisateurCheck->identification($_POST['login'], $_POST['password'], $utilisateur);
    }

    // Méthode pour récupérer les meilleurs scores
    public function scoreAction($scores, $service){
        $service->getMeilleursScores($scores);
    }
}