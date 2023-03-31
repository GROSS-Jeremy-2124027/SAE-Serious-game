<?php

namespace Modele;

include_once "Score.php";

class AccesScore{

    protected $accesDonnees = null;

    public function __construct($accesDonnees){
        $this->accesDonnees = $accesDonnees;
    }

    public function getMeilleursScores(){
        // Envoi de la requête pour les meilleurs scores
        $sql = "Select identifiant, (meilleurScore1 + meilleurScore2 + meilleurScore3 + meilleurScore4) as Sommes from utilisateur order by Sommes desc limit 5";
        $results = $this->accesDonnees->run($sql);

        foreach ($results as $result) {
            $currentScore = new Score($result['identifiant'], $result['Sommes']);
            $scores[] = $currentScore;
        }

        return $scores;
    }
}