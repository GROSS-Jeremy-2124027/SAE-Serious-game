<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "connection/connection.php";
$con = connect();


switch ($_REQUEST['command']) {
    # Fetch a number of scores from our table:
    case "get_score":
        session_start();
        $sql ="SELECT meilleurScore FROM `utilisateur` WHERE identifiant = '".$_SESSION["username"]."'";

        $result = $con->query($sql);

        //Fetch into associative array
        while ( $row = $result->fetch_assoc())  {
            $dbdata=$row;
        }
        /* current() sert à avoir l'index actuel donc dans ce cas la derniere case de $dbdata car on l'a parcouru dans la boucle while
        *  au-dessus, le reste sert à transformer la valeur de score de string a int
        */
        echo json_encode((int) filter_var(current($dbdata), FILTER_SANITIZE_NUMBER_INT)); //affiche le score de l'utilisateur
        session_abort();
        die;

    case "add_score":
        session_start();
        $sql ="UPDATE `utilisateur` SET meilleurScore =".$_REQUEST['score']." WHERE identifiant = '".$_SESSION["username"]."'";

        $con->query($sql);
        session_abort();
        die;

    case "get_question":
        $question = "SELECT tupleQuestion,indice,bonneReponse,mauvaiseReponse,mauvaiseReponse2,mauvaiseReponse3 FROM question, reponse WHERE id_question = ".$_REQUEST['nbQuestion']."";
        $result = $con->query($question);
        while ( $row = $result->fetch_assoc())  {
            $dbdata=$row;
        }
        echo json_encode($dbdata);
        die;
}

?>
    