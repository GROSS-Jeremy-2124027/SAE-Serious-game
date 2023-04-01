<?php

namespace Modele;

class Question
{
    protected $id;
    protected $question;
    protected $indice;
    protected $bonneReponse;
    protected $mauvaiseReponse1;
    protected $mauvaiseReponse2;
    protected $mauvaiseReponse3;

    /**
     * @param $id
     * @param $question
     * @param $indice
     * @param $bonneReponse
     * @param $mauvaiseReponse1
     * @param $mauvaiseReponse2
     * @param $mauvaiseReponse3
     */
    public function __construct($id, $question, $indice, $bonneReponse, $mauvaiseReponse1, $mauvaiseReponse2, $mauvaiseReponse3)
    {
        $this->id = $id;
        $this->question = $question;
        $this->indice = $indice;
        $this->bonneReponse = $bonneReponse;
        $this->mauvaiseReponse1 = $mauvaiseReponse1;
        $this->mauvaiseReponse2 = $mauvaiseReponse2;
        $this->mauvaiseReponse3 = $mauvaiseReponse3;
    }


    public function getId()
    {
        return $this->id;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function getIndice()
    {
        return $this->indice;
    }

    public function getBonneReponse()
    {
        return $this->bonneReponse;
    }

    public function getMauvaiseReponse1()
    {
        return $this->mauvaiseReponse1;
    }

    public function getMauvaiseReponse2()
    {
        return $this->mauvaiseReponse2;
    }

    public function getMauvaiseReponse3()
    {
        return $this->mauvaiseReponse3;
    }


}