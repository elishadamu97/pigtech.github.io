<?php
session_start();
    include_once("configure.php"); 
    if(isset($_POST["input"])){
        $search = $_POST["input"];
        $userid = $_SESSION["userid"];
        $result = mysqli_query($con, "SELECT * FROM customers_record WHERE foreignkey = $userid AND (name LIKE '{$search}%' OR phone_num LIKE '{$search}%' OR  decoder_type LIKE '{$search}%' OR  price LIKE '{$search}%' OR smartcard_num LIKE '{$search}%')");
        if(mysqli_num_rows($result)> 0){ ?>
          
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
                                while($row = mysqli_fetch_assoc($result)){?>
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
                            ?>
                    </table>
        <?php 
       
    }
    else{
        echo "<h5> <b>$search</b> not in record</h5>";
    }
 
}
    ?>
  
       