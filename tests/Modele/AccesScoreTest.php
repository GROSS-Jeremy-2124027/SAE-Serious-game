<?php

namespace tests\Modele;

use Modele\AccesScore;
use Modele\AccesDonnees;
use PHPUnit\Framework\TestCase;

include_once('Modele/AccesScore.php');
include_once('Modele/AccesDonnees.php');

class AccesScoreTest extends TestCase
{
    private $accesDonnees;

    public function setUp(): void
    {
        $this->accesDonnees = new AccesDonnees();
    }

    public function testGetMeilleursScoresRetourneUnTableauDeScores()
    {
        $accesScore = new AccesScore($this->accesDonnees);
        $scores = $accesScore->getMeilleursScores();
        $this->assertIsArray($scores);

        foreach ($scores as $score) {
            $this->assertInstanceOf('Modele\Score', $score);
        }
    }

    public function testGetMeilleursScoresRetourneUnTableauDeScoreDeTaille5AuMaximum()
    {
        $accesScore = new AccesScore($this->accesDonnees);
        $scores = $accesScore->getMeilleursScores();
        $this->assertLessThanOrEqual(5, count($scores));
    }

    public function testGetMeilleursScoresRetourneUnTableauDeScoreTriesParScoreDescendant()
    {
        $accesScore = new AccesScore($this->accesDonnees);
        $scores = $accesScore->getMeilleursScores();
        $scorePrecedent = null;

        foreach ($scores as $score) {
            if ($scorePrecedent != null) {
                $this->assertGreaterThanOrEqual($score->getScore(), $scorePrecedent->getScore());
            }
            $scorePrecedent = $score;
        }
    }
}
