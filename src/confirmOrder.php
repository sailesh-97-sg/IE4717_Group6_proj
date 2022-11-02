<?php
    session_start();

    if(!isset($_SESSION['valid_user'])){
        echo '<script>alert("You are not logged in!");</script>';
        echo '<script>window.location.replace("login.php");</script>';
        exit;
    }

    if(!isset($_SESSION['cart'])){
        if(!empty($_SESSION['cart'])){
            echo '<script>alert("Your cart is empty!");</script>';
            echo '<script>window.location.replace("products.php");</script>';
        }
    }

    // setting variables
    $username = $_SESSION['valid_user'];
    //$isBillingSame = $_REQUEST['set_billing_add'];
    $deli_address = $_REQUEST['delivery_add'];
    $deli_postal = $_REQUEST['delivery_postal_code'];
    $contact = $_REQUEST['contact'];
    //if($isBillingSame == "checked"){
    if(isset($_REQUEST['set_billing_add'])){
        $bill_address = $deli_address;
        $bill_postal = $deli_postal;
    } else {
        $bill_address = $_REQUEST['billing_add'];
        $bill_postal = $_REQUEST['billing_postal'];
    }

    if($_SESSION['shipping'] == 0.00){
        $shipping = "standard";
    } else {
        $shipping = "fast";
    }
    $total_qty = $_SESSION['total_qty'];
    $total_price = $_SESSION['total'];
    $products = $_SESSION['no_of_products'];

    // save to db
    include "dbconnect.php";
    $query = "insert into orders(username, total_qty, total_price, products, shipping, deli_address, deli_postal, deli_contact, bill_address, bill_postal) values (?,?,?,?,?,?,?,?,?,?)";
    $stmt = $dbcnx->prepare($query);
    $stmt->bind_param('sidissssss', $username, $total_qty, $total_price, $products, $shipping, $deli_address, $deli_postal, $contact, $bill_address, $bill_postal);
    $stmt->execute();

    if(!$stmt){
        echo "An error has occured while updating orders";
    }

    $query = "update users set contact = '$contact', address = '$deli_address', postal = '$deli_postal' where username = '$username'";
    $result = $dbcnx->query($query);
    //$num_rows = $result->num_rows;

    if($dbcnx->errno){
        echo "Could not update user's table: ".$dbcnx->error;
        $dbcnx->close();
        exit;
    }
    $dbcnx->close();
?>
<!-- email code can be put here. 
<?php
    unset($_SESSION['cart']);
    unset($_SESSION['total_qty']);
    unset($_SESSION['total']);
    unset($_SESSION['no_of_products']);
    unset($_SESSION['subtotal']);
    unset($_SESSION['shipping']);
?>