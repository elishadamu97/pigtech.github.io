<?php
if(isset($_POST["submit"])){
  
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
    
    if(isset($_POST["submit"])){
      $name = $_POST["username"];
      $email = $_POST["email"];
      $password = $_POST["password"];
      $confirm_pass = $_POST["confirm_pass"];
      $company = $_POST["company"];
      $imagefile = $_FILES["image"]["name"];
      $imagetmp = $_FILES["image"]["tmp_name"];
      $imagefolder = "./image/".  $imagefile;
      $sqli = "INSERT INTO customers_registered(name, email, password, con_password, company, imagefile) VALUES('$name', '$email', '$password', '$confirm_pass', '$company', '$imagefile')";
      $result = mysqli_query($conn, $sqli);
      if( move_uploaded_file($imagetmp, $imagefolder)){
        header("location: login-page.php");
      }
      else{
        echo "<h3> Image failed to upload</h3>";
      }
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
    <link rel="stylesheet" href="signup-page.css">
</head>
<body>

    <div class="content-main">
        <h1 class="header">Signup page</h1>
        <hr class="line">
        <br>
        <div class="header-1">
            <h3>Fill the form to  create an account </h3>
        </div>
        <div class="content">
            <div class="content-image">
                <img class="image" src="Login.jpg" alt="Signup">
            </div>
            <div class="content-signup">
                
                <form action="signup1.php" method="post"  enctype="multipart/form-data">
                    <div class="wrapper">
                        <label for="username"><b>Name:</b></label>
                        <input  type="text" class="form-control" id="username" name="username" autocomplete="on" placeholder="Insert a username" required aria-required="true">
                        <br>
                        <label for="email"><b>Email:</b></label>
                        <input type="email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                        title="login with a valid email" class="form-control" id="email" 
                        autocomplete="new-password"  placeholder="e.g example123@gmail.com"name="email"  required aria-required="true">
                        
                        <br>
                        <label for="password"><b>Password:</b></label>
                       <div class="input-container">
                        <input type="password" class="form-control" name="password" id="password" autocomplete="on" placeholder="Insert a password"
                        title="Password must be 8 characters long" pattern="[0-9]{6}[a-zA-Z]{2}" required>
                        <i class="bi bi-eye-slash" style="color:rgb(8, 126, 194) ;" id="toggle" onclick="toggle()"></i>
                       </div>
                        <br>
                        <label for="con_password"><b>Confirm Password:</b></label>
                        <div class="input-container">
                            <input type="password" style="width: 100%" class="form-control" autocomplete="on" name="confirm_pass" id="con_password" placeholder="Insert a password"
                        title="Password must be 8 characters long" pattern="[0-9]{6}[a-zA-Z]{2}" required>
                        <i class="bi bi-eye-slash" style="color:rgb(8, 126, 194) " id="toggleCon" onclick="toggleCon()"></i>
                        </div>
                        <br>
                        <label for="company"><b>Company's Name:</b></label>
                        <input type="text" class="form-control" id="company" name="company" autocomplete="on" placeholder="Insert company's name" required aria-required="true">
                        <br>
                        <label for="imagelabel"><b>Upload your profile picture</b></label>
                        <input style="color:#0275d8;" type="file" name="image" id="imagelabel">
                        <br>
                        <br>
                        <button type="submit" name="submit" class="btn btn-success">Submit</button>
                        
                    </div>
                </form>
                <br>
                        <div class="span">
                            <span>
                                <p>Already signed up? <b><a href="login-page.php">login</a></b></p>
                                
                            </span>
                        </div>
            </div>
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
        function toggleCon(){
           if(state){
            displayCon.setAttribute("type", "password")
            state = false;
            confirm_color.classList.toggle("bi-eye");
           }
           else{
               displayCon.setAttribute("type", "text")
               confirm_color.classList.toggle("bi-eye");
               state = true;
           }
        }  
    </script>
    

</body>
</html>
   


