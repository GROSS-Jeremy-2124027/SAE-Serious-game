<?php
namespace tests\Controleurs;

use PHPUnit\Framework\TestCase;
use Controleurs\Presenter;
use service\Service;
use Modele\Question;
use Modele\Score;

include_once('Controleurs/Presenter.php');
include_once('Services/Service.php');
include_once('Modele/Question.php');
include_once('Modele/Score.php');


class PresenterTest extends TestCase
{
    protected $serviceMock;
    protected $presenter;

    public function setUp(): void
    {
        $this->serviceMock = $this->createMock(Service::class);
        $this->presenter = new Presenter($this->serviceMock);
    }

    public function testGetMeilleursScoresHTMLWithScores()
    {
        $score1 = new Score('joueur1', 20);
        $score2 = new Score('joueur2', 15);
        $this->serviceMock->expects($this->once())
            ->method('getScores')
            ->willReturn([$score1, $score2]);
        $expectedResult = ' <li>joueur1 : 20</li> <li>joueur2 : 15</li>';
        $this->assertEquals($expectedResult, $this->presenter->getMeilleursScoresHTML());
    }

    public function testGetMeilleursScoresHTMLWithoutScores()
    {
        $this->serviceMock->expects($this->once())
            ->method('getScores')
            ->willReturn([]);
        $expectedResult = null;
        $this->assertEquals($expectedResult, $this->presenter->getMeilleursScoresHTML());
    }

    public function testGetAllQuestionsHTMLWithQuestions()
    {
        $question1 = new Question(1, 'Question 1', 'Indice 1', 'Reponse 1', 'Mauvaise Reponse 1', 'Mauvaise Reponse 2', 'Mauvaise Reponse 3');
        $question2 = new Question(2, 'Question 2', 'Indice 2', 'Reponse 2', 'Mauvaise Reponse 4', 'Mauvaise Reponse 5', 'Mauvaise Reponse 6');
        $this->serviceMock->expects($this->once())
            ->method('getQuestions')
            ->willReturn([$question1, $question2]);
        $expectedResult = "<tr><td>1</td><td>Question 1</td><td>Indice 1</td><td>Reponse 1</td><td>Mauvaise Reponse 1</td><td>Mauvaise Reponse 2</td><td>Mauvaise Reponse 3</td></tr><tr><td>2</td><td>Question 2</td><td>Indice 2</td><td>Reponse 2</td><td>Mauvaise Reponse 4</td><td>Mauvaise Reponse 5</td><td>Mauvaise Reponse 6</td></tr>";
        $this->assertEquals($expectedResult, $this->presenter->getAllQuestionsHTML());
    }

    public function testGetAllQuestionsHTMLWithoutQuestions()
    {
        $this->serviceMock->expects($this->once())
            ->method('getQuestions')
            ->willReturn([]);
        $expectedResult = null;
        $this->assertEquals($expectedResult, $this->presenter->getAllQuestionsHTML());
    }
}
