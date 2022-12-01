<?php

    function connect() {
        $servername = "mysql-jeremygross.alwaysdata.net";
        $username = "264023";
        $password = "Nutella13?";
        $database = "jeremygross_networkpark";
    
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