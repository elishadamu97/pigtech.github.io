<?php
include("configure.php");
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

?>
<!DOCTYPE html>
<head>
    <title>Settings page</title>
    <meta lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="settings.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
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
                            <a  href="pagination.php" >
                                <span><i class="bi bi-speedometer" id="icons"></i></span>
                                <span>Dashboard</span>
                            </a>
                        <li>
                            <a  href="settings.php" class="active">
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
        
        <div class="settings-container">
                <h3 class="settings-title">Settings</h3>
      
            <br>
            <div class="form-container">
                <form action="settings.php" method="post">
                    <div class="settings-move">
                        <div class="settings-move1">
                            <label for="name"><b>Name</b></label>
                            <input class="form-control" type="text" name="name" value="<?php echo $_SESSION["customername"]; ?>" id="name" disabled>
                            <br>
                            <label for="company"><b>Company Name</b></label>
                            <input  class="form-control" type="text" value="<?php echo  $_SESSION["company"]; ?>" name="company" id="company" disabled>
                            <br>
                        </div>
                        <div class="settings-move2">
                            <label for="image"><b>Change admin picture</b></label>
                            <input type="file" name="fileimage" id="image">
                            <br>
                            <button type="submit" class="btn btn-secondary">Update</button>
                        </div>
                    </div>
                </form>

            </div>
            <br>
            <br>
            <hr class="settings-line">
            <br>
        
            <h5 class="main-email"><b>Email address</b></h5>
           
            <div class="settings-email">
            <h6>Your email address is <b><?php echo  $_SESSION["customeremail"]; ?></b></h6>
            <button class="btn btn-info"><a href="changeemail.php" class="password-anchor">Change Email</a></button>
            </div>
       
            <br>
            <hr class="settings-line">
            <br>
            <br>
            <div class="setting-password">
                <h5><b>Password</b></h5>
                <button class="btn btn-info"><a href="changepassword.php" class="password-anchor">Change password</a></button>
            </div>
            <br>
        </div>
            
    </body>
    <body>
       
    </body>
</html>