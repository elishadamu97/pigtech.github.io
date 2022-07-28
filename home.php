<?php
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

 include "configure.php";
 if(isset($_POST["submit"])){
    $customer = $_POST["name"];
    $phone_num = $_POST["phone"];
    $decoder_type = $_POST["decoder_type"];
    $price = $_POST["price"];
    $smart_num = $_POST["smartcard"];
    $address = $_POST["address"];
    $monthof = $_POST["monthof"];
    $foreign_key = $_SESSION["userid"];
    $sql = "INSERT INTO customers_record (name, phone_num, decoder_type, price, smartcard_num, address, month, foreignkey) VALUES('$customer', '$phone_num','$decoder_type', '$price', '$smart_num', '$address', '$monthof', '$foreign_key') limit 10";
    $result = mysqli_query($con, $sql);  
 }
?>
<!DOCTYPE html>
    <head>
        <title>Home page</title>
        <meta lang="en">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="home.css">
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
                        <a  href="#" class="active">
                            <span><i class="bi bi-house-fill" id="icons"></i></span>
                            <span>Home</span>
                        </a>
                        <li>
                            <a  href="pagination.php" >
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
                            <a href="logout.php" >
                                <span><i class="bi bi-box-arrow-in-left" id="icons"></i></span>
                                <span>Logout</span>
                            </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="details">
            <a  href="#" class="email"><i class="bi bi-envelope-fill"></i> elishadamu97@gmail.com</a>
            <p class="line">|</p>
            <a class="phoneNumber" href="#"><i class="bi bi-telephone-fill"></i>+2347067206984</a>
            
            <a href="logout.php" class="logout">Logout</a>
        </div>
        <div class="content-details">
            <div class="content-1">
                <h1 class="details-1">Recharge Details</h1>
                <div class="schedule">
                    <i class="bi bi-clock"></i>
                    <p> Mon - Sat: 8:00am - 8:00pm Sunday CLOSED</p>
                </div>
                <div class="location">
                    <i class="bi bi-geo-alt"></i>
                    <p> Binchi Road, Plateau state, Jos Nigeria</p>
                </div>
            </div>
            <div class="form">
                <form action="home.php" method="POST">
                    <br>
                    <br>
                    <div class="form-floating mb-1 form-1">
                        
                        <input type="text" class="form-control" title="Insert a valid name" name="name" id="floatingInput" placeholder="Place customer name here"  required>
                        <label for="floatingInput">Name</label>
                    </div>   
                    <br><br>          
                    <div class="form-floating mb-1 form-2">
                        
                        <input  type="tel" maxlength="11"   class="form-control" name="phone" id="floatingInput phone" placeholder="Place customer phone number here"  required>
                        <label for="floatingInput">Phone number</label>
                    </div>
                    <br><br>
                    <div class="form-3">
                       <div item-1>
                            <select name="decoder_type" class="form-select" id="selected" required>
                                <option  value="">Select the decoder</option>
                                <option  value="DSTV">DSTV</option>
                                <option  value="GOTV">GOTV</option>
                                <option  value="Startimes">Startimes</option>
                            </select>
                       </div>
                            <select  name="price"  class="form-select" id="select-dstv" required >
                                <optgroup label="Select DSTV prices">
                                    <option   id="yanga" value="2950">Yanga bouquet- 2950</option>
                                    <option   id="comfam" value="5300">Comfam bouquet-5300</option>
                                    <option   id="compact" value="9000">Compact-9000</option>
                                    <option   id="compact-plus" value="14250">Compact-plus- 14200</option>
                                    <option   id="premium" value="21000">Premium- 21000</option>
                                </optgroup>
                                <optgroup label="Select GOTV prices">
                                    <option   id="jinjam" value="2000">Jinja bouquet-2000</option>
                                    <option   id="jolli" value="2800">Jolli bouquet-2800</option>
                                    <option   id="max" value="4150">Max bouquet-4150</option>
                                    <option   id="supa" value="5500">Supa bouquet-5500</option>
                                </optgroup>
                                <optgroup label="Select Startimes prices">
                                    <option   id="nova" value="900">Nova bouquet- 900</option>
                                    <option   id="basic" value="1700">Basic bouquet- 1700</option>
                                    <option   id="smart" value="2200">Smart bouquet- 2200</option>
                                    <option   id="classic" value="2500">Classic bouquet- 2500</option>
                                    <option   id="super" value="4200">Super bouquet- 4200</option>
                                </optgroup>
                            </select>
                        <br>
                        <div class="form-floating mb-1">                                    
                            <input type="tel" maxlength="11" name="smartcard"   class="form-control" id="floatingInput smartcard" placeholder="Place customer smartcard number here"  required>
                            <label for="floatingInput"> Smartcard number</label>
                        </div>
                    </div>
                    <br><br>
                    <div class="form-floating  form-4">
                        <input type="text"  class="form-control" name="address" id="floatingInput address" placeholder="Place customer address here"  required>
                        <label  for="floatingInput" >Address</label>
                        <input class="form-control" name="monthof" placeholder="select month" type="date" >
                    </div>
                    <br>
                    <br>
                   <div class="tasks">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="completed" type="checkbox" id="inlineCheckbox1" value="option1">
                        <label class="form-check-label" for="inlineCheckbox1"><span class="space">Completed tasks</span></label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" name="pending" type="checkbox" id="inlineCheckbox2" value="option2">
                        <label class="form-check-label" for="inlineCheckbox2"><span class="space">Pending tasks</span></label>
                      </div>
                   </div>
                    <br>
                    <br>
                    <input type="submit" name="submit" class="btn btn-danger" value="Save"  id="button">
            </form>
            </div>
        </div>
      
        
    </body>
</html>
