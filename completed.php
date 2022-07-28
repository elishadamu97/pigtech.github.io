<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login-page.php");
    exit;
}
else{
    $now = time(); // Checking the time now when home page starts.

    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo "Your session has expired!";
    }
}

    include_once("configure.php");
    $userid = $_SESSION["userid"];
    $sql = "SELECT * FROM customers_record WHERE foreignkey = $userid";
    $result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<head>
    <title>Dashboard page</title>
    <meta lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="bootstrap.css">
</head>
    <body>
        <style>
            
            table, th, td {
                border-collapse: collapse;
            }
            th, td{
                padding: 15px;
                text-align: center;
            }
            tr:nth-child(even){
                background-color: rgb(191, 225, 255);
            }
            tr:nth-child(odd){
                background-color: rgb(191, 255, 255);
            }
            th{
                background-color: rgb(80, 166, 223);
            }
        </style>
        <div class="header">
            <h5 class="logo"><i class="bi bi-apple"></i><?php echo  $_SESSION["company"]; ?></h5>
        </div>
        
        <div class="content">
            <!--Navigation bar-->
            <div class="nav-bar">
                <div class="admin-name">
                <?php 
            
            $adminimage = $_SESSION["imagefile"];
            $userid = $_SESSION["userid"];
              $sqlimage = mysqli_query($con, "SELECT * FROM customers_registered WHERE ID = $userid ");
              if(mysqli_num_rows($sqlimage)> 0){
                  while($rowimage = mysqli_fetch_assoc($sqlimage)){
                
            ?>
            <img class="image" src="./image/<?php echo $rowimage["imagefile"];?>" alt="avatar">
            <?php
                  }
              } 
            ?>   
                    <h3 class="company"><?php echo  $_SESSION["company"]; ?></h3>
                    <p class="admin">Admin</p>
                </div>
                <ul>
                    <li>
                        <a  href="home.php">
                            <span><i class="bi bi-house-fill" id="icons"></i></span>
                            <span>Home</span>
                        </a>
                        <li>
                            <a href="pagination.php" >
                                <span><i class="bi bi-speedometer" id="icons"></i></span>
                                <span>Dashboard</span>
                            </a>
                        <li>
                        <a  href="settings.php">
                                    <span><i class="bi bi-gear" id="icons"></i></span>
                                    <span>Settings</span>
                            </a>
                        <li>
                            
                        <li>
                            <a href="login-page.html" >
                                <span><i class="bi bi-box-arrow-in-left" id="icons"></i></span>
                                <span>Logout</span>
                            </a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="background">
            <div class="details">
                <a  href="#" class="email"><i class="bi bi-envelope-fill"></i> elishadamu97@gmail.com</a>
                <p class="line">|</p>
                <a class="phoneNumber" href="#"><i class="bi bi-telephone-fill"></i>+2347067206984</a>
                
                <a href="#" class="logout">Logout</a>
            </div>
            
            <div class="tasks">
                
                <div class="monthly">
                   <a href="monthly.php" class="hover">
                    <p class="earnings">EARNINGS MONTHLY</p>
                    <p class="currency" id="month-total"></p>
                <div class="calendar"> 
                    <i class="bi bi-calendar-fill"></i>
                </div>
                   </a>
                </div>
                <div class="annual">
                    <a href="#" class="hover">
                        <p class="earnings-1">EARNINGS YEARLY</p>
                    <p class="currency-1" id="year-total" ></p>
                    <div class="calendar"> 
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    </a>
                </div>
                <div class="completed">
                    <a href="#" class="hover">
                        <p class="earnings-2">COMPLETED TASKS</p>
                    <p class="score" id="score"></p>
                    <div class="completed-1"> 
                        <i class="bi bi-clipboard2-check-fill"></i>
                    </div>
                    </a>
                </div>
                <div class="pending">
                   <a href="searchresult.php" class="hover">
                    <p class="earnings-3">Search customer</p>
                    <p class="score-1">0</p>
                    <div class="pending-1"> 
                        <i class="bi bi-clipboard-minus-fill"></i>
                    </div>
                   </a>
                </div>
            </div>
            
           
            <div class="table-1">
                <table style="width: 1000px;">
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>PHONE NUMBER</th>
                        <th>DECODER TYPE</th>
                        <th>PRICES</th>
                        <th>SMARTCARD NUMBER</th>
                        <th>ADDRESS</th>
                        <th>MONTH</th>
                        <th>DATE</th>
                        <th>COMPLETED</th>
                        
                    </tr>
                    
                        <tr>
                            <?php

                           if(mysqli_num_rows($result)> 0){
                            while($row = mysqli_fetch_assoc($result))
                            {
                            ?>
                            <td><?php echo $row["ID"] ?></td>
                            <td><?php echo $row["name"] ?></td>
                            <td><?php echo $row["phone_num"] ?></td>
                            <td><?php echo $row["decoder_type"] ?></td>
                            <td><?php echo $row["price"] ?></td>
                            <td><?php echo $row["smartcard_num"] ?></td>
                            <td><?php echo $row["address"] ?></td>
                            <td><?php echo $row["month"] ?></td>
                            <td><?php echo $row["date_recharged"] ?></td>
                            <td><button class="btn btn-success btn-sm">Completed</button></td>                        
                        </tr>
                        <?php
                        }
                           }
                    
                         else{
                                echo  "<h3> No record was found in database</h3>";
                            }
                        ?>
                    
                </table>
            </div>
            
        </div>
            <script src="dashboard.js"></script>
    </body>
</html>

            