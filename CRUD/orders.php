<?php
session_start();
require_once "classes/Connection.php";
require_once "classes/Products.php";
require_once "classes/Orders.php";
require_once "classes/Users.php";
if (empty($_SESSION["login"])) {
    header("Location: ./index.php");
    die();
}
if (!empty($_SESSION["cart"])) {
    Orders::createOrder(Users::getId($_SESSION["login"]), $_SESSION["cart"]);
    unset($_SESSION["cart"]);
}
?>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/products.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
</head>
<body>
<?php
include "./pages/header.php";
?>
<div class="orders-container">
        <h2>Cart</h2>
        <?php
        $totalPrice = 0;
        foreach (Orders::getOrders(Users::getId($_SESSION["login"])) as $outerItem) {
            echo "<div class='order'><h3>Order " . $outerItem["id"] . "</h3>";
            foreach (Orders::getOrderCart($outerItem["id"]) as $innerItem) {

                echo "<div class='product-wrapper'>";
                echo "<div>";
                echo "<div class='product-img'>" . $innerItem["img"] . "</div>";
                echo "<div>" . $innerItem["name"] . "</div>";
                echo "<div class='product-price'>" . $innerItem["price"] . "</div>";
                echo "</div><div>";
                echo "<div class='product-price'>" . $innerItem["price"] * $innerItem["amount"] . "</div>";
                echo "<div class='product-amount'>" . $innerItem["amount"] . "</div>";
                echo "</div></div>";
                $totalPrice += $innerItem["price"] * $innerItem["amount"];


            }
            echo "<div class='product-wrapper'>";
            echo "<div>";
            echo "<div>Total price</div>";
            echo "</div><div>";
            echo "<div>$totalPrice</div>";
            echo "</div></div></div>";
        }



        ?>

</div>
</body>
</html>
