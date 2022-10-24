<?php
session_start();
unset($_SESSION['valid_user']);
session_destroy();
header('Location: /Design_Project/IE4717_Group6_proj/src/login.php');
?>