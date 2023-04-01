<?php

namespace Controleurs;

/**
 * Classe de contrôle des données
 */
class Controleur
{

    /**
     * Méthode pour l'identification
     */
    public function identificationAction($utilisateurCheck, $utilisateur)
    {
        $utilisateurCheck->identification($_POST['login'], $_POST['password'], $utilisateur);
    }
    public function identificationAdminAction($donnees) {
        $donnees -> connexionAdmin($_POST['loginAdmin'], $_POST['passwordAdmin']);
    }
    public function inscriptionAction($donnees) {
        $donnees -> inscription($_POST['loginSignup'], $_POST['passwordSignup'], $_POST['confirmPasswordSignup']);
    }
    /**
     * Méthode pour récupérer les meilleurs scores
     */
    public function scoreAction($donnees, $service)
    {
        $service->getMeilleursScores($donnees);
    }

    public function adminAction($donnees, $service) {
        $service->getAllQuestions($donnees);
    }
}