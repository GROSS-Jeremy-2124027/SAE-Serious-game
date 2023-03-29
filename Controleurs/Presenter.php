<?php
namespace Controleurs;
use service\Service;

class Presenter
{
    protected $service;
    public function __construct() {
        $this->service = new Service();
    }
    public function getMeilleursScoresHTML() {
        $scores = $this->service->getScores();
        foreach ($scores as $score) {
            $content .= ' <li>';
            $content .= $score;
        }
        return $content;
    }
}