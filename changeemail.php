<?php
    include_once "configure.php";
    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login-page.html");
        exit;
    }
    else{
        $now = time(); // Checking the time now when home page starts.
    
        if ($now > $_SESSION['expire']) {
            echo "your login time has expired";
            session_destroy();
           
        }
    }
    if(isset($_POST["reset"])){
    $userid = $_SESSION["userid"];
    $currentemail = $_POST["currentemail"];
    $newemail = $_POST["newemail"];
    $emailindatabase = mysqli_query($con, "SELECT email FROM customers_registered WHERE ID = '$userid'");
    $row = mysqli_fetch_assoc($emailindatabase);
        if($row["email"] == $currentemail){
            $sql = mysqli_query($con, "UPDATE customers_registered SET email = '$newemail' WHERE ID = '$userid'");

           
        } 
        else{
            $_SESSION["error"] = "Current email doesn't match";
            echo $_SESSION["error"];
        }  
    }


?>

<!DOCTYPE html>
<head>
    <title>Change password</title>
    <meta lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="bootstrap.css">
    <link rel="stylesheet" type="text/css" href="changeemail.css">
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
                       
                            <a href="logout.php" >
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
                
                <a href="logout.php" class="logout">Logout</a>
            </div> 
        </div>
        <div class="email-container">
            <h4 class="email-title">Change your email</h4>
            <div class="flex-container">
                <div class="email-req">
               
                <?php
                if(isset($sql)){
                    echo "<h3 style='color:green;'> Email has been <br> updated successfully</h3>";
                }
            ?>
                </div>
               
                <div class="form-container">
                    <form action="changeemail.php" method="post">
                        <label for="current"><b>Current Email address</b></label>
                        <input class="form-control" type="email" name="currentemail" id="currentemail" placeholder="Enter current email address" title="Email must be valid" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"required >
                        <br>
                        <label for="current"><b>New Email address</b></label>
                        <input class="form-control" type="email" name="newemail" id="newemail" placeholder="Enter new email address" title="Email must be valid" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"required >
                        <br>
                       
                        <div class="button-email">
                            <button name="reset" class="btn btn-danger">RESET</button>
                            <button  class="btn btn-primary"><a href="settings.php" class="cancel-button">CANCEL</a></button>
                        </div>     
                        
                    </form>                
                </div>
        </div>
            <br>
        </div>
        
            
    </body>
    <body>
       
    </body>
</html>