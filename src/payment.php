<?php
    session_start();
    if(!isset($_SESSION['valid_user'])){
        echo '<script>alert("You must log in first to proceed!");</script>';
        echo '<script>window.location.replace("/Design_Project/IE4717_Group6_proj/src/login.php");</script>';
        exit;
    }
    if(!isset($_SESSION['subtotal']) && !isset($_SESSION['total'])){
        // in case user reaches to payment without adding any item to cart
        echo '<script>alert("Your cart is empty!");</script>';
        //echo $_SERVER['HTTP_REFERER'];
        echo '<script>window.location.replace("'.trim(str_replace("http://localhost:8000","",$_SERVER['HTTP_REFERER'])).'");</script>';
    }
    if($_SESSION['subtotal'] == 0 && $_SESSION['total'] == 0){
        // in case user reaches to payment without adding any item to cart
        echo '<script>alert("Your cart is empty!");</script>';
        //echo $_SERVER['HTTP_REFERER'];
        echo '<script>window.location.replace("'.trim(str_replace("http://localhost:8000","",$_SERVER['HTTP_REFERER'])).'");</script>';
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FashionStore</title>
        <link rel="stylesheet" href="../css/general_style.css">
        <style>
            body{margin: 0px;}
            #payment_body {
                background-color: rgb(195, 195, 195);
                width: 70%;
                margin: auto;
                padding: 20px 20px;
                border-radius: 20px;
                min-width: 900px;
                display: block;
            }
            .card{
                border-radius: 5px;
            }
            #payment_table, #delivery_table, #billing_table{
                margin: 0px 15%;
            }
            #payment_table tr td{
                font-size: 20px;
                padding: 15px;
            }
            #payment_table tr th{
                text-align: left;
                font-size: 25px;
                padding: 15px;
                background-color: rgb(94, 38, 38);
                color: white;
            }
            #delivery_table tr th{
                text-align: left;
                font-size: 25px;
                padding: 15px;
                background-color: rgb(94, 38, 38);
                color: white;
            }
            #delivery_table tr td{
                font-size: 20px;
                padding: 15px;
            }
            #billing_table tr th{
                text-align: left;
                font-size: 25px;
                padding: 15px;
                background-color: rgb(94, 38, 38);
                color: white;
            }
            #billing_table tr td{
                font-size: 20px;
                padding: 15px;
            }
            .delivery{
                border-radius: 5px;
            }
            .billing{
                border-radius: 5px;
            }
            #submit_order{
                border-radius: 5px;
                width: 30%;
                height: auto;
                font-size: 20px;
                color: white;
                background-color: rgb(94, 38, 38);
                margin: 20px 35%;
            }
        </style>
    </head>
    <body>
        <div id="wrapper">
            <?php include "header.php"?>
            <div id="payment_body">
                <div id = "payment">
                    <table border="1" id="payment_table" style="border-collapse:collapse; width: 70%;">
                        <tr>
                            <th colspan="3">Payment Method</th>
                        </tr>
                        <tr>
                            <td rowspan="3" style="width: 40%;">
                                <input type="radio" name="payment_method" value="credit">Card/Debit Card<br><br><br>
                                <input type="radio" name="payment_method" value="cash">Cash on Delivery
                            </td>
                            <td colspan="2">Card Number<br><input type="text" class="card" name="card_no" id="card_no" style="width: 90%;"></td>
                        </tr>
                        <tr>
                            <td>Expiry Date (MM/YYYY)<br>
                                <input type="number" name="expiry_month" class="card" id="expiry_month" min = "1" max = "12" style="width: 40px;"> / 
                                <input type="number" name="expiry_year" class="card" id="expiry_year" style="width: 80px;">
                            </td>
                            <td>Security Code<br>
                                <input type="text" name="security_code" class="card" id="security_code" style="width: 50px;">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">Name on Card<br>
                                <input type="text" name="name_onCard" class="card" id="name_onCard" style="width: 90%;">
                            </td>
                        </tr>
                    </table>
                </div>
                <div id = "delivery_address">
                    <table border="1" id="delivery_table" style="border-collapse:collapse; width: 70%;">
                        <tr>
                            <th colspan="2">Delivery Address</th>
                        </tr>
                        <tr>
                            <td>First Name<br><input type="text" class="delivery" name="first_name"></td>
                            <td>Last Name<br><input type="text" class="delivery" name="last_name"></td>
                        </tr>
                        <tr>
                            <td colspan="2">Postal Code<br><input type="text" name="delivery_postal_code" class="delivery">&nbsp;&nbsp;&nbsp;
                            <input type="button" name="get_address" class="delivery" id="get_address_btn" value="Use Default Address"></td>
                        </tr>
                        <tr>
                            <td colspan="2">Address<br><textarea name="delivery_add" class="delivery" id="delivery_addID" rows="2" style="width: 50%;"></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2">Contact Number<br>
                                +65 <input type="text" class="delivery" name="contact" id="contact"><br><br>
                                <input type="checkbox" name="set_billing_add" id="set_billing_add" checked onchange=""> Use Delivery Address as Billing Address
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="billing_address">
                    <table border="1" id="billing_table" style="border-collapse:collapse; width: 70%;">
                        <tr>
                            <th colspan="2">Billing Address</th>
                        </tr>
                        <tr>
                            <td colspan="2">Postal Code<br><input type="text" name="billing_postal_code" id="billing_postal" class="billing"></td>
                        </tr>
                        <tr>
                            <td colspan="2">Address<br><textarea name="billing_add" class="billing" id="billing_addID" rows="2" style="width: 50%;"></textarea></td>
                        </tr>
                    </table>
                </div>
                <input type="submit" value="Submit Order" name="submit_order" id="submit_order">
            </div>
            <div id="footer">
                <script src="../JS/footer.js"></script>
            </div>
        </div>
    </body>
</html>