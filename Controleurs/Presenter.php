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

    public function getAllQuestionsHTML() {
        $content = null;
        $questions = $this->service->getQuestions();
        foreach ($questions as $question) {
            $content .= "<tr>";
            $content .= '<td>';
            $content .= $question->getId();
            $content .= '</td>';
            $content .= "<td>" . $question->getQuestion() . "</td>";
            $content .= "<td>" . $question->getIndice() . "</td>";
            $content .= "<td>" . $question->getBonneReponse() . "</td>";
            $content .= "<td>" . $question->getMauvaiseReponse1() . "</td>";
            $content .= "<td>" . $question->getMauvaiseReponse2() . "</td>";
            $content .= "<td>" . $question->getMauvaiseReponse3() . "</td>";
            $content .= "</tr>";
        }
        return $content;
    }
}