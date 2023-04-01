<?php
namespace Controleurs;

use service\Service;

/**
 * Classe de présentation des données
 */
class Presenter
{
    protected $service;
    public function __construct($service)
    {
        $this->service = $service;
    }

    /**
     * Retourne le code HTML pour l'affichage des meilleurs scores
     */
    public function getMeilleursScoresHTML()
    {
        $content = null;
        $scores = $this->service->getScores();
        foreach ($scores as $score) {
            $content .= ' <li>';
            $content .= $score->getPseudo();
            $content .= ' : ';
            $content .= $score->getScore();
            $content .= '</li>';
        }
        return $content;
    }
}