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
    
    
    // $_SESSION['cart'][] = [$itemproductname, $itemproductcolor, $itemproductprice, $itemproductqty]; just need to use one of these lines.
    if (isset($itemproductcolor) and isset($itemproductname) and isset($itemproductprice) and isset($itemproductqty) and isset($itemproductsize)) {
        array_push($_SESSION['cart'], [$itemproductname, $itemproductprice, $itemproductcolor, $itemproductqty, $itemproductsize]);   
    }

    // $b=array("itemproductname"=>"$itemproductname","itemproductqty"=>$itemproductqty);
    // array_push($_SESSION['cart'],$b); // Items added to cart


    @ $db = new mysqli('localhost', 'root', '', 'f38_dg06');
    if (mysqli_connect_errno()) {
        echo 'Error: Could not connect to database. Please try again later.';
        exit;
    }
    // $producttag = $_POST['clothingtype'];
    // if ($producttag = "dryfit") {
    //     $query = "select * from products where producttag = 'Dry-Fit'";
    // }
    //  if ($producttag = "casual") {
    //     $query = "select * from products where producttag = 'Casual'";
    // }
    // else if ($producttag = "shirts") {
    //     $query = "select * from products where producttag = 'T-Shirts'";
    // }
    // if($producttag = "all") {
    //     $query = "select * from products";
    // }
    $query = "select * from products";
    
    // $query = "select * from products";
   
    $result = $db->query($query);
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
                            <input type="radio" name="clothingtype" id="all" value="all" checked>
                            <label for="dryfit">All</label>
                            <br>
                            <input type="radio" name="clothingtype" id="dryfit" value="dryfit">
                            <label for="dryfit">Dry-Fit</label>
                            <br>
                            <input type="radio" name="clothingtype" id="casual" value="casual">
                            <label for="casual">Casual</label>
                            <br>
                            <input type="radio" name="clothingtype" id="shirts" value="shirts">
                            <label for="shirts">Shirts</label>
                            <br>
                            <input type="radio" name="clothingtype" id="tshirts" value="tshirts">
                            <label for="tshirts">T-Shirts</label>
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
                    <!-- <div class="productitem">
                        <p>asd</p>
                        <p>asdasd</p>
                        <p>asdas</p>
                    </div> -->
                    <?php 
                    for($i=0;$i<$num_results;$i++) {
                        $row = $result->fetch_assoc();
                   
                        echo "<div class = \"productitems\">";
                        echo "<form action = \"item.php\" method=\"POST\">";
                        echo "<input type=\"image\"  src=\"../assets/clothe1.jpg\" alt=\"\" height=\"150\" width=\"130\">";
                        echo "<p><strong>".$row['productname']."</strong></p>";
                        echo "<input type=\"hidden\" name=\"productname\" value = \"".$row['productname']."\">";
                        echo "<input type=\"hidden\" name=\"productprice\" value = \"".$row['productprice']."\">";
                        echo "<p><em>$".$row['productprice']."</em></p>";
                        // echo $_SESSION['cart'][2][1];
                        echo '<pre>';
                        var_dump($_SESSION['cart']);
                        echo '</pre>';
                        echo "</form>";
                        echo "</div>";
                 
                    }
                    ?>
                    <!-- <div class="productitems">
                        <img src="../assets/clothe1.jpg" alt="" height="150" width="130">
                        <p><strong>Clothing 1</strong></p>
                        <p><em>$12.99</em></p>
                    </div>
                    <div class="productitems">
                        <img src="../assets/clothe2.jpg" alt="" height="150" width="130">
                        <p><strong>Clothing 2</strong></p>
                        <p><em>$15.99</em></p>
                    </div>
                    <div class="productitems">
                        <img src="../assets/clothe2.jpg" alt="" height="150" width="130">
                        <p><strong>Clothing 2</strong></p>
                        <p><em>$15.99</em></p>
                    </div>
                    <div class="productitems">
                        <img src="../assets/clothe2.jpg" alt="" height="150" width="130">
                        <p><strong>Clothing 2</strong></p>
                        <p><em>$15.99</em></p>
                    </div>
                    <div class="productitems">
                        <img src="../assets/clothe2.jpg" alt="" height="150" width="130">
                        <p><strong>Clothing 2</strong></p>
                        <p><em>$15.99</em></p>
                    </div>
                    <div class="productitems">
                        <img src="../assets/clothe2.jpg" alt="" height="150" width="130">
                        <p><strong>Clothing 2</strong></p>
                        <p><em>$15.99</em></p>
                    </div>
                    <div class="productitems">
                        <img src="../assets/clothe2.jpg" alt="" height="150" width="130">
                        <p><strong>Clothing 2</strong></p>
                        <p><em>$15.99</em></p>
                    </div>
                    <div class="productitems">
                        <img src="../assets/clothe2.jpg" alt="" height="150" width="130">
                        <p><strong>Clothing 2</strong></p>
                        <p><em>$15.99</em></p>
                    </div>
                    <div class="productitems">
                        <img src="../assets/clothe2.jpg" alt="" height="150" width="130">
                        <p><strong>Clothing 2</strong></p>
                        <p><em>$15.99</em></p>
                    </div> -->




                </div>
            </div>
        </div>
        <div id="footer">
            <script src="../JS/footer.js"></script>
        </div>
    </div>
</body>

</html>