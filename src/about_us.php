<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/about_us.css">
    <link rel="stylesheet" href="../css/general_style.css">
    <title>About Us</title>
</head>
<body>
    <div id="wrapper">
        <?php include "header.php"?>
        <div class="about_us_body">
            <h3>About FashionStore</h3>
            <div id="introduction">
                <img src="../assets/fashion1.jpg" alt="" height="300" width="300">
                <div id="introductiontext">
                    <p>FashionStore was founded in 1948 by an upcoming entrepreneur at the time with the name of Htet, who
                        had studied in London Imperial College under Fashion Design. He then started his first store in
                        London with the name of FashionStore, which grew in popularity within a decade and became one of the
                        leading fashion stores in all of Europe.</p>
                </div>
            </div>
            <div class="spacer"></div>
            <div id="owner1">
                <img src="../assets/fashion2.jpg" alt="" height="300" width="300">
                <div id="owner1text">
                    <p>FashionStore was founded in 1948 by an upcoming entrepreneur at the time with the name of Htet, who
                        had studied in London Imperial College under Fashion Design. He then started his first store in
                        London with the name of FashionStore, which grew in popularity within a decade and became one of the
                        leading fashion stores in all of Europe.</p>
                </div>
            </div>
        </div>
        <div id="footer">
            <script src="../JS/footer.js"></script>
        </div>
    </div>
</body>
</html>