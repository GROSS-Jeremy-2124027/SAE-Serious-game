<?php
namespace tests\Modele;

use Modele\AccesScore;
use Modele\Score;
use PHPUnit\Framework\TestCase;

class AccesScoreTest extends TestCase
{
    /**
     * @var AccesScore
     */
    private $accesScore;

    protected function setUp(): void
    {
        // Mock de l'objet AccesDonnees
        $accesDonneesMock = $this->getMockBuilder('AccesDonnees')
            ->disableOriginalConstructor()
            ->getMock();

        $accesDonneesMock->method('run')->willReturn([
            ['identifiant' => 'user1', 'Sommes' => 25],
            ['identifiant' => 'user2', 'Sommes' => 20],
            ['identifiant' => 'user3', 'Sommes' => 15],
            ['identifiant' => 'user4', 'Sommes' => 10],
            ['identifiant' => 'user5', 'Sommes' => 5],
        ]);

        // Initialisation de l'objet AccesScore
        $this->accesScore = new AccesScore($accesDonneesMock);
    }

    public function testGetMeilleursScoresRetourneUnTableauDeScores()
    {
        $resultatAttendu = [
            new Score('user1', 25),
            new Score('user2', 20),
            new Score('user3', 15),
            new Score('user4', 10),
            new Score('user5', 5),
        ];

        $this->assertEquals($resultatAttendu, $this->accesScore->getMeilleursScores());
    }

    public function testGetMeilleursScoresRetourneUnTableauDeScoreDeTaille5AuMaximum()
    {
        $this->assertCount(5, $this->accesScore->getMeilleursScores());
    }

    public function testGetMeilleursScoresRetourneUnTableauDeScoreTriesParScoreDescendant()
    {
        $scores = $this->accesScore->getMeilleursScores();

        $premierScore = $scores[0];
        $deuxiemeScore = $scores[1];
        $troisiemeScore = $scores[2];
        $quatriemeScore = $scores[3];
        $cinquiemeScore = $scores[4];

        $this->assertGreaterThanOrEqual($premierScore->getScore(), $deuxiemeScore->getScore());
        $this->assertGreaterThanOrEqual($deuxiemeScore->getScore(), $troisiemeScore->getScore());
        $this->assertGreaterThanOrEqual($troisiemeScore->getScore(), $quatriemeScore->getScore());
        $this->assertGreaterThanOrEqual($quatriemeScore->getScore(), $cinquiemeScore->getScore());
    }
}
