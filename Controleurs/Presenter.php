<?php
namespace Controleurs;
use service\Service;

class Presenter
{
    protected $service;
    public function __construct($service) {
        $this->service = $service;
    }
    public function getMeilleursScoresHTML() {
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