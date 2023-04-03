<?php

use PHPUnit\Framework\TestCase;
use Modele\Score;


include_once('Modele/Score.php');

class ScoreTest extends TestCase
{
    protected $score;

    protected function setUp(): void
    {
        $this->score = new Score("johndoe", 50);
    }

    public function testGetPseudo()
    {
        $this->assertEquals("johndoe", $this->score->getPseudo());
    }

    public function testGetScore()
    {
        $this->assertEquals(50, $this->score->getScore());
    }
}