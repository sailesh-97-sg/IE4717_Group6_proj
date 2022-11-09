<?php
    session_start();
    if(isset($_SESSION['valid_user'])){
        // to redirect to profile page if user happen to reach here for some reasons
        echo '<script>alert("You are already logged in!");</script>';
        echo '<script>window.location.replace("login.php");</script>';
    }
    if(isset($_REQUEST['username']) && isset($_REQUEST['email']) && isset($_REQUEST['password']) && isset($_REQUEST['password2'])){
        include "dbconnect.php";
        $username = $_REQUEST['username'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        $password2 = $_REQUEST['password2'];

        if($password != $password2){
            echo '<script>alert("Passwords do not match!");</script>';
            $dbcnx->close();
            echo '<script>window.location.replace("'.$_SERVER['PHP_SELF'].'");</script>';
        }
        $password = md5($password);

        $query = "select * from users where username = '$username'";
        $result = $dbcnx->query($query);
        if($result->num_rows > 0)
        {
            echo '<script>alert("'.$username.' already exists.");</script>';
            $dbcnx->close();
            echo '<script>window.location.replace("'.$_SERVER['PHP_SELF'].'");</script>';
        }
        $query = "INSERT INTO users(username, password, email) values ('$username', '$password', '$email')";
        $result = $dbcnx->query($query);
        if(!$result)
        {
            echo '<script>alert("Registration Failed!");</script>';
            $dbcnx->close();
            echo '<script>window.location.replace("'.$_SERVER['PHP_SELF'].'");</script>';
        } else {
            echo '<script>alert("Welcome '.$username.'");</script>';
            $dbcnx->close();
            //echo '<script>window.location.replace("/Design_Project/IE4717_Group6_proj/src/login.php");</script>';
            echo '<script>window.location.replace("login.php");</script>';
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/general_style.css">
        <link rel="stylesheet" href="../css/signup.css">
        <title>Sign Up</title>
    </head>
    <body>
        <div id="wrapper">
            <?php include "header.php"?>
            <div class="body">
                <!-- https://www.freepik.com/free-vector/sign-up-concept-illustration_20602851.htm#query=signup&position=7&from_view=keyword -->
                <img src="../assets/signup.png" alt="asd" height="300" width="300">
                <div class="signup">
                    <form action="signup.php" method="POST" id="signup_form">
                        <input type="text" class="signup_input" placeholder="Username" name="username" required>
                        <br><br>
                        <input type="email" class="signup_input" placeholder="Email" name="email" required>
                        <br><br>
                        <input type="password"  class="signup_input" placeholder="Password" name="password" required>
                        <br><br>
                        <input type="password"  class="signup_input" placeholder="Confirm Password" name="password2" required>
                        <br><br>
                        <input type="button" class="signup_input" id="signupsubmit" name="register" value="Signup" onclick="sign_up_form()">
                    </form>
                    <p>Already have an account? <a href="login.php">Log In</a></p>
                </div>
            </div>
            <div id="footer">
                <script src="../JS/footer.js"></script>
            </div>
        </div>
    </body>
</html>
<script>
    var username_flag = false;
    var email_flag = false;
    var pwd_flag = false;
    var username = document.getElementsByClassName('signup_input')[0];
    var email = document.getElementsByClassName('signup_input')[1];
    var password = document.getElementsByClassName('signup_input')[2];
    username.addEventListener("change", () => {
        var pattern = /^(?=.{8,20}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9]+$/g;
        var pos = username.value.search(pattern);
        if(pos < 0){
            username.setCustomValidity("Username must be between 8-20 characters, excluding invalid characters. e.g. !@#$%^&*()_.");
            username.reportValidity();
            setTimeout(function(){username.setCustomValidity("");},2000);
            username.focus();
            username.select();
            username_flag = false;
            return false;
        }
        username_flag = true;
        return true;
    }, false);

    email.addEventListener("change", () => {
        var pattern = /^(([\w\d]+)(?=@{1}))(@[a-zA-Z]+(\.com)?$)/g;
        var pos = email.value.search(pattern);
        if(pos < 0){
            email.setCustomValidity("Email should not have invalid characters in username. Domain name must not have numbers and invalid characters");
            email.reportValidity();
            setTimeout(function(){email.setCustomValidity("");},2000);
            email.focus();
            email.select();
            email_flag = false;
            return false;
        }
        email_flag = true;
        return true;
    }, false);

    password.addEventListener("change", () => {
        var pattern = /^(?=.{8,20}$)(?=.*[0-9]+)(?=.*[!@#$%^&*]+)(?=.*[A-Z]+)(?=.*[a-z]+)[a-zA-Z0-9!@#$%^&*]+$/g;
        var pos = password.value.search(pattern);
        if(pos < 0){
            password.setCustomValidity("Password must be between 8 to 20 characters with atleast 1 capital letter, 1 small letter, 1 number and 1 special character");
            password.reportValidity();
            setTimeout(function(){password.setCustomValidity("");},3000);
            password.focus();
            password.select();
            pwd_flag = false;
            return false;
        }
        pwd_flag = true;
        return true;
    }, false);

    function sign_up_form(){
        if(username_flag && email_flag && pwd_flag){
            document.getElementById('signup_form').submit();
            return true;
        } else {
            alert("Please fill in the correct details!");
            return false;
        }
    }
</script>