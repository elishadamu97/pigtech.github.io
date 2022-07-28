<?php
    include_once "configure.php";
    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login-page.php");
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
  
    $currentpassword = $_POST["currentpassword"];
    $newpassword = $_POST["newpassword"];
    $confirmpassword = $_POST["confirmpassword"];
        $sql = mysqli_query($con, "UPDATE customers_registered SET password = '$newpassword' WHERE ID = '$userid'");
        
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
    <link rel="stylesheet" type="text/css" href="changepassword.css">
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
        <div class="password-container">
            <h4 class="password-title">Change your password</h4>
           <div class="flex-container">
                <div class="password-req">
                    <h5><b>Password must contain</b></h5>
                    <p class="param-password">At least 2 letters</p>
                    <p class="param-password">Must contain 6 numbers</p>
                    <p class="param-password">Must start with a number</p>
                    <p class="param-password">Must be 8 characters</p>
                    <?php
                        if(isset($sql)){
                            echo "<h3 style='color:green;'> Password has been <br> updated successfully</h3>";
                        }
                    ?>
                </div>
                <div class="form-container">
                    <form action="changepassword.php" method="post">
                        <label for="current"><b>Current password</b></label>
                        <input class="form-control" type="password" name="currentpassword" id="currentpassword"  title="Password must be 8 characters long" pattern="[0-9]{6}[a-zA-Z]{2}"required >
                        <br>
                        <label for="newpassword"><b>New password</b></label>
                        <input class="form-control" type="password" name="newpassword" id="newpassword"  title="Password must be 8 characters long" pattern="[0-9]{6}[a-zA-Z]{2}" required>
                        <br>
                        <label for="confirmpassword"><b>Confirm password</b></label>
                        <input class="form-control" type="password" name="confirmpassword" id="confirmpassword" title="Password must be 8 characters long" pattern="[0-9]{6}[a-zA-Z]{2}"required>
                        <br>
                        <div class="button-password">
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