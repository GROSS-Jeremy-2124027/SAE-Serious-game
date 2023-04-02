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

    public function changeQuestion($identifiant, $question, $indice, $bonneReponse, $mauvaiseReponse, $mauvaiseReponse2, $mauvaiseReponse3) {
        $query1 = "UPDATE `question` SET `tupleQuestion` = '$question', `indice` = '$indice' WHERE `id_question` = '$identifiant'";
        $query2 = "UPDATE `reponse` SET `bonneReponse` = '$bonneReponse', `mauvaiseReponse` = '$mauvaiseReponse', `mauvaiseReponse2` = '$mauvaiseReponse2', 
        `mauvaiseReponse3` = '$mauvaiseReponse3' WHERE `question_id` = '$identifiant'";

        $this->accesDonnees->runInsert($query1);
        $this->accesDonnees->runInsert($query2);
    }
}