<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/products.css">
    <link rel="stylesheet" href="../css/general_style.css">
    <title>Document</title>
</head>

<body>
    <?php 
    session_start();

    
    if (isset($_POST['itemname']) and isset($_POST['itemprice']) and isset($_POST['itemcolor']) and isset($_POST['itemquantity']) and isset($_POST['itemsize'])) {
        $itemproductname = $_POST['itemname'];
        $itemproductprice = $_POST['itemprice'];
        $itemproductcolor = $_POST['itemcolor'];
        $itemproductqty = $_POST['itemquantity'];
        $itemproductsize = $_POST['itemsize'];
    }


    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'][] = array();
    }
    
    
    // $_SESSION['cart'][] = [$itemproductname, $itemproductcolor, $itemproductprice, $itemproductqty]; Can use either this line or the one right below this to add to cart. Both of them work.
    if (isset($itemproductcolor) and isset($itemproductname) and isset($itemproductprice) and isset($itemproductqty) and isset($itemproductsize)) {
        array_push($_SESSION['cart'], [$itemproductname, $itemproductprice, $itemproductcolor, $itemproductqty, $itemproductsize]);   
    }

    // $b=array("itemproductname"=>"$itemproductname","itemproductqty"=>$itemproductqty);
    // array_push($_SESSION['cart'],$b); // Items added to cart


    include "dbconnect.php"; // connect to database
    
    if (isset($_POST['clothingtype'])) {
        $clothingtype = $_POST['clothingtype'];
    }

    if (isset($clothingtype) && $clothingtype == "dryfit") {
        $query = "select * from products where producttag = 'Dry-Fit'";
    }
    
    else if (isset($clothingtype) && $clothingtype == "casual") {
        $query = "select * from products where producttag = 'Casual'";
    }
    else if (isset($clothingtype) && $clothingtype == "shirts") {
        $query = "select * from products where producttag = 'Shirts'";
    }
    else if (isset($clothingtype) && $clothingtype == "tshirts") {
        $query = "select * from products where producttag = 'T-Shirts'";
    } 
    else {
        $query = "select * from products";

    }
    $result = $dbcnx->query($query);
    $num_results = $result->num_rows;   
    
    ?>
    <div id="wrapper">
        <div id="header">
            <header>
                <script src="../JS/header_logo.js"></script>
                <!-- tabs contents are not the same for every page. It will be edited in html files.-->
                <script src="../JS/header_tabs.js"></script>
                <!--Search bar will be re-written in JS after login and cart buttons are added-->
                <div id="search_bar">
                    <input type="text" placeholder="Search...">
                    <input type="image" src="../assets/search.png" name="search" width="35px" height="35px"
                        alt="submit">
                </div>
            </header>
        </div>
        <div class="products_body">
            <div class="filtersandproducts">
                <div class="filters">
                    <form action="products.php" method="post">
                        <p><strong>Products:</strong></p>
                        <p>Filter by:</p>
                        <div class="pricefilter">
                            <input type="radio" name="pricefilter" id="lowtohigh" class="pricefiltering" checked>
                            <label for="lowtohigh">Low to High</label>
                            <br>
                            <input type="radio" name="pricefilter" id="hightolow" class="pricefiltering">
                            <label for="hightolow">High to Low</label>
                        </div>
                        <div class="genderfilter">
                            <p><strong>Gender:</strong></p>
                            <input type="radio" name="gender" id="male" value="male" checked>
                            <label for="male">Male</label>
                            <br>
                            <input type="radio" name="gender" id="female" value="female">
                            <label for="female">Female</label>
                        </div>
                        <div class="clothingtypefilter">
                            <p><strong>Clothing Type:</strong></p>

                            <input type="radio" name="clothingtype" id="dryfit" value="dryfit"
                                <?php if(isset($clothingtype) and $clothingtype == "dryfit") { echo 'checked="checked"';} ?>>
                            <label for="dryfit">Dry-Fit</label>
                            <br>
                            <input type="radio" name="clothingtype" id="casual" value="casual"
                                <?php if(isset($clothingtype) and $clothingtype == "casual") { echo 'checked="checked"';} ?>>
                            <label for="casual">Casual</label>
                            <br>
                            <input type="radio" name="clothingtype" id="shirts" value="shirts"
                                <?php if(isset($clothingtype) and $clothingtype == "shirts") { echo 'checked="checked"';} ?>>
                            <label for="shirts">Shirts</label>
                            <br>
                            <input type="radio" name="clothingtype" id="tshirts" value="tshirts"
                                <?php if(isset($clothingtype) and $clothingtype == "tshirts") { echo 'checked="checked"';} ?>>
                            <label for="tshirts">T-Shirts</label>
                            <br>
                            <input type="radio" name="clothingtype" id="all" value="all"
                                <?php if(isset($clothingtype) and $clothingtype == "all") { echo 'checked="checked"';} ?>>
                            <label for="all">All</label>

                        </div>
                        <div class="clothingbrandsfilter">
                            <p><strong>Clothing Brands:</strong></p>
                            <input type="radio" name="clothingbrand" id="adidas" value="adidas">
                            <label for="dryfit">Adidas</label>
                            <br>
                            <input type="radio" name="clothingbrand" id="puma" value="puma">
                            <label for="casual">Puma</label>
                            <br>
                            <input type="radio" name="clothingbrand" id="zara" value="zara">
                            <label for="shirts">Zara</label>
                            <br>
                            <input type="radio" name="clothingbrand" id="h&m" value="h&m">
                            <label for="tshirts">H&M</label>
                        </div>
                        <input type="submit" value="Apply" id="submitbutton">
                    </form>
                </div>
                <div class="products">
                    <?php 
                    for($i=0;$i<$num_results;$i++) {
                        $row = $result->fetch_assoc();
                   
                        echo "<div class = \"productitems\">";
                        echo "<form action = \"item.php\" method=\"POST\">";
                        echo "<input type=\"image\"  src=\"".$row['productimage']."\" alt=\"\" height=\"150\" width=\"130\">";
                        echo "<p><strong>".$row['productname']."</strong></p>";
                        echo "<input type=\"hidden\" name=\"productname\" value = \"".$row['productname']."\">";
                        echo "<input type=\"hidden\" name=\"productprice\" value = \"".$row['productprice']."\">";
                        echo "<p><em>$".$row['productprice']."</em></p>";
                        //use the below lines if you want to visually see the data inside the cart
                        // echo $_SESSION['cart'][2][1];
                        echo '<pre>';
                        var_dump($_SESSION['cart']);
                        echo '</pre>';
                        echo "</form>";
                        echo "</div>";
                 
                    }
                    ?>

                </div>
            </div>
        </div>
        <div id="footer">
            <script src="../JS/footer.js"></script>
        </div>
    </div>
</body>

</html>