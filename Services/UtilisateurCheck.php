<?php

namespace service;
class UtilisateurCheck
{
    public function identification($login, $password, $donnees)
    {
        return ($donnees->connexion($login, $password) != null);
    }
}