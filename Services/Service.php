<?php

namespace service;

class Service
{

    protected $scores;

    public function estConnecte() {
        if ($_SESSION['connecter'] === true) {
            echo "<script>document.getElementById('boutonconnexion').textContent = 'Se déconnecter'</script>";
            echo "<script>document.getElementById('htmlpage').style.display='none'</script>";
        }
    }

    public function veutDeconnecte() {
        session_unset();
        echo "<script>document.getElementById('boutonconnexion').textContent = 'Se connecter / S\'inscrire'</script>";
        echo "<script>window.location.href = window.location.href</script>";
    }

    public function getMeilleursScores($donnees) {
        $this->scores = $donnees -> getMeilleursScores();
    }

    public function getScores() {
        return $this->scores;
    }
}