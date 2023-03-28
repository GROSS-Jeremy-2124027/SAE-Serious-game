<?php

include 'AccesDonnees.php';

class AccesScore{

    protected $accesDonnees = null;

    public function __construct(){
        $this->accesDonnees = new AccesDonnees();
    }

    public function getMeilleursScores(){
        // Envoi de la requête pour les meilleurs scores
        $sql = "Select identifiant, (meilleurScore1 + meilleurScore2 + meilleurScore3 + meilleurScore4) as Sommes from utilisateur order by Sommes desc limit 5";
        $result = $this->accesDonnees->run($sql);

        return $result;
    }

    
}