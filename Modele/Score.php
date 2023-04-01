<?php
namespace Modele;

/**
 * Classe représentant les scores
 */
class Score
{
    protected $pseudo;
    protected $score;

    /**
     * @param $pseudo
     * @param $score
     */
    public function __construct($pseudo, $score)
    {
        $this->pseudo = $pseudo;
        $this->score = $score;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }
}