<?php //login.php
session_start();

if(isset($_REQUEST['username']) && isset($_REQUEST['password']))
{
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    include "dbconnect.php"; // connect to database

    //hash the password
    $password = md5($password);
    $query = "select * from users where username = '$username' and password = '$password'";
    $result = $dbcnx->query($query);
    if($result->num_rows > 0)
    {
        $_SESSION['valid_user'] = $username;
    }
    $dbcnx->close();
    if(!empty($_SESSION['valid_user'])){
        echo '<script>alert("You are logged in as '.$_SESSION['valid_user'].'");</script>';
    }
}
if(isset($_REQUEST['new_address'])){
    if(!empty($_REQUEST['new_address'])){
        $new_address = $_REQUEST['new_address'];
        include "dbconnect.php";

        $query = "update users set address = '$new_address' where username = '".$_SESSION['valid_user']."'";
        $result = $dbcnx->query($query);
        //$num_rows = $result->num_rows;
    
        if($dbcnx->errno){
            echo "Could not update user's table: ".$dbcnx->error;
            $dbcnx->close();
            exit;
        }
        $dbcnx->close();
    }
}
if(isset($_REQUEST['new_postal'])){
    if(!empty($_REQUEST['new_postal'])){
        $new_postal = $_REQUEST['new_postal'];
        include "dbconnect.php";

        $query = "update users set postal = '$new_postal' where username = '".$_SESSION['valid_user']."'";
        $result = $dbcnx->query($query);
        //$num_rows = $result->num_rows;
    
        if($dbcnx->errno){
            echo "Could not update user's table: ".$dbcnx->error;
            $dbcnx->close();
            exit;
        }
        $dbcnx->close();
    }
}
if(isset($_REQUEST['new_contact'])){
    if(!empty($_REQUEST['new_contact'])){
        $new_contact = $_REQUEST['new_contact'];
        include "dbconnect.php";

        $query = "update users set contact = '$new_contact' where username = '".$_SESSION['valid_user']."'";
        $result = $dbcnx->query($query);
        //$num_rows = $result->num_rows;
    
        if($dbcnx->errno){
            echo "Could not update user's table: ".$dbcnx->error;
            $dbcnx->close();
            exit;
        }
        $dbcnx->close();
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/general_style.css">
        <link rel="stylesheet" href="../css/profile_php.css">
        <link rel="stylesheet" href="../css/login.css">
        <script type="text/javascript" src="../JS/payment_form_validator.js"></script>
        <title>Login</title>
    </head>
    <body>
    <div id="wrapper">
        <?php include "header.php"?>
        <div class="body">
            <!-- https://www.freepik.com/free-vector/sign-up-concept-illustration_20602851.htm#query=signup&position=7&from_view=keyword -->
            <?php
                if(isset($_SESSION['valid_user']))
                {
                    $olduser = $_SESSION['valid_user'];

                    if(!empty($olduser))
                    {?>
                        <div class="profile_body">
                            <div id="edit_profile">
                                <button class="openbutton" onclick="openForm()"><strong>Edit Profile</strong></button>
                            </div>
                            <div class="form-popup" id="myForm">
                                <form action="login.php" method="POST" class="form-container">
                                    <label for="new_address"><b>Address</b></label>
                                    <textarea placeholder="Enter Address" class="new_profile" name="new_address" rows="2" maxlength="60" wrap="hard"></textarea>

                                    <label for="new_postal"><b>Postal Code</b></label>
                                    <input type="text" placeholder="Enter Postal Code" class="new_profile" name="new_postal">

                                    <label for="new_contact"><b>Contact Number</b></label>
                                    <input type="text" placeholder="Enter Contact Number" class="new_profile" name="new_contact">

                                    <button type="submit" class="btn">Submit</button>
                                    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
                                </form>
                            </div>
                                <?php include "dbconnect.php";?>
                                <div id="acc_detail">
                                    <?php
                                        $query = "select email, contact from users where username = '".$_SESSION['valid_user']."'";
                                        $result = $dbcnx->query($query);
                                        $num_rows = $result->num_rows;
                                        if($num_rows == 0){
                                            echo "There was an error retrieving data from database!";
                                            exit;
                                            $dbcnx->close();
                                        } else {
                                            echo "<h1>Account Details</h1>";
                                            $row = $result->fetch_assoc();
                                            echo '<table border = "0" id="name_table">';
                                            echo '<tr><td><strong>Username</strong></td><td>'.$_SESSION['valid_user'].'</td></tr>';
                                            echo '<tr><td><strong>Email</strong></td><td>'.$row['email'].'</td></tr>';
                                            echo '<tr><td><strong>Contact Number</strong></td><td>'.$row['contact'].'</td></tr>';
                                            echo '</table>';
                                        }
                                        echo '<br><br>';
                                    ?>
                                </div>
                                <div id="address_detail">
                                    <?php
                                        $query = "select address, postal from users where username = '".$_SESSION['valid_user']."'";
                                        $result = $dbcnx->query($query);
                                        $num_rows = $result->num_rows;
                                        if($num_rows == 0){
                                            echo "There was an error retrieving data from database!";
                                            $dbcnx->close();
                                            exit;
                                        } else {
                                            echo "<h1>Address Details</h1>";
                                            $row = $result->fetch_assoc();
                                            echo '<table border = "0" id="address_table">';
                                            echo '<tr><td><strong>Address: </strong></td><td>'.$row['address'].'</td></tr>';
                                            echo '<tr><td><strong>Postal: </strong></td><td>'.$row['postal'].'</td></tr>';
                                            echo '</table>';
                                        }
                                        echo '<br><br>';
                                    ?>
                                </div>
                                <div id="order_detail">
                                    <h1>Order Details</h1>
                                    <table border="0" class="order_table">
                                        <tr><th style="width: 15%;">Order Ref No</th><th style="width: 20%;">Types of Products</th><th style="width: 10%;">Quantity</th><th style="width: 13%;">Total Price</th></tr>
                                    </table>
                                    <div style="height: 200px; overflow-x: hidden; overflow-y:auto;">
                                    <table border="0" class="order_table">
                                        <?php
                                            $query = "select orderid, total_qty, total_price, products from orders where username = '".$_SESSION['valid_user']."'";
                                            $result = $dbcnx->query($query);
                                            $num_rows = $result->num_rows;
                                            if($num_rows < 0){
                                                echo "There was an error retrieving data from database!";
                                                $dbcnx->close();
                                                exit;
                                            } else if($num_rows > 0){
                                                for($i = 0; $i < $num_rows; $i++){
                                                    $row = $result->fetch_assoc();
                                                    echo '<tr><td style="width: 15%;">'.$row['orderid'].'</td><td style="width: 20%;">'.$row['products'].'</td><td style="width: 10%;">'.$row['total_qty'].'</td><td style="width: 13%;">'.$row['total_price'].'</td></tr>';
                                                }
                                                echo '</table></div>';
                                                //for($i = 0; $i < count($row); $i++){
                                            } else if($num_rows == 0){
                                                echo '<tr><td style="width: 15%;">-</td><td style="width: 20%;">-</td><td style="width: 10%;">-</td><td style="width: 13%;">-</td></tr>';
                                                echo '</table></div>';
                                            }
                                            echo '<br><br>';
                                        ?>
                                </div>
                                <?php
                                    $dbcnx->close();
                                ?>
                            <div id="logout">
                                <button style="border-radius: 10px; font-size: 20px; color:rgb(68,0,102); cursor:pointer;" onclick="window.location.replace('logout.php');"><b>Log Out</b></button>
                            </div>
                        </div>
                    <?php
                    } else {
                        echo 'Please go back to Login Page';
                    }
                } else {
                    if (isset($username))
                    {
                        echo '<script>alert("Your username or password is incorrect!\nPlease log in again.");</script>';
                    } else {
                        //echo '<script>alert("Please Log in");</script>';
                    }
                ?>
                <img src="../assets/login.png" alt="asd" height="400" width="400">
                <div class="login">
                    <form action="login.php" method="POST">
                        <input type="text" class = "form_input" placeholder="Username" name = "username"required>
                        <br>
                        <br>
                        <input type="password" class = "form_input" placeholder="Password" name = "password" required>
                        <br>
                        <br>
                        <input type="submit" id = "loginsubmit" value="Log In">
                    </form>
                    <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
                </div>
                <?php
                }
            ?>
        </div>
        <div id="footer">
            <script src="../JS/footer.js"></script>
        </div>
    </div>
    </body>
</html>
<script>
    var edit_profile = document.getElementsByClassName('new_profile');

    function get_accInfo(){
        if(document.getElementById('acc_detail').checked == true){
            document.getElementById('acc_detail_form').submit();
        }
    }
    function get_address(){
        if(document.getElementById('address').checked == true){
            document.getElementById('address_form').submit();
        }
    }
    function get_orders(){
        if(document.getElementById('orders').checked == true){
            document.getElementById('orders_form').submit();
        }
    }

    function openForm() {
    document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
    document.getElementById("myForm").style.display = "none";
    }

    edit_profile[0].addEventListener("change", chk_address, false);
    edit_profile[1].addEventListener("change", chk_postal_code, false);
    edit_profile[2].addEventListener("change", chk_contact_no, false);
</script>