<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ATTENTION, 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

include "../connection/AccesDonnees.php";
$con = new AccesDonnees();


switch ($_REQUEST['command']) {
    # Fetch a number of scores from our table:
    case "get_score":
        session_start();
        $sql ="SELECT meilleurScore".$_REQUEST['level']." FROM `utilisateur` WHERE identifiant = '".$_SESSION["username"]."'";
        $result = $con->run($sql);

        /* current() sert à avoir l'index actuel donc dans ce cas la derniere case de $result car on l'a parcouru dans la boucle while
        *  au-dessus, le reste sert à transformer la valeur de score de string a int
        */
        
        echo json_encode((int) filter_var(current($result), FILTER_SANITIZE_NUMBER_INT)); //affiche le score de l'utilisateur
        session_abort();
        die;

    case "add_score":
        session_start();
        $sql ="UPDATE `utilisateur` SET meilleurScore".$_REQUEST['level']." =".$_REQUEST['score']." WHERE identifiant = '".$_SESSION["username"]."'";
        $con->runInsert($sql);
        session_abort();
        die;

    case "get_question":
        $sql = "SELECT tupleQuestion,indice,bonneReponse,mauvaiseReponse,mauvaiseReponse2,mauvaiseReponse3 FROM question, reponse WHERE question_id=id_question AND question_id = ".$_REQUEST['idQuestion']."";
        $result = $con->run($sql);

        // var_dump($result);
        echo json_encode($result[0]);
        die;
}

?>
    