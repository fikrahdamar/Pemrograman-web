<?php
    $dbServer = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "mhs";

    $db = mysqli_connect($dbServer, $dbUser, $dbPass, $dbName);

    if ($db -> connect_error){
        echo "database tidak ada";
        die();
    }
?>