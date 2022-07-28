<?php 
    $servername = "localhost";
    $dbuser = "root";
    $password = "";
    $dbname = "customer_details";

    $con = mysqli_connect($servername, $dbuser, $password, $dbname);

    if(!$con){
        die("Connection was unsuccessful");
    }

?>