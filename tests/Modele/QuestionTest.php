<?php

use PHPUnit\Framework\TestCase;
use Modele\Question;

include_once('Modele/Question.php');

class QuestionTest extends TestCase
{
    protected $question;

    protected function setUp(): void
    {
        $this->question = new Question(
            1,
            'Quel est le nom de la planète la plus proche du soleil?',
            'Astronomie',
            'Mercure',
            'Vénus',
            'Mars',
            'Jupiter'
        );
    }

    public function testGetId()
    {
        $this->assertEquals(1, $this->question->getId());
    }

    public function testGetQuestion()
    {
        $this->assertEquals('Quel est le nom de la planète la plus proche du soleil?', $this->question->getQuestion());
    }

    public function testGetIndice()
    {
        $this->assertEquals('Astronomie', $this->question->getIndice());
    }

    public function testGetBonneReponse()
    {
        $this->assertEquals('Mercure', $this->question->getBonneReponse());
    }

    public function testGetMauvaiseReponse1()
    {
        $this->assertEquals('Vénus', $this->question->getMauvaiseReponse1());
    }

    public function testGetMauvaiseReponse2()
    {
        $this->assertEquals('Mars', $this->question->getMauvaiseReponse2());
    }

    public function testGetMauvaiseReponse3()
    {
        $this->assertEquals('Jupiter', $this->question->getMauvaiseReponse3());
    }
}