<?php
class AccesDonnees{
    protected $bdd;

    function __construct(){
        try{
            $this->bdd = new PDO('mysql:host=mysql-networkpark.alwaysdata.net;dbname=networkpark_bd', '291361', 'coucou18?');
        } catch (PDOException $e){
            print "Erreur de connexion !: " . $e->getMessage() . "<br>";
            die();
        }
        return $this->bdd;
    }

    function run($sql){
        $nom = $this->bdd->prepare($sql);
        $nom->execute();
        $result = $nom->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    function runInsert($sql){
        $nom = $this->bdd->prepare($sql);
        $nom->execute();
        return $nom;
    }


    function fermerConnexion(){
        $this->bdd = null;
    }
}