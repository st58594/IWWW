<?php
session_start();
if (!empty($_SESSION["login"])) {
    require_once "classes/Connection.php";
    require_once "classes/Products.php";

} else {
    header("Location: index.php");
}
if (!empty($_GET)) {
    if ($_GET["action"] == "add" && !empty($_GET["id"])) {
        addToCart($_GET["id"]);
        header("Location: eshop.php");
    }

    if ($_GET["action"] == "remove" && !empty($_GET["id"])) {
        removeFromCart($_GET["id"]);
        header("Location: eshop.php");

    }

    if ($_GET["action"] == "delete" && !empty($_GET["id"])) {
        deleteFromCart($_GET["id"]);
        header("Location: eshop.php");
    }
}

function addToCart($productId)
{
    if (!array_key_exists($productId, $_SESSION["cart"])) {
        $_SESSION["cart"][$productId]["amount"] = 1;
    } else {
        $_SESSION["cart"][$productId]["amount"]++;
    }
}

function removeFromCart($productId)
{
    if (array_key_exists($productId, $_SESSION["cart"])) {
        if ($_SESSION["cart"][$productId]["amount"] <= 1) {
            unset($_SESSION["cart"][$productId]);
        } else {
            $_SESSION["cart"][$productId]["amount"]--;
        }
    }
}

function deleteFromCart($productId)
{
    unset($_SESSION["cart"][$productId]);
}

?>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/products.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eshop</title>
</head>
<body>
<?php
include "./pages/header.php";
?>
<div class="eshop-container">
    <div class="catalog">
        <?php
        foreach (Products::getAll() as $item) {
            echo "<div class='product-wrapper'>";
            echo "<div class='product-img'>" . $item["img"] . "</div>";
            echo "<div><h3>" . $item["name"] . "</h3></div>";
            echo "<div class='product-price'>" . $item["price"] . "</div>";
            echo "<div class='product-btn'><a href='eshop.php?action=add&id=" . $item["id"] . "'>buy</a></div>";
            echo "</div>";
        }
        ?>
    </div>
    <div class="cart">
        <h2>Cart</h2>
        <?php
        if (!empty($_SESSION["cart"])){


        $totalPrice = 0;
        foreach ($_SESSION["cart"] as $key => $value) {
            $item = Products::getBy($key);
            echo "<div class='product-wrapper'>";
            echo "<div>";
            echo "<div class='product-img'>" . $item["img"] . "</div>";
            echo "<div>" . $item["name"] . "</div>";
            echo "<div class='product-price'>" . $item["price"] . "</div>";
            echo "</div><div>";
            echo "<div class='product-price'>" . $item["price"] * $value["amount"] . "</div>";
            echo "<div class='product-amount'>" . $value["amount"] . "</div>";
            echo "<div class='product-btn'><a href='eshop.php?action=add&id=" . $item["id"] . "'>+</a></div>";
            echo "<div class='product-btn'><a href='eshop.php?action=remove&id=" . $item["id"] . "'>-</a></div>";
            echo "<div class='product-btn'><a href='eshop.php?action=delete&id=" . $item["id"] . "'>&#128465;</a></div>";
            echo "</div></div>";
            $totalPrice += $item["price"] * $value["amount"];
        }
            echo "<div class='product-wrapper'>";
            echo "<div>";
            echo "<div>Total price $totalPrice</div>";
            echo "</div><div>";
            echo "<div id='finish-order' class='product-btn'><a href='./orders.php'>Finish Order</a></div>";
            echo "</div></div>";
        }else{
            echo"<p>Cart is empty</p>";
        }
        ?>

    </div>
</div>
</body>
</html>
