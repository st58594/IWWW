<?php

?>
<aside class="aside-container">

    <section class="filtry-container">
        <?php
        if (!empty($_SESSION["id_umelec"])){
            $umelec = Umelec::getUmelec($_SESSION["id_umelec"]);
            echo "<p> Nakupujete od ". $umelec["jmeno"] ." ".$umelec["prijmeni"]."</p>";
        }
        ?>

        <h3>Filtry</h3>
        <?php
        foreach (Kategorie::getAll() as $item) {
            ?>
            <form method="post" action="./controller/c_eshop.php">
                <?php
                echo "<input type='hidden' name='id_kategorie' value='" . $item["id_kategorie"] . "'>";
                echo "<input type='hidden' name='nazev' value='" . $item["nazev"] . "'>";
                echo "<label class='filtr' for='check" . $item["id_kategorie"] . "'>";
                if (isset($_SESSION["filtr"][$item["nazev"]])) {
                    echo "<input id='check" . $item["id_kategorie"] . "' type='checkbox' onchange='this.form.submit()' checked>";
                } else {
                    echo "<input id='check" . $item["id_kategorie"] . "' type='checkbox' onchange='this.form.submit()'> ";
                }
                echo $item["nazev"] . "</label>";
                ?>
            </form>
            <?php
        }
        ?>
    </section>
</aside>
<section class="content-container">
    <?php
    foreach (Produkt::getAll() as $item) {
        echo '<div class="img-box">';
        echo '<img class="produkt" src="data:image/jpeg;base64,' . base64_encode($item["nahled"]) . '"/>';
        echo '<div class="transparent-box">';
        echo '<div class="caption">';
        echo '<p>' . $item["nazev"] . '</p>';
        echo '<p>' . number_format($item["cena"], 2, ',', ' ') . ' Kč</p>';
        echo '<p class="opacity-low">';
        foreach (Produkt_Kategorie::get($item["id_produkt"]) as $kategorie) {
            echo '<span>' . $kategorie["nazev"] . '</span>';
        }
        echo '</p>';
        if ($item["mnozstvi"] > 0){
            echo '<div class="produkt-btn">';
            echo '<a href="./controller/c_eshop.php?action=add&id=' . $item["id_produkt"] . '&iu='.$item["id_umelec"].'">Do košíku</a>';
            echo '</div>';
        }else{
            echo "<p>Vyprodáno</p>";
        }
        echo '</div></div></div>';
    }
    ?>

</section>