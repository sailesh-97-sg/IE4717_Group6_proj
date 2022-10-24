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
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/general_style.css">
    <link rel="stylesheet" href="../css/profile_php.css">
        <style>
            .body {
                margin: auto;
                background-color: rgb(195, 195, 195);
                width: 80%;
                margin-top: 0px;
                padding: 2px 20px;
                border-radius: 20px; 
                align-content: start;
                min-width: 900px;
            }
            body {margin: 0px;}
            .body img, .body .login {margin: auto; padding: 0% 35%;
            }
            .form_input {
                margin-left: 50px;
                border-radius: 20px;
                width: 300px;
                padding-left: 10px;
                height: 30px;
                border-width: 3px;
                background-color: rgb(243, 243, 243);
            }
            #loginsubmit {
                width: 200px;
                border-radius: 20px;
                background-color: lightblue;
                margin-left: 100px;
            }
            p {
                margin-left: 100px;
            }
        </style>
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
                            <div id="nav_bar"> 
                                <ul>
                                    <li><form action="" method="POST" id="acc_detail_form">
                                        <input type="radio" id="acc_detail" name="profile_radio" value="account_detail" onchange="get_accInfo()" ><label for="acc_detail">Account Details</label>
                                    </form></li>
                                    <li><form action="" method="POST" id="address_form">
                                        <input type="radio" id="address" name="profile_radio" value="address_detail" onchange="get_address()" ><label for="address">Address</label>
                                    </form></li>
                                    <li><form action="" method="POST" id="orders_form">
                                        <input type="radio" id="orders" name="profile_radio" value="orders" onchange="get_orders()" ><label for="orders">Orders</label>
                                    </form></li>
                                </ul> 
                            </div>
                            <div id="profile_content">
                                <?php
                                    if(isset($_REQUEST['profile_radio'])){
                                        $radio_btn = $_REQUEST['profile_radio'];
                                        if($radio_btn == 'account_detail'){
                                            echo "ACCOUNT DETAIL";
                                        } elseif($radio_btn == 'address_detail'){
                                            echo "ADDRESS";
                                        } elseif($radio_btn == 'orders'){
                                            echo "ORDERS";
                                        }
                                    }
                                ?>
                            </div>
                            <a href = "logout.php">Log Out </a>
                        </div>
                    <?php
                    } else {
                        echo 'Please go back to Login Page';
                    }
                } else {
                    if (isset($username))
                    {
                        echo '<script>alert("Your username or password is invalid!\nPlease log in again.");</script>';
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
                    <p>Forgot Password? <a href="">Reset Here</a></p>
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
</script>