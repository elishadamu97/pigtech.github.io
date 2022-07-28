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

 include "configure.php";
    $userid = $_SESSION["userid"];
    $sql = "SELECT  *  FROM customers_record WHERE foreignkey = $userid";
    $result = mysqli_query($con, $sql);
    $fetcharray = array();    
?>

<!DOCTYPE html>
<head>
    <title>Dashboard page</title>
    <meta lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="dashboard.css">
    <link rel="stylesheet" type="text/css" href="monthly.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" type="text/css" href="bootstrap.css">
</head>
    <body>
       
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
                   <a href="" class="hover">
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
                    <p class="currency-1" id="year-total"></p>
                    <div class="calendar"> 
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    </a>
                </div>
                <div class="completed">
                    <a href="completed.php" class="hover">
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
            
            <div id="myChart" style="width:100%; width:1000px; height:500px;">
            </div>
          </div>
          <script>

              google.charts.load('current',{'packages':['corechart']});
              google.charts.setOnLoadCallback(drawChart);

              function drawChart() {
                  
              // Set Data
              var data = google.visualization.arrayToDataTable([
                ['Month', 'Price'],
     
                <?php
                
                  while($row = mysqli_fetch_array($result)){
                      echo "['".$row["month"]."' , ".$row["price"]."],";
                  }
                              
                ?>
            
              ]);
              // Set Options
              var options = {
                title: 'Prices vs month of subscription',
                hAxis: {title: 'Month of subscription'},
                vAxis: {title: 'Price of subscription'},
                legend: 'none'
              };
              // Draw
              var chart = new google.visualization.LineChart(document.getElementById('myChart'));
              chart.draw(data, options);

              }
          </script>
          <script>
              var xhr = new XMLHttpRequest();
                xhr.open("GET", "monthly1.php", true);
                xhr.onload = function(){
                    const display = JSON.parse(this.responseText)
                    var recordprice = "";
                    var recordscore = "";
                                for(var i = 0; i < display.length; i++){     
                                recordprice += display[i].price;
                                recordscore += display[i].ID;       
                                }
                                
                    document.getElementById("month-total").innerHTML = recordprice
                    document.getElementById("year-total").innerHTML = recordprice*12
                    document.getElementById("score").innerHTML = recordscore
                }
                xhr.send()

          </script>
        </div>
        
    </body>
</html>