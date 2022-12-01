<?php

    function connect() {
        $servername = "mysql-networkpark.alwaysdata.net";
        $username = "291361";
        $password = "coucou18?";
        $database = "networkpark_bd";
    
        $con = new mysqli($servername, $username, $password, $database);
    
        if ($con -> error) {
            die ("Connection Error" . $con -> error);
        }
        else {
            return $con;
            // echo "Connected";
        }
    }

?>