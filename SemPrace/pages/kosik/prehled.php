<?php
if (isset($_GET["action"])) {
    if ($_GET["action"] == "zakoupeno") {
        echo "<p>Objednáno</p>";
    }
}

if (isset($_GET["err"])) {
    echo "<p>" . $_GET["err"] . "</p>";

}

if (!empty($_SESSION["cart"])) {
    $totalPrice = 0;
    foreach ($_SESSION["cart"] as $key => $value) {
        $item = Produkt::get($key);
        echo "<div class='product-wrapper'>";
        echo "<div class='left'>";
        echo "<div class='product-img'>";
        echo '<img class="thumb" src="data:image/jpeg;base64,' . base64_encode($item["nahled"]) . '"/>';
        echo "</div>";
        echo "<div class='product-name'>" . $item["nazev"] . "</div>";
        echo "<div class='product-price'>" . number_format($item["cena"], 2, ',', '') . " Kč/ks</div>";
        echo "</div><div class='right'>";
        echo "<div class='product-price'>" . $item["cena"] * $value["amount"] . " Kč</div>";
        echo "<section class='mnozstvi'>";
        echo "<div class='product-amount'>" . $value["amount"] . " ks</div>";
        echo "<div>";
        echo "<div class='product-btn'><a href='./controller/c_eshop.php?page=prehled&action=add&id=" . $item["id_produkt"] . "'><i class='fa fa-plus-square'></i></a></div>";
        echo "<div class='product-btn'><a href='./controller/c_eshop.php?page=prehled&action=remove&id=" . $item["id_produkt"] . "'><i class='fa fa-minus-square'></i></a></div>";
        echo "</div></section>";
        echo "<div class='product-btn delete'><a href='./controller/c_eshop.php?page=prehled&action=delete&id=" . $item["id_produkt"] . "'><i class='fa fa-trash'> Odebrat</i></a></div>";
        echo "</div></div>";
        $totalPrice += $item["cena"] * $value["amount"];
    }
    $_SESSION["celkova_cena"] = $totalPrice;
    echo "<div class='product-wrapper continue'>";
    echo "<div>";
    echo "<div>Celkem: <strong>" . number_format($totalPrice, 2, ',', ' ') . " Kč</strong></div>";
    echo "</div><div>";
    echo "<div id='finish-order' class='product-btn'><a href='./kosik.php?page=dodaci_udaje'><i class='fa fa-user'></i> Pokračovat</a></div>";
    echo "</div></div>";
} else {
    echo "<p>Cart is empty</p>";
}
?>


<script>
    function change(oldVal) {
        var value = document.getElementById("cena").value;
        var session = sessionStorage.getItem("cart");
        if (value < oldVal) {
            alert(session.)

        } else {
            alert(sessionStorage.getItem("cart"))
        }
    }
</script>