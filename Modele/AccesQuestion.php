<?php

namespace Modele;

include_once "Question.php";

class AccesQuestion
{
    protected $accesDonnees = null;

    public function __construct($accesDonnees) {
        $this->accesDonnees = $accesDonnees;
    }

    public function getAllQuestions() {
        // Préparez la requête et envoyez la requête
        $query = "SELECT * FROM question, reponse WHERE question.id_question = reponse.question_id";
        $results = $this->accesDonnees->run($query);

        foreach ($results as $result) {
            $currentQuestion = new Question($result['id'], $result['tupleQuestion'], $result['indice'], $result['bonneReponse'], $result['mauvaiseReponse'], $result['mauvaiseReponse2'], $result['mauvaiseReponse3']);
            $questions[] = $currentQuestion;
        }
        return $questions;
    }
}