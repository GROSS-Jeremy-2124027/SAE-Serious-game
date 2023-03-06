<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Headers: *");

include "../connection/connection.php";
$bd = new AccesDonnees();
$con = $bd->connection();


switch ($_REQUEST['command']) {
    # Fetch a number of scores from our table:
    case "get_score":
        session_start();
        $sql ="SELECT meilleurScore".$_REQUEST['level']." FROM `utilisateur` WHERE identifiant = '".$_SESSION["username"]."'";
        $sql = $con->prepare($sql);
        $result = $con->execute();

        //Fetch into associative array
        while ( $row = $result->fetch())  {
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
        $sql ="UPDATE `utilisateur` SET meilleurScore".$_REQUEST['level']." =".$_REQUEST['score']." WHERE identifiant = '".$_SESSION["username"]."'";

        $con->query($sql);
        session_abort();
        die;

    case "get_question":
        $question = "SELECT tupleQuestion,indice,bonneReponse,mauvaiseReponse,mauvaiseReponse2,mauvaiseReponse3 FROM question, reponse WHERE question_id=id_question AND question_id = ".$_REQUEST['idQuestion']."";
        $result = $con->query($question);
        while ( $row = $result->fetch_assoc())  {
            $dbdata=$row;
        }
        echo json_encode($dbdata);
}

?>
    