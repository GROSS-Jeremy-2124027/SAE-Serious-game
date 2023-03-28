<?php

namespace service;
class utilisateurCheck
{
    public function identification($login, $password, $donnees)
    {
        return ($donnees->getUser($login, $password) != null);
    }
}