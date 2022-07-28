<?php
  if(isset($_POST["submit"])){
   
  session_start();
  // declaring the session mechanism
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
      header("location:home.php");
  }
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "customer_details";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$email = $_REQUEST["email"];
$password = $_REQUEST["password"];

    $sql = "SELECT * FROM customers_registered WHERE email = '$email' AND password = '$password' limit 1 ";
    
    $result = mysqli_query($conn, $sql);

  if(mysqli_num_rows($result)>0){
    session_start();
        $_SESSION["loggedin"] = true;
        $_SESSION["email"] = $email; 
        $_SESSION["start"] = time();
        $_SESSION["expire"] =  $_SESSION['start'] + (3000);
        header("location:home.php");
        while($row = mysqli_fetch_assoc($result)){
          $_SESSION["userid"] = $row["ID"];
          $_SESSION["imagefile"] = $row["imagefile"];
          $_SESSION["customername"] = $row["name"];
          $_SESSION["customeremail"] = $row["email"];
          $emailrow =  $row["email"]; 
          $_SESSION["company"] = $row["company"];
        }
        
  }
  else{
    $_SESSION["error"] = "enter your correct details";
}
$conn->close();

  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="bootstrap.css">
    <link rel="stylesheet" href="login-page.css">
</head>
<body>

    <div class="content-main">
        <h1 class="header">Login  </h1>
        <hr class="line">
        <br>
        <div class="header-1">
            <h3>Signin to an existing account</h3>
        </div>
        <div class="content">
            <div class="content-signup">
                <form action="login-page.php" method="post">
                    <div class="wrapper">
                        <label for="email"><b>Email:</b></label>
                        <input type="email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                         title="login with a valid email" class="form-control" id="email" 
                         autocomplete="new-password"  placeholder="e.g example123@gmail.com"name="email"   required aria-required="true">
                         
                         <b id="email-validation">
                            <?php 
                                 if(isset($_POST["submit"])){
                                    while($row1 = mysqli_fetch_assoc($result)){
                                    if($_POST["email"] !== $row1["email"]){
                                       echo "<h4>Email does not exist</h4>";
                                   }
                               }
                            }  ?>
                         </b>
                        <br>
                        <br>
                        <label for="password"><b>Password:</b></label>
                        <div class="input-container">
                            <input type="password" class="form-control" aria-autocomplete="both" autocomplete="on" name="password" id="password" autocomplete="current-password" placeholder="Insert a password"
                            title="Password must be 8 characters long" pattern="[0-9]{6}[a-zA-Z]{2}" required>
                            <b id="password-validation"></b>  
                            <i class="bi bi-eye-slash" style="color:rgb(8, 126, 194) ;" id="toggle" onclick="toggle()"></i>
                        </div>
                   
                      <br>
                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
                <br>
                        <div class="span">
                            <span>
                                <p> Need an account? <b><a href="signup1.php">Signup</a></b></p>
                                
                            </span>
                        </div>
            </div>
            <div class="content-image">
                <img class="image" src="Ouriginal_Header_Element-1.png" alt="Signup">
            </div>  
        </div>
    </div>
    
    
    <script>
        var state = false;
        var display = document.getElementById("password");
        var displayCon = document.getElementById("con_password");
        var color = document.getElementById("toggle");
        var confirm_color = document.getElementById("toggleCon");
        function toggle(){
           if(state){
            display.setAttribute("type", "password")
            state = false;
            color.classList.toggle("bi-eye")
           }

           else{
               display.setAttribute("type", "text")
               
               color.classList.toggle("bi-eye")
               state = true;
           }
        }
        var email = document.getElementById("email").value;
        var emailborder = document.getElementById("email");
        if(email == ""){
            emailborder.style.border = "1px solid white"
        }
        
    </script>
</body>
</html>