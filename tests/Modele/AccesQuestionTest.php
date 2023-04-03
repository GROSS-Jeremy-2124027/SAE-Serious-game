<?php

use Modele\AccesDonnees;
use Modele\AccesQuestion;
use Modele\Question;
use PHPUnit\Framework\TestCase;

include_once('Modele/AccesDonnees.php');
include_once('Modele/AccesQuestion.php');
include_once('Modele/Question.php');

class AccesQuestionTest extends TestCase
{
    
    public function testGetAllQuestionsReturnsArrayOfQuestions()
    {
        // Mock AccesDonnees
        $mockAccesDonnees = $this->getMockBuilder(AccesDonnees::class)->disableOriginalConstructor()->getMock();
        $mockAccesDonnees->expects($this->once())
                         ->method('run')
                         ->willReturn([
                            [
                                'id' => 1,
                                'tupleQuestion' => 'Question 1',
                                'indice' => 1,
                                'bonneReponse' => 'Bonne réponse 1',
                                'mauvaiseReponse' => 'Mauvaise réponse 1',
                                'mauvaiseReponse2' => 'Mauvaise réponse 2',
                                'mauvaiseReponse3' => 'Mauvaise réponse 3'
                            ],
                            [
                                'id' => 2,
                                'tupleQuestion' => 'Question 2',
                                'indice' => 2,
                                'bonneReponse' => 'Bonne réponse 2',
                                'mauvaiseReponse' => 'Mauvaise réponse 4',
                                'mauvaiseReponse2' => 'Mauvaise réponse 5',
                                'mauvaiseReponse3' => 'Mauvaise réponse 6'
                            ]
                         ]);

        $accesQuestion = new AccesQuestion($mockAccesDonnees);

        $result = $accesQuestion->getAllQuestions();

        $this->assertIsArray($result);
        $this->assertCount(2, $result);
        $this->assertContainsOnlyInstancesOf(Question::class, $result);
    }

    public function testChangeQuestionUpdatesQuestionAndResponses()
    {
        // Mock AccesDonnees
        $mockAccesDonnees = $this->getMockBuilder(AccesDonnees::class)->disableOriginalConstructor()->getMock();
        $mockAccesDonnees->expects($this->exactly(2))
                         ->method('runInsert');

        $accesQuestion = new AccesQuestion($mockAccesDonnees);

        $accesQuestion->changeQuestion(1, 'Question 1 modifiée', 3, 'Bonne réponse modifiée', 'Mauvaise réponse modifiée 1', 'Mauvaise réponse modifiée 2', 'Mauvaise réponse modifiée 3');
    }
}
