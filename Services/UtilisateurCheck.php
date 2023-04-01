<?php

namespace service;

/**
 * Cas d'utilisation de l'identification
 */
class UtilisateurCheck
{
    public function identification($login, $password, $donnees)
    {
        return ($donnees->connexion($login, $password) != null);
    }
}