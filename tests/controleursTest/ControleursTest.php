<?php

namespace tests\controleursTest;

use Controleurs\Controleur;
use Controleurs\Presenter;
use PHPUnit\Framework\TestCase;
use service\Service;
use service\UtilisateurCheck;

class ControleurTest extends TestCase
{
    public function testIdentificationAction()
    {
        // Créer un utilisateur fictif
        $utilisateur = [
            'login' => 'test',
            'password' => password_hash('password', PASSWORD_DEFAULT),
        ];

        // Créer un objet UtilisateurCheck
        $utilisateurCheck = new UtilisateurCheck();

        // Appeler la méthode identificationAction
        $controleur = new Controleur();
        $controleur->identificationAction($utilisateurCheck, $utilisateur);

        // Vérifier que l'utilisateur est identifié
        $this->assertEquals($_SESSION['login'], $utilisateur['login']);
    }

    public function testScoreAction()
    {
        // Créer un objet Service fictif qui retourne les meilleurs scores
        $service = $this->getMockBuilder(Service::class)
            ->disableOriginalConstructor()
            ->getMock();
        $service->expects($this->once())
            ->method('getMeilleursScores')
            ->willReturn(['score1', 'score2']);

        // Appeler la méthode scoreAction
        $controleur = new Controleur();
        $controleur->scoreAction('donnees', $service);

        // Vérifier que les meilleurs scores sont retournés
        $this->assertEquals($_SESSION['meilleursScores'], ['score1', 'score2']);
    }

    public function testAdminAction()
    {
        // Créer un objet Service fictif qui retourne toutes les questions
        $service = $this->getMockBuilder(Service::class)
            ->disableOriginalConstructor()
            ->getMock();
        $service->expects($this->once())
            ->method('getAllQuestions')
            ->willReturn(['question1', 'question2']);

        // Appeler la méthode adminAction
        $controleur = new Controleur();
        $controleur->adminAction('donnees', $service);

        // Vérifier que toutes les questions sont retournées
        $this->assertEquals($_SESSION['questions'], ['question1', 'question2']);
    }

    public function testChangeQuestionAction()
    {
        // Créer un objet Donnees fictif avec la méthode changeQuestion qui ne fait rien
        $donnees = $this->getMockBuilder(Donnees::class)
            ->disableOriginalConstructor()
            ->getMock();
        $donnees->expects($this->once())
            ->method('changeQuestion');

        // Appeler la méthode changeQuestionAction
        $controleur = new Controleur();
        $controleur->changeQuestionAction($donnees);

        // Vérifier que la méthode changeQuestion a été appelée avec les bons arguments
        $this->assertEquals(
            [
                $_POST['identifiant'],
                $_POST['question'],
                $_POST['indice'],
                $_POST['bonneReponse'],
                $_POST['mauvaiseReponse'],
                $_POST['mauvaiseReponse2'],
                $_POST['mauvaiseReponse3'],
            ],
            $donnees->changeQuestionArgs
        );
    }
}