<?php

namespace Modele;

class AccesScore{

    protected $accesDonnees = null;

    public function __construct($accesDonnees){
        $this->accesDonnees = $accesDonnees;
    }

    public function getMeilleursScores(){
        // Envoi de la requête pour les meilleurs scores
        $sql = "Select identifiant, (meilleurScore1 + meilleurScore2 + meilleurScore3 + meilleurScore4) as Sommes from utilisateur order by Sommes desc limit 5";
        $result = $this->accesDonnees->prepare($sql);
        $result->execute();
        $resultats = $result->fetchAll();


        return $resultats;
    }
}