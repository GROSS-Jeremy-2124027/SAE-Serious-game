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
        echo '<script> console.log("a")</script>';
    }

    /**
     * Méthode pour récupérer les meilleurs scores
     */
    public function scoreAction($donnees, $service)
    {
        $service->getMeilleursScores($donnees);
    }
}