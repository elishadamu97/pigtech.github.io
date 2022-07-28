<?php
session_start();
$userid = $_SESSION["userid"];
 include "configure.php";
    $sql = "SELECT SUM(price) AS price, COUNT(ID) AS ID FROM customers_record WHERE foreignkey = $userid ";
    $result = mysqli_query($con, $sql);
  $row1 = array();
    while($row = mysqli_fetch_assoc($result)){
      $row1[] = $row;

      
    }
 
   echo json_encode($row1);
?>