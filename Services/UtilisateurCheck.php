<?php

namespace service;
class UtilisateurCheck
{
    public function identification($login, $password, $donnees)
    {
        return ($donnees->getUser($login, $password) != null);
    }
}